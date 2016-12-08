<?php defined( 'ABSPATH' ) || exit;
/**
 * Layout template for the Locations component
 *
 * @since 0.1
 */
global $bpfwp_controller;
if ( isset( $bpfwp_controller ) && $bpfwp_controller->settings->get_setting( 'multiple-locations' ) ) :
	$post_query = new WP_Query( array( 'posts_per_page' => 100, 'post_type' => array( 'location' ) ) );
?>

<div class="clc-wrapper clc-locations">
	<?php while( $post_query->have_posts() ) : $post_query->the_post(); ?>
		<article id="post-<?php echo (int) get_the_ID(); ?>" <?php post_class(); ?>><?php
			?>[contact-card location="<?php echo (int) get_the_ID(); ?>" show_name=0 show_address=0 show_get_directions=0 show_phone=0 show_contact=0 show_booking_link=0 show_opening_hours=0]<?php
			?>[contact-card location="<?php echo (int) get_the_ID(); ?>" show_opening_hours=0 show_map=0]<?php
		?></article><?php
	 endwhile;
	wp_reset_query();
?></div>
<?php
endif;
