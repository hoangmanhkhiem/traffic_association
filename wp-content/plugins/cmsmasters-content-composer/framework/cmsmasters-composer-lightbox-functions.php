<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.4.1
 * 
 * Composer Lightbox Functions
 * Created by CMSMasters
 * 
 */


global $pagenow;


if ( 
	is_admin() && 
	$pagenow == 'post-new.php' || 
	($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
) {
	add_action('admin_footer', 'cmsmasters_composer_shortcodes_init');
}


function cmsmasters_composer_shortcodes_init() {
	if (wp_script_is('cmsmasters_content_composer_js', 'queue') && wp_script_is('cmsmasters_composer_lightbox_js', 'queue')) {
		cmsmasters_composer_colors();
		
		cmsmasters_composer_cf7();
		
		cmsmasters_composer_cf7_forms();
		
		cmsmasters_composer_cfb();
		
		cmsmasters_composer_cfb_forms();
		
		cmsmasters_composer_ninja();

		cmsmasters_composer_ninja_forms();

		cmsmasters_composer_wpforms();

		cmsmasters_composer_wpforms_forms();
		
		cmsmasters_composer_layer_slider();
		
		cmsmasters_composer_rev_slider();
		
		cmsmasters_composer_fonts();
		
		cmsmasters_composer_font_weight();
		
		cmsmasters_composer_font_style();
		
		cmsmasters_composer_text_transform();
		
		cmsmasters_composer_sidebars();
		
		cmsmasters_composer_categories();
		
		cmsmasters_composer_pj_compatible();
		
		cmsmasters_composer_pj_categories();
		
		cmsmasters_composer_pl_compatible();
		
		cmsmasters_composer_pl_categories();
		
		cmsmasters_composer_thumbnail_sizes();
		
		cmsmasters_composer_mailpoet();
		
		cmsmasters_composer_mailpoet_forms();
	}
}


function cmsmasters_composer_colors() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_colors() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	foreach (cmsmasters_color_schemes_list() as $key => $value) {
		$out .= "\t\t\t\"" . $key . "\" : \"" . $value . "\", \n";
	}
	
	
	$out = substr($out, 0, -3);
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_cf7() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_cf7() { ' . "\n\t\t";
	
	
	if (class_exists('WPCF7')) {
		$out .= "return 'true'; \n";
	} else {
		$out .= "return 'false'; \n";
	}
	
	
	$out .= '} ' . "\n" . 
		'cmsmasters_composer_cf7();' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_cf7_forms() {
	global $post;
	
	
	$admin_post_object = $post;
	
	
	$option_query = new WP_Query(array( 
		'orderby' => 			'name', 
		'order' => 				'ASC', 
		'post_type' => 			'wpcf7_contact_form', 
		'posts_per_page' => 	-1 
	));
	
	
	$forms = array();
	
	
	if ($option_query->have_posts()) : 
		while ($option_query->have_posts() ) : $option_query->the_post();
			$forms[get_the_ID()] = get_the_title();
		endwhile;
	endif;
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_cf7_forms() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	foreach ($forms as $form_key => $form_value) {
		$out .= "\t\t\t\"" . $form_key . "{|}" . addslashes($form_value) . "\" : \"" . $form_value . "\", \n";
	}
	
	
	if (!empty($forms)) {
		$out = substr($out, 0, -3);
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	wp_reset_query();
	
	
	$post = $admin_post_object;
	
	
	echo $out;
}



function cmsmasters_composer_cfb() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_cfb() { ' . "\n\t\t";
	
	
	if (class_exists('Cmsmasters_Form_Builder')) {
		$out .= "return 'true'; \n";
	} else {
		$out .= "return 'false'; \n";
	}
	
	
	$out .= '} ' . "\n" . 
		'cmsmasters_composer_cfb();' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_cfb_forms() {
	global $frm_bldr;
	
	
	if (!empty($frm_bldr)) {
		$forms = $frm_bldr->form_builder_forms_list();
	} else {
		$forms = '';
	}
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_cfb_forms() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	if (!empty($forms)) {
		foreach ($forms as $form_key => $form_value) {
			$out .= "\t\t\t\"" . $form_key . "\" : \"" . $form_value . "\", \n";
		}
		
		
		$out = substr($out, 0, -3);
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_ninja() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_ninja() { ' . "\n\t\t";
	
	
	if (class_exists('Ninja_Forms')) {
		$out .= "return 'true'; \n";
	} else {
		$out .= "return 'false'; \n";
	}
	
	
	$out .= '} ' . "\n" . 
		'cmsmasters_composer_ninja();' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_ninja_forms() {
	global $post;
	
	
	$admin_post_object = $post;
	
	if (class_exists('Ninja_Forms')) {
		$forms = array();

		foreach( Ninja_Forms()->form()->get_forms() as $form ){
			$forms[$form->get_id()] = $form->get_setting('title');
		}
	
	
		$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
		'/* <![CDATA[ */' . "\n\t" . 
			'function cmsmasters_composer_ninja_forms() { ' . "\n\t\t" . 
				'return { ' . "\n";
		
		
		foreach ($forms as $form_key => $form_value) {
			$out .= "\t\t\t\"" . $form_key . "{|}" . addslashes($form_value) . "\" : \"" . $form_value . "\", \n";
		}
		
		
		if (!empty($forms)) {
			$out = substr($out, 0, -3);
		}
		
		
		$out .= "\n\t\t" . '}; ' . "\n\t" . 
			'} ' . "\n" . 
		'/* ]]> */' . "\n" . 
		'</script>' . "\n\n";
	} else {
		$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
		'/* <![CDATA[ */' . "\n\t" . 
			'function cmsmasters_composer_ninja_forms() {} ' . "\n" . 
		'/* ]]> */' . "\n" . 
		'</script>' . "\n\n";
	}
	
	
	wp_reset_query();
	
	
	$post = $admin_post_object;
	
	
	echo $out;
}


function cmsmasters_composer_wpforms() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_wpforms() { ' . "\n\t\t";
	
	
	if (class_exists('WPForms')) {
		$out .= "return 'true'; \n";
	} else {
		$out .= "return 'false'; \n";
	}
	
	
	$out .= '} ' . "\n" . 
		'cmsmasters_composer_wpforms();' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_wpforms_forms() {
	global $post;
	
	
	$admin_post_object = $post;
	
	
	$option_query = new WP_Query(array( 
		'orderby' => 			'name', 
		'order' => 				'ASC', 
		'post_type' => 			'wpforms', 
		'posts_per_page' => 	-1 
	));
	
	
	$forms = array();
	
	
	if ($option_query->have_posts()) : 
		while ($option_query->have_posts() ) : $option_query->the_post();
			$forms[get_the_ID()] = get_the_title();
		endwhile;
	endif;
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_wpforms_forms() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	foreach ($forms as $form_key => $form_value) {
		$out .= "\t\t\t\"" . $form_key . "{|}" . addslashes($form_value) . "\" : \"" . $form_value . "\", \n";
	}
	
	
	if (!empty($forms)) {
		$out = substr($out, 0, -3);
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	wp_reset_query();
	
	
	$post = $admin_post_object;
	
	
	echo $out;
}


function cmsmasters_composer_layer_slider() {
	if (class_exists('LS_Sliders')) {
		$sliders = LS_Sliders::find(array( 
			'limit' => 	100 
		));
	}
	
	
	if (!isset($sliders)) {
		$sliders = '';
	}
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_layer_slider() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	if (!empty($sliders)) {
		foreach ($sliders as $item) {
			$name = empty($item['name']) ? __('Unnamed', 'cmsmasters-content-composer') : $item['name'];
			
			
			$out .= "\t\t\t\"" . $item['id'] . "\" : \"" . $name . "\", \n";
		}
		
		
		$out = substr($out, 0, -3);
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_rev_slider() {
	if (class_exists('RevSliderSlider')) {
		$sld = new RevSliderSlider();
		
		$sliders = $sld->get_sliders();
	}
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_rev_slider() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	if (!empty($sliders)) {
		foreach($sliders as $slider){
			$alias = $slider->get_val($slider, 'alias', '');
			$title = $slider->get_val($slider, 'title', '');
			
			if($alias != 'false'){
				$out .= "\t\t\t\"" . $alias . "\" : \"" . (($title != '' && $title != 'false') ? $title : $alias) . "\", \n";
			}
		}
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_fonts() {
	$out = "<script type=\"text/javascript\">
	/* <![CDATA[ */
		function cmsmasters_composer_fonts() {
			return {";
				
				$cmsmasters_fonts_list = cmsmasters_fonts_list();
				
				$font_none = array_shift($cmsmasters_fonts_list);
				
				$out .= "'':'{$font_none}'";
				
				
				if (!empty($cmsmasters_fonts_list['local'])) {
					$out .= ", 'local':{";
						
						$local_fonts = array();
						
						foreach ($cmsmasters_fonts_list['local'] as $key => $value) {
							$local_fonts[] = "'{$key}':'{$value}'";
						}
						
						$local_fonts = implode(', ', $local_fonts);

						$out .= $local_fonts;
						
					$out .= "}";
				}
				

				if (!empty($cmsmasters_fonts_list['web'])) {
					$out .= ", 'web':{";

						$google_fonts = array();
						
						foreach ($cmsmasters_fonts_list['web'] as $key => $value) {
							$google_fonts[] = "'{$key}':'{$value}'";
						}
						
						$google_fonts = implode(', ', $google_fonts);

						$out .= $google_fonts;
						
					$out .= "}";
				}
				
			$out .= "}
		}
	/* ]]> */
	</script>";
	
	
	echo $out;
}


function cmsmasters_composer_font_weight() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_font_weight() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	foreach (cmsmasters_font_weight_list() as $key => $value) {
		$out .= "\t\t\t\"" . $key . "\" : \"" . $value . "\", \n";
	}
	
	
	$out = substr($out, 0, -3);
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_font_style() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_font_style() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	foreach (cmsmasters_font_style_list() as $key => $value) {
		$out .= "\t\t\t\"" . $key . "\" : \"" . $value . "\", \n";
	}
	
	
	$out = substr($out, 0, -3);
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_text_transform() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_text_transform() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	foreach (cmsmasters_text_transform_list() as $key => $value) {
		$out .= "\t\t\t\"" . $key . "\" : \"" . $value . "\", \n";
	}
	
	
	$out = substr($out, 0, -3);
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_sidebars() {
	global $wp_registered_sidebars;
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_sidebars() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	foreach ($wp_registered_sidebars as $wp_registered_sidebar) {
		$out .= "\t\t\t\"" . $wp_registered_sidebar['id'] . "\" : \"" . $wp_registered_sidebar['name'] . "\", \n";
	}
	
	
	$out = substr($out, 0, -3);
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_categories() {
	$categories = get_categories(array( 
		'hide_empty' => 0 
	));
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_categories() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	if (!empty($categories)) {
		foreach ($categories as $category) {
			$out .= "\t\t\t\"" . $category->slug . "\" : \"" . esc_html($category->name) . "\", \n";
		}
		
		
		$out = substr($out, 0, -3);
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_pj_compatible() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_pj_compatible() { ' . "\n\t\t";
	
	
	if (CMSMASTERS_PROJECT_COMPATIBLE) {
		$out .= "return 'true'; \n";
	} else {
		$out .= "return 'false'; \n";
	}
	
	
	$out .= '} ' . "\n" . 
		'cmsmasters_composer_pj_compatible();' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_pj_categories() {
	$categories = get_terms('pj-categs', array( 
		'hide_empty' => 0 
	));
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_pj_categories() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	if (CMSMASTERS_PROJECT_COMPATIBLE && !empty($categories) && !is_wp_error($categories)) {
		foreach ($categories as $category) {
			$out .= "\t\t\t\"" . $category->slug . "\" : \"" . esc_html($category->name) . "\", \n";
		}
		
		
		$out = substr($out, 0, -3);
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_pl_compatible() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_pl_compatible() { ' . "\n\t\t";
	
	
	if (CMSMASTERS_PROFILE_COMPATIBLE) {
		$out .= "return 'true'; \n";
	} else {
		$out .= "return 'false'; \n";
	}
	
	
	$out .= '} ' . "\n" . 
		'cmsmasters_composer_pl_compatible();' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_pl_categories() {
	$categories = get_terms('pl-categs', array( 
		'hide_empty' => 0 
	));
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_pl_categories() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	if (CMSMASTERS_PROFILE_COMPATIBLE && !empty($categories) && !is_wp_error($categories)) {
		foreach ($categories as $category) {
			$out .= "\t\t\t\"" . $category->slug . "\" : \"" . esc_html($category->name) . "\", \n";
		}
		
		
		$out = substr($out, 0, -3);
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_thumbnail_sizes() {
	$cmsmasters_sizes = cmsmasters_image_thumbnail_list();
	
	
	$sizes_array = get_intermediate_image_sizes();
	
	
	array_push($sizes_array, 'full');
	
	
	$sizes = array();
	
	
	foreach($sizes_array as $s) {
		if (in_array($s, array('thumbnail', 'medium', 'large'))) {
			if ($s == 'thumbnail') {
				$sizes[$s][0] = __('Thumbnail', 'cmsmasters-content-composer');
			} elseif ($s == 'medium') {
				$sizes[$s][0] = __('Medium', 'cmsmasters-content-composer');
			} elseif ($s == 'large') {
				$sizes[$s][0] = __('Large', 'cmsmasters-content-composer');
			}
			
			
			$sizes[$s][1] = get_option($s . '_size_w');
			
			
			$sizes[$s][2] = get_option($s . '_size_h');
		} elseif ($s == 'full') {
			$sizes[$s] = array(__('Full Size', 'cmsmasters-content-composer'), __('Original image size', 'cmsmasters-content-composer'), '');
		} else {
			if (isset($cmsmasters_sizes) && isset($cmsmasters_sizes[$s]) && isset($cmsmasters_sizes[$s]['title'])) {
				$sizes[$s] = array($cmsmasters_sizes[$s]['title'], $cmsmasters_sizes[$s]['width'], $cmsmasters_sizes[$s]['height']);
			}
		}
	}
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_thumbnail_sizes() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	foreach ($sizes as $size => $attrs) {
		$out .= "\t\t\t\"" . $size . "\" : \"" . $attrs[0] . " &ndash; " . $attrs[1] . (($attrs[2] != '') ? " &#735; " . $attrs[2] : '') . "\", \n";
	}
	
	
	$out = substr($out, 0, -3);
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_mailpoet() {
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_mailpoet() { ' . "\n\t\t";
	
	
	if (CMSMASTERS_MAILPOET) {
		$out .= "return 'true'; \n";
	} else {
		$out .= "return 'false'; \n";
	}
	
	
	$out .= '} ' . "\n" . 
		'cmsmasters_composer_mailpoet();' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}


function cmsmasters_composer_mailpoet_forms() {
	if (class_exists('\MailPoet\Config\Initializer')) {
		$formsRepository = \MailPoet\DI\ContainerWrapper::getInstance()->get( \MailPoet\Form\FormsRepository::class );

		$forms_arr = $formsRepository->findBy([]);
		$forms = array();

		foreach ( $forms_arr as $form ) {
			$forms[] = array(
				'id' => $form->getId(),
				'name' => $form->getName(),
			);
		}
	} elseif (class_exists('WYSIJA')) {
		$model_forms = WYSIJA::get('forms', 'model');
		
		$model_forms->reset();
		
		$forms = $model_forms->getRows(array('form_id', 'name'));
	}
	
	
	if (!isset($forms)) {
		$forms = '';
	}
	
	
	$out = "\n" . '<script type="text/javascript"> ' . "\n" . 
	'/* <![CDATA[ */' . "\n\t" . 
		'function cmsmasters_composer_mailpoet_forms() { ' . "\n\t\t" . 
			'return { ' . "\n";
	
	
	if (!empty($forms)) {
		foreach ($forms as $form) {
			$form_id = (class_exists('\MailPoet\Config\Initializer') ? $form['id'] : $form['form_id']);
			
			$out .= "\t\t\t\"" . esc_attr($form_id) . "\" : \"" . esc_html($form['name']) . "\", \n";
		}
		
		
		$out = substr($out, 0, -3);
	}
	
	
	$out .= "\n\t\t" . '}; ' . "\n\t" . 
		'} ' . "\n" . 
	'/* ]]> */' . "\n" . 
	'</script>' . "\n\n";
	
	
	echo $out;
}

