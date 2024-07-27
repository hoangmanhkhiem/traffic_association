/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version 	1.0.0
 * 
 * CMSMasters Donations Validation Engine Language File
 * Created by CMSMasters
 * 
 */


(function ($) { 
    $.fn.validationEngineLanguage = function () { 
		// empty function
	};
	
	
    $.validationEngineLanguage = { 
        newLang : function () { 
            $.validationEngineLanguage.allRules = { 
                "required" : { 
                    "regex" : 						"none", 
                    "alertText" : 					cmsmasters_ve_lang.required, 
                    "alertTextCheckboxMultiple" : 	cmsmasters_ve_lang.select_option, 
                    "alertTextCheckboxe" : 			cmsmasters_ve_lang.required_checkbox 
                }, 
                "minSize" : { 
                    "regex" : 						"none", 
                    "alertText" : 					cmsmasters_ve_lang.min, 
                    "alertText2" : 					cmsmasters_ve_lang.allowed 
                }, 
                "maxSize" : { 
                    "regex" : 						"none", 
                    "alertText" : 					cmsmasters_ve_lang.max, 
                    "alertText2" : 					cmsmasters_ve_lang.allowed 
                }, 
                "email" : { 
                    "regex" : 						/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/, 
                    "alertText" : 					cmsmasters_ve_lang.invalid_email 
                }, 
                "number" : { 
                    "regex" : 						/^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/, 
                    "alertText" : 					cmsmasters_ve_lang.invalid_number 
                }, 
                "url" : { 
                    "regex" : 						/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i, 
                    "alertText" : 					cmsmasters_ve_lang.invalid_url 
                }, 
                "onlyNumberSp" : { 
                    "regex" : 						/^[0-9\ ]+$/, 
                    "alertText" : 					cmsmasters_ve_lang.numbers_spaces 
                }, 
                "onlyLetterSp" : { 
                    "regex" : 						/^[a-zA-Z\ \']+$/, 
                    "alertText" : 					cmsmasters_ve_lang.letters_spaces 
                } 
            };
        } 
    };
	
	
    $.validationEngineLanguage.newLang();
} )(jQuery);

