<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * CMSMasters Donations Single Campaign Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = schule_get_global_options();


$campaign_tags = get_the_terms(get_the_ID(), 'cp-tags');


$cmsmasters_campaign_sharing_box = get_post_meta(get_the_ID(), 'cmsmasters_campaign_sharing_box', true);

$cmsmasters_campaign_author_box = get_post_meta(get_the_ID(), 'cmsmasters_campaign_author_box', true);

$cmsmasters_campaign_more_posts = get_post_meta(get_the_ID(), 'cmsmasters_campaign_more_posts', true);

$cmsmasters_campaign_title = get_post_meta(get_the_ID(), 'cmsmasters_campaign_title', true);

?>
<!-- Start Standard Campaign -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cmsmasters_campaign_cont">
	<?php
		if (!post_password_required() && has_post_thumbnail()) {
			schule_thumb_rollover(get_the_ID(), 'post-thumbnail', true, false, false, false, false, true, false);
		}
		
		
		echo '<div class="campaign_meta_wrap">';
		
			schule_donations_campaign_target(get_the_ID(), true);
			
			schule_donations_campaign_donations_count(get_the_ID(), true);
			
			schule_donations_campaign_donated(get_the_ID(), 'post');
			
			schule_donations_campaign_donate_button(get_the_ID(), true);
			
		echo '</div>';
		
		
		if ($cmsmasters_campaign_title == 'true') {
			schule_donations_campaign_heading(get_the_ID(), 'h2', false);
		}
		
		
		if ( 
			$cmsmasters_option['schule' . '_donations_campaign_date'] || 
			$cmsmasters_option['schule' . '_donations_campaign_author'] || 
			$cmsmasters_option['schule' . '_donations_campaign_cat'] || 
			$cmsmasters_option['schule' . '_donations_campaign_tag'] || 
			$cmsmasters_option['schule' . '_donations_campaign_like'] || 
			$cmsmasters_option['schule' . '_donations_campaign_comment'] 
		) {
			echo '<div class="cmsmasters_campaign_cont_info entry-meta' . ((get_the_content() == '') ? ' no_bdb' : '') . '">';
				
				schule_donations_campaign_date('post');
				
				schule_donations_campaign_category(get_the_ID(), 'cp-categs', 'post');
				
				schule_donations_campaign_author('post');
				
				schule_donations_campaign_tags(get_the_ID(), 'cp-tags', 'post');	
				
				
			echo '</div>';
		}
		
		
		if (get_the_content() != '') {
			echo '<div class="cmsmasters_campaign_content entry-content">';
				
				the_content();
				
				
				wp_link_pages(array( 
					'before' => '<div class="subpage_nav">' . '<strong>' . esc_html__('Pages', 'schule') . ':</strong>', 
					'after' => '</div>', 
					'link_before' => ' [ ', 
					'link_after' => ' ] ' 
				));

		if ( 
					$cmsmasters_option['schule' . '_donations_campaign_like'] || 
					$cmsmasters_option['schule' . '_donations_campaign_comment'] 
				) {
					echo '<div class="cmsmasters_campaign_meta_info">';
						
						schule_donations_campaign_comments('post');
						
						schule_donations_campaign_like('post');
						
					echo '</div>';
				}
				
			echo '<div class="cl"></div>' . 
			'</div>';
		}
	?>
	</div>
</article>
<!-- Finish Standard Campaign -->
<?php

if ($cmsmasters_campaign_sharing_box == 'true') {
	schule_sharing_box(esc_html__('Share this campaign?', 'schule'), 'h4');
}


if ($cmsmasters_campaign_author_box == 'true') {
	schule_author_box(esc_html__('About author', 'schule'), 'h4');
}


if ($campaign_tags) {
	$tgsarray = array();
	
	foreach ($campaign_tags as $tagone) {
		$tgsarray[] = $tagone->term_id;
	}  
} else {
	$tgsarray = '';
}


if ($cmsmasters_campaign_more_posts != 'hide') {
	schule_donations_related( 
		'h4', 
		esc_html__('More campaigns', 'schule'), 
		esc_html__('No campaigns found', 'schule'), 
		$cmsmasters_campaign_more_posts, 
		$tgsarray, 
		$cmsmasters_option['schule' . '_donations_more_campaigns_count'], 
		$cmsmasters_option['schule' . '_donations_more_campaigns_pause'], 
		'campaign', 
		'cp-tags' 
	);
}


comments_template();

