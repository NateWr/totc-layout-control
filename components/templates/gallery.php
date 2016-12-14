<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the Gallery component
 *
 * @since 0.1
 */
?>

<div class="clc-wrapper clc-gallery">
	[gallery link="file" ids="<?php echo esc_attr( join( ',', $this->images ) ); ?>"]
</div>
<?php
