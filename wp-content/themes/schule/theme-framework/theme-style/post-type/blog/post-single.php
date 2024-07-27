<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.1.5
 * 
 * Post Single Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = schule_get_global_options();

$cmsmasters_post_title = get_post_meta(get_the_ID(), 'cmsmasters_post_title', true);


list($cmsmasters_layout) = schule_theme_page_layout_scheme();

if ($cmsmasters_layout == 'fullwidth') {
	$cmsmasters_image_thumb_size = 'cmsmasters-full-masonry-thumb';
} else {
	$cmsmasters_image_thumb_size = 'post-thumbnail';
}


$cmsmasters_post_format = get_post_format();


$cmsmasters_post_sharing_box = get_post_meta(get_the_ID(), 'cmsmasters_post_sharing_box', true);

$cmsmasters_post_author_box = get_post_meta(get_the_ID(), 'cmsmasters_post_author_box', true);

$cmsmasters_post_more_posts = get_post_meta(get_the_ID(), 'cmsmasters_post_more_posts', true);

?>
<!-- Start Post Single Article -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_open_post'); ?>>
	<?php 

	if (
		$cmsmasters_option['schule' . '_blog_post_date'] || 
		$cmsmasters_option['schule' . '_blog_post_author'] ||
		$cmsmasters_option['schule' . '_blog_post_cat']
	) {
		echo '<div class="cmsmasters_post_cont_info entry-meta">';

		echo '<div class="cmsmasters_data_author">';
		
			schule_get_post_date('post');		

			schule_get_post_author('post');

		echo '</div>';

		schule_get_post_category(get_the_ID(), 'category', 'post');
			
		echo '</div>';
	}
	
	
	if ($cmsmasters_post_title == 'true') {
		schule_post_title_nolink(get_the_ID(), 'h2');
	}	
	
	
	if ($cmsmasters_post_format == 'image') {
		$cmsmasters_post_image_link = get_post_meta(get_the_ID(), 'cmsmasters_post_image_link', true);
		
		schule_post_type_image(get_the_ID(), $cmsmasters_post_image_link, $cmsmasters_image_thumb_size);
	} elseif ($cmsmasters_post_format == 'gallery') {
		$cmsmasters_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_post_images', true))));
		
		schule_post_type_slider(get_the_ID(), $cmsmasters_post_images, $cmsmasters_image_thumb_size);
	} elseif ($cmsmasters_post_format == 'video') {
		$cmsmasters_post_video_type = get_post_meta(get_the_ID(), 'cmsmasters_post_video_type', true);
		$cmsmasters_post_video_link = get_post_meta(get_the_ID(), 'cmsmasters_post_video_link', true);
		$cmsmasters_post_video_links = get_post_meta(get_the_ID(), 'cmsmasters_post_video_links', true);
		
		schule_post_type_video(get_the_ID(), $cmsmasters_post_video_type, $cmsmasters_post_video_link, $cmsmasters_post_video_links, $cmsmasters_image_thumb_size);
	} elseif ($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) {
		$cmsmasters_post_image_show = get_post_meta(get_the_ID(), 'cmsmasters_post_image_show', true);
		
		if ($cmsmasters_post_image_show != 'true') {
			schule_thumb(get_the_ID(), $cmsmasters_image_thumb_size, false, 'cmsmasters_open_post_img', false, false, false, true, false);
		}
	} elseif ($cmsmasters_post_format == 'audio') {
		$cmsmasters_post_audio_links = get_post_meta(get_the_ID(), 'cmsmasters_post_audio_links', true);
		
		schule_post_type_audio($cmsmasters_post_audio_links);
	}
	
	
	if (get_the_content() != '') {
		echo '<div class="cmsmasters_post_content entry-content">';
			
			the_content();
			
			
			wp_link_pages(array( 
				'before' => '<div class="subpage_nav">' . '<strong>' . esc_html__('Pages', 'schule') . ':</strong>', 
				'after' => '</div>', 
				'link_before' => ' [ ', 
				'link_after' => ' ] ' 
			));
			
		echo '</div>';
	}
	
	
	if (
		$cmsmasters_option['schule' . '_blog_post_tag'] || 
		$cmsmasters_option['schule' . '_blog_post_like'] || 
		$cmsmasters_option['schule' . '_blog_post_comment'] 
	) {
		echo '<footer class="cmsmasters_post_footer entry-meta">';
			
			schule_get_post_tags();
			
			
			if (
				$cmsmasters_option['schule' . '_blog_post_date'] || 
				$cmsmasters_option['schule' . '_blog_post_author'] 
			) {
				echo '<div class="cmsmasters_post_meta_info entry-meta">';
					
					schule_get_post_likes('post');
					
					schule_get_post_comments('post');
					
				echo '</div>';
			}
			
		echo '</footer>';
	}
	?>
</article>
<!-- Finish Post Single Article -->
<?php 

if ($cmsmasters_post_sharing_box == 'true') {
	schule_sharing_box(esc_html__('Like this post?', 'schule'), 'h3');
}

if ($cmsmasters_option['schule' . '_blog_post_nav_box']) {
	$order_cat = (isset($cmsmasters_option['schule' . '_blog_post_nav_order_cat']) ? $cmsmasters_option['schule' . '_blog_post_nav_order_cat'] : false);
	
	schule_prev_next_posts($order_cat);
}

if ($cmsmasters_post_author_box == 'true') {
	schule_author_box(esc_html__('About author', 'schule'), 'h3', 'h4');
}


if (get_the_tags()) {
	$tgsarray = array();
	
	foreach (get_the_tags() as $tagone) {
		$tgsarray[] = $tagone->term_id;
	}
} else {
	$tgsarray = '';
}


if ($cmsmasters_post_more_posts != 'hide') {
	schule_related( 
		'h3', 
		esc_html__('More posts', 'schule'), 
		esc_html__('No posts found', 'schule'), 
		$cmsmasters_post_more_posts, 
		$tgsarray, 
		$cmsmasters_option['schule' . '_blog_more_posts_count'], 
		$cmsmasters_option['schule' . '_blog_more_posts_pause'], 
		'post' 
	);
}


$get_post = get_post( get_the_ID() );
$show_ping = ( 'open' === $get_post->ping_status );

if ( $show_ping ) {
	echo schule_get_pings( get_the_ID(), 'h3' );
}


comments_template();

