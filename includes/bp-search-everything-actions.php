<?php
add_action( 'bp_init', 'bp_search_everything_var_dump' ); // Debugging
add_action( 'bp_init', 'bp_search_everything_template', 10 ); // Custom handler for the search
add_action( 'advance-search', 'bp_search_everything_show_search_results', 1 );

/**
 * Debug functions on bp_init.
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 */
function bp_search_everything_var_dump() {

	global $bp;
	//var_dump( $bp->active_components);

}

/**
 * Loads the search template
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - bp_is_current_component()
 *       - bp_core_load_template
 *       - apply_filters
 */
function bp_search_everything_template() {

	global $bp;

	if ( bp_is_current_component( $bp->search_everything->slug ) )//if this is search page
		bp_core_load_template( apply_filters( 'bp_core_template_search_template', 'search-single' ) );//load the single search template
}

/**
 * Process search query.
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - get_option()
 *       - bp_search_everything_process_custom()
 *       - bp_search_everything_process_members()
 *       - bp_search_everything_process_topics()
 *       - bp_search_everything_process_groups()
 *       - bp_search_everything_process_updates()
 */
function bp_search_everything_show_search_results() {

	// Get request & sanitize
	$words = esc_attr( $_REQUEST['as'] );
	$search_terms = preg_replace( '/\s+/', ' ', trim( $words ) );

	// Wrap results in a div
	echo '<div id="bp-search-everything" class="post">';

	// Get custom content type to search
	$includes = get_option( 'bp-search-everything-include' );

	// Always include posts and pages
	$types = array( 'post', 'page' );
	foreach ($includes as $key => $value) {
		$types[] = $key;
	}

	// Do any custom searches before
	do_action( 'bp-search-everything-before-search', $words );

	// Search posts, pages and custom content types
	bp_search_everything_process_custom ( $types, $words );

	// Search members - no need to check if active, mandatory in BP
	bp_search_everything_process_members ( $words );

	// Search forums - bp_is_active is wrong, older BP foru  structure
	if ( bp_is_active( 'forums' ) )
		bp_search_everything_process_topics ( $words );

	// Search groups
	if ( bp_is_active( 'groups' ) )
		bp_search_everything_process_groups ( $words );

	// Search activity
	if ( bp_is_active( 'activity' ) )
		bp_search_everything_process_updates ( $words );

	// Do any custom searches after
	do_action( 'bp-search-everything-after-search', $words );

	// Close div
	echo '</div>';

}
