/**
 * @package 	WordPress
 * @subpackage 	schule
 * @version		1.0.0
 * 
 * LearnPress Content Composer Schortcodes Extend
 * Created by CMSMasters
 * 
 */


/**
 * LearnPress
 */
cmsmastersShortcodes.cmsmasters_learnpress = { 
	title : 	cmsmasters_learnpress_shortcodes.learnpress_title, 
	icon : 		'admin-icon-sitemap', 
	pair : 		false, 
	content : 	false, 
	visual : 	false, 
	multiple : 	false, 
	def : 		'', 
	fields : { 
		// Shortcode ID
		shortcode_id : { 
			type : 		'hidden', 
			title : 	'', 
			descr : 	'', 
			def : 		'', 
			required : 	true, 
			width : 	'full' 
		}, 
		// Order By
		orderby : { 
			type : 		'select', 
			title : 	cmsmasters_shortcodes.orderby_title, 
			descr : 	cmsmasters_learnpress_shortcodes.course_field_orderby_descr, 
			def : 		'date', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'date' : 		cmsmasters_shortcodes.choice_date, 
						'name' : 		cmsmasters_shortcodes.name, 
						'id' : 			cmsmasters_shortcodes.choice_id, 
						'menu_order' : 	cmsmasters_shortcodes.choice_menu
			} 
		}, 
		// Order
		order : { 
			type : 		'radio', 
			title : 	cmsmasters_shortcodes.order_title, 
			descr : 	cmsmasters_shortcodes.order_descr, 
			def : 		'DESC', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'ASC' : 	cmsmasters_shortcodes.choice_asc, 
						'DESC' : 	cmsmasters_shortcodes.choice_desc
			} 
		}, 
		// Categories
		categories : { 
			type : 		'select_multiple', 
			title : 	cmsmasters_shortcodes.categories, 
			descr : 	cmsmasters_learnpress_shortcodes.course_field_categories_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_learnpress_shortcodes.course_field_categories_descr_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	cmsmasters_learnpress_shortcodes.course_categories 
		}, 
		// Courses Number
		count : { 
			type : 		'input', 
			title : 	cmsmasters_learnpress_shortcodes.course_field_postsnumber_title, 
			descr : 	cmsmasters_learnpress_shortcodes.course_field_postsnumber_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_learnpress_shortcodes.course_field_postsnumber_descr_note + "</span>", 
			def : 		'12', 
			required : 	false, 
			width : 	'number', 
			min : 		'1' 
		}, 
		// Columns Count
		columns : { 
			type : 		'select', 
			title : 	cmsmasters_shortcodes.columns_count, 
			descr : 	cmsmasters_learnpress_shortcodes.course_field_col_count_descr, 
			def : 		'4', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'1' : 	'1', 
						'2' : 	'2', 
						'3' : 	'3', 
						'4' : 	'4', 
						'5' : 	'5' 
			} 
		}, 
		// Additional Classes
		classes : { 
			type : 		'input', 
			title : 	cmsmasters_shortcodes.classes_title, 
			descr : 	cmsmasters_shortcodes.classes_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half' 
		}, 
	} 
};

