( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Menus form
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentForm
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_controls['posts-menus'] = clc.Views.component_controls.posts.extend({
        template: wp.template( 'clc-component-posts-menus' ),
    });

} )( jQuery );
