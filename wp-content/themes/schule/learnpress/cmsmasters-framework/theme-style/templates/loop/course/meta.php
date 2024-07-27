<?php
/**
 * @cmsmasters_package 	Schule
 * @cmsmasters_version 	1.1.6
 */

defined( 'ABSPATH' ) || exit;

global $post;

$content = $post->post_excerpt;

if ( empty($content) ) {
    $content = $post->post_content;
}
?>

<div class="course-excerpt"><?php echo wp_trim_words( $content, 25 ); ?></div>
