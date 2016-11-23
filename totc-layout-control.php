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

		// Initialize the plugin
		add_action( 'init', array( $this, 'load_textdomain' ) );

	}

	/**
	 * Load the plugin textdomain for localistion
	 *
	 * @since 0.1.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'totc-layout-control', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
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
