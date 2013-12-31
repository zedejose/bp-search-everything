<?php
/***
 * BuddyPress Search Everything functions.
 */

/**
 * Set the correct title for the results page.
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - bp_is_current_component()
 *       - add_options_page()
 * @param  string $title       Original title
 * @param  string $sep
 * @param  string $seplocation Separator
 * @return string              New title
 */
function bp_search_everything_get_title($title, $sep, $seplocation){
	global $bp;
	if( bp_is_current_component( $bp->search_everything->id ) )
		$title = __( 'Advanced Search', 'bp-search-everything' ) . ' ' . $seplocation . ' ';
	return $title;

}

add_filter('bp_modify_page_title','bp_search_everything_get_title',5,3);
