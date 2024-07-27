<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.1.9
 * 
 * Template Functions
 * Created by CMSMasters
 * 
 */


/* Post Type Video */
function schule_post_type_video($cmsmasters_id, $video_type = '', $video_link = '', $video_links = '', $size = 'post-thumbnail') {
	if (!post_password_required()) {
		if ($video_type == 'selfhosted' && !empty($video_links) && sizeof($video_links) > 0) {
			$video_size = cmsmasters_image_thumbnail_list();
			
			
			$attrs = array( 
				'preload'  => 'none', 
				'height'   => $video_size[$size]['height'], 
				'width'    => $video_size[$size]['width'] 
			);
			
			
			if (has_post_thumbnail()) {
				$video_poster = wp_get_attachment_image_src((int) get_post_thumbnail_id($cmsmasters_id), $size);
				
				
				$attrs['poster'] = $video_poster[0];
			}
			
			
			foreach ($video_links as $video_link_url) {
				$attrs[substr(strrchr($video_link_url, '.'), 1)] = $video_link_url;
			}
			
			
			echo '<div class="cmsmasters_video_wrap">' . 
				wp_video_shortcode($attrs) . 
			'</div>';
		} elseif ($video_type == 'embedded' && $video_link != '') {
			global $wp_embed;
			
			
			$video_size = cmsmasters_image_thumbnail_list();
			
			
			echo '<div class="cmsmasters_video_wrap">' . 
				do_shortcode($wp_embed->run_shortcode('[embed width="' . $video_size[$size]['width'] . '" height="' . $video_size[$size]['height'] . '"]' . $video_link . '[/embed]')) . 
			'</div>';
		} elseif (has_post_thumbnail()) {
			schule_thumb($cmsmasters_id, $size, true, false, true, false, true, true, false);
		}
	}
}



/* Post Type Slider */
function schule_post_type_slider($cmsmasters_id, $images, $size = 'post-thumbnail', $slider_data = '') {
	if (!post_password_required()) {
		if (sizeof($images) > 1) {
			echo '<div' . 
				' id="cmsmasters_owl_slider_' . esc_attr(uniqid()) . '"' . 
				' class="cmsmasters_owl_slider"' . 
				$slider_data . 
			'>';
				
				
				foreach ($images as $image) {
					$image_atts = cmsmasters_check_img_agrs(strstr($image, '|', true));
					
					
					echo '<div class="cmsmasters_owl_slider_item">' . 
						'<figure>' . 
							wp_get_attachment_image(strstr($image, '|', true), $size, false, array( 
								'class' => 	'full-width', 
								'alt' => ($image_atts['alt'] != '') ? esc_attr($image_atts['alt']) : cmsmasters_title($cmsmasters_id, false), 
								'title' => ($image_atts['title'] != '') ? esc_attr($image_atts['title']) : cmsmasters_title($cmsmasters_id, false) 
							)) . 
						'</figure>' . 
					'</div>';
				}
				
				
			echo "</div>";
		} elseif (sizeof($images) == 1 && $images[0] != '') {
			schule_thumb($cmsmasters_id, $size, false, 'img_' . $cmsmasters_id, true, true, true, true, $images[0]);
		} elseif (has_post_thumbnail()) {
			schule_thumb($cmsmasters_id, $size, false, 'img_' . $cmsmasters_id, true, true, true, true, false);
		}
	}
}



/* Post Type Gallery */
function schule_post_type_gallery($cmsmasters_id, $images, $columns, $size_col = 'post-thumbnail', $size_full = 'post-thumbnail') {
	if (!post_password_required()) {
		if ($columns == 'three' || $columns == 'two') {
			$thumb_size = $size_col;
		} else {
			$thumb_size = $size_full;
		}


		$img_columns = 'one_third';

		if ($columns == 'two') {
			$img_columns = 'one_half';
		} elseif ($columns == 'one') {
			$img_columns = 'one_first';
		}

		$colnumb = 0;
		
		
		if (sizeof($images) > 0 && $images[0] != '') {
			echo '<div class="cmsmasters_gallery_row">';
			
			
			foreach ($images as $image) {				
				if ($columns == 'one' && $colnumb == 1) { 
					echo '</div><div class="cmsmasters_gallery_row">';
					
					$colnumb = 0;
				} else if ($columns == 'two' && $colnumb == 2) {
					echo '</div><div class="cmsmasters_gallery_row">';
					
					$colnumb = 0;
				} else if ($columns == 'three' && $colnumb == 3) {
					echo '</div><div class="cmsmasters_gallery_row">';
					
					$colnumb = 0;
				}
				
				
				echo '<div class="' . $img_columns . '">';
					
					$link_href = wp_get_attachment_image_src(strstr($image, '|', true), 'full');
					
					$image_atts = cmsmasters_check_img_agrs(strstr($image, '|', true));
					
					echo '<figure class="cmsmasters_img_rollover_wrap preloader">' . 
						wp_get_attachment_image(strstr($image, '|', true), $thumb_size, false, array( 
							'class' => 'full-width', 
							'alt' => ($image_atts['alt'] != '') ? esc_attr($image_atts['alt']) : cmsmasters_title($cmsmasters_id, false), 
							'title' => ($image_atts['title'] != '') ? esc_attr($image_atts['title']) : cmsmasters_title($cmsmasters_id, false) 
						)) . 
						'<div class="cmsmasters_img_rollover">' . 
							'<a href="' . esc_url($link_href[0]) . '" rel="ilightbox[img_' . $cmsmasters_id . ']" title="' . (($image_atts['title'] != '') ? esc_attr($image_atts['title']) : cmsmasters_title($cmsmasters_id, false)) . '" class="cmsmasters_image_link"></a>' . 
						'</div>' . 
					'</figure>';
					
				echo '</div>';
				
				
				$colnumb++;
			}
			
			
			echo '</div>';
		} elseif (has_post_thumbnail()) {
			schule_thumb($cmsmasters_id, $size_full, false, 'img_' . $cmsmasters_id, true, true, false, true, false);
		}
	}
}



