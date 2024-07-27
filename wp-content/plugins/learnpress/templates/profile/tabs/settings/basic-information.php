<?php
/**
 * Template for displaying editing basic information form of user in profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/settings/tabs/basic-information.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.1
 */

defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();

if ( ! isset( $section ) ) {
	$section = 'basic-information';
}

$user = $profile->get_user();
?>

<form method="post" id="learn-press-profile-basic-information" name="profile-basic-information" enctype="multipart/form-data" class="learn-press-form">

	<?php do_action( 'learn-press/before-profile-basic-information-fields', $profile ); ?>

	<ul class="form-fields">

		<?php do_action( 'learn-press/begin-profile-basic-information-fields', $profile ); ?>


		<li class="form-field form-field__first-name form-field__50">
			<label for="first_name"><?php esc_html_e( 'First name', 'learnpress' ); ?></label>
			<div class="form-field-input">
				<input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $user->get_data( 'first_name' ) ); ?>" class="regular-text">
			</div>
		</li>
		<li class="form-field form-field__last-name form-field__50">
			<label for="last_name"><?php esc_html_e( 'Last name', 'learnpress' ); ?></label>
			<div class="form-field-input">
				<input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $user->get_data( 'last_name' ) ); ?>" class="regular-text">
			</div>
		</li>
		<li class="form-field form-field__last-name form-field__50">
			<label for="account_display_name"><?php esc_html_e( 'Display name', 'learnpress' ); ?><span class="required">*</span></label>
			<div class="form-field-input">
				<input type="text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->get_data( 'display_name' ) ); ?>" class="regular-text">
			</div>
		</li>
		<li class="form-field form-field__last-name form-field__50">
			<label for="account_email"><?php esc_html_e( 'Email address', 'learnpress' ); ?><span class="required">*</span></label>
			<div class="form-field-input">
				<input type="email" name="account_email" id="account_email" value="<?php echo esc_attr( $user->get_data( 'email' ) ); ?>" class="regular-text">
			</div>
		</li>

		<li class="form-field form-field__bio form-field__clear">
			<label for="description"><?php esc_html_e( 'Biographical Info', 'learnpress' ); ?></label>
			<div class="form-field-input">
				<?php
				echo sprintf(
					'%s%s%s',
					'<textarea name="description" id="description" rows="5" cols="30">',
					esc_html( $user->get_data( 'description' ) ),
					'</textarea>'
				);
				?>
				<p class="description"><?php esc_html_e( 'Share a little biographical information to fill out your profile. This may be shown publicly.', 'learnpress' ); ?></p>
			</div>
		</li>

		<?php
		do_action( 'learn-press/profile/layout/general-info-custom', $profile );

		// Social button.
		$socials = learn_press_get_user_extra_profile_info( $user->get_id() );
		if ( $socials ) {
			foreach ( $socials as $k => $v ) {
				if ( ! learn_press_is_social_profile( $k ) ) {
					continue;
				}
				?>

				<li class="form-field form-field__profile-social form-field__50 form-field__<?php echo esc_attr( $k ); ?>">
					<label for="description"><?php echo learn_press_social_profile_name( $k ); ?></label>
					<div class="form-field-input">
						<input type="text" value="<?php echo esc_attr( $v ); ?>" name="user_profile_social[<?php echo esc_attr( $k ); ?>]" placeholder="https://">
					</div>
				</li>
				<?php
			}
		}
		?>

		<?php do_action( 'learn-press/end-profile-basic-information-fields', $profile ); ?>
	</ul>

	<?php do_action( 'learn-press/after-profile-basic-information-fields', $profile ); ?>

	<p>
		<input type="hidden" name="save-profile-basic-information" value="<?php echo wp_create_nonce( 'learn-press-save-profile-basic-information' ); ?>"/>
	</p>

	<button type="submit" name="submit"><?php esc_html_e( 'Save changes', 'learnpress' ); ?></button>

</form>
