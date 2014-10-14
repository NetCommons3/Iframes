<?php
/**
 * Iframe Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('Iframe', 'Iframes.Model');
App::uses('IframeFrameSetting', 'Iframes.Model');

/**
 * Iframe Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package app.Plugin.Iframes.Test
 */
class IframeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $fixtures = array(
		'plugin.iframes.iframe',
		'plugin.iframes.block',
		'plugin.iframes.frame',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Iframe = ClassRegistry::init('Iframes.Iframe');
		$this->Block = ClassRegistry::init('Iframes.Block');
		$this->Frame = ClassRegistry::init('Iframes.Frame');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Iframe);
		unset($this->Block);
		unset($this->Frame);
		parent::tearDown();
	}

/**
 * a method test
 *
 * @return void
 */
	public function testSaveIframe() {
		//contents status list
		$contentStatusArray = array(1, 2, 3, 4);
		CakeSession::write('Auth.User.id', 1);
		foreach ($contentStatusArray as $contentStatus) {
			//save用データ作成
			$data = array();
			$data['Frame']['frame_id'] = 1;
			$data['Block']['block_id'] = 1;
			$data['Iframe']['status'] = $contentStatus;
			$data['Iframe']['url'] = 'http://www.netcommons.org/';
			$data['Iframe']['created_user'] = 1;
			$frameId = 1;
			$roomId = 1;
			//save処理実行
			$rtn = $this->Iframe->saveIframe($data, $frameId, $roomId);
			//save結果検証
			$this->assertTextEquals('http://www.netcommons.org/', $rtn['Iframe']['url'], print_r($data, true));
		}
	}

/**
 * a method test
 *
 * @return void
 */
	public function testNotExistPostData() {
		//save用データ作成
		$data = '';
		$frameId = 1;
		$roomId = 1;
		//save処理実行
		$rtn = $this->Iframe->saveIframe($data, $frameId, $roomId);
		//save結果検証
		$this->assertTextEquals(false, $rtn, print_r($data, true));
	}

/**
 * a method test
 *
 * @return void
 */
	public function testNotExistBlockId() {
		$frameId = 2;
		$roomId = 1;

		$data = array();
		$data['Frame']['frame_id'] = $frameId;
		$data['Block']['block_id'] = 1;
		$data['Iframe']['status'] = 1;
		$data['Iframe']['url'] = 'http://www.netcommons.org/';
		$data['Iframe']['created_user'] = 1;

		//save処理実行
		$rtn = $this->Iframe->saveIframe($data, $frameId, $roomId);
		//save結果検証
		$this->assertTextEquals('http://www.netcommons.org/', $rtn['Iframe']['url'], print_r($data, true));
	}

/**
 * a method test
 *
 * @return void
 */
	public function testNotExistFrameId() {
		//save用データ作成
		$data = array();
		$data['Frame']['frame_id'] = '';
		$data['Block']['block_id'] = 1;
		$data['Iframe']['status'] = 1;
		$data['Iframe']['url'] = 'http://www.netcommons.org/';
		$data['Iframe']['created_user'] = 1;
		$frameId = 2;
		$roomId = 1;
		//save処理実行
		$rtn = $this->Iframe->saveIframe($data, $frameId, $roomId);
		//save結果検証
		$this->assertTextEquals(false, $rtn, print_r($data, true));
	}

}