/* Post Type Image */
function schule_post_type_image($cmsmasters_id, $image_link = '', $size = 'cmsmasters-masonry-thumb') {
	if (!post_password_required()) {
		if ($image_link != '') {
			schule_thumb($cmsmasters_id, $size, false, 'img_' . $cmsmasters_id, false, false, false, true, $image_link);
		} elseif (has_post_thumbnail()) {
			schule_thumb($cmsmasters_id, $size, false, 'img_' . $cmsmasters_id, false, false, false, true, false);
		}
	}
}



/* Post Type Audio */
function schule_post_type_audio($audio_links) {
	if (!post_password_required() && !empty($audio_links) && sizeof($audio_links) > 0) {
		$attrs = array(
			'preload' => 'none'
		);
		
		
		foreach ($audio_links as $audio_link_url) {
			$attrs[substr(strrchr($audio_link_url, '.'), 1)] = $audio_link_url;
		}
		
		
		echo '<div class="cmsmasters_audio">' . 
			wp_audio_shortcode($attrs) . 
		'</div>';
	}
}



/* Get Header Search Form Function */
function schule_get_header_search_form($cmsmasters_option) {
	if (
		$cmsmasters_option['schule' . '_header_search'] && 
		$cmsmasters_option['schule' . '_header_styles'] != 'c_nav'
	) {
		$out_form = "<form method=\"get\" action=\"" . esc_url(home_url('/')) . "\">
			<div class=\"cmsmasters_header_search_form_field\">
				<input type=\"search\" name=\"s\" placeholder=\"" . esc_attr__('Enter Keywords', 'schule') . "\" value=\"\" />
				<button type=\"submit\">Search</button>
			</div>
		</form>";
		
		
		$out_form = apply_filters('schule_get_header_search_form_filter', $out_form);
		
		
		echo "<div class=\"cmsmasters_header_search_form\">
			<span class=\"cmsmasters_header_search_form_close cmsmasters_theme_icon_cancel\"></span>" . 
			$out_form . 
		"</div>";
	}
}



/* Theme Error Styles */
function schule_theme_error_styles() {
	$out = "";
	
	
	if (is_404()) {
		$cmsmasters_option = schule_get_global_options();
		
		
		if (
			$cmsmasters_option['schule' . '_error_bg_img_enable'] && 
			$cmsmasters_option['schule' . '_error_bg_image'] != ''
		) {
			$error_bg_image = explode('|', $cmsmasters_option['schule' . '_error_bg_image']);
			
			
			if (is_numeric($error_bg_image[0])) {
				$error_bg_image_url = wp_get_attachment_image_src((int) $error_bg_image[0], 'full');
			}
			
			
			$out .= "
	.error .error_bg {
		background-image : " . (!empty($cmsmasters_option['schule' . '_error_bg_image']) ? 'url(' . ((is_numeric($error_bg_image[0])) ? $error_bg_image_url[0] : $error_bg_image[1]) . ')' : 'none') . ";
		background-position : " . (!empty($cmsmasters_option['schule' . '_error_bg_pos']) ? $cmsmasters_option['schule' . '_error_bg_pos'] : 'top center') . ";
		background-repeat : " . (!empty($cmsmasters_option['schule' . '_error_bg_rep']) ? $cmsmasters_option['schule' . '_error_bg_rep'] : 'repeat') . ";
		background-attachment : " . (!empty($cmsmasters_option['schule' . '_error_bg_att']) ? $cmsmasters_option['schule' . '_error_bg_att'] : 'scroll') . ";
		background-size : " . (!empty($cmsmasters_option['schule' . '_error_bg_size']) ? $cmsmasters_option['schule' . '_error_bg_size'] : 'auto') . ";
	}
";
		}
		
		
		$out .= "
	.error .error_bg {
		" . cmsmasters_color_css('background-color', $cmsmasters_option['schule' . '_error_bg_color']) . "
	}
	
	.error .error_title, 
	.error .error_subtitle {
		" . cmsmasters_color_css('color', $cmsmasters_option['schule' . '_error_color']) . "
	}
";
	}
	
	
	wp_add_inline_style('schule-style', $out);
}

add_action('wp_enqueue_scripts', 'schule_theme_error_styles');



