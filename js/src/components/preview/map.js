( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Map layout
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentPreview
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_previews.map = clc.Views.BaseComponentPreview.extend({

		/**
		* Inject HTML into the dom
		*
		* @since 0.1
		*/
		injectHTML: function( html ) {

			html += '<a href="#" class="clc-edit-component">' + CLC_Preview_Settings.i18n.edit_component + '</a>';
			this.$el.html( html );

			// Assign a unique ID to this map (since each map is loaded in its
			// own request, they all come back with #bp-map-0 )
			$( '.bp-map' ).each( function( i ) {
				$(this).attr( 'id', 'bp-map-' + i.toString() );
			} );

			// Re-initialize any maps which may have been added
			if ( typeof bp_initialize_map !== 'undefined' && typeof google !== 'undefined' && typeof google.maps != 'undefined' ) {
				bp_initialize_map();
			}
		},
	});

} )( jQuery );
