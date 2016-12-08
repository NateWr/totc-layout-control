( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the Gallery component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components.gallery = clc.Models.Component.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				type:           'gallery',
				images:         [],
				order:          0
			};
		}
	});

} )( jQuery );
