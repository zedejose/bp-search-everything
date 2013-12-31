<?php
/***
 * BuddyPress Search Everything functions.
 */

/**
 * Search members
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - bp_has_members()
 *       - bp_members()
 *       - bp_the_member()
 *       - bp_member_avatar()
 *       - bp_member_name()
 *       - bp_get_root_domain()
 *       - bp_get_members_slug()
 * @param  string $query       Words to search
 */
function bp_search_everything_process_members( $query ) {

	global $bp;
	global $members_template;

	$max_results = get_option( 'bp-search-everything-max-results' );
	if( !$max_results ) {
		$max_results = 10;
	}

	?>
	<h2 class="post-title"><?php _e( 'Members', 'bp-search-everything' ); ?></h2>
	<div class="members-search-result search-result">

	<?php

	if ( bp_has_members( 'search_terms=' . $query ) ) {

		$members_found = $members_template->total_member_count;
		$counter = 0;

		while ( bp_members() ) {

			if( $max_results == $counter )
				break;

			bp_the_member();
			?>
			<div class="member-search-result">
				<div class="item-avatar">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(); ?></a>
				</div>
				<div class="item-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
				</div>
			</div>
			<?php
			$counter ++;
		}
		?>
		<div class="post-meta">
			<a href="<?php echo bp_get_root_domain().'/'.  bp_get_members_slug().'/?s='. $query; ?>" ><?php echo __( 'View all found members', 'bp-search-everything' ) . ' (' . $members_found . ')';?></a>
		</div>
		<?php
	} else {
		?>
		<div class="post-meta"><?php _e( 'No Members Found', 'bp-search-everything' ); ?></div>
		<?php
	}
	?>
	</div>
	<?php

}

/**
 * Search groups
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - bp_has_groups()
 *       - bp_groups()
 *       - bp_the_group()
 *       - bp_group_name()
 *       - bp_get_root_domain()
 *       - bp_get_groups_slug()
 * @param  string $query       Words to search
 */
function bp_search_everything_process_groups( $query ) {

	global $bp;
	global $groups_template;

	$max_results = get_option( 'bp-search-everything-max-results' );
	if( !$max_results ) {
		$max_results = 10;
	}

	?>
	<h2 class="post-title"><?php _e( 'Groups', 'bp-search-everything' ); ?></h2>
	<div class="groups-search-result search-result">

	<?php

	if ( bp_has_groups( 'search_terms=' . $query ) ) {

		$groups_found = $groups_template->total_group_count;
		$counter = 0;

		while ( bp_groups() ) {

			if( $max_results == $counter )
				break;

			bp_the_group();
			?>
			<div class="groups-search-result">
				<div class="item-title">
					<a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a>
				</div>
			</div>
			<?php
			$counter ++;
		}
		?>
		<div class="post-meta">
			<a href="<?php echo bp_get_root_domain().'/'.  bp_get_groups_slug().'/?s='. $query; ?>" ><?php echo __( 'View all found groups', 'bp-search-everything' ) . ' (' . $groups_found . ')';?></a>
		</div>
		<?php
	} else {
		?>
		<div class="post-meta"><?php _e( 'No Groups Found', 'bp-search-everything' ); ?></div>
		<?php
	}
	?>
	</div>
	<?php

}

/**
 * Search forum topics
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - bp_has_forum_topics()
 *       - bp_forum_topics()
 *       - bp_the_forum_topic()
 *       - bp_the_topic_title()
 *       - bp_get_root_domain()
 *       - bp_get_forums_slug()
 * @param  string $query       Words to search
 */

function bp_search_everything_process_topics( $query ) {

	global $bp;
	global $forums_template;

	$max_results = get_option( 'bp-search-everything-max-results' );
	if( !$max_results ) {
		$max_results = 10;
	}

	?>
	<h2 class="post-title"><?php _e( 'Forum Topics', 'bp-search-everything' ); ?></h2>
	<div class="topics-search-result search-result">

	<?php

	if ( bp_has_forum_topics( 'search_terms=' . $query ) ) {

		$topics_found = $forums_template->topic_count;
		$counter = 0;

		while ( bp_forum_topics() ) {

			if( $max_results == $counter )
				break;

			bp_the_forum_topic();
			?>
			<div class="topics-search-result">
				<div class="item-title">
					<a href="<?php bp_the_topic_permalink() ?>"><?php bp_the_topic_title(); ?></a>
				</div>
			</div>
			<?php
			$counter ++;
		}
		?>
		<div class="post-meta">
			<a href="<?php echo bp_get_root_domain().'/'.  bp_get_forums_slug().'/search/'. $query; ?>" ><?php echo __( 'View all found topics', 'bp-search-everything' ) . ' (' . $groups_found . ')';?></a>
		</div>
		<?php
	} else {
		?>
		<div class="post-meta"><?php _e( 'No Topics Found', 'bp-search-everything' ); ?></div>
		<?php
	}
	?>
	</div>
	<?php

}

