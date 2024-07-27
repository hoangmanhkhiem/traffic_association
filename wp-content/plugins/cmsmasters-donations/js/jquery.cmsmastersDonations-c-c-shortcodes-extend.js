/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version 	1.2.2
 * 
 * CMSMasters Donations Content Composer Schortcodes Extend
 * Created by CMSMasters
 * 
 */


/**
 * Donations
 */
cmsmastersShortcodes.cmsmasters_donations = {
	title : 	cmsmasters_donations_shortcodes.donations_title, 
	icon : 		'admin-icon-donate', 
	pair : 		false, 
	content : 	false, 
	visual : 	false, 
	multiple : 	false, 
	def : 		"", 
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
			descr : 	'', 
			def : 		'date', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'date' : 					cmsmasters_shortcodes.choice_date, 
						'cmsmasters_donation_amount' : 	cmsmasters_shortcodes.choice_amount, 
						'rand' : 					cmsmasters_shortcodes.choice_rand 
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
		// Donations Number
		count : { 
			type : 		'input', 
			title : 	cmsmasters_donations_shortcodes.donations_field_donations_number_title, 
			descr : 	"<span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_donations_shortcodes.donations_field_donations_number_descr_note + "</span>", 
			def : 		'4', 
			required : 	false, 
			width : 	'number', 
			min : 		'0' 
		}, 
		// Donations Campaigns
		campaigns : { 
			type : 		'select_multiple', 
			title : 	cmsmasters_donations_shortcodes.donations_field_campaigns_title, 
			descr : 	cmsmasters_donations_shortcodes.donations_field_campaigns_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_donations_shortcodes.donations_field_campaigns_descr_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	cmsmasters_composer_campaign_ids() 
		}, 
		// Columns Count
		columns : { 
			type : 		'select', 
			title : 	cmsmasters_shortcodes.columns_count, 
			descr : 	'', 
			def : 		'4', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'1' : 	'1', 
						'2' : 	'2', 
						'3' : 	'3', 
						'4' : 	'4' 
			}
		}, 
		// Donations Metadata
		donation_metadata : { 
			type : 		'checkbox', 
			title : 	cmsmasters_donations_shortcodes.donations_field_postsmeta_title, 
			descr : 	'', 
			def : 		'image,link,campaign,amount', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'image' : 		cmsmasters_shortcodes.choice_image, 
						'link' : 		cmsmasters_shortcodes.choice_link, 
						'campaign' : 	cmsmasters_donations_shortcodes.choice_campaign, 
						'amount' : 		cmsmasters_shortcodes.choice_amount 
			}
		}, 
		// CSS3 Animation
		animation : { 
			type : 		'select', 
			title : 	cmsmasters_shortcodes.animation_title, 
			descr : 	cmsmasters_shortcodes.animation_descr + " <br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_shortcodes.animation_descr_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	get_animations() 
		}, 
		// Animation Delay
		animation_delay : { 
			type : 		'input', 
			title : 	cmsmasters_shortcodes.animation_delay_title, 
			descr : 	cmsmasters_shortcodes.animation_delay_descr + " <br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_shortcodes.animation_delay_descr_note + "</span>", 
			def : 		'0', 
			required : 	false, 
			width : 	'number', 
			min : 		'0', 
			step : 		'50' 
		}, 
		// Additional Classes
		classes : { 
			type : 		'input', 
			title : 	cmsmasters_shortcodes.classes_title, 
			descr : 	cmsmasters_shortcodes.classes_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half' 
		} 
	} 
};



/**
 * Featured Campaign
 */
