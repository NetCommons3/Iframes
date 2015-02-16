<?php
/**
 * iframes edit form element template
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
		<?php echo __d('iframes', 'URL'); ?>
	</label>
	<?php echo $this->element('NetCommons.required'); ?>

	<div class="nc-iframes-url-alert">
		<?php echo $this->Form->input('url',
				array(
						'label' => false,
						'type' => 'url',
						'class' => 'form-control',
						'ng-model' => 'iframes.url',
						'placeholder' => 'http://',
						'autofocus' => true,
						'required' => 'required',
					)) ?>
	</div>

	<div class="has-error">
		<?php if ($this->validationErrors['Iframe']) : ?>
			<?php //foreach ($this->validationErrors['Iframe']['url'] as $message) : ?>
				<div class="help-block">
					<?php //echo $message; ?>
				</div>
			<?php //endforeach; ?>
		<?php else : ?>
			<br />
		<?php endif; ?>
	</div>
</div>