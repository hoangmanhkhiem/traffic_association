<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Quote Slider Template
 * Created by CMSMasters
 * 
 */


?>
<!-- Start Quote Slider Article -->
<article class="cmsmasters_quote_inner">
<?php 

	if ($quote_image != '') {
		echo '<figure class="cmsmasters_quote_image">' . 
			wp_get_attachment_image(strstr($quote_image, '|', true), 'cmsmasters-square-thumb') . 
		'</figure>';
	}


	echo cmsmasters_divpdel('<div class="cmsmasters_quote_content">' . 
		do_shortcode(wpautop(wp_kses(stripslashes($quote_content), 'post'))) . 
	'</div>');
		
	if ($quote_name != '') {
		echo '<header class="cmsmasters_quote_header">' . 
			'<h3 class="cmsmasters_quote_title">' . esc_html($quote_name) . '</h3>' . 
		'</header>';
	}
	
	
	if ($quote_subtitle != '' || $quote_website != '' || $quote_link != '') {
		echo '<div class="cmsmasters_quote_subtitle_wrap">' . 
			
			($quote_subtitle != '' ? '<h6 class="cmsmasters_quote_subtitle">' . esc_html($quote_subtitle) . '</h6>' : '');
			
			
			if ($quote_website != '' || $quote_link != '') {
				echo '<span class="cmsmasters_quote_site">' . 
					($quote_link != '' ? '<a href="' . esc_url($quote_link) . '" target="_blank">' : '') . 
					
					($quote_website != '' ? esc_html($quote_website) : esc_html($quote_link)) . 
					
					($quote_link != '' ? '</a>' : '') . 
				'</span>';
			}
			
		echo '</div>';
	}
?>
</article>
<!-- Finish Quote Slider Article -->

