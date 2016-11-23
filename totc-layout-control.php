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
	}

	/**
	 * Register the layout components provided by this plugin
	 *
	 * @param array Components already registered
	 * @since 0.1.0
	 */
	public function register_components( $components ) {

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
				'title' => __( 'Homepage Editor', 'totc-layout-control' ),
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
					'components' => array( 'content-block', 'posts' ),
					'active_callback' => array( 'totclcInit', 'active_callback' ),
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
