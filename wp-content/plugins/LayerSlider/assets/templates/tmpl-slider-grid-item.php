<?php defined( 'LS_ROOT_FILE' ) || exit; ?>
<?php $sliderName = ! empty( $item['data']['properties']['title'] ) ? $item['data']['properties']['title'] : $item['name']; ?>
<div class="slider-item <?= $class ?>" data-id="<?= $item['id'] ?>" data-slug="<?= htmlentities($item['slug']) ?>" data-hidden="<?= ( $item['flag_deleted'] == '1' ) ? 'true' : 'false' ?>" data-revisions="<?= admin_url( 'admin.php?page=layerslider&action=edit&id='.$item['id'].'&showrevisions=1' ) ?>">
	<div class="slider-item-wrapper">
		<input type="checkbox" name="sliders[]" class="slider-checkbox ls-hover" value="<?= $item['id'] ?>">
		<?= lsGetSVGIcon('ellipsis-v', null, [
			'class' => 'ls-hover slider-actions-button'
		]) ?>
		<a class="ls-preview" style="background-image: url(<?=  ! empty( $preview ) ? $preview : LS_ROOT_URL . '/static/admin/img/blank.gif' ?>);" href="<?= admin_url('admin.php?page=layerslider&action=edit&id='.$item['id']) ?>">
			<?php if( empty( $preview ) ) : ?>
			<div class="no-preview">
				<h5><?= __('No Preview', 'LayerSlider') ?></h5>
				<small><?= __('Previews are automatically generated from slide images in projects.', 'LayerSlider') ?></small>
			</div>
			<?php endif ?>
		</a>

		<div class="ls-info">
			<div class="ls-name">
				<?php if( ! empty( $item['data']['properties']['pt'] ) ) : ?>
				<?= lsGetSVGIcon('lock', false, [
					'class' => 'ls-premium-lock-templates',
					'data-help-delay' => '100',
					'data-help' => __('Register your LayerSlider license to use premium templates. Click to learn more.', 'LayerSlider')
				]) ?>
				<?php endif ?>

				<?php if( $item['flag_dirty'] == 1 ) : ?>
				<?= lsGetSVGIcon('save', false, [
					'data-help-delay' => '100',
					'data-help' => __('This project has a saved draft that has not been published yet. Changes will not be visible on front-end pages until you publish them.', 'LayerSlider')
				]) ?>
				<?php endif ?>
				<input value="<?= htmlentities( apply_filters('ls_slider_title', stripslashes( $sliderName ), 99 ) ) ?>" class="ls--project-name-input">
				<ls-span class="ls-project-id">#<?= $item['id'] ?></ls-span>
			</div>
		</div>

	</div>
</div>