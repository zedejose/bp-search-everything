<?php
/*
Plugin Name: BuddyPress Search Everything
Plugin URI: http://github.com/zedejose/bp-search-everything
Description: Allows searching across all BP/WP content
Version: 0.1
Revision Date: DEC 20, 2013
Requires at least: WP 3.8, BuddyPress 1.9
Tested up to: WP 3.8, BuddyPress 1.9
License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
Author: Zé Fontainhas
Author URI: http://github.com/zedejose/
Network: true
*/

// Define a constant that can be checked to see if the component is installed or not.
define( 'BP_SEARCH_EVERYTHING_IS_INSTALLED', 1 );

// Define a constant that will hold the current version number of the component
// This can be useful if you need to run update scripts or do compatibility checks in the future
define( 'BP_SEARCH_EVERYTHING_VERSION', '0.1' );

// Define a constant that we can use to construct file paths throughout the component
define( 'BP_SEARCH_EVERYTHING_PLUGIN_DIR', dirname( __FILE__ ) );


add_action( 'bp_include', 'bp_search_everything_init' );
register_activation_hook( __FILE__, 'bp_search_everything_activate' );
register_deactivation_hook( __FILE__, 'bp_search_everything_deactivate' );

/**
 * Load the component (only if BuddyPress is loaded and initialized).
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 */
function bp_search_everything_init() {
	// The loader file uses BP_Component and new BP, it requires BP 1.9 or greater.
	if ( version_compare( BP_VERSION, '1.8', '>' ) )
		require dirname( __FILE__ ) . '/includes/bp-search-everything-loader.php';
}

/**
 * Setup procedures to be run when the plugin is activated.
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 */
function bp_search_everything_activate() {

}

/**
 * Clean-up procedures to be run when the plugin is deactivated.
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 */
function bp_search_everything_deactivate() {

}
