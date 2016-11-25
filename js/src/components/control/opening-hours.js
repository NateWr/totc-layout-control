( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Opening Hours form
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentForm
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_controls['opening-hours'] = clc.Views.BaseComponentForm.extend({
        template: wp.template( 'clc-component-opening-hours' )
    });

} )( jQuery );
