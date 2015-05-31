<?php
/**
 * Blocks edit template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->Form->hidden('Frame.id', array(
		'value' => $frameId,
	)); ?>

<?php echo $this->Form->hidden('Block.id', array(
		'value' => $block['id'],
	)); ?>

<?php echo $this->Form->hidden('Block.key', array(
		'value' => $block['key'],
	)); ?>

<?php echo $this->Form->hidden('Block.language_id', array(
		'value' => $languageId,
	)); ?>

<?php echo $this->Form->hidden('Block.room_id', array(
		'value' => $roomId,
	)); ?>

<?php echo $this->Form->hidden('Block.plugin_key', array(
		'value' => 'iframes',
	)); ?>

<?php echo $this->Form->hidden('Iframe.id', array(
		'value' => isset($iframe['id']) ? (int)$iframe['id'] : null,
	)); ?>

<?php echo $this->Form->hidden('Iframe.key', array(
		'value' => isset($iframe['key']) ? $iframe['key'] : null,
	)); ?>

<div class="row form-group">
	<div class="col-xs-12">
		<?php echo $this->Form->input(
				'Iframe.url', array(
					'type' => 'text',
					'label' => __d('iframes', 'URL') . $this->element('NetCommons.required'),
					'error' => false,
					'class' => 'form-control',
					'placeholder' => 'http://',
					'autofocus' => true,
					'value' => (isset($iframe['url']) ? $iframe['url'] : '')
				)
			); ?>
	</div>

	<div class="col-xs-12">
		<?php echo $this->element(
			'NetCommons.errors', [
				'errors' => $this->validationErrors,
				'model' => 'Iframe',
				'field' => 'url',
			]); ?>
	</div>
</div>

<div class="row form-group">
	<div class="col-xs-12">
		<?php echo $this->Form->input(
				'Iframe.height', array(
					'label' => __d('iframes', 'Frame height') . $this->element('NetCommons.required'),
					'type' => 'number',
					'class' => 'form-control',
					'autofocus' => true,
					'value' => (isset($iframe['height']) ? (int)$iframe['height'] : ''),
					'min' => Iframe::HEIGHT_MIN_VALUE,
					'max' => Iframe::HEIGHT_MAX_VALUE,
			)); ?>
	</div>

	<div class="col-xs-12">
		<?php echo $this->element(
			'NetCommons.errors', [
				'errors' => $this->validationErrors,
				'model' => 'Iframe',
				'field' => 'height',
			]); ?>
	</div>
</div>

<div class="row form-group">
	<div class="col-xs-12">
		<?php echo $this->Form->checkbox('Iframe.display_scrollbar', array(
					'div' => false,
					'checked' => (int)$iframe['displayScrollbar']
				)
			); ?>
		<?php echo $this->Form->label('Iframe.display_scrollbar', __d('iframes', 'Display the scroll bar')); ?>
	</div>
</div>

<div class="row form-group">
	<div class="col-xs-12">
		<?php echo $this->Form->checkbox('Iframe.display_frame', array(
					'div' => false,
					'checked' => (int)$iframe['displayFrame']
				)
			); ?>
		<?php echo $this->Form->label('Iframe.display_frame', __d('iframes', 'Display the frame')); ?>
	</div>
</div>

<?php echo $this->element('Blocks.public_type');
