<?php

// Prevent direct file access
defined( 'LS_ROOT_FILE' ) || exit;

include LS_ROOT_PATH . '/classes/class.ls.templateutils.php';

$lsTemplatesConnectionError = empty( $lsStoreData );

$lsStoreData = LS_TemplateUtils::processTemplatesData( $lsStoreData, [
	'lastViewed' => $lsStoreLastViewed,
]);

$demoSliders = LS_Sources::getDemoSliders();


function lsPrintTemplateGridItems( $originalCategory, $items, $max = 9999, $excludeHandles = [] ) {

	if( empty( $items ) ) { return ''; }

	$counter = 0;

	foreach( $items as $handle => $item ) {

		$category = $originalCategory;

		if( empty( $category ) && ! empty( $item['category'] ) ) {
			$category = $item['category'];
		}

		// Skip when excluded
		if( ! empty( $excludeHandles ) ) {
			if( in_array( $handle, $excludeHandles ) ) {
				continue;
			}
		}

		// Skip popups in sliders
		if( $category === 'sliders' && ! empty( $item['popup'] ) ) {
			continue;
		}

		// Stop when reached the max limit
		if( ++$counter > $max ) {
			break;
		}

		$item['order'] 			= ! empty( $item['released'] ) ? str_replace('-', '', $item['released']) : '19700101';
		$item['collections'] 	= ! empty( $item['collections'] ) ? $item['collections'] : '';
		$item['bundled'] 		= ! empty( $item['bundled'] ) ? 'true' : 'false';
		$item['premium'] 		= ! empty( $item['premium'] ) ? 'true' : 'false';
		$item['requires'] 		= ! empty( $item['requires'] ) ? $item['requires'] : '1.0.0';
		$item['warning'] 		= version_compare( $item['requires'], LS_PLUGIN_VERSION, '>') ? 'true' : 'false';

	?>
	<ls-template data-groups="<?= $item['groups'] ?>" data-collections="<?= $item['collections'] ?>" data-order="<?= $item['order'] ?>">
		<ls-wrapper>
			<ls-image-holder style="background-image: url(<?= $item['preview'] ?>);"></ls-image-holder>
			<ls-content-wrapper>
				<ls-template-name><?= $item['name'] ?></ls-template-name>
				<ls-template-buttons>

					<?php if( ! empty( $item['url'] ) ) : ?>
					<a
						href="<?= $item['url'] ?>"
						class="ls--button"
						target="_blank">
							<?= __('Preview', 'LayerSlider') ?>
					</a>
					<?php endif ?>

					<a
						href="#"
						class="ls--button ls--import-template-button"
						data-name="<?= $item['name'] ?>"
						data-handle="<?= $handle ?>"
						data-category="<?= $category ?>"
						data-bundled="<?= $item['bundled'] ?>"
						data-premium="<?= $item['premium'] ?>"
						data-version-warning="<?= $item['warning'] ?>">
							<?= __('Import', 'LayerSlider') ?>
					</a>
				</ls-template-buttons>
			</ls-content-wrapper>
		</ls-wrapper>
	</ls-template>
<?php } } ?>



<script type="text/javascript">
	window.lsImportNonce = '<?= wp_create_nonce('ls-import-demos'); ?>';
</script>

<?php if( ! empty( $lsStoreData['html'] ) ) : ?>
<?= $lsStoreData['html'] ?>
<?php endif ?>

