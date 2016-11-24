<?php if ( ! defined( 'ABSPATH' ) ) exit;

include_once( CLC_Content_Layout_Control::$dir . '/components/posts.php' );

/**
 * Posts collection component for reviews from the Good Reviews for WP plugin
 *
 * Requires the plugin `good-reviews-wp`
 *
 * @since 0.1
 */
class TOTCLC_Component_Reviews extends CLC_Component_Posts {

	/**
	 * Type of component
	 *
	 * @param string
	 * @since 0.1
	 */
	public $type = 'posts-reviews';

	/**
	 * Limit number of reviews allowed
	 *
	 * @param int
	 * @since 0.1
	 */
	public $limit_posts = 5;

	/**
	 * Post types to allow
	 *
	 * @since 0.1
	 */
	public $post_types = 'grfwp-review';
}
