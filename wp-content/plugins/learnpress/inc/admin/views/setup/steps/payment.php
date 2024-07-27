<?php
/**
 * Template for displaying payments of setup wizard.
 *
 * @author  ThimPres
 * @package LearnPress/Admin/Views
 * @version 3.0.0
 */

defined( 'ABSPATH' ) or exit;

$wizard   = LP_Setup_Wizard::instance();
$payments = $wizard->get_payments();

?>
<h2><?php _e( 'Payment', 'learnpress' ); ?></h2>

<p class="large-text"><?php _e( 'LearnPress can accept both online and offline payments. Additional payment addons can be installed later.', 'learnpress' ); ?></p>

<ul class="browse-payments">
	<?php foreach ( $payments as $slug => $payment ) { ?>
		<li class="payment payment-<?php echo esc_attr( $slug ); ?>">
			<h3 class="payment-name">
				<?php if ( ! empty( $payment['icon'] ) ) { ?>
					<img src="<?php echo esc_url_raw( $payment['icon'] ); ?>">
				<?php } else { ?>
					<?php echo esc_html( $payment['name'] ); ?>
				<?php } ?>
			</h3>
			<?php if ( ! empty( $payment['desc'] ) ) { ?>
				<p class="payment-desc"><?php echo wp_kses_post( $payment['desc'] ); ?></p>
			<?php } ?>
			<div class="payment-settings">
				<?php call_user_func( $payment['callback'] ); ?>
			</div>
		</li>
	<?php } ?>
</ul>
