<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Donations
 * @version		1.0.0
 * 
 * CMSMasters Donations Pagination
 * Created by CMSMasters
 * 
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $donations;

if ( $donations->max_num_pages <= 1 ) {
	return;
}
?>
<nav class="cmsmasters_donations_pagination">
    <?php
        echo paginate_links( apply_filters( 'cmsmasters_donations_pagination_args', array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $donations->max_num_pages,
		'prev_text' 	=> '&larr;',
		'next_text' 	=> '&rarr;',
		'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
		) ) );
    ?>
</nav>