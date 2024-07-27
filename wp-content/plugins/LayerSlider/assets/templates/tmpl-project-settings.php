<?php

// Prevent direct file access
defined( 'LS_ROOT_FILE' ) || exit;

$sDefs  =& $lsDefaults['slider'];
$sProps =& $slider['properties'];

?>

<lse-b class="lse-dn">


	<lse-b id="lse-project-settings-sidebar">
		<lse-b class="kmw-sidebar-title">
			<?= __('Project Settings', 'LayerSlider') ?>
		</lse-b>
		<kmw-navigation class="km-tabs-list" data-target="#lse-project-settings-tabs">

			<kmw-menuitem data-deeplink="publish">
				<?= lsGetSVGIcon('calendar-alt', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Publish', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem class="kmw-active" data-deeplink="layout">
				<?= lsGetSVGIcon('expand-arrows-alt', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Layout', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="mobile">
				<?= lsGetSVGIcon('mobile-alt', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Mobile', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="slideshow">
				<?= lsGetSVGIcon('film', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Slideshow', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="appearance">
				<?= lsGetSVGIcon('palette', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Appearance', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="navigation">
				<?= lsGetSVGIcon('exchange', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Navigation', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="thumbnav">
				<?= lsGetSVGIcon('th-large', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Thumbnail Navigation', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="media">
				<?= lsGetSVGIcon('play-circle', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Video / Audio', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<!-- <kmw-menuitem data-deeplink="contentsources">
				<?= lsGetSVGIcon('box-open', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Content Sources', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem> -->

			<kmw-menuitem data-deeplink="performance">
				<?= lsGetSVGIcon('tachometer-alt-fastest', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Performance', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="defaults">
				<?= lsGetSVGIcon('sliders-v-square', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Defaults', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="misc">
				<?= lsGetSVGIcon('cog', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Miscellaneous', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-deeplink="" class="lse-callbacks-tab kmw-unselectable">
				<?= lsGetSVGIcon('brackets-curly', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Event Callbacks', 'LayerSlider') ?></kmw-menutext>
				<lse-badge class="lse-dn"></lse-badge>
			</kmw-menuitem>

		</kmw-navigation>

		<lse-b class="lse-project-settings-advanced">
			<label class="ls-switch lse-large" id="lse-show-advanced-settings">
				<input type="checkbox">
				<ls-switch></ls-switch>
				<lse-i><?= __('Advanced Settings', 'LayerSlider') ?></lse-i>
			</label>
		</lse-b>
	</lse-b>


	<lse-b id="lse-project-settings-content" class="lse-light-theme">
		<kmw-h1 class="kmw-modal-title">
			<?= __('Layout', 'LayerSlider') ?>
		</kmw-h1>

		<lse-b class="lse-project-settings">
			<input type="hidden" name="sliderVersion" value="<?= LS_PLUGIN_VERSION ?>">

			<lse-b id="lse-project-settings-tabs" class="km-tabs-content">

				<!-- Publish -->
				<lse-b data-category="<?= __('Publish', 'LayerSlider') ?>">

					<lse-h2><?= __('Project Name', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<tr>
									<td>
										<?php $sliderName = !empty($sProps['title']) ? htmlspecialchars(stripslashes($sProps['title'])) : ''; ?>
										<input class="lse-large" type="text" name="title" maxlength="100" value="<?= $sliderName ?>" id="title" autocomplete="off" placeholder="<?= __('Type your project name here', 'LayerSlider') ?>">

									</td>
								</tr>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Project Slug & Keywords', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<tr>
									<td class="lse-half">
										<input class="lse-large lse-must-be-validated" type="text" name="slug" maxlength="100" pattern="[A-Za-z0-9_\-]+" value="<?= !empty($sProps['slug']) ? htmlentities( $sProps['slug'] ) : '' ?>" autocomplete="off" placeholder="<?= __('slug: e.g. homepageslider', 'LayerSlider') ?>" data-tt=".tt-project-slug" data-tt-de="0">
										<input class="lse-large" type="text" name="keywords" maxlength="100" value="<?= !empty($sProps['keywords']) ? htmlentities( $sProps['keywords'] ) : '' ?>" autocomplete="off" placeholder="<?= __('keywords: e.g. mobile, promotion, socials', 'LayerSlider') ?>" data-tt=".tt-project-keywords" data-tt-de="0">
									</td>
								</tr>
							</tbody>
						</table>
					</lse-table-wrapper>



					<lse-tt class="tt-project-slug"><?= __('You can optionally set a custom project identifier to use in shortcodes instead of the database ID number. <br><br><b>No two projects can share the same slug. It needs to be unique and can contain only alphanumeric characters.</b>', 'LayerSlider') ?></lse-tt>
					<lse-tt class="tt-project-keywords"><?= __('Comma-separated list of keywords used for searching and organizing your projects.', 'LayerSlider') ?></lse-tt>

					<lse-h2><?= __('Status', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<tr>
									<td>
										<?php lsGetCheckbox($sDefs['status'], $sProps, [], false, [ 'class' => 'lse-large' ]); ?>
									</td>
									<td>
										<?= $sDefs['status']['desc'] ?>
									</td>
								</tr>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Schedule', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<thead>
								<tr>
									<th>
										<?= $sDefs['scheduleStart']['name'] ?>
									</th>
									<th>
										<?= $sDefs['scheduleEnd']['name'] ?>
									</th>
								</tr>
							</thead>
							<tbody class="lse-half">
								<tr>
									<td>
										<lse-b class="lse-datepicker-wrapper">
											<?php lsGetInput($sDefs['scheduleStart'], $sProps, [
												'class' => 'lse-datepicker-input lse-large',
												'data-datepicker-inline' => true,
												'data-datepicker-classes' => 'lse-datepicker-inline',
												'data-datepicker-key' => 'schedule_start'
											]); ?>
										</lse-b>
									</td>
									<td>
										<lse-b class="lse-datepicker-wrapper">
											<?php lsGetInput($sDefs['scheduleEnd'], $sProps, [
												'class' => 'lse-datepicker-input lse-large',
												'data-datepicker-inline' => true,
												'data-datepicker-classes' => 'lse-datepicker-inline',
												'data-datepicker-key' => 'schedule_end'
											]); ?>
										</lse-b>
									</td>
								</tr>
							</tbody>
						</table>
					</lse-table-wrapper>

				</lse-b>

				<!-- Layout -->
				<lse-b class="kmw-active" data-category="<?= __('Layout', 'LayerSlider') ?>">


					<lse-b id="lse-project-layouts" class="lse-children-can-be-selected">
						<lse-b class="lse-project-layout" data-layout="fixedsize">
							<svg xmlns="http://www.w3.org/2000/svg" width="124" class="lse-slider-type" height="84" viewBox="0 0 124 84">
								<g transform="translate(-6 -6)">
									<path class="lse-type-base" d="M14,8H122a6,6,0,0,1,6,6V82a6,6,0,0,1-6,6H14a6,6,0,0,1-6-6V14A6,6,0,0,1,14,8Z"/>
									<path class="lse-type-size" d="M29,23h78a6,6,0,0,1,6,6V67a6,6,0,0,1-6,6H29a6,6,0,0,1-6-6V29A6,6,0,0,1,29,23Z"/>
									<path class="lse-type-nav" d="M68,66a1,1,0,1,1-1,1A1,1,0,0,1,68,66Z"/>
									<path class="lse-type-nav" d="M72,66a1,1,0,1,1-1,1A1,1,0,0,1,72,66Z"/>
									<path class="lse-type-nav" d="M64,66a1,1,0,1,1-1,1A1,1,0,0,1,64,66Z"/>
									<path class="lse-type-nav" d="M104.884,51,108,48l-3.116-3-.884.839L106.245,48,104,50.161Z"/>
									<path class="lse-type-nav" d="M31.116,51,28,48l3.116-3,.884.839L29.755,48,32,50.161Z"/>
									<path class="lse-type-mountains" d="M117.227,199.883a4.084,4.084,0,1,0-4.084-4.084A4.084,4.084,0,0,0,117.227,199.883Zm17.97,2.179a2.042,2.042,0,0,0-3.267,0l-6.295,8.392-2.625-3.934a2.042,2.042,0,0,0-3.4,0l-6.469,9.7h32.673Z" transform="translate(-61.172 -155.555)"/>
								</g>
							</svg>
							<lse-b class="lse-project-layout-name"><?= __('Fixed size', 'LayerSlider') ?></lse-b>
						</lse-b>

						<lse-b class="lse-project-layout" data-layout="responsive">
							<svg xmlns="http://www.w3.org/2000/svg" width="124" height="84" viewBox="0 0 124 84" class="lse-slider-type">
								<g transform="translate(-6 -6)">
									<path class="lse-type-base" d="M14,8H122a6,6,0,0,1,6,6V82a6,6,0,0,1-6,6H14a6,6,0,0,1-6-6V14A6,6,0,0,1,14,8Z"/>
									<g id="resizer" transform="translate(113.998 73.998)">
										<path class="lse-type-nav" d="M7.2,3.994,8,8l-4-.8Z"/>
										<path class="lse-type-nav" d="M.8,4.006,0,0l4,.8Z"/>
									</g>
									<path class="lse-type-size" d="M29,23h78a6,6,0,0,1,6,6V67a6,6,0,0,1-6,6H29a6,6,0,0,1-6-6V29A6,6,0,0,1,29,23Z"/>
									<path class="lse-type-nav" d="M68,66a1,1,0,1,1-1,1A1,1,0,0,1,68,66Z"/>
									<path class="lse-type-nav" d="M72,66a1,1,0,1,1-1,1A1,1,0,0,1,72,66Z"/>
									<path class="lse-type-nav" d="M64,66a1,1,0,1,1-1,1A1,1,0,0,1,64,66Z"/>
									<path class="lse-type-nav" d="M104.884,51,108,48l-3.116-3-.884.839L106.245,48,104,50.161Z"/>
									<path class="lse-type-nav" d="M31.116,51,28,48l3.116-3,.884.839L29.755,48,32,50.161Z"/>
									<path class="lse-type-mountains" d="M117.227,199.883a4.084,4.084,0,1,0-4.084-4.084A4.084,4.084,0,0,0,117.227,199.883Zm17.97,2.179a2.042,2.042,0,0,0-3.267,0l-6.295,8.392-2.625-3.934a2.042,2.042,0,0,0-3.4,0l-6.469,9.7h32.673Z" transform="translate(-61.172 -155.555)"/>
								</g>
							</svg>
							<lse-b class="lse-project-layout-name"><?= __('Responsive', 'LayerSlider') ?></lse-b>
						</lse-b>

						<lse-b class="lse-project-layout" data-layout="fullwidth">
							<svg xmlns="http://www.w3.org/2000/svg" width="124" height="84" viewBox="0 0 124 84" class="lse-slider-type">
								<g transform="translate(-6 -6)">
									<path class="lse-type-base" d="M14,8H122a6,6,0,0,1,6,6V82a6,6,0,0,1-6,6H14a6,6,0,0,1-6-6V14A6,6,0,0,1,14,8Z"/>
									<path class="lse-type-size" d="M29,23H149V73H29Z" transform="translate(-21)"/>
								<path class="lse-type-nav" d="M68,66a1,1,0,1,1-1,1A1,1,0,0,1,68,66Z"/>
								<path class="lse-type-nav" d="M72,66a1,1,0,1,1-1,1A1,1,0,0,1,72,66Z"/>
								<path class="lse-type-nav" d="M64,66a1,1,0,1,1-1,1A1,1,0,0,1,64,66Z"/>
								<path class="lse-type-nav" d="M104.884,51,108,48l-3.116-3-.884.839L106.245,48,104,50.161Z" transform="translate(13)"/>
								<path class="lse-type-nav" d="M31.116,51,28,48l3.116-3,.884.839L29.755,48,32,50.161Z" transform="translate(-13)"/>
									<path class="lse-type-mountains" d="M117.227,199.883a4.084,4.084,0,1,0-4.084-4.084A4.084,4.084,0,0,0,117.227,199.883Zm17.97,2.179a2.042,2.042,0,0,0-3.267,0l-6.295,8.392-2.625-3.934a2.042,2.042,0,0,0-3.4,0l-6.469,9.7h32.673Z" transform="translate(-61.172 -155.555)"/>
								</g>
							</svg>
							<lse-b class="lse-project-layout-name"><?= __('Full width', 'LayerSlider') ?></lse-b>
						</lse-b>

						<lse-b class="lse-project-layout" data-layout="hero">
							<svg xmlns="http://www.w3.org/2000/svg" width="124" height="84" viewBox="0 0 124 84" id="lse-full-size-hero" class="lse-slider-type">
								<g transform="translate(-6 -6)">
									<path class="lse-type-base" d="M14,8H122a6,6,0,0,1,6,6V82a6,6,0,0,1-6,6H14a6,6,0,0,1-6-6V14A6,6,0,0,1,14,8Z"/>
								<rect class="lse-type-navmenu" width="8" height="3" rx="1.5" transform="translate(80 15)"/>
								<rect class="lse-type-navmenu" width="8" height="3" rx="1.5" transform="translate(92 15)"/>
								<rect class="lse-type-navmenu" width="8" height="3" rx="1.5" transform="translate(48 15)"/>
								<rect class="lse-type-navmenu" width="8" height="3" rx="1.5" transform="translate(36 15)"/>
								<rect class="lse-type-navmenu" width="12" height="5" rx="2.5" transform="translate(62 14)"/>
									<path class="lse-type-size" d="M29,23H146.158V86.023H29Z" transform="translate(-19.411 0.067)"/>
								<path class="lse-type-nav" d="M68,66a1,1,0,1,1-1,1A1,1,0,0,1,68,66Z" transform="translate(0 13)"/>
								<path class="lse-type-nav" d="M72,66a1,1,0,1,1-1,1A1,1,0,0,1,72,66Z" transform="translate(0 13)"/>
								<path class="lse-type-nav" d="M64,66a1,1,0,1,1-1,1A1,1,0,0,1,64,66Z" transform="translate(0 13)"/>
								<path class="lse-type-nav" d="M104.884,51,108,48l-3.116-3-.884.839L106.245,48,104,50.161Z" transform="translate(13)"/>
								<path class="lse-type-nav" d="M31.116,51,28,48l3.116-3,.884.839L29.755,48,32,50.161Z" transform="translate(-13)"/>
									<path class="lse-type-mountains" d="M117.227,199.883a4.084,4.084,0,1,0-4.084-4.084A4.084,4.084,0,0,0,117.227,199.883Zm17.97,2.179a2.042,2.042,0,0,0-3.267,0l-6.295,8.392-2.625-3.934a2.042,2.042,0,0,0-3.4,0l-6.469,9.7h32.673Z" transform="translate(-61.172 -155.555)"/>
								</g>
							</svg>
							<lse-b class="lse-project-layout-name"><?= __('Hero', 'LayerSlider') ?></lse-b>
						</lse-b>

						<lse-b class="lse-project-layout" data-layout="fullsize">
							<svg xmlns="http://www.w3.org/2000/svg" width="124" height="84" viewBox="0 0 124 84" class="lse-slider-type">
								<g transform="translate(-6 -6)">
									<path class="lse-type-base" d="M14,8H122a6,6,0,0,1,6,6V82a6,6,0,0,1-6,6H14a6,6,0,0,1-6-6V14A6,6,0,0,1,14,8Z"/>
									<path class="lse-type-size" d="M29,23H146.158V99.22H29Z" transform="translate(-19.411 -13.13)"/>
								<path class="lse-type-nav" d="M68,66a1,1,0,1,1-1,1A1,1,0,0,1,68,66Z" transform="translate(0 13)"/>
								<path class="lse-type-nav" d="M72,66a1,1,0,1,1-1,1A1,1,0,0,1,72,66Z" transform="translate(0 13)"/>
								<path class="lse-type-nav" d="M64,66a1,1,0,1,1-1,1A1,1,0,0,1,64,66Z" transform="translate(0 13)"/>
								<path class="lse-type-nav" d="M104.884,51,108,48l-3.116-3-.884.839L106.245,48,104,50.161Z" transform="translate(13)"/>
								<path class="lse-type-nav" d="M31.116,51,28,48l3.116-3,.884.839L29.755,48,32,50.161Z" transform="translate(-13)"/>
									<path class="lse-type-mountains" d="M117.227,199.883a4.084,4.084,0,1,0-4.084-4.084A4.084,4.084,0,0,0,117.227,199.883Zm17.97,2.179a2.042,2.042,0,0,0-3.267,0l-6.295,8.392-2.625-3.934a2.042,2.042,0,0,0-3.4,0l-6.469,9.7h32.673Z" transform="translate(-61.172 -155.555)"/>
								</g>
							</svg>
							<lse-b class="lse-project-layout-name"><?= __('Full size', 'LayerSlider') ?></lse-b>
						</lse-b>




						<lse-b class="lse-project-layout <?= ! $lsActivated ? 'lse-locked lse-premium-lock' : '' ?>" <?=! $lsActivated ? 'data-tt=".tt-premium"': ''; ?> data-layout="popup">
							<svg xmlns="http://www.w3.org/2000/svg" width="124" height="84" viewBox="0 0 124 84" id="lse-popup" class="lse-slider-type">
								<g transform="translate(-6 -6)">
									<path class="lse-type-base" d="M14,8H122a6,6,0,0,1,6,6V82a6,6,0,0,1-6,6H14a6,6,0,0,1-6-6V14A6,6,0,0,1,14,8Z"/>
									<rect class="lse-type-fake-site" width="96" height="30" rx="3" transform="translate(20 20)"/>
								<rect class="lse-type-fake-site" width="46" height="22" rx="3" transform="translate(20 54)"/>
								<rect class="lse-type-fake-site" width="46" height="22" rx="3" transform="translate(70 54)"/>
									<path class="lse-type-popup-size" d="M8,0H52a8,8,0,0,1,8,8V32a8,8,0,0,1-8,8H8a8,8,0,0,1-8-8V8A8,8,0,0,1,8,0Z" transform="translate(38 28)"/>
								<path class="lse-type-popup-nav" d="M104.884,51,108,48l-3.116-3-.884.839L106.245,48,104,50.161Z" transform="translate(-14 0)"/>
								<path class="lse-type-popup-nav" d="M31.116,51,28,48l3.116-3,.884.839L29.755,48,32,50.161Z" transform="translate(14 0)"/>
									<path class="lse-type-mountains" d="M117.227,199.883a4.084,4.084,0,1,0-4.084-4.084A4.084,4.084,0,0,0,117.227,199.883Zm17.97,2.179a2.042,2.042,0,0,0-3.267,0l-6.295,8.392-2.625-3.934a2.042,2.042,0,0,0-3.4,0l-6.469,9.7h32.673Z" transform="translate(-61.172 -155.555)"/>
								</g>
							</svg>
							<lse-b class="lse-project-layout-name"><?= __('Popup', 'LayerSlider') ?></lse-b>

							<?php if( ! $lsActivated ) : ?>
								<?= lsGetSVGIcon('lock') ?>
							<?php endif ?>
						</lse-b>

						<?php lsGetInput($sDefs['type'], $sProps); ?>

						<lse-flex-placeholder></lse-flex-placeholder>
						<lse-flex-placeholder></lse-flex-placeholder>
						<lse-flex-placeholder></lse-flex-placeholder>
						<lse-flex-placeholder></lse-flex-placeholder>
						<lse-flex-placeholder></lse-flex-placeholder>

					</lse-b>

					<lse-b id="lse-project-layouts-content">

						<!-- Popup -->
						<lse-b class="lse-only-popup-layout lse-popup-settings">

							<lse-b id="lse-popup-notifications">
								<?php if( ! $lsActivated ) : ?>
								<lse-b class="lse-notification lse-bg-highlight">
									<?= lsGetSVGIcon('info-circle') ?>
									<lse-text><?= sprintf(__('Popup is a premium feature. You can preview it in the editor, but you need to register your LayerSlider license in order to use it on your front end pages. %sPurchase a license%s or %sread the documentation%s to learn more. %sGot LayerSlider in a theme?%s', 'LayerSlider'), '<a href="'.LS_Config::get('purchase_url').'" target="_blank">', '</a>', '<a href="https://layerslider.com/documentation/#activation" target="_blank">', '</a>', '<a href="https://layerslider.com/documentation/#activation-bundles" target="_blank">', '</a>') ?></lse-text>
								</lse-b>
								<?php endif ?>

								<lse-b class="lse-popup-trigger-notification lse-notification lse-bg-highlight">
									<?= lsGetSVGIcon('info-circle') ?>
									<lse-text><?= __('Your Popup will not show up until you set a trigger. Check out the Launch Popup section and choose how and when your Popup should be displayed.', 'LayerSlider') ?></lse-text>
								</lse-b>
							</lse-b>

							<lse-b id="lse-popup-preview-sticky">
								<lse-button class="lse-large lse-popup-preview-button"><?= lsGetSVGIcon('play-circle',false,['class' => 'lse-it-fix']) ?><lse-text><?= __('Live Popup Preview', 'LayerSlider') ?></lse-text></lse-button>
								<lse-tt><?= __('Your project seems empty. Start building something, then check back when there’s content to be previewed.', 'LayerSlider') ?></lse-tt>
							</lse-b>

							<lse-h2><?= __('Layout Settings', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tr>
										<td>
											<?= __('Popup Layout Preset', 'LayerSlider') ?><br>
										</td>
										<td class="lse-popup-presets">
											<lse-b id="lse-selected-popup-preset">
												<lse-b class="lse-layout-illustration">
													<lse-b class="lse-layout-illustration-inner">
														<lse-b class="lse-popup-layout-inner lse-popup-top lse-popup-fitwidth">
														</lse-b>
													</lse-b>
												</lse-b>
												<lse-text><?= __('Top Bar', 'LayerSlider') ?></lse-text>
											</lse-b>
										</td>
										<td>
											<lse-button class="lse-large" data-search-name="<?= __('Choose Popup Preset', 'LayerSlider') ?>" data-tt-c data-tt-de="0"><?= lsGetSVGIcon('border-outer',false,['class' => 'lse-it-fix']) ?><lse-text><?= __('Choose Popup Preset', 'LayerSlider') ?></lse-text></lse-button>
											<lse-tt class="lse-popup-presets lse-theme-light">
												<lse-button-group id="lse-popup-presets" class="lse-toggle-all lse-min-one lse-max-one">
													<lse-button class="lse-layout-illustration-grid lse-active" data-options='{ "popupPositionVertical": "top", "popupPositionHorizontal": "center", "popupFitWidth": true, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-top lse-popup-fitwidth">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Top Bar', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "middle", "popupPositionHorizontal": "center", "popupFitWidth": true, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-middle lse-popup-fitwidth">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Middle Bar', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "bottom", "popupPositionHorizontal": "center", "popupFitWidth": true, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-bottom lse-popup-fitwidth">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Bottom Bar', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "middle", "popupPositionHorizontal": "left", "popupFitWidth": false, "popupFitHeight": true }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-left lse-popup-fitheight">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Left Bar', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "middle", "popupPositionHorizontal": "center", "popupFitWidth": false, "popupFitHeight": true }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-center lse-popup-fitheight">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Center Bar', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "middle", "popupPositionHorizontal": "right", "popupFitWidth": false, "popupFitHeight": true }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-right lse-popup-fitheight">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Right Bar', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "top", "popupPositionHorizontal": "left", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-left lse-popup-top">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Top Left Corner', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "top", "popupPositionHorizontal": "center", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-center lse-popup-top">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Top', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "top", "popupPositionHorizontal": "right", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-right lse-popup-top">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Top Right Corner', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "middle", "popupPositionHorizontal": "left", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-left lse-popup-middle">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Left', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "middle", "popupPositionHorizontal": "center", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-center lse-popup-middle">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Middle', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "middle", "popupPositionHorizontal": "right", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-right lse-popup-middle">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Right', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "bottom", "popupPositionHorizontal": "left", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-left lse-popup-bottom">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Bottom Left Corner', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "bottom", "popupPositionHorizontal": "center", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-center lse-popup-bottom">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Bottom', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "bottom", "popupPositionHorizontal": "right", "popupFitWidth": false, "popupFitHeight": false }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-right lse-popup-bottom">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Bottom Right Corner', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-button class="lse-layout-illustration-grid" data-options='{ "popupPositionVertical": "middle", "popupPositionHorizontal": "center", "popupFitWidth": true, "popupFitHeight": true }'>
														<lse-b class="lse-layout-illustration">
															<lse-b class="lse-layout-illustration-inner">
																<lse-b class="lse-popup-layout-inner lse-popup-fitwidth lse-popup-fitheight">
																</lse-b>
															</lse-b>
														</lse-b>
														<lse-text><?= __('Full Size', 'LayerSlider') ?></lse-text>
													</lse-button>
													<lse-flex-placeholder></lse-flex-placeholder>
													<lse-flex-placeholder></lse-flex-placeholder>
													<lse-flex-placeholder></lse-flex-placeholder>
													<lse-flex-placeholder></lse-flex-placeholder>
													<lse-flex-placeholder></lse-flex-placeholder>
													<lse-flex-placeholder></lse-flex-placeholder>
												</lse-button-group>

											</lse-tt>
											<?php
												lsGetInput($sDefs['popupFitWidth'], $sProps, [ 'type' => 'hidden', 'class' => 'lse-popup-fit-width lse-popup-prop' ] );
											?>
											<?php
												lsGetInput($sDefs['popupFitHeight'], $sProps, [ 'type' => 'hidden', 'class' => 'lse-popup-fit-height lse-popup-prop' ] );
											?>

											<?php
												lsGetInput($sDefs['popupPositionHorizontal'], $sProps, [ 'type' => 'hidden', 'class' => 'lse-popup-prop' ] );
											?>

											<?php
												lsGetInput($sDefs['popupPositionVertical'], $sProps, [ 'type' => 'hidden', 'class' => 'lse-popup-prop' ] );
											?>


										</td>
									</tr>
									<tr>
										<td>
											<?= __('Popup Canvas Size', 'LayerSlider') ?><br>
											<lse-text data-set-prop-name="popupsize" class="lse-font-s lse-fw-400"><lse-i><?= __('width', 'LayerSlider') ?></lse-i> | <lse-i><?= __('height', 'LayerSlider') ?></lse-i></lse-text>
										</td>
										<td class="lse-half" data-get-prop-name="popupsize">
											<lse-fe-wrapper>
												<?php
													lsGetInput($sDefs['popupWidth'], $sProps );
												?>
												<lse-unit>
													px
												</lse-unit>
											</lse-fe-wrapper>
											<lse-fe-wrapper>
												<?php
													lsGetInput($sDefs['popupHeight'], $sProps );
												?>
												<lse-unit>
													px
												</lse-unit>
											</lse-fe-wrapper>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>
											<?= __('Distance from Sides', 'LayerSlider') ?><br>
											<lse-text data-set-prop-name="popupdistance" class="lse-font-s lse-fw-400"><lse-i><?= __('top', 'LayerSlider') ?></lse-i> | <lse-i><?= __('right', 'LayerSlider') ?></lse-i> | <lse-i><?= __('bottom', 'LayerSlider') ?></lse-i> | <lse-i><?= __('left', 'LayerSlider') ?></lse-i></lse-text>
										</td>
										<td colspan="2" class="lse-quarter" data-get-prop-name="popupdistance">
											<lse-fe-wrapper>
												<?php lsGetInput($sDefs['popupDistanceTop'], $sProps); ?>
												<lse-unit>px</lse-unit>
											</lse-fe-wrapper>
											<lse-fe-wrapper>
												<?php lsGetInput($sDefs['popupDistanceRight'], $sProps); ?>
												<lse-unit>px</lse-unit>
											</lse-fe-wrapper>
											<lse-fe-wrapper>
												<?php lsGetInput($sDefs['popupDistanceBottom'], $sProps); ?>
												<lse-unit>px</lse-unit>
											</lse-fe-wrapper>
											<lse-fe-wrapper>
												<?php lsGetInput($sDefs['popupDistanceLeft'], $sProps); ?>
												<lse-unit>px</lse-unit>
											</lse-fe-wrapper>
										</td>
									</tr>
									<?php lsOptionRow('checkbox', $sDefs['popupScrollable'], $sProps ); ?>

								</table>
							</lse-table-wrapper>

							<lse-h2><?= __('Launch Popup', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<tr class="lse-popup-triggers">
											<td><?= $sDefs['popupShowOnTimeout']['name'] ?></td>
											<td><lse-fe-wrapper>
												<?php lsGetInput($sDefs['popupShowOnTimeout'], $sProps, [ 'class' => 'mini']) ?><lse-unit><?= __('seconds') ?></lse-unit>
											</lse-fe-wrapper></td>
											<td class="lse-desc"><?= $sDefs['popupShowOnTimeout']['desc'] ?></td>
										</tr>
										<tr class="lse-popup-triggers">
											<td><?= $sDefs['popupShowOnIdle']['name'] ?></td>
											<td><lse-fe-wrapper>
												<?php lsGetInput($sDefs['popupShowOnIdle'], $sProps, [ 'class' => 'mini']) ?><lse-unit><?= __('seconds') ?></lse-unit>
											</lse-fe-wrapper>
											</td>
											<td class="lse-desc"><?= $sDefs['popupShowOnIdle']['desc'] ?></td>
										</tr>
										<?php
										lsOptionRow('input', $sDefs['popupShowOnScroll'], $sProps, [ 'class' => 'mini'], 'lse-popup-triggers' );
										lsOptionRow('checkbox', $sDefs['popupShowOnLeave'], $sProps, [], 'lse-popup-triggers' );
										lsOptionRow('input', $sDefs['popupShowOnClick'], $sProps, [], 'lse-popup-triggers' );
										?>

									</tbody>
								</table>
							</lse-table-wrapper>

							<lse-h2><?= __('Close Popup', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<tr>
											<td><?= $sDefs['popupCloseOnTimeout']['name'] ?></td>
											<td><lse-fe-wrapper>
												<?php lsGetInput($sDefs['popupCloseOnTimeout'], $sProps, [ 'class' => 'mini']) ?><lse-unit><?= __('seconds') ?></lse-unit>
											</lse-fe-wrapper></td>
											<td class="lse-desc"><?= $sDefs['popupCloseOnTimeout']['desc'] ?></td>
										</tr>
										<?php
										lsOptionRow('input', $sDefs['popupCloseOnScroll'], $sProps, [ 'class' => 'mini'] );
										lsOptionRow('checkbox', $sDefs['popupCloseOnEsc'], $sProps, [ 'class' => 'lse-popup-prop'] );
										lsOptionRow('checkbox', $sDefs['popupCloseOnSliderEnd'], $sProps, [ 'class' => 'lse-popup-prop'] );
										?>

									</tbody>
								</table>
							</lse-table-wrapper>

							<lse-h2><?= __('Repeat Control', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<?php lsOptionRow('checkbox', $sDefs['popupRepeat'], $sProps ); ?>
										<tr>
											<td><?= $sDefs['popupRepeatDays']['name'] ?></td>
											<td><lse-fe-wrapper>
												<?php lsGetInput($sDefs['popupRepeatDays'], $sProps, [ 'class' => 'mini']) ?><lse-unit><?= __('days') ?></lse-unit>
											</lse-fe-wrapper></td>
											<td class="lse-desc"><?= $sDefs['popupRepeatDays']['desc'] ?></td>
										</tr>
										<?php lsOptionRow('checkbox', $sDefs['popupShowOnce'], $sProps ); ?>

									</tbody>
								</table>
							</lse-table-wrapper>

							<lse-h2><?= __('Target Pages', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<tr class="lse-popup-include-pages">
											<td><?= __('Include pages', 'LayerSlider') ?></td>
											<td class="lse-popup-target">
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupPagesAll'], $sProps, [ 'class' => 'lse-popup-include-all-pages' ]); ?>
													<?= $sDefs['popupPagesAll']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupPagesHome'], $sProps); ?>
													<?= $sDefs['popupPagesHome']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupPagesPage'], $sProps); ?>
													<?= $sDefs['popupPagesPage']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupPagesPost'], $sProps); ?>
													<?= $sDefs['popupPagesPost']['name'] ?>
												</lse-ib>
											</td>
										</tr>
										<tr class="lse-popup-include-custom-pages">
											<td><?= __('Include custom pages', 'LayerSlider') ?></td>
											<td colspan="2"><?php lsGetInput($sDefs['popupPagesCustom'], $sProps, [ 'placeholder' => __('Comma separated list of page IDs, titles or slugs.') ]); ?></td>
										</tr>
										<tr class="lse-popup-exclude-pages">
											<td><?= __('Exclude pages') ?></td>
											<td colspan="2"><?php lsGetInput($sDefs['popupPagesExclude'], $sProps, [ 'placeholder' => __('Comma separated list of page IDs, titles or slugs.') ]); ?></td>
										</tr>
									</tbody>
								</table>
							</lse-table-wrapper>

							<lse-h2><?= __('Target Audience', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<tr>
											<td><?= __('Show Popup for users', 'LayerSlider') ?></td>
											<td colspan="2">
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupRolesAdministrator'], $sProps); ?>
													<?= $sDefs['popupRolesAdministrator']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupRolesEditor'], $sProps); ?>
													<?= $sDefs['popupRolesEditor']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupRolesAuthor'], $sProps); ?>
													<?= $sDefs['popupRolesAuthor']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupRolesContributor'], $sProps); ?>
													<?= $sDefs['popupRolesContributor']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupRolesSubscriber'], $sProps); ?>
													<?= $sDefs['popupRolesSubscriber']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupRolesCustomer'], $sProps); ?>
													<?= $sDefs['popupRolesCustomer']['name'] ?>
												</lse-ib>
												<lse-ib>
													<?php lsGetCheckbox($sDefs['popupRolesVisitor'], $sProps); ?>
													<?= $sDefs['popupRolesVisitor']['name'] ?>
												</lse-ib>
											</td>
										</tr>
										<?php lsOptionRow('checkbox', $sDefs['popupFirstTimeVisitor'], $sProps ); ?>
									</tbody>
								</table>
							</lse-table-wrapper>

							<lse-h2><?= __('Modal Options', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<?php
										lsOptionRow('select', $sDefs['popupTransitionIn'], $sProps, [ 'class' => 'lse-popup-prop' ] );
										lsOptionRow('input', $sDefs['popupDurationIn'], $sProps, [ 'class' => 'lse-popup-prop'] );
										lsOptionRow('input', $sDefs['popupDelayIn'], $sProps, [ 'class' => 'lse-popup-prop'] );
										lsOptionRow('select', $sDefs['popupTransitionOut'], $sProps, [ 'class' => 'lse-popup-prop' ] );
										lsOptionRow('input', $sDefs['popupDurationOut'], $sProps, [ 'class' => 'lse-popup-prop'] );
										lsOptionRow('checkbox', $sDefs['popupStartSliderImmediately'], $sProps, [ 'class' => 'lse-popup-prop'] );
										lsOptionRow('select', $sDefs['popupResetOnClose'], $sProps, [ 'class' => 'lse-popup-prop']);
										lsOptionRow('checkbox', $sDefs['popupShowCloseButton'], $sProps, [ 'class' => 'lse-popup-prop'] );
										lsOptionRow('input', $sDefs['popupCloseButtonStyle'], $sProps, [ 'class' => 'lse-popup-prop'] );
										?>
									</tbody>
								</table>
							</lse-table-wrapper>

							<lse-h2><?= __('Overlay Options', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<?php
										lsOptionRow('checkbox', $sDefs['popupDisableOverlay'], $sProps );
										lsOptionRow('checkbox', $sDefs['popupOverlayClickToClose'], $sProps );
										?>
										<tr>
											<td><?= $sDefs['popupOverlayBackground']['name'] ?></td>
											<td>
												<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="background color" data-smart-load="lse-color-picker">
													<?php lsGetInput( $sDefs['popupOverlayBackground'], null, [ 'data-type' => 'gradient'] ) ?>
													<?= lsGetSVGIcon('times', null, [
														'class' => 'lse-remove'
													]) ?>
												</lse-fe-wrapper>
											</td>
											<td><?= $sDefs['popupOverlayBackground']['desc'] ?></td>
										</tr>
										<?php
										lsOptionRow('select', $sDefs['popupOverlayTransitionIn'], $sProps, [ 'class' => 'lse-popup-prop' ] );
										lsOptionRow('input', $sDefs['popupOverlayDurationIn'], $sProps, [ 'class' => 'lse-popup-prop' ] );
										lsOptionRow('select', $sDefs['popupOverlayTransitionOut'], $sProps, [ 'class' => 'lse-popup-prop' ] );
										lsOptionRow('input', $sDefs['popupOverlayDurationOut'], $sProps, [ 'class' => 'lse-popup-prop' ] );
										?>
									</tbody>
								</table>
							</lse-table-wrapper>
							</table>

						</lse-b>

						<!-- Common -->
						<lse-b class="lse-any-but-popup-layout">

							<lse-h2><?= __('Slider Scroll Behavior', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<tr class="lse-project-settings-helper-row">
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="2">
												<lse-button-group id="lse-scene-selector" data-search-name="<?= __('Slider Scroll Behavior', 'LayerSlider') ?>" data-search-keywords="<?= _x('scene normal sticky scroll behavior', 'search keywords', 'LayerSlider') ?>">
													<lse-button data-scene="">
														<?= lsGetSVGIcon('image-landscape', 'duotone' ) ?>
														<lse-b><?= __('Normal', 'LayerSlider') ?></lse-b>
													</lse-button>
													<lse-button data-scene="sticky" <?=! $lsActivated ? 'data-tt=".tt-premium"': ''; ?> class="<?= ! $lsActivated ? 'lse-locked lse-premium-lock' : '' ?>">
														<?= lsGetSVGIcon('image-landscape', 'duotone' ) ?>
														<?= lsGetSVGIcon('thumbtack', false, ['class' => 'lse-pwr'] ) ?>
														<lse-b><?= __('Sticky', 'LayerSlider') ?></lse-b>

															<?php if( ! $lsActivated ) {
																echo lsGetSVGIcon('lock',false,[ 'class' => 'lse-pwr' ]);
															} ?>
													</lse-button>
													<lse-button data-scene="scroll" <?=! $lsActivated ? 'data-tt=".tt-premium"': ''; ?> class="<?= ! $lsActivated ? 'lse-locked lse-premium-lock' : '' ?>">
														<?= lsGetSVGIcon('image-landscape', 'duotone' ) ?>
														<?= lsGetSVGIcon('computer-mouse-scrollwheel', false, ['class' => 'lse-pwr'] ) ?>
														<lse-b><?= __('Scroll Scene', 'LayerSlider') ?></lse-b>

														<?php if( ! $lsActivated ) {
															echo lsGetSVGIcon('lock',false, [ 'class' => 'lse-pwr' ]);
														} ?>
													</lse-button>
												</lse-button-group>
											</td>
											<td class="lse-desc">
												<lse-i class="lse-any-but-scene">
													<?= __('The slider will be a regular element on the page. It will scroll along with other elements and play animations normally based on your settings.', 'LayerSlider') ?>
												</lse-i>
												<lse-i class="lse-only-sticky-scene">
													<?= __('Once the slider reaches the chosen viewport portion, it’ll stick to that location and act as a pinned element until visitors scroll beyond the threshold defined below. Animations are not affected.', 'LayerSlider') ?>
												</lse-i>
												<lse-i class="lse-only-scroll-scene">
													<?= __('Acts as the Sticky behavior, but reacts and plays animations by scrolling the page. It’s the long-awaited successor to the <b>“Play By Scroll”</b> feature. Scroll Scene will display and animate the first slide only.', 'LayerSlider') ?>
												</lse-i>
											</td>
										</tr>

										<tr class="lse-only-sticky-scene">
											<td>
												<lse-b>
													<?= __('Scene Height', 'LayerSlider') ?>
												</lse-b>
											</td>
											<td>
												<lse-fe-wrapper class="lse-smart-help" data-smart-help="sceneheight" data-smart-options="sceneheight" data-smart-help-title="<?= __('Scene Height', 'LayerSlider') ?>" >
													<?php lsGetInput($sDefs['sceneHeight'], $sProps ); ?>
												</lse-fe-wrapper>
											</td>
											<td class="lse-desc">
												<?= __('The length of the scrollable area. Use larger values to keep the slider visible for longer, and play animations slower in case of a Scroll Scene. Supported units: px, %, sh (percentage of slider height), vh (percentage of viewport height).', 'LayerSlider') ?>
											</td>
										</tr>

										<tr class="lse-only-scroll-scene">
											<td>
												<lse-b>
													<?= __('Scene Speed', 'LayerSlider') ?>
												</lse-b>
											</td>
											<td>
												<lse-ib class="lse-range-inputs lse-half lse-modal-inputs">

														<?php lsGetInput( $sDefs['sceneSpeed'], $sProps, [
															'name' => '',
															'type' => 'range',
															'min' => 10,
															'max' => 300,
															'step' => 10
														]) ?>
														<?php lsGetInput( $sDefs['sceneSpeed'], $sProps ); ?>
														<lse-unit>%</lse-unit>
												</lse-ib>
											</td>
											<td class="lse-desc">
												<?= __('Controls the scene’s animation speed when scrolling the page. This is a percentage value, so, for example, 50% will result in slower and less intense animations.', 'LayerSlider') ?>
											</td>
										</tr>

										<?php
											lsOptionRow('select', $sDefs['stickTo'], $sProps, [], 'lse-only-scene' );
										?>

										<tr class="lse-only-scroll-scene">
											<td>
												<lse-b>
													<?= __('Smooth Scroll Duration', 'LayerSlider') ?>
												</lse-b>
											</td>
											<td>
												<lse-ib class="lse-range-inputs lse-modal-inputs">
													<?php lsGetInput( $sDefs['smoothScrollDuration'], $sProps ); ?>
													<lse-unit>ms</lse-unit>
												</lse-ib>
											</td>
											<td class="lse-desc">
												<?= __('Controls the smooth scrolling animation behavior. This value is in milliseconds. A second is 1000 milliseconds. Lower values result in faster reaction times.', 'LayerSlider') ?>
											</td>
										</tr>
									</tbody>
								</table>
							</lse-table-wrapper>

							<lse-h2><?= __('Layout Settings', 'LayerSlider') ?></lse-h2>
							<lse-table-wrapper>
								<table>
									<tbody>
										<?php
										lsOptionRow('input', $sDefs['width'], $sProps, [] );
										lsOptionRow('input', $sDefs['height'], $sProps, [] );
										lsOptionRow('input', $sDefs['maxWidth'], $sProps, [], 'lse-any-but-fixed-layout' );
										lsOptionRow('input', $sDefs['responsiveUnder'], $sProps, [], 'lse-only-fullwidth-layout' );
										lsOptionRow('select', $sDefs['fullSizeMode'], $sProps, [], 'lse-only-fullsize-layout' );
										?>

										<tr class="lse-project-spacing-row">
											<td>
												<lse-b>
													<?= __('Vertical Spacing', 'LayerSlider') ?>
												</lse-b>
											</td>
											<td>
												<lse-fe-wrapper class="lse-smart-help" data-smart-help="projectverticalspacing" data-smart-options="projectverticalspacing" data-smart-help-title="<?= __('Vertical Spacing', 'LayerSlider') ?>" >
													<?php lsGetInput($sDefs['marginTop'], $sProps ); ?>
												</lse-fe-wrapper>
												<lse-fe-wrapper class="lse-smart-help lse-mt-10" data-smart-help="projectverticalspacing" data-smart-options="projectverticalspacing" data-smart-help-title="<?= __('Vertical Spacing', 'LayerSlider') ?>" >
													<?php lsGetInput($sDefs['marginBottom'], $sProps ); ?>
												</lse-fe-wrapper>
											</td>
											<td class="lse-desc">
												<?= __('Creates the given amount of space above and below your slider. <br>Supported units: px, %, sh (percentage of slider height), vh (percentage of viewport height).', 'LayerSlider') ?>
											</td>
										</tr>
										<?php
											lsOptionRow('checkbox', $sDefs['fitScreenWidth'], $sProps, [], 'lse-only-full-layout' );
											lsOptionRow('checkbox', $sDefs['allowFullscreen'], $sProps, [], 'lse-any-but-scene' );
											lsOptionRow('input', $sDefs['maxRatio'], $sProps, [], 'lse-any-but-fixed-layout' );
											lsOptionRow('input', $sDefs['calculateOffsetFrom'], $sProps, [], 'lse-only-hero-layout' );
										?>
										<tr class="lse-advanced">
											<td>
												<lse-b>
													<?= lsGetSVGIcon('flag-alt', false, [
														'data-tt' => '.tt-advanced'
													] ) ?>
													<?= $sDefs['insertMethod']['name'] ?>
												</lse-b>
											</td>
											<td>
												<lse-fe-wrapper class="lse-select">
												<?php
													lsGetSelect($sDefs['insertMethod'], $sProps, [], false, false );
												?>
												</lse-fe-wrapper>
												<?php
													lsGetInput($sDefs['insertSelector'], $sProps);
												?>
											</td>
											<td class="lse-desc"><?= $sDefs['insertMethod']['desc'] ?></td>
										</tr>
										<?php
											lsOptionRow('select', $sDefs['clipSlideTransition'], $sProps );
											lsOptionRow('checkbox', $sDefs['preventSliderClip'], $sProps, [], 'full-width-row full-size-row' );
										?>

									</tbody>
								</table>
							</lse-table-wrapper>

						</lse-b>

					</lse-b>

				</lse-b>

				<!-- Mobile -->
				<lse-b data-category="<?= __('Mobile', 'LayerSlider') ?>">
					<lse-table-wrapper>
						<table>
							<tbody>
							<?php
							lsOptionRow('checkbox', $sDefs['hideOnMobile'], $sProps );
							lsOptionRow('input', $sDefs['hideUnder'], $sProps );
							lsOptionRow('input', $sDefs['hideOver'], $sProps );
							lsOptionRow('checkbox', $sDefs['slideOnSwipe'], $sProps );
							lsOptionRow('checkbox', $sDefs['optimizeForMobile'], $sProps );
							?>
							</tbody>
						</table>
					</lse-table-wrapper>
				</lse-b>

				<!-- Slideshow -->
				<lse-b data-category="<?= __('Slideshow', 'LayerSlider') ?>">
					<lse-h2><?= __('Slideshow behavior', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<tr>
									<td>
										<?= $sDefs['firstSlide']['name'] ?>
									</td>
									<td>
										<lse-fe-wrapper class="lse-smart-help" data-smart-help="firstslide" data-smart-options="firstslide" data-smart-help-title="<?= $sDefs['firstSlide']['name'] ?>">
											<?php lsGetInput($sDefs['firstSlide'], $sProps) ?>
										</lse-fe-wrapper>
									</td>
									<td class="lse-desc"><?= $sDefs['firstSlide']['desc'] ?></td>
								</tr>
								<?php
								lsOptionRow('checkbox', $sDefs['autoStart'], $sProps );
								lsOptionRow('checkbox', $sDefs['pauseLayers'], $sProps );
								lsOptionRow('checkbox', $sDefs['startInViewport'], $sProps );
								lsOptionRow('select', $sDefs['pauseOnHover'], $sProps );
								lsOptionRow('checkbox', $sDefs['hashChange'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Slideshow navigation', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('checkbox', $sDefs['keybNavigation'], $sProps );
								lsOptionRow('checkbox', $sDefs['touchNavigation'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<?php if( $lseProjectUsesPlayByScroll || $lsePlayByScrollEnabled ) : ?>
					<lse-h2><?= __('Play By Scroll', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
									lsOptionRow('checkbox', $sDefs['playByScroll'], $sProps );
									lsOptionRow('checkbox', $sDefs['playByScrollStart'], $sProps );
									lsOptionRow('checkbox', $sDefs['playByScrollSkipSlideBreaks'], $sProps );
									lsOptionRow('input', $sDefs['playByScrollSpeed'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>
					<?php endif ?>

					<lse-h2><?= __('Cycles', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('input', $sDefs['loops'], $sProps );
								lsOptionRow('checkbox', $sDefs['forceLoopNumber'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Other settings', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('checkbox', $sDefs['twoWaySlideshow'], $sProps );
								lsOptionRow('checkbox', $sDefs['shuffle'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

				</lse-b>

				<!-- Appearance -->
				<lse-b data-category="<?= __('Appearance', 'LayerSlider') ?>">
					<lse-h2><?= __('Project appearance', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<tr>
									<td><?= __('Skin', 'LayerSlider') ?></td>
									<td>
										<lse-fe-wrapper class="lse-select">
											<select name="skin" data-search-name="<?= __('Skin', 'LayerSlider') ?>">
												<?php $sProps['skin'] = empty($sProps['skin']) ? $sDefs['skin']['value'] : $sProps['skin'] ?>
												<?php $skins = LS_Sources::getSkins(); ?>
												<?php foreach($skins as $skin) : ?>
												<?php $selected = ($skin['handle'] == $sProps['skin']) ? ' selected="selected"' : '' ?>
												<option value="<?= $skin['handle'] ?>"<?= $selected ?>>
													<?php
													echo $skin['name'];
													if(!empty($skin['info']['note'])) { echo ' - ' . $skin['info']['note']; }
													?>
												</option>
												<?php endforeach; ?>
											</select>
										</lse-fe-wrapper>
									</td>
									<td class="lse-desc"><?= $sDefs['skin']['desc'] ?></td>
								</tr>
								<?php
								lsOptionRow('input', $sDefs['borderRadius'], $sProps );
								lsOptionRow('input', $sDefs['sliderFadeInDuration'], $sProps );
								lsOptionRow('checkbox', $sDefs['animateFirstSlide'], $sProps );
								lsOptionRow('input', $sDefs['firstSlideDuration'], $sProps );
								lsOptionRow('input', $sDefs['firstSlideTimeShift'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Advanced Customization Options', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php lsOptionRow('input', $sDefs['sliderClasses'], $sProps ); ?>
								<tr>
									<td><?= __('Custom Project CSS', 'LayerSlider') ?></td>
									<td colspan="2"><textarea data-search-name="<?= __('Custom Project CSS', 'LayerSlider') ?>" name="sliderstyle" cols="30" rows="10" placeholder="<?= __('List of CSS properties, e.g. border-radius: 5px;') ?>"><?= !empty($sProps['sliderstyle']) ? $sProps['sliderstyle'] : $sDefs['sliderStyle']['value'] ?></textarea></td>
								</tr>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Project global background', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php lsOptionRow('select', $sDefs['globalBGFor'], $sProps ); ?>
								<tr>
									<td>
										<?= $sDefs['globalBGColor']['name'] ?>
									</td>
									<td>
										<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="background color" data-smart-load="lse-color-picker">
											<?php lsGetInput( $sDefs['globalBGColor'], null, [ 'data-type' => 'gradient'] ) ?>
											<?= lsGetSVGIcon('times', null, [
												'class' => 'lse-remove'
											]) ?>
										</lse-fe-wrapper>
									</td>
									<td>
										<?= $sDefs['globalBGColor']['desc'] ?>
									</td>
								</tr>
 								<tr>
									<td>
										<?= lsGetSVGIcon('exclamation-triangle', false, [
											'class' => 'lse-unregistered-layer lse-premium lse-premium-lock',
											'data-tt' => '.tt-option-unregistered'
										]) ?>
										<?= __('Background Image', 'LayerSlider') ?>
									</td>
									<td>
										<?php $bgImage = !empty($sProps['backgroundimage']) ? $sProps['backgroundimage'] : null; ?>
										<?php $bgImageId = !empty($sProps['backgroundimageId']) ? $sProps['backgroundimageId'] : null; ?>
										<lse-fe-wrapper class="lse-image-input lse-has-contextmenu" data-contextmenu-selector="#lse-context-menu-image-input">
											<lse-image-input style="background-image: url( <?= apply_filters('ls_get_thumbnail', $bgImageId, $bgImage) ?>)" class="lse-media-upload lse-global-background" data-prop="backgroundimage"></lse-image-input>
											<?= lsGetSVGIcon('ellipsis-v', null, [
												'class' => 'lse-options lse-has-left-contextmenu',
												'data-contextmenu-selector' => '#lse-context-menu-image-input'
											]) ?>
										</lse-fe-wrapper>
										<lse-b class="lse-image lse-global-background" data-search-name="<?= __('Background Image', 'LayerSlider') ?>" data-l10n-set="<?= __('Click to set', 'LayerSlider') ?>" data-l10n-change="<?= __('Click to change', 'LayerSlider') ?>">
											<lse-b class="lse-image-overlay"></lse-b>
										</lse-b>
									</td>
									<td class="lse-desc"><?= $sDefs['globalBGImage']['desc'] ?></td>
								</tr>
								<?php
								lsOptionRow('select', $sDefs['globalBGRepeat'], $sProps );
								lsOptionRow('select', $sDefs['globalBGAttachment'], $sProps );
								lsOptionRow('input', $sDefs['globalBGPosition'], $sProps, ['class' => 'input'] );
								?>
								<tr>
									<td><?= $sDefs['globalBGSize']['name'] ?></td>
									<td>
										<lse-fe-wrapper class="lse-smart-help" data-smart-help="backgroundsize" data-smart-help-title="<?= __('Background Size', 'LayerSlider') ?>" data-smart-options="backgroundsize">
											<?php lsGetInput($sDefs['globalBGSize'], $sProps, ['class' => 'input'] ) ?>
										</lse-fe-wrapper>
									</td>
									<td class="lse-desc"><?= $sDefs['globalBGSize']['desc'] ?></td>
								</tr>
							</tbody>
						</table>
					</lse-table-wrapper>

				</lse-b>

				<!-- Navigation Area -->
				<lse-b data-category="<?= __('Navigation Area', 'LayerSlider') ?>">

					<lse-h2><?= __('Show navigation buttons', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('checkbox', $sDefs['navPrevNextButtons'], $sProps );
								lsOptionRow('checkbox', $sDefs['navStartStopButtons'], $sProps );
								lsOptionRow('checkbox', $sDefs['navSlideButtons'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Show Navigation buttons on hover', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('checkbox', $sDefs['hoverPrevNextButtons'], $sProps );
								lsOptionRow('checkbox', $sDefs['hoverSlideButtons'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Show Slideshow timers', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('checkbox', $sDefs['barTimer'], $sProps );
								lsOptionRow('checkbox', $sDefs['circleTimer'], $sProps );
								lsOptionRow('checkbox', $sDefs['slideBarTimer'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

				</lse-b>

				<!-- Thumbnail navigation -->
				<lse-b data-category="<?= __('Thumbnail navigation', 'LayerSlider') ?>">

					<lse-h2><?= __('Appearance', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('select', $sDefs['thumbnailNavigation'], $sProps );
								lsOptionRow('input', $sDefs['thumbnailAreaWidth'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Thumbnail dimensions', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('input', $sDefs['thumbnailWidth'], $sProps );
								lsOptionRow('input', $sDefs['thumbnailHeight'], $sProps );
								lsOptionRow('select', $sDefs['tnFillMode'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Thumbnail appearance', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('input', $sDefs['thumbnailActiveOpacity'], $sProps );
								lsOptionRow('input', $sDefs['thumbnailInactiveOpacity'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>
				</lse-b>

				<!-- Videos -->
				<lse-b data-category="<?= __('Videos', 'LayerSlider') ?>">
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('checkbox', $sDefs['autoPlayVideos'], $sProps, [ 'class' => 'lse-media-autoplay-notification' ] );
								lsOptionRow('checkbox', $sDefs['rememberUnmuteState'], $sProps );
								lsOptionRow('select', $sDefs['autoPauseSlideshow'], $sProps );
								lsOptionRow('select', $sDefs['youtubePreviewQuality'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>
				</lse-b>

				<!-- Content Sources -->
				<!-- <lse-b data-category="<?= __('Content Sources', 'LayerSlider') ?>">

					<lse-table-wrapper class="lse-p-s">
						<lse-p><?= __('...', 'LayerSlider') ?></lse-p>

						<lse-ul>
							<lse-li><?= __('No content source', 'LayerSlider') ?></lse-li>
							<lse-li><?= __('No content source', 'LayerSlider') ?></lse-li>
						</lse-ul>
					</lse-table-wrapper>
				</lse-b> -->


				<!-- Performance -->
				<lse-b data-category="<?= __('Performance', 'LayerSlider') ?>">
					<lse-h2><?= __('Performance Mode', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php lsOptionRow('select', $sDefs['performanceMode'], $sProps );?>

								<tr>
									<td><?= $sDefs['performanceModeThreshold']['name'] ?></td>
									<td>
										<lse-fe-wrapper class="lse-smart-help" data-smart-help="performancemodethreshold" data-smart-help-title="<?= __('Perf. Mode Threshold', 'LayerSlider') ?>" data-smart-options="performancemodethreshold" data-smart-options-title="<?= __('Threshold', 'LayerSlider') ?>">
											<?php lsGetInput( $sDefs['performanceModeThreshold'], $sProps ) ?>
										</lse-fe-wrapper>
									</td>
									<td class="lse-desc"><?= $sDefs['performanceModeThreshold']['desc'] ?></td>
								</tr>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Lazy Load', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php lsOptionRow('select', $sDefs['enhancedLazyLoad'], $sProps ); ?>
							</tbody>
						</table>
					</lse-table-wrapper>
				</lse-b>


				<!-- Defaults -->
				<lse-b data-category="<?= __('Defaults', 'LayerSlider') ?>">

					<lse-h2><?= __('Slide background defaults', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('select', $sDefs['slideBGSize'], $sProps );
								lsOptionRow('select', $sDefs['slideBGPosition'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Slide duration & timings defaults', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('input', $sDefs['slideDuration'], $sProps );
								lsOptionRow('input', $sDefs['slideTransitionDuration'], $sProps );
								lsOptionRow('input', $sDefs['slideTimeShift'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Parallax Transition defaults', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('input', $sDefs['parallaxSensitivity'], $sProps );
								lsOptionRow('select', $sDefs['parallaxCenterLayers'], $sProps );
								lsOptionRow('input', $sDefs['parallaxCenterDegree'], $sProps );
								lsOptionRow('checkbox', $sDefs['parallaxScrollReverse'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Scroll Transition defaults', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('select', $sDefs['scrollCenterLayers'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2 class="lse-advanced"><?= __('Misc', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper class="lse-advanced">
						<table>
							<tbody>
								<?php
								lsOptionRow('input', $sDefs['forceLayersOutDuration'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>
				</lse-b>

				<!-- Misc -->
				<lse-b data-category="<?= __('Misc', 'LayerSlider') ?>">

					<!-- <lse-h2 class="lse-advanced"><?= __('Loading', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper class="lse-advanced">
						<table>
							<tbody>
								<?php
								lsOptionRow('input', $sDefs['loadOrder'], $sProps );
								?>
								<?php
								lsOptionRow('input', $sDefs['loadDelay'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2 class="lse-advanced"><?= __('Other', 'LayerSlider') ?></lse-h2> -->

					<lse-h2><?= __('Browser behavior', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('checkbox', $sDefs['noUserSelect'], $sProps );
								lsOptionRow('checkbox', $sDefs['noContextMenu'], $sProps );
								?>
							</tbody>
						</table>
					</lse-table-wrapper>

					<lse-h2><?= __('Other', 'LayerSlider') ?></lse-h2>
					<lse-table-wrapper>
						<table>
							<tbody>
								<?php
								lsOptionRow('checkbox', $sDefs['relativeURLs'], $sProps );
								lsOptionRow('select', $sDefs['useSrcset'], $sProps );
								lsOptionRow('checkbox', $sDefs['allowRestartOnResize'], $sProps );
								lsOptionRow('checkbox', $sDefs['fixFloatedContainers'], $sProps );
								lsOptionRow('select', $sDefs['preferBlendMode'], $sProps );
								?>
								<tr>
									<td><?= __('Project preview image', 'LayerSlider') ?></td>
									<td>
										<?php $preview = !empty($slider['meta']['preview']) ? $slider['meta']['preview'] : null; ?>
										<?php $previewId = !empty($slider['meta']['previewId']) ? $slider['meta']['previewId'] : null; ?>
										<lse-fe-wrapper class="lse-image-input lse-has-contextmenu" data-contextmenu-selector="#lse-context-menu-image-input">
											<lse-image-input style="background-image: url( <?= apply_filters('ls_get_thumbnail', $previewId, $preview) ?>)" class="lse-media-upload lse-slider-preview" data-prop="preview"></lse-image-input>
											<?= lsGetSVGIcon('ellipsis-v', null, [
												'class' => 'lse-options lse-has-left-contextmenu',
												'data-contextmenu-selector' => '#lse-context-menu-image-input'
											]) ?>
										</lse-fe-wrapper>
										<lse-b class="lse-image lse-slider-preview lse-upload" data-l10n-set="<?= __('Click to set', 'LayerSlider') ?>" data-l10n-change="<?= __('Click to change', 'LayerSlider') ?>">
											<lse-b class="lse-image-overlay"></lse-b>
										</lse-b>
									</td>
									<td class="lse-desc"><?= __('The preview image you can see in your list of projects.', 'LayerSlider') ?></td>
								</tr>
							</tbody>
						</table>
					</lse-table-wrapper>
				</lse-b>

			</lse-b>
		</lse-b>

	</lse-b>
</lse-b>