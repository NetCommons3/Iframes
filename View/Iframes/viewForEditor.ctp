<?php
/**
 * iframes view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div id="nc-iframes-<?php echo (int)$frameId; ?>">

	<div class="text-right">
		<span class="nc-tooltip" tooltip="<?php echo __d('net_commons', 'Edit'); ?>">
			<a href="<?php echo $this->Html->url('/iframes/iframes/edit/' . $frameId) ?>" class="btn btn-primary">
				<span class="glyphicon glyphicon-edit"> </span>
			</a>
		</span>
	</div>

	<p class="text-left">
		<?php echo $this->element('NetCommons.status_label',
			array('status' => $iframes['status'])); ?></p>

	<div class="text-left">
		<?php echo $this->element('Iframes/display_iframe'); ?>
	</div>

</div>
