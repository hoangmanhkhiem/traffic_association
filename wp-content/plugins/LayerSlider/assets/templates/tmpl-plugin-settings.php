<?php

defined( 'LS_ROOT_FILE' ) || exit;

$custom_capability = $custom_role = get_option('layerslider_custom_capability', 'manage_options');
$ls_google_fonts_enabled = get_option('layerslider-google-fonts-enabled', true );
$ls_google_fonts_host_locally = get_option('layerslider-google-fonts-host-locally', false );
$custom_locale = get_option('ls_custom_locale', 'auto' );

$default_capabilities = [
	'manage_network',
	'manage_options',
	'publish_pages',
	'publish_posts',
	'edit_posts'
];

if( in_array( $custom_capability, $default_capabilities ) ) {
	$custom_capability = '';
} else {
	$custom_role = 'custom';
}

$googleFonts = get_option( 'ls-google-fonts', [] );

?>

<div class="ls-hidden">
	<div id="tmpl-plugin-settings-sidebar">
		<div class="kmw-sidebar-title">
			<?= __('LayerSlider Settings', 'LayerSlider') ?>
		</div>
		<kmw-navigation class="km-tabs-list" data-target="#ls-plugin-settings-tabs">

			<kmw-menuitem class="kmw-active">
				<?= lsGetSVGIcon('cog', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('General', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem>
				<?= lsGetSVGIcon('font-case', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Google Fonts', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem>
				<?= lsGetSVGIcon('puzzle-piece', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Integrations', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem>
				<?= lsGetSVGIcon('tachometer-alt-fast', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Performance', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem>
				<?= lsGetSVGIcon('tools', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Troubleshooting', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem>
				<?= lsGetSVGIcon('layer-group', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Project Defaults', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem>
				<?= lsGetSVGIcon('ellipsis-h', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Miscellaneous', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

		</kmw-navigation>
	</div>

	<div id="tmpl-plugin-settings-content">

		<kmw-h1 class="kmw-modal-title"><?= __('Permissions', 'LayerSlider') ?></kmw-h1>

		<form method="post" id="ls-plugin-settings-content">

			<input type="hidden" name="action" value="ls_save_plugin_settings">
			<?php wp_nonce_field('ls-save-plugin-settings'); ?>

			<div id="ls-plugin-settings-tabs" class="km-tabs-content">

				<!-- Permissions -->
				<div class="kmw-active">

					<table class="ls-settings-table">
						<tbody>
							<tr>
								<td><?php _e('Language:', 'LayerSlider') ?></td>
								<td>
									<select name="ls_custom_locale">
										<option value="auto" <?php echo ( $custom_locale === 'auto' ) ? 'selected' : ''?>><?php _e('Site default', 'LayerSlider') ?></option>
										<option value="en_US" <?php echo ( $custom_locale === 'en_US' ) ? 'selected' : ''?>>English (United States)</option>
										<option value="fr_FR" <?php echo ( $custom_locale === 'fr_FR' ) ? 'selected' : ''?>>Français</option>
										<option value="hu_HU" <?php echo ( $custom_locale === 'hu_HU' ) ? 'selected' : ''?>>Magyar</option>
										<option value="uk" <?php echo ( $custom_locale === 'uk' ) ? 'selected' : ''?>>Українська</option>
									</select>
								</td>
								<td><?php echo sprintf(__('You can change the default site language in %sSettings → General%s or in your %sprofile settings%s.', 'LayerSlider'), '<a href="'.admin_url('options-general.php').'">', '</a>', '<a href="'.admin_url('profile.php').'">', '</a>') ?>
								</td>
							</tr>

							<tr>
								<td>
									<?= __('WordPress Role', 'LayerSlider') ?>
								</td>
								<td>
									<select name="custom_role">
										<?php if( is_multisite() ) : ?>
										<option value="manage_network" <?= ($custom_role == 'manage_network') ? 'selected="selected"' : '' ?>> <?= __('Super Admin', 'LayerSlider') ?></option>
										<?php endif; ?>
										<option value="manage_options" <?= ($custom_role == 'manage_options') ? 'selected="selected"' : '' ?>> <?= __('Admin', 'LayerSlider') ?></option>
										<option value="publish_pages" <?= ($custom_role == 'publish_pages') ? 'selected="selected"' : '' ?>> <?= __('Editor, Admin', 'LayerSlider') ?></option>
										<option value="publish_posts" <?= ($custom_role == 'publish_posts') ? 'selected="selected"' : '' ?>> <?= __('Author, Editor, Admin', 'LayerSlider') ?></option>
										<option value="edit_posts" <?= ($custom_role == 'edit_posts') ? 'selected="selected"' : '' ?>> <?= __('Contributor, Author, Editor, Admin', 'LayerSlider') ?></option>
										<option value="custom" <?= ($custom_role == 'custom') ? 'selected="selected"' : '' ?>> <?= __('Custom', 'LayerSlider') ?></option>
									</select>
								</td>
								<td>
									<?= __('Choose the groups of users who will be able to access LayerSlider and manage your projects.', 'LayerSlider') ?>
								</td>
							</tr>


							<tr>
								<td>
									<?= __('Capability', 'LayerSlider') ?>
								</td>
								<td>
									<input type="text" name="custom_capability" value="<?= $custom_capability ?>" placeholder="<?= __('Custom capability', 'LayerSlider') ?>">
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>


				<!-- Google Fonts -->
				<div>

					<table class="ls-settings-table">
						<tr>
							<td>
								<?= __('Enable Google Fonts', 'LayerSlider') ?>
							</td>
							<td>
								<?= lsGetSwitchControl([
									'name' => 'ls_google_fonts_status',
									'checked' => $ls_google_fonts_enabled,

									// TODO: Add this back later: <br><br> <b>To comply with GDPR, you can host fonts from a local cache by turning on the “Host Fonts Locally” switch.</b>
									'data-warning-disable' => __("Many of our importable project templates use and rely on Google Fonts. If you turn off this feature, you may be unable to add custom fonts, and the appearance of textual content might be compromised in projects. <br><br> Are you sure you want to disable Google Fonts?", 'LayerSlider')
								])?>
							</td>
							<td>
								<?= __('Making the web more beautiful, fast, and open through great typography. Google Fonts provides over a thousand of web-optimized fonts that you can use in your projects.', 'LayerSlider') ?>
							</td>
						</tr>
						<!-- <tr class="ls-show-if-google-fonts-enabled">
							<td>
								<?= __('Host Fonts Locally', 'LayerSlider') ?>
							</td>
							<td>
							<?= lsGetSwitchControl([
									'name' => 'ls_google_fonts_local_cache',
									'checked' => $ls_google_fonts_host_locally
								])?>
							</td>
							<td>
								<?= __('You can host fonts from a local cache to ensure full compliance with GDPR and EU regulations.', 'LayerSlider') ?>
							</td>
						</tr> -->
					</table>



					<div class="ls-show-if-google-fonts-enabled">
						<div class="ls-notification-info solid">
							<?= lsGetSVGIcon('info-circle') ?>
							<?= sprintf(__('Consider adding Google Fonts %sin the Project Editor%s for convenience and better performance. Fonts added here will be loaded globally, even if they aren’t used.', 'LayerSlider'), '<a href="https://layerslider.com/media/help/project-editor-google-fonts@2x.png" target="_blank">', '</a>') ?>
						</div>

						<ls-div class="ls--form-control">
							<ls-div class="ls--button ls--bg-lightgray ls--white ls-open-fonts-library"><?= __('Add New Font', 'LayerSlider') ?></ls-div>

							<?php if( is_array( $googleFonts ) && ! empty( $googleFonts ) ) : ?>
							<a href="<?= wp_nonce_url( admin_url( 'admin.php?page=layerslider&action=empty_google_fonts' ), 'empty_google_fonts') ?>" class="ls--button ls--bg-light ls--white ls--float-right ls-empty-google-fonts"><?= __('Remove All Fonts', 'LayerSlider') ?></a>
							<?php endif ?>
						</ls-div>
						<ls-div id="ls-global-google-fonts-nonce" class="ls-d-none"><?= wp_create_nonce( 'save-google-fonts' ) ?></ls-div>
						<ls-p id="ls-global-google-fonts">
							<?php
								if( is_array( $googleFonts ) && ! empty( $googleFonts ) ) {
								foreach( $googleFonts as $item ) {
									$fontNameParts 	= explode(':', $item['param']);
									$fontName 		= str_replace('+', ' ', $fontNameParts[0] );
							?>
							<ls-div class="ls-font-item">
								<ls-div class="ls-font-name" style="font-family: '<?= $fontName ?>';"><?= $fontName ?></ls-div>
								<?= lsGetSVGIcon('times', false, ['class' => 'ls-remove-font' ]) ?>
							</ls-div>
							<?php } } ?>
							<ls-div class="ls-font-placeholder"></ls-div>
							<ls-div class="ls-font-placeholder"></ls-div>
							<ls-div class="ls-font-placeholder"></ls-div>
						</ls-p>

						<ls-div id="ls-font-item-template" class="ls-d-none">
							<ls-div class="ls-font-item">
								<?= lsGetSVGIcon('times', false, ['class' => 'ls-remove-font' ]) ?>
								<ls-div class="ls-font-name"></ls-div>
							</ls-div>
						</ls-div>
					</div>

				</div>


				<!-- Integrations -->
				<div>
					<ls-h5><?= __('WPML / Polylang', 'LayerSlider') ?></ls-h5>
					<table class="ls-settings-table">
						<tr>
							<td><?= __('String Translation', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('wpml_string_translation', true ) ?></td>
							<td><?= sprintf(__('When enabled, LayerSlider will automatically register the strings used in your projects to be translated on multilingual sites. %sPolylang doesn’t support an “untranslated” state for strings.%s If you use Polylang instead of WPML, you should either actively maintain translations or consider disabling this option to avoid issues where your projects’ content doesn’t reflect the changes made in the editor.', 'LayerSlider'), '<br><br><b>', '</b>') ?></td>
						</tr>
						<tr>
							<td><?= __('Media Translation', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('wpml_media_translation', true ) ?></td>
							<td><?= __('Media Translation allows you to translate images. You can provide language-specific alternative versions of the images in your Media Library, and LayerSlider will automatically show the right one. Consider disabling this feature if you use Media Translation on your site but don’t want images in your projects to be changed.', 'LayerSlider') ?></td>
						</tr>
					</table>

					<ls-h5><?= __('Page Builders', 'LayerSlider') ?></ls-h5>
					<table class="ls-settings-table">
						<tr>
							<td><?= __('Enable TinyMCE helper', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('tinymce_helper', true ) ?></td>
							<td><?= __('Allows the LayerSlider helper utility for the classic WordPress page editor, which makes it easy to insert projects into your pages. Disable only if you’re experiencing issues with the editor.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Enable Gutenberg block', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('gutenberg_block', true ) ?></td>
							<td><?= __('Allows the LayerSlider block for  WordPress’s new Gutenberg page editor, which makes it easy to insert projects into your pages. Disable only if you’re experiencing issues with the editor.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Enable Elementor widget', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('elementor_widget', true ) ?></td>
							<td><?= __('Allows the LayerSlider widget for Elementor, which makes it easy to insert projects into your pages. Disable only if you’re experiencing issues with the editor.', 'LayerSlider') ?></td>
						</tr>
					</table>
				</div>


				<!-- Performance -->
				<div>
					<table class="ls-settings-table">

						<tr>
							<td><?= __('Performance mode', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('performance_mode', true ) ?></td>
							<td><?= __('Performance mode suspends every background activity when your sliders are out of the viewport and not visible. This can dramatically increase performance on pages with many sliders. However, it also means that media playback will stop, and sliders won’t progress further in the background.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Use markup caching', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('use_cache', false) ?></td>
							<td>
								<?= __('Enabling caching can drastically increase the plugin performance and spare your server from unnecessary load. However, this might be unnecessary if you already have a caching plugin, and it might cause issues for localization plugins.', 'LayerSlider') ?>
									<a class="ls-button" href="<?= wp_nonce_url( admin_url( 'admin.php?page=layerslider&action=empty_caches' ), 'empty_caches') ?>" class="button button-small"><?= __('Empty caches', 'LayerSlider') ?></a>
							</td>
						</tr>

						<tr>
							<td><?= __('Include scripts in the footer', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('include_at_footer', false) ?></td>
							<td><?= __('Including resources in the footer can improve load times and solve other type of issues. Outdated themes might not support this method.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Conditional script loading', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('conditional_script_loading', false) ?></td>
							<td><?= __('Increase your site’s performance by loading resources only when necessary. Outdated themes might not support this method.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Concatenate output', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('concatenate_output', false) ?></td>
							<td><?= __('Concatenating the plugin’s output could solve issues caused by custom filters your theme might use.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Defer JavaScript loading', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('defer_scripts', false) ?></td>
							<td><?= __('Eliminates render-blocking JavaScript files, but might also delay a bit displaying projects above the fold.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Use “loading” attribute', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('use_loading_attribute', false) ?></td>
							<td><?= __('Enables the use of the HTML native lazy loading feature. LayerSlider has its own lazy loading mechanism more suitable for general use and we recommend leaving this option off.', 'LayerSlider') ?></td>
						</tr>
					</table>
				</div>


				<!-- Troubleshooting -->
				<div>
					<div class="ls-notification-info solid">
						<?= lsGetSVGIcon('info-circle') ?>
						<?= sprintf( __('Visiting %sSystem Status%s is recommended if you’re experiencing issues on your site or with LayerSlider.', 'LayerSlider'), '<a href="'.admin_url( 'admin.php?page=layerslider&section=system-status' ).'" target="_blank">', '</a>') ?>
					</div>

					<table class="ls-settings-table">
						<tr>
							<td><?= __('Clear 3rd party caches', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('clear_3rd_party_caches', true) ?></td>
							<td><?= __('Attempts to automatically clear the caches of the most popular caching plugins. It can help to avoid certain issues like changes not showing up on your front-end pages.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('No-conflict mode', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('admin_no_conflict_mode', false, [ 'data-warning-enable' => __('Do not enable this option unless you’re experiencing issues on LayerSlider’s admin screens. This option can be helpful in some cases but can easily cause other issues and side effects. Do you want to proceed?', 'LayerSlider') ]) ?></td>
							<td><?= __('Removes extraneous scripts and styles on LayerSlider admin pages to reduce conflicts with 3rd party plugins and themes. Disable this option if you experience any issue.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('RocketScript compatibility', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('rocketscript_ignore', false) ?></td>
							<td><?= __('Enable this option to ignore LayerSlider files by CloudFlare’s Rocket Loader, which can help overcoming potential issues.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Always load all JavaScript files', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('load_all_js_files', false) ?></td>
							<td><?= __('Enabling this option will likely help if you’re experiencing issues with CDN services or JavaScript minify/combine features in a 3rd party plugin. However, it can also negatively impact performance since resources will not be loaded conditionally.', 'LayerSlider' ) ?></td>
						</tr>

						<tr>
							<td><?= __('Use GreenSock (GSAP) sandboxing', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('gsap_sandboxing', true, [
								'data-warning-disable' => __('Leaving this option enabled is strongly recommended to maximize compatibility with other plugins and themes. Disabling it might cause unexpected issues. Do you wish to proceed?', 'LayerSlider')
							]) ?></td>
							<td><?= __('Enabling GreenSock sandboxing can solve issues when other plugins are using multiple/outdated versions of this library.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Use Google CDN version of jQuery', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('use_custom_jquery', false, [ 'data-warning-enable' => __('Do not enable this option unless you’re experiencing issues with jQuery on your site. This option can easily cause unexpected issues when used incorrectly. Do you want to proceed?', 'LayerSlider') ]) ?></td>
							<td><?= __('This option will likely solve “Old jQuery” issues, but can easily have other side effects. Use it only when it is necessary.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Scripts priority', 'LayerSlider') ?></td>
							<td><?= lsGetOptionField('text', 'scripts_priority', 3, [ 'class' => 'ls--mini', 'placeholder' => 3 ] ) ?></td>
							<td><?= __('Used to specify the order in which scripts are loaded. Lower numbers correspond with earlier execution.', 'LayerSlider') ?></td>
						</tr>

					</table>

				</div>

				<!-- Project Defaults -->
				<div>
					<table class="ls-settings-table">


						<tr>
							<td><?= __('Use srcset attribute', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('use_srcset', true ) ?></td>
							<td><?= __('The srcset attribute allows loading dynamically scaled images based on screen resolution. It can save bandwidth and allow using retina-ready images on high resolution devices. In some rare edge cases, this option might cause blurry images.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Enhanced lazy load', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('enhanced_lazy_load', false ) ?></td>
							<td><?= __('The default lazy loading behavior ensures maximum compatibility and works ideally for general purposes. However, there is a chance that the browser might start downloading some assets for a split second before LayerSlider cancels them. Enabling this option will eliminate any chance of generating even a minuscule amount of unwanted traffic, but it can also cause issues for search engine indexing and other WP themes/plugins.', 'LayerSlider') ?></td>
						</tr>
					</table>
				</div>

				<!-- Miscellaneous -->
				<div>
					<table class="ls-settings-table">

						<tr>
							<td><?= __('Enable “Play By Scroll”', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('enable_play_by_scroll', false) ?></td>
							<td><?= __('“Play By Scroll” is a discontinued feature replaced by Scroll Scene. Sliders using “Play By Scroll” remain working as expected, but we’re hiding this feature by default due to its deprecation and eventual removal from LayerSlider.', 'LayerSlider') ?></td>
						</tr>

						<tr>
							<td><?= __('Suppress debug info', 'LayerSlider') ?></td>
							<td><?= lsGetSwitchOptionField('suppress_debug_info', false) ?></td>
							<td><?= __('Hides useful information such as the version number in the browser’s debug console and in the site HTML markup. We recommend leaving this option disabled as it can be a significant help for debugging and supporting LayerSlider.', 'LayerSlider') ?></td>
						</tr>

					</table>
				</div>
			</div>
		</form>

	</div>
</div>
</script>