<?php
/**
 * @author    ThemePunch <info@themepunch.com>
 * @link      https://www.themepunch.com/
 * @copyright 2024 ThemePunch
 */

if(!defined('ABSPATH')) exit();

class RevSliderTemplate extends RevSliderFunctions {
	
	private $templates_list			= 'revslider/get-list.php';
	private $templates_download		= 'revslider/download.php';
	
	public $templates_server_path	= '/revslider/images/';
	private $templates_path			= '/revslider/templates/';
	
	private $curl_check				= null;
	
	const SHOP_VERSION				= '2.0';
	
	/**
	 * Download template by UID (also validates if download is legal)
	 * @since: 5.0.5
	 */
	public function _download_template($uid){
		$rslb	= RevSliderGlobals::instance()->get('RevSliderLoadBalancer');
		$return	= false;
		$uid	= $this->clear_uid($uid);
		$uid	= esc_attr($uid);
		$code	= ($this->_truefalse(get_option('revslider-valid', 'false')) === false) ? '' : get_option('revslider-code', '');
		
		$upload_dir = wp_upload_dir(); // Set upload folder
		// Check folder permission and define file location
		if(wp_mkdir_p($upload_dir['basedir'].$this->templates_path)){ //check here to not flood the server
			$data = array(
				'code'		=> urlencode($code),
				'shop_version' => urlencode(self::SHOP_VERSION),
				'version'	=> urlencode(RS_REVISION),
				'uid'		=> urlencode($uid),
				'product'	=> urlencode(RS_PLUGIN_SLUG)
			);
			
			$request = $rslb->call_url($this->templates_download, $data, 'templates');
			
			if(!is_wp_error($request)){
				if($response = $this->get_val($request, 'body')){
					if($response !== 'invalid'){
						//add stream as a zip file
						$file = $upload_dir['basedir']. $this->templates_path . '/' . $uid.'.zip';
						@mkdir(dirname($file));
						$ret = @file_put_contents( $file, $response );
						if($ret !== false){
							//return $file so it can be processed. We have now downloaded it into a zip file
							$return = $file;
						}else{//else, print that file could not be written
							$return = array('error' => __('Can\'t write the file into the uploads folder of WordPress, please change permissions and try again!', 'revslider'));
						}
					}else{
						$error = ($this->get_addition('selling') === true) ? __('License Key is invalid', 'revslider') : __('Purchase Code is invalid', 'revslider');
						
						$return = array('error' => $error);
					}
				}
			}else{//else, check for error and print it to customer
				$return = array('error' => __('Can\'t connect programatically to the ThemePunch servers, please check your webserver settings', 'revslider'));
			}
		}else{
			$return = array('error' => __('Can\'t write into the uploads folder of WordPress, please change permissions and try again!', 'revslider'));
		}
		
		return $return;
	}
	
	
	/**
	 * Delete the Template file
	 * @since: 5.0.5
	 */
	public function _delete_template($uid){
		$uid		= $this->clear_uid($uid);
		$uid		= esc_attr($uid);
		$upload_dir	= wp_upload_dir(); //Set upload folder
		
		// Check folder permission and define file location
		if(wp_mkdir_p($upload_dir['basedir'] . $this->templates_path)){
			$file = $upload_dir['basedir'] . $this->templates_path . '/' . $uid.'.zip';
			if(file_exists($file)) return unlink($file); //delete file
		}
		return false;
	}
	
	
	/**
	 * Get the Templatelist from servers
	 * @since: 5.0.5
	 */
	public function _get_template_list($force = false){
		$rslb		= RevSliderGlobals::instance()->get('RevSliderLoadBalancer');
		$last_check	= get_option('revslider-templates-check');
		
		if($last_check == false){ //first time called
			$last_check = 172801;
			update_option('revslider-templates-check',  time());
		}
		
		// Get latest Templates
		if(time() - $last_check > 345600 || $force == true){ //4 days
			
			update_option('revslider-templates-check', time());

			$hash = ($force === true) ? '' : get_option('revslider-templates-hash', '');
			$code = ($this->_truefalse(get_option('revslider-valid', 'false')) === false) ? '' : get_option('revslider-code', '');
			$data = array(
				'code'		=> urlencode($code),
				'shop_version' => urlencode(self::SHOP_VERSION),
				'hash'		=> urlencode($hash),
				'version'	=> urlencode(RS_REVISION),
				'product'	=> urlencode(RS_PLUGIN_SLUG)
			);
			$request = $rslb->call_url($this->templates_list, $data, 'templates');

			if(!is_wp_error($request)){
				if($response = maybe_unserialize($request['body'])){
					$templates = json_decode($response, true);
					if(is_array($templates)){
						if(isset($templates['hash'])) update_option('revslider-templates-hash', $templates['hash']);
						$templates = $this->do_compress($templates);
						$upd = update_option('rs-templates-new', $templates, false);
					}
				}
			}
			
			$this->update_template_list();
		}
	}
	
	
	/**
	 * Update the Templatelist, move rs-templates-new into rs-templates
	 * @since: 5.0.5
	 */
	private function update_template_list(){
		$new = get_option('rs-templates-new', false);
		$new = $this->do_uncompress($new);
		$cur = get_option('rs-templates', false);
		$cur = $this->do_uncompress($cur);
		$counter = 0;

		if($new !== false && !empty($new) && is_array($new)){
			if(empty($cur)){
				$cur = $new;
				$counter = (isset($cur['slider']) && is_array($cur['slider'])) ? count($cur['slider']) : $counter;
			}else{
				if(isset($new['slider']) && is_array($new['slider'])){
					if(isset($cur['slider']) && is_array($cur['slider']) && isset($new['slider']) && is_array($cur['slider'])){
						$_n = count($new['slider']);
						$_c = count($cur['slider']);
						$counter = ($_n > $_c) ? $_n - $_c : $counter;
					}
					
					foreach($new['slider'] as $n){
						$found = false;
						if(isset($cur['slider']) && is_array($cur['slider'])){
							foreach($cur['slider'] as $ck => $c){
								if($c['uid'] == $n['uid']){
									if(version_compare($c['version'], $n['version'], '<')){
										$n['is_new'] = true;
										$n['push_image'] = true; //push to get new image and replace
									}
									if(isset($c['is_new'])) $n['is_new'] = true; //is_new will stay until update is done
									
									$n['exists'] = true; //if this flag is not set here, the template will be removed from the list
									
									if(isset($n['new_slider'])){
										unset($n['new_slider']); //remove this again, as the new flag should be removed now
									}
									
									$cur['slider'][$ck] = $n;
									$found = true;
									
									break;
								}
							}
						}
						
						if(!$found){
							$n['exists']	 = true;
							$n['new_slider'] = true;
							$cur['slider'][] = $n;
						}
					}
					
					foreach($cur['slider'] as $ck => $c){ //remove no longer available Slider
						if(!isset($c['exists'])){
							unset($cur['slider'][$ck]);
						}else{
							unset($cur['slider'][$ck]['exists']);
						}
					}
					
					$cur['slides'] = $new['slides']; // push always all slides
				}
			}

			$cur = $this->do_compress($cur);
			update_option('rs-templates', $cur, false);
			update_option('rs-templates-new', false, false);
			
			//$this->_update_images();
		}
		
		update_option('rs-templates-counter', $counter, false);
	}
	
	
	/**
	 * Remove the is_new attribute which shows the "update available" button
	 * @since: 5.0.5
	 */
	public function remove_is_new($uid){
		$cur = get_option('rs-templates', false);
		$cur = $this->do_uncompress($cur);
		
		if(is_array($cur) && isset($cur['slider']) && is_array($cur['slider'])){
			foreach($cur['slider'] as $ck => $c){
				if($c['uid'] == $uid){
					unset($cur['slider'][$ck]['is_new']);
					break;
				}
			}
		}
		
		$cur = $this->do_compress($cur);
		update_option('rs-templates', $cur, false);
	}
	
	
	/**
	 * Update the Images get them from Server and check for existance on each image
	 * @since: 5.0.5
	 * @param bool $img
	 */
	private function _update_images($img = false){
		global $SR_GLOBALS;
		$rslb	= RevSliderGlobals::instance()->get('RevSliderLoadBalancer');
		$templates = get_option('rs-templates', false);
		$templates = $this->do_uncompress($templates);

		$chk	= $this->check_curl_connection();
		$curl	= ($chk) ? new WP_Http_Curl() : false;
		$url	= $rslb->get_url('templates', 0, true);
		$reload	= array();
		
		$loaded = false;
		
		if(!empty($templates) && is_array($templates)){
			$upload_dir = wp_upload_dir(); // Set upload folder
			if(!empty($templates['slider']) && is_array($templates['slider'])){
				foreach($templates['slider'] as $key => $temp){
					if($img !== false){ //we want to download a certain image, check for it
						$temp_img = $this->get_val($temp, 'img');
						if($temp_img !== $img) continue;

						$file_type = wp_check_filetype($temp_img, $this->get_val($SR_GLOBALS, array('mime_types', 'image')));
						if($this->get_val($file_type, 'ext', false) === false || $this->get_val($file_type, 'type', false) === false) continue;
					}
					
					// Check folder permission and define file location
					if(wp_mkdir_p($upload_dir['basedir']. $this->templates_path)){
						$file = $upload_dir['basedir'] . $this->templates_path . '/' . $temp['img'];
						
						if(!file_exists($file) || isset($temp['push_image'])){
							if($curl !== false){
								$done	= false;
								$count	= 0;
								do{
									$image_data = @$curl->request($url.'/'.$this->templates_server_path.$temp['img']); // Get image data
									if(!is_wp_error($image_data) && isset($image_data['body']) && isset($image_data['response']) && isset($image_data['response']['code']) && $image_data['response']['code'] == '200'){
										$image_data = $this->get_val($image_data, 'body');
										$done = true;
									}else{
										$image_data = false;
										$rslb->move_server_list();
										$url = $rslb->get_url('templates', 0, true);
									}
									$count++;
								}while($done == false && $count < 3);
							}else{
								$count = 0;
								do{
									$image_data = wp_remote_get($url.'/'.$this->templates_server_path.$temp['img'], array('timeout' => 10));
									if(!is_wp_error($image_data) && isset($image_data['body']) && isset($image_data['response']) && isset($image_data['response']['code']) && $image_data['response']['code'] == '200'){
										$done = true;
										$image_data = $this->get_val($image_data, 'body');
									}else{
										$image_data = false;
										$rslb->move_server_list();
										$url = $rslb->get_url('templates', 0, true);
									}
									$count++;
								}while($done == false && $count < 3);
							}
							if($image_data !== false){
								$reload[$temp['alias']] = true;
								unset($templates['slider'][$key]['push_image']);
								if(!is_dir(dirname($file))){
									mkdir(dirname($file), 0777, true);
								}
								@file_put_contents($file, $image_data);
								
								$loaded = $file;
							}
						}else{//use default image
						}
					}else{//use default images
					}
				}
			}
			if($loaded === false){
				if(!empty($templates['slides']) && is_array($templates['slides'])){
					foreach($templates['slides'] as $key => $temp){
						foreach($temp as $k => $tvalues){
							if($img !== false){ //we want to download a certain image, check for it
								$temp_img = $this->get_val($tvalues, 'img');
								if($temp_img !== $img) continue;
								
								$file_type = wp_check_filetype($temp_img, $this->get_val($SR_GLOBALS, array('mime_types', 'image')));
								if($this->get_val($file_type, 'ext', false) === false || $this->get_val($file_type, 'type', false) === false) continue;
							}
							
							// Check folder permission and define file location
							if(wp_mkdir_p($upload_dir['basedir']. $this->templates_path)){
								$file = $upload_dir['basedir'] . $this->templates_path . '/' . $tvalues['img'];
								
								if(!file_exists($file) || isset($reload[$key])){ //update, so load again
									if($curl !== false){
										//curl_setopt( $curl, CURLOPT_CAINFO, RS_PLUGIN_PATH.'cert.crt'); //'sslcertificates'
										$done	= false;
										$count	= 0;
										do{
											$image_data = @$curl->request($url.'/'.$this->templates_server_path.$tvalues['img']); // Get image data
											if(!is_wp_error($image_data) && isset($image_data['body']) && isset($image_data['response']) && isset($image_data['response']['code']) && $image_data['response']['code'] == '200'){
												$image_data = $image_data['body'];
												$done = true;
											}else{
												$image_data = false;
												$rslb->move_server_list();
												$url = $rslb->get_url('templates', 0, true);
											}
											$count++;
										}while($done == false && $count < 5);
									}else{
										$count = 0;
										do{
											$image_data = @file_get_contents($url.'/'.$this->templates_server_path.$tvalues['img']); // Get image data
											if($image_data == false){
												$rslb->move_server_list();
												$url = $rslb->get_url('templates', 0, true);
											}
											$count++;
										}while($image_data == false && $count < 5);
									}
									if($image_data !== false){
										if(!is_dir(dirname($file))){
											mkdir(dirname($file), 0777, true);
										}
										file_put_contents($file, $image_data);
									}
								}
							}
						}
					}
				}
			}
		}
		
		$templates = $this->do_compress($templates);
		update_option('rs-templates', $templates, false); //remove the push_image
	}
	
	
	/**
	 * get default ThemePunch default Slides
	 * @since: 5.0
	 * @before: RevSliderTemplate::getThemePunchTemplateSlides()
	 * @param bool $sliders
	 */
	public function get_tp_template_slides($sliders = false){
		global $wpdb;
		
		$templates = array();
		if($sliders == false) $sliders = $this->get_tp_template_sliders();
	
		foreach($sliders ?? [] as $slider){
			$slides		= $this->get_tp_template_default_slides($slider['alias']);
			$installed	= false;
			
			if($this->get_val($slider, 'installed', false) !== false){
				$cur_slides = $wpdb->get_results($wpdb->prepare("SELECT * FROM ". $wpdb->prefix . RevSliderFront::TABLE_SLIDES ." WHERE slider_id = %s", $slider['installed']), ARRAY_A);
				$installed	= true;
			}else{
				$cur_slides = $slides;
			}
			
			if(!empty($cur_slides)){
				$i = 1;
				foreach($cur_slides as $key => $tmpl){
					if(isset($slides[$key]) && !empty($slides[$key]['img'])) $cur_slides[$key]['img']	= $this->_check_file_path($slides[$key]['img'], true, false);
					if($this->get_val($tmpl, 'title', false) === false) $cur_slides[$key]['title']		= 'Slide '.$i;
					$cur_slides[$key]['uid']	= $this->get_val($slider, 'uid');
					$cur_slides[$key]['parent']	= $this->get_val($slider, 'id');
					if($installed){
						$cur_slides[$key]['installed'] = $this->get_val($tmpl, 'id');
					}
					
					//addon requirements
					$cur_slides[$key]['plugin_require'] = $this->get_val($slider, 'plugin_require', array());
					
					$i++;
				}
			}
			
			$templates = array_merge($templates, $cur_slides);
		}
	
		foreach($templates ?? [] as $key => $template){
			if($this->get_val($template, 'installed', false) === false) continue;
			$template['params']		= $this->get_val($template, 'params', '');
			$template['layers']		= $this->get_val($template, 'layers', '');
			$template['settings']	= $this->get_val($template, 'settings', '');
			
			$templates[$key]['params']	 = json_decode($template['params'], true);
			//$templates[$key]['layers'] = json_decode($template['layers'], true);
			$templates[$key]['settings'] = json_decode($template['settings'], true);
		}
		
		return $templates;
	}
	
	
	/**
	 * get default ThemePunch default Slides
	 * @since: 5.0
	 * @before: RevSliderTemplate::getThemePunchTemplateDefaultSlides()
	 */
	public function get_tp_template_default_slides($slider_alias){
		$templates	= get_option('rs-templates', false);
		$templates	= $this->do_uncompress($templates);
		$slides		= (is_array($templates) && isset($templates['slides']) && !empty($templates['slides'])) ? $templates['slides'] : array();
		
		return (isset($slides[$slider_alias])) ? $slides[$slider_alias] : array();
	}
	
	
	/**
	 * get default ThemePunch default Sliders
	 * @since: 5.0
	 * @before: RevSliderTemplate::getThemePunchTemplateSliders()
	 *
	 */
	public function get_tp_template_sliders($uid = false){
		global $wpdb;

		$plugin_list = array();
		$defaults 	= get_option('rs-templates', false);
		$defaults 	= $this->do_uncompress($defaults);
		$defaults 	= $this->get_val($defaults, 'slider', array());
		
		if(empty($defaults)) return $defaults;
	
		$favorite = RevSliderGlobals::instance()->get('RevSliderFavorite');
		
		foreach($defaults as $dk => $default){
			if($uid !== false && $uid !== $this->get_val($default, 'uid')){
				unset($defaults[$dk]);
				continue;
			}
			$defaults[$dk]['plugin_require'] = (isset($defaults[$dk]['plugin_require']) && !empty($defaults[$dk]['plugin_require'])) ? json_decode($defaults[$dk]['plugin_require'], true) : '';
			
			if(!empty($defaults[$dk]['plugin_require'])){
				foreach($defaults[$dk]['plugin_require'] as $pr => $plugin){
					$path = $this->get_val($plugin, 'path');
					if(!isset($plugin_list[$path])){
						$plugin_list[$path] = (is_plugin_active(esc_attr($path))) ? true : false;
					}
					$defaults[$dk]['plugin_require'][$pr]['installed'] = ($plugin_list[$path] === true) ? true : false;
				}
			}

			$tags	= $defaults[$dk]['filter'];
			$tags[]	= $defaults[$dk]['cat'];
			$defaults[$dk]['tags'] = $tags;
			unset($defaults[$dk]['filter']);
			unset($defaults[$dk]['cat']);
			
			if(!isset($defaults[$dk]['setup_notes'])){
				$defaults[$dk]['setup_notes'] = '<span class="ttm_content">Checkout our <a href="https://www.themepunch.com/revslider-doc/slider-revolution-documentation/" target="_blank" rel="noopener">Documentation</a> for basic Slider Revolution help.</span>';
			}
			
			$id = $this->get_val($default, 'id', 0);
			$defaults[$dk]['favorite'] = $favorite->is_favorite('moduletemplates', $id);
		}
		
		krsort($defaults);
		
		return $defaults;
	}
	
	
	/**
	 * get the template sliders for the get_full_library function
	 * @since: 6.0
	 */
	public function get_tp_template_sliders_for_library($leave_counter = false){
		$templates = $this->get_tp_template_sliders();
		foreach($templates ?? [] as $k => $t){
			if(isset($templates[$k]['params'])) unset($templates[$k]['params']);
		}
		
		if(!$this->_truefalse($leave_counter)){
			update_option('rs-templates-counter', 0, false); //reset the counter
		}
		return $templates;
	}
	
	
	/**
	 * get the template slides for the get_full_library function
	 * @since: 6.0
	 */
	public function get_tp_template_slides_for_library($tmp_slide_uid){
		$tmp_slide_uid = (array)$tmp_slide_uid;
		if(!empty($tmp_slide_uid)){
			$templates = array();
			foreach($tmp_slide_uid ?? [] as $tmp_uid){
				$templates = $this->get_tp_template_sliders($tmp_uid);
			}
		}else{
			$templates = $this->get_tp_template_sliders();
		}
		
		$templates_slides = $this->get_tp_template_slides($templates);
		foreach($templates_slides ?? [] as $t_k => $t_slide){
			if(isset($t_slide['params'])) unset($templates_slides[$t_k]['params']);
			if(isset($t_slide['layers'])) unset($templates_slides[$t_k]['layers']);
			if(isset($t_slide['settings'])) unset($templates_slides[$t_k]['settings']);
		}
		
		return $templates_slides;
	}
	
	
	/**
	 * check if image was uploaded, if yes, return path or url
	 * @since: 5.0.5
	 */
	public function _check_file_path($image, $url = false, $download = true){
		$upload_dir	 = wp_upload_dir(); // Set upload folder
		$file		 = $upload_dir['basedir'] . $this->templates_path . '/' . $image;
		
		if(file_exists($file)){ //downloaded image first, for update reasons
			$image = ($url) ? $upload_dir['baseurl'] . $this->templates_path . '/' . $image : $upload_dir['basedir'] . $this->templates_path . '/' . $image; //server path
		}elseif($download === true){
			//redownload image from server and store it
			$this->_update_images($image);
			if(file_exists($file)){ //downloaded image first, for update reasons
				$image = ($url) ? $upload_dir['baseurl'] . $this->templates_path . '/' . $image : $upload_dir['basedir'] . $this->templates_path . '/' . $image; //server path
			}
		}
		
		return $image;
	}
	
	
	/**
	 * Get all uids from a certain package, by one uid
	 * @since: 5.2.5
	 */
	public function get_package_uids($uid, $sliders = false){
		if($sliders == false){
			$sliders = $this->get_tp_template_sliders();
		}
		
		$uids = array();
		
		$package = false;
		foreach($sliders ?? [] as $slider){
		if($slider['uid'] != $uid) continue;
			if(isset($slider['package'])) $package = $slider['package'];
			break;
		}
		
		if($package !== false){
			$i = 0;
			$tuids = array();
			foreach($sliders ?? [] as $slider){
				if(isset($slider['package']) && $slider['package'] == $package){
					if(isset($slider['package_parent']) && $slider['package_parent'] == 'true') continue; //dont install parent package
					
					if($this->get_val($slider, 'installed') !== false){ //add an invalid slider id as we have not yet installed it
						$i--;
						$sid = $i;
					}else{ //add the installed slider id, as we have the template installed already
						$sid = $slider['id'];
					}
					$order = (isset($slider['package_order'])) ? $slider['package_order'] : 0;
					$tuids[] = array(
						'uid' => $slider['uid'],
						'sid' => $sid,
						'order' => $order
					);
				}
			}
		}

		if(!empty($tuids)){
			usort($tuids, array($this, 'sort_by_order'));
			foreach($tuids as $uid){
				$uids[$uid['sid']] = $uid['uid'];
			}
		}
		
		return $uids;
	}
	
	
	/**
	 * check if Slider Template was already imported. If yes, remove the old Slider Template as we now do an "update" (in reality we delete and insert again)
	 */
	public function remove_old_template($uid){
		//get all template sliders
		$templates = $this->get_tp_template_sliders($uid);
		
		foreach($templates ?? [] as $tslider){
			if($this->get_val($tslider, 'uid') != $uid) continue;
		
			if($this->get_val($tslider, 'installed', false) === false) break;
			
			//slider is installed
			//delete template Slider!
			$mSlider = new RevSliderSlider();
			$mSlider->init_by_id($tslider['installed']);
			
			$mSlider->delete_slider();

			//remove the update flag from the slider
			$this->remove_is_new($uid);
			break;
		}
	}
	
	
	public function sort_by_order($a, $b) {
		return $a['order'] - $b['order'];
	}
	
	
	/**
	 * Check if Curl can be used
	 */
	public function check_curl_connection(){
		if($this->curl_check !== null) return $this->curl_check;
		$curl = new WP_Http_Curl();
		$this->curl_check = $curl->test();
		return $this->curl_check;
	}
	
	
	/**
	 * get the template existing categories, merging filter and cat
	 **/
	public function get_template_categories(){
		$cat = array();
		
		$defaults = get_option('rs-templates', false);
		$defaults = $this->do_uncompress($defaults);
		$defaults = $this->get_val($defaults, 'slider', array());
	
		foreach($defaults ?? [] as $def){
			$d_cat		= $this->get_val($def, 'cat', '');
			$d_filter	= $this->get_val($def, 'filter', array());
			if(trim($d_cat) !== '' && !isset($cat[$d_cat])) $cat[$d_cat] = ucfirst($d_cat);
			
			foreach($d_filter ?? [] as $filter){
				if(trim($filter) !== '' && !isset($cat[$filter])) $cat[$filter] = ucfirst($filter);
			}
		}
		
		return $cat;
	}
	
	
	/**
	 * get the slide thumbnail
	 **/
	public function get_slide_image_by_uid($uid, $slidenumber){
		$defaults	= get_option('rs-templates', false);
		$defaults	= (!is_array($defaults)) ? json_decode($defaults, true) : $defaults;
		$sliders	= $this->get_val($defaults, 'slider', array());
		$slides		= $this->get_val($defaults, 'slides', array());
		$image		= false;
		
		foreach($sliders ?? [] as $slider){
			if($this->get_val($slider, 'uid') != $uid) continue;
			
			$alias = $this->get_val($slider, 'alias');
			$slide = $this->get_val($slides, $alias, array());
			
			if(!empty($slide)){
				$sl		= $this->get_val($slide, $slidenumber, array());
				$image	= $this->get_val($sl, 'img');
			}
			break;
		}
		
		return ($image !== false) ? $this->_check_file_path($image, true, true) : $image;
	}
	
	
	/**
	 * get the slide thumbnail
	 **/
	public function get_slider_id_by_uid($uid){
		$templates = $this->get_tp_template_sliders();
		
		foreach($templates ?? [] as $template){
			if($this->get_val($template, 'uid') != $uid) continue;
		
			return intval($this->get_val($template, 'installed'));
		}
		
		return 0;
	}
	
	/**
	 * clears the uid to make sure no illegal characters are in it
	 **/
	public function clear_uid($uid){
		return preg_replace("/[^a-zA-Z0-9\s]/", '', $uid);
	}
}