/* Get Page Heading Function */
function schule_page_heading() {
	if (is_404() || is_home()) {
		echo "<div class=\"headline\">
			<div class=\"headline_outer cmsmasters_headline_disabled\"></div>
		</div>";
	} else {
		$cmsmasters_option = schule_get_global_options();
		
		
		if (is_singular()) {
			$cmsmasters_page_id = get_the_ID();
		} elseif (CMSMASTERS_WOOCOMMERCE && is_shop()) {
			$cmsmasters_page_id = wc_get_page_id('shop');
		} elseif (CMSMASTERS_LEARNPRESS) {
			$cmsmasters_page_id = get_queried_object_id();
		}
		
		
		$cmsmasters_heading = '';
		
		if (
			is_singular() || 
			(CMSMASTERS_WOOCOMMERCE && is_shop()) ||
			CMSMASTERS_LEARNPRESS
		) {
			$cmsmasters_heading = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading', true);
		}
		
		
		if (
			$cmsmasters_heading != '' && 
			(
				is_singular() || 
				(CMSMASTERS_WOOCOMMERCE && is_shop()) ||
				CMSMASTERS_LEARNPRESS
			)
		) {
			$cmsmasters_heading_block_disabled = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_block_disabled', true);
			$cmsmasters_header_overlaps = get_post_meta($cmsmasters_page_id, 'cmsmasters_header_overlaps', true);
			
			$cmsmasters_heading_alignment = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_alignment', true);
			$cmsmasters_heading_scheme = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_scheme', true);
			
			$cmsmasters_heading_title = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_title', true);
			$cmsmasters_heading_subtitle = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_subtitle', true);
			$cmsmasters_heading_icon = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_icon', true);
			
			$cmsmasters_breadcrumbs = get_post_meta($cmsmasters_page_id, 'cmsmasters_breadcrumbs', true);
		} else {
			$cmsmasters_heading = 'default';
			$cmsmasters_heading_block_disabled = 'false';
			$cmsmasters_header_overlaps = $cmsmasters_option['schule' . '_header_overlaps'] ? 'true' : 'false';
			
			$cmsmasters_heading_alignment = $cmsmasters_option['schule' . '_heading_alignment'];
			$cmsmasters_heading_scheme = $cmsmasters_option['schule' . '_heading_scheme'];
			
			$cmsmasters_breadcrumbs = $cmsmasters_option['schule' . '_breadcrumbs'] ? 'true' : 'false';
		}
		
		
		if (
			CMSMASTERS_TRIBE_EVENTS &&
			tribe_is_event_query() &&
			(
				true === tribe_events_views_v2_is_enabled() ||
				( false === tribe_events_views_v2_is_enabled() && is_archive() )
			)
		) {
			$cmsmasters_heading = 'disabled';
		}
		
		
		$cmsmasters_heading = apply_filters( 'cmsmasters_headline_type', $cmsmasters_heading );
		
		
		list($cmsmasters_layout) = schule_theme_page_layout_scheme();
		
		
		if (
			$cmsmasters_heading_block_disabled == 'true' && 
			$cmsmasters_layout == 'fullwidth' && 
			$cmsmasters_header_overlaps == 'true' 
		) {
			echo "";
		} else {
			echo "<div class=\"headline cmsmasters_color_scheme_{$cmsmasters_heading_scheme}\">
				<div class=\"headline_outer" . ($cmsmasters_heading == 'disabled' ? ' cmsmasters_headline_disabled' : '') . "\">
					<div class=\"headline_color\"></div>";
			
			
			if ($cmsmasters_heading != 'disabled') {
				echo "<div class=\"headline_inner align_{$cmsmasters_heading_alignment}\">
					<div class=\"headline_aligner\"></div>" . 
					'<div class="headline_text_wrap">' . 
					'<div class="headline_text' . (($cmsmasters_heading == 'custom') ? (($cmsmasters_heading_icon != '') ? ' headline_icon ' . $cmsmasters_heading_icon : '') . (($cmsmasters_heading_subtitle != '') ? ' headline_subtitle' : '') : '') . '">';
				
				
				if ($cmsmasters_heading == 'custom') {
					if ($cmsmasters_heading_title != '') {
						echo '<h1 class="entry-title">' . esc_html($cmsmasters_heading_title) . '</h1>';
					}
					
					if ($cmsmasters_heading_subtitle != '') {
						echo '<h5 class="entry-subtitle">' . esc_html($cmsmasters_heading_subtitle) . '</h5>';
					}
				} elseif (CMSMASTERS_LEARNPRESS && learn_press_is_courses()) {
					$page_id = get_queried_object_id();
					
					$title = get_the_title($page_id);
					
					if (is_tax()) {
						$title = get_the_archive_title();
					}
					
					echo '<h1 class="entry-title">' . wp_kses_post($title) . '</h1>';
				} elseif (CMSMASTERS_WOOCOMMERCE && is_woocommerce() && !is_singular()) {
					echo '<h1 class="entry-title">';
					
						esc_html(woocommerce_page_title());
						
					echo '</h1>';
				} elseif (is_archive() || is_search()) {
					echo '<h1 class="entry-title">';
					
					
					if (is_search()) {
						global $wp_query;
						
						
						if (!empty($wp_query->found_posts)) {
							echo sprintf(esc_html(_n('%1$d search result for: %2$s', '%1$d search results for: %2$s', $wp_query->found_posts, 'schule')), $wp_query->found_posts, get_search_query());
						} else {
							echo sprintf(esc_html__('0 search results for: %s', 'schule'), get_search_query());
						}
					} elseif (is_archive()) {
						if (is_author()) {
							if (get_the_author_meta('first_name') != '' || get_the_author_meta('last_name') != '') {
								echo sprintf(esc_html__('Author: %1$s (%2$s %3$s)', 'schule'), '<span class="vcard">' . get_the_author() . '</span>', get_the_author_meta('first_name'), get_the_author_meta('last_name'));
							} else {
								echo sprintf(esc_html__('Author: %s', 'schule'), '<span class="vcard">' . get_the_author() . '</span>');
							}
						} else {
							echo get_the_archive_title();
						}
					}
					
					
					echo '</h1>';
				} elseif ($cmsmasters_heading == 'default') {
					echo the_title('<h1 class="entry-title">', '</h1>', false);
				}
				
				
				echo '</div>';
				
				
				if ( 
					!is_front_page() && 
					$cmsmasters_breadcrumbs == 'true' && 
					!(
						CMSMASTERS_TRIBE_EVENTS && 
						(
							tribe_is_list_view() || 
							tribe_is_month() || 
							tribe_is_day() || 
							(function_exists('tribe_is_past') && tribe_is_past()) || 
							(function_exists('tribe_is_upcoming') && tribe_is_upcoming()) || 
							(function_exists('tribe_is_week') && tribe_is_week()) || 
							(function_exists('tribe_is_map') && tribe_is_map()) || 
							(function_exists('tribe_is_photo') && tribe_is_photo()) 
						)
					)
				) {
					echo '<div class="cmsmasters_breadcrumbs">' . 
						'<div class="cmsmasters_breadcrumbs_aligner"></div>' . 
						'<div class="cmsmasters_breadcrumbs_inner">';
					
					
					if (CMSMASTERS_WOOCOMMERCE && is_woocommerce()) {
						woocommerce_breadcrumb();
					} elseif (function_exists('yoast_breadcrumb')) {
						$yoast_enable = get_option('wpseo_titles');
						
						
						if ($yoast_enable['breadcrumbs-enable']) {
							yoast_breadcrumb();
						} else {
							schule_breadcrumbs();
						}
					} elseif (CMSMASTERS_LEARNPRESS && learn_press_is_courses()) {
						learn_press_breadcrumb();
					} else {
						schule_breadcrumbs();
					}
					
					
					echo '</div>' . 
					'</div>';
				}
				
				
				echo '</div>' . 
				'</div>';
			}
			
			
				echo "</div>
			</div>";
		}
	}
}



