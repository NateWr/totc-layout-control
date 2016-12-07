<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the pages component
 *
 * @param $this->items array List of posts
 * @since 0.1
 */
$post_ids = join( ',', wp_list_pluck( $this->items, 'ID' ) );
?>

<div class="clc-wrapper clc-posts-pages-<?php echo absint( count( $this->items ) ); ?>">
	[totclc-pages post_ids="<?php echo esc_attr( $post_ids ); ?>"]
</div>
