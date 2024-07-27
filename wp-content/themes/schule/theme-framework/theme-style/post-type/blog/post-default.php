<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.1
 * 
 * Post Default Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_post_metadata = !is_home() ? explode(',', $cmsmasters_metadata) : array();


$date = (in_array('date', $cmsmasters_post_metadata) || is_home()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsmasters_post_metadata) || is_home())) ? true : false;
$author = (in_array('author', $cmsmasters_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsmasters_post_metadata) || (is_home() && CMSMASTERS_CONTENT_COMPOSER)) ? true : false;
$more = (in_array('more', $cmsmasters_post_metadata) || is_home()) ? true : false;


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Post Default Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_post_default'); ?>>
	<div class="cmsmasters_post_cont_wrap">
		<?php
		if ($cmsmasters_post_format == 'image') {

			echo '<div class="cmsmasters_img_date">';

				$cmsmasters_post_image_link = get_post_meta(get_the_ID(), 'cmsmasters_post_image_link', true);				
			
					schule_post_type_image(get_the_ID(), $cmsmasters_post_image_link, 'cmsmasters-full-thumb');

					if ($date || $author) {
						echo '<div class="cmsmasters_post_cont_info entry-meta">';
							
							$date ? schule_get_post_date('page', 'default') : '';
							
							$author ? schule_get_post_author('page') : '';
							
						echo '</div>';
					}				

			echo '</div>';

			echo '<div class="cmsmasters_block_wrap">';

			if ($categories) {
				$categories ? schule_get_post_category(get_the_ID(), 'category', 'page') : '';
			}

			schule_post_heading(get_the_ID(), 'h3');
			
			schule_post_exc_cont(100);	

			if ($more || $comments || $likes) {				
				
				echo '<footer class="cmsmasters_post_footer entry-meta">';

					$more ? schule_post_more(get_the_ID()) : '';
					
					if ($comments || $likes) {
						echo '<div class="cmsmasters_post_meta_info">';
							
							$comments ? schule_get_post_comments('page') : '';
							
							$likes ? schule_get_post_likes('page') : '';
							
						echo '</div>';
					}
					
				echo '</footer>';
			}

			echo '</div>';
			
		} elseif ($cmsmasters_post_format == 'gallery') {
			$cmsmasters_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_post_images', true))));
			
			schule_post_type_slider(get_the_ID(), $cmsmasters_post_images, 'cmsmasters-full-thumb');

			echo '<div class="cmsmasters_block_wrap">';

			if ($date || $author) {
				echo '<div class="cmsmasters_post_cont_info entry-meta">';
					
					$date ? schule_get_post_date('page', 'default') : '';
					
					$author ? schule_get_post_author('page') : '';
					
				echo '</div>';
			}	

			if ($categories) {
				$categories ? schule_get_post_category(get_the_ID(), 'category', 'page') : '';
			}

			schule_post_heading(get_the_ID(), 'h3');

			schule_post_exc_cont(100);	

			if ($more || $comments || $likes) {				
				
				echo '<footer class="cmsmasters_post_footer entry-meta">';

					$more ? schule_post_more(get_the_ID()) : '';
					
					if ($comments || $likes) {
						echo '<div class="cmsmasters_post_meta_info">';
							
							$comments ? schule_get_post_comments('page') : '';
							
							$likes ? schule_get_post_likes('page') : '';
							
						echo '</div>';
					}
					
				echo '</footer>';
			}

			echo '</div>';

		} elseif ($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) {
			echo '<div class="cmsmasters_img_date">';
				
				$cmsmasters_post_image_link = get_post_meta(get_the_ID(), 'cmsmasters_post_image_link', true);				
					
					schule_thumb(get_the_ID(), 'cmsmasters-full-thumb', true, false, false, false, false, true, false);
					
					if ($date || $author) {
						echo '<div class="cmsmasters_post_cont_info entry-meta">';
							
							$date ? schule_get_post_date('page', 'default') : '';
							
							$author ? schule_get_post_author('page') : '';
							
						echo '</div>';
					}

			echo '</div>';
			
			echo '<div class="cmsmasters_block_wrap">';
				
				if ($categories) {
					$categories ? schule_get_post_category(get_the_ID(), 'category', 'page') : '';
				}
				
				schule_post_heading(get_the_ID(), 'h3');
				
				schule_post_exc_cont(100);	
				
				if ($more || $comments || $likes) {				
					
					echo '<footer class="cmsmasters_post_footer entry-meta">';
						
						$more ? schule_post_more(get_the_ID()) : '';
						
						if ($comments || $likes) {
							echo '<div class="cmsmasters_post_meta_info">';
								
								$comments ? schule_get_post_comments('page') : '';
								
								$likes ? schule_get_post_likes('page') : '';
								
							echo '</div>';
						}
						
					echo '</footer>';
				}
				
			echo '</div>';
		} elseif ($cmsmasters_post_format == '' && !post_password_required() && !has_post_thumbnail()) {
			schule_thumb(get_the_ID(), 'cmsmasters-full-thumb', true, false, false, false, false, true, false);

			if ($date || $author) {
				echo '<div class="cmsmasters_post_cont_info entry-meta">';
					
					$date ? schule_get_post_date('page', 'default') : '';
					
					$author ? schule_get_post_author('page') : '';
					
				echo '</div>';
			}

			if ($categories) {
				$categories ? schule_get_post_category(get_the_ID(), 'category', 'page') : '';
			}

			
			schule_post_heading(get_the_ID(), 'h3');
			
			schule_post_exc_cont(100);	
			
			if ($more || $comments || $likes) {				
				
				echo '<footer class="cmsmasters_post_footer entry-meta">';
					
					$more ? schule_post_more(get_the_ID()) : '';
					
					if ($comments || $likes) {
						echo '<div class="cmsmasters_post_meta_info">';
							
							$comments ? schule_get_post_comments('page') : '';
							
							$likes ? schule_get_post_likes('page') : '';
							
						echo '</div>';
					}
					
				echo '</footer>';
			}
			
		} elseif ($cmsmasters_post_format == 'video') {
			$cmsmasters_post_video_type = get_post_meta(get_the_ID(), 'cmsmasters_post_video_type', true);
			$cmsmasters_post_video_link = get_post_meta(get_the_ID(), 'cmsmasters_post_video_link', true);
			$cmsmasters_post_video_links = get_post_meta(get_the_ID(), 'cmsmasters_post_video_links', true);
			
			echo '<div class="cmsmasters_post_video_wrap">';
				schule_post_type_video(get_the_ID(), $cmsmasters_post_video_type, $cmsmasters_post_video_link, $cmsmasters_post_video_links);
			echo '</div>';
					

			echo '<div class="cmsmasters_block_wrap">';

			if ($date || $author) {
				echo '<div class="cmsmasters_post_cont_info entry-meta">';
					
					$date ? schule_get_post_date('page', 'default') : '';
					
					$author ? schule_get_post_author('page') : '';
					
				echo '</div>';
			}	

			if ($categories) {
				$categories ? schule_get_post_category(get_the_ID(), 'category', 'page') : '';
			}

			schule_post_heading(get_the_ID(), 'h3');

			schule_post_exc_cont(100);	

			if ($more || $comments || $likes) {				
				
				echo '<footer class="cmsmasters_post_footer entry-meta">';

					$more ? schule_post_more(get_the_ID()) : '';
					
					if ($comments || $likes) {
						echo '<div class="cmsmasters_post_meta_info">';
							
							$comments ? schule_get_post_comments('page') : '';
							
							$likes ? schule_get_post_likes('page') : '';
							
						echo '</div>';
					}
					
				echo '</footer>';
			}

			echo '</div>';
		} else 	if ($cmsmasters_post_format == 'audio') {
			if ($date || $author) {
				echo '<div class="cmsmasters_post_cont_info entry-meta">';
					
					$date ? schule_get_post_date('page', 'default') : '';
					
					$author ? schule_get_post_author('page') : '';
					
				echo '</div>';
			}

			if ($categories) {
				$categories ? schule_get_post_category(get_the_ID(), 'category', 'page') : '';
			}

			schule_post_heading(get_the_ID(), 'h3');

			$cmsmasters_post_audio_links = get_post_meta(get_the_ID(), 'cmsmasters_post_audio_links', true);
			
			schule_post_type_audio($cmsmasters_post_audio_links);

			schule_post_exc_cont(100);

			if ($more || $comments || $likes) {				
				
				echo '<footer class="cmsmasters_post_footer entry-meta">';
					
					$more ? schule_post_more(get_the_ID()) : '';
					
					if ($comments || $likes) {
						echo '<div class="cmsmasters_post_meta_info">';
							
							$comments ? schule_get_post_comments('page') : '';
							
							$likes ? schule_get_post_likes('page') : '';
							
						echo '</div>';
					}
					
				echo '</footer>';
			}
		} else {
			schule_thumb(get_the_ID(), 'cmsmasters-full-thumb', true, false, false, false, false, true, false);

			if ($date || $author) {
				echo '<div class="cmsmasters_post_cont_info entry-meta">';
					
					$date ? schule_get_post_date('page', 'default') : '';
					
					$author ? schule_get_post_author('page') : '';
					
				echo '</div>';
			}

			if ($categories) {
				$categories ? schule_get_post_category(get_the_ID(), 'category', 'page') : '';
			}

			
			schule_post_heading(get_the_ID(), 'h3');
			
			schule_post_exc_cont(100);	
			
			if ($more || $comments || $likes) {				
				
				echo '<footer class="cmsmasters_post_footer entry-meta">';
					
					$more ? schule_post_more(get_the_ID()) : '';
					
					if ($comments || $likes) {
						echo '<div class="cmsmasters_post_meta_info">';
							
							$comments ? schule_get_post_comments('page') : '';
							
							$likes ? schule_get_post_likes('page') : '';
							
						echo '</div>';
					}
					
				echo '</footer>';
			}
		}
		?>
	</div>
</article>
<!-- Finish Post Default Article -->