/* Theme Heading Styles */
function schule_theme_heading_styles() {
	$cmsmasters_option = schule_get_global_options();
	
	
	if (is_singular()) {
		$cmsmasters_page_id = get_the_ID();
	} elseif (CMSMASTERS_WOOCOMMERCE && is_shop()) {
		$cmsmasters_page_id = wc_get_page_id('shop');
	} elseif (CMSMASTERS_LEARNPRESS) {
		$cmsmasters_page_id = get_queried_object_id();
	}
	
	
	$cmsmasters_heading = '';
	
	$out = '';
	
	if (
		is_singular() || 
		(CMSMASTERS_WOOCOMMERCE && is_shop()) ||
		CMSMASTERS_LEARNPRESS
	) {
		$cmsmasters_heading = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading', true);
	}
	
	
	if (
		$cmsmasters_heading != '' && 
		(
			( is_singular() && ! CMSMASTERS_TRIBE_EVENTS ) ||
			( is_singular() && CMSMASTERS_TRIBE_EVENTS && ! tribe_is_event_query() ) ||
			(CMSMASTERS_WOOCOMMERCE && is_shop()) ||
			CMSMASTERS_LEARNPRESS
		)
	) {
		$cmsmasters_heading_block_disabled = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_block_disabled', true);
		$cmsmasters_header_overlaps = get_post_meta($cmsmasters_page_id, 'cmsmasters_header_overlaps', true);
		
		$cmsmasters_heading_height = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_height', true);
		$cmsmasters_heading_bg_color = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_bg_color', true);
		$cmsmasters_heading_bg_img_enable = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_bg_img_enable', true);
		$cmsmasters_heading_bg_img = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_bg_img', true);
		$cmsmasters_heading_bg_rep = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_bg_rep', true);
		$cmsmasters_heading_bg_att = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_bg_att', true);
		$cmsmasters_heading_bg_size = get_post_meta($cmsmasters_page_id, 'cmsmasters_heading_bg_size', true);
	} else {
		$cmsmasters_heading_block_disabled = 'false';
		$cmsmasters_header_overlaps = $cmsmasters_option['schule' . '_header_overlaps'] ? 'true' : 'false';
		
		$cmsmasters_heading_height = $cmsmasters_option['schule' . '_heading_height'];
		$cmsmasters_heading_bg_color = $cmsmasters_option['schule' . '_heading_bg_color'];
		$cmsmasters_heading_bg_img_enable = $cmsmasters_option['schule' . '_heading_bg_image_enable'] ? 'true' : 'false';
		$cmsmasters_heading_bg_img = $cmsmasters_option['schule' . '_heading_bg_image'];
		$cmsmasters_heading_bg_rep = $cmsmasters_option['schule' . '_heading_bg_repeat'];
		$cmsmasters_heading_bg_att = $cmsmasters_option['schule' . '_heading_bg_attachment'];
		$cmsmasters_heading_bg_size = $cmsmasters_option['schule' . '_heading_bg_size'];
	}
	
	
	list($cmsmasters_layout) = schule_theme_page_layout_scheme();
	
	
	if (
		$cmsmasters_heading_block_disabled == 'true' && 
		$cmsmasters_layout == 'fullwidth' && 
		$cmsmasters_header_overlaps == 'true' 
	) {
		$out .= "";
	} else {
		$options_img = explode('|', $cmsmasters_heading_bg_img);
		
		
		if (is_numeric($options_img[0])) {
			$options_img_url = wp_get_attachment_image_src((int) $options_img[0], 'full');
		}
		
		
		if ($cmsmasters_heading_bg_img_enable == 'true' && $cmsmasters_heading_bg_img != '') {
			$out .= "
			.headline_outer {
				background-image:url(" . ((is_numeric($options_img[0])) ? $options_img_url[0] : $options_img[1]) . ");
				background-repeat:{$cmsmasters_heading_bg_rep};
				background-attachment:{$cmsmasters_heading_bg_att};
				background-size:{$cmsmasters_heading_bg_size};
			}
			";
		}
		
		
		if ($cmsmasters_heading_bg_color != '') {
			$out .= "
			.headline_color {
				background-color:{$cmsmasters_heading_bg_color};
			}
			";
		}
		
		
		$out .= "
		.headline_aligner {
			min-height:{$cmsmasters_heading_height}px;
		}
		";
	}
	
	
	wp_add_inline_style('schule-style', $out);
}

add_action('wp_enqueue_scripts', 'schule_theme_heading_styles');



