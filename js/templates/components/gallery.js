<div class="header">
	<h4 class="name">
		<?php esc_html_e( $this->name ); ?>
		<span class="title">{{ data.model.get( 'title' ) }}</span>
	</h4>
	<a href="#" class="clc-toggle-component-form"><?php esc_html_e( CLC_Content_Layout_Control::$i18n['control-toggle'] ); ?></a>
</div>
<div class="control">
	<div class="setting">
		<span class="customize-control-title"><?php echo $this->i18n['image']; ?></span>
		<# if ( !data.model.get( 'images' ).length ) { #>
			<div class="placeholder">
				<?php echo $this->i18n['image_placeholder']; ?>
			</div>
		<# } else { #>
			<div class="thumb loading"></div>
		<# } #>
		<div class="buttons">
			<# if ( !data.model.get( 'images' ).length ) { #>
				<button class="select-image button-secondary">
					<?php echo $this->i18n['image_select_button']; ?>
				</button>
			<# } else { #>
				<button class="select-image button-secondary">
					<?php echo $this->i18n['image_change_button']; ?>
				</button>
			<# } #>
		</div>
	</div>
</div>
<div class="footer">
	<a href="#" class="delete"><?php esc_html_e( CLC_Content_Layout_Control::$i18n['delete'] ); ?></a>
</div>
