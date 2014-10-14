<?php
	echo $this->Form->create(null, array('id' => 'nc-iframes-post-form-' . $frameId));

	//フレームID
	echo $this->Form->input('Frame.frame_id', array(
				'type' => 'hidden',
				'value' => (int)$frameId,
			)
		);

	//ブロックID
	echo $this->Form->input('Block.block_id', array(
				'type' => 'hidden',
				'value' => (int)$blockId,
			)
		);

	//URL
	echo $this->Form->input('Iframe.url', array(
				'type' => 'text',
				'value' => '',
			)
		);

	//状態
	echo $this->Form->input('Iframe.status', array(
				'type' => 'select',
				'options' => array(
					Iframe::STATUS_PUBLISHED,
					Iframe::STATUS_APPROVED,
					Iframe::STATUS_DRAFTED,
					Iframe::STATUS_DISAPPROVED
				),
			)
		);

	echo $this->Form->end();
