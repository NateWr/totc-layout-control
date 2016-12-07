( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the locations component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components.locations = clc.Models.Component.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				type:           'locations',
				order:          0
			};
		}
	});

} )( jQuery );
