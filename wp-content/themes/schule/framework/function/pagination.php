<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.1.9
 * 
 * Pagination Function
 * Created by CMSMasters
 * 
 */


function cmsmasters_pagination($max_num_pages = NULL, $shortcode_id = '') {
	if ($max_num_pages == NULL) {
		global $wp_query;
		
		
		$max_num_pages = $wp_query->max_num_pages;
	}
	
	
	$format = '?paged=%#%';
	
	
	if (get_query_var('paged')) {
		$current = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$current = get_query_var('page');
		
		$format = '/page/%#%';
	} else {
		$current = 1;
	}

	$base = str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999)));

	if ( ! empty( $shortcode_id ) ) {
		$base = esc_url_raw( add_query_arg( "cmsmasters-{$shortcode_id}-page", '%#%', false ) );
		$format = "?cmsmasters-{$shortcode_id}-page=%#%";
		$current = absint( empty( $_GET["cmsmasters-{$shortcode_id}-page"] ) ? 1 : $_GET["cmsmasters-{$shortcode_id}-page"] );
	}
	
	
	$pagination = array( 
		'base' => $base, 
		'format' => $format, 
		'total' => $max_num_pages, 
		'current' => $current, 
		'show_all' => false, 
		'end_size' => 1, 
		'mid_size' => 1, 
		'prev_next' => true, 
		'prev_text' => '<span class="cmsmasters_theme_icon_pagination_' . (!is_rtl() ? 'prev' : 'next') . '"><span>' . esc_html(apply_filters('schule_pagination_prev_text_filter', '')) . '</span></span>', 
		'next_text' => '<span class="cmsmasters_theme_icon_pagination_' . (!is_rtl() ? 'next' : 'prev') . '"><span>' . esc_html(apply_filters('schule_pagination_next_text_filter', '')) . '</span></span>', 
		'type' => 'list', 
		'add_args' => false, 
		'add_fragment' => '' 
	);
	
	
	if (get_query_var('s')) {
		$search_query = get_query_var('s');
		
		
		$pagination['add_args'] = array( 
			's' => urlencode($search_query) 
		);
	}
	
	
	return '<div class="cmsmasters_wrap_pagination">' . 
		paginate_links($pagination) . 
	'</div>';
}

