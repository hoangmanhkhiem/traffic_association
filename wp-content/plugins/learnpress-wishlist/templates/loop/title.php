<?php

/**
 * Template for displaying loop wishlist title.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/wishlist/loop/title.php.
 *
 * @author  ThimPress
 * @package LearnPress/Wishlist/Templates
 * @version 3.0.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
global $post;
$course = learn_press_get_course( $post->ID );
?>
<?php echo $course->get_image(); ?>
<h3><?php the_title(); ?></h3>
