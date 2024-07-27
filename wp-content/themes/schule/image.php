<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Images Page Template
 * Created by CMSMasters
 * 
 */


get_header();


echo '<!-- Start Content -->' . "\n" . 
'<div class="middle_content entry">';


if (have_posts()) : the_post();
	echo '<div class="cmsmasters_attach_img image-attachment">';
		
		$metadata = wp_get_attachment_metadata();
		
		echo '<div class="cmsmasters_attach_img_info entry-meta">'; 
			edit_post_link(esc_html__('Edit Media', 'schule'), '<h5 class="cmsmasters_attach_img_edit">', '</h5>');
			
			echo '<h5 class="cmsmasters_attach_img_meta">' . esc_html__('Published', 'schule') . ' <abbr class="published" title="' . esc_attr(get_the_date()) . '">' . get_the_date() . '</abbr> ' . esc_html__('at', 'schule') . ' ' . esc_html($metadata['width']) . '&times;' . esc_html($metadata['height']) . ' ' . esc_html__('in', 'schule') . ' ' . '<a href="' . esc_url(get_permalink($post->post_parent)) . '" title="' . cmsmasters_title($post->post_parent, false) . '">' . cmsmasters_title($post->post_parent, false) . '</a>.</h5>' . 
		'</div>' . 
		schule_thumb(get_the_ID(), 'full', false, 'img_' . get_the_ID(), true, true, true, false, get_the_ID());
		
		
		comments_template();
		
	echo '</div>';
endif;


echo '</div>' . "\n" . 
'<!-- Finish Content -->' . "\n\n";


get_footer();

