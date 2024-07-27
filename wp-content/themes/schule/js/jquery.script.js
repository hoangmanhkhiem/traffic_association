/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.2.0
 * 
 * Theme Custom Scripts
 * Created by CMSMasters
 * 
 */


jQuery(document).ready(function() { 
	"use strict";
	
	/* Run Blog */
	(function ($) { 
		var blogs = $('.cmsmasters_wrap_blog');
		
		
		blogs.each(function () { 
			var blog = $(this), 
				params = {};
			
			
			params.id = '#' + blog.attr('id');
			
			if (blog.data('layout') !== undefined) {
				params.layout = blog.data('layout');
			}
			
			if (blog.data('layoutMode') !== undefined) {
				params.layoutMode = blog.data('layoutMode');
			}
			
			if (blog.data('url') !== undefined) {
				params.url = blog.data('url');
			}
			
			if (blog.data('orderby') !== undefined) {
				params.orderby = blog.data('orderby');
			}
			
			if (blog.data('order') !== undefined) {
				params.order = blog.data('order');
			}
			
			if (blog.data('count') !== undefined) {
				params.count = Number(blog.data('count'));
			}
			
			if (blog.data('categories') !== undefined) {
				params.categories = blog.data('categories');
			}
			
			if (blog.data('metadata') !== undefined) {
				params.metadata = blog.data('metadata');
			}
			
			if (blog.data('pagination') !== undefined) {
				params.pagination = blog.data('pagination');
			}
			
			
			if (
				params.layout !== 'standard' || 
				(params.layout === 'standard' && params.pagination === 'more')
			) {
				startBlog(params.id, params.layout, params.layoutMode, params.url, params.orderby, params.order, params.count, params.categories, params.metadata);
			}
		} );
	} )(jQuery);
	
	
	
	/* Run Portfolio */
	(function ($) { 
		var portfolios = $('.cmsmasters_wrap_portfolio');
		
		
		portfolios.each(function () { 
			var portfolio = $(this), 
				params = {};
			
			
			params.id = '#' + portfolio.attr('id');
			
			if (portfolio.data('layout') !== undefined) {
				params.layout = portfolio.data('layout');
			}
			
			if (portfolio.data('layoutMode') !== undefined) {
				params.layoutMode = portfolio.data('layoutMode');
			}
			
			if (portfolio.data('url') !== undefined) {
				params.url = portfolio.data('url');
			}
			
			if (portfolio.data('orderby') !== undefined) {
				params.orderby = portfolio.data('orderby');
			}
			
			if (portfolio.data('order') !== undefined) {
				params.order = portfolio.data('order');
			}
			
			if (portfolio.data('count') !== undefined) {
				params.count = Number(portfolio.data('count'));
			}
			
			if (portfolio.data('categories') !== undefined) {
				params.categories = portfolio.data('categories');
			}
			
			if (portfolio.data('metadata') !== undefined) {
				params.metadata = portfolio.data('metadata');
			}
			
			
			startPortfolio(params.id, params.layout, params.layoutMode, params.url, params.orderby, params.order, params.count, params.categories, params.metadata);
		} );
	} )(jQuery);
	
	
	
	/* Run Gallery */
	(function ($) { 
		var galleries = $('.cmsmasters_gallery_wrap');
		
		
		galleries.each(function () { 
			var gallery = $(this), 
				params = {};
			
			
			params.id = '#' + gallery.attr('id');
			
			if (gallery.data('type') !== undefined) {
				params.type = gallery.data('type');
			}
			
			if (gallery.data('count') !== undefined) {
				params.count = Number(gallery.data('count'));
			}
			
			
			startGallery(params.id, params.type, params.count);
		} );
	} )(jQuery);
	
	
	
	/* Run Google Map */
	(function ($) { 
		var gmaps = $('.cmsmasters_google_map');
		
		
		gmaps.each(function () { 
			var gmap = $(this), 
				params = {}, 
				controls = {};
			
			
			params.id = '#' + gmap.attr('id');
			
			if (gmap.data('address') !== undefined) {
				params.address = gmap.data('address');
			}
			
			if (gmap.data('latitude') !== undefined) {
				params.latitude = gmap.data('latitude');
			}
			
			if (gmap.data('longitude') !== undefined) {
				params.longitude = gmap.data('longitude');
			}
			
			if (gmap.data('maptype') !== undefined) {
				params.maptype = gmap.data('maptype');
			}
			
			if (gmap.data('zoom') !== undefined) {
				params.zoom = gmap.data('zoom');
			}
			
			if (gmap.data('scrollwheel') !== undefined) {
				params.scrollwheel = Boolean(gmap.data('scrollwheel'));
			}
			
			if (gmap.data('doubleclickzoom') !== undefined) {
				params.doubleclickzoom = Boolean(gmap.data('doubleclickzoom'));
			}
			
			if (gmap.data('markers') !== undefined) {
				var markers_str = gmap.data('markers'), 
					markers_arr = markers_str.split('|||'), 
					markers = [];
				
				for (var i = 0; i < markers_arr.length; i++) {
					if (markers_arr[i] !== '') {
						var marker_str = markers_arr[i], 
							marker_arr = marker_str.split('///'), 
							marker_obj = {};
						
						for (var j = 0; j < marker_arr.length; j++) {
							if (marker_arr[j] !== '') {
								var marker_attr = marker_arr[j].split(': ');
								
								marker_obj[marker_attr[0]] = marker_attr[1];
							}
						}
						
						markers.push(marker_obj);
					}
				}
				
				
				params.markers = markers;
			}
			
			
			if (gmap.data('panControl') !== undefined) {
				controls.panControl = Boolean(gmap.data('panControl'));
			}
			
			if (gmap.data('zoomControl') !== undefined) {
				controls.zoomControl = Boolean(gmap.data('zoomControl'));
			}
			
			if (gmap.data('mapTypeControl') !== undefined) {
				controls.mapTypeControl = Boolean(gmap.data('mapTypeControl'));
			}
			
			if (gmap.data('scaleControl') !== undefined) {
				controls.scaleControl = Boolean(gmap.data('scaleControl'));
			}
			
			if (gmap.data('streetViewControl') !== undefined) {
				controls.streetViewControl = Boolean(gmap.data('streetViewControl'));
			}
			
			if (gmap.data('overviewMapControl') !== undefined) {
				controls.overviewMapControl = Boolean(gmap.data('overviewMapControl'));
			}
			
			params.controls = controls;
			
			
			if (cmsmasters_script.gmap_api_key === '') {
				$(params.id).append('<div class="cmsmasters_notice cmsmasters_notice_error cmsmasters_theme_icon_cancel">' + 
					'<div class="notice_content">' + 
						'<p>' + cmsmasters_script.gmap_api_key_notice + ', ' + '<a target="_blank" href="http://cmsmasters.net/google-maps-api-key/">' + cmsmasters_script.gmap_api_key_notice_link + '</a></p>' + 
					'</div>' + 
				'</div>');
			} else {
				$(params.id).gMap(params);
			}
		} );
	} )(jQuery);
	
	
	
	/* Run Hover Slider */
	(function ($) { 
		var hover_sliders = $('.cmsmasters_hover_slider');
		
		
		hover_sliders.each(function () { 
			var slider = $(this), 
				params = {};
			
			
			params.sliderBlock = '#' + slider.attr('id');
			
			if (slider.data('thumbWidth') !== undefined) {
				params.thumbWidth = Number(slider.data('thumbWidth'));
			}
			
			if (slider.data('thumbHeight') !== undefined) {
				params.thumbHeight = Number(slider.data('thumbHeight'));
			}
			
			if (slider.data('activeSlide') !== undefined) {
				params.activeSlide = Number(slider.data('activeSlide'));
			}
			
			if (slider.data('pauseTime') !== undefined) {
				params.pauseTime = Number(slider.data('pauseTime'));
			}
			
			if (slider.data('pauseOnHover') !== undefined) {
				params.pauseOnHover = Boolean(slider.data('pauseOnHover'));
			}
			
			
			$(params.sliderBlock).cmsmastersHoverSlider(params);
		} );
	} )(jQuery);
	
	
	
	/* Run Owl Sliders */
	cmsmasters_owl_sliders_run();
	
	jQuery(window).on('debouncedresize', function () { 
		cmsmasters_owl_sliders_run();
	} );
	
	
	
	/* Touch events on ipad, iphone etc */
	jQuery('body').bind('touchstart', function() {});
	
	
	
	/* Add Class To Row */
	(function ($) { 
		$('.cmsmasters_row_margin').each(function () { 
			var cmsmasters_column = $(this).find('.cmsmasters_column').eq(0);
			
			
			if ( 
				cmsmasters_column.hasClass('one_half') && 
				cmsmasters_column.next().hasClass('one_half') 
			) {
				$(this).addClass('cmsmasters_1212');
			} else if ( 
				cmsmasters_column.hasClass('one_third') && 
				cmsmasters_column.next().hasClass('two_third') 
			) {
				$(this).addClass('cmsmasters_1323');
			} else if ( 
				cmsmasters_column.hasClass('two_third') && 
				cmsmasters_column.next().hasClass('one_third') 
			) {
				$(this).addClass('cmsmasters_2313');
			} else if ( 
				cmsmasters_column.hasClass('one_fourth') && 
				cmsmasters_column.next().hasClass('three_fourth') 
			) {
				$(this).addClass('cmsmasters_1434');
			} else if ( 
				cmsmasters_column.hasClass('three_fourth') && 
				cmsmasters_column.next().hasClass('one_fourth') 
			) {
				$(this).addClass('cmsmasters_3414');
			} else if ( 
				cmsmasters_column.hasClass('one_third') && 
				cmsmasters_column.next().hasClass('one_third') && 
				cmsmasters_column.next().next().hasClass('one_third') 
			) {
				$(this).addClass('cmsmasters_131313');
			} else if (
				cmsmasters_column.hasClass('one_half') && 
				cmsmasters_column.next().hasClass('one_fourth') && 
				cmsmasters_column.next().next().hasClass('one_fourth')
			) {
				$(this).addClass('cmsmasters_121414');
			} else if ( 
				cmsmasters_column.hasClass('one_fourth') && 
				cmsmasters_column.next().hasClass('one_half') && 
				cmsmasters_column.next().next().hasClass('one_fourth')
			) {
				$(this).addClass('cmsmasters_141214');
			} else if ( 
				cmsmasters_column.hasClass('one_fourth') && 
				cmsmasters_column.next().hasClass('one_fourth') && 
				cmsmasters_column.next().next().hasClass('one_half') 
			) {
				$(this).addClass('cmsmasters_141412');
			} else if ( 
				cmsmasters_column.hasClass('one_fourth') && 
				cmsmasters_column.next().hasClass('one_fourth') && 
				cmsmasters_column.next().next().hasClass('one_fourth') && 
				cmsmasters_column.next().next().next().hasClass('one_fourth') 
			) {
				$(this).addClass('cmsmasters_14141414');
			} else {
				$(this).addClass('cmsmasters_11');
			}
		} );
	} )(jQuery);



	/* Scroll Top */
	(function ($) { 
		$(window).scroll(function () { 
			if ($(this).scrollTop() > 200) {
				$('#slide_top').filter(':hidden').fadeIn('fast');
			} else {
				$('#slide_top').filter(':visible').fadeOut('fast');
			}
		} );
		
		
		$('.divider a, #slide_top').on('click', function () { 
			$('html, body').animate( { 
				scrollTop : 0 
			}, 'slow');
			
			
			return false;
		} );
	} )(jQuery);



	/* Lightbox Classes Adding */
	(function ($) { 
		$('.widget_custom_flickr_entries').each(function () { 
			var flickrUniqID = uniqID();
			
			
			$(this).find('.flickr_badge_image a').each(function () { 
				var src = $(this).find('img').attr('src'), 
					title = $(this).find('img').attr('title'), 
					src_full = src.replace(/_s.jpg/g, '.jpg');
				
				
				$(this).removeAttr('href').attr( { 
					href : 		src_full, 
					title : 	title, 
					rel : 		'ilightbox[flickr_' + flickrUniqID + ']' 
				} );
			} );
		} ); // Flickr Widget Lightbox
		
		
		$('.gallery').each(function () { 
			var galUniqID = uniqID();
			
			
			$(this).find('a').each(function () { 
				var linkHref = $(this).attr('href'), 
					lastDotPos = linkHref.lastIndexOf('.'), 
					imgFormat = linkHref.slice(lastDotPos + 1);
				
				
				if (imgFormat.length <= 5) {
					$(this).attr('rel', 'ilightbox[wp_gal_' + galUniqID + ']');
				}
			} );
		} ); // WordPress Default Gallery Shortcode Lightbox
	} )(jQuery);
	
	
	
	/* iLightBox Init */
	(function ($) { 
		var ilightbox_settings = { 
			skin : 					cmsmasters_script.ilightbox_skin, 
			path : 					cmsmasters_script.ilightbox_path, 
			infinite : 				(cmsmasters_script.ilightbox_infinite == '1') ? true : false, 
			keepAspectRatio : 		(cmsmasters_script.ilightbox_aspect_ratio == '1') ? true : false, 
			mobileOptimizer : 		(cmsmasters_script.ilightbox_mobile_optimizer == '1') ? true : false, 
			maxScale : 				Number(cmsmasters_script.ilightbox_max_scale), 
			minScale : 				Number(cmsmasters_script.ilightbox_min_scale), 
			innerToolbar : 			(cmsmasters_script.ilightbox_inner_toolbar == '1') ? true : false, 
			smartRecognition : 		(cmsmasters_script.ilightbox_mobile_optimizer == '1') ? true : false, 
			fullAlone : 			(cmsmasters_script.ilightbox_fullscreen_one_slide == '1') ? true : false, 
			fullViewPort : 			cmsmasters_script.ilightbox_fullscreen_viewport, 
			controls : { 
				toolbar : 			(cmsmasters_script.ilightbox_controls_toolbar == '1') ? true : false, 
				arrows : 			(cmsmasters_script.ilightbox_controls_arrows == '1') ? true : false, 
				fullscreen : 		(cmsmasters_script.ilightbox_controls_fullscreen == '1') ? true : false, 
				thumbnail : 		(cmsmasters_script.ilightbox_controls_thumbnail == '1') ? true : false, 
				keyboard : 			(cmsmasters_script.ilightbox_controls_keyboard == '1') ? true : false, 
				mousewheel : 		(cmsmasters_script.ilightbox_controls_mousewheel == '1') ? true : false, 
				swipe : 			(cmsmasters_script.ilightbox_controls_swipe == '1') ? true : false, 
				slideshow : 		(cmsmasters_script.ilightbox_controls_slideshow == '1') ? true : false 
			}, 
			text : { 
				close : 			cmsmasters_script.ilightbox_close_text, 
				enterFullscreen : 	cmsmasters_script.ilightbox_enter_fullscreen_text, 
				exitFullscreen : 	cmsmasters_script.ilightbox_exit_fullscreen_text, 
				slideShow : 		cmsmasters_script.ilightbox_slideshow_text, 
				next : 				cmsmasters_script.ilightbox_next_text, 
				previous : 			cmsmasters_script.ilightbox_previous_text 
			}, 
			errors : { 
				loadImage : 		cmsmasters_script.ilightbox_load_image_error, 
				loadContents : 		cmsmasters_script.ilightbox_load_contents_error, 
				missingPlugin : 	cmsmasters_script.ilightbox_missing_plugin_error 
			} 
		}, 
		gallery_array = [], 
		gallery_id = '';
		
		
		$('[rel="ilightbox"]').each(function () { 
			if (!$(this).attr('href')) {
				return;
			}
			
			
			$(this).iLightBox(ilightbox_settings);
		} );
		
		
		$('[rel^="ilightbox["]').each(function () { 
			if ($(this).closest('.cmsmasters_more_items_loader').length === 0) {
				var item_rel = $(this).attr('rel');
				
				
				if ($.inArray(item_rel, gallery_array) === -1 && $(this).attr('href')) {
					gallery_array.push(item_rel);
				}
			}
		} );
		
		
		$.each(gallery_array, function (gallery_array, gallery_id) { 
			$('[rel="' + gallery_id + '"]').iLightBox(ilightbox_settings);
		} );
	} )(jQuery);
	
	
	
	/* Shortcodes Animation Run */
	(function ($) { 
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('[data-animation]').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 			$(this), 
						animation = 	el.data('animation'), 
						delay = 		(el.data('delay')) ? el.data('delay') : 0;
					
					
					setTimeout(function () { 
						el.addClass(animation + ' animated');
					}, delay);
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 			$(this), 
						animation = 	el.data('animation'), 
						delay = 		(el.data('delay')) ? el.data('delay') : 0;
					
					
					setTimeout(function () { 
						el.addClass(animation + ' animated');
					}, delay);
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('[data-animation]').addClass('animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsmasters_icon_box').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 	$(this);
					
					
					el.addClass('shortcode_animated');
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 	$(this);
					
					
					el.addClass('shortcode_animated');
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsmasters_icon_box').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsmasters_icon_list_items.cmsmasters_icon_list_type_block').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 		$(this), 
						items = 	el.find('li'), 
						delay = 	500, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 		$(this), 
						items = 	el.find('li'), 
						delay = 	500, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsmasters_icon_list_items .cmsmasters_icon_list_item').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsmasters_hover_slider').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 		$(this), 
						items = 	el.find('li'), 
						delay = 	300, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 		$(this), 
						items = 	el.find('li'), 
						delay = 	300, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsmasters_hover_slider ul li').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsmasters_profile.vertical').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 		$(this), 
						items = 	el.find('article'), 
						delay = 	500, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 		$(this), 
						items = 	el.find('article'), 
						delay = 	500, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsmasters_profile.vertical .profile').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsmasters_clients_grid').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 		$(this), 
						items = 	el.find('.cmsmasters_clients_item'), 
						delay = 	300, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 		$(this), 
						items = 	el.find('.cmsmasters_clients_item'), 
						delay = 	300, 
						i = 		1;
					
					
					items.each(function () { 
						var item = 	$(this);
						
						
						setTimeout(function () { 
							item.addClass('shortcode_animated');
						}, delay * i);
						
						
						i += 1;
					} );
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsmasters_clients_grid').find('.cmsmasters_clients_item').addClass('shortcode_animated');
		}
		
		
		if ( 
			!checker.os.iphone && 
			!checker.os.ipod && 
			!checker.os.ipad && 
			!checker.os.blackberry && 
			!checker.os.android 
		) {
			$('.cmsmasters_gallery, .blog.columns, .blog.timeline').waypoint(function (dir) { 
				if (dir === 'down') {
					var el = 			$(this), 
						items = 		el.find('article.post, .cmsmasters_gallery_item'), 
						itemsCount = 	items.length, 
						delay = 		300, 
						i = 			1;
					
					
					var newTime = setInterval(function () { 
						if (el.hasClass('isotope')) {
							clearInterval(newTime);
						} else {
							return false;
						}
						
						
						items.each(function () { 
							var item = 	$(this);
							
							
							setTimeout(function () { 
								item.addClass('shortcode_animated');
							}, delay * i);
							
							
							i += 1;
							
							
							if (i === itemsCount) {
								setTimeout(function () { 
									$(window).trigger('resize');
								}, delay * i);
							}
						} );
					}, 300);
				}
			}, { 
				offset : 		'100%' 
			} ).waypoint(function (dir) { 
				if (dir === 'up') {
					var el = 			$(this), 
						items = 		el.find('article.post, .cmsmasters_gallery_item'), 
						itemsCount = 	items.length, 
						delay = 		300, 
						i = 			1;
					
					
					var newTime = setInterval(function () { 
						if (el.hasClass('isotope')) {
							clearInterval(newTime);
						} else {
							return false;
						}
						
						
						items.each(function () { 
							var item = 	$(this);
							
							
							setTimeout(function () { 
								item.addClass('shortcode_animated');
							}, delay * i);
							
							
							i += 1;
							
							
							if (i === itemsCount) {
								setTimeout(function () { 
									$(window).trigger('resize');
								}, delay * i);
							}
						} );
					}, 300);
				}
			}, { 
				offset : 		'25%' 
			} );
		} else {
			$('.cmsmasters_gallery, .blog.columns, .blog.timeline').find('article.post, .cmsmasters_gallery_item').addClass('shortcode_animated');
		}
	} )(jQuery);
	
	
	
	/* Fixed Header Function Start */
 	(function ($) { 
		$('#header').cmsmastersFixedHeaderScroll();
	} )(jQuery);
	
	
	
	/* Responsive Navigation Function Start */
	(function ($) { 
		$('#navigation').cmsmastersResponsiveNav();
	} )(jQuery);
	
	
	
	/* Row Parallax Function Start */
	(function ($) { 
		$(window).on('load', function () {
			if ( 
				!checker.os.iphone && 
				!checker.os.ipad && 
				!checker.os.ipod && 
				!checker.os.android && 
				!checker.os.blackberry 
			) {
				if (checker.ua.safari) {
					if (checker.ua.chrome || checker.os.mac) {
						setTimeout(function () { 
							$.stellar( { 
								horizontalScrolling : 	false, 
								verticalOffset : 		30, 
								parallaxElements : 		false 
							} );
						}, 1500);
						
						
						$(window).on('debouncedresize', function () { 
							if ($(window).width() < 1024) {
								$.stellar('destroy');
							} else {
								$.stellar( { 
									horizontalScrolling : 	false, 
									verticalOffset : 		30, 
									parallaxElements : 		false 
								} );
							}
						} );
					}
				} else {
					setTimeout(function () { 
						$.stellar( { 
							horizontalScrolling : 	false, 
							verticalOffset : 		30, 
							parallaxElements : 		false 
						} );
					}, 1500);
					
					
					$(window).on('debouncedresize', function () { 
						if ($(window).width() < 1024) {
							$.stellar('destroy');
						} else {
							$.stellar( { 
								horizontalScrolling : 	false, 
								verticalOffset : 		30, 
								parallaxElements : 		false 
							} );
						}
					} );
				}
			} else {
				$('div.cmsmasters_row').css('background-attachment', 'scroll');
			}
		} );
	} )(jQuery);
	
	
	
	/* One Page Navigation */
	(function ($) { 
		function cmsmasters_get_offset_val() {
			var cmsmasters_wpAdminBar = $('#wpadminbar').outerHeight(), 
				cmsmasters_offset_val = (cmsmasters_wpAdminBar !== undefined) ? cmsmasters_wpAdminBar : 0;
			
			
			if ($('#page').hasClass('fixed_header')) {
				var header_mid_data_height = $('.header_mid').data('height'), 
					header_mid_height = header_mid_data_height - (header_mid_data_height / 3), 
					header_bot_data_height = $('.header_bot').data('height'), 
					header_bot_data_height = (header_bot_data_height !== undefined) ? header_bot_data_height : 0;
					
					
				cmsmasters_offset_val = cmsmasters_offset_val + header_mid_height + header_bot_data_height - 1;
			}
			
			
			return cmsmasters_offset_val;
		}
		
		
		var cmsmasters_window_hash = window.location.hash;
		
		if ($(cmsmasters_window_hash).length > 0) {
			setTimeout(function () { 
				$('html, body').animate( {
					scrollTop: $(cmsmasters_window_hash).offset().top - cmsmasters_get_offset_val() + 1
				}, 800);
			}, 800);
		}
		
		
		$('body').scrollspy({target: '#navigation'});
		
		
		$('#navigation a').on('click', function(event) {
			if (this.hash !== "") {
				event.preventDefault();
				
				
				var hash = this.hash, 
					linkHref = $(this).attr('href');
				
				
				if ($(hash).length > 0) {
					$('html, body').animate( {
						scrollTop: $(hash).offset().top - cmsmasters_get_offset_val() + 1
					}, 800, function() {
						if (history.pushState) {
							history.pushState(null, null, hash);
						}
					} );
				} else if (!$('body').hasClass('cmsmasters_custom_page_menu')) {
					if ( 
						linkHref.indexOf(hash) !== -1 && 
						linkHref.slice(0, linkHref.indexOf(hash)) !== cmsmasters_script.site_url && 
						linkHref !== hash 
					) {
						window.location.href = linkHref;
					} else {
						window.location.href = cmsmasters_script.site_url + hash;
					}
				}
			}
		} );
	} )(jQuery);
	
	
	
	/* Notise Close Button */
	(function ($) { 
		$('.cmsmasters_notice a.notice_close').on('click', function () { 
			$(this).parents('.cmsmasters_notice').fadeOut(500, function () { 
				$(this).remove();
			} );
			
			
			return false;
		} );
	} )(jQuery);
	
	
	
	/* Toggles */
	(function ($) { 
		$('.cmsmasters_toggles .cmsmasters_toggle_title a').on('click', function (i) { 
			var active_toggle = $(this).parents('.cmsmasters_toggles').find('.cmsmasters_toggle_wrap.current_toggle .cmsmasters_toggle'), 
				toggle = $(this).parents('.cmsmasters_toggle_wrap'), 
				acc = ($(this).parents('.cmsmasters_toggles').hasClass('toggles_mode_accordion')) ? true : false, 
				dropDown = toggle.find('.cmsmasters_toggle');
			
			
			if (toggle.hasClass('current_toggle')) {
				dropDown.slideUp('fast', function () { 
					toggle.removeClass('current_toggle');
				} );
			} else {
				if (acc) {
					active_toggle.slideUp('fast', function () { 
						active_toggle.parents('.cmsmasters_toggle_wrap').removeClass('current_toggle');
					} );
				}
				
				dropDown.slideDown('fast', function () { 
					toggle.addClass('current_toggle');
				} );
			}
			
			
			i.preventDefault();
			
			
			setTimeout(function () { 
				jQuery('body').trigger('debouncedresize');
			}, 300);
		} );
		
		
		$('.cmsmasters_toggles .cmsmasters_toggles_filter a').on('click', function (i) { 
			var filter_wrap = $(this).parents('.cmsmasters_toggles_filter'), 
				filter = $(this).data('key'), 
				toggle = $(this).parents('.cmsmasters_toggles').find('.cmsmasters_toggle_wrap');
			
			
			if ($(this).is(':not(.current_filter)')) { 
				filter_wrap.find('a').removeClass('current_filter');
				
				
				$(this).addClass('current_filter');
				
				
				toggle.filter('[data-tags~="' + filter + '"]').slideDown('fast');
				
				
				toggle.filter(':not([data-tags~="' + filter + '"])').slideUp('fast');
				
				
				toggle.filter(':not([data-tags~="' + filter + '"])').removeClass('current_toggle').find('.cmsmasters_toggle').removeAttr('style');
			}
			
			
			i.preventDefault();
		} );
	} )(jQuery);
	
	
	
	/* Tabs */
	(function ($) { 
		$('.cmsmasters_tabs ul.cmsmasters_tabs_list li a').on('click', function (t) { 
			var tabs_parent = $(this).parents('.cmsmasters_tabs'), 
				tabs = tabs_parent.find('.cmsmasters_tabs_wrap'), 
				index = $(this).parents('li').index();
			
			
			tabs_parent.find('.cmsmasters_tabs_list > .current_tab').removeClass('current_tab');
			
			
			$(this).parents('li').addClass('current_tab');
			
			
			tabs.find('.cmsmasters_tab').not(':eq(' + index + ')').slideUp('fast', function () { 
				$(this).removeClass('active_tab');
			} );
			
			
			tabs.find('.cmsmasters_tab:eq(' + index + ')').slideDown('fast', function () { 
				$(this).addClass('active_tab');
			} );
			
			
			t.preventDefault();
			
			
			setTimeout(function () { 
				jQuery('body').trigger('resize');
			}, 5000);
		} );
	} )(jQuery);
	
	
	
	/* Share Buttons */
	(function ($) { 
		$('.share_posts a, .share_wrap a:not(.cmsmasters_pinterest_button)').bind('click', function (e) { 
			var screenSize = { 
					width : 	screen.width, 
					height : 	screen.height 
				}, 
				windowWidth = 650, 
				windowHeight = 350, 
				windowTop = (screenSize.height / 2) - (windowHeight / 2), 
				windowLeft = (screenSize.width / 2) - (windowWidth / 2), 
				socialHref = $(this).attr('href'), 
				newWindow = 'width = ' + windowWidth + ', height = ' + windowHeight + ', top = ' + windowTop + ', left = ' + windowLeft + ', resizable = no, status = no, titlebar = no, toolbar = no, location = no';
			
			
			e.preventDefault();
			
			
			return window.open(socialHref, '_blank', newWindow);
		} );
	} )(jQuery);
	
	
	
	/* YouTube Iframe Fix */
	(function ($) { 
		var iframe = $('iframe[src*="youtube.com"]');
		
		
		iframe.each(function () { 
			var current = 	$(this), 
				src = 		current.attr('src'); 
			
			
			if (src) {
				if (src.indexOf('?') !== -1) {
					src += "&wmode=opaque";
				} else {
					src += "?wmode=opaque";
				}
				
				
				current.attr('src', src);
			}
		} );
	} )(jQuery);
	
	
	/* Sticky Columns */
	(function ($) { 
		var $header = $("#header"),
			$wpadminbar = $("#wpadminbar"),
			cmsmasters_sticky_columns = $(".cmsmasters_column_sticky").smoothSticky({
				indent_top: 32,
				indent_bottom: 32,
				onScroll: function (){
					this.options.offsetTop = (function(){
						var offsetTop = 0;
						
						$.each([$header, $wpadminbar], function(index, item){
							var $item = $(item);

							return offsetTop += ($item.css("position") === "fixed" ? $item.height() : 0);
						});
						
						return offsetTop;
					})();
				}
			});
	} )(jQuery);
	
	
	/* View Button */
	function cmsmastersView() { 
		var viewButton = jQuery('.cmsmastersView');
		
		if (viewButton.hasClass('no_active')) {
			var postID = viewButton.attr('id').replace(/cmsmastersView-/g, ''),
			data = { 
				action : 	'cmsmasters_ajax_view', 
				id : 		postID, 
				nonce : 	cmsmasters_script.nonce_ajax_view 
			};
			
			
			if (postID !== '') { 
				viewButton.find('> span').text('...');
				
				
				jQuery.post(cmsmasters_script.ajaxurl, data, function(response) {
					viewButton.find('> span').text(response);
					
					
					viewButton.removeClass('no_active');
					
					viewButton.addClass('active');
				} );
			}
		}
		
		
		return false;
	}
	
	cmsmastersView();
} );



