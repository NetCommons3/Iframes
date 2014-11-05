<?php
/**
 * iframe edit view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="form-group has-feedback"
		ng-class="iframeDisplayChange['data[IframeFrameSetting][height]'].$valid ? 'has-success' : 'has-error'; ">
	<?php
		echo $this->Form->label('IframeFrameSetting.height', __d('iframes', 'Frame height'));
		echo $this->Form->input('IframeFrameSetting.height', array(
					'label' => false,
					'div' => false,
					'type' => 'number',
					'class' => 'form-control',
					'ng-model' => 'edit.data.IframeFrameSetting.height',
					'min' => IframeFrameSetting::MINIMUM_VALUE,
					'max' => IframeFrameSetting::MAXIMUM_VALUE,
					'placeholder' => __d('iframes', 'Please enter frame height.'),
					'required' => 'true',
				)
			);
	?>
	<span class="form-control-feedback"
		  ng-class="iframeDisplayChange['data[IframeFrameSetting][height]'].$valid ?
			'glyphicon glyphicon-ok' :
			'glyphicon glyphicon-remove'; ">
	</span>
	<span class="help-block">
		<span ng-show="iframeDisplayChange['data[IframeFrameSetting][height]'].$valid">
			<br />
		</span>
		<span ng-show="iframeDisplayChange['data[IframeFrameSetting][height]'].$error.required &&
						!iframeDisplayChange['data[IframeFrameSetting][height]'].$error.number">
			<?php  echo __d('net_commons', 'Required field.');?>
		</span>
		<span ng-show="iframeDisplayChange['data[IframeFrameSetting][height]'].$error.number ||
						iframeDisplayChange['data[IframeFrameSetting][height]'].$error.min ||
						iframeDisplayChange['data[IframeFrameSetting][height]'].$error.max">
			<?php echo __d('iframes', 'The input frame height must be a number bigger than 1 and less than 2000.');?>
		</span>
	</span>
</div>

<div class='form-group'>
	<?php
		echo $this->Form->input('IframeFrameSetting.display_scrollbar', array(
					'label' => __d('iframes', 'Display the scroll bar.'),
					'div' => false,
					'type' => 'checkbox',
					'ng-model' => 'edit.data.IframeFrameSetting.display_scrollbar',
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
					'ng-model' => 'edit.data.IframeFrameSetting.display_frame',
				)
			);
	?>
</div>