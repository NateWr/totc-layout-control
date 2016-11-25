( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the Opening Hours component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components['opening-hours'] = clc.Models.Component.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				type:           'opening-hours',
				order:          0
			};
		}
	});

} )( jQuery );
