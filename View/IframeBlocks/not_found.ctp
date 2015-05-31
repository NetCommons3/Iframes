<?php
/**
 * Blocks view for editor template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="modal-body">
	<?php echo $this->element('NetCommons.setting_tabs', $settingTabs); ?>

	<div class="tab-content">
		<div class="text-right">
			<a class="btn btn-success" href="<?php echo $this->Html->url('/iframes/iframe_blocks/add/' . $frameId);?>">
				<span class="glyphicon glyphicon-plus"> </span>
			</a>
		</div>

		<div class="text-left">
			<?php echo __d('net_commons', 'Not found.'); ?>
		</div>
	</div>

</div>
