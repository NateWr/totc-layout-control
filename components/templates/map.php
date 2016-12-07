<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the Map component
 *
 * @since 0.1
 */
global $bpfwp_controller;
if ( isset( $bpfwp_controller ) && $bpfwp_controller->settings->get_setting( 'address' ) ) :
?>

<div class="clc-wrapper clc-opening-hours">
	[contact-card show_name=0 show_address=0 show_get_directions=0 show_phone=0 show_contact=0 show_booking_link=0 show_opening_hours=0]
</div>
<?php
endif;
