( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the booking form component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components['booking-form'] = clc.Models.Component.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				type:           'booking-form',
				order:          0
			};
		}
	});

} )( jQuery );
