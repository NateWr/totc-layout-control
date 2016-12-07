<?php defined( 'ABSPATH' ) || exit;
/**
 * Locations component
 *
 * @since 0.1
 */
class TOTCLC_Component_Locations extends CLC_Component {

	/**
	 * Type of component
	 *
	 * @param string
	 * @since 0.1
	 */
	public $type = 'locations';

	/**
	 * Settings expected by this component
	 *
	 * @param array Setting keys
	 * @since 0.1
	 */
	public $settings = array();

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
			'order'          => isset( $val['order'] ) ? absint( $val['order'] ) : 0,
			'type'           => $this->type, // Don't allow this to be modified
		);
	}
}
