<?php if ( ! defined( 'ABSPATH' ) ) exit;

include_once( CLC_Content_Layout_Control::$dir . '/components/posts.php' );

/**
 * Post collection component for displaying a single Page
 *
 * @since 0.1
 */
class TOTCLC_Component_Pages extends CLC_Component_Posts {

	/**
	 * Type of component
	 *
	 * @param string
	 * @since 0.1
	 */
	public $type = 'posts-pages';

	/**
	 * Limit number of pages allowed
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
	public $post_types = 'page';
}
