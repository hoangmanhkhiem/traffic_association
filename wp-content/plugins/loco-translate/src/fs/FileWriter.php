<?php
/**
 * Provides write operation context via the WordPress file system API
 */
class Loco_fs_FileWriter {

   /**
    * @var Loco_fs_File
    */
    private $file;

    /**
     * @var WP_Filesystem_Base
     */
    private $fs;

    /**
     * @param Loco_fs_File $file
     */
    public function __construct( Loco_fs_File $file ){
        $this->setFile($file);
        $this->disconnect();
    }
    
    
    /**
     * @param Loco_fs_File $file
     * @return Loco_fs_FileWriter
     */
    public function setFile( Loco_fs_File $file ){
        $this->file = $file;
        return $this;
    }
    

    /**
     * Connect to alternative file system context
     * 
     * @param WP_Filesystem_Base $fs
     * @param bool $disconnected whether reconnect required
     * @return Loco_fs_FileWriter
     * @throws Loco_error_WriteException
     */
    public function connect( WP_Filesystem_Base $fs, $disconnected = true ){
        if( $disconnected && ! $fs->connect() ){
            $errors = $fs->errors;
            if( is_wp_error($errors) ){
                foreach( $errors->get_error_messages() as $reason ){
                    Loco_error_AdminNotices::warn($reason);
                }
            }
            throw new Loco_error_WriteException( __('Failed to connect to remote server','loco-translate') );
        }
        $this->fs = $fs;
        return $this;
    }
    
    
    /**
     * Revert to direct file system connection
     * @return self
     */
    public function disconnect(){
        $this->fs = Loco_api_WordPressFileSystem::direct();
        return $this;
    }


    /**
     * Get mapped path for use in indirect file system manipulation
     * @return string
     */
    public function getPath(){
        return $this->mapPath( $this->file->getPath() );
    }


    /**
     * Map virtual path for remote file system
     * @param string $path
     * @return string
     */
    private function mapPath( $path ){
        if( ! $this->isDirect() ){
            $base = untrailingslashit( Loco_fs_File::abs(loco_constant('WP_CONTENT_DIR')) );
            $snip = strlen($base);
            if( substr( $path, 0, $snip ) !== $base ){
                // fall back to default path in case of symlinks
                $base = trailingslashit(ABSPATH).'wp-content';
                $snip = strlen($base);
                if( substr( $path, 0, $snip ) !== $base ){
                    throw new Loco_error_WriteException('Remote path must be under WP_CONTENT_DIR');
                }
            }
            $virt = $this->fs->wp_content_dir();
            if( false === $virt ){
                throw new Loco_error_WriteException('Failed to find WP_CONTENT_DIR via remote connection');
            }
            $virt = untrailingslashit( $virt );
            $path = substr_replace( $path, $virt, 0, $snip );
        }
        return $path;
    }


    /**
     * Test if a direct (not remote) file system
     * @return bool
     */
    public function isDirect(){
        return $this->fs instanceof WP_Filesystem_Direct;
    }


    /**
     * @return bool
     */
    public function writable(){
        return ! $this->disabled() && $this->fs->is_writable( $this->getPath() );
    }


    /**
     * @param int $mode file mode integer e.g 0664
     * @param bool $recursive whether to set recursively (directories)
     * @return Loco_fs_FileWriter
     * @throws Loco_error_WriteException
     */
    public function chmod( $mode, $recursive = false ){
        $this->authorize();
        if( ! $this->fs->chmod( $this->getPath(), $mode, $recursive ) ){
            // translators: %s refers to a file name, for which the chmod operation failed.
            throw new Loco_error_WriteException( sprintf( __('Failed to chmod %s','loco-translate'), $this->file->basename() ) );
        }
        return $this;
    }


