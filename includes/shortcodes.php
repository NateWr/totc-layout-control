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
 *  `number` int The number of posts to display. Default: 3
 *  `show_date` bool Whether or not to show the date. Default: true
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
		class_exists( 'Totc_Widget_Recent_Posts' ) ? 'Totc_Widget_Recent_Posts' : 'WP_Widget_Recent_Posts'
	);

	ob_start();

	the_widget( $widget_class_name, $atts );

	return ob_get_clean();

}
add_shortcode( 'totclc-recent-posts', 'totclc_shortcode_recent_posts' );

/**
* Print a title, excerpt, thumbnail and read more link for a single post or a
* collection of posts.
*
* Expects to be Pages or Page-like content, so no date or author information is
* printed.
*
* @param array $args {
*  `post_ids` string List of post IDs, separated by a comma. Required
*  `post_type` string List of post type(s) to display. Default: 'page'
* }
* @since 0.1
*/
function totclc_shortcode_pages( $args = array() ) {

	$defaults = array(
		'post_ids'  => '',
		'post_type' => 'page',
	);

	$atts = shortcode_atts( $defaults, $args, 'totclc-pages' );

	$post_type = explode( ',', $atts['post_type'] );

	if ( !isset( $atts['post_ids'] ) ) {
		return '';
	} else {
		$post_ids = explode( ',', $atts['post_ids'] );
	}

	$post_query = new WP_Query( array( 'post__in' => $post_ids, 'post_type' => $post_type ) );

	ob_start();
	?>

	<?php while( $post_query->have_posts() ) : $post_query->the_post(); ?>
		<article id="post-<?php echo (int) get_the_ID(); ?>" <?php post_class(); ?>>
			<?php the_post_thumbnail(); ?>
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>" class="more">
					<?php
					    // Translators: 1 and 3 are an opening and closing <span> tag. 2 is the post title.
					    printf( esc_html__( 'Read More%1$s about %2$s%3$s', 'totc-layout-control' ), '<span class="screen-reader-text">', esc_html( get_the_title() ), '</span>' );
					?>
				</a>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	<?php endwhile; ?>
	<?php
	wp_reset_query();

	return ob_get_clean();
}
add_shortcode( 'totclc-pages', 'totclc_shortcode_pages' );

/**
* Print a list of all locations
*
* @since 0.1
*/
function totclc_shortcode_locations() {

	global $bpfwp_controller;
	if ( !isset( $bpfwp_controller ) || !$bpfwp_controller->settings->get_setting( 'multiple-locations' ) ) {
		return '';
	}

	$post_query = new WP_Query( array( 'posts_per_page' => 100, 'post_type' => array( 'location' ) ) );

	ob_start();

	if ( $post_query->have_posts() ) : ?>
		<div class="clc-wrapper clc-locations-<?php echo absint( $post_query->found_posts ); ?>">
			<?php
				while( $post_query->have_posts() ) : $post_query->the_post(); ?>
					<article id="post-<?php echo (int) get_the_ID(); ?>" <?php post_class(); ?>>
						<?php
							bpwfwp_print_map( get_the_ID() );
							echo bpwfwp_print_contact_card(
								array(
									'location'                  => get_the_ID(),
									'show_name'					=> true,
									'show_address'				=> true,
									'show_get_directions'		=> true,
									'show_phone'				=> true,
									'show_contact'				=> true,
									'show_opening_hours'		=> false,
									'show_opening_hours_brief'	=> false,
									'show_map'					=> false,
								)
							);
						?>
					</article>
				<?php
				endwhile;
				wp_reset_query();
			?>
		</div>
	<?php
	endif;

	return ob_get_clean();
}
add_shortcode( 'totclc-locations', 'totclc_shortcode_locations' );
