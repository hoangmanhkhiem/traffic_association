<?php defined( 'LS_ROOT_FILE' ) || exit; ?>

<!-- SMART HELP & OPTIONS -->
<lse-smart-help>
	<lse-smart-help-arrow></lse-smart-help-arrow>
	<lse-smart-help-bg>
		<lse-smart-help-inner>
			<lse-smart-help-overflow class="lse-scrollbar lse-scrollbar-light">
				<lse-smart-help-title></lse-smart-help-title>
				<lse-smart-help-content></lse-smart-help-content>
				<lse-grid class="lse-smart-help-cols">
				</lse-grid>
			</lse-smart-help-overflow>
		</lse-smart-help-inner>
		<lse-smart-help-outer></lse-smart-help-outer>
	</lse-smart-help-bg>
</lse-smart-help>

<lse-smart-help-elements>
	<lse-button class="lse-show-more lse-can-be-activated"><lse-i class="lse-open"><?= __('show', 'LayerSlider') ?></lse-i><lse-i class="lse-close"><?= __('hide', 'LayerSlider') ?></lse-i> <?= __('more', 'LayerSlider') ?></lse-button>
	<lse-smart-options-title><?= sprintf( _x('%s options', 'Possessive case: filter options, font options, etc.', 'LayerSlider'), '<lse-i></lse-i>' ) ?></lse-smart-options-title>
	<lse-smart-examples-title><?= sprintf( _x('%s examples', 'Possessive case: example of what value an input field can take, etc.', 'LayerSlider'), '<lse-i></lse-i>' ) ?></lse-smart-examples-title>
	<lse-smart-options-content></lse-smart-options-content>
	<lse-smart-operations-title>
		<?= __('smart operations', 'LayerSlider') ?>
		<lse-b><?= __('on selected layers’ values', 'LayerSlider') ?></lse-b>
		<a href="https://layerslider.com/documentation/#builder-smart-operations" target="_blank" class="lse-button">
			<?= lsGetSVGIcon('info-circle') ?>
		</a>
	</lse-smart-operations-title>
	<lse-smart-operations-content class="lse-smart-help-theme">
		<input class="lse-smart-operations-input" type="text" placeholder="examples:   +100   or   *2 --100">
		<lse-wrapper class="lse-smart-operations-help">
			<lse-text><?= __('QUICK HELP: You can use numbers and math expressions with the following operators:', 'LayerSlider') ?></lse-text>
			<lse-b>+</lse-b><lse-b>-</lse-b><lse-b>*</lse-b><lse-b>/</lse-b>
			<lse-b>++</lse-b><lse-b>--</lse-b><lse-b>**</lse-b><lse-b>//</lse-b><lse-b>+*</lse-b><lse-b>-*</lse-b><lse-b>*+</lse-b><lse-b>/+</lse-b>
			<lse-b>+++</lse-b><lse-b>---</lse-b><lse-b>***</lse-b><lse-b>///</lse-b><lse-b>++*</lse-b><lse-b>--*</lse-b><lse-b>**+</lse-b><lse-b>//+</lse-b>
		</lse-wrapper>
		<lse-wrapper class="lse-smart-operations-results">
			<lse-grid>
				<lse-row class="lse-smart-operations-placeholder-row">
					<lse-col class="lse-layer-thumb-placeholder"></lse-col>
					<lse-col class="lse-layer-name-placeholder"></lse-col>
					<lse-col class="lse-original-value-placeholder"></lse-col>
					<lse-col class="lse-arrow-placeholder">
						<?= lsGetSVGIcon('long-arrow-right',false,['class' => 'lse-it-0']) ?>
					</lse-col>
					<lse-col class="lse-new-value-placeholder"></lse-col>
				</lse-row>
			</lse-grid>
			<lse-wrapper class="lse-scrollbar lse-scrollbar-light">
				<lse-grid></lse-grid>
			</lse-wrapper>
			<lse-button-group>
				<lse-button class="lse-f11 lse-apply-button">
					<?= __('Apply new values', 'LayerSlider') ?>
				</lse-button>
				<lse-button class="lse-icons-only lse-f00 lse-toggle-sort">
					<?= lsGetSVGIcon('sort-alt',false, ['class' => 'lse-it-fix']) ?>
				</lse-button>
			</lse-button-group>
		</lse-wrapper>
	</lse-smart-operations-content>
	<lse-color-picker>
		<form class="lse-color-picker" name="grad">


			<?= lsGetSVGIcon('copy', false, [
				'class' => 'lse-color-picker-copy',
				'data-tt' => '',
				'data-tt-de' => 0
			]) ?>
			<lse-tt><?= __('Copy color or gradient') ?></lse-tt>

			<?= lsGetSVGIcon('clipboard', false, [
				'class' => 'lse-color-picker-paste',
				'data-tt' => '',
				'data-tt-de' => 0
			]) ?>
			<lse-tt><?= __('Paste color or gradient') ?></lse-tt>

			<div class="lse-grad-row">
				<lse-fe-wrapper class="lse-select">
					<select class="lse-grad-type lse-grad-input" name="type">
						<option value=""><?= __('Solid Color', 'LayerSlider') ?></option>
						<option value="linear-gradient"><?= __('Linear Gradient', 'LayerSlider') ?></option>
						<option value="radial-gradient"><?= __('Radial Gradient', 'LayerSlider') ?></option>
					</select>
				</lse-fe-wrapper>

				<div class="lse-grad-angle-inputs">
					<div class="lse-grad-angle-wrapper">
						<input class="lse-grad-angle lse-grad-input" type="number" placeholder="90" min="0" max="360" name="gradAngle" value="0">
					</div>
					<div class="lse-knob-wrapper"></div>
				</div>
			</div>
			<div class="lse-grad-row lse-grad-radial">
				<lse-fe-wrapper class="lse-select lse-radial">
					<select class="lse-grad-shape lse-grad-input lse-grad-radial" name="shape">
						<option value="ellipse"><?= __('Ellipse', 'LayerSlider') ?></option>
						<option value="circle"><?= __('Circle', 'LayerSlider') ?></option>
					</select>
				</lse-fe-wrapper>
				<lse-fe-wrapper class="lse-select">
					<select class="lse-grad-position lse-grad-input" name="position">
						<option value="center"><?= __('Center Center', 'LayerSlider') ?></option>
						<option value="center left"><?= __('Center Left', 'LayerSlider') ?></option>
						<option value="center right"><?= __('Center Right', 'LayerSlider') ?></option>
						<option value="top center"><?= __('Top Center', 'LayerSlider') ?></option>
						<option value="top left"><?= __('Top Left', 'LayerSlider') ?></option>
						<option value="top right"><?= __('Top Right', 'LayerSlider') ?></option>
						<option value="bottom center"><?= __('Bottom Center', 'LayerSlider') ?></option>
						<option value="bottom left"><?= __('Bottom Left', 'LayerSlider') ?></option>
						<option value="bottom right"><?= __('Bottom Right', 'LayerSlider') ?></option>
					</select>
				</lse-fe-wrapper>
			</div>
			<div class="lse-grad-bg">
				<div class="lse-grad-hr"></div>
			</div>
			<div class="lse-grad-slider"></div>
			<div class="lse-grad-color-wrapper">
				<input id="lse-color-picker-input" class="lse-color-picker-input lse-grad-color lse-grad-input" type="text" name="colorInput">
			</div>
			<div class="lse-grad-sample-trash"></div>
			<div class="lse-grad-sample-list"><div class="lse-grad-sample lse-grad-sample-add">+</div></div>
		</form>
	</lse-color-picker>
