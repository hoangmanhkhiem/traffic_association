/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.0.0
 * 
 * Content Composer Shortcodes for Editor Scripts
 * Created by CMSMasters
 * 
 */


(function () { 
	tinymce.create('tinymce.plugins.cmsmasters_shortcodes', { 
        init : function (c, url) { 
			c.addCommand('cmsmasters_shortcodes_command', function () { 
				var elObj = { 
					index : 	false, 
					prepend : 	false, 
					editor : 	true 
				};
				
				
				cmsmastersComposerLightbox.methods.openShortcodes(elObj);
			} );
			
			
			c.addButton('cmsmasters_shortcodes', { 
				title : 'Content Composer shortcodes', 
				cmd : 'cmsmasters_shortcodes_command' 
			} );
        }, 
		createControl : function (n, c) { 
            return null;
		}, 
		getInfo : function () { 
			return { 
				longname : 		'CMSMasters Shortcodes Selector', 
				author : 		'CMSMasters', 
				authorurl : 	'http://cmsmasters.net/', 
				infourl : 		'http://cmsmasters.net/', 
				version : 		'1.0' 
			};
		} 
	} );
	
	
	tinymce.PluginManager.add('cmsmasters_shortcodes', tinymce.plugins.cmsmasters_shortcodes);
} )();

