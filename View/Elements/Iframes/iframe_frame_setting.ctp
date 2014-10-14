<form method="post" accept-charset="utf-8" name="iframeFrameSetting"
		id="nc-iframes-frame-setting-input-form-<?php echo (int)$frameId; ?>" novalidate>

	<div class="form-group has-feedback"
		ng-class="iframeFrameSetting['data[IframeFrameSetting][height]'].$valid ? 'has-success' : 'has-error'; ">
		<?php
			echo $this->Form->label('IframeFrameSetting.height', __d('iframes', 'Frame height'));
			echo $this->Form->input('IframeFrameSetting.height', array(
						'label' => false,
						'div' => false,
						'type' => 'number',
						'class' => 'form-control',
						'ng-model' => 'iframeHeight',
						'min' => IframeFrameSetting::MINIMUM_VALUE,
						'max' => IframeFrameSetting::MAXIMUM_VALUE,
						'placeholder' => __d('iframes', 'Please enter frame height.'),
						'required' => 'true',
					)
				);
		?>
		<span class="form-control-feedback"
			  ng-class="iframeFrameSetting['data[IframeFrameSetting][height]'].$valid ?
				'glyphicon glyphicon-ok' :
				'glyphicon glyphicon-remove'; ">
		</span>
		<span class="help-block">
			<?php echo $this->element('Iframes/form_height_error'); ?>
		</span>
	</div>

	<div class='form-group'>
		<?php
			echo $this->Form->input('IframeFrameSetting.display_scrollbar', array(
						'label' => __d('iframes', 'Display the scroll bar.'),
						'div' => false,
						'type' => 'checkbox',
						'ng-model' => 'iframeScrollBar',
						//'ng-true-value' => '1',
						//'ng-false-value' => '0'
					)
				);
		?>
	</div>

	<div class='form-group'>
		<?php
			echo $this->Form->input('IframeFrameSetting.display_frame', array(
						'label' => __d('iframes', 'Display the frame.'),
						'div' => false,
						'type' => 'checkbox',
						'ng-model' => 'iframeFrame',
					)
				);
		?>
	</div>

</form>