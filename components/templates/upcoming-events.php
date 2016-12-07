<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the Upcoming Events component
 *
 * @since 0.1
 */
?>
<div class="clc-wrapper clc-recent-posts clc-recent-posts-<?php echo absint( $this->number ); ?>">
	<h2 class="title"><?php echo esc_html( $this->title ); ?></h2>
	[eo_events numberposts="<?php echo absint( $this->number ); ?>" showpastevents="false"]
</div>
