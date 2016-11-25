( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Pages form
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentForm
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_controls['posts-pages'] = clc.Views.component_controls.posts.extend({
        template: wp.template( 'clc-component-posts-pages' ),
    });

} )( jQuery );
