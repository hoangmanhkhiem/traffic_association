<?php defined( 'LS_ROOT_FILE' ) || exit; ?>
<script type="text/html" id="tmpl-deregister-license">
	<form method="post" id="ls-deregister-license-modal" class="ls--form-control">
		<?php wp_nonce_field('ls-deregister-license'); ?>
		<ls-p class="ls-modal-icon ls--text-center">
			<?= lsGetSVGIcon('exclamation-triangle') ?>
		</ls-p>
		<h1><?= __('License Deregistered', 'LayerSlider') ?></h1>

		<ls-p><?= __('This site can no longer receive LayerSlider plugin updates, access premium templates and features, use Add-Ons, and other benefits that come with license registration. Projects built using premium templates will no longer display on front-end pages.', 'LayerSlider') ?></ls-p>
		<ls-p><?= __('This might affect the appearance and functionality of your site and projects. Register a LayerSlider license key to restore them and continue to receive premium benefits, or purchase an additional license if you have multiple websites.') ?></ls-p>

		<ls-p class="ls--text-center lse-df ls-row-wrap lse-jcsa">
			<a href="<?= admin_url('admin.php?page=layerslider#activationBox') ?>" class="ls-show-activation-box ls--button ls--bg-lightgray ls--white lse-it-fix">
				<?= lsGetSVGIcon('key') ?>
				<lse-text>
					<?= __('Register License', 'LayerSlider') ?>
				</lse-text>
			</a>

			<a href="<?= LS_Config::get('purchase_url') ?>" target="_blank" class="ls--button ls--bg-lightgray ls--white lse-it-fix">
				<?= lsGetSVGIcon('cart-plus') ?>
				<lse-text>
					<?= __('Purchase License', 'LayerSlider') ?>
				</lse-text>
			</a>
		</ls-p>
	</form>
</script>