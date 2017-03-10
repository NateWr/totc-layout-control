<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the Gallery component
 *
 * @param $this->images array List of attachment IDs
 * @param $this->columns int Number of columns for the gallery
 * @param $this->size string Image size to use
 * @since 0.1
 */
?>

<div class="clc-wrapper clc-gallery">
	[gallery link="file" ids="<?php echo esc_attr( join( ',', $this->images ) ); ?>" columns="<?php echo absint( $this->columns ); ?>" size="<?php echo esc_attr( $this->size ); ?>"]
</div>
<?php
