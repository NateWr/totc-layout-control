( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the map component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components.map = clc.Models.Component.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				type:           'map',
				order:          0
			};
		}
	});

} )( jQuery );
