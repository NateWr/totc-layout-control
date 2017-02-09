<div class="header">
	<h4 class="name">
		<?php esc_html_e( $this->name ); ?>
		<span class="title">{{ data.model.get( 'title' ) }}</span>
	</h4>
	<a href="#" class="clc-toggle-component-form"><?php esc_html_e( CLC_Content_Layout_Control::$i18n['control-toggle'] ); ?></a>
</div>
<div class="control">
	<label>
		<span class="customize-control-title"><?php echo $this->i18n['title']; ?></span>
		<input type="text" value="{{ data.model.get( 'title' ) }}" data-clc-setting-link="title">
	</label>
	<label>
		<span class="customize-control-title"><?php echo $this->i18n['number_label']; ?></span>
		<select data-clc-setting-link="number">
			<# for ( var i = 1; i <= data.model.get( 'limit_posts' ); i++ ) { #>
				<option value="{{ i }}"<# if ( i === data.model.get( 'number' ) ) { #> selected<# } #>>{{ i }}</option>
			<# } #>
		</select>
	</label>
	<label>
		<input type="checkbox" data-clc-show-date-link="true"<# if ( data.model.get( 'show_date' ) ) { #> checked="checked"<# } #>>
		<?php echo $this->i18n['show_date']; ?>
	</label>
</div>
<div class="footer">
	<a href="#" class="delete"><?php esc_html_e( CLC_Content_Layout_Control::$i18n['delete'] ); ?></a>
</div>
