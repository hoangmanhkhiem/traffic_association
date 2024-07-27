<?php

// Prevent direct file access
defined( 'LS_ROOT_FILE' ) || exit;

// Popup
if( ! empty( $slides['properties']['attrs']['type'] ) && $slides['properties']['attrs']['type'] === 'popup' ) {
	$slides['properties']['props']['width']  = ! empty( $slides['properties']['props']['popupWidth'] ) ? $slides['properties']['props']['popupWidth'] : 640;
	$slides['properties']['props']['height'] = ! empty( $slides['properties']['props']['popupHeight']) ? $slides['properties']['props']['popupHeight'] : 360;
}

// Get slider style
$sliderStyleAttr[] = 'width:'.layerslider_check_unit($slides['properties']['props']['width']).';';

if( ( !empty($slides['properties']['attrs']['type']) && $slides['properties']['attrs']['type'] === 'fullsize' ) && ( empty($slides['properties']['attrs']['fullSizeMode']) || $slides['properties']['attrs']['fullSizeMode'] !== 'fitheight' ) ) {
	$sliderStyleAttr[] = 'height:100vh;';
} else {
	$sliderStyleAttr[] = 'height:'.layerslider_check_unit($slides['properties']['props']['height']).';';
}

if(!empty($slides['properties']['props']['maxwidth'])) {
	$sliderStyleAttr[] = 'max-width:'.layerslider_check_unit($slides['properties']['props']['maxwidth']).';';
}

$sliderStyleAttr[] = 'margin:0 auto;';
if(isset($slides['properties']['props']['sliderStyle'])) {
	$sliderStyleAttr[] = str_replace('\n', ' ', $slides['properties']['props']['sliderStyle'] );
}

// Border radius
$borderRadius = ! empty( $slides['properties']['props']['borderRadius'] ) ? $slides['properties']['props']['borderRadius'] : '';
if( ! empty( $borderRadius ) && $borderRadius !== '0px' && $borderRadius !== '0%' && $borderRadius !== '0' ) {
	$sliderStyleAttr[] = 'border-radius:'.layerslider_check_unit($borderRadius).';overflow: hidden;';
}

// Gutenberg Margin Options
if( ! empty( $embed['marginTop'] ) ) { $sliderStyleAttr[] = 'margin-top: '.layerslider_check_unit( $embed['marginTop'] ).';'; }
if( ! empty( $embed['marginRight'] ) ) { $sliderStyleAttr[] = 'margin-right: '.layerslider_check_unit( $embed['marginRight'] ).';'; }
if( ! empty( $embed['marginBottom'] ) ) { $sliderStyleAttr[] = 'margin-bottom: '.layerslider_check_unit( $embed['marginBottom'] ).';'; }
if( ! empty( $embed['marginLeft'] ) ) { $sliderStyleAttr[] = 'margin-left: '.layerslider_check_unit( $embed['marginLeft'] ).';'; }

// Before slider content hook
if(has_action('layerslider_before_slider_content')) {
	do_action('layerslider_before_slider_content');
}

// Wrap Popups
if( !empty($slides['properties']['attrs']['type']) && $slides['properties']['attrs']['type'] === 'popup' ) {
	$popupClasses = ! empty( $slides['properties']['props']['popupScrollable'] ) ? 'ls-popup-scrollable' : '';
	$lsContainer[] = '<div class="ls-popup '.$popupClasses.'">';
}

$customClasses = '';
if( ! empty( $slides['properties']['props']['sliderclass'] ) ) {
	$customClasses = ' '.$slides['properties']['props']['sliderclass'];
}

if( ! empty( $embed['className'] ) ) {
	$customClasses .= ' '.$embed['className'];
}

// v7.10.0: Class to control new user-select option
if( empty( $slides['properties']['props']['noUserSelect']) ) {
	$customClasses .= ' ls-selectable';
}

// Use srcset
$useSrcset = (bool) get_option('ls_use_srcset', true );
if( isset( $slides['properties']['attrs']['useSrcset'] ) ) {

	if( is_bool( $slides['properties']['attrs']['useSrcset'] ) ) {
		$useSrcset = $slides['properties']['attrs']['useSrcset'];

	} elseif( $slides['properties']['attrs']['useSrcset'] === 'enabled' ||
			  $slides['properties']['attrs']['useSrcset'] === '1' ) {
		$useSrcset = true;

	} elseif( $slides['properties']['attrs']['useSrcset'] === 'disabled') {
		$useSrcset = false;
	}
}

$slides['properties']['attrs']['useSrcset'] = $useSrcset;


// Enhanced lazy load
$enhancedLazyLoad = (bool) get_option('ls_enhanced_lazy_load', false );
if( isset( $slides['properties']['props']['enhancedLazyLoad'] ) ) {

	if( is_bool( $slides['properties']['props']['enhancedLazyLoad'] ) ) {
		$enhancedLazyLoad = $slides['properties']['props']['enhancedLazyLoad'];

	} elseif( $slides['properties']['props']['enhancedLazyLoad'] === 'enabled' ||
			  $slides['properties']['props']['enhancedLazyLoad'] === '1') {
		$enhancedLazyLoad = true;

	} elseif( $slides['properties']['props']['enhancedLazyLoad'] === 'disabled') {
		$enhancedLazyLoad = false;
	}
}

