( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Recent Posts layout
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.component_previews.posts
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentPreview
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_previews['recent-posts'] = clc.Views.component_previews.posts.extend({
		/**
		 * Initialize
		 *
		 * @since 0.1
		 */
		initialize: function( options ) {
			this.listenTo( this.model, 'change', this.load );
			_.bindAll( this, 'settingChanged' );
			wp.customize.preview.bind( 'component-setting-changed-' + this.model.get( 'id' ) +'.clc', this.settingChanged );
		},

		/**
		 * Update the text settings immediately in the browser
		 *
		 * @since 0.1
		 */
		settingChanged: function( data ) {
			if ( data.setting == 'number' || data.setting == 'show_date' ) {
				this.load();
			} else {
				this.$el.find( '.' + data.setting ).html( data.val );
			}
		},
	});

} )( jQuery );
