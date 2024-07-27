<?php


class LS_TemplateUtils {


	public static function processTemplatesData( $data = [], $extraParams = [] ) {

		if( ! empty( $data['collections'] ) ) {
			$data['collections']['items'] = ! empty( $data['collections']['items'] ) ? $data['collections']['items'] : [];
			$data['collections']['items'] = LS_TemplateUtils::processCollections( $data['collections']['items'] );
		}

		if( ! empty( $data['workshop'] ) ) {
			$data['categories'] = array_merge( $data['categories'], $data['workshop'] );
		}

		// Normalize categories
		$data['featured_interval'] = ! empty( $data['featured_interval'] ) ? $data['featured_interval'] : '';
		$data['featured'] = ! empty( $data['featured'] ) ? $data['featured'] : [];
		$data['featured'] = LS_TemplateUtils::processFeaturedCategory( $data['featured'] );

		$data['new'] = [
			'items' => [],
			'handles' => []
		];

		$data['categories'] = ! empty( $data['categories'] ) ? $data['categories'] : [];
		foreach( $data['categories'] as $categoryKey => &$category ) {

			$category['name'] 		= ! empty( $category['name'] ) ? $category['name'] : __('Templates', 'LayerSlider');
			$category['tags'] 		= ! empty( $category['tags'] ) ? $category['tags'] : [];
			$category['tags'] 		= LS_TemplateUtils::processTags( $category['tags'], $category );
			$category['supports'] 	= ! empty( $category['supports'] ) ? $category['supports'] : [];
			$category['icon'] 		= LS_TemplateUtils::findAndProccessIcon( $category );
			$category['items'] 		= ! empty( $category['items'] ) ? $category['items'] : [];

			// Brand new section
			if( ! empty( $category['supports']['brand-new'] ) ) {
				$newItems = array_slice( $category['items'], 0, 3 );

				foreach( $newItems as $itemKey => $itemVal ) {
					$itemVal['category'] 	= $categoryKey;
					$newItems[ $itemKey ] 	= $itemVal;
				}

				$data['new']['items'] = array_merge( $data['new']['items'], $newItems );
			}


			// Count new/unseen items in category
			$loopCounter = 0; $newTemplatesCounter = 0;
			foreach( $category['items'] as $itemKey => $itemVal ) {

				if( ++$loopCounter > 100 ) {
					break;
				}

				if( empty( $itemVal['released'] ) ) {
					continue;
				}

				if( $itemVal['released'] <= $extraParams['lastViewed'] ) {
					break;
				}

				$newTemplatesCounter++;
			}

			$category['new_items_counter'] = ( $newTemplatesCounter > 99 ) ? '99+' : $newTemplatesCounter;

			unset( $category );
		}

		$data['new']['items'] = LS_TemplateUtils::sortTemplatesByReleaseDate( $data['new']['items'] );
		$data['new']['items'] = array_slice( $data['new']['items'], 0, 3, true );
		$data['new']['handles'] = array_keys( $data['new']['items'] );

		return $data;
	}