/* Get Social Icons Styles Function */
function schule_theme_social_icons_styles() {
	if (class_exists('Cmsmasters_Content_Composer')) {
		$cmsmasters_option = schule_get_global_options();
		
		$out = '';
		
		$i = 1;
		
		
		foreach ($cmsmasters_option['schule' . '_social_icons'] as $cmsmasters_social_icons) {
			$cmsmasters_social_icon = explode('|', str_replace(' ', '', $cmsmasters_social_icons));
			
			
			if (isset($cmsmasters_social_icon[4]) && $cmsmasters_social_icon[4] != '') {
				$out .= "
		
		#page .cmsmasters_social_icon_color.cmsmasters_social_icon_{$i} {
			background-color:{$cmsmasters_social_icon[4]};
		}
		";
			}
			
			
			if (isset($cmsmasters_social_icon[5]) && $cmsmasters_social_icon[5] != '') {
				$out .= "
		
		#page .cmsmasters_social_icon_color.cmsmasters_social_icon_{$i}:hover {
			background-color:{$cmsmasters_social_icon[5]};
		}";
			}
			
			
			$i++;
		}
		
		
		wp_add_inline_style('schule-style', $out);
	}
}

add_action('wp_enqueue_scripts', 'schule_theme_social_icons_styles');



/* Get Posts Thumbnail Function */
function schule_thumb($cmsmasters_id, $type = 'post-thumbnail', $link = true, $group = false, $preload = true, $highImg = false, $fullwidth = true, $show = true, $attachment = false, $unique = false, $link_icon = false, $placeholder_icon = 'cmsmasters_theme_icon_image') {
	$args = array( 
		'class' => (($fullwidth) ? 'full-width' : ''), 
		'alt' => cmsmasters_title($cmsmasters_id, false), 
		'title' => cmsmasters_title($cmsmasters_id, false) 
	);
	
	
	$link_href = ($attachment) ? wp_get_attachment_image_src(strstr($attachment, '|', true), 'full') : wp_get_attachment_image_src((int) get_post_thumbnail_id($cmsmasters_id), 'full');
	
	
	if (!$unique) {
		$unique_id = uniqid();
	} else {
		$unique_id = $unique;
	}
	
	
	$out = '<figure class="cmsmasters_img_wrap">' . 
		'<a href="' . (($link) ? esc_url(get_permalink()) : esc_url($link_href[0])) . '"' . 
		' title="' . cmsmasters_title($cmsmasters_id, false) . '"' . 
		(($group) ? ' rel="ilightbox[' . esc_attr($group) . '_' . esc_attr($unique_id) . ']"' : '') . 
		' class="cmsmasters_img_link' . 
		(($preload) ? ' preloader' . (($highImg) ? ' highImg' : '') : '') . 
		($link_icon ? ' ' . esc_attr($link_icon) : '') . 
		'">';
	
	
	if ($attachment) {
		$args = cmsmasters_check_img_agrs(strstr($attachment, '|', true), $args);
		
		$out .= wp_get_attachment_image(strstr($attachment, '|', true), (($type) ? $type : 'full'), false, $args);
	} elseif (has_post_thumbnail($cmsmasters_id)) {
		$args = cmsmasters_check_img_agrs(get_post_thumbnail_id($cmsmasters_id), $args);
		
		$out .= get_the_post_thumbnail($cmsmasters_id, (($type) ? $type : 'full'), $args);
	} else {
		$out .= '<span class="img_placeholder ' . esc_attr($placeholder_icon) . '"></span>';
	}
	
	
	$out .= '</a>' . 
	'</figure>';
	
	
	if ($show) {
		echo schule_return_content($out);
	} else {
		return $out;
	}
}