    /**
     * @param Loco_fs_File $copy target for copy
     * @return Loco_fs_FileWriter
     * @throws Loco_error_WriteException
     */
    public function copy( Loco_fs_File $copy ){
        $this->authorize();
        $source = $this->getPath();
        $target = $this->mapPath( $copy->getPath() );
        // bugs in WP file system "exists" methods means we must force $overwrite=true; so checking file existence first
        if( $copy->exists() ){
            Loco_error_AdminNotices::debug(sprintf('Cannot copy %s to %s (target already exists)',$source,$target));
            throw new Loco_error_WriteException( __('Refusing to copy over an existing file','loco-translate') );
        }
        // ensure target directory exists, although in most cases copy will be in situ
        $parent = $copy->getParent();
        if( $parent && ! $parent->exists() ){
            $this->mkdir($parent);
        }
        // perform WP file system copy method
        if( ! $this->fs->copy($source,$target,true) ){
            Loco_error_AdminNotices::debug(sprintf('Failed to copy %s to %s via "%s" method',$source,$target,$this->fs->method));
            // translators: (1) Source file name (2) Target file name
            throw new Loco_error_WriteException( sprintf( __('Failed to copy %1$s to %2$s','loco-translate'), basename($source), basename($target) ) );
        }

        return $this;
    }


    /**
     * @param Loco_fs_File $dest target file with new path
     * @return Loco_fs_FileWriter
     * @throws Loco_error_WriteException
     */
    public function move( Loco_fs_File $dest ){
        $orig = $this->file;
        try {
            // target should have been authorized to create the new file
            $context = clone $dest->getWriteContext();
            $context->setFile($orig);
            $context->copy($dest);
            // source should have been authorized to delete the original file
            $this->delete(false);
            return $this;
        }
        catch( Loco_error_WriteException $e ){
            Loco_error_AdminNotices::debug('copy/delete failure: '.$e->getMessage() );
            throw new Loco_error_WriteException( sprintf( 'Failed to move %s', $orig->basename() ) );
        }
    }


    /**
     * @param bool $recursive
     * @return self
     * @throws Loco_error_WriteException
     */
    public function delete( $recursive = false ){
        $this->authorize();
        if( ! $this->fs->delete( $this->getPath(), $recursive ) ){
            // translators: %s refers to a file name, for which a delete operation failed.
            throw new Loco_error_WriteException( sprintf( __('Failed to delete %s','loco-translate'), $this->file->basename() ) );
        }

        return $this;
    }


    /**
     * @param string $data
     * @return Loco_fs_FileWriter
     * @throws Loco_error_WriteException
     */
    public function putContents( $data ){
        $this->authorize();
        $file = $this->file;
        if( $file->isDirectory() ){
            // translators: %s refers to a directory name which was expected to be an ordinary file
            throw new Loco_error_WriteException( sprintf( __('"%s" is a directory, not a file','loco-translate'), $file->basename() ) );
        }
        // file having no parent directory is likely an error, like a relative path.
        $dir = $file->getParent();
        if( ! $dir ){
            throw new Loco_error_WriteException( sprintf('Bad file path "%s"',$file) );
        }
        // avoid chmod of existing file
        if( $file->exists() ){
            $mode = $file->mode();
        }
        // may have bypassed definition of FS_CHMOD_FILE
        else {
            $mode = defined('FS_CHMOD_FILE') ? FS_CHMOD_FILE : 0644;
            // new file may also require directory path building
            if( ! $dir->exists() ){
                $this->mkdir($dir);
            }
        }
        $fs = $this->fs;
        $path = $this->getPath();
        if( ! $fs->put_contents($path,$data,$mode) ){
            // provide useful reason for failure if possible
            if( $file->exists() && ! $file->writable() ){
                Loco_error_AdminNotices::debug( sprintf('File not writable via "%s" method, check permissions on %s',$fs->method,$path) );
                throw new Loco_error_WriteException( __("Permission denied to update file",'loco-translate') );
            }
            // directory path should exist or have thrown error earlier.
            // directory path may not be writable by same fs context
            if( ! $dir->writable() ){
                Loco_error_AdminNotices::debug( sprintf('Directory not writable via "%s" method; check permissions for %s',$fs->method,$dir) );
                throw new Loco_error_WriteException( __("Parent directory isn't writable",'loco-translate') );
            }
            // else reason for failure is not established
            Loco_error_AdminNotices::debug( sprintf('Unknown write failure via "%s" method; check %s',$fs->method,$path) );
            throw new Loco_error_WriteException( __('Failed to save file','loco-translate').': '.$file->basename() );
        }
        // trigger hook every time a file is written. This allows caches to be invalidated
        try {
            do_action( 'loco_file_written', $path );
        }
        catch( Exception $e ){
            Loco_error_AdminNotices::add( Loco_error_Exception::convert($e) );
        }
        return $this;
    }


