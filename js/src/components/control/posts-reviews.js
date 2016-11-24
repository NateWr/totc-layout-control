( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Reviews form
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentForm
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_controls['posts-reviews'] = clc.Views.component_controls.posts.extend({
        template: wp.template( 'clc-component-posts-reviews' ),

		/**
		 * Retrieve search arguments for review lookup
		 *
		 * @since 0.1
		 */
		getSearchArgs: function( search_args ) {
			return { post_type: this.model.get( 'post_types' ) };
		},
    });

} )( jQuery );
