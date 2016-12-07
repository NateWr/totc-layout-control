( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Booking Form layout
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentPreview
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_previews['booking-form'] = clc.Views.BaseComponentPreview.extend({

		/**
		* Inject HTML into the dom
		*
		* @since 0.1
		*/
		injectHTML: function( html ) {

			html += '<a href="#" class="clc-edit-component">' + CLC_Preview_Settings.i18n.edit_component + '</a>';
			this.$el.html( html );

			// Throw a warning if there are more than one booking form on the page
			if ( $( '.rtb-booking-form' ).length > 1 && typeof totclc_preview !== 'undefined' ) {
				alert( totclc_preview.i18n.multiple_booking_forms );
			}

			// Re-initialize any maps which may have been added
			if ( typeof rtb_booking_form !== 'undefined' && typeof rtb_booking_form.init !== 'undefined' ) {
				rtb_booking_form.init();
			}
		},
	});

} )( jQuery );
