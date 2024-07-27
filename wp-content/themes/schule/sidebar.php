<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version 	1.0.0
 * 
 * Sidebar Template
 * Created by CMSMasters
 * 
 */


if (is_singular()) {
	$sidebar_id = get_post_meta(get_the_ID(), 'cmsmasters_sidebar_id', true);
} elseif (CMSMASTERS_WOOCOMMERCE && is_shop()) {
	$sidebar_id = get_post_meta(wc_get_page_id('shop'), 'cmsmasters_sidebar_id', true);
}


if (isset($sidebar_id) && is_dynamic_sidebar($sidebar_id) && is_active_sidebar($sidebar_id)) {
	dynamic_sidebar($sidebar_id);
} else if (
	CMSMASTERS_WOOCOMMERCE && 
	(
		is_woocommerce() || 
		is_cart() || 
		is_checkout() || 
		is_checkout_pay_page() || 
		is_account_page() || 
		is_view_order_page() || 
		is_edit_account_page() || 
		is_order_received_page() || 
		is_add_payment_method_page() || 
		is_lost_password_page()
	) && 
	is_active_sidebar('sidebar_shop')
) {
	dynamic_sidebar('sidebar_shop');
} else if (is_home() || is_archive()) {
	if (is_active_sidebar('sidebar_archive')) {
		dynamic_sidebar('sidebar_archive');
	} elseif (is_active_sidebar('sidebar_default')) {
		dynamic_sidebar('sidebar_default');
	}
} else if (is_search()) {
	if (is_active_sidebar('sidebar_search')) {
		dynamic_sidebar('sidebar_search');
	} elseif (is_active_sidebar('sidebar_default')) {
		dynamic_sidebar('sidebar_default');
	}
} else if (is_active_sidebar('sidebar_default')) {
	dynamic_sidebar('sidebar_default');
}

