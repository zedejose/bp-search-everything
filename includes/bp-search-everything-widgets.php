<?php

add_action( 'widgets_init', create_function( '', 'return register_widget("BP_Search_Everything_Widget");' ) );

/**
 * BuddyPress Search Everything Widget.
 *
 * @package BuddyPress Search Everything.
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - BP_Search_Everything_Widget::__construct()
 *       - BP_Search_Everything_Widget::widget()
 *       - BP_Search_Everything_Widget::update()
 *       - BP_Search_Everything_Widget::form()
 */
class BP_Search_Everything_Widget extends WP_Widget {

	/**
	 * Constructor method.
	 *
	 * @package BuddyPress Search Everything.
	 * @since 0.1.0
	 * @author Zé Fontainhas
	 */
	public function __construct() {
		parent::__construct(
			false,
			_x( 'Search Everything', 'Title of the widget', 'bp-search-everything' ),
			array(
				'description' => __( 'Shows the Search Everything form.', 'bp-search-everything' ),
				'classname' => 'widget_bp_search_everything_widget buddypress widget',
			)
		);
	}

	/**
	 * Display the form widget.
	 *
	 * @package BuddyPress Search Everything.
	 * @since 0.1.0
	 * @author Zé Fontainhas
	 *
	 * @see WP_Widget::widget() for description of parameters.
	 */
	public function widget( $args, $instance ) {

		global $bp;

		$title = apply_filters( 'widget_title', $instance['title'] );
		$hide_button = isset( $instance['hide_button'] ) ? $instance['hide_button'] : false;

		echo $args['before_widget'];

		echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		?>
		<aside id="bp-search-everything" class="widget widget_search">
		<form role="search" method="get" id="searchform" action="<?php echo home_url( trailingslashit( $bp->search_everything->root_slug ) ); ?>">
			<input type="text" value="" name="as" id="as">
			<?php if( ! $hide_button ) {?>
			<input type="submit" id="searchsubmit" value="Search">
			<?php } ?>
		</form>

		</aside>
		<?php

		echo $args['after_widget'];
	}

	/**
	 * Update the form widget options.
	 *
	 * @package BuddyPress Search Everything.
	 * @since 0.1.0
	 * @author Zé Fontainhas
	 *
	 * @param array   $new_instance The new instance options.
	 * @param array   $old_instance The old instance options.
	 * @return array $instance The parsed options to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['hide_button'] = isset( $new_instance['hide_button'] ) ? (bool) $new_instance['hide_button'] : false;

		return $instance;
	}

	/**
	 * Output the form widget options form.
	 *
	 * @package BuddyPress Search Everything.
	 * @since 0.1.0
	 * @author Zé Fontainhas
	 *
	 * @param unknown $instance Settings for this widget.
	 */
	public function form( $instance = array() ) {

		$title     	= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$hide_button = isset( $instance['hide_button'] ) ? (bool) $instance['hide_button'] : false;

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bp-search-everything' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $hide_button ); ?> id="<?php echo $this->get_field_id( 'hide_button' ); ?>" name="<?php echo $this->get_field_name( 'hide_button' ); ?>">
			<label for="<?php echo $this->get_field_id( 'hide_button' ); ?>"><?php _e( 'Hide submit button?', 'bp-search-everything' ); ?></label>
		</p>
		<?php
	}
}