/**
 * Search activity
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - bp_has_activities()
 *       - bp_activities()
 *       - bp_the_activity()
 *       - bp_activity_avatar()
 *       - bp_activity_action()
 *       - bp_get_root_domain()
 *       - bp_get_activity_slug()
 * @param  string $query       Words to search
 */
function bp_search_everything_process_updates( $query ) {

	global $bp;
	global $activities_template;

	$max_results = get_option( 'bp-search-everything-max-results' );
	if( !$max_results ) {
		$max_results = 10;
	}

	?>
	<h2 class="post-title"><?php _e( 'Updates', 'bp-search-everything' ); ?></h2>
	<div class="topics-search-result search-result">

	<?php

	if ( bp_has_activities( 'search_terms=' . $query ) ) {
		//var_dump($activities_template);

		$updates_found = $activities_template->total_activity_count;
		$counter = 0;

		while ( bp_activities() ) {

			if( $max_results == $counter )
				break;

			bp_the_activity();
			?>
			<div class="topics-search-result">
				<div class="item-avatar">
					<?php bp_activity_avatar(); ?>
				</div>
				<div class="item-title">
					<?php bp_activity_action(); ?>
				</div>
			</div>
			<?php
			$counter ++;
		}
		?>
		<div class="post-meta">
			<a href="<?php echo bp_get_root_domain().'/'.  bp_get_activity_slug().'/?s='. $query; ?>" ><?php echo __( 'View all found updates', 'bp-search-everything' ) . ' (' . $updates_found . ')';?></a>
		</div>
		<?php
	} else {
		?>
		<div class="post-meta"><?php _e( 'No Updates Found', 'bp-search-everything' ); ?></div>
		<?php
	}
	?>
	</div>
	<?php

}

/**
 * Search standard WP content
 *
 * @package BuddyPress Search Everything
 * @since 0.1.0
 * @author Zé Fontainhas
 *
 * @uses - WP_Query()
 *       - have_posts()
 *       - the_post()
 *       - the_title()
 *       - wp_reset_postdata()
 * @param  string $query       Words to search
 */
function bp_search_everything_process_custom( $types, $query ) {

	$args = array(
		'post_type' => $types,
		's' => $query
		);

	$squery = new WP_Query( $args );

	foreach ($types as $type) {
		$object = get_post_type_object( $type );
		$title[] = $object->labels->name;
	}

	$last = array_pop($title);
	$post_title = count($title) ? implode(', ', $title) . __( ', and ', 'bp-search-everything' ) . $last : $last;

	$max_results = get_option( 'bp-search-everything-max-results' );
	if( !$max_results ) {
		$max_results = 10;
	}

	?>
	<h2 class="post-title"><?php echo $post_title; ?></h2>
	<div class="content-search-result search-result">

	<?php

	if ( $squery->have_posts() ) {

		$items_found = $squery->post_count;
		$counter = 0;
		$id = get_the_ID();

		while (  $squery->have_posts() ) {

			$squery->the_post();

			if( $max_results == $counter )
				break;
			?>
			<div class="<?php echo get_post_type( $id ); ?>-search-result">
				<div class="item-title">
					<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
				</div>
			</div>
			<?php
			$counter ++;
		}
		?>
		<div class="post-meta">
			<a href="<?php echo home_url() .'/?s='. $query; ?>" ><?php echo __( 'View all found items', 'bp-search-everything' ) . ' (' . $items_found . ')';?></a>
		</div>
		<?php
	} else {
		?>
		<div class="post-meta"><?php _e( 'No Items Found', 'bp-search-everything' ); ?></div>
		<?php
	}
	?>
	</div>
	<?php

	wp_reset_postdata();
}

