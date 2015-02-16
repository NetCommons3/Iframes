<?php
/**
 * iframes display change form element template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="form-group">
	<label class="control-label">
		<?php echo __d('iframes', 'Frame height'); ?>
	</label>
	<?php echo $this->element('NetCommons.required'); ?>

	<div class="nc-iframes-height-alert">
		<?php echo $this->Form->input('height',
				array(
						'label' => false,
						'div' => false,
						'type' => 'number',
						'class' => 'form-control',
						'ng-model' => 'iframeFrameSettings.height',
						'autofocus' => true,
						'required' => 'required',
						'min' => IframeFrameSetting::HEIGHT_MIN_VALUE,
						'max' => IframeFrameSetting::HEIGHT_MAX_VALUE,
					)) ?>

	</div>
	<div class="has-error">
		<?php if ($this->validationErrors['IframeFrameSetting']) : ?>
			<?php //foreach ($this->validationErrors['IframeFrameSetting']['height'] as $message) : ?>
				<div class="help-block">
					<?php //echo $message; ?>
				</div>
			<?php //endforeach; ?>
		<?php else : ?>
			<br />
		<?php endif; ?>
	</div>
</div>

<div class='form-group'>
	<label style="margin-left:20px">
		<?php echo $this->Form->input('display_scrollbar',
				array(
						'label' => false,
						'type' => 'checkbox',
						'ng-model' => 'iframeFrameSettings.display_scrollbar',
						'required' => 'required',
					)) ?>
		<?php echo __d('iframes', 'Display the scroll bar'); ?>
	</label>
</div>

<div class='form-group'>
	<label style="margin-left:20px">
		<?php echo $this->Form->input('display_frame',
				array(
						'label' => false,
						'type' => 'checkbox',
						'ng-model' => 'iframeFrameSettings.display_frame',
						'required' => 'required',
					)) ?>
		<?php echo __d('iframes', 'Display the frame'); ?>
	</label>
</div>