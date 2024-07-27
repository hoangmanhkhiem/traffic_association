<?php defined( 'LS_ROOT_FILE' ) || exit; ?>

<lse-b class="lse-dn">

	<lse-b id="lse-object-modal-window-content">

		<kmw-h1 class="kmw-modal-title"><?= __('Insert SVG', 'LayerSlider') ?></kmw-h1>

		<lse-b class="lse-notification lse-bg-yellow">
			<?= lsGetSVGIcon('info-circle') ?>
			<lse-text><?= sprintf(__('You can drop SVG files onto the project canvas to quickly add them to your project. Alternatively, you can also enter and edit the inline source code of SVGs with the below text field. Check out the %sAssets Library%s for thousands of pre-made objects you can use instantly.', 'LayerSlider'), '<a href="#" class="lse-assets-library-button">', '</a>') ?></lse-text>
		</lse-b>

		<lse-b class="lse-white-theme">
			<textarea id="lse-object-insert-textarea" required placeholder="&lt;svg ..."></textarea>
		</lse-b>

		<lse-p class="lse-tac lse-common-modal-style lse-light-theme-alternate">
			<lse-button class="lse-large" id="lse-object-insert-button"><?= __('Insert SVG', 'LayerSlider') ?></ls-button>
		</lse-p>
	</lse-b>
</lse-b>