/* CMSMasters Media Width */
function cmsmasters_media_width() {
	var media_width = parseInt(jQuery('.cmsmasters_responsive_width').css('width'));
	
	return media_width;
}



/* Like Button */
function cmsmastersLike(postID, add_html) { 
	"use strict";
	
	if (postID !== '') {
		var likeButton = jQuery('#cmsmastersLike-' + postID), 
			data = { 
				action : 	'cmsmasters_ajax_like', 
				id : 		postID, 
				add_html : 	add_html, 
				nonce : 	cmsmasters_script.nonce_ajax_like 
			};
		
		
		likeButton.find('> span').text('...');
		
		
		jQuery.post(cmsmasters_script.ajaxurl, data, function(response) {	
			likeButton.find('> span').text(response);
			
			
			likeButton.addClass('active');
			
			
			likeButton.attr( { 
				onclick : 	'return false;' 
			} );
		} );
	}
	
	
	return false;
}



/* Run Owl Slider */
function cmsmasters_owl_sliders_run() {
	var owl_sliders = jQuery('.cmsmasters_owl_slider');
	
	
	owl_sliders.each(function () { 
		var slider = jQuery(this), 
			data = [];
		
		
		data['data_id'] = slider.attr('id');
		data['data_items'] = slider.data('items'), 
		data['data_singleItem'] = slider.data('singleItem'), 
		data['data_autoPlay'] = slider.data('autoPlay'), 
		data['data_stopOnHover'] = slider.data('stopOnHover'), 
		data['data_rewindNav'] = slider.data('rewindNav'), 
		data['data_slideSpeed'] = slider.data('slideSpeed'), 
		data['data_paginationSpeed'] = slider.data('paginationSpeed'), 
		data['data_rewindSpeed'] = slider.data('rewindSpeed'), 
		data['data_autoHeight'] = slider.data('autoHeight'), 
		data['data_transitionStyle'] = slider.data('transitionStyle'), 
		data['data_pagination'] = slider.data('pagination'), 
		data['data_navigation'] = slider.data('navigation'), 
		data['data_navigationPrev'] = slider.data('navigationPrev'), 
		data['data_navigationNext'] = slider.data('navigationNext');
		
		
		cmsmasters_owl_slider_run(data);
	} );
}



