<?php defined( 'LS_ROOT_FILE' ) || exit; ?>

<lse-b class="lse-dn">

	<lse-b id="tmpl-shape-modal-left-sidebar">

		<kmw-navigation class="km-tabs-list" data-disable-auto-rename>

			<kmw-menuitem data-shape-type="line" data-shape-name="<?= _x('Line', 'Shape Type', 'LayerSlider') ?>">
				<?= lsGetSVGIcon('line', false, [ 'class' => 'kmw-icon-auto-height' ], 'kmw-icon') ?>
				<kmw-menutext><?= _x('Line', 'Shape Type', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-shape-type="rectangle" data-shape-name="<?= _x('Rectangle', 'Shape Type', 'LayerSlider') ?>">
				<?= lsGetSVGIcon('rectangle', false, [ 'class' => 'kmw-icon-auto-height' ], 'kmw-icon') ?>
				<kmw-menutext><?= _x('Rectangle', 'Shape Type', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-shape-type="oval" data-shape-name="<?= _x('Oval', 'Shape Type', 'LayerSlider') ?>">
				<?= lsGetSVGIcon('oval', false, [ 'class' => 'kmw-icon-auto-height' ], 'kmw-icon') ?>
				<kmw-menutext><?= _x('Oval', 'Shape Type', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem class="kmw-active" data-shape-type="polygon" data-shape-name="<?= _x('Polygon', 'Shape Type', 'LayerSlider') ?>">
				<?= lsGetSVGIcon('pentagon', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= _x('Polygon', 'Shape Type', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-shape-type="blob" data-shape-name="<?= _x('Blob', 'Shape Type', 'LayerSlider') ?>">
				<?= lsGetSVGIcon('blob', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= _x('Blob', 'Shape Type', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

			<kmw-menuitem data-shape-type="wave" data-shape-name="<?= _x('Wave', 'Shape Type', 'LayerSlider') ?>">
				<?= lsGetSVGIcon('wave', false, false, 'kmw-icon') ?>
				<kmw-menutext><?= _x('Wave', 'Shape Type', 'LayerSlider') ?></kmw-menutext>
			</kmw-menuitem>

		</kmw-navigation>

	</lse-b>

	<lse-b id="tmpl-shape-modal-sidebar">

		<kmw-h1 class="kmw-sidebar-title">
			<?= _x('Polygon Options', 'Default Shape Type', 'LayerSlider') ?>
		</kmw-h1>

		<lse-grid class="lse-form-elements lse-floating-window-theme">

			<lse-row class="lse-shape-modal-polygon">
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Side Count', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-range-inputs lse-3-1">
						<input class="lse-small" type="range" min="3" max="20" value="6">
						<input name="sideCount" type="number" min="3" max="20" value="6">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Side Length', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-range-inputs lse-3-1">
						<input class="lse-small" type="range" min="10" max="300" value="200">
						<input name="sideLength" type="number" min="10" max="300" value="200">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Radius', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-range-inputs lse-3-1">
						<input class="lse-small" type="range" min="1" max="200" value="5">
						<input name="radius" type="number" min="1" max="200" value="5">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Stroke size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-range-inputs lse-3-1">
						<input class="lse-small" type="range" min="0" max="100" value="0">
						<input name="strokeWidth" type="number" min="0" max="100" value="0">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Stroke Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Stroke Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="strokeColor" type="text" class="lse-color-picker-input" value="#000">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Fill Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Fill Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="fillColor" type="text" class="lse-color-picker-input" value="#0099ff">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
			</lse-row>

			<lse-row class="lse-shape-modal-oval">
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Horizontal size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="10" max="300" value="150">
						<input name="width" type="number" min="10" max="300" value="150">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Vertical size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="10" max="300" value="150">
						<input name="height" type="number" min="10" max="300" value="150">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Stroke size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="0" max="100" value="0">
						<input name="strokeWidth" type="number" min="0" max="100" value="0">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Stroke Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Fill Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="strokeColor" type="text" class="lse-color-picker-input" value="#000">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Fill Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Fill Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="fillColor" type="text" class="lse-color-picker-input" value="#0099ff">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
			</lse-row>

			<lse-row class="lse-shape-modal-rectangle">

				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Horizontal size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="10" max="300" value="200">
						<input name="width" type="number" min="10" max="300" value="200">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Vertical size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="10" max="300" value="150">
						<input name="height" type="number" min="10" max="300" value="150">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Radius', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="1" max="200" value="5">
						<input name="radius" type="number" min="1" max="200" value="5">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Stroke size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="0" max="100" value="0">
						<input name="strokeWidth" type="number" min="0" max="100" value="0">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Stroke Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Fill Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="strokeColor" type="text" class="lse-color-picker-input" value="#000">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Fill Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Fill Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="fillColor" type="text" class="lse-color-picker-input" value="#0099ff">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
			</lse-row>

			<lse-row class="lse-shape-modal-line">
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Length', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="1" max="1000" value="150">
						<input name="length" type="number" min="1" max="1000" value="150">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Thickness', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="1" max="1000" value="10">
						<input name="lineWidth" type="number" min="1" max="1000" value="10">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Rounded Endings', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-jcc">
						<label class="ls-switch"><input name="roundedEndings" type="checkbox" checked><ls-switch></ls-switch></label>
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Fill Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="fillColor" type="text" class="lse-color-picker-input" value="#000">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
			</lse-row>

			<lse-row class="lse-shape-modal-blob">

				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Complexity', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="3" max="10" value="4">
						<input name="complexity" type="number" min="3" max="10" value="4">
					</lse-ib>
				</lse-col>

				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Variation', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="10" max="90" value="30" step="1">
						<input name="variation" type="number" min="10" max="90" value="30" step="1">
						<lse-unit>%</lse-unit>
					</lse-ib>
				</lse-col>


				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Layers', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="1" max="3" value="1">
						<input name="layers" type="number" min="1" max="3" value="1">
					</lse-ib>
				</lse-col>

				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Stroke size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-range-inputs lse-3-1">
						<input class="lse-small" type="range" min="0" max="10" step="0.1" value="0">
						<input name="strokeWidth" type="number" min="0" max="100" value="0">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Stroke Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Stroke Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="strokeColor" type="text" class="lse-color-picker-input" value="#000">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>

				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Fill Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Fill Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="fillColor" type="text" class="lse-color-picker-input" value="#0099ff">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-separator></lse-separator>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-button class="lse-shape-modal-randomize">
							<lse-text>
								<?= __('Randomize', 'LayerSlider') ?>
							</lse-text>
							<ls-icon class="lse-show-dice-6">
								<div class="lse-icons-wrapper">
									<svg class="lse-dice-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM224 288c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm192 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm96 96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm96 96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm192 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm96 96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm96 96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm192 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
								</div>
							</ls-icon>
						</lse-button>
					</lse-ib>
				</lse-col>
			</lse-row>

			<lse-row class="lse-shape-modal-wave">

				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Complexity', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="3" max="25" value="7">
						<input name="complexity" type="number" min="3" max="25" value="7">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Variation', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="0" max="130" value="30" step="1">
						<input name="variation" type="number" min="0" max="130" value="30" step="1">
						<lse-unit>%</lse-unit>
					</lse-ib>
				</lse-col>

				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Balance', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="1" max="200" value="50" step="1">
						<input name="balance" type="number" min="1" max="200" value="50"  step="1">
						<lse-unit>%</lse-unit>
					</lse-ib>
				</lse-col>

				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Layers', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-3-1 lse-range-inputs">
						<input class="lse-small" type="range" min="1" max="4" value="1">
						<input name="layers" type="number" min="1" max="4" value="1">
					</lse-ib>
				</lse-col>

				<lse-col class="lse-wide">
					<lse-ib>
						<lse-text>
							<?= __('Stroke size', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib class="lse-range-inputs lse-3-1">
						<input class="lse-small" type="range" min="0" max="5" step="0.1" value="0">
						<input name="strokeWidth" type="number" min="0" max="100" value="0">
					</lse-ib>
				</lse-col>
				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Stroke Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Stroke Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="strokeColor" type="text" class="lse-color-picker-input" value="#000">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>

				<lse-col class="lse-3-1">
					<lse-ib>
						<lse-text>
							<?= __('Fill Color', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-smart-help lse-color-input" data-smart-help="color" data-smart-help-title="<?= __('Fill Color', 'LayerSlider') ?>" data-smart-load="lse-color-picker">
							<input name="fillColor" type="text" class="lse-color-picker-input" value="#0099ff">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>

				<lse-separator></lse-separator>

				<lse-col class="lse-full">
					<lse-ib>
						<lse-text>
							<?= __('Type', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>

					<lse-ib>
						<lse-button-group class="lse-max-one lse-min-one lse-toggle-all">
							<lse-button class="lse-shape-modal-wave-type" data-wave-type="smooth">
								<lse-text><?= __('Smooth', 'LayerSlider') ?></lse-text>
							</lse-button>
							<lse-button class="lse-shape-modal-wave-type" data-wave-type="square">
								<lse-text><?= __('Square', 'LayerSlider') ?></lse-text>
							</lse-button>
							<lse-button class="lse-shape-modal-wave-type" data-wave-type="pointy">
								<lse-text><?= __('Pointy', 'LayerSlider') ?></lse-text>
							</lse-button>
						</lse-button-group>
					</lse-ib>

				</lse-col>

				<lse-col class="lse-full">

					<lse-ib>
						<lse-text>
							<?= __('Position', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>

					<lse-ib>
						<lse-button-group class="lse-it-fix lse-icons-only lse-max-one lse-min-one lse-toggle-all">
							<lse-button class="lse-shape-modal-wave-direction" data-wave-direction="down">
								<?= lsGetSVGIcon('border-bottom', 'duotone') ?>
							</lse-button>
							<lse-button class="lse-shape-modal-wave-direction" data-wave-direction="left">
								<?= lsGetSVGIcon('border-left', 'duotone') ?>
							</lse-button>
							<lse-button class="lse-shape-modal-wave-direction" data-wave-direction="up">
								<?= lsGetSVGIcon('border-top', 'duotone') ?>
							</lse-button>
							<lse-button class="lse-shape-modal-wave-direction" data-wave-direction="right">
								<?= lsGetSVGIcon('border-right', 'duotone') ?>
							</lse-button>
						</lse-button-group>
					</lse-ib>

				</lse-col>

				<lse-col class="lse-full">

					<lse-ib>
						<lse-text>
							<?= __('Tools', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>

					<lse-ib>
						<lse-button-group class="lse-toggle-all">
							<lse-button class="lse-shape-modal-invert">
								<lse-text><?= __('Invert', 'LayerSlider') ?></lse-text>
							</lse-button>
							<lse-button class="lse-shape-modal-perfectionize">
								<lse-text><?= __('Perfect wave', 'LayerSlider') ?></lse-text>
							</lse-button>
						</lse-button-group>
					</lse-ib>

				</lse-col>

				<lse-separator></lse-separator>

				<lse-col class="lse-wide">
					<lse-ib>

						<lse-button class="lse-shape-modal-randomize">
							<lse-text>
								<?= __('Randomize', 'LayerSlider') ?>
							</lse-text>
							<ls-icon class="lse-show-dice-6">
								<div class="lse-icons-wrapper">
									<svg class="lse-dice-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM224 288c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm192 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm96 96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm96 96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm192 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm96 96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm96 96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
									<svg class="lse-dice-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M384 32H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V96c0-35.35-28.65-64-64-64zM128 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm192 192c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm0-96c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
								</div>
							</ls-icon>
						</lse-button>
					</lse-ib>

				</lse-col>
			</lse-row>



		</lse-grid>

		<lse-b id="lse-shape-sidebar-bottom">
			<lse-button class="lse-shape-modal-insert <?= LS_Config::isActivatedSite() ? '' : 'lse-premium-lock' ?>">
				<?php if( ! LS_Config::isActivatedSite() ) : ?>
				<?= lsGetSVGIcon('lock', false, ['class' => 'lse-it-fix'] ) ?>
				<?php endif ?>
				<lse-text><?= __('Insert Shape', 'LayerSlider') ?></lse-text>
			</lse-button>
			<lse-p class="lse-shape-modal-advice"><?= __('You can resize, rotate, and do other things with your shape once it’s inserted into the editor', 'LayerSlider') ?></lse-p>
		</lse-b>

	</lse-b>

	<lse-b id="tmpl-shape-modal">

		<lse-b class="lse-shape-modal-content">
			<lse-b class="lse-shape-modal-preview-area"></lse-b>
		</lse-b>

	</lse-b>

</lse-b>
