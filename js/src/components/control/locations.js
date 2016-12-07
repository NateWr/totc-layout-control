( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Locations form
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentForm
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_controls.locations = clc.Views.BaseComponentForm.extend({
        template: wp.template( 'clc-component-locations' )
    });

} )( jQuery );
