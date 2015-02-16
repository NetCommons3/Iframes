<?php
/**
 * Iframe Model Test Case
 *
 * @property Iframe $Iframe
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframeAppModelTest', 'Iframes.Test/Case/Model');

/**
 *Iframe Model Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframeTest extends IframeAppModelTest {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Iframe = ClassRegistry::init('Iframes.Iframe');
		$this->Comment = ClassRegistry::init('Comments.Comment');
	}

/**
 * testGetIframe method
 *
 * @return void
 */
	public function testGetIframe() {
		$frameId = 1;
		$blockId = 1;
		$contentEditable = true;
		$result = $this->Iframe->getIframe($frameId, $blockId, $contentEditable);

		$expected = array(
			'Iframe' => array(
				'id' => '2',
				'block_id' => $blockId,
				'status' => NetCommonsBlockComponent::STATUS_IN_DRAFT,
				'key' => 'iframe_1',
			),
			/* 'Frame' => array( */
			/* 	'id' => $frameId */
			/* ), */
		);
		/* var_dump($result); */

		$this->_assertArray(null, $expected, $result);
	}

/**
 * testGetIframeByNoEditable method
 *
 * @return void
 */
	public function testGetIframeByNoEditable() {
		$frameId = 1;
		$blockId = 1;
		$contentEditable = false;
		$result = $this->Iframe->getIframe($frameId, $blockId, $contentEditable);

		$expected = array(
			'Iframe' => array(
				'id' => '1',
				'block_id' => $blockId,
				'key' => 'iframe_1',
				'status' => NetCommonsBlockComponent::STATUS_PUBLISHED,
			),
			/* 'Frame' => array( */
			/* 	'id' => $frameId */
			/* ), */
		);
		/* var_dump($result); */

		$this->_assertArray(null, $expected, $result);
	}

/**
 * testGetIframeByNoBlockId method
 *
 * @return void
 */
	public function testGetIframeByNoBlockId() {
		$frameId = 3;
		$blockId = 0;
		$contentEditable = true;
		$result = $this->Iframe->getIframe($frameId, $blockId, $contentEditable);

		$expected = array(
			/* 'Iframe' => array( */
			/* 	'id' => '0', */
			/* 	'block_id' => '0', */
			/* 	'key' => '', */
			/* 	'status' => '0', */
			/* ), */
			/* 'Frame' => array( */
			/* 	'id' => $frameId */
			/* ), */
		);
		/* var_dump($result); */

		$this->_assertArray(null, $expected, $result);
	}

/**
 * testSaveIframe method
 *
 * @return void
 */
	public function testSaveIframe() {
		$frameId = 1;
		$blockId = 1;

		$postData = array(
			'Iframe' => array(
				'block_id' => $blockId,
				'key' => 'iframe_1',
				'status' => NetCommonsBlockComponent::STATUS_PUBLISHED,
				'url' => 'http://www.netcommons.org',
			),
			'Frame' => array(
				'id' => $frameId
			),
			'Comment' => array(
				'comment' => 'edit comment',
			)
		);
		/* $this->Iframe->validateIframe($postData); */
		$this->Iframe->saveIframe($postData);

		$result = $this->Iframe->getIframe($frameId, $blockId, true);

		$expected = array(
			'Iframe' => array(
				'id' => '2',
				'block_id' => $blockId,
				'key' => 'iframe_1',
			),
			/* 'Frame' => array( */
			/* 	'id' => $frameId */
			/* ), */
		);
		/* var_dump($result); */

		$this->_assertArray(null, $expected, $result);
	}