/* Get Posts Thumbnail With Rollover Function */
function schule_thumb_rollover($cmsmasters_id, $type = 'post-thumbnail', $rollover = true, $open_link = true, $group = false, $attachment_images = false, $attachment_video_type = false, $attachment_video_link = false, $attachment_video_links = false, $highImg = false, $show = true, $link_redirect = false, $link_url = false, $link_target = false, $placeholder_icon = 'cmsmasters_theme_icon_image', $puzzle_image = '') {
	$cmsmasters_title = cmsmasters_title($cmsmasters_id, false);

	$args = array( 
		'class' => 'full-width', 
		'alt' => $cmsmasters_title, 
		'title' => $cmsmasters_title 
	);
	
	$unique_id = uniqid();
	
	
	$out = '<figure class="cmsmasters_img_rollover_wrap preloader' . (($highImg) ? ' highImg' : '') . '">';
	
	
	if ($puzzle_image != '') {
		$args = cmsmasters_check_img_agrs(strstr($puzzle_image, '|', true), $args);
		
		$out .= wp_get_attachment_image(strstr($puzzle_image, '|', true), 'full', false, $args);
		
		$cmsmasters_image_link = wp_get_attachment_image_src(strstr($puzzle_image, '|', true), 'full');
	} elseif (has_post_thumbnail($cmsmasters_id)) {
		$args = cmsmasters_check_img_agrs(get_post_thumbnail_id($cmsmasters_id), $args);
		
		$out .= get_the_post_thumbnail($cmsmasters_id, (($type) ? $type : 'full'), $args);
		
		$cmsmasters_image_link = wp_get_attachment_image_src((int) get_post_thumbnail_id($cmsmasters_id), 'full');
	} elseif ($attachment_images && $attachment_images[0] != '' && sizeof($attachment_images) > 0) {
		$args = cmsmasters_check_img_agrs(strstr($attachment_images[0], '|', true), $args);
		
		$out .= wp_get_attachment_image(strstr($attachment_images[0], '|', true), (($type) ? $type : 'full'), false, $args);
		
		$cmsmasters_image_link = wp_get_attachment_image_src(strstr($attachment_images[0], '|', true), 'full');
	} else {
		$out .= '<span class="img_placeholder ' . esc_attr($placeholder_icon) . '"></span>';
		
		$cmsmasters_image_link = '';
	}
	
	
	$is_video_selfhosted = false;
	
	
	if (
		$attachment_video_type == 'selfhosted' && 
		!empty($attachment_video_links) && 
		sizeof($attachment_video_links) > 0
	) {
		$is_video_selfhosted = true;
		
		
		$shv_out = 'href="' . esc_url($attachment_video_links[0]) . '"';
		
		
		$shvl_out = '';
		
		
		unset($attachment_video_links[0]);
		
		
		foreach($attachment_video_links as $attachment_video_link_url) {
			$video_format = substr(strrchr($attachment_video_link_url, '.'), 1);
			
			$shvl_out .= $video_format . ":'{$attachment_video_link_url}', ";
		}
		
		
		$shv_out .= ' data-options="' . 
			'html5video: {' . 
				substr($shvl_out, 0, -2) . 
			'}' . 
		'"';
	}
	
	
	if ($rollover) {
		$out .= '<div class="cmsmasters_img_rollover">';
		
		if (
			$group && 
			(
				(
					$attachment_video_type == 'embedded' && 
					$attachment_video_link != ''
				) || 
				$is_video_selfhosted || 
				$cmsmasters_image_link != ''
			)
		) {
			$out .= '<a ' . ($is_video_selfhosted ? $shv_out : 'href="' . ((!$attachment_video_link) ? esc_url($cmsmasters_image_link[0]) : $attachment_video_link) . '"') . ' rel="ilightbox[' . esc_attr($cmsmasters_id) . '_' . esc_attr($unique_id) . ']"' . (($link_redirect == 'true' && $link_target == 'true') ? ' target="_blank"' : '') . ' title="' . esc_attr($cmsmasters_title) . '" class="cmsmasters_image_link"></a>';
		}
		
		
		if ($open_link) {
			$out .= '<a href="' . (($link_redirect == 'true' && $link_url != '') ? esc_url($link_url) : esc_url(get_permalink($cmsmasters_id))) . '"' . (($link_redirect == 'true' && $link_target == 'true') ? ' target="_blank"' : '') . ' title="' . esc_attr($cmsmasters_title) . '" class="cmsmasters_open_link"></a>';
		}
		
		$out .= '</div>';
	} elseif ($open_link) {
		$out .= '<div class="cmsmasters_img_rollover">' . 
			'<a href="' . (($link_redirect == 'true' && $link_url != '') ? esc_url($link_url) : esc_url(get_permalink($cmsmasters_id))) . '"' . (($link_redirect == 'true' && $link_target == 'true') ? ' target="_blank"' : '') . ' title="' . esc_attr($cmsmasters_title) . '" class="cmsmasters_open_post_link button">' . esc_html__('Read more', 'schule') . '</a>' . 
		'</div>';
	} else {
		$out .= '<div class="cmsmasters_img_rollover">' . 
			'<a href="' . (($link_redirect == 'true' && $link_url != '') ? esc_url($link_url) : esc_url(get_permalink($cmsmasters_id))) . '"' . (($link_redirect == 'true' && $link_target == 'true') ? ' target="_blank"' : '') . ' title="' . esc_attr($cmsmasters_title) . '" class="cmsmasters_open_link"></a>' . 
		'</div>';
	}
	
	
	$out .= '</figure>';
	
	
	if ($group && $attachment_images && sizeof($attachment_images) > 1) {
		if (!has_post_thumbnail($cmsmasters_id)) {
			unset($attachment_images[0]);
		}
		
		$out .= '<div class="dn">';
		
		foreach ($attachment_images as $attachment_image) {
			$attachment_image_link = wp_get_attachment_image_src(strstr($attachment_image, '|', true), 'full');
			
			$args = cmsmasters_check_img_agrs(strstr($attachment_image, '|', true), $args);
			
			$out .= '<figure>' . 
				'<a href="' . esc_url($attachment_image_link[0]) . '" rel="ilightbox[' . esc_attr($cmsmasters_id) . '_' . esc_attr($unique_id) . ']" title="' . esc_attr($cmsmasters_title) . '" class="preloader highImg">' . 
					wp_get_attachment_image(strstr($attachment_image, '|', true), 'full', false, $args) . 
				'</a>' . 
			'</figure>';
		}
		
		$out .= '</div>';
	}
	
	
	if ($show) {
		echo schule_return_content($out);
	} else {
		return $out;
	}
}



