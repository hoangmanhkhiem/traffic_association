<?php
/**
 * Template for displaying form submit review.
 */

if ( ! isset( $user ) || ! isset( $course_id ) ) {
	return;
}

if ( ! $user->has_course_status( $course_id, [ LP_COURSE_ENROLLED, LP_COURSE_FINISHED ] )
|| learn_press_get_user_rate( $course_id ) ) {
	return;
}
?>

<button class="write-a-review lp-button"><?php _e( 'Write a review', 'learnpress-course-review' ); ?></button>
<div class="course-review-wrapper">
	<div class="review-form" id="review-form">
		<form>
			<h4>
				<?php _e( 'Write a review', 'learnpress-course-review' ); ?>
				<a href="" class="close"><i class="fas fa-times"></i></a>
			</h4>
			<ul class="review-fields">
				<?php do_action( 'learn_press_before_review_fields' ); ?>
				<li>
					<label><?php _e( 'Title', 'learnpress-course-review' ); ?> <span class="required">*</span></label>
					<input type="text" name="review_title"/>
				</li>
				<li>
					<label><?php _e( 'Content', 'learnpress-course-review' ); ?><span class="required">*</span></label>
					<textarea name="review_content"></textarea>
				</li>
				<li>
					<label><?php _e( 'Rating', 'learnpress-course-review' ); ?><span class="required">*</span></label>
					<ul class="review-stars">
						<?php for ( $i = 1; $i <= 5; $i ++ ) { ?>
							<li class="review-title" title="<?php echo $i; ?>">
								<span>
									<?php echo LP_Addon_Course_Review::get_svg_star() ?>
								</span>
							</li>
						<?php } ?>
					</ul>
				</li>
				<?php do_action( 'learn_press_after_review_fields' ); ?>
				<li class="review-actions">
					<button type="button" class="lp-button submit-review"
							data-id="<?php echo $course_id; ?>">
						<?php _e( 'Add review', 'learnpress-course-review' ); ?>
					</button>
					<button type="button" class="lp-button close">
						<?php _e( 'Cancel', 'learnpress-course-review' ); ?>
					</button>
					<span class="ajaxload"></span>
					<span class="error"></span>
					<?php wp_nonce_field( 'learn_press_course_review_' . get_the_ID(), 'review-nonce' ); ?>
					<input type="hidden" name="rating" value="0">
					<input type="hidden" name="lp-ajax" value="add_review">
					<input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
					<input type="hidden" name="empty_title" value="<?php echo __( 'Please enter the review title', 'learnpress-course-review' ); ?>">
					<input type="hidden" name="empty_content" value="<?php echo __( 'Please enter the review content', 'learnpress-course-review' ); ?>">
					<input type="hidden" name="empty_rating" value="<?php echo __( 'Please select your rating', 'learnpress-course-review' ); ?>">
				</li>
			</ul>
		</form>
	</div>
</div>