/**
 * testSaveIframeByNoBlockId method
 *
 * @return void
 */
	public function testSaveIframeByNoBlockId() {
		$frameId = 3;
		$blockId = 0;

		$postData = array(
			'Iframe' => array(
				'block_id' => $blockId,
				'status' => NetCommonsBlockComponent::STATUS_PUBLISHED,
				'url' => 'add content',
				'key' => 'http://www.netcommons.org',
			),
			'Frame' => array(
				'id' => $frameId
			),
			'Comment' => array(
				'comment' => 'add comment',
			)
		);
		/* $this->Iframe->validateIframe($postData); */
		$this->Iframe->saveIframe($postData);

		$blockId = 3;
		$result = $this->Iframe->getIframe($frameId, $blockId, true);

		$expected = array(
			/* 'Iframe' => array( */
			/* 	'id' => '4', */
			/* 	'block_id' => $blockId, */
			/* ), */
			/* 'Frame' => array( */
			/* 	'id' => $frameId */
			/* ), */
		);
		/* var_dump($result); */

		$this->_assertArray(null, $expected, $result);
	}

/**
 * testSaveIframeByStatusDisapproved method
 *
 * @return void
 */
	/* public function testSaveIframeByStatusDisapproved() { */
	/* 	$frameId = 1; */
	/* 	$blockId = 1; */

	/* 	$postData = array( */
	/* 		'Iframe' => array( */
	/* 			'block_id' => $blockId, */
	/* 			'key' => 'iframe_1', */
	/* 			'status' => NetCommonsBlockComponent::STATUS_DISAPPROVED, */
	/* 			'content' => 'edit content', */
	/* 			'is_auto_translated' => true, */
	/* 			'translation_engine' => 'edit translation_engine', */
	/* 		), */
	/* 		'Frame' => array( */
	/* 			'id' => $frameId */
	/* 		), */
	/* 		'Comment' => array( */
	/* 			'comment' => 'edit comment', */
	/* 		) */
	/* 	); */
	/* 	/\* $this->Iframe->validateIframe($postData); *\/ */
	/* 	$result = $this->Iframe->saveIframe($postData); */

	/* 	$result = $this->Iframe->getIframe($frameId, $blockId, true); */

	/* 	$expected = array( */
	/* 		'Iframe' => array( */
	/* 			'id' => '2', */
	/* 			'block_id' => $blockId, */
	/* 			'key' => 'iframe_1', */
	/* 			'status' => NetCommonsBlockComponent::STATUS_DISAPPROVED, */
	/* 		), */
	/* 		/\* 'Frame' => array( *\/ */
	/* 		/\* 	'id' => $frameId, *\/ */
	/* 		/\* ), *\/ */
	/* 	); */
	/* 	/\* var_dump($result); *\/ */

	/* 	$this->_assertArray(null, $expected, $result); */
	/* } */

/**
 * testSaveIframe method
 *
 * @return void
 */
	public function testSaveIframeStatusModify() {
		$frameId = 1;
		$blockId = 1;

		$postData = array(
			'Iframe' => array(
				'block_id' => $blockId,
				'key' => 'iframe_1',
				'status' => NetCommonsBlockComponent::STATUS_APPROVED,
				'url' => 'http://www.netcommons.org',
			),
			'Frame' => array(
				'id' => $frameId
			),
			'Comment' => array(
				'comment' => '',
			)
		);
		/* $this->Iframe->validateIframe($postData); */
		$this->Iframe->saveIframe($postData);

		$result = $this->Iframe->getIframe($frameId, $blockId, true);

		/* $expected = array( */
		/* 	'Iframe' => array( */
		/* 		'id' => '4', */
		/* 		'block_id' => $blockId, */
		/* 		'key' => 'iframe_1', */
		/* 		'status' => NetCommonsBlockComponent::STATUS_APPROVED, */
		/* 	), */
		/* 	'Frame' => array( */
		/* 		'id' => $frameId, */
		/* 	) */
		/* ); */
		$expected = array(
			'Iframe' => array(
				'id' => '4',
				'block_id' => $blockId,
				'key' => 'iframe_1',
				'status' => NetCommonsBlockComponent::STATUS_APPROVED,
			)
		);

		$this->_assertArray(null, $expected, $result);
	}

}