<script type="text/html" id="tmpl-import-sliders">

	<div id="ls-import-modal-window" class="<?php if( $lsTemplatesConnectionError ) : ?>connection-failed<?php endif ?> <?= $lsStoreHasUpdate ? 'has-updates' : '' ?>">

		<ls-templates>

			<ls-templates-sidebar class="ls--dark">
				<ls-wrapper class="ls--back">
					<ls-ib class="ls--button ls--close-templates">
						<?= lsGetSVGIcon('arrow-left'); ?>
						<ls-ib><?= __('Back to Dashboard', 'LayerSlider') ?> <span><?= __('[ESC]', 'LayerSlider') ?></span></ls-ib>
					</ls-ib>
				</ls-wrapper>
				<ls-templates-nav>
					<ls-ul>
						<ls-li class="ls--active" data-show-category="discover">
							<?= lsGetSVGIcon('sparkles', 'duotone'); ?>
							<ls-ib><?= __('Discover', 'LayerSlider') ?></ls-ib>
						</ls-li>

						<?php foreach( $lsStoreData['categories'] as $categoryKey => $category ) { ?>
						<?php if( ! empty( $category['separator-before'] ) ) : ?>
						<ls-separator></ls-separator>
						<?php endif ?>
						<ls-li data-show-category="<?= $categoryKey ?>">
							<lse-badge <?= ! empty( $category['new_items_counter'] ) ? 'data-new-items="'.$category['new_items_counter'].'"' : '' ?>></lse-badge>
							<?= $category['icon'] ?>
							<ls-ib><?= $category['name'] ?></ls-ib>
						</ls-li>
						<?php if( ! empty( $category['separator-after'] ) ) : ?>
						<ls-separator></ls-separator>
						<?php endif ?>
						<?php } ?>

						<?php if( ! empty( $lsStoreData['collections'] ) ) : ?>
						<ls-li data-show-category="collections">
							<?= lsGetSVGIcon('rectangle-history', 'duotone'); ?>
							<ls-ib><?= __('Collections', 'LayerSlider') ?></ls-ib>
						</ls-li>
						<?php endif ?>
					</ls-ul>

				</ls-templates-nav>
				<ls-templates-info>
						<?= __('Last updated:', 'LayerSlider') ?>
						<ls-nowrap>
							<?php
								if( time() - 15 > (int) LS_RemoteData::lastUpdated() ) {
									echo human_time_diff( LS_RemoteData::lastUpdated() ), __(' ago', 'LayerSlider');
								} else {
									_e('Just now', 'LayerSlider');
								}
							?>
						</ls-nowrap>
						<a title="<?= __('Check for Updates', 'LayerSlider') ?>"href="<?= wp_nonce_url( admin_url('admin.php?page=layerslider&action=update_store'), 'update_store') ?>" class="refresh-btn ls--button"><?= __('Check for Updates', 'LayerSlider') ?></a>
				</ls-templates-info>
			</ls-templates-sidebar>

			<ls-templates-containers class="lse-scrollbar lse-scrollbar-dark">

				<ls-templates-container data-category="discover" class="ls--active">

					<ls-templates-featured data-slideshow-interval="<?= $lsStoreData['featured_interval'] ?>">
						<?php foreach( $lsStoreData['featured'] as $featuredIndex => $featured ) : ?>
						<ls-featured-item class="<?= ( $featuredIndex === 0 ) ? 'ls--active' : '' ?>">

							<ls-templates-featured-sidebar class=" <?= $featured['sidebar']['class'] ?>" style="<?= $featured['sidebar']['style'] ?>">
								<ls-title><?= ! empty( $featured['template']['handle'] ) ? __('Featured Template') : __('Featured', 'LayerSlider') ?></ls-title>
								<ls-template-name><?= $featured['title'] ?></ls-template-name>
								<ls-template-desc class="lse-scrollbar lse-scrollbar-light">
									<?= $featured['text'] ?>
								</ls-template-desc>
								<ls-template-buttons>
									<?php
										foreach( $featured['buttons'] as $button ) {
											$attrList = '';
											if( ! empty( $button['attributes'] ) ) {
												foreach( $button['attributes'] as $attrKey => $attrVal ) {
													if( $attrKey !== 'class' ) {
														$attrList .= ' '.$attrKey.'="'.$attrVal.'"';
													}
												}
											}
									?>

									<a class="ls--button <?= ! empty( $button['attributes']['class'] ) ? $button['attributes']['class'] : '' ?>" href="<?= $button['attributes']['href'] ?>" <?= $attrList ?>>
										<?= $button['icon'] ?>
										<ls-text><?= $button['text'] ?></ls-text>
									</a>
									<?php } ?>
								</ls-template-buttons>
							</ls-templates-featured-sidebar>
							<ls-templates-featured-media>
								<div class="ls--sidebar-spacer"></div>
								<div class="ls--media-container">

									<?php if( ! empty( $featured['video'] ) ) { ?>
									<ls-media-wrapper class="ls--blurred">
										<video width="640" height="360" preload="metadata" muted autoplay loop>
											<?php foreach( $featured['video']['sources'] as $source ) : ?>
											<source src="<?= $source['src'] ?>" type="<?= $source['type'] ?>">
											<?php endforeach ?>
										</video>

		 							</ls-media-wrapper>
									<ls-media-wrapper>
										<video width="640" height="360" preload="metadata" muted autoplay loop>
											<?php foreach( $featured['video']['sources'] as $source ) : ?>
											<source src="<?= $source['src'] ?>" type="<?= $source['type'] ?>">
											<?php endforeach ?>
										</video>
									</ls-media-wrapper>
									<?php } elseif( ! empty( $featured['poster'] ) ) { ?>
									<ls-media-wrapper class="ls--blurred" style="background-image: url( <?= $featured['poster'] ?>);"></ls-media-wrapper>
									<ls-media-wrapper style="background-image: url( <?= $featured['poster'] ?>);"></ls-media-wrapper>
									<?php } elseif( ! empty( $featured['template']['preview'] ) ) { ?>
									<ls-media-wrapper class="ls--blurred" style="background-image: url( <?= $featured['template']['preview'] ?>);"></ls-media-wrapper>
									<ls-media-wrapper style="background-image: url( <?= $featured['template']['preview'] ?>);"></ls-media-wrapper>
									<?php } ?>

								</div>

							</ls-templates-featured-media>
						</ls-featured-item>

						<?php if( count( $lsStoreData['featured'] ) > 1 ) : ?>
						<ls-featured-bullet class="<?= ( $featuredIndex === 0 ) ? 'ls--active' : '' ?>"></ls-featured-bullet>
						<?php endif ?>
					<?php endforeach ?>
					</ls-templates-featured>

					<ls-templates-title><ls-ib><?= __('Brand New Templates', 'LayerSlider') ?></ls-ib></ls-templates-title>
					<ls-templates-holder class="ls--templates-latest ls--templates-large">
						<?php lsPrintTemplateGridItems( '', $lsStoreData['new']['items'], 3 ) ?>
					</ls-templates-holder>

					<?php foreach( $lsStoreData['categories'] as $categoryKey => $category ) : ?>
					<?php if( ! empty( $category['supports']['discover'] ) ) : ?>
					<ls-templates-title>
						<ls-ib><?= sprintf( _x('Latest %s', 'Templates category (eg. Latest Sliders)', 'LayerSlider'), $category['name-alt'] ) ?></ls-ib>
					</ls-templates-title>
					<ls-templates-holder class="ls--clear ls--templates-list ls--grid-filter">
						<?php lsPrintTemplateGridItems( $categoryKey, $category['items'], 9, $lsStoreData['new']['handles'] ) ?>
					</ls-templates-holder>
					<ls-templates-button-holder>
						<ls-ib class="ls--button ls--show-all" data-show-category="<?= $categoryKey ?>"><?= __('Show All', 'LayerSlider') ?></ls-ib>
					</ls-templates-button-holder>
					<?php endif ?>
					<?php endforeach ?>


				</ls-templates-container>


				<!-- COLLECTIONS -->
				<?php if( ! empty( $lsStoreData['collections'] ) ) : ?>
				<ls-templates-container data-category="collections">

					<ls-b class="ls--sticky-header">
						<ls-templates-holder class="ls--collections-list">
							<?php
							$counter = 0;
							foreach( $lsStoreData['collections']['items'] as $handle => $collection ) {

								$activeClass = '';
								if( ! empty( $lsStoreData['collections']['active'] ) ) {
									if( $lsStoreData['collections']['active'] === $handle ) {
										$activeClass = 'ls--active';
									}
								} elseif( $counter++ === 0 ) {
									$activeClass = 'ls--active';
								}
							?>
							<ls-template class="<?= $activeClass ?>" data-handle="<?= $handle ?>" data-name="<?= $collection['name'] ?>">
								<ls-wrapper>
									<ls-image-holder <?= ! empty( $collection['image'] ) ? 'style="background-image: url('.$collection['image'].');"' : '' ?>></ls-image-holder>
									<ls-content-wrapper>
										<ls-template-name>
											<?= $collection['icon'] ?>
											<ls-text><?= $collection['name'] ?></ls-text>
										</ls-template-name>
									</ls-content-wrapper>
								</ls-wrapper>
							</ls-template>
							<?php } ?>
						</ls-templates-holder>
						<!-- <ls-templates-holder-separator></ls-templates-holder-separator> -->
					</ls-b>

					<ls-templates-holder id="ls--collection-templates" class="ls--templates-list">
					</ls-templates-holder>

				</ls-templates-container>
				<?php endif ?>


				<?php
					// Merge bundled sliders coming from theme and 3rd parties
					//
					// DO NOT MOVE ABOVE. It'll interfere with the Discover page.
					//
					if( ! $lsTemplatesConnectionError && ! empty( $lsStoreData['categories']['sliders'] ) ) {
						$lsStoreData['categories']['sliders']['items'] = array_merge( $demoSliders, $lsStoreData['categories']['sliders']['items'] );

					}
				?>


				<!-- CATEGORIES  -->
				<?php
				foreach( $lsStoreData['categories'] as $categoryKey => $category ) : ?>
				<ls-templates-container class="<?= ! empty( $category['supports']['collections'] ) ? 'ls-template-collections-target' : '' ?>" data-category="<?= $categoryKey ?>">

					<!-- TAGS -->
					<ls-b class="ls--sticky-header">
						<ls-tags-holder>
							<?php foreach( $category['tags'] as $handle => $tag ) : ?>
							<ls-tag class="ls--button <?= $tag['active'] ? 'ls--active' : '' ?>" data-handle="<?= $handle ?>">
								<?= $tag['icon'] ?>
								<ls-text><?= $tag['name'] ?></ls-text>
							</ls-tag>
							<?php endforeach ?>
						</ls-tags-holder>
						<!-- <ls-templates-holder-separator></ls-templates-holder-separator> -->
					</ls-b>

					<!-- TAG DESCRIPTIONS -->
					<ls-tag-descriptions-holder data-show-description="all">
						<?php foreach( $category['tags'] as $handle => $tag ) : ?>
						<?php if( ! empty( $tag['description']['text'] ) ) : ?>
						<ls-tag-description data-handle="<?= $handle ?>">

							<?php if( ! empty( $tag['description']['icon'] ) ) : ?>
							<ls-block class="ls-icon-holder">
								<?= $tag['description']['icon'] ?>
							</ls-block>
							<?php endif ?>
							<ls-block class="ls-text-holder">
								<ls-text><?= $tag['description']['text'] ?></ls-text>
							</ls-block>
						</ls-tag-description>
						<?php endif ?>
						<?php endforeach ?>
					</ls-tag-descriptions-holder>

					<!-- ITEMS -->
					<ls-templates-holder class="ls--templates-list">
						<?php lsPrintTemplateGridItems( $categoryKey, $category['items']) ?>
					</ls-templates-holder>
				</ls-templates-container>
				<?php endforeach ?>


				<!-- CONNECTION ERROR -->
				<?php if( $lsTemplatesConnectionError ) : ?>
				<ls-templates-container data-category="connection-failed">
					<?= lsGetSVGIcon('wifi-slash', 'duotone') ?>
					<ls-h1><?= __('Templates Unavailable', 'LayerSlider') ?></ls-h1>
					<ls-p><?= sprintf(__('LayerSlider encountered a problem preventing it from downloading the list of available templates. It’s likely a web server configuration issue. Please visit %sSystem Status%s to check for potential causes or try to %sreconnect%s.', 'LayerSlider'), '<a href="'.admin_url('admin.php?page=layerslider&section=system-status').'">', '</a>', '<a href="'.wp_nonce_url( admin_url('admin.php?page=layerslider&action=update_store'), 'update_store').'">', '</a>' ) ?></ls-p>
				</ls-templates-container>
				<?php endif ?>

			</ls-templates-containers>

		</ls-templates>

	</div>

</script>