    /**
     * Create current directory context
     * @param Loco_fs_File|null $here optional working directory
     * @return bool
     * @throws Loco_error_WriteException
     */
     public function mkdir( Loco_fs_File $here = null ) {
        if( is_null($here) ){
            $here = $this->file;
        }
        $this->authorize();
        $fs = $this->fs;
        // may have bypassed definition of FS_CHMOD_DIR
        $mode = defined('FS_CHMOD_DIR') ? FS_CHMOD_DIR : 0755;
        // find first ancestor that exists while building tree
        $stack = [];
        /* @var $parent Loco_fs_Directory */
        while( $parent = $here->getParent() ){
            array_unshift( $stack, $this->mapPath( $here->getPath() ) );
            if( '/' === $parent->getPath() || $parent->readable() ){
                // have existent directory, now build full path
                foreach( $stack as $path ){
                    if( ! $fs->mkdir($path,$mode) ){
                        Loco_error_AdminNotices::debug( sprintf('mkdir(%s,%03o) failed via "%s" method;',var_export($path,1),$mode,$fs->method) );
                        throw new Loco_error_WriteException( __('Failed to create directory','loco-translate') );
                    }
                }
                return true;
            }
            $here = $parent;
        }
        // refusing to create directory when the entire path is missing. e.g. "/bad"
        throw new Loco_error_WriteException( __('Failed to build directory path','loco-translate') );
    }


    /**
     * Check whether write operations are permitted, or throw
     * @throws Loco_error_WriteException
     * @return self
     */
    public function authorize(){
        if( $this->disabled() ){
            throw new Loco_error_WriteException( __('File modification is disallowed by your WordPress config','loco-translate') );
        }
        $opts = Loco_data_Settings::get();
        // deny system file changes (fs_protect = 2)
        if( 1 < $opts->fs_protect && $this->file->getUpdateType() ){
            throw new Loco_error_WriteException( __('Modification of installed files is disallowed by the plugin settings','loco-translate') );
        }
        // we may need to examine multiple extensions, or there may be none for directories
        $exts = array_slice( explode('.',strtolower($this->file->basename())), 1 );
        if( ! $exts ){
            return $this;
        }
        $ext = array_pop($exts);
        // deny POT modification (pot_protect = 2)
        // this assumes that templates all have .pot extension, which isn't guaranteed. UI should prevent saving of wrongly files like "default.po"
        if( 'pot' === $ext && 1 < $opts->pot_protect ){
            throw new Loco_error_WriteException( __( 'Modification of POT (template) files is disallowed by the plugin settings', 'loco-translate' ) );
        }
        // Full list of file extensions this plugin can modify; note that specific actions may limit this further.
        $allow = [ 'po'=>1, 'pot'=>1, 'mo'=>1, 'json'=>1, 'po~'=>1, 'pot~'=>1, 'txt'=>1, 'xml'=>1, 'zip'=>1 ];
        if( array_key_exists($ext,$allow) ){
            return $this;
        }
        // Writing to PHP files is generally disallowed, but we need to write l10n.php cache files
        if( preg_match('/php\\d*/i',$ext) ){
            $prev = array_pop($exts);
            if( 'mo' === $prev || 'l10n' === $prev ){
                return $this;
            }
        }
        throw new Loco_error_WriteException('File extension disallowed .'.$ext );
    }


    /**
     * Check if file system modification is banned at WordPress level
     * @return bool
     */
    public function disabled(){
        // WordPress >= 4.8
        if( function_exists('wp_is_file_mod_allowed') ){
            $context = apply_filters( 'loco_file_mod_allowed_context', 'download_language_pack', $this->file );
            return ! wp_is_file_mod_allowed( $context );
        }
        // fall back to direct constant check
        return (bool) loco_constant('DISALLOW_FILE_MODS');
    }

}
