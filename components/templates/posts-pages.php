<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the pages component
 *
 * @param $this->items array List of posts
 * @since 0.1
 */
$post_ids = wp_list_pluck( $this->items, 'ID' );
$post_query = new WP_Query( array( 'post__in' => $post_ids, 'post_type' => 'page' ) );
?>

<div class="clc-wrapper clc-posts-pages-<?php echo absint( count( $this->items ) ); ?>">
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
					    printf( esc_html__( 'Read More%1$s about %2$s%3$s', 'totcbase' ), '<span class="screen-reader-text">', esc_html( get_the_title() ), '</span>' );
					?>
				</a>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	<?php endwhile; ?>
</div>
<?php
wp_reset_query();
