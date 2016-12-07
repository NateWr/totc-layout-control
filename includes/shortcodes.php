<?php
/**
 * Functions used to define custom shortcodes
 */

/**
 * Print a list of the most recent posts
 *
 * This prints the Recent Posts widget. It uses TotcBase_Widget_Recent_Posts if
 * that class exists. If not, it falls back to WP_Widget_Recent_Posts.
 *
 * @param array $args {
 *  `number` The number of posts to display. Default: 3
 *  `show_date` Whether or not to show the date. Default: true
 * }
 * @since 0.1
 */
function totclc_shortcode_recent_posts( $args = array() ) {

	$defaults = array(
		'number' => 3,
		'show_date' => true,
	);

	$atts = shortcode_atts( $defaults, $args, 'totclc-recent-posts' );

	$widget_class_name = apply_filters(
		'totclc_shortcode_recent_posts_widget_class',
		class_exists( 'TotcBase_Widget_Recent_Posts' ) ? 'TotcBase_Widget_Recent_Posts' : 'WP_Widget_Recent_Posts'
	);

	ob_start();

	the_widget( $widget_class_name, $atts );

	return ob_get_clean();

}
add_shortcode( 'totclc-recent-posts', 'totclc_shortcode_recent_posts' );
