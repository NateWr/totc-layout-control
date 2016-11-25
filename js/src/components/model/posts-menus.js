( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * Model class for the Menus component
	 *
	 * @augments Backbone.Model
	 * @since 0.1
	 */
	clc.Models.components['posts-menus'] = clc.Models.components.posts.extend({
		defaults: function() {
			return {
				name:           '',
				description:    '',
				type:           'posts-menus',
				title:          '',
				items:          [],
				limit_posts:    1,
				post_types:     'fdm-menu',
				order:          0
			};
		}
	});

} )( jQuery );
