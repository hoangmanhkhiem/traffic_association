<?php defined( 'LS_ROOT_FILE' ) || exit; ?>


<script type="text/html" id="tmpl-insert-media-modal">

	<lse-b id="lse-insert-media-modal-window" class="lse-light-theme">

		<kmw-h1 class="kmw-modal-title"><?= __('Insert Media', 'LayerSlider') ?></kmw-h1>

		<lse-grid>
			<lse-row>

				<lse-col>

					<lse-h2><?= __('Insert from URL (YouTube, Vimeo)', 'LayerSlider') ?></lse-h2>

					<lse-table-wrapper>

						<table>
							<tbody>
								<tr>
									<td>
										<input type="text">
									</td>
									<td>
										<lse-button class="lse-insert lse-insert-url">
											<lse-text>
												<?= __('Add Video', 'LayerSlider') ?>
											</lse-text>
										</lse-button>
									</td>
								</tr>
							</tbody>
						</table>

					</lse-table-wrapper>

					<lse-h2><?= __('Paste embed or HTML code', 'LayerSlider') ?></lse-h2>

					<lse-table-wrapper>

						<table>
							<tbody>
								<tr>
									<td>
										<textarea></textarea>
									</td>
									<td>
										<lse-button class="lse-insert lse-insert-embed">
											<lse-text>
												<?= __('Add Media', 'LayerSlider') ?>
											</lse-text>
										</lse-button>
									</td>
								</tr>
							</tbody>
						</table>

					</lse-table-wrapper>

					<lse-h2><?= __('Add self-hosted HTML 5 video / audio', 'LayerSlider') ?></lse-h2>

					<lse-table-wrapper>

						<table>
							<tbody>
								<tr>
									<td class="lse-text">
										<?= __('You can select multiple media formats to maximize browser compatibility across devices by holding down the Ctrl / Command key and selecting multiple uploads. We recommend using MP3 or AAC in MP4 for audio, and VP8+Vorbis in WebM or H.264+MP3/AAC in MP4 for video.', 'LayerSlider') ?>
									</td>
									<td>
										<lse-button class="lse-html5-button">
											<lse-text>
												<?= __('Choose Media', 'LayerSlider') ?>
											</lse-text>
										</lse-button>
									</td>
								</tr>
							</tbody>
						</table>

					</lse-table-wrapper>

					<lse-h2><?= __('Choose from assets', 'LayerSlider') ?></lse-h2>

					<lse-table-wrapper>

						<table>
							<tbody>
								<tr>
									<td class="lse-text">
										<?= __('Explore a large selection of professional stock videos and easily add them to your project with a simple click of a button.', 'LayerSlider') ?>
									</td>
									<td>
										<lse-button class="lse-giant lse-aic lse-assets-library-button" data-accepts="video" data-asset-for="layer-video" data-asset-category="videos">
											<lse-text>
												<?= __('Choose Asset', 'LayerSlider') ?>
											</lse-text>
										</lse-button>
									</td>
								</tr>
							</tbody>
						</table>

					</lse-table-wrapper>

				</lse-col>

				<lse-col>

					<lse-h2><?= __('Preview', 'LayerSlider') ?></lse-h2>
					<lse-b class="lse-media-preview-wrapper">
						<?= lsGetSVGIcon('play-circle') ?>
						<lse-b class="lse-media-preview"></lse-b>
					</lse-b>

				</lse-col>

			</lse-row>
		</lse-grid>

	</lse-b>

</script>


</script>