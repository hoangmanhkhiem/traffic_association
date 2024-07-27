<?php
/**
 * Template for displaying a message and list courses require.
 *
 * @since 4.0.6
 * @version 1.0.0
 * @author thimpress
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$message = __(
	'NOTE: You have to pass these courses before you can enroll this course.',
	'learnpress-prerequisites-courses'
);

/**
 * @var LP_User_Item_Course[] $users_courses
 */
if ( ! isset( $users_courses ) ) {
	return;
}

wp_enqueue_style( 'lp-prerequisites-courses' );
?>
<div class="lp-prerequisite">
	<p class="learn-press-message warning"><?php echo esc_html( $message ); ?></p>
	<ul class="list-course-prerequisite">
		<?php
		foreach ( $users_courses as $data ) {
			/**
			 * @var LP_Course $course
			 * @var LP_User_Item_Course|false $user_course
			 */
			$course = $data->course;
			$user_course = $data->user_course;
			?>
			<li class="<?php echo esc_attr( $user_course ? $user_course->get_graduation() : '' ); ?>">
				<a href="<?php echo esc_url_raw( $course->get_permalink() ); ?>">
					<?php echo $course->get_title(); ?>
					<?php if ( $user_course && $user_course->get_graduation() ) { ?>
					<span class="lp-course-prerequisite-status"><?php echo sprintf( '(%s)', learn_press_course_grade_html( $user_course->get_graduation(), false ) ); ?></span>
					<?php } ?>
				</a>
			</li>
			<?php
		}
		?>
	</ul>
</div>


