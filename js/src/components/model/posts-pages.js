( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the Pages component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components['posts-pages'] = clc.Models.components.posts.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				type:           'posts-pages',
				title:          '',
				items:          [],
				limit_posts:    1,
				post_types:     'page',
				order:          0
			};
		}
	});

} )( jQuery );
