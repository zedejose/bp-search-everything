<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( file_exists( dirname( __FILE__ ) . '/languages/' . get_locale() . '.mo' ) )
	load_textdomain( 'bp-search-everything', dirname( __FILE__ ) . '/includes/languages/' . get_locale() . '.mo' );

/**
 * Implementation of BP_Component
 *
 * BP_Component is the base class that all BuddyPress components use to set up their basic
 * structure, including global data, navigation elements, and admin bar information.
 *
 *
 * @package BuddyPress Search Everything.
 * @since 0.1.0
 * @author Zé Fontainhas
 */
class BP_Search_Everything_Component extends BP_Component {

	/**
	 * Constructor method
	 *
	 * BP_Component::start() takes three parameters:
	 *   (1) $id   - A unique identifier for the component. Letters, numbers, and underscores
	 *   only.
	 *   (2) $name - This is a translatable name for your component, which will be used in
	 *               various places through the BuddyPress admin screens to identify it.
	 *   (3) $path - The path to your plugin directory. Primarily, this is used by
	 *   BP_Component::includes(), to include your plugin's files.
	 *
	 * @package BuddyPress Search Everything.
	 * @since 0.1.0
	 * @author Zé Fontainhas
	 *
	 */
	function __construct() {
		global $bp;

		parent::start(
			'search_everything',
			__( 'Search Everything', 'bp-search-everything' ),
			BP_SEARCH_EVERYTHING_PLUGIN_DIR
		);

		/**
		 * BuddyPress-dependent plugins are loaded too late to depend on BP_Component's
		 * hooks, so we must call the function directly.
		 */
		$this->includes();

		/**
		 * Put the component into the active components array, so that
		 *   bp_is_active( 'search_everything' );
		 * returns true when appropriate.
		 */
		$bp->active_components[$this->id] = '1';

	}

	/**
	 * Include the component's files
	 *
	 * @package BuddyPress Search Everything.
	 * @since 0.1.0
	 * @author Zé Fontainhas
	 */
	function includes( $includes = array() ) {

		// Files to include
		$includes = array(
			'includes/bp-search-everything-admin.php',
			'includes/bp-search-everything-actions.php',
			'includes/bp-search-everything-filters.php',
			'includes/bp-search-everything-functions.php',
			'includes/bp-search-everything-template.php',
			'includes/bp-search-everything-widgets.php',
		);

		parent::includes( $includes );
	}

	/**
	 * Set up globals
	 *
	 * @package BuddyPress Search Everything.
	 * @since 0.1.0
	 * @author Zé Fontainhas
	 *
	 * @global obj $bp BuddyPress's global object
	 */
	function setup_globals( $globals = array() ) {
		global $bp;

		// Defining the slug in this way makes it possible for site admins to override it
		if ( !defined( 'BP_SEARCH_EVERYTHING_SLUG' ) )
			define( 'BP_SEARCH_EVERYTHING_SLUG', $this->id );

		// Set up the $globals array to be passed along to parent::setup_globals()
		$globals = array(
			'slug'                  => BP_SEARCH_EVERYTHING_SLUG,
			'root_slug'             => isset( $bp->pages->{$this->id}->slug ) ? $bp->pages->{$this->id}->slug : BP_SEARCH_EVERYTHING_SLUG,
			'has_directory'         => true, // Set to false if not required
			'notification_callback' => '',
			'search_string'         => '',
			'global_tables'         => ''
		);

		// Let BP_Component::setup_globals() do its work.
		parent::setup_globals( $globals );

	}
}

/**
 * Loads the component into the $bp global
 *
 * @package BuddyPress Search Everything.
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 */
function bp_search_everything_load_core_component() {
	global $bp;

	$bp->search_everything = new BP_Search_Everything_Component;
}
add_action( 'bp_loaded', 'bp_search_everything_load_core_component' );


