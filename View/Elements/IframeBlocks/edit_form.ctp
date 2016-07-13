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

<?php echo $this->element('Blocks.public_type');