</lse-smart-help-elements>

<!-- SMART HELP CONTENTS -->

<lse-smart-help-contents>

	<!-- SLIDE DURATION & TIMINGS -->
	<div data-smart-help="slideduration">
		<?= __('The time that this slide remains visible before the slideshow attempts to change to the next slide. In other words, it’s the animation timeline’s length. Leave this option empty to let LayerSlider manage it automatically. This value is in milliseconds, so the value 1000 means 1 second.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="transitionduration">
		<?= __('You can speed up or slow down slide transitions by providing a custom animation duration. Leave this option empty to use the default speed. This value is in milliseconds, so the value 1000 means 1 second.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="timeshift">
		<?= __('You can shift the starting point of the slide animation timeline so that layers can animate in at an earlier time after a slide change. This value is in milliseconds, so the value 1000 means 1 second. You can only use negative values.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="zindex">
		<?= __('This option controls the stacking order of layers that overlap. In CSS, it’s commonly called as z-index. Elements with a higher value are stacked in front of elements with a lower one, effectively covering them. By default, this value is calculated automatically based on the order of your layers. Simply re-ordering them in the layers list can fix overlap issues. Use this option only if you want to set your own value manually in special cases like using static layers.', 'LayerSlider') ?>
		<br><br>
		<?= __('On each slide, the stacking order starts counting from 100. Providing a number less than 100 will put the layer behind every other layer on all slides. Specifying a much greater number like 500 will make the layer to be on top of everything else.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="overflow">
		<?= __('Sets the desired behavior when content does not fit into the layer.<br><br>

		<b>Visible:</b> Overflowing content will be visible, which is the default behavior in most cases. <br><br>

		<b>Hidden:</b> Overflowing content will be clipped, and will not be visible. <br><br>

		<b>Auto:</b> Makes the layer scrollable when it has overflowing content.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="userselect">
		<?= __('Controls whether users can select text and other interface elements of this layer. <br><br>

		<b>Inherit</b> uses the global value set in Project Settings → Miscellaneous.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="minresponsiveratio">
		<?= __('The minimum responsive ratio specifies the smallest size your layers can shrink to when viewed on smaller screens. By default, this value is zero, and there’s no size limitation. The value 1 corresponds to the layer’s original size, making it impossible to become smaller.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="maxresponsiveratio">
		<?= __('The maximum responsive ratio specifies the largest size your layers can enlarge to when viewed on bigger screens. There’s no size limitation by default. The value 1 corresponds to the layer’s original size, making it impossible to become larger. The value 2 means the layer can double in its size.', 'LayerSlider') ?>
	</div>


	<!-- OFFSETS -->
	<div data-smart-help="offset">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-25 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-27 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-26 lse-anim-box lse-axis-x  lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-29 lse-anim-box lse-axis-x  lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Shifts the layer position from its original with the given amount on the selected axis. Refer to the below options to see special values and supported units.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="offsetin">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-25 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-24 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-26 lse-anim-box lse-axis-x  lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Shifts the layer starting position with the given amount on the selected axis. Layers animate from the offset value toward their position set under the <b>STYLE</b> menu. Refer to the below options to see special values and supported units.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="offsettextin">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-25 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-24 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-26 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Shifts each text fragment starting position with the given amount on the selected axis. Text fragments animate from the offset value toward the whole joint text. Refer to the below options to see special values and supported units.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="offsetout">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-28 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-27 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-29 lse-anim-box lse-axis-x  lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Shifts the layer position with the given amount while it’s animating out. Layers animate from their current state toward the value you set here. Refer to the below options to see special values and supported units.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="offsettextout">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-28 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-27 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>

			<lse-ib class="lse-anim-box-29 lse-anim-box lse-axis-x  lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Shifts each text fragment position with the given amount on the selected axis while the layer animates out. Text fragments animate from the whole joint text toward the value you set here. Refer to the below options to see special values and supported units.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="offsetxscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-30 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Shifts the layer position with the given amount of intensity on the X axis by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="offsetyscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-31 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Shifts the layer position with the given amount of intensity on the Y axis by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>



	<!-- SCALES -->
	<div data-smart-help="scale">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-3 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-2 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-1 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-4 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Scales the layer with the given amount on the selected axis. Use the value 1 for the original size. The value 2 will double, while 0.5 will shrink the layer to half of its original size. A negative value flips the layer on the given axis.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="scalein">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-3 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-2 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-1 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-4 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Sets the initial layer scale on the selected axis before the layer starts animating in. Use the value 1 for the original size. The value 2 will double, while 0.5 will shrink the layer to half of its original size. A negative value flips the layer on the given axis. Layers animate from this value toward their appearance set under the <b>STYLE</b> menu.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="scaletextin">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-3 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-2 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-1 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-4 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Sets the initial scale of each text fragment on the selected axis before they start animating in. Use the value 1 for the original size. The value 2 will double, while 0.5 will shrink text fragments to half of their original size. A negative value flips text fragments on the given axis. Text fragments animate from this value toward the whole joint text. Refer to the below options to see special values and supported units.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="scaleout">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-3 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-2 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-1 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-4 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Scales the layer with the given amount on the selected axis while it’s animating out. Use the value 1 for the original size. The value 2 will double, while 0.5 will shrink the layer to half of its original size. A negative value flips the layer on the given axis. Layers animate from their current state toward the value you set here.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="scaletextout">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-3 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-2 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-1 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-4 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Scales each text fragment with the given amount on the selected axis while they’re animating out. Use the value 1 for the original size. The value 2 will double, while 0.5 will shrink each fragment to half of its original size. A negative value flips the fragments on the given axis. Text fragments animate from the whole joint text toward the value you set here.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="scalexscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-32 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Scales the layer with the given amount of intensity on the X axis by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="scaleyscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-33 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Scales the layer position with the given amount of intensity on the Y axis by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>



	<!-- ROTATE -->
	<div data-smart-help="rotate">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-7 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-6 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-5 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Rotates the layer by the given number of degrees on the selected axis. Negative values are allowed for counterclockwise rotation.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="rotatein">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-7 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-6 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-5 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Sets the initial layer rotation by the given number of degrees on the selected axis before the layer starts animating in. Negative values are allowed for counterclockwise rotation. Layers animate from this value toward their appearance set under the <b>STYLE</b> menu.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="rotatetextin">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-7 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-6 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-5 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Sets initial rotation of each text fragment by the given number of degrees on the selected axis before they start animating in. Negative values are allowed for counterclockwise rotation. Text fragments animate from this value toward the whole joint text.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="rotateout">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-7 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-6 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-5 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Rotates the layer with the given number of degrees on the selected axis while it’s animating out. Negative values are allowed for counterclockwise rotation. Layers animate from their current state toward the value you set here.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="rotatetextout">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-7 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-6 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-5 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Rotates each text fragment with the given number of degrees on the selected axis while they’re animating out. Negative values are allowed for counterclockwise rotation. Text fragments animate from the whole joint text toward the value you set here.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="rotatescroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-34 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Rotates the layer with the given amount of intensity by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="rotatexscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-35 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Rotates the layer with the given amount of intensity on the X axis by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="rotateyscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-36 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Rotates the layer with the given amount of intensity on the Y axis by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>



	<!-- SKEW -->
	<div data-smart-help="skew">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-8 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-9 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-10 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Skews the layer by the given number of degrees on the selected axis. Negative values are allowed for the reverse direction.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="skewin">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-8 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-9 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-10 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Sets the initial layer skew on the selected axis before the layer starts animating in. Negative values are allowed for the reverse direction. Layers animate from this value toward their appearance set under the <b>STYLE</b> menu.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="skewtextin">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-8 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-9 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-10 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Sets the initial skew of each text fragment on the selected axis before they start animating in. Negative values are allowed for the reverse direction. Text fragments animate from this value toward the whole joint text.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="skewout">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-8 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-9 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-10 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Skews the layer with the given amount of degrees on the selected axis while it’s animating out. Negative values are allowed for the reverse direction. Layers animate from their current state toward the value you set here.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="skewtextout">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-8 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-9 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-10 lse-anim-box lse-axis-x lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Skews each text fragment with the given amount of degrees on the selected axis while they’re animating out. Negative values are allowed for the reverse direction. Text fragments animate from the whole joint text toward the value you set here.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="skewxscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-37 lse-anim-box lse-axis-x">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Skews the layer with the given amount of intensity on the X axis by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="skewyscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-38 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Skews the layer with the given amount of intensity on the Y axis by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="opacityscroll">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-39 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Changes the transparency of the layer with the given amount of intensity by scrolling up or down on your site.', 'LayerSlider') ?>
		<br><br>
		<?= __('You can use decimal values and go over the pre-defined ranges to fine-tune the animation intensity.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="durationscroll">
		<?= __('The length of the scroll transition in milliseconds. A second equals to 1000 milliseconds. <br><br> Using smaller values will result in quick and fast animations, while larger values will result in slower and delayed animations.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="centerpointscroll">
		<?= __('Choose a center point for scroll transition layers where they will be aligned perfectly according to their original position. <br><br> <b>Inherit</b>: Uses the global value set in Project Settings → Defaults. <br><br> <b>Top</b>: When the top edge of the slider is at the top of the viewport. <br><br> <b>Center</b>: When the center of the slider is at the center of the viewport. <br><br> <b>Bottom</b>: When the bottom edge of the slider is at the bottom of the viewport.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="scrollgetposition">
		<?= __('Choose whether Scroll Transition should watch for the project position or the scene progression. By default, Scroll Transition won’t animate while the project is pinned when using a Sticky or Scroll Scene. Choose the “Scene” option if you’d like to use them in combination.', 'LayerSlider') ?>
	</div>






	<!-- TRANSFORM -->
	<div data-smart-help="transformorigin">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-13 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-11 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-12 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
		</lse-b>

		<?= __('The transform origin is the point around which transformations are applied. For example, a layer may rotate around its center point or an entirely custom point like one of its corners. See the below options for common values.', 'LayerSlider') ?>

	</div>

	<div data-smart-help="alternatetransformorigin">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-13 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-11 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
			<lse-ib class="lse-anim-box-12 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
				<lse-origin class="lse-anim-center">&#10011;</lse-origin>
			</lse-ib>
		</lse-b>

		<?= __('The transform origin is the point around which transformations are applied. For example, a layer may rotate around its center point or an entirely custom point like one of its corners. See the below options for common values.', 'LayerSlider') ?>
		<br><br>
		<b><?= __('This transform origin takes effect when you scroll past the center point set for this layer in Scroll Transition Properties.', 'LayerSlider') ?></b>

	</div>


	<div data-smart-help="perspective">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-14 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-15 lse-anim-box lse-axis-y">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Changes the perspective of animated objects in the 3D space. Large values of perspective cause milder transformations. Smaller values cause stronger and more noticeable transformations.', 'LayerSlider') ?>

	</div>

	<div data-smart-help="mirrortransition">
		<?= __('Mirrors the selected transition properties on slide change based on whether you navigate forward or backward in the slider. For example, if a layer normally animates from left to right, it’ll go the opposite direction from the right to the left when you navigate backward.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="mask">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-21 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-23 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-22 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-20 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('Clips (cuts off) the sides of layers by the given amount specified in pixels or percentages. Similar to animating layer dimensions, except it will not shift the layer and its contents. The four values are in order: top, right, bottom, and the layer’s left side. A four-point polygonal cutout can also be used by providing 4 pairs of coordinates, separated by commas. Refer to the provided examples for acceptable values.', 'LayerSlider') ?>

	</div>


	<div data-smart-help="maskStyle">

		<?= __('Clips (cuts out) a polygonal shape from the layer by the given amount specified in pixels or percentages. LayerSlider currently supports polygons with 4 points, and it can be used by providing 4 pairs of coordinates separated by commas. Refer to the provided examples for acceptable values.', 'LayerSlider') ?>

	</div>

	<div data-smart-help="easing">

		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-16 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-17 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-18 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
			<lse-ib class="lse-anim-box-19 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>

		<?= __('The timing function of the animation. With this function, you can manipulate the movement of the animated object. Please click on the link to open <a href="https://easings.net/" target="_blank">easings.net</a> for more information and more detailed examples.', 'LayerSlider') ?>

	</div>


	<div data-smart-help="width">
		<?= __('The width of the layer in pixels or percents. Percentage values are relative to the project canvas size.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="widthin">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-40 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>
		<?= __('Sets the layer’s initial width before it starts animating in. Layers animate from this value toward their appearance set under the <b>STYLE</b> menu. You can use pixels or percents. Percentage values are relative to the project canvas size.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="widthout">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-40 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>
		<?= __('Changes the layer’s width while it’s animating out. Layers animate from their current state toward the value you set here. You can use pixels or percents. Percentage values are relative to the project canvas size.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="height">
		<?= __('The height of the layer in pixels or percents. Percentage values are relative to the project canvas size.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="heightin">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-41 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>
		<?= __('Sets the layer’s initial height before it starts animating in. Layers animate from this value toward their appearance set under the <b>STYLE</b> menu. You can use pixels or percents. Percentage values are relative to the project canvas size.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="heightout">
		<lse-b class="lse-anim lse-jcse">
			<lse-ib class="lse-anim-box-41 lse-anim-box">
				<lse-anim-block class="lse-anim-rect lse-anim-orig"></lse-anim-block>
				<lse-anim-block class="lse-anim-rect lse-anim-moved"></lse-anim-block>
			</lse-ib>
		</lse-b>
		<?= __('Changes the layer’s height while it’s animating out. Layers animate from their current state toward the value you set here. You can use pixels or percents. Percentage values are relative to the project canvas size.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="left">
		<?= __('The layer’s position from the left edge of the project canvas. You can use pixels and percents. Percentage values align the layer’s center point to the given position, so 50% places the layer exactly at the center. The 0% and 100% special values align the layer to the left and right edges.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="top">
		<?= __('The layer’s position from the top edge of the project canvas. You can use pixels and percents. Percentage values align the layer’s center point to the given position, so 50% places the layer exactly at the middle. The 0% and 100% special values align the layer to the top and bottom edges.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="position-adjustment-left">
		<?= __('Useful when you want to position layers relative to the right side. In this case, set the value of the left position to 100% and enter the distance from the right side in this field as a negative value in pixels.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="position-adjustment-top">
		<?= __('Useful when you want to position layers relative to the bottom. In this case, set the value of the top position to 100% and enter the distance from the bottom edge in this field as a negative value in pixels.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="duration">
		<?= __('The length of the transition in milliseconds. A second equals to 1000 milliseconds.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="textshiftduration">
		<?= __('Delays the transition of each text fragment relative to each other. A second equals to 1000 milliseconds.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="parallaxlevel">
		<?= __('Sets the intensity of the parallax effect. Use negative values to shift layers in the opposite direction.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="parallaxmoveduration">
		<?= __('Controls the speed of animating layers when you move your mouse cursor or tilt your mobile device. This value is in milliseconds. A second equals to 1000 milliseconds.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="parallaxleaveduration">
		<?= __('Controls how quickly parallax layers revert to their original position when you move your mouse cursor outside of the slider. This value is in milliseconds. A second equals to 1000 milliseconds.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="parallaxdistance">
		<?= __('Increase or decrease the amount of layer movement when moving your mouse cursor or tilting on a mobile device.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="parallaxrotation">
		<?= __('Increase or decrease the amount of layer rotation in the 3D space when moving your mouse cursor or tilting on a mobile device.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="startat">
		<?= __('Sets the start time of the selected transition with the given amount of milliseconds. A second equals to 1000 milliseconds.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="startatfirst">
		<?= __('Sets the start time of the selected transition with the given amount of milliseconds. A second equals to 1000 milliseconds.', 'LayerSlider') ?>
		<br><br><b>
		<?= __('This value overwrites the normal “Start at” value in the first cycle if the layer is on the first slide.', 'LayerSlider') ?>
		</b>
	</div>

	<div data-smart-help="startwhen">
		<?= __('The starting time of this transition. Choose from one of the pre-defined options to use relative timing, which then can also be shifted with custom operations below.', 'LayerSlider') ?>
	</div>
	<div data-smart-help="startwhenmodifier">
		<?= __('Shifts the above selected starting time by performing a custom operation.', 'LayerSlider') ?>
		<br><br>
		<?= __('For example, “- 1000” will advance the animation by playing it 1 second (1000 milliseconds) earlier.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="opacity">
		<?= __('Opacity specifies the transparency of layers. You can enter a decimal number between 0 and 1. The value 0 means the layer is fully transparent and invisible, while the value 1 results in a fully solid and opaque layer.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="filter">
		<?= __('Filters provide effects like blurring, color shifting, or changing the brightness, contrast, saturation of your layers, among many others. Use the below options to easily apply multiple filters on your layers.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="filterin">
		<?= __('Sets the initial layer filters before it starts animating in. Layers animate from this value toward their appearance set under the <b>STYLE</b> menu. Filters provide effects like blurring, color shifting, or changing the brightness, contrast, saturation of your layers, among many others. Use the below options to easily apply multiple filters on your layers.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="filterout">
		<?= __('Applies filters on the layer while it’s animating out. Layers animate from their current state toward the value you set here. Filters provide effects like blurring, color shifting, or changing the brightness, contrast, saturation of your layers, among many others. Use the below options to easily apply multiple filters on your layers.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="loopwait">
		<?= __('Waiting time between repeats in milliseconds. A second is 1000 milliseconds.', 'LayerSlider') ?>
	</div>


	<div data-smart-help="static">
		<?= __('Layers can be kept at their place across multiple slides. Here you can select the slide on which this layer should animate out.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="skipviewport">
		<?= __('By default, LayerSlider will start playing your project when it enters the viewport so that visitors will not miss the animation and effects you intended them to see, even if the project is below the fold. This behavior is controlled by the Project Settings → Slideshow → Start Only In Viewport option.<br><br>

		However, there are cases where you might want to display certain interface elements immediately, even if the project canvas is only partially visible and the playback of your project hasn’t started yet.<br><br>

		With this option, you can exclude layers from waiting for the playback to begin, and they will start the selected transitions immediately.', 'LayerSlider') ?>
	</div>



	<div data-smart-help="fontfamily">

		<?php if( ! $googleFontsEnabled ) : ?>
		<lse-b class="lse-notification lse-smart-help-notification">
			<lse-text><?= __('It looks like you’ve disabled Google Fonts in LayerSlider plugin settings. We recommend enabling Google Fonts, so you can enhance your content with beautiful and unique typography.', 'LayerSlider') ?></lse-text>
		</lse-b>
		<?php else : ?>
		<?= __('Enhance your content with beautiful and unique typography. Google Fonts provides over a thousand web-optimized fonts.', 'LayerSlider') ?>
		<lse-button class="lse-layer-open-font-library">
			<?= __('Browse Google Fonts', 'LayerSlider') ?>
		</lse-button>
		<?php endif ?>
	</div>


	<div data-smart-help="color">
	</div>


	<div data-smart-help="textcolor">
	</div>


	<div data-smart-help="iconcolor">
	</div>


	<div data-smart-help="backgroundcolor">
	</div>


	<div data-smart-help="backgroundsize">
		<?= __('Sets the size of the background image. The image can be left to its natural size, stretched, or constrained to fit the available space.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="smartbg">
		<?= __('When enabled, the layer background will use the whole slide area, acting like a slide background, but only the part covered by the layer will be visible. It creates an effect as if you were looking through the layer - like a window - to the background.
			<br><br>

			<b>Continuous Background:</b><br>
			The cut out part is static and will not change as the layer moves.

			<br><br>

			<b>Dynamic for Transitions:</b><br>
			The cut out part is dynamic and will show the corresponding part of the background for the selected transition type as the layer moves.

			<br><br>

			Useful tip: use this feature with more layers and the same background to create great effects.', 'LayerSlider') ?>

			<br><br>
			<a class="lse-button lse-link" target="_blank" href="https://layerslider.com/blog/introducing-smart-background/"><?= __('Explore Live Examples', 'LayerSlider') ?> </a>
	</div>



	<div data-smart-help="deeplink">
		<?= __('A slide alias name, which you can use in your URLs with a hash tag so LayerSlider will start with the corresponding slide when visitors arrive to the page. <br><br> Example: domain.com/page/#welcome<br><br>Use only lowercase alphanumeric values. You can also use this feature to implement slide navigation with links.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="sceneheight">
		<?= __('The length of the scrollable area. Use larger values to keep the slider visible for longer, and play animations slower in case of a Scroll Scene. Supported units: <br><br> <b>px:</b> A fixed value specified in pixels. <br><br> <b>%</b> or <b>sh:</b> Percentage of the slider height. 1sh equals to 1% of the slider height. This value scales dinamically when the slider’s size changes. <b> <br><br> vh:</b> Percentage of the viewport (browser window) height. 1vh equals to 1% of the viewport height. This value scales dinamically when the browser window is resized.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="projectverticalspacing">
		<?= __('Creates empty space above and below your projects (i.e. margins). Supported units: <br><br> <b>px:</b> A fixed value specified in pixels. <br><br> <b>%</b> or <b>sh:</b> Percentage of the slider height. 1sh equals to 1% of the slider height. This value scales dinamically when the slider’s size changes. <b> <br><br> vh:</b> Percentage of the viewport (browser window) height. 1vh equals to 1% of the viewport height. This value scales dinamically when the browser window is resized.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="firstslide">
		<?= __('Enter the slide number you want your project to start with, or choose from the below options.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="performancemodethreshold">
		<?= __('The minimum distance between the slider and viewport edges when Performance Mode should activate as described on the right. Supported units: <br><br> <b>px:</b> A fixed value specified in pixels. <br><br> <b>%</b> or <b>sh:</b> Percentage of the slider height. 1sh equals to 1% of the slider height. This value scales dinamically when the slider’s size changes. <b> <br><br> vh:</b> Percentage of the viewport (browser window) height. 1vh equals to 1% of the viewport height. This value scales dinamically when the browser window is resized.', 'LayerSlider') ?>
	</div>



	<div data-smart-help="scroll-to-scene-position">
		<?= __('The scene position to animate to. Supported units: <br><br> <b>%:</b> Percentage of the scene’s length. 0% means the beginning, while 100% means the end of the scene. <br><br> <b>ms:</b> A specific point in time on the scene’s animation timeline in milliseconds. A second is 1000 milliseconds. Sticky scenes do not support this unit.', 'LayerSlider') ?>
	</div>

	<div data-smart-help="scroll-to-timeline-position">
		<?= __('The timeline position to animate to or the amount to play forward/backward. Supported units: <br><br> <b>%:</b> Percentage of the slide duration. 0% means the beginning, while 100% means the end of the slide timeline. <br><br> <b>ms:</b> A specific point or amount of time in milliseconds. A second is 1000 milliseconds.', 'LayerSlider') ?>
	</div>

</lse-smart-help-contents>

<lse-smart-options-contents>

	<div data-smart-options="left">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="0%"><?= __('Left', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50%"><?= __('Center', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="100%"><?= __('Right', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="top">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="0%"><?= __('Top', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50%"><?= __('Middle', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="100%"><?= __('Bottom', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="offset">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="100px"><?= __('100px', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-x _textin-x" data-smart-inject="left"><?= __('Enter the stage from left', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-x _textin-x" data-smart-inject="right"><?= __('Enter the stage from right', 'LayerSlider') ?></lse-li>
			<lse-li class="_out-x _textout-x"data-smart-inject="left"><?= __('Leave the stage on left', 'LayerSlider') ?></lse-li>
			<lse-li class="_out-x _textout-x" data-smart-inject="right"><?= __('Leave the stage on right', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-y _textin-y" data-smart-inject="top"><?= __('Enter the stage from top', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-y _textin-y" data-smart-inject="bottom"><?= __('Enter the stage from bottom', 'LayerSlider') ?></lse-li>
			<lse-li class="_out-y _textout-y" data-smart-inject="top"><?= __('Leave the stage on top', 'LayerSlider') ?></lse-li>
			<lse-li class="_out-y _textout-y" data-smart-inject="bottom"><?= __('Leave the stage on bottom', 'LayerSlider') ?></lse-li>
			<lse-li class="_loop-x"data-smart-inject="left"><?= __('Move out of stage on left', 'LayerSlider') ?></lse-li>
			<lse-li class="_loop-x" data-smart-inject="right"><?= __('Move out of stage on right', 'LayerSlider') ?></lse-li>
			<lse-li class="_loop-y" data-smart-inject="top"><?= __('Move out of stage on top', 'LayerSlider') ?></lse-li>
			<lse-li class="_loop-y" data-smart-inject="bottom"><?= __('Move out of stage on bottom', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-x _textin-x _out-x _textout-x _loop-x" data-smart-inject="100lw"><?= __('100% layer width', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-x _textin-x _out-x _textout-x _loop-x" data-smart-inject="-100lw"><?= __('-100% layer width', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-x _textin-x _out-x _textout-x _loop-x" data-smart-inject="50sw"><?= __('50% slider width', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-x _textin-x _out-x _textout-x _loop-x" data-smart-inject="-50sw"><?= __('-50% slider width', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-y _textin-y _out-y _textout-y _loop-y" data-smart-inject="100lh"><?= __('100% layer height', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-y _textin-y _out-y _textout-y _loop-y" data-smart-inject="-100lh"><?= __('-100% layer height', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-y _textin-y _out-y _textout-y _loop-y" data-smart-inject="50sh"><?= __('50% slider height', 'LayerSlider') ?></lse-li>
			<lse-li class="_in-y _textin-y _out-y _textout-y _loop-y" data-smart-inject="-50sh"><?= __('-50% slider height', 'LayerSlider') ?></lse-li>
			<lse-li class="_hover-x" data-smart-inject="20lw"><?= __('20% layer width', 'LayerSlider') ?></lse-li>
			<lse-li class="_hover-x" data-smart-inject="-20lw"><?= __('-20% layer width', 'LayerSlider') ?></lse-li>
			<lse-li class="_hover-y" data-smart-inject="20lh"><?= __('20% layer height', 'LayerSlider') ?></lse-li>
			<lse-li class="_hover-y" data-smart-inject="-20lh"><?= __('-20% layer height', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[-100..100]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[-90|10|70]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
			<lse-li class="_textin-x _textin-y _textout-x _textout-y" data-smart-inject="50|-50|25|-25"><?= __('Cycle through multiple values', 'LayerSlider') ?></lse-li>
		</lse-ul>

	</div>

	<div data-smart-options="rotate">

		<lse-ul class="lse-smart-inject">
			<lse-li class="_in _out" data-smart-inject="="><?= __('Inherit value from style settings', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[-5..40]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[-5|9|60]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
			<lse-li class="_text" data-smart-inject="30|60|90"><?= __('Cycle through multiple values', 'LayerSlider') ?></lse-li>
			<lse-li class="_in _out" data-smart-inject="+=60"><?= __('Add 60 to style settings value', 'LayerSlider') ?></lse-li>
			<lse-li class="_in _out" data-smart-inject="/=2"><?= __('Divide style settings value by 2', 'LayerSlider') ?></lse-li>
		</lse-ul>

	</div>

	<div data-smart-options="scale">

		<lse-ul class="lse-smart-inject">
			<lse-li class="_in _out" data-smart-inject="="><?= __('Inherit value from style settings', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="1"><?= __('Original size', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="2"><?= __('Enlarge layer to double size', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0.5"><?= __('Shrink layer to half size', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="-1"><?= __('Flip layer', 'LayerSlider') ?></lse-li>
			<lse-li class="_transition" data-smart-inject="[2..3]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li class="_transition" data-smart-inject="[0.5|1.5|2]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
			<lse-li class="_text" data-smart-inject="3|2|1.5"><?= __('Cycle through multiple values', 'LayerSlider') ?></lse-li>
			<lse-li class="_in _out" data-smart-inject="*=1.5"><?= __('Multiply style settings value by 1.5', 'LayerSlider') ?></lse-li>
			<lse-li class="_in _out" data-smart-inject="/=2"><?= __('Divide style settings value by 2', 'LayerSlider') ?></lse-li>
		</lse-ul>

	</div>

	<div data-smart-options="skew">

		<lse-ul class="lse-smart-inject">
			<lse-li class="_in _out" data-smart-inject="="><?= __('Inherit value from style settings', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[-10..10]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[5|10|15]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
			<lse-li class="_text" data-smart-inject="10|20|30"><?= __('Cycle through multiple values', 'LayerSlider') ?></lse-li>
			<lse-li class="_in _out" data-smart-inject="+=30"><?= __('Add 30 to style settings value', 'LayerSlider') ?></lse-li>
		</lse-ul>

	</div>

	<div data-smart-options="width">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="300px"><?= __('300px', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50%"><?= __('50%', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[0..500]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[0..500]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[10|50|100]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="height">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="100px"><?= __('100px', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50%"><?= __('50%', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[0..200]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[10|50|100]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="backgroundsize">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="auto" data-tt><?= __('auto', 'LayerSlider') ?></lse-li><lse-tt><?= __('The background image is displayed in its original size', 'LayerSlider') ?></lse-tt>
			<lse-li data-smart-inject="cover" data-tt><?= __('cover', 'LayerSlider') ?></lse-li><lse-tt><?= __('Resize the background image to cover the entire container, even if it has to stretch the image or cut a little bit off one of the edges', 'LayerSlider') ?></lse-tt>
			<lse-li data-smart-inject="contain" data-tt><?= __('contain', 'LayerSlider') ?></lse-li><lse-tt><?= __('Resize the background image to make sure the image is fully visible', 'LayerSlider') ?></lse-tt>
			<lse-li data-smart-inject="100% 100%" data-tt><?= __('stretch', 'LayerSlider') ?></lse-li><lse-tt><?= __('Stretches the background image to the same size as the layer. May result in distorted image.', 'LayerSlider') ?></lse-tt>
			<lse-li data-smart-inject="initial" data-tt><?= __('initial', 'LayerSlider') ?></lse-li><lse-tt><?= __('Sets this property to its default value.', 'LayerSlider') ?></lse-tt>
			<lse-li data-smart-inject="300px" data-tt><?= __('300px (example)', 'LayerSlider') ?></lse-li><lse-tt><?= __('Sets this property to its default value.', 'LayerSlider') ?></lse-tt>
			<lse-li data-smart-inject="80%" data-tt><?= __('80% (example)', 'LayerSlider') ?></lse-li><lse-tt><?= __('Sets this property to its default value.', 'LayerSlider') ?></lse-tt>
		</lse-ul>

	</div>

	<div data-smart-options="fontfamily">

		<?php if( $googleFontsEnabled ) : ?>
		<lse-b class="lse-smart-help-fonts-in-projects lse-dn">
			<lse-smart-options-subtitle><?= __('Used in Project', 'LayerSlider') ?></lse-smart-options-subtitle>
			<lse-ul class="lse-smart-inject"></lse-ul>
		</lse-b>
		<?php endif ?>

		<lse-smart-options-subtitle><?= __('Common Fonts', 'LayerSlider') ?></lse-smart-options-subtitle>
		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="Arial">Arial</lse-li>
			<lse-li data-smart-inject="Helvetica">Helvetica</lse-li>
			<lse-li data-smart-inject="Georgia">Georgia</lse-li>
			<lse-li data-smart-inject="'Comic Sans MS'">Comic Sans MS</lse-li>
			<lse-li data-smart-inject="Impact">Impact</lse-li>
			<lse-li data-smart-inject="Tahoma">Tahoma</lse-li>
			<lse-li data-smart-inject="Verdana">Verdana</lse-li>
		</lse-ul>

		<lse-b class="lse-smart-help-external-fonts lse-dn">
			<lse-smart-options-subtitle><?= __('External Fonts', 'LayerSlider') ?></lse-smart-options-subtitle>
			<lse-ib class="lse-mt-10"><?= __('Fonts loaded by third parties might not be present on every page and might only support some font weights and styles.', 'LayerSlider') ?></lse-ib>
			<lse-ul class="lse-smart-inject"></lse-ul>
		</lse-b>

	</div>

	<div data-smart-options="maskin">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="="><?= __('Inherit value from style settings', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 0 100% 0"><?= __('From top', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 0 0 100%"><?= __('From right', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="100% 0 0 0"><?= __('From bottom', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 100% 0 0"><?= __('From left', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50% 0 50% 0"><?= __('From middle (vertically)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 50% 0 50%"><?= __('From center (horizontally', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50% 50%, 50% 50%, 50% 50%, 50% 50%"><?= __('From absolute center point', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50% 0, 100% 50%, 50% 100%, 0 50%"><?= __('Parallelogram', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="100% 0, 100% 100%, 0 100%, 0 0"><?= __('Rotate 90deg', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 100%, 0 0, 100% 0, 100% 100%"><?= __('Rotate -90deg', 'LayerSlider') ?></lse-li>
		</lse-ul>

	</div>

	<div data-smart-options="mask">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="50% 0, 100% 50%, 50% 100%, 0 50%"><?= __('Parallelogram', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50% 0, 50% 0, 100% 100%, 0 100%"><?= __('Top arrow', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 0, 100% 50%, 100% 50%, 0 100%"><?= __('Right arrow', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 0, 100% 0, 50% 100%, 50% 100%"><?= __('Bottom arrow', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 50%, 100% 0, 100% 100%, 0 50%"><?= __('Left arrow', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 50%, 100% 0, 100% 50%, 0 100%"><?= __('Skew to top', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50% 0, 100% 0, 50% 100%, 0 100%"><?= __('Skew to right', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 0, 100% 50%, 100% 100%, 0 50%"><?= __('Skew to bottom', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 0, 50% 0, 100% 100%, 50% 100%"><?= __('Skew to left', 'LayerSlider') ?></lse-li>
		</lse-ul>

	</div>

	<div data-smart-options="maskout">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="="><?= __('Inherit value from style settings', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 0 100% 0"><?= __('To top', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 0 0 100%"><?= __('To right', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="100% 0 0 0"><?= __('To bottom', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 100% 0 0"><?= __('To left', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50% 0 50% 0"><?= __('To middle (vertically)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 50% 0 50%"><?= __('To center (horizontally', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50% 50%, 50% 50%, 50% 50%, 50% 50%"><?= __('To absolute center point', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="50% 0, 100% 50%, 50% 100%, 0 50%"><?= __('Parallelogram', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="100% 0, 100% 100%, 0 100%, 0 0"><?= __('Rotate 90deg', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0 100%, 0 0, 100% 0, 100% 100%"><?= __('Rotate -90deg', 'LayerSlider') ?></lse-li>
		</lse-ul>

	</div>

	<div data-smart-options="transformorigin">
		<lse-grid class="lse-transform-origin-smart-select lse-form-elements lse-smart-help-theme lse-collect-values">
			<lse-row>
				<lse-col class="lse-full">
					<lse-ib>
						<lse-text>
							<?= __('X axis', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-select">
							<select class="lse-value">
								<option value="left"><?= __('Left', 'LayerSlider') ?></option>
								<option value="center" selected="selected"><?= __('Center', 'LayerSlider') ?></option>
								<option value="right"><?= __('Right', 'LayerSlider') ?></option>
								<option value="sliderleft"><?= __('Left side of the project canvas', 'LayerSlider') ?></option>
								<option value="slidercenter"><?= __('Center of the project canvas', 'LayerSlider') ?></option>
								<option value="sliderright"><?= __('Right side of the project canvas', 'LayerSlider') ?></option>
							</select>
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-col class="lse-full">
					<lse-ib>
						<lse-text>
							<?= __('Y axis', 'LayerSlider') ?>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper class="lse-select">
							<select class="lse-value">
								<option value="top"><?= __('Top', 'LayerSlider') ?></option>
								<option value="center" selected="selected"><?= __('Center', 'LayerSlider') ?></option>
								<option value="bottom"><?= __('Bottom', 'LayerSlider') ?></option>
								<option value="slidertop"><?= __('Top of the project canvas', 'LayerSlider') ?></option>
								<option value="slidermiddle"><?= __('Middle of the project canvas', 'LayerSlider') ?></option>
								<option value="sliderbottom"><?= __('Bottom of the project canvas', 'LayerSlider') ?></option>
							</select>
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-col class="lse-full">
					<lse-ib>
						<lse-text>
							<?= __('Z axis', 'LayerSlider') ?><lse-units>px %</lse-units>
						</lse-text>
					</lse-ib>
					<lse-ib>
						<lse-fe-wrapper>
							<input class="lse-value" type="text">
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-col>
					<lse-button><?= __('Apply selected values', 'LayerSlider') ?></lse-button>
				</lse-col>
			</lse-row>
		</lse-grid>
	</div>


	<div data-smart-options="opacity">
		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="1"><?= __('Fully opaque', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0.5"><?= __('Semi-transparent', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0"><?= __('Invisible', 'LayerSlider') ?></lse-li>
			<lse-li class="_transition" data-smart-inject="[0.5..1]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li class="_transition" data-smart-inject="[0.3|0.5|0.7]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>


	<div data-smart-options="filter">
		<lse-grid class="lse-form-elements lse-smart-help-theme lse-form-rows lse-collect-values">
			<?= lsGetSVGIcon('times-circle',false,['class' => 'lse-form-rows-close']) ?>
			<lse-row>
				<lse-col class="lse-placeholder">
					<lse-ib class="lse-2-1">
						<lse-fe-wrapper class="lse-select">
							<select class="lse-key" data-auto-unit="true">
								<option value=""><?= __('Add new property', 'LayerSlider') ?></option>
								<option value="blur" data-unit="px"><?= __('Blur', 'LayerSlider') ?></option>
								<option value="brightness" data-unit="%"><?= __('Brightness', 'LayerSlider') ?></option>
								<option value="contrast" data-unit="%"><?= __('Contrast', 'LayerSlider') ?></option>
								<option value="drop-shadow"><?= __('Drop Shadow', 'LayerSlider') ?></option>
								<option value="grayscale" data-unit="%"><?= __('Grayscale', 'LayerSlider') ?></option>
								<option value="hue-rotate" data-unit="deg"><?= __('Hue-Rotate', 'LayerSlider') ?></option>
								<option value="invert" data-unit="%"><?= __('Invert', 'LayerSlider') ?></option>
								<option value="opacity" data-unit="%"><?= __('Opacity', 'LayerSlider') ?></option>
								<option value="saturate" data-unit="%"><?= __('Saturate', 'LayerSlider') ?></option>
								<option value="sepia" data-unit="%"><?= __('Sepia', 'LayerSlider') ?></option>
							</select>
						</lse-fe-wrapper>
						<lse-fe-wrapper class="lse-show-only-if-other-has-value">
							<input class="lse-value" type="text" value=""><lse-unit></lse-unit>
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-col>
					<lse-button><?= __('Apply selected values', 'LayerSlider') ?></lse-button>
				</lse-col>
			</lse-row>
		</lse-grid>
	</div>

	<div data-smart-options="minresponsiveratio">
		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="0"><?= __('No limitation', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0.5"><?= __('Half the layer’s original size', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="1"><?= __('Don’t allow shrinking', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="maxresponsiveratio">
		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject=""><?= __('No limitation', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="2"><?= __('Double the layer’s original size', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="1"><?= __('Don’t allow enlarging', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="mirrortransition">
		<lse-grid class="lse-form-elements lse-smart-help-theme lse-form-rows lse-collect-values">
			<?= lsGetSVGIcon('times-circle',false,['class' => 'lse-form-rows-close']) ?>
			<lse-row>
				<lse-col class="lse-placeholder">
					<lse-ib>
						<lse-fe-wrapper class="lse-select">
							<select class="lse-value">
								<option value=""><?= __('Select properties to mirror', 'LayerSlider') ?></option>
								<option value="x"><?= __('Offset X', 'LayerSlider') ?></option>
								<option value="y"><?= __('Offset Y', 'LayerSlider') ?></option>
								<option value="scalex"><?= __('Scale X', 'LayerSlider') ?></option>
								<option value="scaley"><?= __('Scale Y', 'LayerSlider') ?></option>
								<option value="rotation"><?= __('Rotation', 'LayerSlider') ?></option>
								<option value="rotationx"><?= __('Rotation X', 'LayerSlider') ?></option>
								<option value="rotationy"><?= __('Rotation Y', 'LayerSlider') ?></option>
								<option value="skewx"><?= __('Skew X', 'LayerSlider') ?></option>
								<option value="skewy"><?= __('Skew Y', 'LayerSlider') ?></option>
							</select>
						</lse-fe-wrapper>
					</lse-ib>
				</lse-col>
				<lse-col>
					<lse-button><?= __('Apply selected values', 'LayerSlider') ?></lse-button>
				</lse-col>
			</lse-row>
		</lse-grid>
	</div>

	<div data-smart-options="startatin">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="650"><?= __('650ms', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[500..1000]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[50|450|850]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="duration">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="3000"><?= __('3s', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[900..1800]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[1000|2000|3000]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="loopwait">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="2500"><?= __('2.5s', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[1000..4000]"><?= __('Random between two values', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="[500|1000|1500]"><?= __('Random from listed values', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="applytoallslides">
		<lse-grid class="lse-form-elements lse-smart-help-theme lse-form-rows">
			<lse-row>
				<lse-col>
					<lse-button class="lse-apply-value-to-all-slides"><?= __('Apply Value To All Slides', 'LayerSlider') ?></lse-button>
				</lse-col>
			</lse-row>
		</lse-grid>
	</div>

	<div data-smart-options="sceneheight">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject=""><?= __('auto (Calculated automatically based on slide duration and slider height)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="2000px"><?= __('2000px', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="250sh"><?= __('250sh (250% of slider height)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="150vh"><?= __('150vh (150% of viewport height)', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="projectverticalspacing">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="200px"><?= __('200px', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="60sh"><?= __('60sh (60% of slider height)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="90vh"><?= __('90vh (90% of viewport height)', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="firstslide">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject=""><?= __('Normal sequence', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="random"><?= __('Random', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="performancemodethreshold">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject=""><?= __('Default', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="0"><?= __('Activate immediately once the slider leaves the viewport', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="100vh"><?= __('Activate once the slider moves by a screen distance away from the viewport', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="scroll-to-scene-position">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="50%"><?= __('50% (Animate to the center of a Sticky or Scroll Scene)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="1200ms"><?= __('1200ms (Animate to 1200ms on the timline of a Scroll Scene)', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

	<div data-smart-options="scroll-to-timeline-position">

		<lse-ul class="lse-smart-inject">
			<lse-li data-smart-inject="50%"><?= __('50% (Animate to the halfway point of the slide duration)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="675ms"><?= __('675ms (Animates exactly to 675ms)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="+200ms"><?= __('+200ms (Plays forward by 200ms)', 'LayerSlider') ?></lse-li>
			<lse-li data-smart-inject="-30%"><?= __('-30% (Plays backward by 30%)', 'LayerSlider') ?></lse-li>
		</lse-ul>
	</div>

</lse-smart-options-contents>