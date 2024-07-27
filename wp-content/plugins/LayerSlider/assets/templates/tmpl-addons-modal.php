<?php defined( 'LS_ROOT_FILE' ) || exit; ?>


<?php 

$allPages = get_pages();
$projects404 = LS_Sliders::find([
	'columns' => 'id,name',
	'limit' => 100,
	'data' => false,
	'where' => "name LIKE '%404%' OR keywords LIKE '%404%'"
]);
$recentProjects = LS_Sliders::find([
	'columns' => 'id,name',
	'limit' => 20,
	'data' => false,
]);
$allProjects = LS_Sliders::find([
	'columns' => 'id,name',
	'orderby' => 'name',
	'order' => 'ASC',
	'limit' => 1000,
	'data' => false
]);

?>

<ls-b class="ls-hidden">

	<ls-b id="ls-addons-modal-sidebar">
		
		<ls-b class="km-tabs-content" id="ls-addons-content">

			<!-- Templates -->
			<ls-b data-tab="template-store">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('The ever growing selection of fully crafted, customizable and importable slider templates are an ideal starting point for new projects and they cover every common use case from personal to corporate business.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
				<ls-p class="ls--form-control ls--text-center">
					<a href="#" class="ls-open-template-store ls--button ls--small ls--bg-lightgray ls--white">
						<?= __('Browse Templates', 'LayerSlider') ?>
					</a>	
				</ls-p>
			</ls-b>


			<!-- 404 -->
			<ls-b data-tab="404">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Don’t let those dull 404 “Not Found” error messages be a dead-end for your visitors. LayerSlider’s 404 add-on empowers you to transform those boring and frustrating error pages into captivating experiences.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>

				<ls-h5>
					<?= __('Add-on Status', 'LayerSlider') ?>
				</ls-h5>

				<ls-box>

					<ls-p class="ls--form-control ls--text-center">
						<a href="#" class="ls--button ls--small ls--bg-blue ls--white">
							<?= __('Install Add-on', 'LayerSlider') ?>
						</a>
					</ls-p>

				</ls-box>

				<ls-h5>
					<?= __('Add-on Settings', 'LayerSlider') ?>
				</ls-h5>

				<ls-box class="ls-settings-table">

					<table>
						<tbody>

							<tr>
								<td>
									<?= __('Type', 'LayerSlider') ?>
								</td>
								<td>
									<select name="type">
										<option value="project"><?= __('LayerSlider Project', 'LayerSlider') ?></option>
										<option value="page"><?= __('WordPress Page', 'LayerSlider') ?></option>
									</select>
								</td>
							</tr>

							<tr>
								<td>
									<?= __('Project', 'LayerSlider') ?>
								</td>
								<td>
									<select name="project">

										<?php if( ! empty( $projects404 ) ) : ?>
										<optgroup label="<?= __('Your 404 Projects', 'LayerSlider') ?>">
											<?php foreach( $projects404 as $project ) : ?>
											<option value="<?= $project['id'] ?>"><?= apply_filters('ls_slider_title', stripslashes( $project['name'] ), 40) ?></option>
											<?php endforeach; ?>
										</optgroup>
										<?php endif ?>

										<?php if( ! empty( $recentProjects ) ) : ?>
										<optgroup label="<?= __('Recent Projects', 'LayerSlider') ?>">
											<?php foreach( $recentProjects as $project ) : ?>
											<option value="<?= $project['id'] ?>"><?= apply_filters('ls_slider_title', stripslashes( $project['name'] ), 40) ?></option>
											<?php endforeach; ?>
										</optgroup>
										<?php endif ?>

										<?php if( ! empty( $allProjects ) ) : ?>
										<optgroup label="<?= __('All Projects', 'LayerSlider') ?>">
											<?php foreach( $allProjects as $project ) : ?>
											<option value="<?= $project['id'] ?>"><?= apply_filters('ls_slider_title', stripslashes( $project['name'] ), 40) ?></option>
											<?php endforeach; ?>
										</optgroup>
										<?php endif ?>
									</select>
								</td>
							</tr>

							<tr>
								<td>
									<?= __('Page', 'LayerSlider') ?>
								</td>
								<td>
									<select name="page">
										<?php foreach( $allPages as $page ) : ?>
										<option value=""><?= ! empty( $page->post_title ) ? $page->post_title : __('(no title)', 'Layerslider') ?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>

							<tr>
								<td>
									<?= __('Page Title', 'LayerSlider') ?>
								</td>
								<td>
									<input type="text" name="page_title" value="">
								</td>
							</tr>

							<tr>
								<td>
									<?= __('Page Background', 'LayerSlider') ?>
								</td>
								<td>
									<input type="text" name="page_background" value="">
								</td>
							</tr>

						</tbody>
					</table>

				</ls-box>

			</ls-b>


			<!-- Shape Editor -->
			<ls-b data-tab="shape-editor">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('LayerSlider lets you easily generate the perfect vector-based graphics for your needs from rectangles and ovals to polygons and complex shapes. Precisely controlled or randomized results ensure unique shapes. Waves and Blobs with optional multi-layered variations can add striking design features to any project.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
			</ls-b>


			<!-- Origami -->
			<ls-b data-tab="origami">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Fold your users’ expectations. Origami slide transition is the perfect solution to share your gorgeous photos with the world or your loved ones in a truly inspirational way and create sliders with stunning effects.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
			</ls-b>


			<!-- Assets Library -->
			<ls-b data-tab="assets-library">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Ready to make your designs stand out? LayerSlider’s Assets Library offers thousands of objects and millions of royalty-free stock photos to choose from. Save time and impress your audience with stunning graphics in just a few clicks.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
			</ls-b>


			<!-- Revisions -->
			<ls-b data-tab="revisions">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('You can go back in time. Have a peace of mind knowing that your slider edits are always safe and you can revert back unwanted changes or faulty saves at any time. Revisions serves not just as a backup solution, but a complete version control system where you can visually compare the changes you have made along the way. Supported platforms: WordPress.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
				<ls-p class="ls--form-control ls--text-center">
					<a target="_blank" href="https://layerslider.com/features/revisions/" class="ls--button ls--small ls--bg-lightgray ls--white">
						<?= __('Learn More', 'LayerSlider') ?>
					</a>	
				</ls-p>
			</ls-b>


			<!-- Icon Library -->
			<ls-b data-tab="icon-library">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('A subtle touch of adding icons to your content can make all the difference between outdated and elegant design, and you don’t have to settle for generic ones, either. Choose from our extensive and diverse collection of more than 16,000 icons with unique styles to make your project stand out.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
			</ls-b>


			<!-- Text Mask Effects -->
			<ls-b data-tab="text-mask-effects">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Elevate your website’s design with text mask effects - the perfect way to create eye-catching and unforgettable fonts easier than ever before. Apply gradients or texture on your fonts with just a few clicks to make them look cinematic and inspiring that your visitors will remember.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
			</ls-b>


			<!-- Support -->
			<ls-b data-tab="support">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Receive help directly from the team behind LayerSlider. With our expert assistance, you can trust that your needs will be met, questions answered, and problems solved, leaving you with more time and peace of mind to focus on what truly matters to you.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
				<ls-p class="ls--form-control ls--text-center">
					<a target="_blank" href="https://layerslider.com/help/" class="ls--button ls--small ls--bg-lightgray ls--white">
						<?= __('Get Help', 'LayerSlider') ?>
					</a>	
				</ls-p>
			</ls-b>


			<!-- Instant Updates -->
			<ls-b data-tab="updates">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Effortlessly stay in the loop and receive all the new features and content updates without a hitch. One-click installation of the latest LayerSlider version or opt for automatic background updates for a hassle-free maintenance experience. Plus, enjoy early-access releases and safeguard your website with the latest security patches. Keep your website in peak condition with ease.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
			</ls-b>


			<!-- Scroll Effects -->
			<ls-b data-tab="scroll-effects">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Create captivating interactions between your website and visitors. You can add all sorts of scroll effects with Scroll Transition, while Scroll Scene keeps your content on the screen that visitors can play back and forth by scrolling the page. A Sticky Scene plays animations normally, but also sticks to the center of the screen for a given time, thus further maintaining your users’ attention.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
				<ls-p class="ls--form-control ls--text-center">
					<a target="_blank" href="https://layerslider.com/sliders/the-web-company/" class="ls--button ls--small ls--bg-lightgray ls--white">
						<?= __('See an Example', 'LayerSlider') ?>
					</a>	
				</ls-p>
			</ls-b>


			<!-- Popups -->
			<ls-b data-tab="popups">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Popups is a completely new way of using LayerSlider and it greatly extends its capabilities and what you can build with the plugin. Combining our strong foundation and the vast number of features we already have with the newly introduced Popup feature makes LayerSlider one of the best choice among popup plugins.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
			</ls-b>


			<!-- Image Editor -->
			<ls-b data-tab="image-editor">
				<ls-b class="ls--addon-desc">
					<ls-p>
						<?= __('Elevate your visuals and make every image shine with our integrated Image Editor – where creativity meets simplicity. Effortlessly resize, crop, and rotate images, then add your personal touch with filters, frames, text, stickers, and many exciting features. It’s akin to having your own pocket-sized Photoshop.', 'LayerSlider') ?>
					</ls-p>
				</ls-b>
			</ls-b>

		</ls-b>
	</ls-b>

	<ls-b id="ls-addons-modal-content">
		<kmw-h1 class="kmw-modal-title"><?= __('Add-Ons & Premium Benefits', 'LayerSlider') ?></kmw-h1>

		<ls-grid id="ls-addons-grid" class="ls--h-2 ls--v-1">

			<ls-row class="km-tabs-list" data-target="#ls-addons-content" data-disable-auto-rename>

				<ls-col class="kmw-menuitem ls--col1-3"  data-tab-target="404">
					<ls-box>
						<ls-b class="ls--container">
							<video class="ls--video ls--allowstop" muted src="https://layerslider.com/media/premium/404.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('404 Page', 'LayerSlider') ?>
					</ls-b>
					<lse-badge><?= __('NEW', 'LayerSlider') ?></lse-badge>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-3" data-tab-target="template-store">
					<ls-box>
						<ls-b class="ls--container">
							<!-- <ls-b class="ls--tn" id="p-template-store"></ls-b> -->
							<video class="ls--video" muted src="https://layerslider.com/media/premium/template-store.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Template Store', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-3"  data-tab-target="shape-editor">
					<ls-box>
						<ls-b class="ls--container">
							<video class="ls--video ls--allowstop" muted src="https://layerslider.com/media/premium/shape-editor.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Shape Editor', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="origami">
					<ls-box>
						<ls-b class="ls--container ls--nozoom">
							<video class="ls--video" muted src="https://layerslider.com/media/premium/origami.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Origami Slide Transition', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="assets-library">
					<ls-box>
						<ls-b class="ls--container">
							<video class="ls--video ls--allowstop" muted src="https://layerslider.com/media/premium/assets-library.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Assets Library', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

 				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="revisions">
					<ls-box>
						<ls-b class="ls--container">
							<ls-b class="ls--tn" id="p-revisions"></ls-b>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Revisions', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="icon-library">
					<ls-box>
						<ls-b class="ls--container">
							<video class="ls--video" muted src="https://layerslider.com/media/premium/icon-library.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Icon Library', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="text-mask-effects">
					<ls-box>
						<ls-b class="ls--container">
							<video class="ls--video" muted src="https://layerslider.com/media/premium/text-mask-effects.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Text Mask Effects', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="support">
					<ls-box>
						<ls-b class="ls--container">
							<video class="ls--video" muted src="https://layerslider.com/media/premium/support.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Premium Support', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="updates">
					<ls-box>
						<ls-b class="ls--container">
							<video class="ls--video" muted src="https://layerslider.com/media/premium/updates.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Instant Updates', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="scroll-effects">
					<ls-box>
						<ls-b class="ls--container">
							<video class="ls--video ls--allowstop" muted src="https://layerslider.com/media/premium/scroll-effects.mp4"></video>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Scroll Effects', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="popups">
					<ls-box>
						<ls-b class="ls--container">
							<ls-b class="ls--tn" id="p-popups"></ls-b>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Popups', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="kmw-menuitem ls--col1-4"  data-tab-target="image-editor">
					<ls-box>
						<ls-b class="ls--container">
							<ls-b class="ls--tn" id="p-image-editor"></ls-b>
						</ls-b>
					</ls-box>
					<ls-b class="ls--title">
						<?= __('Image Editor', 'LayerSlider') ?>
					</ls-b>
				</ls-col>

				<ls-col class="ls--col-placeholder" data-exclude>
				</ls-col>

			</ls-row>

		</ls-grid>

	</ls-b>

</ls-b>