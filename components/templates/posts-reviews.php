<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the reviews component
 *
 * @param $this->items array List of posts
 * @since 0.1
 */
?>

<div class="clc-wrapper clc-posts-reviews-<?php echo absint( count( $this->items ) ); ?>">
	<?php
		foreach( $this->items as $post ) {
			if ( empty( $post['ID'] ) ) { continue; }
			echo '[good-reviews review=' . absint( $post['ID'] ) . ']';
		}
	?>
</div>
<?php
