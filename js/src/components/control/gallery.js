( function( $ ) {

	var clc = wp.customize.ContentLayoutControl;

	/**
	 * View class for the Gallery form
	 *
	 * @augments wp.customize.ContentLayoutControl.Views.BaseComponentForm
	 * @augments wp.Backbone.View
	 * @since 0.1
	 */
	clc.Views.component_controls.gallery = clc.Views.BaseComponentForm.extend({
		template: wp.template( 'clc-component-gallery' ),

		className: 'clc-component-gallery',

		events: {
			'click .clc-toggle-component-form': 'toggleDisplay',
			'click .delete': 'delete',
			'blur [data-clc-setting-link]': 'updateLinkedSetting',
			'reordered': 'reordered',
			'click .select-image': 'openMedia',
		},

		image_thumb_urls: [],

		render: function() {
			wp.Backbone.View.prototype.render.apply( this );

			if ( this.image_thumb_urls.length && this.model.get( 'images' ).length ) {
				this.renderThumbs();

			// Fetch the thumbnail URL from the server if we don't yet have one
		} else if ( this.model.get( 'images' ).length ) {
				$.ajax({
					url: CLC_Control_Settings.root + '/content-layout-control/v1/components/gallery/thumb-urls/' + this.model.get( 'images' ).join( ',' ),
					type: 'GET',
					beforeSend: function( xhr ) {
						xhr.setRequestHeader( 'X-WP-Nonce', CLC_Control_Settings.nonce );
					},
					complete: _.bind( function( r ) {
						var urls = [];
						if ( typeof r.success !== 'undefined' && r.success() && typeof r.responseJSON !== 'undefined' ) {
							urls = r.responseJSON;
						}

						this.image_thumb_urls = urls;
						this.renderThumbs();
					}, this )
				});
			}
		},

		/**
		 * Open the media modal
		 *
		 * @since 0.1
		 */
		openMedia: function( event ) {
			event.preventDefault();

			if ( !this.media ) {
				this.initMedia();
			}

			this.media.open();

		},

		/**
		 * Create a media modal
		 *
		 * @since 0.1
		 */
		initMedia: function() {
			this.media = wp.media({
				state: 'gallery-library',
				frame: 'post',
			});
			this.media.on( 'close', _.bind( this.selectImage, this ) );
		},

		/**
		 * Receive the selected images from the media modal and assign them to
		 * the control
		 *
		 * @since 0.1
		 */
		selectImage: function() {
			var attachments = [],
				image_thumb_urls = [],
				library = this.media.states.get( {id: 'gallery-edit'} ).get( 'library' );

			library.each( function( model, i, collection )  {

				attachments.push( model.get( 'id') );

				if ( typeof model.get( 'sizes' ).medium !== 'undefined' && model.get( 'sizes' ).medium.width >= 238 ) {
					image_thumb_urls.push( model.get( 'sizes' ).medium.url );
				} else if ( typeof model.get( 'sizes' ).full !== 'undefined' ) {
					image_thumb_urls.push( model.get( 'sizes' ).full.url );
				} else {
					image_thumb_urls.push( '' );
				}
			} );

			this.image_thumb_urls = image_thumb_urls;
			this.model.set({
				images: attachments,
				columns: library.gallery.get('columns'),
				size: library.gallery.get('size'),
			});
			this.render();
			wp.customize.previewer.send( 'component-changed.clc', this.model );
		},

		/**
		 * Add the image thumbnail preview
		 *
		 * This should normally be set with the template. However, in some cases
		 * we'll need to set it by making an end-run to the server to fetch the
		 * url. In such cases, we can slot it in when it returns without
		 * re-rendering the whole view.
		 *
		 * @since 0.1
		 */
		renderThumbs: function() {
			var html = '';
			for ( var i in this.image_thumb_urls ) {
				html += '<img src="' + this.image_thumb_urls[i] + '">';
			}
			this.$el.find( '.thumb' ).removeClass( 'loading' ).html( html );
		},
	});

} )( jQuery );
