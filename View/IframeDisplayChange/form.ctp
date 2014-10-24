<?php
/**
 * iframes display change form view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

echo $this->Form->create(null);

echo $this->Form->input('IframeFrameSetting.height', array(
			'type' => 'number',
			'value' => '',
		)
	);

echo $this->Form->input('IframeFrameSetting.display_scrollbar', array(
			'type' => 'boolean',
			'value' => '',
		)
	);

echo $this->Form->input('IframeFrameSetting.display_frame', array(
			'type' => 'boolean',
			'value' => '',
		)
	);

echo $this->Form->input('IframeFrameSetting.frame_key', array(
			'type' => 'hidden',
			'value' => $frameKey,
			'ng-model' => 'edit.data.IframeFrameSetting.frame_key'
		)
	);

echo $this->Form->input('IframeFrameSetting.id', array(
			'type' => 'hidden',
			'value' => (int)$iframeFrameSetting['IframeFrameSetting']['id'],
			'ng-model' => 'edit.data.IframeFrameSetting.id',
		)
	);

echo $this->Form->end();
