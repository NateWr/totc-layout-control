<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the Gallery component
 *
 * @param $this->images array List of attachment IDs
 * @since 0.1
 */
?>

<div class="clc-wrapper clc-gallery">
	[gallery link="file" ids="<?php echo esc_attr( join( ',', $this->images ) ); ?>" size="medium"]
</div>
<?php
