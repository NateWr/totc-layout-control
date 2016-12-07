( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the Upcoming Events component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components['upcoming-events'] = clc.Models.Component.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				number:         3,
				title:          '',
				type:           'upcoming-events',
				order:          0
			};
		}
	});

} )( jQuery );