$slides['properties']['props']['enhancedLazyLoad'] = $enhancedLazyLoad;


// Performance mode
$performanceMode = (bool) get_option('ls_performance_mode', true );
if( isset( $slides['properties']['attrs']['performanceMode'] ) ) {

	if( is_bool( $slides['properties']['attrs']['performanceMode'] ) ) {
		$performanceMode = $slides['properties']['attrs']['performanceMode'];

	} elseif( $slides['properties']['attrs']['performanceMode'] === 'enabled' ||
			  $slides['properties']['attrs']['performanceMode'] === '1') {
		$performanceMode = true;

	} elseif( $slides['properties']['attrs']['performanceMode'] === 'disabled' ||
			  empty( $slides['properties']['attrs']['performanceMode'] ) ) {
		$performanceMode = false;
	}
}

$slides['properties']['attrs']['performanceMode'] = $performanceMode;



// Project-level Google Fonts
if( get_option('layerslider-google-fonts-enabled', true ) ) {

	$slides = ls_merge_google_fonts( $slides );

	if( ! empty( $slides['googlefonts'] ) ) {

		$fontManager = new LS_GoogleFontsManager();
		$lsContainer[] = $fontManager->getInlineStyle( $slides['googlefonts'] );
	}
}






// STICKY + SCROLL SCENE

$type 					= ! empty( $slides['properties']['attrs']['type'] ) ? $slides['properties']['attrs']['type'] : 'responsive';
$scene 					= ! empty( $slides['properties']['attrs']['scene'] ) ? $slides['properties']['attrs']['scene'] : '';
$needsSceneWrapper 		= ( $type !== 'popup' && ! empty( $scene ) );
$sceneWrapperHeight 	= '';

if( $needsSceneWrapper ) {

	$sceneDuration 	= ! empty( $slides['properties']['attrs']['sceneDuration'] ) ? (float) $slides['properties']['attrs']['sceneDuration'] : 1;
	$sceneSpeed 	= ! empty( $slides['properties']['attrs']['sceneSpeed'] ) ? (float) $slides['properties']['attrs']['sceneSpeed'] : 100;
	$sceneSpeed 	= max( 10, $sceneSpeed );
	$sceneSpeed 	= min( 999, $sceneSpeed );
	$sceneHeight 	= ! empty( $slides['properties']['attrs']['sceneHeight'] ) ? $slides['properties']['attrs']['sceneHeight'] : '200%';
	$canvasHeight 	= (float) $slides['properties']['props']['height'];

	if( in_array( $type, ['fixedsize', 'responsive', 'fullwidth'] ) ) {

		if( $scene === 'scroll' ) {
			$sceneWrapperHeight = round( $canvasHeight + ( $canvasHeight * $sceneDuration / ( $sceneSpeed / 100 ) ) ) . 'px';

		} elseif( $scene === 'sticky' ) {

			if( strpos( $sceneHeight, '%') !== false || strpos( $sceneHeight, 'sh') !== false  ) {
				$sceneWrapperHeight = round( $canvasHeight * ( (float) $sceneHeight / 100 ) ) . 'px';
			} elseif( strpos( $sceneHeight, 'px') !== false ) {
				$sceneWrapperHeight = round( max( (float) $sceneHeight, $canvasHeight ) ). 'px';
			} else {
				$sceneWrapperHeight = $sceneHeight;
			}
		}

	} else {

		if( $scene === 'scroll' ) {
			$sceneWrapperHeight = 100 + ( 100 * $sceneDuration / ( $sceneSpeed / 100 ) ) . 'vh';

		} elseif( $scene === 'sticky' ) {

			if( strpos( $sceneHeight, '%') !== false || strpos( $sceneHeight, 'sh') !== false  ) {
				$sceneWrapperHeight = max( 100, 100 * ( (float) $sceneHeight / 100 ) ) . 'vh';
			} elseif( strpos( $sceneHeight, 'px') !== false ) {
				$sceneWrapperHeight = round( max( (float) $sceneHeight, $canvasHeight ) ) . 'px';
			} else {
				$sceneWrapperHeight = max( 100, (float) $sceneHeight ) . 'vh';
			}
		}
	}




	// Sticky + Scroll Scene wrapper START
	$lsContainer[] = '<ls-scene-wrapper '.( !empty( $sceneWrapperHeight ) ? 'style="height: '.$sceneWrapperHeight.'"' : '').'>';
}





// Start of slider container
$lsContainer[] = '<div id="'.$sliderID.'" '.( ! empty( $sliderSlug ) ? 'data-ls-slug="'.$sliderSlug.'"' : '' ).' class="ls-wp-container fitvidsignore'.$customClasses.'" style="'.implode('', $sliderStyleAttr).'">';