/* Owl Slider run */
function cmsmasters_owl_slider_run(data) {
	var data_id = data['data_id'], 
		container = jQuery('#' + data_id), 
		data_items = false, 
		data_singleItem = true, 
		data_autoPlay = false, 
		data_stopOnHover = true, 
		data_rewindNav = true, 
		data_slideSpeed = 200, 
		data_paginationSpeed = 800, 
		data_rewindSpeed = 1000, 
		data_autoHeight = (checker.ua.safari && checker.os.mac && !checker.ua.chrome) ? false : true, 
		data_transitionStyle = false, 
		data_pagination = true, 
		data_navigation = true, 
		data_navigationPrev = '<span class="cmsmasters_prev_arrow"><span></span></span>', 
		data_navigationNext = '<span class="cmsmasters_next_arrow"><span></span></span>', 
		params = {};
	
	
	if (data['data_items'] !== undefined) {
		data_items = Number(data['data_items']);
	}
	
	
	if (data['data_singleItem'] !== undefined) {
		data_singleItem = Boolean(data['data_singleItem']);
	}
	
	
	if (data['data_autoPlay'] !== undefined) {
		data_autoPlay = (data['data_autoPlay'] === false) ? false : Number(data['data_autoPlay']);
	}
	
	
	if (data['data_stopOnHover'] !== undefined) {
		data_stopOnHover = Boolean(data['data_stopOnHover']);
	}
	
	
	if (data['data_rewindNav'] !== undefined) {
		data_rewindNav = Boolean(data['data_rewindNav']);
	}
	
	
	if (data['data_slideSpeed'] !== undefined) {
		data_slideSpeed = Number(data['data_slideSpeed']);
	}
	
	
	if (data['data_paginationSpeed'] !== undefined) {
		data_paginationSpeed = Number(data['data_paginationSpeed']);
	}
	
	
	if (data['data_rewindSpeed'] !== undefined) {
		data_rewindSpeed = Number(data['data_rewindSpeed']);
	}
	
	
	if (data['data_autoHeight'] !== undefined) {
		data_autoHeight = Boolean(data['data_autoHeight']);
	}
	
	
	if (data['data_transitionStyle'] !== undefined) {
		data_transitionStyle = (data['data_transitionStyle'] === 'fade') ? data['data_transitionStyle'] : false;
	}
	
	
	if (data['data_pagination'] !== undefined) {
		data_pagination = Boolean(data['data_pagination']);
	}
	
	
	if (data['data_navigation'] !== undefined) {
		data_navigation = Boolean(data['data_navigation']);
	}
	
	
	if (data['data_navigationPrev'] !== undefined) {
		data_navigationPrev = data['data_navigationPrev'];
	}
	
	
	if (data['data_navigationNext'] !== undefined) {
		data_navigationNext = data['data_navigationNext'];
	}
	
	
	params = { 
		singleItem : 			data_singleItem, 
		autoPlay : 				data_autoPlay, 
		stopOnHover : 			data_stopOnHover, 
		rewindNav : 			data_rewindNav, 
		slideSpeed : 			data_slideSpeed, 
		paginationSpeed : 		data_paginationSpeed, 
		rewindSpeed : 			data_rewindSpeed, 
		autoHeight : 			data_autoHeight, 
		addClassActive : 		true, 
		transitionStyle : 		data_transitionStyle, 
		responsiveBaseWidth : 	'#' + data_id, 
		pagination : 			data_pagination, 
		navigation : 			data_navigation, 
		navigationText : 		[data_navigationPrev, data_navigationNext] 
	};
	
	
	if (data_singleItem === false) {
		if (data_items === false) {
			var contentWrap = container.closest('.content_wrap'), 
				itemsNumber = 2;
			
			
			if (contentWrap.hasClass('fullwidth')) {
				itemsNumber = 4;
			} else if (contentWrap.hasClass('r_sidebar') || contentWrap.hasClass('l_sidebar')) {
				itemsNumber = 3;
			}
		} else {
			itemsNumber = data_items;
		}
		
		var firstPost = container.find('.cmsmasters_owl_slider_item'), 
			postMinWidthStr = firstPost.css('minWidth'),
			postMinWidth = 0;

		if (postMinWidthStr) {
			postMinWidth = parseInt(postMinWidthStr.replace('px', ''), 10);
		}

		var postDesktopWidth = (postMinWidth * 5) - 1, 
			postDesktopSmallWidth = (postMinWidth * 4) - 1, 
			postTabletWidth = (postMinWidth * 3) - 1, 
			postMobileWidth = (postMinWidth * 2) - 1, 
			postFourColumns = (itemsNumber > 4 ? 4 : itemsNumber), 
			postThreeColumns = (itemsNumber > 3 ? 3 : itemsNumber), 
			postTwoColumns = (itemsNumber > 2 ? 2 : itemsNumber), 
			postOneColumns = 1;
		
		
		params.items = itemsNumber;
		params.itemsDesktop = [postDesktopWidth, postFourColumns];
		params.itemsDesktopSmall = [postDesktopSmallWidth, postThreeColumns];
		params.itemsTablet = [postTabletWidth, postTwoColumns];
		params.itemsMobile = [postMobileWidth, postOneColumns];
	}
	
	
	container.owlCarousel(params);
}