/* Get Posts Small Thumbnail Function */
function schule_thumb_small($cmsmasters_id, $type = 'post', $w = 100, $h = 100, $show = true) {
	$out = '<figure class="alignleft">' . 
		'<a href="' . esc_url(get_permalink()) . '"' . ' title="' . cmsmasters_title($cmsmasters_id, false) . '">';

		$args = array( 
			'alt' => cmsmasters_title($cmsmasters_id, false), 
			'title' => cmsmasters_title($cmsmasters_id, false), 
			'style' => 'width:' . $w . 'px; height:' . $h . 'px;' 
		);
		
		
		if (has_post_thumbnail()) {
			$args = cmsmasters_check_img_agrs(get_post_thumbnail_id($cmsmasters_id), $args);
			
			$out .= get_the_post_thumbnail($cmsmasters_id, 'cmsmasters-square-thumb', $args);
		} elseif ($type == 'post') { // Post type - post
			if (get_post_format() == 'gallery') {
				$cmsmasters_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta($cmsmasters_id, 'cmsmasters_post_images', true))));
				
				$cmsmasters_post_image = $cmsmasters_post_images[0];
				
				if (isset($cmsmasters_post_image) && $cmsmasters_post_image != '') {
					$args = cmsmasters_check_img_agrs(strstr($cmsmasters_post_image, '|', true), $args);
					
					$out .= wp_get_attachment_image(strstr($cmsmasters_post_image, '|', true), 'cmsmasters-square-thumb', false, $args);
				} else {
					$out .= '<span class="img_placeholder cmsmasters_theme_icon_image"></span>';
				}
			} elseif (get_post_format() == 'image') {
				$cmsmasters_post_image = get_post_meta($cmsmasters_id, 'cmsmasters_post_image_link', true);
				
				if (isset($cmsmasters_post_image) && $cmsmasters_post_image != '') {
					$args = cmsmasters_check_img_agrs(strstr($cmsmasters_post_image, '|', true), $args);
					
					$out .= wp_get_attachment_image(strstr($cmsmasters_post_image, '|', true), 'cmsmasters-square-thumb', false, $args);
				} else {
					$out .= '<span class="img_placeholder cmsmasters_theme_icon_image"></span>';
				}
			} else {
				$out .= '<span class="img_placeholder cmsmasters_theme_icon_image"></span>';
			}
		} elseif ($type == 'project') { // Post type - project
			if (get_post_format() == 'gallery' || get_post_format() == 'standard') {
				$cmsmasters_project_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta($cmsmasters_id, 'cmsmasters_project_images', true))));
				
				$cmsmasters_project_image = $cmsmasters_project_images[0];
				
				if (isset($cmsmasters_project_image) && $cmsmasters_project_image != '') {
					$args = cmsmasters_check_img_agrs(strstr($cmsmasters_project_image, '|', true), $args);
					
					$out .= wp_get_attachment_image(strstr($cmsmasters_project_image, '|', true), 'cmsmasters-square-thumb', false, $args);
				} else {
					$out .= '<span class="img_placeholder cmsmasters_theme_icon_image"></span>';
				}
			} else {
				$out .= '<span class="img_placeholder cmsmasters_theme_icon_image"></span>';
			}
		} elseif ($type == 'profile') { // Post type - profile
			$out .= '<span class="img_placeholder cmsmasters_theme_icon_person"></span>';
		}
		
		$out .= '</a>' . 
	'</figure>';
	
	
	if ($show) {
		echo schule_return_content($out);
	} else {
		return $out;
	}
}



/* Theme Category Styles */
function schule_theme_category_styles() {
	$out = "";
	
	
	if (CMSMASTERS_COLORED_CATEGORIES) {
		$args = schule_colored_categories_args();
		
		$cats = get_terms($args);
		
		
		if (!empty($cats) && !is_wp_error($cats)) {
			foreach ($cats as $cat) {
				$cat_id = $cat->term_id;
				
				$cat_color = get_term_meta($cat_id, 'cmsmasters_cat_color', true);
				
				
				if (isset($cat_color) && $cat_color != '') {
					$out .= "
		
		a.cmsmasters_cat_{$cat_id} {
			" . cmsmasters_color_css('color', $cat_color) . "
		}	
	";
				}
			}
		}
	}
	
	
	wp_add_inline_style('schule-style', $out);
}

add_action('wp_enqueue_scripts', 'schule_theme_category_styles');



/* Get Page Container Classes */
function schule_get_page_classes($cmsmasters_option, $classes = false) {
	$browser = new Browser();
	
	list($cmsmasters_layout) = schule_theme_page_layout_scheme();
	
	if (
		($browser->getPlatform() != Browser::PLATFORM_IPHONE) && 
		($browser->getPlatform() != Browser::PLATFORM_IPOD) && 
		($browser->getPlatform() != Browser::PLATFORM_IPAD) && 
		($browser->getPlatform() != Browser::PLATFORM_BLACKBERRY) && 
		($browser->getPlatform() != Browser::PLATFORM_ANDROID) && 
		($browser->getPlatform() != Browser::PLATFORM_APPLE) 
	) {
		echo 'csstransition ';
	}
	
	
	if ( $browser->getBrowser() == Browser::BROWSER_CHROME ) {
		echo 'chrome_only ';
	}
	
	
	if (
		( $browser->getBrowser() == Browser::BROWSER_SAFARI ) &&
		( $browser->getBrowser() != Browser::BROWSER_CHROME ) 
	) {
		echo 'safari_only ';
	}
	
	
	if (
		( $browser->getPlatform() == Browser::PLATFORM_IPHONE ) || 
		( $browser->getPlatform() == Browser::PLATFORM_IPOD ) || 
		( $browser->getPlatform() == Browser::PLATFORM_IPAD ) 
	) {
		echo 'safari_mobile_only ';
	}
	
	
	if ( $browser->getBrowser() == Browser::BROWSER_IE ) {
		echo 'ie_only ';
	}
	
	
	if ( $browser->getBrowser() == Browser::BROWSER_EDGE ) {
		echo 'edge_only ';
	}
	
	
	echo 'cmsmasters_' . $cmsmasters_option['schule' . '_theme_layout'] . ' ';
	
	
	if ($cmsmasters_layout == 'fullwidth') {
		echo 'fullwidth ';
	}
	
	
	if ($cmsmasters_option['schule' . '_fixed_header']) {
		echo 'fixed_header ';
	}
	
	
	if ($cmsmasters_option['schule' . '_header_top_line']) {
		echo 'enable_header_top ';
	}
	
	
	if ($cmsmasters_option['schule' . '_header_styles'] != 'default') {
		echo 'enable_header_bottom ';
	}
	
	
	if ($cmsmasters_option['schule' . '_header_styles'] == 'r_nav') {
		echo 'enable_header_right ';
	}
	
	
	if ($cmsmasters_option['schule' . '_header_styles'] == 'c_nav') {
		echo 'enable_header_centered ';
	}
	
	
	if (is_singular()) {
		$cmsmasters_page_id = get_the_ID();
	} elseif (CMSMASTERS_WOOCOMMERCE && is_shop()) {
		$cmsmasters_page_id = wc_get_page_id('shop');
	}
	
	
	$cmsmasters_header_overlaps = '';
	
	
	if (
		is_singular() || 
		(CMSMASTERS_WOOCOMMERCE && is_shop())
	) {
		$cmsmasters_header_overlaps = get_post_meta($cmsmasters_page_id, 'cmsmasters_header_overlaps', true);
	}
	
	
	if ($cmsmasters_header_overlaps == '') {
		$cmsmasters_header_overlaps = $cmsmasters_option['schule' . '_header_overlaps'];
	}
	
	
	if (!empty($cmsmasters_header_overlaps) && $cmsmasters_header_overlaps != 'false') {
		echo 'cmsmasters_heading_under_header ';
	} else {
		echo 'cmsmasters_heading_after_header ';
	}

	if (
		CMSMASTERS_TRIBE_EVENTS &&
		true === tribe_events_views_v2_is_enabled()
	) {
		echo 'cmsmasters_tribe_events_views_v2 cmsmasters_tribe_events_style_mode_' . tribe_get_option( 'stylesheet_mode' ) . ' ';
	}
	
	
	if ($classes && $classes != '') {
		echo esc_attr($classes) . ' ';
	}
}



