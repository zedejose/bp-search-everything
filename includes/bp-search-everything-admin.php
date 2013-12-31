<?php

/***
 * This file is used to add site administration menus to the WordPress backend.
 */

/**
 * Add a settings menu item for this component.
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - is_super_admin()
 *       - add_options_page()
 */
function bp_search_everything_add_settings_menu() {
	global $bp;

	if ( !is_super_admin() )
		return false;

	add_options_page(
			__( 'Search Everything Settings', 'bp-search-everything' ),
			__( 'Search Everything', 'bp-search-everything' ),
			'manage_options',
			'bp-search-everything-settings',
			'bp_search_everything_settings'
		);
}
// The bp_core_admin_hook() function returns the correct hook (admin_menu or network_admin_menu),
// depending on how WordPress and BuddyPress are configured
add_action( bp_core_admin_hook(), 'bp_search_everything_add_settings_menu' );

/**
 * Checks for form submission, saves component settings and outputs admin screen HTML.
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - check_admin_referer()
 *       - update_option()
 *       - get_option()
 *       - site_url
 *       - get_post_types()
 *       - wp_nonce_field()
 */
function bp_search_everything_settings() {
	global $bp;

	if ( isset( $_POST['submit'] ) && check_admin_referer( 'bp-search-everything-settings' ) ) {
		update_option( 'bp-search-everything-max-results', $_POST['bp-search-everything-max-results'] );
		update_option( 'bp-search-everything-include', $_POST['bp-search-everything-include'] );
		$updated = true;
	}

	$max_results = get_option( 'bp-search-everything-max-results' );

	?>
	<div class="wrap">
		<h2><?php _e( 'Search Everything Settings', 'bp-search-everything' ); ?></h2>
		<br />

		<?php if ( isset( $updated ) ) : ?><?php echo "<div id='message' class='updated fade'><p>" . __( 'Settings Updated.', 'bp-search-everything' ) . "</p></div>" ?><?php endif; ?>

		<form action="<?php echo site_url() . '/wp-admin/admin.php?page=bp-search-everything-settings' ?>" name="bp-search-everything-settings-form" id="bp-search-everything-settings-form" method="post">

			<table class="form-table">

				<tr valign="top">
					<h3><?php _e( 'General Settings', 'bp-search-everything' ); ?></h3>
					<th scope="row"><label for="target_uri"><?php _e( 'Maximum Number of Results', 'bp-search-everything' ) ?></label></th>
					<td>
						<input name="bp-search-everything-max-results" type="text" id="bp-search-everything-max-results" value="<?php echo esc_attr( $max_results ); ?>" size="2" />
					</td>
				</tr>

			</table>

			<?php
			$args = array(
				'public'   => true,
				'exclude_from_search' => true,
				'_builtin' => false
			);

			$output = 'objects'; // names or objects, note names is the default
			$post_types = get_post_types( $args, $output );

			if ( $post_types ) {
				foreach ( $post_types as $post_type ) {
					if ( !in_array( $post_type->name, array( 'forum', 'topic', 'reply' ) ) ) {
						$contents[] = $post_type->name . ',' . $post_type->labels->name;
					}
				}
				if ( $contents ) {
					?>
					<h3><?php _e( 'Search Custom Content', 'bp-search-everything' ); ?></h3>
					<table class="form-table">
					<?php

					foreach ($contents as $select) {
						$option = explode( ',', $select );
						$selected = get_option( 'bp-search-everything-include' );
						$checked = ("1" == $selected[$option[0]] ) ? ' checked="checked"' : '';
						?>
						<tr valign="top">
						<th scope="row"><label for="bp-search-everything-include[<?php echo $option[0]; ?>]"><?php echo $option[1]; ?></label></th>
						<td>
						<input id="bp-search-everything-include-<?php echo $option[0]; ?>" name="bp-search-everything-include[<?php echo $option[0]; ?>]" type="checkbox" value="1"<?php echo $checked; ?>>
						</td>
						</tr>
					<?php
					}
					?>
					</table>
					<?php
				}
			}

			?>
			<p class="submit">
				<input type="submit" class="button button-primary" name="submit" value="<?php _e( 'Save Settings', 'bp-search-everything' ); ?>"/>
			</p>
			<?php wp_nonce_field( 'bp-search-everything-settings' ); ?>
		</form>
	</div>
<?php
}
