<?php defined( 'ABSPATH' ) || exit;
/**
 * Upcoming Events component
 *
 * @since 0.1
 */
class TOTCLC_Component_UpcomingEvents extends CLC_Component {

	/**
	 * Type of component
	 *
	 * @param string
	 * @since 0.1
	 */
	public $type = 'upcoming-events';

	/**
	 * Number of posts to display
	 *
	 * @param int
	 * @since 0.1
	 */
	public $number = 3;

	/**
	 * Title to accompany the list
	 *
	 * @param string
	 * @since 0.1
	 */
	public $title = '';

	/**
	 * Maximum number of posts allowed
	 *
	 * @param int
	 * @since 0.1
	 */
	public $limit_posts = 10;

	/**
	 * Settings expected by this component
	 *
	 * @param array Setting keys
	 * @since 0.1
	 */
	public $settings = array( 'number', 'title' );

	/**
	 * Sanitize settings
	 *
	 * @param array val Values to be sanitized
	 * @return array
	 * @since 0.1
	 */
	public function sanitize( $val ) {

		return array(
			'id'             => isset( $val['id'] ) ? absint( $val['id'] ) : 0,
			'number'         => isset( $val['number'] ) ? absint( $val['number'] ) : $this->number,
			'title'          => isset( $val['title'] ) ? sanitize_text_field( $val['title'] ) : '',
			'order'          => isset( $val['order'] ) ? absint( $val['order'] ) : 0,
			'type'           => $this->type, // Don't allow this to be modified
		);
	}

	/**
	 * Get meta attributes
	 *
	 * @since 0.1
	 */
	public function get_meta_attributes() {

		$atts = parent::get_meta_attributes();
		$atts['limit_posts'] = $this->limit_posts;

		return $atts;
	}
}
