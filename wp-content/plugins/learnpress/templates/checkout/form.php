<?php
/**
 * Template for displaying checkout form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/checkout/form.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.4
 */

defined( 'ABSPATH' ) || exit();

$checkout = LearnPress::instance()->checkout();
?>
<?php
if ( ! is_user_logged_in() ) {
	?>
	<div class="learn-press-message error">
		<?php _e( 'Please log in to enroll in the course!', 'learnpress' ); ?>
	</div>
	<?php
}

learn_press_show_message();
?>
	<form method="post" id="learn-press-checkout-form" name="learn-press-checkout-form" class="lp-checkout-form"
		tabindex="0" action="<?php echo esc_url_raw( learn_press_get_checkout_url() ); ?>"
		enctype="multipart/form-data">
		<?php
		if ( has_action( 'learn-press/before-checkout-form' ) ) {
			?>
			<div class="lp-checkout-form__before">
				<?php do_action( 'learn-press/before-checkout-form' ); ?>
			</div>
			<?php
		}

		do_action( 'learn-press/checkout-form' );

		if ( has_action( 'learn-press/after-checkout-form' ) ) {
			?>
			<div class="lp-checkout-form__after">
				<?php do_action( 'learn-press/after-checkout-form' ); ?>
			</div>
			<?php
		}

		wp_nonce_field( 'learn-press-checkout', 'learn-press-checkout-nonce', false );
		?>
	</form>
<?php
