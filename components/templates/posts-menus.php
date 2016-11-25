<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the Menu component
 *
 * @param $this->items array List of posts
 * @since 0.1
 */
?>
<div class="clc-wrapper clc-posts-menus-<?php echo absint( count( $this->items ) ); ?>">
	<?php foreach( $this->items as $post ) : ?>
		<?php if ( empty( $post['ID'] ) ) { continue; } ?>
		[fdm-menu id=<?php echo absint( $post['ID'] ); ?>]
	<?php endforeach; ?>
</div>
<?php