// Add slides
if(!empty($slider['slides']) && is_array($slider['slides'])) {
	foreach($slider['slides'] as $slidekey => $slide) {

		// Skip this slide?
		if( ! empty( $slide['props']['skip'] ) ) {
			continue;
		}

		// Schedule start
		if( ! empty( $slide['props']['schedule_start'] ) && (int) $slide['props']['schedule_start'] > time() ) {
			continue;
		}

		// Schedule end
		if( ! empty( $slide['props']['schedule_end'] ) && (int) $slide['props']['schedule_end'] < time() ) {
			continue;
		}

		// First slide only for Scroll Scene
		if( ( $scene === 'scroll' && $type !== 'popup' ) && $slidekey > 0 ) {
			break;
		}


		// Get slide attributes
		$slideId = !empty($slide['props']['id']) ? ' id="'.$slide['props']['id'].'"' : '';
		$slideAttrs = !empty($slide['attrs']) ? ls_array_to_attr($slide['attrs']) : '';

		if( ! empty( $slide['props']['customProperties'] ) && is_array( $slide['props']['customProperties'] ) ) {
			$slideAttrs .= ls_array_to_attr( $slide['props']['customProperties'] );
		}

		$postContent = false;


		// Check for the origami plugin
		if( ! empty( $slide['attrs']['transitionorigami'] ) ) {
			$lsPlugins[] = 'origami';
		}

		// Post content
		//if( !isset($slide['props']['post_content']) || $slide['props']['post_content']) {
			$queryArgs = [
				'post_status' => 'publish',
				'limit' => 1,
				'posts_per_page' => 1,
				'suppress_filters' => false
			];


			if(isset($slide['props']['post_offset'])) {
				if($slide['props']['post_offset'] == -1) {
					$slide['props']['post_offset'] = $slidekey;
				}

				$queryArgs['offset'] = $slide['props']['post_offset'];
			}

			if(!empty($slides['properties']['props']['post_type'])) {
				$queryArgs['post_type'] = $slides['properties']['props']['post_type']; }

			if(!empty($slides['properties']['props']['post_orderby'])) {
				$queryArgs['orderby'] = $slides['properties']['props']['post_orderby']; }

			if(!empty($slides['properties']['props']['post_order'])) {
				$queryArgs['order'] = $slides['properties']['props']['post_order']; }

			if(!empty($slides['properties']['props']['post_categories'][0])) {
				$queryArgs['category__in'] = $slides['properties']['props']['post_categories']; }

			if(!empty($slides['properties']['props']['post_tags'][0])) {
				$queryArgs['tag__in'] = $slides['properties']['props']['post_tags']; }

			if(!empty($slides['properties']['props']['post_taxonomy']) && !empty($slides['properties']['props']['post_tax_terms'])) {
				$queryArgs['tax_query'][] = [
					'taxonomy' => $slides['properties']['props']['post_taxonomy'],
					'field' => 'id',
					'terms' => $slides['properties']['props']['post_tax_terms']
				];
			}

			$postContent = LS_Posts::find($queryArgs);
		//}

		// Start of slide
		$slideAttrs = !empty($slideAttrs) ? 'data-ls="'.$slideAttrs.'"' : '';
		$lsMarkup[] = '<div class="ls-slide"'.$slideId.' '.$slideAttrs.'>';

		// Add slide background
		if( ! empty( $slide['props']['background'] ) && ls_assets_cond( $slide['props'], 'background') ) {
			$lsBG = '';
			$alt = '';

			if( ! empty($slide['props']['backgroundId'])) {

				if( has_filter('wpml_object_id') && get_option('ls_wpml_media_translation', true ) ) {
					$slide['props']['backgroundId'] = apply_filters('wpml_object_id', $slide['props']['backgroundId'], 'attachment', true );
				}

				$lsBG = ls_get_markup_image( $slide['props']['backgroundId'], ['class' => 'ls-bg'] );

			} elseif($slide['props']['background'] == '[image-url]') {
				$src = $postContent->getWithFormat($slide['props']['background']);

				if(is_object($postContent->post)) {
					$attchID = get_post_thumbnail_id($postContent->post->ID);
					$lsBG = ls_get_markup_image( $attchID, ['class' => 'ls-bg'] );
				}
			} else {
				$src = do_shortcode($slide['props']['background']);
				$alt = 'Slide background';
			}

			if( ! empty( $lsBG ) ) {


				if( ! $useSrcset ) {
					$lsBG = preg_replace('/srcset="[^\"]*"/', '', $lsBG);
					$lsBG = preg_replace('/sizes="[^\"]*"/', '', $lsBG);
				}

				if( $enhancedLazyLoad ) {
					$lsBG = str_replace(' src="', ' data-src="', $lsBG);
					$lsBG = str_replace(' srcset="', ' data-srcset="', $lsBG);
				}

				$lsMarkup[] = $lsBG;
			} elseif( ! empty( $src ) ) {
				$lsMarkup[] = '<img src="'.$src.'" class="ls-bg" alt="'.$alt.'" />';
			}
		}

		// Add slide thumbnail
		if(!isset($slides['properties']['attrs']['thumbnailNavigation']) || $slides['properties']['attrs']['thumbnailNavigation'] != 'disabled') {
			if( ! empty( $slide['props']['thumbnail'] ) && ls_assets_cond( $slide['props'], 'thumbnail') ) {

				$lsTN = '';
				if( ! empty($slide['props']['thumbnailId']) ) {

					if( has_filter('wpml_object_id') && get_option('ls_wpml_media_translation', true ) ) {
						$slide['props']['thumbnailId'] = apply_filters('wpml_object_id', $slide['props']['thumbnailId'], 'attachment', true );
					}

					$lsTN = ls_get_markup_image( $slide['props']['thumbnailId'], ['class' => 'ls-tn'] );
				}

				if( ! empty( $lsTN ) && ! $useSrcset ) {
					$lsTN = preg_replace('/srcset="[^\"]*"/', '', $lsTN);
					$lsTN = preg_replace('/sizes="[^\"]*"/', '', $lsTN);
				}

				if( ! empty( $lsTN ) && $enhancedLazyLoad ) {
					$lsTN = str_replace(' src="', ' data-src="', $lsTN);
					$lsTN = str_replace(' srcset="', ' data-srcset="', $lsTN);
				}

				$lsMarkup[] = ! empty( $lsTN ) ? $lsTN : '<img src="'.$slide['props']['thumbnail'].'" class="ls-tn" alt="Slide thumbnail" />';
			}
		}

		// Add layers
		if(!empty($slide['layers']) && is_array($slide['layers'])) {
			foreach($slide['layers'] as $layerkey => $layer) {

				$svgIB = false;

				// Skip this layer?
				if( ! empty( $layer['props']['skip'] ) ) {
					$skip = ls_normalize_hide_layer_value( $layer['props']['skip'] );
					if( $skip === 'all' ) {
						continue;
					}
				}

				unset($layerAttributes);
				unset($innerAttributes);
				$layerAttributes = ['style' => '', 'class' => 'ls-l'];
				$innerAttributes = ['style' => '', 'class' => ''];

				if( empty( $layer['props']['url'] ) ) {
					$innerAttributes =& $layerAttributes;
				}

				if( empty( $layer['props']['styles'] ) ) {
					$layer['props']['styles'] = [];
				}

				$layer['props']['html'] = ( ! empty( $layer['props']['html'] ) || ( isset( $layer['props']['html'] ) && $layer['props']['html'] === '0' ) ) ? trim( $layer['props']['html'] ) : '';
				$layer['props']['type'] = !empty($layer['props']['type']) ? $layer['props']['type'] : '';
				$layer['props']['media'] = !empty($layer['props']['media']) ? $layer['props']['media'] : '';

				// Premium layer content checks
				if( ! $GLOBALS['lsIsActivatedSite'] ) {

					if( $layer['props']['media'] === 'shape' ) {
						continue;
					}

					if( $layer['props']['media'] === 'icon' && ! empty( $layer['props']['html'] ) && strpos( $layer['props']['html'], '<svg' ) !== false ) {
						continue;
					}

					if( in_array( $layer['props']['media'], ['text', 'media', 'button', 'shape', 'icon', 'svg', 'html', 'post'] ) ) {
						if( ! ls_assets_cond( $layer['props'] ) ) {
							continue;
						}
					}
				}

				// WPML support
				if( has_filter( 'wpml_translate_single_string' ) && get_option('ls_wpml_string_translation', true ) ) {

					// Check 'createdWith' property to decide which WPML implementation
					// should we use. This property was added in v6.5.5 along with the
					// new WPML implementation, so no version comparison required.
					if( ! empty( $slides['properties']['attrs']['createdWith'] ) ) {
						$string_name = "slider-{$id}-layer-{$layer['props']['uuid']}-html";
						$layer['props']['html'] = apply_filters( 'wpml_translate_single_string', $layer['props']['html'], 'LayerSlider Sliders', $string_name );

					// Old implementation
					} else {
						$string_name = '<'.$layer['props']['type'].':'.substr(sha1($layer['props']['html']), 0, 10).'> layer on slide #'.($slidekey+1).' in slider #'.$id.'';
						$layer['props']['html'] = apply_filters( 'wpml_translate_single_string', $layer['props']['html'], 'LayerSlider WP', $string_name);
					}

					// Fallback WPML support for older sliders.
					if( ! empty( $layer['props']['url'] ) ) {

						// Don't try to modify the URL if it's auto-generated
						if( empty( $layer['props']['linkId'] ) && $layer['props']['url'] !== '[post-url]' ) {

							// Don't try to modify the URL if it starts with a hash tag.
							$firstChar = function_exists('mb_substr') ? mb_substr( $layer['props']['url'], 0, 1 ) : substr( $layer['props']['url'], 0, 1 );
							if( $firstChar !== '#' ) {

								// Carry over the 'lang' URI param if it's set and the URL is non-relative, non-external
								if( ! empty( $_GET['lang'] ) && ( strpos($layer['props']['url'], 'http') !== 0 || strpos( $layer['props']['url'], $_SERVER['SERVER_NAME'] ) !== false ) ) {
									if(strpos($layer['props']['url'], '?') !== false) { $layer['props']['url'] .= '&amp;lang=' . ICL_LANGUAGE_CODE; }
										else { $layer['props']['url'] .= '?lang=' . ICL_LANGUAGE_CODE; }
								}
							}
						}
					}
				}

				// v7.0.0: Normalize HTML element tag for old versions
				if( empty( $layer['props']['htmlTag'] ) ) {

					$layer['props']['htmlTag'] = ! empty( $layer['props']['type'] ) ? $layer['props']['type'] : 'ls-layer';

					if( ! empty( $layer['props']['media'] ) ) {
						switch( $layer['props']['media'] ) {
							case 'img':
								$layer['props']['htmlTag'] = 'img';
								break;

							case 'button':
							case 'icon':
								$layer['props']['htmlTag'] = 'span';
								break;

							case 'html':
							case 'media':
								$layer['props']['htmlTag'] = 'div';
								break;

							case 'post':
								$layer['props']['htmlTag'] = 'div';
								break;
						}
					}
				}


				// Post layer
				if( $layer['props']['media'] === 'post' ) {
					$layer['props']['post_text_length'] = !empty($layer['props']['post_text_length']) ? $layer['props']['post_text_length'] : 0;
					$layer['props']['html'] = $postContent->getWithFormat($layer['props']['html'], $layer['props']['post_text_length']);
					$layer['props']['html'] = do_shortcode($layer['props']['html']);
				}


				// Handle media uploads
				if( $layer['props']['media'] === 'media' && isset( $layer['props']['mediaAttachments'] ) ) {

					// Make sure to empty the layer's HTML in case of using uploaded media
					$layer['props']['html'] = '';

					if( ! empty( $layer['props']['mediaAttachments'] ) ) {

						$mediaHTML = '';
						$mediaType = $layer['props']['mediaAttachments'][0]['type'];

						if( $mediaType === 'video' ) {
							$mediaHTML .= '<video width="640" height="360" preload="metadata" controls>';
						} else {
							$mediaHTML .= '<audio preload="metadata" controls>';
						}

						foreach( $layer['props']['mediaAttachments'] as $item ) {

							if( has_filter('wpml_object_id') && get_option('ls_wpml_media_translation', true ) ) {
								$item['id'] = apply_filters('wpml_object_id', $item['id'], 'attachment', true );
							}

							$mediaURL = wp_get_attachment_url( $item['id'] );
							$mediaURL = ! empty( $mediaURL ) ? $mediaURL : $item['url'];
							$mediaHTML .= '<source src="'.$mediaURL.'" type="'.$item['mime'].'">';
						}


						$mediaHTML .= '</'.$mediaType.'>';

						$layer['props']['html'] = $mediaHTML;
					}
				}

				// Should wrap layer? Test for a single HTML element
				$wrapLayer = true;
				if( $layer['props']['media'] === 'post' && ! empty( $layer['props']['html'] ) ) {

					$firstChar = substr( $layer['props']['html'], 0, 1 );
					$lastChar = substr( $layer['props']['html'], strlen( $layer['props']['html'] ) - 1, 1 );

					if( $firstChar === '<' && $lastChar === '>') {

						try {
							$layerHTML = LayerSlider\DOM::newDocumentHTML( $layer['props']['html'] );
							if( $layerHTML->length === 1 ) {
								$wrapLayer = false;
							}

						} catch( Exception $e ) {

						}
					}
				}

				// Skip image layer without src
				if( ( $layer['props']['type'] === 'img' || $layer['props']['media'] === 'img' ) && empty($layer['props']['image'])) { continue; }

				// Convert line breaks
				if( ! empty( $layer['props']['htmlLineBreak'] ) ) {

					if( $layer['props']['htmlLineBreak'] === 'enabled' ) {
						$layer['props']['html'] = nl2br( $layer['props']['html'] );
					}

					if( $layer['props']['htmlLineBreak'] === 'auto' ) {
						if( in_array( $layer['props']['media'], ['text', 'button', 'post'] ) ) {
							$layer['props']['html'] = nl2br( $layer['props']['html'] );
						}
					}
				}

				// Handle attached icon
				if( ! empty( $layer['props']['icon'] ) && in_array( $layer['props']['media'], ['text', 'button', 'post', 'html'] ) ) {

					// Premium content check
					if( $GLOBALS['lsIsActivatedSite'] || strpos( $layer['props']['icon'], '<svg' ) === false ) {

						$iconHTML = $layer['props']['icon'];
						$icon;

						if( ! empty( $layer['props']['html'] ) ) {
							$svgIB = true;
						}

						try {
							$icon = LayerSlider\DOM::newDocumentHTML( $layer['props']['icon'] );
						} catch( Exception $e ) {}

						$layer['props']['iconPlacement'] = ! empty( $layer['props']['iconPlacement'] ) ? $layer['props']['iconPlacement'] : '';

						// Icon Color & Icon Gap
						if( $icon ) {

							$iconCSS = [];

							if( ! empty( $layer['props']['iconColor'] ) ) {
								$iconCSS[ 'color' ] = $layer['props']['iconColor'];
							}

							if( ! empty( $layer['props']['iconGap'] ) ) {

								if( $layer['props']['iconPlacement'] === 'left' ) {
									$iconCSS[ 'margin-right' ] = $layer['props']['iconGap'].'em';
								} else {
									$iconCSS[ 'margin-left' ] = $layer['props']['iconGap'].'em';
								}
							}

							if( ! empty( $layer['props']['iconSize'] ) ) {
								$iconCSS[ 'font-size' ] = $layer['props']['iconSize'].'em';
							}

							if( ! empty( $layer['props']['iconVerticalAdjustment'] ) ) {
								$iconCSS[ 'transform' ] = 'translateY( '.$layer['props']['iconVerticalAdjustment'].'em )';
							}

							$icon->attr('style', ls_array_to_attr( $iconCSS ) );
							$iconHTML = $icon;
						}

						// Content & Icon Placement
						$layer['props']['html'] = ( $layer['props']['iconPlacement'] === 'left' ) ? $iconHTML.$layer['props']['html'] : $layer['props']['html'].$iconHTML;
					}
				}

				// Image layer
				$layerIMG = false;
				if( $layer['props']['type'] === 'img' || $layer['props']['media'] === 'img' ) {

					if( ! empty( $layer['props']['image'] ) && ls_assets_cond( $layer['props'], 'image') ) {

						if( ! empty($layer['props']['imageId'])) {

							if( has_filter('wpml_object_id') && get_option('ls_wpml_media_translation', true ) ) {
								$layer['props']['imageId'] = apply_filters('wpml_object_id', $layer['props']['imageId'], 'attachment', true );
							}

							$layerIMG = ls_get_markup_image( (int)$layer['props']['imageId'], ['class' => 'ls-l'] );

						} elseif($layer['props']['image'] == '[image-url]') {

							if(is_object($postContent->post)) {
								$attchID = get_post_thumbnail_id($postContent->post->ID);
								$layerIMG = ls_get_markup_image( $attchID, ['class' => 'ls-l'] );
							} else {
								$layerIMG = '<img src="'.$postContent->getWithFormat($layer['props']['image']).'">';
							}

						} else {

							$layerIMG = '<img src="'.$layer['props']['image'].'">';

							if(!empty($layer['props']['alt'])) {
							$innerAttributes['alt'] = $layer['props']['alt']; }
								else { 	$innerAttributes['alt'] = ''; }
						}
					}
				}


				if( ! empty( $layerIMG ) && ! $useSrcset ) {
					$layerIMG = preg_replace('/srcset="[^\"]*"/', '', $layerIMG);
					$layerIMG = preg_replace('/sizes="[^\"]*"/', '', $layerIMG);
				}

				if( ! empty( $layerIMG ) && $enhancedLazyLoad ) {
					$layerIMG = str_replace(' src="', ' data-src="', $layerIMG);
					$layerIMG = str_replace(' srcset="', ' data-srcset="', $layerIMG);
				}

				// Layer element type & wrapping
				if( ! empty( $layerIMG ) ) {
					$type = $layerIMG;

				} elseif( ! $wrapLayer ) {
					$type = $layer['props']['html'];

				} else {
					$type = '<'.$layer['props']['htmlTag'].'>';
				}

				// Linked layer
				if( ! empty( $layer['props']['url'] ) ) {

					// Create <a> element
					$el = LayerSlider\DOM::newDocumentHTML('<a>')->children();

					// Auto-generated URL
					if( ! empty( $layer['props']['linkId'] ) ) {

						// Smart Links
						if( '#' === substr( $layer['props']['linkId'], 0, 1 ) ) {
							$layer['props']['url'] = $layer['props']['linkId'];

						// Dynamic Layer
						} elseif( '[post-url]' === $layer['props']['linkId'] ) {
							$layer['props']['url'] = $postContent->getWithFormat('[post-url]');

						// Attachment
						} elseif( ! empty( $layer['props']['linkType'] ) && $layer['props']['linkType'] === 'attachment' ) {
							$layer['props']['url'] = wp_get_attachment_url( $layer['props']['linkId'] );

						// Page / Post
						} else {
							$layer['props']['url'] = get_permalink( $layer['props']['linkId'] );
						}
					}


					if( $layer['props']['url'] === '[post-url]' ) {
						$layer['props']['url'] = $postContent->getWithFormat('[post-url]');
					}

					$layerAttributes['href'] = ! empty( $layer['props']['url'] ) ? do_shortcode( $layer['props']['url'] ) : '#';

					if(!empty($layer['props']['target'])) {
						$layerAttributes['target'] =  $layer['props']['target'];
					}

					$inner = $el->append($type)->children();

				} else {

					if( ! $wrapLayer ) {
						$el = $inner = LayerSlider\DOM::newDocumentHTML($type);
					} else {
						$el = $inner = LayerSlider\DOM::newDocumentHTML($type)->children();
					}

				}

				// HTML attributes
				$layerAttributes['class'] = 'ls-l';

				if(!empty($layer['props']['id'])) { $innerAttributes['id'] = $layer['props']['id']; }
				if(!empty($layer['props']['class'])) { $innerAttributes['class'] .= ' '.$layer['props']['class']; }

				if(!empty($layer['props']['url'])) {

					if(!empty($layer['props']['rel'])) {
						$layerAttributes['rel'] = $layer['props']['rel'];
					}

					if(!empty($layer['props']['title'])) {
						$layerAttributes['title'] = $layer['props']['title'];
					}

					if( isset( $layer['props']['tabindex']) && $layer['props']['tabindex'] !== '' ) {
						$layerAttributes['tabindex'] = $layer['props']['tabindex'];
					}

				} else {
					if(!empty($layer['props']['title'])) {
						$innerAttributes['title'] = $layer['props']['title'];
					}

					if( isset( $layer['props']['tabindex']) && $layer['props']['tabindex'] !== '' ) {
						$innerAttributes['tabindex'] = $layer['props']['tabindex'];
					}
				}


				if( ! empty( $layer['props']['posterId'] ) ) {

					if( has_filter('wpml_object_id') && get_option('ls_wpml_media_translation', true ) ) {
						$layer['props']['posterId'] = apply_filters('wpml_object_id', $layer['props']['posterId'], 'attachment', true );
					}

					$poster = wp_get_attachment_image_src( $layer['props']['posterId'], 'full', false );
					$poster = ! empty( $poster[0] ) ? $poster[0]: '';

					$layer['attrs']['poster'] = $poster;

					if( ! ls_assets_cond( $layer['attrs'], 'poster') ) {
						unset( $layer['attrs']['poster'] );
					}
				}


				if(isset($layer['attrs']) && isset($layer['props']['transition'])) { $layerAttributes['data-ls'] = ls_array_to_attr($layer['attrs']); }
					elseif(isset($layer['attrs'])) { $layerAttributes['style'] .= ls_array_to_attr($layer['attrs']); }

				if(!empty($layer['props']['style'])) {
					if(substr($layer['props']['style'], -1) != ';') { $layer['props']['style'] .= ';'; }
					$innerAttributes['style'] .= preg_replace('/\s\s+/', ' ', $layer['props']['style']);
				}

				if( ! empty( $layer['props']['layerBackground'] ) && ls_assets_cond( $layer['props'], 'layerBackground') ) {

					if( ! empty( $layer['props']['layerBackgroundId'] ) ) {

						if( has_filter('wpml_object_id') && get_option('ls_wpml_media_translation', true ) ) {
							$layer['props']['layerBackgroundId'] = apply_filters('wpml_object_id', $layer['props']['layerBackgroundId'], 'attachment', true );
						}

						$layerBG = wp_get_attachment_image_src( $layer['props']['layerBackgroundId'], 'full', false );
						$layerBG = ! empty( $layerBG[0] ) ? $layerBG[0]: '';

					} elseif( $layer['props']['layerBackground'] === '[image-url]' ) {
						$layerBG = $postContent->getWithFormat( $layer['props']['layerBackground'] );

					} else {
						$layerBG = do_shortcode( $layer['props']['layerBackground'] );
					}

					$layer['props']['styles']['background-image'] = 'url("'.$layerBG.'")';
				}

				if( ! empty( $layer['props']['styles']['background-color'] ) && strstr( $layer['props']['styles']['background-color'], 'gradient' ) ) {

					if( empty( $layer['props']['styles']['background-image'] ) ) {
						$layer['props']['styles']['background-image'] = $layer['props']['styles']['background-color'];
					} else {
						$layer['props']['styles']['background-image'] .= ', ' . $layer['props']['styles']['background-color'];
					}

					unset( $layer['props']['styles']['background-color'] );
				}

				// v7.2.5: Add prefixed version of backdrop filter for Safari
				if( ! empty( $layer['props']['styles']['backdrop-filter'] ) ) {
					$layer['props']['styles']['-webkit-backdrop-filter'] = $layer['props']['styles']['backdrop-filter'];
				}

				// v7.5.0: Browser support for background-clip
				if( ! empty( $layer['props']['styles']['background-clip'] ) ) {

					if( ! $GLOBALS['lsIsActivatedSite'] ) {
						unset( $layer['props']['styles']['background-clip'] );

					} else {

						$layer['props']['styles']['-webkit-background-clip'] = $layer['props']['styles']['background-clip'];

						if( $layer['props']['styles']['background-clip'] === 'text' ) {
							$layer['props']['styles']['text-fill-color'] = 'transparent';
							$layer['props']['styles']['-webkit-text-fill-color'] = 'transparent';
						}
					}
				}

				// v7.9.9: Added clip-path support
				if( ! empty( $layer['props']['styles']['clip-path'] ) ) {
					$layer['props']['styles']['clip-path'] = 'polygon('.$layer['props']['styles']['clip-path'].')';
				}


				$innerAttributes['style'] .= ls_array_to_attr($layer['props']['styles'], 'css');

				// Text / HTML layer
				if( $wrapLayer ) {
					$inner->html(do_shortcode(__(stripslashes($layer['props']['html']))));
				}

				// Rewrite Youtube/Vimeo iframe src to data-src
				$video = $inner->find('iframe[src*="youtube-nocookie.com"], iframe[src*="youtube.com"], iframe[src*="youtu.be"], iframe[src*="player.vimeo"]');
				if( $video->length ) {
					$video->attr('data-src', $video->attr('src') );
					$video->removeAttr('src');
				}

				// Device dependent responsive classes
				if( ! empty($layer['props']['hide_on_desktop']) ) {
					$layerAttributes['class'] .=  ' ls-hide-desktop';
				}

				if( ! empty($layer['props']['hide_on_tablet']) ) {
					$layerAttributes['class'] .= ' ls-hide-tablet';
				}

				if( ! empty($layer['props']['hide_on_phone']) ) {
					$layerAttributes['class'] .= ' ls-hide-phone';
				}

				$el->attr( $layerAttributes );
				$inner->attr( $innerAttributes );

				if( ! empty( $layer['props']['outerAttributes'] ) ) {
					foreach( $layer['props']['outerAttributes'] as $key => $val ) {
						if( $key === 'class' ) {
							$el->addClass( $val );
						} else {
							$el->attr( $key, $val );
						}
					}
				}

				if( ! empty( $layer['props']['innerAttributes'] ) ) {
					foreach( $layer['props']['innerAttributes'] as $key => $val ) {
						if( $key === 'class' ) {
							$inner->addClass( $val );
						} else {
							$inner->attr( $key, $val );
						}
					}
				}

				if( ! empty( $layer['props']['actions'] ) ) {

					$actionsString = json_encode( $layer['props']['actions']);

					$el->attr('data-ls-actions', $actionsString );

					if( strpos( $actionsString, 'openPopup' ) !== false ) {
						$GLOBALS['lsInitAjaxURL'] = true;
						$GLOBALS['lsLoadPlugins'][] = 'popup';
					}
				}

				if( $svgIB ) {
					$inner->addClass('ls-ib-icon');
				}

				if( ! empty( $layer['props']['media'] ) ) {
					$inner->addClass('ls-'.$layer['props']['media'].'-layer');
				}

				if( ! empty( $layer['props']['userSelect'] ) ) {
					if( $layer['props']['userSelect'] === 'none' ) {
						$inner->addClass('ls-unselectable');
					} else {
						$inner->addClass('ls-selectable');
					}
				}

				$lsMarkup[] = $el;
				LayerSlider\DOM::unloadDocuments();
			}
		}

		// Link this slide
		if( ! empty( $slide['props']['linkUrl'] ) ) {

			if( ! empty( $slide['props']['linkTarget'] ) ) {
				$target = ' target="'.$slide['props']['linkTarget'].'"';
			} else {
				$target = '';
			}

			if( ! empty( $slide['props']['linkId'] ) ) {

				// Smart Links
				if( '#' === substr( $slide['props']['linkId'], 0, 1 ) ) {
					$slide['props']['linkUrl'] = $slide['props']['linkId'];

				// Dynamic Layer
				} elseif( '[post-url]' === $slide['props']['linkId'] ) {
					$slide['props']['linkUrl'] = $postContent->getWithFormat('[post-url]');

				// Attachment
				} elseif( ! empty( $slide['props']['linkType'] ) && $slide['props']['linkType'] === 'attachment' ) {
					$slide['props']['linkUrl'] = wp_get_attachment_url( $slide['props']['linkId'] );

				// Page / Post
				} else {
					$slide['props']['linkUrl'] = get_permalink( $slide['props']['linkId'] );
				}
			}


			if( $slide['props']['linkUrl'] === '[post-url]' ) {
				$slide['props']['linkUrl'] = $postContent->getWithFormat('[post-url]');
			}

			// Apply shortcodes
			$slide['props']['linkUrl'] = do_shortcode( $slide['props']['linkUrl'] );

			// Fallback WPML support for older sliders
			if( has_filter( 'wpml_translate_single_string' ) && get_option('ls_wpml_string_translation', true ) ) {

				// Don't try to modify the URL if it's auto-generated
				if( empty( $slide['props']['linkId'] ) && $slide['props']['linkUrl'] !== '[post-url]' ) {

					// Carry over the 'lang' URI param if it's set and the URL is non-relative, non-external
					if( ! empty( $_GET['lang'] ) && ( strpos($slide['props']['linkUrl'], 'http') !== 0 || strpos( $slide['props']['linkUrl'], $_SERVER['SERVER_NAME'] ) !== false ) ) {
						if(strpos($slide['props']['linkUrl'], '?') !== false) { $slide['props']['linkUrl'] .= '&amp;lang=' . ICL_LANGUAGE_CODE; }
							else { $slide['props']['linkUrl'] .= '?lang=' . ICL_LANGUAGE_CODE; }
					}
				}
			}


			$linkClass = 'ls-link';
			if( empty( $slide['props']['linkPosition'] ) || $slide['props']['linkPosition'] === 'over' ) {
				$linkClass .= ' ls-link-on-top';
			}

			$slide['props']['linkUrl'] = ! empty( $slide['props']['linkUrl'] ) ? $slide['props']['linkUrl'] : '#';

			$lsMarkup[] = '<a href="'.$slide['props']['linkUrl'].'"'.$target.' class="'.$linkClass.'"></a>';
		}

		// End of slide
		$lsMarkup[] = '</div>';
	}
}

// End of slider container
$lsMarkup[] = '</div>';

// End of scene wrapper
if( $needsSceneWrapper ) {
	$lsMarkup[] = '</ls-scene-wrapper>';
}

// End of Popup wrapper
if( !empty($slides['properties']['attrs']['type']) && $slides['properties']['attrs']['type'] === 'popup' ) {
	$lsMarkup[] = '</div>';
}

// After slider content hook
if(has_action('layerslider_after_slider_content')) {
	do_action('layerslider_after_slider_content');
}