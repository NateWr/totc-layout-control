<?php
/**
 * Plugin Name: Theme of the Crop Layout Control
 * Plugin URI: https://themeofthecrop.com
 * Description: Beautiful homepage layouts for themes from Theme of the Crop.
 * Version: 0.1.0
 * Author: Theme of the Crop
 * Author URI: https://themeofthecrop.com
 * License:     GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: totc-layout-control
 * Domain Path: /languages/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
defined( 'ABSPATH' ) || exit;

class totclcInit {

	/**
	 * The single instance of this class
	 *
	 * @param totclcInit
	 */
	private static $instance;

	/**
	 * Path to the plugin directory
	 *
	 * @param string
	 */
	static $plugin_dir;

	/**
	 * URL to the plugin
	 *
	 * @param string
	 */
	static $plugin_url;

	/**
	 * Create or retrieve the single instance of the class
	 *
	 * @since 0.1.0
	 */
	public static function instance() {

		if ( !isset( self::$instance ) ) {

			self::$instance = new totclcInit();

			self::$plugin_dir = untrailingslashit( plugin_dir_path( __FILE__ ) );
			self::$plugin_url = untrailingslashit( plugin_dir_url( __FILE__ ) );

			self::$instance->init();
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin and register hooks
	 *
	 * @since 0.1.0
	 */
	public function init() {

		add_action( 'init', array( $this, 'load_textdomain' ) );
		add_action( 'after_setup_theme', array( $this, 'load_controller' ), 100 );
	}

	/**
	 * Load the plugin textdomain for localistion
	 *
	 * @since 0.1.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'totc-layout-control', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Load the content-layout-control controller class
	 *
	 * @since 0.1.0
	 */
	public function load_controller() {

		if ( !get_theme_support( 'totc-layout-control' ) ) {
			return;
		}

		include_once( self::$plugin_dir . '/lib/content-layout-control/dist/content-layout-control.php' );
		$args['url'] = self::$plugin_url . '/lib/content-layout-control/dist';
		CLC_Content_Layout_Control(
			array(
				'url'  => self::$plugin_url . '/lib/content-layout-control/dist',
				'i18n' => array(
					'delete'         => esc_html__( 'Delete', 'totc-layout-control' ),
					'control-toggle' => esc_html__( 'Open/close this component', 'totc-layout-control' ),
				)
			)
		);

		add_filter( 'clc_register_components', array( $this, 'register_components' ) );
		add_filter( 'customize_register', array( $this, 'customize_register' ) );
		add_filter( 'clc_component_render_template_dirs', array( $this, 'add_render_template_dir' ) );
		add_filter( 'clc_component_control_template_dirs', array( $this, 'add_control_template_dir' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_assets' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue_preview_assets' ) );

		include_once( self::$plugin_dir . '/includes/shortcodes.php' );
	}

	/**
	 * Register the layout components provided by this plugin
	 *
	 * @param array Components already registered
	 * @since 0.1.0
	 */
	public function register_components( $components ) {

		$supported_components = $this->get_theme_support( 'components' );

		foreach( $supported_components as $component ) {
			switch( $component ) {

				case 'content-block' :
					$components['content-block'] = array(
						'file' => self::$plugin_dir . '/lib/content-layout-control/dist/components/content-block.php',
						'class' => 'CLC_Component_Content_Block',
						'name' => esc_html__( 'Content Block', 'totc-layout-control' ),
						'description' => esc_html__( 'A simple content block with an image, title, text and links.', 'totc-layout-control' ),
						'i18n' =>  array(
							'title'                => esc_html__( 'Title', 'totc-layout-control' ),
							'content'              => esc_html__( 'Content', 'totc-layout-control' ),
							'image'                => esc_html__( 'Image', 'totc-layout-control' ),
							'image_placeholder'    => esc_html__( 'No image selected', 'totc-layout-control' ),
							'image_position'       => esc_html__( 'Image Position', 'totc-layout-control' ),
							'image_position_left'  => esc_html__( 'Left', 'totc-layout-control' ),
							'image_position_right' => esc_html__( 'Right', 'totc-layout-control' ),
							'image_select_button'  => esc_html__( 'Select Image', 'totc-layout-control' ),
							'image_change_button'  => esc_html__( 'Change Image', 'totc-layout-control' ),
							'image_remove_button'  => esc_html__( 'Remove', 'totc-layout-control' ),
							'links'                => esc_html__( 'Links', 'totc-layout-control' ),
							'links_add_button'     => esc_html__( 'Add Link', 'totc-layout-control' ),
							'links_remove_button'  => esc_html__( 'Remove', 'totc-layout-control' ),
						),
					);
					break;

				case 'posts' :
					$components['posts'] = array(
						'file' => self::$plugin_dir . '/lib/content-layout-control/dist/components/posts.php',
						'class' => 'CLC_Component_Posts',
						'name' => esc_html__( 'Posts', 'totc-layout-control' ),
						'description' => esc_html__( 'Display one or more posts.', 'totc-layout-control' ),
						'limit_posts' => 3,
						'i18n' =>  array(
							'posts_loading'       => esc_html__( 'Loading', 'totc-layout-control' ),
							'posts_remove_button' => esc_html__( 'Remove', 'totc-layout-control' ),
							'placeholder'         => esc_html__( 'No post selected.', 'totc-layout-control' ),
							'posts_add_button'    => esc_html__( 'Add Post', 'totc-layout-control' ),
						),
					);
					break;

				case 'posts-reviews' :
					if ( !is_plugin_active( 'good-reviews-wp/good-reviews-wp.php' ) ) {
						break;
					}
					$components['posts-reviews'] = array(
						'file' => self::$plugin_dir . '/components/posts-reviews.php',
						'class' => 'TOTCLC_Component_Reviews',
						'name' => esc_html__( 'Reviews', 'totc-layout-control' ),
						'description' => esc_html__( 'Display one or more reviews.', 'totc-layout-control' ),
						'i18n' =>  array(
							'posts_loading'       => esc_html__( 'Loading', 'totc-layout-control' ),
							'posts_remove_button' => esc_html__( 'Remove', 'totc-layout-control' ),
							'placeholder'         => esc_html__( 'No review selected.', 'totc-layout-control' ),
							'posts_add_button'    => esc_html__( 'Add Review', 'totc-layout-control' ),
						),
					);
					break;

				case 'posts-menus' :
					if ( !is_plugin_active( 'food-and-drink-menu/food-and-drink-menu.php' ) ) {
						break;
					}
					$components['posts-menus'] = array(
						'file' => self::$plugin_dir . '/components/posts-menus.php',
						'class' => 'TOTCLC_Component_Menus',
						'name' => esc_html__( 'Restaurant Menu', 'totc-layout-control' ),
						'description' => esc_html__( 'Display your restaurant menu.', 'totc-layout-control' ),
						'i18n' =>  array(
							'posts_loading'       => esc_html__( 'Loading', 'totc-layout-control' ),
							'posts_remove_button' => esc_html__( 'Remove', 'totc-layout-control' ),
							'placeholder'         => esc_html__( 'No menu selected.', 'totc-layout-control' ),
							'posts_add_button'    => esc_html__( 'Add Menu', 'totc-layout-control' ),
						),
					);
					break;

				case 'posts-pages' :
					$components['posts-pages'] = array(
						'file' => self::$plugin_dir . '/components/posts-pages.php',
						'class' => 'TOTCLC_Component_Pages',
						'name' => esc_html__( 'Page', 'totc-layout-control' ),
						'limit_posts' => 1,
						'description' => esc_html__( 'Display a page title and excerpt.', 'totc-layout-control' ),
						'i18n' =>  array(
							'posts_loading'       => esc_html__( 'Loading', 'totc-layout-control' ),
							'posts_remove_button' => esc_html__( 'Remove', 'totc-layout-control' ),
							'placeholder'         => esc_html__( 'No page selected.', 'totc-layout-control' ),
							'posts_add_button'    => esc_html__( 'Add Page', 'totc-layout-control' ),
						),
					);
					break;

				case 'opening-hours' :
					if ( !is_plugin_active( 'business-profile/business-profile.php' ) ) {
						break;
					}
					$components['opening-hours'] = array(
						'file' => self::$plugin_dir . '/components/opening-hours.php',
						'class' => 'TOTCLC_Component_Opening_Hours',
						'name' => esc_html__( 'Opening Hours', 'totc-layout-control' ),
						'limit_posts' => 1,
						'description' => esc_html__( 'Display the opening hours from your Business Profile.', 'totc-layout-control' ),
						'i18n'          => array(
							'description' => sprintf( esc_html__( 'To change your opening hours, edit your %sBusiness Profile%s.', 'totc-layout-control' ), '<a href="' . esc_url( admin_url( 'admin.php?page=bpfwp-settings' ) ) . '">', '</a>' ),
						),
					);
					break;

				case 'map' :
					if ( !is_plugin_active( 'business-profile/business-profile.php' ) ) {
						break;
					}
					$components['map'] = array(
						'file' => self::$plugin_dir . '/components/map.php',
						'class' => 'TOTCLC_Component_Map',
						'name' => esc_html__( 'Map', 'totc-layout-control' ),
						'limit_posts' => 1,
						'description' => esc_html__( 'Display a map of the address in your Business Profile.', 'totc-layout-control' ),
						'i18n'          => array(
							'description' => sprintf( esc_html__( 'To change your address, edit your %sBusiness Profile%s.', 'totc-layout-control' ), '<a href="' . esc_url( admin_url( 'admin.php?page=bpfwp-settings' ) ) . '">', '</a>' ),
						),
					);
					break;

				case 'booking-form' :
					if ( !is_plugin_active( 'restaurant-reservations/restaurant-reservations.php' ) ) {
						break;
					}
					$components['booking-form'] = array(
						'file' => self::$plugin_dir . '/components/booking-form.php',
						'class' => 'TOTCLC_Component_BookingForm',
						'name' => esc_html__( 'Booking Form', 'totc-layout-control' ),
						'limit_posts' => 1,
						'description' => esc_html__( 'The booking form for taking online reservations.', 'totc-layout-control' ),
						'i18n'          => array(
							'description' => sprintf( esc_html__( 'To configure your Booking Form, visit %sBookings > Settings%s.', 'totc-layout-control' ), '<a href="' . esc_url( admin_url( 'admin.php?page=rtb-settings' ) ) . '">', '</a>' ),
						),
					);
					break;

				case 'recent-posts' :
					$components['recent-posts'] = array(
						'file' => self::$plugin_dir . '/components/recent-posts.php',
						'class' => 'TOTCLC_Component_RecentPosts',
						'name' => esc_html__( 'Recent Posts', 'totc-layout-control' ),
						'limit_posts' => 10,
						'description' => esc_html__( 'A list of your most recent posts.', 'totc-layout-control' ),
						'i18n'          => array(
							'title' => __( 'Title', 'totc-layout-control' ),
							'number_label' => __( 'Number of posts to show', 'totc-layout-control' ),
							'show_date' => __( 'Display the published date with each post.', 'totc-layout-control' ),
						),
					);
					break;

				case 'upcoming-events' :
					if ( !is_plugin_active( 'event-organiser/event-organiser.php' ) ) {
						break;
					}
					$components['upcoming-events'] = array(
						'file' => self::$plugin_dir . '/components/upcoming-events.php',
						'class' => 'TOTCLC_Component_UpcomingEvents',
						'name' => esc_html__( 'Upcoming Events', 'totc-layout-control' ),
						'limit_posts' => 10,
						'description' => esc_html__( 'A list of your upcoming events.', 'totc-layout-control' ),
						'i18n'          => array(
							'title' => __( 'Title', 'totc-layout-control' ),
							'number_label' => __( 'Number of events to show', 'totc-layout-control' ),
						),
					);
					break;

				case 'locations' :
					global $bpfwp_controller;
					if ( isset( $bpfwp_controller ) && !$bpfwp_controller->settings->get_setting( 'multiple-locations' ) ) {
						break;
					}
					$components['locations'] = array(
						'file' => self::$plugin_dir . '/components/locations.php',
						'class' => 'TOTCLC_Component_Locations',
						'name' => esc_html__( 'Locations', 'totc-layout-control' ),
						'limit_posts' => 10,
						'description' => esc_html__( 'Show a map and contact details for each of your locations.', 'totc-layout-control' ),
						'i18n'          => array(
							'description' => sprintf( esc_html__( 'To edit your locations or add new ones, visit the %sLocations%s page.', 'totc-layout-control' ), '<a href="' . esc_url( admin_url( 'edit.php?post_type=location' ) ) . '">', '</a>' ),
						),
					);
					break;

				case 'gallery' :
					$components['gallery'] = array(
						'file' => self::$plugin_dir . '/components/gallery.php',
						'class' => 'CLC_Component_Gallery',
						'name' => esc_html__( 'Photo Gallery', 'totc-layout-control' ),
						'description' => esc_html__( 'A collection of images.', 'totc-layout-control' ),
						'i18n' =>  array(
							'image'                => esc_html__( 'Images', 'totc-layout-control' ),
							'image_placeholder'    => esc_html__( 'No images selected', 'totc-layout-control' ),
							'image_select_button'  => esc_html__( 'Select Images', 'totc-layout-control' ),
							'image_change_button'  => esc_html__( 'Change Images', 'totc-layout-control' ),
						),
					);
					break;
			}
		}

		return $components;
	}

	/**
	 * Register the content-layout-control with the customizer
	 *
	 * @since 0.1.0
	 */
	public function customize_register( $wp_customize ) {

		$wp_customize->add_section(
			'content_layout_control',
			array(
				'capability' => 'edit_posts',
				'title' => $this->get_theme_support( 'control_title' ),
			)
		);

		$wp_customize->add_setting(
			'content_layout_control',
			array(
				'sanitize_callback' => 'CLC_Content_Layout_Control::sanitize',
				'transport' => 'postMessage',
				'type' => 'content_layout',
			)
		);

		$wp_customize->add_control(
			new CLC_WP_Customize_Content_Layout_Control(
				$wp_customize,
				'content_layout_control',
				array(
					'section' => 'content_layout_control',
					'priority' => 1,
					'components' => $this->get_theme_support( 'components' ),
					'active_callback' => $this->get_theme_support( 'active_callback' ),
					'i18n' => array(
						'add_component'                 => esc_html__( 'Add Component', 'clc-demo-theme' ),
						'edit_component'                => esc_html__( 'Edit', 'clc-demo-theme' ),
						'close'                         => esc_attr__( 'Close', 'clc-demo-theme' ),
						'post_search_label'             => esc_html__( 'Search content', 'clc-demo-theme' ),
						'links_add_button'              => esc_html__( 'Add Link', 'clc-demo-theme' ),
						'links_url'                     => esc_html__( 'URL', 'clc-demo-theme' ),
						'links_text'                    => esc_html__( 'Link Text', 'clc-demo-theme' ),
						'links_search_existing_content' => esc_html__( 'Search existing content &rarr;', 'clc-demo-theme' ),
						'links_back'                    => esc_html__( '&larr; Back to link form', 'clc-demo-theme' ),
					),
				)
			)
		);
	}

	/**
	 * A callback function to display the editor only on the homepage
	 *
	 * @since 0.1.0
	 */
	static public function active_callback() {
		return is_page() && is_front_page();
	}

	/**
	 * Add the directory for this plugin's component render templates
	 *
	 * @param array $dirs List of dirs to search in
	 * @since 0.1.0
	 */
	public function add_render_template_dir( $dirs ) {
		array_unshift( $dirs, self::$plugin_dir . '/components/templates' );
		return $dirs;
	}

	/**
	 * Add the directory for this plugin's component control templates
	 *
	 * @param array $dirs List of dirs to search in
	 * @since 0.1.0
	 */
	public function add_control_template_dir( $dirs ) {
		array_unshift( $dirs, self::$plugin_dir . '/js/templates/components' );
		return $dirs;
	}

	/**
	 * Enqueue the assets required for the customizer control pane
	 *
	 * @since  0.1.0
	 */
	public function enqueue_control_assets() {
		$min = SCRIPT_DEBUG ? '' : 'min.';
		wp_enqueue_script( 'totclc-customizer-control-js', self::$plugin_url . '/js/customizer-control.' . $min . 'js', array( 'customize-controls', 'content-layout-control-js' ), '0.1.0', true );
	}

	/**
	 * Enqueue the assets required for the customizer preview pane
	 *
	 * @since 0.1.0
	 */
	public function enqueue_preview_assets() {

		$min = SCRIPT_DEBUG ? '' : 'min.';
		wp_enqueue_script( 'totclc-customizer-preview-js', self::$plugin_url . '/js/customizer-preview.' . $min . 'js', array( 'customize-preview', 'content-layout-preview-js' ), '0.1.0', true );

		wp_localize_script(
			'totclc-customizer-preview-js',
			'totclc_preview',
			array(
				'i18n' => array(
					'multiple_booking_forms' => __( 'You can only have one instance of the booking form on a page at once. Please remove any extra Booking Form components.', 'totc-layout-control' ),
				),
			)
		);

		// Enqueue assets from plugins when active
		if ( function_exists( 'rtb_enqueue_assets' ) ) {
			global $rtb_controller;
			$rtb_controller->register_assets();
			rtb_enqueue_assets();
		}

		if ( class_exists( 'bpfwpInit' ) ) {
			add_action( 'wp_footer', array( $this, 'load_bpfwp_map_handlers' ) );
		}
	}

	/**
	 * Print a hidden map using Business Profile's native functions to ensure
	 * that the map handler is loaded and initialized properly. This is used by
	 * the customizer to ensure that if a map is loaded in during customization,
	 * it will update properly.
	 *
	 * @since 0.1.0
	 */
	public function load_bpfwp_map_handlers() {

		if ( !function_exists( 'bpwfwp_print_map' ) ) {
			return;
		}
		?>

		<div style="display:none;">
			<?php bpwfwp_print_map(); ?>
		</div>

		<?php
	}

	/**
	 * Wrapper function for get_theme_support which queries specific support
	 * params
	 *
	 * @param string $setting Key in array of theme support values
	 * @since 0.1.0
	 */
	public function get_theme_support( $setting ) {

		$supports = get_theme_support( 'totc-layout-control' );

		$defaults = array(
			'components' => array(
				'content-block',
				'posts-reviews',
				'posts-menus',
				'posts-pages',
				'opening-hours',
				'map',
				'booking-form',
				'recent-posts',
				'upcoming-events',
				'locations',
				'gallery',
			),
			'active_callback' => array( 'totclcInit', 'active_callback' ),
			'control_title' => __( 'Homepage Editor', 'totc-layout-control' ),
		);

		if ( !$supports ) {
			return isset( $defaults[$setting] ) ? $defaults[$setting] : null;
		}

		if ( is_array( $supports ) ) {
			$supports = reset( $supports );
		}

		if ( isset( $supports[$setting] ) ) {
			return $supports[$setting];
		} elseif ( isset( $defaults[$setting] ) ) {
			return $defaults[$setting];
		}
	}
}

/**
 * This function returns one totclcInit instance everywhere
 * and can be used like a global, without needing to declare the global.
 *
 * Example: $totclc = totclcInit();
 */
function totclcInit() {
	return totclcInit::instance();
}
add_action( 'plugins_loaded', 'totclcInit' );
