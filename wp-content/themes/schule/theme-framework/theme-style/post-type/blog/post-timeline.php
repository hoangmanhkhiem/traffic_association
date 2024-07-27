<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Post Timeline Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_post_metadata = !is_home() ? explode(',', $cmsmasters_metadata) : array();


$date = (in_array('date', $cmsmasters_post_metadata) || is_home()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsmasters_post_metadata) || is_home())) ? true : false;
$author = (in_array('author', $cmsmasters_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsmasters_post_metadata) || is_home()) ? true : false;
$more = (in_array('more', $cmsmasters_post_metadata) || is_home()) ? true : false;


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Post Timeline Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_post_timeline'); ?>>
	<?php 
	if ($date) {
		echo '<div class="cmsmasters_post_info entry-meta">';
		
			schule_get_post_date('page', 'timeline');
			
		echo '</div>';
	}
	?>
	<div class="cmsmasters_timeline_margin">
		<div class="cmsmasters_post_cont">
		<?php
			if ($cmsmasters_post_format == 'image') {
				$cmsmasters_post_image_link = get_post_meta(get_the_ID(), 'cmsmasters_post_image_link', true);
				
				schule_post_type_image(get_the_ID(), $cmsmasters_post_image_link);
			} elseif ($cmsmasters_post_format == 'gallery') {
				$cmsmasters_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_post_images', true))));
				
				$slider_data = ' data-auto-height="false"';
				
				schule_post_type_slider(get_the_ID(), $cmsmasters_post_images, 'cmsmasters-blog-masonry-thumb', $slider_data);
			} elseif ($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) {
				schule_thumb(get_the_ID(), 'cmsmasters-blog-masonry-thumb', true, false, true, false, true, true, false);
			} elseif ($cmsmasters_post_format == 'video') {
				$cmsmasters_post_video_type = get_post_meta(get_the_ID(), 'cmsmasters_post_video_type', true);
				$cmsmasters_post_video_link = get_post_meta(get_the_ID(), 'cmsmasters_post_video_link', true);
				$cmsmasters_post_video_links = get_post_meta(get_the_ID(), 'cmsmasters_post_video_links', true);
				
				echo '<div class="cmsmasters_post_video_wrap">';
					schule_post_type_video(get_the_ID(), $cmsmasters_post_video_type, $cmsmasters_post_video_link, $cmsmasters_post_video_links);
				echo '</div>';
			}
			
			if ($categories || $author) {
				echo '<div class="cmsmasters_post_cont_info entry-meta">';
					
					$categories ? schule_get_post_category(get_the_ID(), 'category', 'page') : '';
					
					$author ? schule_get_post_author('page') : '';
					
				echo '</div>';
			}
			
			echo '<div class="cmsmasters_post_cont_inner' . ((($cmsmasters_post_format == 'image') || ($cmsmasters_post_format == 'gallery') || ($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) || ($cmsmasters_post_format == 'video')) ? ' enable_image' : '') . '">';
				schule_post_heading(get_the_ID(), 'h2');		
				
				
				if ($cmsmasters_post_format == 'audio') {
					$cmsmasters_post_audio_links = get_post_meta(get_the_ID(), 'cmsmasters_post_audio_links', true);
					
					schule_post_type_audio($cmsmasters_post_audio_links);
				}
				
				
				schule_post_exc_cont();
				
				
				if ($more || $likes || $comments) {
					echo '<footer class="cmsmasters_post_footer' . (($comments || $likes) ? ' enable_meta_info' : '') . ' entry-meta">';
						
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
		?>
		</div>
	</div>
</article>
<!-- Finish Post Timeline Article -->

