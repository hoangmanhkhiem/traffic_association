<?php 
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Importer
 * @version 	1.0.6
 */


if (!class_exists('Cmsmasters_Theme_Importer')) {
	class Cmsmasters_Theme_Importer {
		private static $instance;
		

		public $demo_files_path;
		

		public $content_demo;
		
		public $mptt_content_demo;
		
		public $mptt_content_demo_file_name;
		
		public $theme_settings;
		
		public $widgets;
		
		public $sliders;
		
		
		public $thumbnails;
		
		public $pages;
		
		
		public $woo_thumbnails;
		
		public $woo_pages;
		
		
		public $widget_import_results;
		
		
		public $active_import = 'default';
		
		
		public $flag_as_imported = array( 
			'content' => 			false, 
			'settings' => 			false, 
			'widgets' => 			false, 
			'menus' => 				false, 
			'thumbnails' => 		false, 
			'pages' => 				false, 
			'woo_thumbnails' => 	false, 
			'woo_pages' => 			false, 
			'layer_sliders' => 		false, 
			'rev_sliders' => 		false 
		);
		
		
		public $imported_demos = array();
		
		
		public function __construct() {
			self::$instance = $this;
			
			
			$this->demo_files_path = apply_filters('cmsmasters_theme_importer_demo_files_path', $this->demo_files_path);
			
			
			$this->content_demo = apply_filters('cmsmasters_theme_importer_content_demo_file', $this->demo_files_path . $this->content_demo_file_name);
			
			$this->mptt_content_demo = apply_filters('cmsmasters_theme_importer_mptt_content_demo_file', $this->demo_files_path . $this->mptt_content_demo_file_name);
			
			$this->theme_settings = apply_filters('cmsmasters_theme_importer_theme_settings_file', $this->demo_files_path . $this->theme_settings_file_name);
			
			$this->widgets = apply_filters('cmsmasters_theme_importer_widgets_file', $this->demo_files_path . $this->widgets_file_name);
			
			
			$this->sliders = apply_filters('cmsmasters_theme_importer_sliders_folder', $this->demo_files_path . $this->sliders_folder_name);
			
			
			$this->thumbnails = apply_filters('cmsmasters_theme_importer_thumbnails_array', $this->thumbnails);
			
			$this->pages = apply_filters('cmsmasters_theme_importer_pages_array', $this->pages);
			
			
			$this->woo_thumbnails = apply_filters('cmsmasters_theme_importer_woo_thumbnails_array', $this->woo_thumbnails);
			
			$this->woo_pages = apply_filters('cmsmasters_theme_importer_woo_pages_array', $this->woo_pages);
			
			
			$this->imported_demos = get_option('cmsmasters_imported_demo');
			
			
			add_action('admin_menu', array($this, 'add_admin'));
			
			
			add_filter('add_post_metadata', array($this, 'check_previous_meta'), 10, 5);

			add_action('cmsmasters_import_end', array($this, 'after_wp_importer'));
		}
		
		
		public function add_admin() {
			add_menu_page( 
				__('Import Demo Content', 'cmsmasters-importer'), 
				__('Import Demo Content', 'cmsmasters-importer'), 
				'switch_themes', 
				'cmsmasters_demo_installer', 
				array($this, 'demo_installer') 
			);
		}
		
		
		public function check_previous_meta($continue, $post_id, $meta_key, $meta_value, $unique) {
			$old_value = get_metadata('post', $post_id, $meta_key);
			
			
			if (count($old_value) == 1) {
				if ($old_value[0] === $meta_value) {
					return false;
				} elseif ($old_value[0] !== $meta_value && '_stock' !== $meta_key) {
					update_post_meta($post_id, $meta_key, $meta_value);
					
					
					return false;
				}
			}
		}
		
		
		public function after_wp_importer() {
			do_action('cmsmasters_importer_after_content_import');
			
			
			update_option('cmsmasters_imported_demo', $this->flag_as_imported);
		}
		
		
		public function reload_script($reload = false, $demo_select = false, $demo_data = false, $demo_attachments = false, $demo_widgets = false, $demo_settings = false, $demo_sliders = false) {
			if ($reload) {
				return "<script type=\"text/javascript\">
					jQuery(document).ready(function() { 
						(function ($) { 
							" . ($demo_select ? "$('#cmsmasters-demo-select option[value={$demo_select}]').prop('selected', true);" : "") . "
							
							
							$('#cmsmasters-demo-data').prop('checked', " . ($demo_data ? "true" : "false") . ");
							
							$('#cmsmasters-demo-attachments').prop('checked', " . ($demo_attachments ? "true" : "false") . ");
							
							$('#cmsmasters-demo-widgets').prop('checked', " . ($demo_widgets ? "true" : "false") . ");
							
							$('#cmsmasters-demo-settings').prop('checked', " . ($demo_settings ? "true" : "false") . ");
							
							$('#cmsmasters-demo-sliders').prop('checked', " . ($demo_sliders ? "true" : "false") . ");
							
							
							$('#cmsmasters-importer-reload').val('false');
							
							
							$('#cmsmasters-importer-form').submit();
						} )(jQuery);
					} );
				</script>";
			}
		}
		
		
		public function intro_html($reload = false, $action = '') {
			if (
				$action == 'demo-content' && 
				check_admin_referer('cmsmasters-demo-code' , 'demononce')
			) {
				if (!$reload) {
					return "<div class=\"cmsmasters-notice cmsmasters-notice-success\">
						<p>" . __('Demo content already imported.', 'cmsmasters-importer') . "</p>
					</div>";
				} else {
					return "<div class=\"cmsmasters-notice cmsmasters-notice-warning\">
						<p><strong>" . __('Please, do not reload or navigate away from the page, procedure is not finished yet!', 'cmsmasters-importer') . "</strong></p>
					</div>";
				}
			}
		}
		
		
		public function select_field() {
			if (empty($this->content_demo) || !is_file($this->content_demo)) {
				return "<div class=\"cmsmasters-demo-label\">
					<label for=\"cmsmasters-demo-select\" class=\"cmsmasters-demo-select\">
						<select id=\"cmsmasters-demo-select\" name=\"demo-select\">
							" . $this->select_options() . "
						</select> &nbsp;
						<span class=\"description\">" . __("Choose theme demo to import", 'cmsmasters-importer') . "</span>
					</label>
				</div>";
			}
		}
		
		
		public function select_options() {
			$demo_content_dir = opendir($this->demo_files_path);
			
			
			if ($demo_content_dir) {
				$options_out = '';
				
				
				while (($demo_content_folder = readdir($demo_content_dir)) !== false){
					if ($demo_content_folder == '.' || $demo_content_folder == '..') {
						continue;
					}
					
					
					$demo_content_name_array = array();
					
					$demo_content_folder_array = explode('_', $demo_content_folder);
					
					
					foreach ($demo_content_folder_array as $demo_content_folder_item) {
						$demo_content_name_array[] = ucfirst($demo_content_folder_item);
					}
					
					
					$demo_content_name = implode(' ', $demo_content_name_array);
					
					
					$options_out .= "<option value=\"" . $demo_content_folder . "\">" . $demo_content_name . "</option>";
				}
				
				
				closedir($demo_content_dir);
				
				
				return $options_out;
			}
		}
		
		
		public function demo_installer() {
			$action = isset($_POST['action']) ? $_POST['action'] : '';
			
			
			$demo_select = isset($_POST['demo-select']) ? $_POST['demo-select'] : false;
			
			
			$demo_data = isset($_POST['demo-data']) ? true : false;
			
			$demo_attachments = isset($_POST['demo-attachments']) ? true : false;
			
			$demo_widgets = isset($_POST['demo-widgets']) ? true : false;
			
			$demo_settings = isset($_POST['demo-settings']) ? true : false;
			
			$demo_sliders = isset($_POST['demo-sliders']) ? true : false;
			
			
			$reload = (isset($_POST['reload']) && $_POST['reload'] == 'true') ? true : false;
			
			
			echo '<div class="wrap">';
				
				echo '<div id="icon-options-general" class="icon32">' . 
					'<br />' . 
				'</div>' . 
				'<h2>' . __("Demo Content Importer", 'cmsmasters-importer') . '</h2>';
				
				echo "<div class=\"cmsmasters-importer-notice cmsmasters-importer-notice-info\">
					<p>" . __("Importing demo data (posts, pages, images, theme settings, menus, widgets, ...) is the easiest way to setup your theme. It will allow you to quickly edit everything instead of creating content from scratch.", 'cmsmasters-framework') . "</p>
					<p>" . __("When you import the data following things will happen:", 'cmsmasters-framework') . "</p>
					<ul>
						<li>" . __("No existing posts, pages, categories, images, custom post types or any other data except theme settings will be deleted or modified.", 'cmsmasters-framework') . "</li>
						<li>" . __("Posts, pages, some images, theme settings, widgets, menus, sliders and some other data will get imported.", 'cmsmasters-framework') . "</li>
						<li>" . __("Images will be downloaded if you leave 'Upload attachments' checkbox enabled. Please note that the images from our demo are copyrighted material and cannot be provided, so they are replaced with grey placeholders.", 'cmsmasters-framework') . "</li>
						<li>" . __("Please click import only once and wait, it can take a couple of minutes and reload page once or twice - please wait until the end of the procedure, do not navigate away from the page until you see a success message.", 'cmsmasters-framework') . "</li>
					</ul>
				</div>
				<div class=\"cmsmasters-importer-notice cmsmasters-importer-notice-warning\">
					<p>" . __("Before you begin, make sure all the required and recomended plugins are activated.", 'cmsmasters-framework') . "</p>
				</div>";
			
				echo "<div class=\"cmsmasters-importer-wrap\" data-nonce=\"" . wp_create_nonce('cmsmasters-demo-code') . "\">
					<form id=\"cmsmasters-importer-form\" method=\"post\">
						" . $this->intro_html($reload, $action) . "
						<input type=\"hidden\" name=\"demononce\" value=\"" . wp_create_nonce('cmsmasters-demo-code') . "\" />
						<input type=\"hidden\" name=\"action\" value=\"demo-content\" />
						" . $this->select_field() . "
						<div class=\"cmsmasters-demo-label\">
							<label for=\"cmsmasters-demo-data\" class=\"cmsmasters-demo-data\">
								<input id=\"cmsmasters-demo-data\" type=\"checkbox\" name=\"demo-data\" value=\"true\" checked=\"checked\" /> &nbsp;
								<span class=\"description\">" . __("Import demo posts, pages, images, categories, post types...", 'cmsmasters-importer') . "</span>
							</label>
						</div>
						<div class=\"cmsmasters-demo-label\">
							<label for=\"cmsmasters-demo-attachments\" class=\"cmsmasters-demo-attachments\">
								<input id=\"cmsmasters-demo-attachments\" type=\"checkbox\" name=\"demo-attachments\" value=\"true\" checked=\"checked\" /> &nbsp;
								<span class=\"description\">" . __('Upload attachments', 'cmsmasters-importer') . "</span>
							</label>
						</div>
						<div class=\"cmsmasters-demo-label\">
							<label for=\"cmsmasters-demo-widgets\" class=\"cmsmasters-demo-widgets\">
								<input id=\"cmsmasters-demo-widgets\" type=\"checkbox\" name=\"demo-widgets\" value=\"true\" checked=\"checked\" /> &nbsp;
								<span class=\"description\">" . __("Import widgets (please use with theme settings import, or you get widgets only for default sidebars)", 'cmsmasters-importer') . "</span>
							</label>
						</div>
						<div class=\"cmsmasters-demo-label\">
							<label for=\"cmsmasters-demo-settings\" class=\"cmsmasters-demo-settings\">
								<input id=\"cmsmasters-demo-settings\" type=\"checkbox\" name=\"demo-settings\" value=\"true\" checked=\"checked\" /> &nbsp;
								<span class=\"description\">" . __('Import theme settings', 'cmsmasters-importer') . "</span>
							</label>
						</div>
						<div class=\"cmsmasters-demo-label\">
							<label for=\"cmsmasters-demo-sliders\" class=\"cmsmasters-demo-sliders\">
								<input id=\"cmsmasters-demo-sliders\" type=\"checkbox\" name=\"demo-sliders\" value=\"true\" checked=\"checked\" /> &nbsp;
								<span class=\"description\">" . __('Import sliders', 'cmsmasters-importer') . "</span>
							</label>
						</div>
						<input name=\"reload\" id=\"cmsmasters-importer-reload\" type=\"hidden\" value=\"true\" />
						" . (!$reload ? "<input name=\"submit\" class=\"panel-save button-primary cmsmasters-import-start\" type=\"submit\" value=\"" . __('Import', 'cmsmasters-importer') . "\" />" : "");
						
						
						if ($action == 'demo-content' && check_admin_referer('cmsmasters-demo-code' , 'demononce')) {
							$this->pre_process_imports($demo_select);
							
							
							if ($reload) {
								$this->process_imports(false, false, false, $demo_settings, false);
							} else {
								ob_start();
								
								$this->process_imports($demo_data, $demo_attachments, $demo_widgets, $demo_settings, $demo_sliders);
								
								$import_result_message = ob_get_clean();
								
								
								if ($import_result_message) {
									echo "<div class=\"cmsmasters-notice cmsmasters-notice-info cmsmasters-importer-message clear\">
										<div class=\"p_wrap\">" . 
											$import_result_message . 
										"</div>
									</div>";
								}
							}
						}
						
						
						echo $this->reload_script($reload, $demo_select, $demo_data, $demo_attachments, $demo_settings, $demo_widgets, $demo_sliders) . "
					</form>
				</div>";
				
			echo '</div>';
		}
		
		
		public function pre_process_imports($select = false) {
			if ($select) {
				$this->active_import = $select;

				
				$select_path = $this->demo_files_path . $select . '/';
				
				
				$this->content_demo = apply_filters('cmsmasters_theme_importer_content_demo_file_select', $select_path . $this->content_demo_file_name);
				
				$this->mptt_content_demo = apply_filters('cmsmasters_theme_importer_mptt_content_demo_file_select', $select_path . $this->mptt_content_demo_file_name);
				
				$this->theme_settings = apply_filters('cmsmasters_theme_importer_theme_settings_file_select', $select_path . $this->theme_settings_file_name);
				
				$this->widgets = apply_filters('cmsmasters_theme_importer_widgets_file_select', $select_path . $this->widgets_file_name);
				
				
				$this->sliders = apply_filters('cmsmasters_theme_importer_sliders_folder_select', $select_path . $this->sliders_folder_name);
			}
		}
		
		
		public function process_imports($content = true, $attachments = true, $widgets = true, $settings = true, $sliders = true) {			
			if ($settings && !empty($this->theme_settings) && is_file($this->theme_settings)) {
				$this->set_demo_theme_settings($this->theme_settings);
			}

			
			if ($content && !empty($this->content_demo) && is_file($this->content_demo)) {
				$this->set_demo_thumbnail_sizes();
				
				
				if (class_exists('WooCommerce')) {
					$this->set_demo_woo_thumbnail_sizes();
				}
				
				
				$this->set_demo_data($this->content_demo, $attachments);
				
				
				$this->set_demo_pages();
				
				
				if (class_exists('WooCommerce')) {
					$this->set_demo_woo_pages();
				}
				
				
				$this->set_demo_menus();
				
				
				if ($widgets && !empty($this->widgets) && is_file($this->widgets)) {
					$this->process_widget_import_file($this->widgets);
				}
			}
			
			
			if ($sliders && !empty($this->sliders) && is_dir($this->sliders)) {
				$this->set_demo_sliders();
			}
			
			
			do_action('cmsmasters_import_end');
		}
		
		
		public function set_demo_thumbnail_sizes() {
			foreach ($this->thumbnails as $name => $value) {
				update_option($name, $value);
			}
			
			
			$this->flag_as_imported['thumbnails'] = true;
		}
		
		
		public function set_demo_woo_thumbnail_sizes() {
			if (is_array($this->woo_thumbnails)) {
				foreach ($this->woo_thumbnails as $name => $value) {
					if (!is_array($value)) {
						update_option($name, $value);
					} else {
						$serialized = serialize($value);
						
						
						update_option($name, $serialized);
					}
				}
				
				
				$this->flag_as_imported['woo_thumbnails'] = true;
			}
		}
		
		
		public function set_demo_data($file, $attachments = true) {
			if (!defined('WP_LOAD_IMPORTERS')) define('WP_LOAD_IMPORTERS', true);
			
			
			require_once ABSPATH . 'wp-admin/includes/import.php';
			
			
			$importer_error = false;
			
			
			if (!class_exists('WP_Importer')) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				
				
				if (file_exists($class_wp_importer)) {
					require_once($class_wp_importer);
				} else {
					$importer_error = true;
				}
			}
			
			
			if (!class_exists('WP_Import')) {
				$class_wp_import = CMSMASTERS_IMPORTER_PATH . 'wordpress-importer/wordpress-importer.php';
				
				
				if (file_exists($class_wp_import)) {
					require_once($class_wp_import);
				} else {
					$importer_error = true;
				}
			}
			
			
			if ($importer_error) {
				die(__('Error on import', 'cmsmasters-importer'));
			} else {
				if (!is_file($file)) {
					_e("The XML file containing the dummy content is not available or could not be read. <br/>You might want to try to set the file permission to chmod 755. <br/>If this doesn't work please use the Wordpress importer and import the XML file manually (should be located in your theme archive at <strong>/current_theme/inc/admin/assets/demo-content</strong> folder).", 'cmsmasters-importer');
				} else {
					$wp_import = new WP_Import();
					
					
					$wp_import->fetch_attachments = $attachments;
					
					
					if (class_exists('woocommerce')) {
						$this->wc_post_importer_compatibility($file);
					}
					
					
					if (
						class_exists('mp_timetable\classes\models\Import') && 
						!empty($this->mptt_content_demo) && 
						is_file($this->mptt_content_demo)
					) {
						$mptt_import = new mp_timetable\classes\models\Import();
						
						$mptt_import->fetch_attachments = true;
						
						$mptt_import->process_start($this->mptt_content_demo);
					}
					
					
					$wp_import->import($file);
					
					$this->flag_as_imported['content'] = true;
				}
			}
			
			
			do_action('cmsmasters_importer_after_theme_content_import');
		}
		
		
		public function set_demo_pages() {
			update_option('show_on_front', $this->pages['show_on_front']);
			
			
			if ($this->pages['show_on_front'] == 'page') {
				$query_args = array(
					'post_type' => 'page',
					'post_status' => 'any',
					'posts_per_page' => 1,
					'no_found_rows' => true,
					'ignore_sticky_posts' => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'orderby' => 'post_date ID',
					'order' => 'ASC',
				);

				if ($this->pages['page_on_front'] != '') {
					$home_page = new \WP_Query( array_merge( $query_args, array(
						'title' => $this->pages['page_on_front'],
					) ) );
					
					
					if ( ! empty( $home_page->post ) && ! empty( $home_page->post->ID ) ) {
						update_option('page_on_front', $home_page->post->ID);
					}
				}
				
				
				if ($this->pages['page_for_posts'] != '') {
					$posts_page = new \WP_Query( array_merge( $query_args, array(
						'title' => $this->pages['page_for_posts'],
					) ) );
					
					
					if ( ! empty( $posts_page->post ) && ! empty( $posts_page->post->ID ) ) {
						update_option('page_for_posts', $posts_page->post->ID);
					}
				}
			}
			
			
			$this->flag_as_imported['pages'] = true;
		}
		
		
		function set_demo_woo_pages() {
			if (is_array($this->woo_pages)) {
				foreach ($this->woo_pages as $name => $title) {
					$woo_page = new \WP_Query( array(
						'post_type' => 'page',
						'title' => $title,
						'post_status' => 'any',
						'posts_per_page' => 1,
						'no_found_rows' => true,
						'ignore_sticky_posts' => true,
						'update_post_term_cache' => false,
						'update_post_meta_cache' => false,
						'orderby' => 'post_date ID',
						'order' => 'ASC',
					) );
					
					
					if ( ! empty( $woo_page->post ) && ! empty( $woo_page->post->ID) ) {
						update_option($name, $woo_page->post->ID);
					}
				}
				
				
				delete_option('_wc_needs_pages');
				
				delete_transient('_wc_activation_redirect');
				
				
				$this->flag_as_imported['woo_pages'] = true;
			}
		}
		
		
		public function set_demo_menus() {}
		
		
		function available_widgets() {
			global $wp_registered_widget_controls;
			
			
			$widget_controls = $wp_registered_widget_controls;
			
			
			$available_widgets = array();
			
			
			foreach ($widget_controls as $widget) {
				if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']])) {
					$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
					
					$available_widgets[$widget['id_base']]['name'] = $widget['name'];
				}
			}
			
			
			return apply_filters('cmsmasters_theme_import_widget_available_widgets', $available_widgets);
		}
		
		
		function process_widget_import_file($file) {
			if (!file_exists($file)) {
				wp_die( 
					__('Widget Import file could not be found. Please try again.', 'cmsmasters-importer'), 
					'', 
					array('back_link' => true) 
				);
			}
			
			
			$data_json = file_get_contents($file);
			
			$data = json_decode($data_json);
			
			
			$this->widget_import_results = $this->import_widgets($data);
		}
		
		
		public function import_widgets($data) {
			global $wp_registered_sidebars;
			
			
			if (empty($data) || !is_object($data)) {
				return;
			}
			
			
			$data = apply_filters('cmsmasters_theme_import_widget_data', $data);
			
			
			$available_widgets = $this->available_widgets();
			
			
			$widget_instances = array();
			
			
			foreach ($available_widgets as $widget_data) {
				$widget_instances[$widget_data['id_base']] = get_option('widget_' . $widget_data['id_base']);
			}
			
			
			$results = array();
			
			
			foreach ($data as $sidebar_id => $widgets) {
				if ('wp_inactive_widgets' == $sidebar_id) {
					continue;
				}
				
				
				if (isset($wp_registered_sidebars[$sidebar_id])) {
					$sidebar_available = true;
					
					$use_sidebar_id = $sidebar_id;
					
					$sidebar_message_type = 'success';
					
					$sidebar_message = '';
				} else {
					$sidebar_available = false;
					
					$use_sidebar_id = 'wp_inactive_widgets';
					
					$sidebar_message_type = 'error';
					
					$sidebar_message = __('Sidebar does not exist in theme (using Inactive)', 'cmsmasters-importer');
				}
				
				
				$results[$sidebar_id]['name'] = !empty($wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id;
				
				
				$results[$sidebar_id]['message_type'] = $sidebar_message_type;
				
				$results[$sidebar_id]['message'] = $sidebar_message;
				
				$results[$sidebar_id]['widgets'] = array();
				

				$sidebars_widgets_clear = get_option('sidebars_widgets');
				
				$sidebars_widgets_clear[$use_sidebar_id] = array();
				
				update_option('sidebars_widgets', $sidebars_widgets_clear);
				
				
				foreach ($widgets as $widget_instance_id => $widget) {
					$fail = false;
					
					$id_base = preg_replace('/-[0-9]+$/', '', $widget_instance_id);
					
					$instance_id_number = str_replace($id_base . '-', '', $widget_instance_id);
					
					
					if (!$fail && !isset($available_widgets[$id_base])) {
						$fail = true;
						
						$widget_message_type = 'error';
						
						$widget_message = __('Site does not support widget', 'cmsmasters-importer');
					}
					
					
					$widget = apply_filters('cmsmasters_theme_import_widget_settings', $widget);
					
					
					if (!$fail && isset($widget_instances[$id_base])) {
						$sidebars_widgets = get_option('sidebars_widgets');
						
						
						$sidebar_widgets = isset($sidebars_widgets[$use_sidebar_id]) ? $sidebars_widgets[$use_sidebar_id] : array();
						
						
						$single_widget_instances = !empty($widget_instances[$id_base]) ? $widget_instances[$id_base] : array();
						
						
						foreach ($single_widget_instances as $check_id => $check_widget) {
							if (in_array("$id_base-$check_id", $sidebar_widgets) && (array) $widget == $check_widget) {
								$fail = true;
								
								$widget_message_type = 'warning';
								
								$widget_message = __('Widget already exists', 'cmsmasters-importer');
								
								
								break;
							}
						}
					}
					
					
					if (!$fail) {
						$single_widget_instances = get_option( 'widget_' . $id_base );
						
						
						$single_widget_instances = !empty($single_widget_instances) ? $single_widget_instances : array('_multiwidget' => 1);
						
						
						$single_widget_instances[] = (array) $widget;
						
						
						end($single_widget_instances);
						
						
						$new_instance_id_number = key($single_widget_instances);
						
						
						if ('0' === strval($new_instance_id_number)) {
							$new_instance_id_number = 1;
							
							
							$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
							
							
							unset($single_widget_instances[0]);
						}
						
						
						if (isset($single_widget_instances['_multiwidget'])) {
							$multiwidget = $single_widget_instances['_multiwidget'];
							
							
							unset($single_widget_instances['_multiwidget']);
							
							
							$single_widget_instances['_multiwidget'] = $multiwidget;
						}
						
						
						update_option('widget_' . $id_base, $single_widget_instances);
						
						
						$sidebars_widgets = get_option('sidebars_widgets');
						
						
						$new_instance_id = $id_base . '-' . $new_instance_id_number;
						
						$sidebars_widgets[$use_sidebar_id][] = $new_instance_id;
						
						
						update_option('sidebars_widgets', $sidebars_widgets);
						
						
						if ($sidebar_available) {
							$widget_message_type = 'success';
							
							$widget_message = __('Imported', 'cmsmasters-importer');
						} else {
							$widget_message_type = 'warning';
							
							$widget_message = __('Imported to Inactive', 'cmsmasters-importer');
						}
					}
					
					
					$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset($available_widgets[$id_base]['name']) ? $available_widgets[$id_base]['name'] : $id_base;
					
					
					$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = isset($widget->title) ? $widget->title : __('No Title', 'cmsmasters-importer');
					
					
					$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
					
					$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
				}
			}
			
			
			$this->flag_as_imported['widgets'] = true;
			
			
			do_action('cmsmasters_theme_import_widget_after_import');
			
			
			return apply_filters('cmsmasters_theme_import_widget_results', $results);
		}
		
		
		public function set_demo_theme_settings($file) {
			if (file_exists($file)) {
				$settings_hex2bin = file_get_contents($file);
				
				$settings_json = hex2bin($settings_hex2bin);
				
				$settings = json_decode($settings_json, true);
				
				
				if (!empty($settings) || is_array($settings)) {
					$settings = apply_filters('cmsmasters_theme_import_theme_settings', $settings);
					
					
					foreach ($settings as $name => $value) {
						update_option($name, $value);
					}
					
					
					cmsmasters_regenerate_styles();
					
					
					$this->flag_as_imported['settings'] = true;
				}
				
				
				do_action('cmsmasters_importer_after_theme_settings_import', $this->active_import, $this->demo_files_path);
			} else {
				wp_die(
					__('Theme settings Import file could not be found. Please try again.', 'cmsmasters-importer'), 
					'', 
					array('back_link' => true) 
				);
			}
		}
		
		
		public function set_demo_sliders() {
			$layerslider = $this->sliders . 'layerslider/';
			
			$revslider = $this->sliders . 'revslider/';
			
			
			if (is_dir($layerslider) && class_exists('LS_Sliders')) {
				$layerslider_dir = opendir($layerslider);
				
				
				if ($layerslider_dir) {
					include LS_ROOT_PATH . '/classes/class.ls.importutil.php';
					
					
					while (($layerslider_file = readdir($layerslider_dir)) !== false){
						if ($layerslider_file == '.' || $layerslider_file == '..') {
							continue;
						}
						
						
						new LS_ImportUtil($layerslider . $layerslider_file);
					}
					
					
					closedir($layerslider_dir);
					
					
					$this->flag_as_imported['layer_sliders'] = true;
				}
			}
			
			
			if (is_dir($revslider) && class_exists('RevSliderSlider')) {
				$revslider_dir = opendir($revslider);
				
				
				if ($revslider_dir) {
					$rev_slider = new RevSliderSliderImport();
					
					
					while (($revslider_file = readdir($revslider_dir)) !== false){
						if ($revslider_file == '.' || $revslider_file == '..') {
							continue;
						}
						
						
						$rev_slider->import_slider(true, $revslider . $revslider_file, false);
					}
					
					
					closedir($revslider_dir);
					
					
					$this->flag_as_imported['rev_sliders'] = true;
				}
			}
		}
		
		
		public function add_widget_to_sidebar($sidebar_slug, $widget_slug, $count_mod, $widget_settings = array()) {
			$sidebars_widgets = get_option('sidebars_widgets');
			
			
			if (!isset($sidebars_widgets[$sidebar_slug])) {
				$sidebars_widgets[$sidebar_slug] = array('_multiwidget' => 1);
			}
			
			
			$newWidget = get_option('widget_' . $widget_slug);
			
			
			if (!is_array($newWidget)) {
				$newWidget = array();
			}
			
			
			$count = count($newWidget) + 1 + $count_mod;
			
			$sidebars_widgets[$sidebar_slug][] = $widget_slug . '-' . $count;
			
			$newWidget[$count] = $widget_settings;
			
			
			update_option('sidebars_widgets', $sidebars_widgets);
			
			update_option('widget_' . $widget_slug, $newWidget);
		}

		public function wc_post_importer_compatibility($file) {
			global $wpdb;

			$parser = new WXR_Parser();

			$import_data = $parser->parse($file);


			if (isset($import_data['posts']) && !empty($import_data['posts'])) {
				foreach ($import_data['posts'] as $post) {
					if ('product' === $post['post_type'] && !empty($post['terms'])) {
						foreach ($post['terms'] as $term) {
							if (strstr($term['domain'], 'pa_')) {
								if (!taxonomy_exists($term['domain'])) {
									$attribute_name = wc_sanitize_taxonomy_name(str_replace('pa_', '', $term['domain']));


									// Create the taxonomy.
									if (!in_array($attribute_name, wc_get_attribute_taxonomies(), true)) {
										wc_create_attribute(
											array(
												'name' => 			$attribute_name,
												'slug' => 			$attribute_name,
												'type' => 			'select',
												'order_by' => 		'menu_order',
												'has_archives' => 	false,
											)
										);
									}


									// Register the taxonomy now so that the import works!
									register_taxonomy(
										$term['domain'],
										apply_filters('woocommerce_taxonomy_objects_' . $term['domain'], array('product')),
										apply_filters(
											'woocommerce_taxonomy_args_' . $term['domain'], array(
												'hierarchical' => 	true,
												'show_ui' => 		false,
												'query_var' => 		true,
												'rewrite' => 		false,
											)
										)
									);
								}
							}
						}
					}
				}
			}
		}
	}
}

