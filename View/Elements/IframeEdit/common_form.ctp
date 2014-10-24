<?php
/**
 * iframe edit form view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

echo $this->Form->input('Frame.id', array(
			'type' => 'hidden',
			'value' => (int)$frameId,
			'ng-model' => 'edit.data.Frame.id'
		)
	);

echo $this->Form->input('Iframe.block_id', array(
			'type' => 'hidden',
			'value' => (int)$blockId,
			'ng-model' => 'edit.data.Iframe.block_id',
		)
	);

echo $this->Form->input('Iframe.id', array(
			'type' => 'hidden',
			'value' => (int)$iframe['Iframe']['id'],
			'ng-model' => 'edit.data.Iframe.id',
		)
	);