	public static function processFeaturedCategory( $featured ) {

		foreach( $featured as &$item ) {

			$item['title'] 				= ! empty( $item['title'] ) 			? $item['title'] 			: '';
			$item['text'] 				= ! empty( $item['text'] ) 				? $item['text'] 			: '';
			$item['poster'] 			= ! empty( $item['poster'] ) 			? $item['poster'] 			: '';

			$item['sidebar'] 			= ! empty( $item['sidebar'] ) 			? $item['sidebar'] 			: [];
			$item['sidebar']['class'] 	= ! empty( $item['sidebar']['class'] ) 	? $item['sidebar']['class'] : '';
			$item['sidebar']['style'] 	= ! empty( $item['sidebar']['style'] ) 	? $item['sidebar']['style'] : '';

			$item['buttons'] 			= ! empty( $item['buttons'] ) 			? $item['buttons'] 			: [];
			$item['video'] 				= ! empty( $item['video'] ) 			? $item['video'] 			: [];

			foreach( $item['buttons'] as &$button ) {

				$button['text'] = ! empty( $button['text'] ) ? $button['text'] : '';
				$button['icon'] = self::findAndProccessIcon( $button );
				$button['attributes'] = ! empty( $button['attributes'] ) ? $button['attributes'] : [];

				unset( $button );
			}

			if( ! empty( $item['video']['sources'] ) ) {
				foreach( $item['video']['sources'] as &$sources ) {
					$sources['src'] = ! empty( $sources['src'] ) ? $sources['src'] : '';
					$sources['src'] = ! empty( $sources['src'] ) ? $sources['src'] : 'video/mp4';

					unset( $sources );
				}
			}

			// If template item
			if( ! empty( $item['template'] ) ) {

				// Use template name as title if not provided
				if( empty( $item['title'] ) && ! empty( $item['template']['name'] ) ) {
					$item['title'] = $item['template']['name'];
				}

				// Use template preview image as poster if not provided
				if( empty( $item['video'] ) && empty( $item['poster'] ) && ! empty( $item['template']['preview'] ) ) {
					$item['poster'] = $item['template']['preview'];
				}

				// Import button if 'handle' provided
				if( ! empty( $item['template']['handle'] ) ) {

					$item['template']['name'] 		= ! empty( $item['template']['name'] ) 		? $item['template']['name'] 	: '';
					$item['template']['category'] 	= ! empty( $item['template']['category'] ) 	? $item['template']['category']	: '';
					$item['template']['requires'] 	= ! empty( $item['template']['requires'] ) 	? $item['template']['requires'] : '1.0.0';

					array_unshift( $item['buttons'], [
						'text' => __('Import', 'LayerSlider'),
						'icon' => '',
						'attributes' => [
							'href' => '#',
							'class' 	=> 'ls--import-template-button',
							'data-name' => $item['template']['name'],
							'data-handle' => $item['template']['handle'],
							'data-category' => $item['template']['category'],
							'data-bundled' => false,
							'data-premium' => ! empty( $item['template']['premium'] ),
							'data-version-warning' => version_compare( $item['template']['requires'], LS_PLUGIN_VERSION, '>')
						]
					]);
				}

				// Preview button if 'url' provided
				if( ! empty( $item['template']['url'] ) ) {
					array_unshift( $item['buttons'], [
						'text' => __('Preview', 'LayerSlider'),
						'icon' => '',
						'attributes' => [
							'href' => $item['template']['url'],
							'target' => '_blank'
						]
					]);
				}
			}

			unset( $item );
		}

		return $featured;
	}


	public static function processCollections( $collections ) {

		foreach( $collections as &$collection ) {
			$collection['name'] = ! empty( $collection['name'] ) ? $collection['name'] : '';
			$collection['icon'] = self::findAndProccessIcon( $collection );


			unset( $collection );
		}

		return $collections;
	}



	public static function sortTemplatesByReleaseDate( $items ) {

		uasort( $items, function( $a, $b ) {
			$t1 = strtotime( ! empty( $a['released'] ) ? $a['released'] : '1970-01-01' );
			$t2 = strtotime( ! empty( $b['released'] ) ? $b['released'] : '1970-01-01' );

			return ( $t2 - $t1 );
		});

		return $items;
	}

	public static function processTags( $tags, $categoryKey = '' ) {

		$counter = 0;

		foreach( $tags as $tagKey => $tag ) {

			if( self::shouldExcludeTag( $tagKey ) ) {
				unset( $tags[ $tagKey ] );
				continue;
			}

			$tags[ $tagKey ]['active'] 				= ( 0 === $counter++ );
			$tags[ $tagKey ]['name'] 				= ! empty( $tag['name'] ) ? $tag['name'] : '';
			$tags[ $tagKey ]['icon'] 				= self::findAndProccessIcon( $tag );

			if( empty( $tag['description'] ) ) {
				$tags[ $tagKey ]['description'] = [];

			} elseif( ! empty( $tag['description'] ) && is_string( $tag['description'] ) ) {
				$tags[ $tagKey ]['description'] = [
					'text' => $tag['description']
				];
			}

			$tags[ $tagKey ]['description']['icon'] = self::findAndProccessIcon( $tags[ $tagKey ]['description'] );
		}

		return $tags;
	}



	public static function shouldExcludeTag( $tagKey ) {

		if( $tagKey === 'bundled' && ! LS_Sources::hasDemoSliders() ) {
			return true;
		}

		if( $tagKey === 'free' && LS_Config::isActivatedSite() ) {
			return true;
		}


		return false;
	}


	public static function findAndProccessIcon( $array = [] ) {

		// Has name
		if( ! empty( $array['icon']['name'] ) ) {
			$type 		= ! empty( $array['icon']['type'] ) ? $array['icon']['type'] : 'solid';
			$attributes = ! empty( $array['icon']['attributes'] ) ? $array['icon']['attributes'] : [];
			return lsGetSVGIcon( $array['icon']['name'], $type, $attributes );

		// HTML/SVG source
		} elseif( ! empty( $array['icon']['html'] ) ) {
			return $array['icon']['html'];
		}

		return '';
	}
}