cmsmastersShortcodes.cmsmasters_featured_campaign = {
	title : 	cmsmasters_donations_shortcodes.featured_campaign_title, 
	icon : 		'admin-icon-donate', 
	pair : 		false, 
	content : 	false, 
	visual : 	false, 
	multiple : 	false, 
	def : 		"", 
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
		// Campaign ID
		campaign : { 
			type : 		'select', 
			title : 	cmsmasters_donations_shortcodes.featured_campaign_field_campaign_title, 
			descr : 	'', 
			def : 		'', 
			required : 	true, 
			width : 	'half', 
			choises : 	cmsmasters_composer_campaign_ids() 
		}, 
		// Donations Metadata
		campaign_metadata : { 
			type : 		'checkbox', 
			title : 	cmsmasters_donations_shortcodes.featured_campaign_field_postsmeta_title, 
			descr : 	'', 
			def : 		'image,link,rest_amount,donated_percent,excerpt,donation_but', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'image' : 				cmsmasters_shortcodes.choice_image, 
						'link' : 				cmsmasters_shortcodes.choice_link, 
						'rest_amount' : 		cmsmasters_donations_shortcodes.choice_rest_amount, 
						'donated_percent' : 	cmsmasters_donations_shortcodes.choice_donated_percent, 
						'excerpt' : 			cmsmasters_shortcodes.choice_excerpt, 
						'donation_but' : 		cmsmasters_donations_shortcodes.choice_donation_but 
			}
		}, 
		// CSS3 Animation
		animation : { 
			type : 		'select', 
			title : 	cmsmasters_shortcodes.animation_title, 
			descr : 	cmsmasters_shortcodes.animation_descr + " <br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_shortcodes.animation_descr_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	get_animations() 
		}, 
		// Animation Delay
		animation_delay : { 
			type : 		'input', 
			title : 	cmsmasters_shortcodes.animation_delay_title, 
			descr : 	cmsmasters_shortcodes.animation_delay_descr + " <br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_shortcodes.animation_delay_descr_note + "</span>", 
			def : 		'0', 
			required : 	false, 
			width : 	'number', 
			min : 		'0', 
			step : 		'50' 
		}, 
		// Additional Classes
		classes : { 
			type : 		'input', 
			title : 	cmsmasters_shortcodes.classes_title, 
			descr : 	cmsmasters_shortcodes.classes_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half' 
		} 
	} 
};



/**
 * Campaigns
 */
