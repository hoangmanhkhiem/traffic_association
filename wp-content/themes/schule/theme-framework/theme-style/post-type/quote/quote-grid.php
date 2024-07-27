<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Quote Grid Template
 * Created by CMSMasters
 * 
 */


?>
<!-- Start Quote Grid Article -->
<article class="cmsmasters_quote_inner">
<?php 
	echo cmsmasters_divpdel('<div class="cmsmasters_quote_content">' . 
		do_shortcode(wpautop(wp_kses(stripslashes($quote_content), 'post'))) . 
	'</div>');
	
	
	if ($quote_image != '' || $quote_name != '' || $quote_subtitle != '' || $quote_website != '' || $quote_link != '') {
		echo '<div class="cmsmasters_quote_img_info_wrap">';
			
			if ($quote_image != '') {
				echo '<figure class="cmsmasters_quote_image">' . 
					wp_get_attachment_image(strstr($quote_image, '|', true), 'cmsmasters-small-thumb') . 
				'</figure>';
			}
			
			
			if ($quote_name != '' || $quote_subtitle != '' || $quote_website != '' || $quote_link != '') {
				echo '<div class="cmsmasters_quote_info_wrap">';
					
					if ($quote_name != '') {
						echo '<header class="cmsmasters_quote_header">' . 
							'<h4 class="cmsmasters_quote_title">' . esc_html($quote_name) . '</h4>' . 
						'</header>';
					}
					
					if ($quote_subtitle != '' || $quote_website != '' || $quote_link != '') {
						echo '<div class="cmsmasters_quote_subtitle_wrap">' . 
							
							($quote_subtitle != '' ? '<h6 class="cmsmasters_quote_subtitle">' . esc_html($quote_subtitle) . '</h6> ' : '');
							
							
							if ($quote_website != '' || $quote_link != '') {
								echo '<span class="cmsmasters_quote_site">' . 
									($quote_link != '' ? '<a href="' . esc_url($quote_link) . '" target="_blank">' : '') . 
									
									($quote_website != '' ? esc_html($quote_website) : esc_html($quote_link)) . 
									
									($quote_link != '' ? '</a>' : '') . 
								'</span>';
							}
							
						echo '</div>';
					}
					
				echo '</div>';
			}
			
		echo '</div>';
	}
?>
</article>
<!-- Finish Quote Grid Article -->

