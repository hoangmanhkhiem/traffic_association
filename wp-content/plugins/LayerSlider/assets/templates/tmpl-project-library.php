<?php defined( 'LS_ROOT_FILE' ) || exit; ?>

<div class="ls-sliders-grid">

<?php

if( ! empty($sliders) ) {
	foreach($sliders as $key => $item) {
		$preview = apply_filters('ls_preview_for_slider', $item );

		if( ! empty( $item['flag_group'] ) ) {
			$groupItems = $item['items'];

			if( empty( $groupItems ) ) { continue; }
			?>
			<div class="ls-slider-item ls-group-item"
				data-id="<?= $item['id'] ?>"
				data-name="<?= apply_filters('ls_slider_title', stripslashes($item['name']), 40) ?>"
			>
				<div class="ls-slider-item-wrapper">
					<div class="ls-items">
						<?php
							if( ! empty( $item['items'] ) ) {
							foreach( $groupItems as $groupKey => $groupItem )  {
							$groupPreview = apply_filters('ls_preview_for_slider', $groupItem ); ?>
								<div class="ls-item <?= ($groupItem['flag_deleted'] == '1') ? 'ls-dimmed' : '' ?>">
									<div class="ls-preview" style="background-image: url(<?=  ! empty( $groupPreview ) ? $groupPreview : LS_ROOT_URL . '/static/admin/img/blank.gif' ?>);">
										<?php if( empty( $groupPreview ) ) : ?>
										<div class="ls-no-preview">
											<?= __('No Preview', 'LayerSlider') ?>
										</div>
										<?php endif ?>
									</div>
								</div>
							<?php } } ?>
					</div>
					<div class="ls-info">
						<div class="ls-name">
							<div class="ls-project-name"><?= apply_filters('ls_slider_title', stripslashes($item['name']), 40) ?></div>
						</div>
					</div>
				</div>
			</div>
			<div class="ls-hidden">
				<div class="ls-clearfix">
					<?php
						if( ! empty( $item['items'] ) ) {
							foreach( $groupItems as $groupKey => $item ) {
								$preview = apply_filters('ls_preview_for_slider', $item );
								?>
								<div class="ls-slider-item"
									data-id="<?= $item['id'] ?>"
									data-slug="<?= htmlentities( $item['slug'] ) ?>"
									data-name="<?= apply_filters('ls_slider_title', stripslashes($item['name']), 40) ?>"
									data-previewurl="<?=  ! empty( $preview ) ? $preview : LS_ROOT_URL . '/static/admin/img/blank.gif' ?>"
									data-slidecount="<?= ! empty( $item['data']['layers'] ) ? count( $item['data']['layers'] ) : 0 ?>"
									data-author="<?= $item['author'] ?>"
									data-date_c="<?= $item['date_c'] ?>"
									data-date_m="<?= $item['date_m'] ?>"
								>
									<div class="ls-slider-item-wrapper">
										<div class="ls-preview" style="background-image: url(<?=  ! empty( $preview ) ? $preview : LS_ROOT_URL . '/static/admin/img/blank.gif' ?>);">
											<?php if( empty( $preview ) ) : ?>
											<div class="ls-no-preview">
												<h5><?= __('No Preview', 'LayerSlider') ?></h5>
												<small><?= __('Previews are automatically generated from slide images in projects.', 'LayerSlider') ?></small>
											</div>
											<?php endif ?>
										</div>
										<div class="ls-info">
											<div class="ls-name">
												<div class="ls-project-name"><?= apply_filters('ls_slider_title', stripslashes($item['name']), 40) ?></div>
												<div class="ls-project-id">#<?= $item['id'] ?></div>
											</div>
										</div>
									</div>
								</div><?php
							}
						}
					?>
				</div>
			</div>
			<?php

		} else { ?>
			<div class="ls-slider-item"
				data-id="<?= $item['id'] ?>"
				data-slug="<?= htmlentities( $item['slug'] ) ?>"
				data-name="<?= apply_filters('ls_slider_title', stripslashes($item['name']), 40) ?>"
				data-previewurl="<?=  ! empty( $preview ) ? $preview : LS_ROOT_URL . '/static/admin/img/blank.gif' ?>"
				data-slidecount="<?= ! empty( $item['data']['layers'] ) ? count( $item['data']['layers'] ) : 0 ?>"
				data-author="<?= $item['author'] ?>"
				data-date_c="<?= $item['date_c'] ?>"
				data-date_m="<?= $item['date_m'] ?>"
			>
				<div class="ls-slider-item-wrapper">
					<div class="ls-preview" style="background-image: url(<?=  ! empty( $preview ) ? $preview : LS_ROOT_URL . '/static/admin/img/blank.gif' ?>);">
						<?php if( empty( $preview ) ) : ?>
						<div class="ls-no-preview">
							<h5><?= __('No Preview', 'LayerSlider') ?></h5>
							<small><?= __('Previews are automatically generated from slide images in projects.', 'LayerSlider') ?></small>
						</div>
						<?php endif ?>
					</div>
					<div class="ls-info">
						<div class="ls-name">
							<div class="ls-project-name"><?= apply_filters('ls_slider_title', stripslashes($item['name']), 40) ?></div>
							<div class="ls-project-id">#<?= $item['id'] ?></div>
						</div>
					</div>
				</div>
			</div><?php
		}
	}
}
?>

</div>