/* Theme Header Styles */
function schule_theme_header_styles() {
	$cmsmasters_option = schule_get_global_options();
	
	$defaults = schule_settings_general_defaults();
	
	
	$header_top_height = (($cmsmasters_option['schule' . '_header_top_height'] !== '') ? $cmsmasters_option['schule' . '_header_top_height'] : $defaults[$tab]['schule' . '_header_top_height']);
	
	$header_mid_height = (($cmsmasters_option['schule' . '_header_mid_height'] !== '') ? $cmsmasters_option['schule' . '_header_mid_height'] : $defaults[$tab]['schule' . '_header_mid_height']);
	
	$header_bot_height = (($cmsmasters_option['schule' . '_header_bot_height'] !== '') ? $cmsmasters_option['schule' . '_header_bot_height'] : $defaults[$tab]['schule' . '_header_bot_height']);
	
	
	$out = "
	.header_top {
		height : {$header_top_height}px;
	}
	
	ul.top_line_nav > li > a {
		line-height : " . ($header_top_height - 2) . "px;
	}
	
	.header_mid {
		height : {$header_mid_height}px;
	}
	
	.header_bot {
		height : {$header_bot_height}px;
	}
	
	#page.cmsmasters_heading_after_header #middle, 
	#page.cmsmasters_heading_under_header #middle .headline .headline_outer {
		padding-top : {$header_mid_height}px;
	}
	
	#page.cmsmasters_heading_after_header.enable_header_top #middle, 
	#page.cmsmasters_heading_under_header.enable_header_top #middle .headline .headline_outer {
		padding-top : " . ($header_mid_height + $header_top_height) . "px;
	}
	
	#page.cmsmasters_heading_after_header.enable_header_bottom #middle, 
	#page.cmsmasters_heading_under_header.enable_header_bottom #middle .headline .headline_outer {
		padding-top : " . ($header_mid_height + $header_bot_height) . "px;
	}
	
	#page.cmsmasters_heading_after_header.enable_header_top.enable_header_bottom #middle, 
	#page.cmsmasters_heading_under_header.enable_header_top.enable_header_bottom #middle .headline .headline_outer {
		padding-top : " . ($header_mid_height + $header_top_height + $header_bot_height) . "px;
	}
	
	@media only screen and (max-width: 1024px) {
		.header_top,
		.header_mid,
		.header_bot {
			height : auto;
		}
		
		.header_mid .header_mid_inner > div,
		.header_mid .header_mid_inner .cmsmasters_header_cart_link {
			height : {$header_mid_height}px;
		}
		
		#page.cmsmasters_heading_after_header #middle, 
		#page.cmsmasters_heading_under_header #middle .headline .headline_outer, 
		#page.cmsmasters_heading_after_header.enable_header_top #middle, 
		#page.cmsmasters_heading_under_header.enable_header_top #middle .headline .headline_outer, 
		#page.cmsmasters_heading_after_header.enable_header_bottom #middle, 
		#page.cmsmasters_heading_under_header.enable_header_bottom #middle .headline .headline_outer, 
		#page.cmsmasters_heading_after_header.enable_header_top.enable_header_bottom #middle, 
		#page.cmsmasters_heading_under_header.enable_header_top.enable_header_bottom #middle .headline .headline_outer {
			padding-top : 0 !important;
		}
	}
	
	@media only screen and (max-width: 768px) {
		.header_mid .header_mid_inner > div, 
		.header_bot .header_bot_inner > div,
		.header_mid .header_mid_inner .cmsmasters_header_cart_link {
			height:auto;
		}
	}
	
	@media only screen and (max-width: 1024px) {
		.enable_header_centered .header_mid .header_mid_inner .cmsmasters_header_cart_link {
			height:auto;
		}
	}
";
	
	
	if ($cmsmasters_option['schule' . '_custom_css'] != '') {
		$out .= stripslashes($cmsmasters_option['schule' . '_custom_css']);
	}
	
	wp_add_inline_style('schule-style', $out);
}

add_action('wp_enqueue_scripts', 'schule_theme_header_styles');

