/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.1
 * 
 * Post, Page, Project & Profile Options Toggles Scripts
 * Created by CMSMasters
 * 
 */


(function ($) { 
	"use strict";
	
	$(document).on('DOMContentLoaded', function () { 
		/* Post Format Fields Load */
		if ($('#post-formats-select input.post-format:checked, select[id^="post-format-selector"]').val() === 'image') {
			$('#cmsmasters_post_image').show();
		} else if ($('#post-formats-select input.post-format:checked, select[id^="post-format-selector"]').val() === 'gallery') {
			$('#cmsmasters_post_gallery').show();
			
			$('#cmsmasters_project_images').show();
			
			$('#cmsmasters_project_images .cmsmasters_tr_radio').show();
			
			$('#cmsmasters_project_images .cmsmasters_tr_checkbox').hide();
		} else if ($('#post-formats-select input.post-format:checked, select[id^="post-format-selector"]').val() === 'video') {
			$('#cmsmasters_post_video').show();
			
			$('#cmsmasters_project_video').show();
			
			
			if ($('input[name="cmsmasters_post_video_type"]:checked').val() === 'embedded') {
				$('#cmsmasters_post_video_link').closest('tr').show();
			} else {
				$('#cmsmasters_post_video_links-repeatable').closest('tr').show();
			}
			
			if ($('input[name="cmsmasters_project_video_type"]:checked').val() === 'embedded') {
				$('#cmsmasters_project_video_link').closest('tr').show();
			} else {
				$('#cmsmasters_project_video_links-repeatable').closest('tr').show();
			}
		} else if ($('#post-formats-select input.post-format:checked, select[id^="post-format-selector"]').val() === 'audio') {
			$('#cmsmasters_post_audio').show();
		} else {
			$('#cmsmasters_post_standard').show();
			
			$('#cmsmasters_project_images').show();
		}
		
		/* Post Format Change */
		$('#post-formats-select input.post-format, select[id^="post-format-selector"]').on('change', function () { 
			if ($(this).val() === 'image') {
				$('#cmsmasters_post_gallery, #cmsmasters_post_video, #cmsmasters_post_audio, #cmsmasters_project_images, #cmsmasters_project_video, #cmsmasters_post_standard').hide();
				
				$('#cmsmasters_post_image').show();
			} else if ($(this).val() === 'gallery') {
				$('#cmsmasters_post_image, #cmsmasters_post_video, #cmsmasters_post_audio, #cmsmasters_project_video, #cmsmasters_post_standard').hide();
				
				$('#cmsmasters_post_gallery').show();
				
				$('#cmsmasters_project_images').show();
			
				$('#cmsmasters_project_images .cmsmasters_tr_radio').show();
			
				$('#cmsmasters_project_images .cmsmasters_tr_checkbox').hide();
			} else if ($(this).val() === 'video') {
				$('#cmsmasters_post_image, #cmsmasters_post_gallery, #cmsmasters_post_audio, #cmsmasters_project_images, #cmsmasters_post_standard').hide();
				
				$('#cmsmasters_post_video').show();
				
				$('#cmsmasters_project_video').show();
				
				
				if ($('input[name="cmsmasters_post_video_type"]:checked').val() === 'embedded') {
					$('#cmsmasters_post_video_link').closest('tr').show();
				} else {
					$('#cmsmasters_post_video_links-repeatable').closest('tr').show();
				}
				
				if ($('input[name="cmsmasters_project_video_type"]:checked').val() === 'embedded') {
					$('#cmsmasters_project_video_link').closest('tr').show();
				} else {
					$('#cmsmasters_project_video_links-repeatable').closest('tr').show();
				}
			} else if ($(this).val() === 'audio') {
				$('#cmsmasters_post_image, #cmsmasters_post_gallery, #cmsmasters_post_video, #cmsmasters_project_images, #cmsmasters_project_video, #cmsmasters_post_standard').hide();
				
				$('#cmsmasters_post_audio').show();
			} else {
				$('#cmsmasters_post_image, #cmsmasters_post_gallery, #cmsmasters_post_video, #cmsmasters_post_audio, #cmsmasters_project_video').hide();
				
				$('#cmsmasters_post_standard').show();
				
				$('#cmsmasters_project_images').show();
			
				$('#cmsmasters_project_images .cmsmasters_tr_radio').hide();
			
				$('#cmsmasters_project_images .cmsmasters_tr_checkbox').show();
			}
		} );
		
		/* Post Video Type Change */
		$('input[name="cmsmasters_post_video_type"]').on('change', function () { 
			if ($('input[name="cmsmasters_post_video_type"]:checked').val() === 'embedded') {
				$('#cmsmasters_post_video_links-repeatable').closest('tr').hide();
				
				$('#cmsmasters_post_video_link').closest('tr').show();
			} else {
				$('#cmsmasters_post_video_link').closest('tr').hide();
				
				$('#cmsmasters_post_video_links-repeatable').closest('tr').show();
			}
		} );
		
		/* Project Video Type Change */
		$('input[name="cmsmasters_project_video_type"]').on('change', function () { 
			if ($('input[name="cmsmasters_project_video_type"]:checked').val() === 'embedded') {
				$('#cmsmasters_project_video_links-repeatable').closest('tr').hide();
				
				$('#cmsmasters_project_video_link').closest('tr').show();
			} else {
				$('#cmsmasters_project_video_link').closest('tr').hide();
				
				$('#cmsmasters_project_video_links-repeatable').closest('tr').show();
			}
		} );
		
		
		
		/* Layout Sidebar Field Load */
		if ($('input[name="cmsmasters_layout"]:checked').val() !== 'fullwidth') {
			$('#cmsmasters_sidebar_id').closest('tr').show();
			$('#cmsmasters_heading_block_disabled').closest('tr').hide();
		}
		
		/* Page Layout Change */
		$('input[name="cmsmasters_layout"]').on('change', function () { 
			if ($(this).val() === 'fullwidth') {
				$('#cmsmasters_sidebar_id').closest('tr').hide();
				$('#cmsmasters_heading_block_disabled').closest('tr').show();
				
				if ($('#page_template').val() === 'portfolio.php') {
					$('#cmsmasters_page_full_columns').closest('tr').show();
				}
			} else {
				$('#cmsmasters_sidebar_id').closest('tr').show();
				$('#cmsmasters_heading_block_disabled').closest('tr').hide();
				
				if ($('#page_template').val() === 'portfolio.php') {
					$('#cmsmasters_page_full_columns').closest('tr').hide();
				}
			}
		} );
		
		
		
		/* Heading Block Disabled Field Load */
		if (
			$('#cmsmasters_header_overlaps').is(':checked') && 
			$('input[name="cmsmasters_layout"]:checked').val() === 'fullwidth'
		) {
			$('#cmsmasters_heading_block_disabled').closest('tr').show();
		}
		
		/* Heading Block Disabled Field Change */
		$('#cmsmasters_header_overlaps').on('change', function () { 
			if (
				$(this).is(':checked') && 
				$('input[name="cmsmasters_layout"]:checked').val() === 'fullwidth'
			) {
				$('#cmsmasters_heading_block_disabled').closest('tr').show();
			} else {
				$('#cmsmasters_heading_block_disabled').closest('tr').hide();
			}
		} );
		
		$('input[name="cmsmasters_layout"]').on('change', function () { 
			if (
				$(this).val() === 'fullwidth' && 
				$('#cmsmasters_header_overlaps').is(':checked')
			) {
				$('#cmsmasters_heading_block_disabled').closest('tr').show();
			} else {
				$('#cmsmasters_heading_block_disabled').closest('tr').hide();
			}
		} );
		
		
		
		/* Heading Block Title Load */
		if (
			$('#cmsmasters_heading_block_disabled').is(':checked') && 
			$('#cmsmasters_header_overlaps').is(':checked') && 
			$('input[name="cmsmasters_layout"]:checked').val() === 'fullwidth'
		) {
			$('#cmsmasters_page_tabs > a[href="#cmsmasters_heading"]').hide();
		} else {
			$('#cmsmasters_page_tabs > a[href="#cmsmasters_heading"]').show();
		}
		
		/* Heading Block Title Change */
		$('#cmsmasters_heading_block_disabled').on('change', function () {
			if (
				$(this).is(':checked') && 
				$('#cmsmasters_header_overlaps').is(':checked') && 
				$('input[name="cmsmasters_layout"]:checked').val() === 'fullwidth'
			) {
				$('#cmsmasters_page_tabs > a[href="#cmsmasters_heading"]').hide();
			} else {
				$('#cmsmasters_page_tabs > a[href="#cmsmasters_heading"]').show();
			}
		} );
		
		$('#cmsmasters_header_overlaps').on('change', function () { 
			if (
				$('#cmsmasters_heading_block_disabled').is(':checked') && 
				$(this).is(':checked') && 
				$('input[name="cmsmasters_layout"]:checked').val() === 'fullwidth'
			) {
				$('#cmsmasters_page_tabs > a[href="#cmsmasters_heading"]').hide();
			} else {
				$('#cmsmasters_page_tabs > a[href="#cmsmasters_heading"]').show();
			}
		} );
		
		$('input[name="cmsmasters_layout"]').on('change', function () { 
			if (
				$('#cmsmasters_heading_block_disabled').is(':checked') && 
				$('#cmsmasters_header_overlaps').is(':checked') && 
				$(this).val() === 'fullwidth'
			) {
				$('#cmsmasters_page_tabs > a[href="#cmsmasters_heading"]').hide();
			} else {
				$('#cmsmasters_page_tabs > a[href="#cmsmasters_heading"]').show();
			}
		} );
		
		
		
		/* Bottom Sidebar Field Load */
		if ($('#cmsmasters_bottom_sidebar').is(':checked')) {
			$('#cmsmasters_bottom_sidebar_id').closest('tr').show();
			$('#cmsmasters_bottom_sidebar_layout').closest('tr').show();
		}
		
		/* Bottom Sidebar Visibility Change */
		$('#cmsmasters_bottom_sidebar').on('change', function () { 
			if ($(this).is(':checked')) {
				$('#cmsmasters_bottom_sidebar_id').closest('tr').show();
				$('#cmsmasters_bottom_sidebar_layout').closest('tr').show();
			} else {
				$('#cmsmasters_bottom_sidebar_id').closest('tr').hide();
				$('#cmsmasters_bottom_sidebar_layout').closest('tr').hide();
			}
		} );
		
		
		
		/* Background Fields Load */
		if ($('#cmsmasters_bg_default').is(':not(:checked)')) {
			$('#cmsmasters_bg_col').closest('tr').show();
			$('#cmsmasters_bg_img_enable').closest('tr').show();
			
			if ($('#cmsmasters_bg_img_enable').is(':checked')) {
				$('#cmsmasters_bg_img').closest('tr').show();
				$('#cmsmasters_bg_rep_no-repeat').closest('tr').show();
				$('#cmsmasters_bg_pos').closest('tr').show();
				$('#cmsmasters_bg_att_scroll').closest('tr').show();
				$('#cmsmasters_bg_size_auto').closest('tr').show();
			}
		}
		
		/* Default Background Checkbox Change */
		$('#cmsmasters_bg_default').on('change', function () { 
			if ($(this).is(':checked')) {
				$('#cmsmasters_bg_col').closest('tr').hide();
				$('#cmsmasters_bg_img_enable').closest('tr').hide();
				$('#cmsmasters_bg_img').closest('tr').hide();
				$('#cmsmasters_bg_rep_no-repeat').closest('tr').hide();
				$('#cmsmasters_bg_pos').closest('tr').hide();
				$('#cmsmasters_bg_att_scroll').closest('tr').hide();
				$('#cmsmasters_bg_size_auto').closest('tr').hide();
			} else {
				$('#cmsmasters_bg_col').closest('tr').show();
				$('#cmsmasters_bg_img_enable').closest('tr').show();
				
				if ($('#cmsmasters_bg_img_enable').is(':checked')) {
					$('#cmsmasters_bg_img').closest('tr').show();
					$('#cmsmasters_bg_rep_no-repeat').closest('tr').show();
					$('#cmsmasters_bg_pos').closest('tr').show();
					$('#cmsmasters_bg_att_scroll').closest('tr').show();
					$('#cmsmasters_bg_size_auto').closest('tr').show();
				}
			}
		} );
		
		/* Background Visibility Change */
		$('#cmsmasters_bg_img_enable').on('change', function () { 
			if ($(this).is(':checked')) {
				$('#cmsmasters_bg_img').closest('tr').show();
				$('#cmsmasters_bg_rep_no-repeat').closest('tr').show();
				$('#cmsmasters_bg_pos').closest('tr').show();
				$('#cmsmasters_bg_att_scroll').closest('tr').show();
				$('#cmsmasters_bg_size_auto').closest('tr').show();
			} else {
				$('#cmsmasters_bg_img').closest('tr').hide();
				$('#cmsmasters_bg_rep_no-repeat').closest('tr').hide();
				$('#cmsmasters_bg_pos').closest('tr').hide();
				$('#cmsmasters_bg_att_scroll').closest('tr').hide();
				$('#cmsmasters_bg_size_auto').closest('tr').hide();
			}
		} );
		
		
		
		/* Heading Fields Load */
		if ($('input[name="cmsmasters_heading"]:checked').val() === 'custom') {
			$('#cmsmasters_heading_title').closest('tr').show();
			$('#cmsmasters_heading_subtitle').closest('tr').show();
			$('#cmsmasters_heading_icon').closest('tr').show();
			$('input[name="cmsmasters_heading_alignment"]').closest('tr').show();
			$('#cmsmasters_heading_height').closest('tr').show();
			$('#cmsmasters_breadcrumbs').closest('tr').show();
		} else if ($('input[name="cmsmasters_heading"]:checked').val() === 'default') {
			$('input[name="cmsmasters_heading_alignment"]').closest('tr').show();
			$('#cmsmasters_heading_height').closest('tr').show();
			$('#cmsmasters_breadcrumbs').closest('tr').show();
		}
		
		/* Heading Type Change */
		$('input[name="cmsmasters_heading"]').on('change', function () { 
			if ($(this).val() === 'default') {
				$('#cmsmasters_heading_title').closest('tr').hide();
				$('#cmsmasters_heading_subtitle').closest('tr').hide();
				$('#cmsmasters_heading_icon').closest('tr').hide();
				$('input[name="cmsmasters_heading_alignment"]').closest('tr').show();
				$('#cmsmasters_heading_height').closest('tr').show();
				$('#cmsmasters_breadcrumbs').closest('tr').show();
			} else if ($(this).val() === 'custom') {
				$('#cmsmasters_heading_title').closest('tr').show();
				$('#cmsmasters_heading_subtitle').closest('tr').show();
				$('#cmsmasters_heading_icon').closest('tr').show();
				$('input[name="cmsmasters_heading_alignment"]').closest('tr').show();
				$('#cmsmasters_heading_height').closest('tr').show();
				$('#cmsmasters_breadcrumbs').closest('tr').show();
			} else {
				$('#cmsmasters_heading_title').closest('tr').hide();
				$('#cmsmasters_heading_subtitle').closest('tr').hide();
				$('#cmsmasters_heading_icon').closest('tr').hide();
				$('input[name="cmsmasters_heading_alignment"]').closest('tr').hide();
				$('#cmsmasters_heading_height').closest('tr').hide();
				$('#cmsmasters_breadcrumbs').closest('tr').hide();
			}
		} );
		
		/* Heading Background Visibility Load */
		if ($('#cmsmasters_heading_bg_img_enable').is(':checked')) {
			$('#cmsmasters_heading_bg_img').closest('tr').show();
			$('input[name="cmsmasters_heading_bg_rep"]').closest('tr').show();
			$('input[name="cmsmasters_heading_bg_att"]').closest('tr').show();
			$('input[name="cmsmasters_heading_bg_size"]').closest('tr').show();
		}
		
		/* Heading Background Visibility Change */
		$('#cmsmasters_heading_bg_img_enable').on('change', function () { 
			if ($(this).is(':checked')) {
				$('#cmsmasters_heading_bg_img').closest('tr').show();
				$('input[name="cmsmasters_heading_bg_rep"]').closest('tr').show();
				$('input[name="cmsmasters_heading_bg_att"]').closest('tr').show();
				$('input[name="cmsmasters_heading_bg_size"]').closest('tr').show();
			} else {
				$('#cmsmasters_heading_bg_img').closest('tr').hide();
				$('input[name="cmsmasters_heading_bg_rep"]').closest('tr').hide();
				$('input[name="cmsmasters_heading_bg_att"]').closest('tr').hide();
				$('input[name="cmsmasters_heading_bg_size"]').closest('tr').hide();
			}
		} );
	} );
} )(jQuery);

