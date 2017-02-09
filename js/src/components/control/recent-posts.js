( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Recent Posts form
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentForm
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_controls['recent-posts'] = clc.Views.BaseComponentForm.extend({
		template: wp.template( 'clc-component-recent-posts' ),

		events: {
			'click .clc-toggle-component-form': 'toggleDisplay',
			'click .delete': 'delete',
			'blur [data-clc-setting-link]': 'updateLinkedSetting',
			'change [data-clc-setting-link]': 'updateLinkedSetting',
			'keyup [data-clc-setting-link]': 'updateTextLive',
			'change [data-clc-show-date-link]': 'updateShowDateSetting',
			'reordered': 'reordered',
		},

		/**
		 * Update text inputs in the browser without triggering a full
		 * component refresh
		 *
		 * @since 0.1
		 */
		updateTextLive: function( event ) {
			var target = $( event.target );

			wp.customize.previewer.send(
				'component-setting-changed-' + this.model.get( 'id' ) + '.clc',
				{
					setting: target.data( 'clc-setting-link' ),
					val: target.val()
				}
			);
		},

		/**
		 * Update the show_date setting
		 *
		 * This can't use the updateLinkedSetting helper because it passes the
		 * value whether of a checkbox whether it's checked or not.
		 *
		 * @since 0.1
		 */
		updateShowDateSetting: function( event ) {
			var val = $( event.target ).is( ':checked' ) ? 1 : 0;

			if ( this.model.get( 'show_date' ) === val ) {
				return;
			}

			this.model.set( { show_date: val } );
		}
	});

} )( jQuery );
