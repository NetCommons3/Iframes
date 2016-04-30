<?php
/**
 * ブロック編集Element
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->NetCommonsForm->hidden('Iframe.id'); ?>
<?php echo $this->NetCommonsForm->hidden('Iframe.key'); ?>

<?php echo $this->NetCommonsForm->input('Iframe.url', array(
		'type' => 'url',
		'label' => __d('iframes', 'URL'),
		'required' => true,
	)); ?>

<?php echo $this->NetCommonsForm->input('Iframe.height', array(
		'type' => 'number',
		'label' => __d('iframes', 'Frame height'),
		'required' => true,
		'min' => Iframe::HEIGHT_MIN_VALUE,
		'max' => Iframe::HEIGHT_MAX_VALUE,
	)); ?>

<?php echo $this->NetCommonsForm->input('Iframe.display_scrollbar', array(
		'type' => 'checkbox',
		'label' => __d('iframes', 'Display the scroll bar'),
		'class' => false,
		'div' => array('class' => 'form-group'),
	)); ?>

<?php echo $this->NetCommonsForm->input('Iframe.display_frame', array(
		'type' => 'checkbox',
		'label' => __d('iframes', 'Display the frame'),
		'class' => false,
		'div' => array('class' => 'form-group'),
	)); ?>

<?php echo $this->element('Blocks.public_type');
