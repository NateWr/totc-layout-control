( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Pages layout
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.component_previews.posts
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentPreview
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_previews['posts-pages'] = clc.Views.component_previews.posts.extend();

} )( jQuery );
