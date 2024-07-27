<?php
/**
 * Template for displaying thumbnail of course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/thumbnail.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

defined( 'ABSPATH' ) || exit();

$course = learn_press_get_course();

if ( ! $course ) {
	return;
}
?>

<div class="course-thumbnail">
	<a href="<?php the_permalink(); ?>">
<!--		<div class="thumbnail">-->
			<?php echo wp_kses_post( $course->get_image( 'course_thumbnail' ) ); ?>
<!--		</div>-->
	</a>
</div>