cmsmastersShortcodes.cmsmasters_campaigns = {
	title : 	cmsmasters_donations_shortcodes.campaigns_title, 
	icon : 		'admin-icon-donate', 
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
			descr : 	'', 
			def : 		'date', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'date' : 		cmsmasters_shortcodes.choice_date, 
						'campaigns' : 	cmsmasters_donations_shortcodes.choice_campaign, 
						'rand' : 		cmsmasters_shortcodes.choice_rand 
			} 
		}, 
		// Campaigns IDs
		campaigns_ids : { 
			type : 		'select_multiple', 
			title : 	cmsmasters_donations_shortcodes.campaigns_field_campaigns_ids_title, 
			descr : 	cmsmasters_donations_shortcodes.campaigns_field_campaigns_ids_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_donations_shortcodes.campaigns_field_campaigns_ids_descr_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	cmsmasters_composer_campaign_ids(), 
			depend : 	'orderby:campaigns' 
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
		// Campaigns Categories
		campaigns_categories : { 
			type : 		'select_multiple', 
			title : 	cmsmasters_donations_shortcodes.campaigns_field_campaigns_categories_title, 
			descr : 	cmsmasters_donations_shortcodes.campaigns_field_campaigns_categories_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_donations_shortcodes.campaigns_field_campaigns_categories_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	cmsmasters_composer_campaign_categories() 
		}, 
		// Columns Count
		columns : { 
			type : 		'select', 
			title : 	cmsmasters_shortcodes.columns_count, 
			descr : 	'', 
			def : 		'4', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'1' : 	'1', 
						'2' : 	'2', 
						'3' : 	'3', 
						'4' : 	'4' 
			} 
		}, 
		// Campaigns Number
		count : { 
			type : 		'input', 
			title : 	cmsmasters_donations_shortcodes.campaigns_field_campaigns_number_title, 
			descr : 	"<span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_donations_shortcodes.campaigns_field_campaigns_number_descr_note + "</span>", 
			def : 		'4', 
			required : 	false, 
			width : 	'number', 
			min : 		'0' 
		}, 
		// Pause Time
		pause : { 
			type : 		'input', 
			title : 	cmsmasters_shortcodes.pause_time, 
			descr : 	cmsmasters_donations_shortcodes.campaigns_field_pausetime_descr + "<br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_shortcodes.autoslide_def + "</span>", 
			def : 		'5', 
			required : 	false, 
			width : 	'number', 
			min : 		'0' 
		}, 
		// Campaigns Metadata
		campaigns_metadata : { 
			type : 		'checkbox', 
			title : 	cmsmasters_donations_shortcodes.campaigns_field_campaigns_metadata_title, 
			descr : 	'', 
			def : 		'title,excerpt,donated_percent', 
			required : 	true, 
			width : 	'half', 
			choises : { 
						'title' : 				cmsmasters_shortcodes.choice_title, 
						'excerpt' : 			cmsmasters_shortcodes.choice_excerpt, 
						'donated_percent' : 	cmsmasters_donations_shortcodes.choice_donated_percent, 
			} 
		}, 
		// CSS3 Animation
		animation : { 
			type : 		'select', 
			title : 	cmsmasters_shortcodes.animation_title, 
			descr : 	cmsmasters_shortcodes.animation_descr + " <br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_shortcodes.animation_descr_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	get_animations() 
		}, 
		// Animation Delay
		animation_delay : { 
			type : 		'input', 
			title : 	cmsmasters_shortcodes.animation_delay_title, 
			descr : 	cmsmasters_shortcodes.animation_delay_descr + " <br /><span>" + cmsmasters_shortcodes.note + ' ' + cmsmasters_shortcodes.animation_delay_descr_note + "</span>", 
			def : 		'0', 
			required : 	false, 
			width : 	'number', 
			min : 		'0', 
			step : 		'50' 
		}, 
		// Additional Classes
		classes : { 
			type : 		'input', 
			title : 	cmsmasters_shortcodes.classes_title, 
			descr : 	cmsmasters_shortcodes.classes_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half' 
		} 
	} 
};



/**
 * Button
 */
var button_new_fields = {};

for (var id in cmsmastersShortcodes.cmsmasters_button.fields) {
	if (id === 'button_title') {
		button_new_fields[id] = cmsmastersShortcodes.cmsmasters_button.fields[id];
		
		
		button_new_fields['button_type'] = { 
			type : 		'radio', 
			title : 	cmsmasters_donations_shortcodes.button_field_type_title, 
			descr : 	'', 
			def : 		'regular', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'regular' : 	cmsmasters_donations_shortcodes.choice_button_type_regular, 
						'donation' : 	cmsmasters_donations_shortcodes.choice_button_type_donation 
			} 
		};
	} else if (id === 'button_link') {
		cmsmastersShortcodes.cmsmasters_button.fields[id]['depend'] = 'button_type:regular';
		
		
		button_new_fields[id] = cmsmastersShortcodes.cmsmasters_button.fields[id];
	} else {
		button_new_fields[id] = cmsmastersShortcodes.cmsmasters_button.fields[id];
	}
	
	
	if (id === 'button_link') {
		button_new_fields['button_campaign'] = { 
			type : 		'select', 
			title : 	cmsmasters_donations_shortcodes.button_field_campaign_title, 
			descr : 	'', 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	cmsmasters_composer_donation_but_campaign_ids(), 
			depend : 	'button_type:donation' 
		};
		
		
		button_new_fields[id] = cmsmastersShortcodes.cmsmasters_button.fields[id];
	} else {
		button_new_fields[id] = cmsmastersShortcodes.cmsmasters_button.fields[id];
	}
}

cmsmastersShortcodes.cmsmasters_button.fields = button_new_fields;

