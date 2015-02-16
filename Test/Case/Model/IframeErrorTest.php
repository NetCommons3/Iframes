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
class IframeErrorTest extends IframeAppModelTest {

/**
 * logLevels
 *
 * @var array
 */
	public $logLevels = array();

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//異常(catch)テストでエラーTraceが必ず出力されてしまうため、ログ出力をOFFにする
		//また、Modelでは、CakeLog::error()を使うとNoticeが発生するため、CakeLog::write()を使って出力する
		$this->logLevels = CakeLog::levels();
		$setLevels = $this->logLevels;
		$setLevels[LOG_ERR] = '';
		CakeLog::levels($setLevels, false);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		//ログ出力をONにする
		CakeLog::levels($this->logLevels, false);
		parent::tearDown();
	}

/**
 * testSaveIframeByErrorFrameId method
 *
 * @return void
 */
	public function testSaveIframeByErrorFrameId() {
		$this->setExpectedException('InternalErrorException');

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'key' => 'iframe_1',
				'status' => '2',
				'url' => 'http://www.netcommons.org',
			),
			'Frame' => array(
				'id' => '10'
			),
			'Comment' => array(
				'comment' => 'edit comment',
			)
		);

		$this->Iframe->saveIframe($postData);
	}

/**
 * testSaveIframeByFrameSaveError method
 *
 * @return void
 */
	/* public function testSaveIframeByFrameSaveError() { */
	/* 	$this->setExpectedException('InternalErrorException'); */

	/* 	$this->Frame = $this->getMockForModel('Frames.Frame', array('save')); */
	/* 	$this->Frame->expects($this->any()) */
	/* 		->method('save') */
	/* 		->will($this->returnValue(false)); */

	/* 	$postData = array( */
	/* 		'Iframe' => array( */
	/* 			'status' => '2', */
	/* 			'content' => 'add content', */
	/* 			'block_id' => '0' */
	/* 		), */
	/* 		'Frame' => array( */
	/* 			'id' => '3' */
	/* 		), */
	/* 		'Comment' => array( */
	/* 			'comment' => 'edit comment', */
	/* 		) */
	/* 	); */
	/* 	$this->Iframe->saveIframe($postData); */

	/* 	unset($this->Frame); */
	/* } */

/**
 * testSaveIframeBySaveError method
 *
 * @return void
 */
	/* public function testSaveIframeBySaveError() { */
	/* 	$this->setExpectedException('InternalErrorException'); */

	/* 	$this->Iframe = $this->getMockForModel('Iframes.Iframe', array('save')); */
	/* 	$this->Iframe->expects($this->any()) */
	/* 		->method('save') */
	/* 		->will($this->returnValue(false)); */

	/* 	$postData = array( */
	/* 		'Iframe' => array( */
	/* 			'status' => '2', */
	/* 			'content' => 'add content', */
	/* 			'block_id' => '0' */
	/* 		), */
	/* 		'Frame' => array( */
	/* 			'id' => '3' */
	/* 		), */
	/* 		'Comment' => array( */
	/* 			'comment' => 'edit comment', */
	/* 		) */
	/* 	); */
	/* 	$this->Iframe->saveIframe($postData); */

	/* 	unset($this->Iframe); */
	/* } */

/**
 * testSaveIframeByCommentSaveError method
 *
 * @return void
 */
	/* public function testSaveIframeByCommentSaveError() { */
	/* 	$this->setExpectedException('InternalErrorException'); */

	/* 	$this->Comment = $this->getMockForModel('Comments.Comment', array('save')); */
	/* 	$this->Comment->expects($this->any()) */
	/* 		->method('save') */
	/* 		->will($this->returnValue(false)); */

	/* 	$postData = array( */
	/* 		'Iframe' => array( */
	/* 			'status' => '2', */
	/* 			'content' => 'add content', */
	/* 			'block_id' => '0' */
	/* 		), */
	/* 		'Frame' => array( */
	/* 			'id' => '3' */
	/* 		), */
	/* 		'Comment' => array( */
	/* 			'comment' => 'edit comment', */
	/* 		) */
	/* 	); */
	/* 	$this->Iframe->saveIframe($postData); */

	/* 	unset($this->Comment); */
	/* } */

}
