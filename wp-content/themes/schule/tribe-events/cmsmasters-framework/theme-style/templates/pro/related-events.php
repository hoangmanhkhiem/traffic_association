<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


$posts = tribe_get_related_posts();

if ( is_array( $posts ) && ! empty( $posts ) ) : ?>

<h2 class="tribe-events-related-events-title"><?php printf( esc_html__( 'Related %s', 'schule' ), tribe_get_event_label_plural() ); ?></h2>

<ul class="tribe-related-events tribe-clearfix hfeed vcalendar clearfix">
	<?php foreach ( $posts as $post ) : ?>
	<li>
		<div class="tribe-related-events-thumbnail">
			<a href="<?php echo esc_url( tribe_get_event_link( $post ) ); ?>" class="url" rel="bookmark">
				<?php echo (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail($post->ID, 'cmsmasters-project-thumb') : '<span class="cmsmasters_events_img_placeholder cmsmasters_theme_icon_image"></span>'; ?>
			</a>
		</div>
		<div class="tribe-related-event-info">
			<h4 class="tribe-related-events-title summary"><a href="<?php echo esc_url(tribe_get_event_link( $post )); ?>" class="url" rel="bookmark"><?php echo esc_html(get_the_title( $post->ID )); ?></a></h4>
		</div>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>