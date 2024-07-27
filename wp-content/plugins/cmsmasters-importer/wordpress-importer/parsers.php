<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Importer
 * @version 	1.0.7
 */

/**
 * WordPress eXtended RSS file parser implementations
 */
_deprecated_file( basename( __FILE__ ), '0.7.0' );

/** WXR_Parser class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser.php';

/** WXR_Parser_SimpleXML class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-simplexml.php';

/** WXR_Parser_XML class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-xml.php';

/** WXR_Parser_Regex class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-regex.php';
