<?php defined( 'ABSPATH' ) || exit;

include_once( CLC_Content_Layout_Control::$dir . '/components/posts.php' );

/**
 * Posts collection component for menus from the Food and Drink Menu plugin
 *
 * Requires the plugin `food-and-drink-menu`
 *
 * @since 0.1
 */
class TOTCLC_Component_Menus extends CLC_Component_Posts {

	/**
	 * Type of component
	 *
	 * @param string
	 * @since 0.1
	 */
	public $type = 'posts-menus';

	/**
	 * Limit number of menus allowed
	 *
	 * @param int
	 * @since 0.1
	 */
	public $limit_posts = 1;

	/**
	 * Post types to allow
	 *
	 * @since 0.1
	 */
	public $post_types = 'fdm-menu';
}
