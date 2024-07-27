<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Gutenberg Module Colors Rules
 * Created by CMSMasters
 * 
 */


function schule_gutenberg_module_colors($custom_css = '', $is_editor = false) {
	$cmsmasters_option = schule_get_global_options();
	
	$editor = ($is_editor ? '.editor-styles-wrapper' : '');
	
	$custom_css .= "
/***************** Start Gutenberg Module Custom Colors Scheme Rules ******************/

	{$editor} div.wp-block ul > li:before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_border']) . "
	}
	
	{$editor} .wp-block-quote,
	.editor-styles-wrapper .wp-block-freeform blockquote,
	.editor-styles-wrapper .wp-block-freeform blockquote p {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_heading']) . "
	}
	
	
	/* Start Table Colors */
	{$editor} .wp-block-table th,
	{$editor} .wp-block-table td,
	{$editor} .wp-block-table.is-style-stripes th,
	{$editor} .wp-block-table.is-style-stripes td,
	.editor-styles-wrapper .wp-block-freeform .mce-item-table tbody tr th,
	.editor-styles-wrapper .wp-block-freeform .mce-item-table tbody tr td,
	.editor-styles-wrapper .wp-block-freeform table tbody tr th,
	.editor-styles-wrapper .wp-block-freeform table tbody tr td {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_default_border']) . "
	}
	
	{$editor} .wp-block-table.is-style-stripes tr:nth-child(odd) th,
	{$editor} .wp-block-table.is-style-stripes tr:nth-child(odd) td {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_alternate']) . "
	}
	
	{$editor} .wp-block-table thead th,
	{$editor} .wp-block-table thead td,
	{$editor} .wp-block-freeform.mce-content-body > table thead th,
	{$editor} .wp-block-freeform.mce-content-body > table thead td {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_secondary']) . "
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_default_secondary']) . "
	}
	
	{$editor} .wp-block-table thead th,
	{$editor} .wp-block-table thead td,
	{$editor} .wp-block-freeform.mce-content-body > table thead th,
	{$editor} .wp-block-freeform.mce-content-body > table thead td {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_alternate']) . "
	}
	/* Finish Table Colors */

/***************** Finish Gutenberg Module Custom Colors Scheme Rules ******************/





/***************** Start Gutenberg Module General Colors Scheme Rules ******************/
	/* Start Main Content Font Color */
	body .editor-styles-wrapper,
	.editor-styles-wrapper select,
	{$editor} .wp-block-image figcaption,
	{$editor} .wp-block-audio figcaption,
	{$editor} .wp-block-video figcaption,
	{$editor} .wp-caption dd,
	{$editor} .wp-block-latest-posts .wp-block-latest-posts__post-date,
	{$editor} .wp-block-latest-comments .wp-block-latest-comments__comment-date {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	.editor-styles-wrapper a,
	.editor-styles-wrapper .wp-block-freeform.block-library-rich-text__tinymce a,
	.editor-styles-wrapper .wp-block-file .wp-block-file__textlink .editor-rich-text__tinymce {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_link']) . "
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	.editor-styles-wrapper a:hover,
	.editor-styles-wrapper a:active,
	.editor-styles-wrapper h1 a:hover,
	.editor-styles-wrapper h1 a:active,
	.editor-styles-wrapper h2 a:hover,
	.editor-styles-wrapper h2 a:active,
	.editor-styles-wrapper h3 a:hover,
	.editor-styles-wrapper h3 a:active,
	.editor-styles-wrapper h4 a:hover,
	.editor-styles-wrapper h4 a:active,
	.editor-styles-wrapper h5 a:hover,
	.editor-styles-wrapper h5 a:active,
	.editor-styles-wrapper h6 a:hover,
	.editor-styles-wrapper h6 a:active,
	.editor-styles-wrapper div.wp-block .wp-block-freeform.block-library-rich-text__tinymce a:hover,
	.editor-styles-wrapper div.wp-block .wp-block-freeform.block-library-rich-text__tinymce a:active {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_hover']) . "
	}
	
	.editor-styles-wrapper select:focus {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_default_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	.editor-post-title__block .editor-post-title__input,
	body .editor-styles-wrapper h1,
	body .editor-styles-wrapper h1 a,
	body .editor-styles-wrapper h2,
	body .editor-styles-wrapper h2 a,
	body .editor-styles-wrapper h3,
	body .editor-styles-wrapper h3 a,
	body .editor-styles-wrapper h4,
	body .editor-styles-wrapper h4 a,
	body .editor-styles-wrapper h5,
	body .editor-styles-wrapper h5 a,
	body .editor-styles-wrapper h6,
	body .editor-styles-wrapper h6 a,
	{$editor} .wp-block-pullquote {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_heading']) . "
	}
	
	{$editor} .wp-block-pullquote.is-style-solid-color {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_heading']) . "
	}
	
	{$editor} .wp-block-pullquote {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_default_heading']) . "
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$editor} .wp-block-pullquote.is-style-solid-color {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_bg']) . "
	}
	
	body .editor-styles-wrapper,
	.editor-styles-wrapper select {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_bg']) . "
	}
	/* Finish Main Background Color */
	
	
	/* Start Borders Color */
	{$editor} .wp-block-separator.is-style-dots:before {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_border']) . "
	}
	
	{$editor} .wp-block-separator:not(.is-style-dots):before {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_border']) . "
	}
	
	.editor-styles-wrapper select,
	.editor-styles-wrapper .wp-block-freeform hr {
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_default_border']) . "
	}
	/* Finish Borders Color */
	
	
	/* Start Buttons Colors */
	{$editor} .wp-block-button .wp-block-button__link:not(.has-text-color):not(.has-background),
	{$editor} .wp-block-file .wp-block-file__button,
	{$editor} .wp-block-file a.wp-block-file__button {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_bg']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_link']) . "
	}
	
	{$editor} .wp-block-button .wp-block-button__link:not(.has-text-color):not(.has-background):hover,
	{$editor} .wp-block-button .wp-block-button__link:not(.has-text-color):not(.has-background):focus,
	{$editor} .wp-block-button .wp-block-button__link:not(.has-text-color):not(.has-background):active,
	{$editor} .wp-block-file .wp-block-file__button:hover,
	{$editor} .wp-block-file .wp-block-file__button:focus,
	{$editor} .wp-block-file .wp-block-file__button:active,
	{$editor} .wp-block-file a.wp-block-file__button:hover,
	{$editor} .wp-block-file a.wp-block-file__button:focus,
	{$editor} .wp-block-file a.wp-block-file__button:active {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_bg']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_hover']) . "
	}
	
	{$editor} .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color):not(.has-background) {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_link']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_bg']) . "
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_default_link']) . "
	}
	
	{$editor} .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color):not(.has-background):hover,
	{$editor} .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color):not(.has-background):focus,
	{$editor} .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color):not(.has-background):active {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_default_bg']) . "
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_default_link']) . "
		" . cmsmasters_color_css('border-color', $cmsmasters_option['schule' . '_default_link']) . "
	}
	/* Finish Buttons Colors */
	

/***************** Finish Gutenberg Module General Colors Scheme Rules ******************/

";
	
	
	return $custom_css;
}

add_filter('schule_theme_colors_secondary_filter', 'schule_gutenberg_module_colors');

