<?php defined( 'LS_ROOT_FILE' ) || exit; ?>
<div class="ls-d-none">

	<lse-b id="lse-assets-inspector" class="kmw-inspector">
		<lse-b id="lse-assets-inspector-overlay" class="kmw-inspector-overlay">
		</lse-b>
		<lse-b id="lse-assets-inspector-content" class="kmw-inspector-content">
			<?= lsGetSVGIcon('times',false,['class' => 'kmw-inspector-close']) ?>
			<lse-b id="lse-assets-inspector-inner" class="kmw-inspector-inner lse-scrollbar lse-scrollbar-dark">
				<lse-h1 id="lse-assets-inspector-title" class="kmw-inspector-title"></lse-h1>
				<lse-b id="lse-assets-inspector-preview-wrapper" class="lse-hidden-x">
					<lse-b id="lse-assets-inspector-preview"></lse-b>
				</lse-b>
				<lse-b class="lse-video-playback-error lse-notification lse-bg-highlight"><?= __('The video is temporarily unavailable. Please try again later.', 'LayerSlider') ?></lse-b>
				<lse-grid id="lse-assets-insert-options">
					<lse-row></lse-row>
				</lse-grid>

				<lse-b class="lse-common-modal-style lse-light-theme-alternate">
					<lse-fe-wrapper id="lse-assets-insert-select" class="lse-select">
						<select>
							<option value="layer-image" data-accepts="image" selected><?= __('New image layer') ?></option>
							<option value="layer-background-image" data-accepts="image"><?= __('New layer with background') ?></option>
							<option value="slide-image" data-accepts="image" data-update><?= __('Set as slide background') ?></option>
							<option value="layer-svg" data-accepts="svg"><?= __('New SVG layer') ?></option>
							<option value="layer-video" data-accepts="video"><?= __('New video layer') ?></option>
							<option value="layer-video" data-accepts="video" data-background-video="1"><?= __('New background video layer') ?></option>
						</select>
					</lse-fe-wrapper>
					<lse-button id="lse-assets-insert-asset">
						<lse-text class="lse-default-text"><?= __('Apply selected insert method') ?></lse-text>
						<lse-text class="lse-only-slide-image"><?= __('Set slide background') ?></lse-text>
						<lse-text class="lse-only-layer-image"><?= __('Set layer image') ?></lse-text>
						<lse-text class="lse-only-layer-background-image"><?= __('Set layer background') ?></lse-text>
						<lse-text class="lse-only-svg"><?= __('Update SVG') ?></lse-text>
						<lse-text class="lse-only-layer-video"><?= __('Set video') ?></lse-text>
					</lse-button>
				</lse-b>

				<lse-b id="lse-assets-type-warning" class="lse-notification lse-bg-highlight">
					<?= lsGetSVGIcon('info-circle') ?>
					<lse-text><?= __('This asset type cannot be added to the selected layer.') ?></lse-text>
				</lse-b>

				<lse-b id="lse-assets-credits">
					<lse-b data-type="photos"><?=
						sprintf(
							__('Photo by %s on %s', 'Asset credits', 'LayerSlider'),
							'<a target="_blank" class="lse-assets-credits-author" target="_blank"></a>',
							'<a target="_blank" class="lse-assets-credits-source"></a>'
						)
					 ?></lse-b>
					<lse-b data-type="videos"><?=
						sprintf(
							__('Video by %s on %s', 'Asset credits', 'LayerSlider'),
							'<a target="_blank" class="lse-assets-credits-author" target="_blank"></a>',
							'<a target="_blank" class="lse-assets-credits-source"></a>'
						)
					 ?></lse-b>
				</lse-b>
			</lse-b>
		</lse-b>
	</lse-b>

	<div id="tmpl-assets-library-sidebar">
		<div class="kmw-sidebar-title">
			<?= __('Assets Library', 'LayerSlider') ?>
		</div>
		<kmw-navigation class="km-tabs-list" data-disable-auto-rename>

			<!-- Stock Assets -->
			<kmw-menutitle>
				<kmw-menutext><?= __('Stock Assets', 'LayerSlider') ?></kmw-menutext>
			</kmw-menutitle>
			<kmw-menuitem data-type="photos" data-category="photos">
				<?= lsGetSVGIcon('images', 'solid', false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Photos', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>
			<kmw-menuitem data-type="videos" data-category="videos">
				<?= lsGetSVGIcon('films', 'solid', false, 'kmw-icon') ?>
				<kmw-menutext><?= __('Videos', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<!-- Objects -->
			<kmw-menutitle>
				<kmw-menutext><?= __('Objects', 'LayerSlider') ?></kmw-menutext>
			</kmw-menutitle>

		</kmw-navigation>
	</div>

	<lse-b id="tmpl-assets-library-modal">

		<kmw-h1 class="kmw-modal-title" style="display: none;"><?= __('Welcome', 'LayerSlider') ?></kmw-h1>

		<lse-b class="kmw-modal-toolbar" style="margin-top: 10px; display: none;">
			<input type="search" name="s" id="lse-assets-search-input" class="lse-modal-search" placeholder="<?= __('Search', 'LayerSlider') ?>">

			<lse-tags-holder>

			</lse-tags-holder>
		</lse-b>

		<lse-b>

			<lse-b id="lse-assets-grid-wrapper">

				<lse-b id="lse-assets-welcome-screen" style="background-image: url(https://layerslider.com/media/assets/welcome/welcome-1.jpg)">
					<lse-b>
						<?= sprintf(__('%sSay goodbye to design roadblocks.%s Elevate your creative vision and easily bring your dream projects to life using our vast collection of professional assets and millions of stock photos and videos. These pre-made graphics are designed for immediate use and can be quickly integrated into your projects with just a few clicks.', 'LayerSlider'), '<b>', '</b>') ?>
					</lse-b>
				</lse-b>

				<lse-b class="lse-objects-grid">

				</lse-b>

				<div id="lse-asset-not-found" class="lse-not-found ls--not-found">
					<div class="not-found-icon">
						<?= lsGetSVGIcon( 'face-monocle', 'duotone' ) ?>
					</div>
					<div class="not-found-main-text">
						<?= __('Can’t find any assets.', 'LayerSlider') ?>
					</div>
					<div class="not-found-sub-text">
						<?= __('Try a different search term or repeat the search for another asset type.', 'LayerSlider') ?>
					</div>
					<ls-button class="not-found-button lse-button ls-button">
						<?= __('Reset Search', 'LayerSlider') ?>
					</ls-button>
				</div>

			</lse-b>

		</lse-b>

	</lse-b>

</div>