"use strict";

/* Correct OS & Browser Check */
var ua = navigator.userAgent, 
	checker = { 
		os : { 
			iphone : 		ua.match(/iPhone/), 
			ipod : 			ua.match(/iPod/), 
			ipad : 			ua.match(/iPad/), 
			blackberry : 	ua.match(/BlackBerry/), 
			android : 		ua.match(/(Android|Linux armv6l|Linux armv7l)/), 
			linux : 		ua.match(/Linux/), 
			win : 			ua.match(/Windows/), 
			mac : 			ua.match(/Macintosh/) 
		}, 
		ua : { 
			ie : 		ua.match(/MSIE/), 
			ie6 : 		ua.match(/MSIE 6.0/), 
			ie7 : 		ua.match(/MSIE 7.0/), 
			ie8 : 		ua.match(/MSIE 8.0/), 
			ie9 : 		ua.match(/MSIE 9.0/), 
			ie10 : 		ua.match(/MSIE 10.0/), 
			ie11 : 		ua.match(/MSIE 11.0/), 
			opera : 	ua.match(/Opera/), 
			firefox : 	ua.match(/Firefox/), 
			chrome : 	ua.match(/Chrome/), 
			safari : 	ua.match(/(Safari|BlackBerry)/) 
		} 
	};



/* Correct Image Load Check */
function isImageOk(img) { 
	"use strict";
	
	if (!img.complete) { 
		return false;
	}
	
	
	if (typeof img.naturalWidth !== undefined && img.naturalWidth === 0) { 
		return 'stop';
	}
	
	
	return true;
}



/* Check Whether the Numbers are Approximately Equal */
function checkN(a, b, x) { 
	"use strict";
	
    if ((a > b && a - x <= b) || (b > a && b - x <= a)){
        return true;
    } else {
        return false;
    }
}



/* Run Facebook Widget */
if (jQuery('#fb-root').length > 0) {
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, "script", "facebook-jssdk"));
}



/* Run Pinterest Widget */
if (jQuery('.cmsmasters_pinterest_button').length > 0) {
	(function() {
		window.PinIt = window.PinIt || { loaded:false };
		
		if (window.PinIt.loaded) {
			return;
		}
		
		window.PinIt.loaded = true;
		
		function async_load(){
			var s = document.createElement("script");
				s.type = "text/javascript";
				s.async = true;
				s.src = "//assets.pinterest.com/js/pinit.js";
				
			var x = document.getElementsByTagName("script")[0];
			
			
			x.parentNode.insertBefore(s, x);
		}
		
		if (window.attachEvent) {
			window.attachEvent("onload", async_load);
		} else {
			window.addEventListener("load", async_load, false);
		}
	})();
}



/* Uniq ID */
function uniqID() { 
	"use strict";
	
	return Math.round(new Date().getTime() + (Math.random() * 1000000));
}

