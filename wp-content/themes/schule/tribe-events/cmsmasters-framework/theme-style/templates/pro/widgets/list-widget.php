<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.0.1
 */


// Retrieves the posts used in the List Widget loop.
$posts = tribe_get_list_widget_events();

// The URL for this widget's "View More" link.
$link_to_all = tribe_events_get_list_widget_view_all_link( $instance );

// Check if any posts were found.
if ( isset( $posts ) && $posts ) : ?>
	<ol class="hfeed vcalendar">
	<?php foreach ( $posts as $post ) :
		setup_postdata( $post );
		do_action( 'tribe_events_widget_list_inside_before_loop' ); ?>

		<!-- Event  -->
		<li class="<?php tribe_events_event_classes() ?>">
			<?php tribe_get_template_part( 'pro/widgets/modules/single-event', null, $instance ) ?>
		</li><!-- .hentry .vevent -->

		<?php do_action( 'tribe_events_widget_list_inside_after_loop' ) ?>

	<?php endforeach ?>
	</ol><!-- .hfeed -->

	<p class="tribe-events-widget-link">
		<a href="<?php echo esc_url( $link_to_all ) ?>" rel="bookmark">
			<?php esc_html_e( 'View More&hellip;', 'schule' ) ?>
		</a>
	</p>

<?php
// No Events were found.
else:
?>
	<p><?php printf( esc_html__( 'There are no upcoming %s at this time.', 'schule' ), tribe_get_event_label_plural_lowercase() ); ?></p>
<?php
endif;

// Cleanup. Do not remove this.
wp_reset_postdata();