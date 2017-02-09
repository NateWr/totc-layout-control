<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the Recent Posts component
 *
 * @since 0.1
 */
error_log( 'hi: ' . $this->show_date );
?>
<div class="clc-wrapper clc-recent-posts clc-recent-posts-<?php echo absint( $this->number ); ?>">
	<h2 class="title"><?php echo esc_html( $this->title ); ?></h2>
	[totclc-recent-posts number="<?php echo absint( $this->number ); ?>" show_date="<?php echo !empty( $this->show_date ) ? '1' : '0'; ?>"]
</div>
