<?php
/**
 * IframeFrameSettings edit form template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->NetCommonsForm->hidden('IframeFrameSetting.id'); ?>
<?php echo $this->NetCommonsForm->hidden('IframeFrameSetting.frame_key'); ?>
<?php echo $this->NetCommonsForm->hidden('Frame.id'); ?>
<?php echo $this->NetCommonsForm->hidden('Frame.key'); ?>


<?php echo $this->NetCommonsForm->input('IframeFrameSetting.height', array(
		'type' => 'number',
		'label' => __d('iframes', 'Frame height'),
		'required' => true,
		'min' => IframeFrameSetting::HEIGHT_MIN_VALUE,
		'max' => IframeFrameSetting::HEIGHT_MAX_VALUE,
	)); ?>

<?php echo $this->NetCommonsForm->checkbox('IframeFrameSetting.display_scrollbar', array(
		'type' => 'checkbox',
		'label' => __d('iframes', 'Display the scroll bar'),
		'class' => false,
		'div' => array('class' => 'form-group'),
	)); ?>

<?php echo $this->NetCommonsForm->checkbox('IframeFrameSetting.display_frame', array(
		'type' => 'checkbox',
		'label' => __d('iframes', 'Display the frame'),
		'class' => false,
		'div' => array('class' => 'form-group'),
	));
