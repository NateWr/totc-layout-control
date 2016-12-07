( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the Recent posts component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components['recent-posts'] = clc.Models.Component.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				number:         3,
				title:          '',
				type:           'recent-posts',
				order:          0
			};
		}
	});

} )( jQuery );
