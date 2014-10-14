<?php
	echo $this->Form->create(null, array('id' => 'nc-iframes-frame-setting-post-form-' . $frameId));

	//フレームID
	echo $this->Form->input('Frame.frame_key', array(
				'type' => 'hidden',
				'value' => $frameKey,
			)
		);

	//フレームの高さ
	echo $this->Form->input('IframeFrameSetting.height', array(
				'type' => 'text',
				'value' => '',
			)
		);

	//スクロールバーの有無
	echo $this->Form->input('IframeFrameSetting.display_scrollbar', array(
				'type' => 'text',
				'value' => '',
			)
		);

	//フレーム枠の有無
	echo $this->Form->input('IframeFrameSetting.display_frame', array(
				'type' => 'text',
				'value' => '',
			)
		);

	echo $this->Form->end();
