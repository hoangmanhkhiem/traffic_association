<?php
/**
 * Template for displaying message if user has submitted review and it is awaiting approve.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.2
 */

if ( ! isset( $course_id ) ) {
	return;
}

$args           = array(
	'user_id' => learn_press_get_current_user_id(),
	'post_id' => $course_id,
);
$comments_count = get_comments( $args );

if ( ! empty( $comments_count ) && ! $comments_count[0]->comment_approved ) {
	echo sprintf(
		'<div class="learn-press-message success">%s</div>',
		__( 'Your review has been submitted and is awaiting approve.', 'learnpress-course-review' )
	);
}
