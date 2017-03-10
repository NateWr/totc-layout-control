<?php if ( ! defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'CLC_Component_Gallery' ) ) {
	/**
	 * Image gallery layout component
	 *
	 * @since 0.1
	 */
	class CLC_Component_Gallery extends CLC_Component {

		/**
		 * Type of component
		 *
		 * @param string
		 * @since 0.1
		 */
		public $type = 'gallery';

		/**
		 * Images (attachment IDs)
		 *
		 * @param array
		 * @since 0.1
		 */
		public $images = array();

		/**
		 * Columns (gallery shortcode columns attribute)
		 *
		 * @param int
		 * @since 0.1
		 */
		public $columns = 5;

		/**
		 * Image size to use for thumbnails
		 *
		 * @param string
		 * @since 0.1
		 */
		public $size = 'medium';

		/**
		 * Settings expected by this component
		 *
		 * @param array Setting keys
		 * @since 0.1
		 */
		public $settings = array( 'images', 'columns', 'size' );

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
				'images'         => isset( $val['images'] ) ? array_map( 'absint', $val['images'] ) : $this->images,
				'columns'        => isset( $val['columns'] ) ? absint( $val['columns'] ) : 5,
				'size'           => isset( $val['size'] ) ? sanitize_text_field( $val['size'] ) : 'medium',
				'order'          => isset( $val['order'] ) ? absint( $val['order'] ) : 0,
				'type'           => $this->type, // Don't allow this to be modified
			);
		}

		/**
		 * Register custom endpoint to transform image IDs into thumb URLs
		 *
		 * @since 0.1
		 */
		public function register_endpoints() {
			register_rest_route(
				'content-layout-control/v1',
				'/components/gallery/thumb-urls/(?P<ids>.+)',
				array(
					'methods'   => 'GET',
					'callback' => array( $this, 'api_get_thumb_urls' ),
					'permission_callback' => array( CLC_Content_Layout_Control(), 'current_user_can' ),
				)
			);
		}

		/**
		 * API endpoint: transform an image ID into the thumbnail URL
		 *
		 * @since 0.1
		 */
		public function api_get_thumb_urls( WP_REST_Request $request ) {

			if ( !isset( $request['ids'] ) ) {
				return '';
			}

			$ids = explode( ',', $request['ids'] );
			$urls = array();
			foreach( $ids as $id ) {
				$img = wp_get_attachment_image_src( absint( $id ), 'medium' );
				$urls[] = is_array( $img ) ? $img[0] : '';
			}

			return $urls;
		}
	}
}
