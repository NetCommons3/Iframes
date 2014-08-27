<?php
/**
 * IframeDatumSaveData Test Case
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.AccessCounters.Test.Model.Case
 */

App::uses('IframeDatum', 'Iframes.Model');
App::uses('IframeFrame', 'Iframes.Model');

/**
 * IframeDatum Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.AccessCounters.Test.Model.Case
 */
class IframeDatumSaveDataTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     array
 */
	public $fixtures = array(
		'plugin.iframes.iframe',
		'plugin.iframes.iframe_language',
		'plugin.iframes.iframe_block',
		'plugin.iframes.iframe_frame',
		'plugin.iframes.iframe_datum'
	);

/**
 * setUp method
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function setUp() {
		parent::setUp();
		$this->IframeDatum = ClassRegistry::init('Iframes.IframeDatum');
		$this->IframeFrame = ClassRegistry::init('Iframes.IframeFrame');
	}

/**
 * tearDown method
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function tearDown() {
		unset($this->IframeDatum);
		unset($this->IframeFrame);
		parent::tearDown();
	}

/**
 * testSaveData "no frameId" or "no userId" or "no roomId"
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testSaveDataError() {
		$datum = array(
			array('frameId' => 999999999, 'userId' => 1, 'roomId' => 1),
			//array('frameId' => 999999999, 'userId' => 999999999, 'roomId' => 1),
			array('frameId' => 999999999, 'userId' => null, 'roomId' => 1),
			//array('frameId' => 999999999, 'userId' => 1, 'roomId' => 999999999),
			array('frameId' => 999999999, 'userId' => 1, 'roomId' => null),
			//array('frameId' => 999999999, 'userId' => 999999999, 'roomId' => 999999999),
			array('frameId' => 999999999, 'userId' => 999999999, 'roomId' => null),
			array('frameId' => 999999999, 'userId' => null, 'roomId' => 999999999),
			array('frameId' => 999999999, 'userId' => null, 'roomId' => null),

			array('frameId' => null, 'userId' => 1, 'roomId' => 1),
			array('frameId' => null, 'userId' => 999999999, 'roomId' => 1),
			array('frameId' => null, 'userId' => null, 'roomId' => 1),
			array('frameId' => null, 'userId' => 1, 'roomId' => null),
			array('frameId' => null, 'userId' => 1, 'roomId' => 999999999),
			//array('frameId' => null, 'userId' => 999999999, 'roomId' => 999999999),
			array('frameId' => null, 'userId' => 999999999, 'roomId' => null),
			array('frameId' => null, 'userId' => null, 'roomId' => 999999999),
			array('frameId' => null, 'userId' => null, 'roomId' => null),

			//array('frameId' => 1, 'userId' => 999999999, 'roomId' => 1),
			array('frameId' => 1, 'userId' => null, 'roomId' => 1),
			//array('frameId' => 1, 'userId' => 1, 'roomId' => 999999999),
			array('frameId' => 1, 'userId' => 1, 'roomId' => null),
			//array('frameId' => 1, 'userId' => 999999999, 'roomId' => 999999999),
			array('frameId' => 1, 'userId' => 999999999, 'roomId' => null),
			array('frameId' => 1, 'userId' => null, 'roomId' => 999999999),
			array('frameId' => 1, 'userId' => null, 'roomId' => null),
		);
		foreach ($datum as $data) {
			$frameId = $data['frameId'];
			$userId = $data['userId'];
			$roomId = $data['roomId'];
			$isEncode = false;
			$inputData['IframeDatum']['iframe_id'] = 1;
			$inputData['IframeDatum']['url'] = "http://www.netcommons.org/";
			$inputData['IframeDatum']['frame_height'] = 400;
			$inputData['IframeDatum']['scrollbar_show'] = 1;
			$inputData['IframeDatum']['scrollframe_show'] = 1;
			$inputData['IframeDatum']['blockId'] = 0;
			$inputData['IframeDatum']['frameId'] = $frameId;
			$inputData['IframeDatum']['type'] = 'Publish';
			$inputData['IframeDatum']['langId'] = 2;
			$inputData['IframeDatum']['id'] = 0;
			$mine = $this->IframeDatum->saveData($inputData, $frameId, $userId, $roomId, $isEncode);
			$this->assertNull($mine, "inputData\n" . print_r($inputData, true) . "checkData\n" . print_r($inputData, true));
		}
	}

/**
 * testSaveData
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testSaveData() {
		$frameId = 1;
		$userId = 1;
		$roomId = 1;
		$isEncode = false;
		$inputData = array();
		$inputData['IframeDatum']['iframe_id'] = 1;
		$inputData['IframeDatum']['url'] = "http://www.netcommons.org/";
		$inputData['IframeDatum']['frame_height'] = 400;
		$inputData['IframeDatum']['scrollbar_show'] = 1;
		$inputData['IframeDatum']['scrollframe_show'] = 1;
		$inputData['IframeDatum']['frameId'] = $frameId;
		$inputData['IframeDatum']['blockId'] = 0;
		$inputData['IframeDatum']['type'] = 'Publish';
		$inputData['IframeDatum']['langId'] = 2;
		$inputData['IframeDatum']['id'] = 0;
		$mine = $this->IframeDatum->saveData($inputData, $frameId, $userId, $roomId, $isEncode);
		$this->assertTrue(is_numeric($mine['IframeDatum']['iframe_id']));
		$this->assertTextEquals(2, $mine['IframeDatum']['language_id'], print_r($inputData, true));
		$this->assertTextEquals('http://www.netcommons.org/', $mine['IframeDatum']['url'], print_r($inputData, true));
		$this->assertTextEquals(400, $mine['IframeDatum']['frame_height'], print_r($inputData, true));
		$this->assertTextEquals(1, $mine['IframeDatum']['scrollbar_show'], print_r($inputData, true));
		$this->assertTextEquals(1, $mine['IframeDatum']['scrollframe_show'], print_r($inputData, true));
	}

/**
 * testSaveData "no url" or "no frame_height"
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testSaveDataValidateError() {
		$datum = array(
			array('url' => '', 'frame_height' => 400),
			array('url' => 'http://', 'frame_height' => 400),
			array('url' => 'aaa', 'frame_height' => 400),
			array('url' => 'あああ', 'frame_height' => 400),
			array('url' => '１１１', 'frame_height' => 400),
			array('url' => '111', 'frame_height' => 400),
			array('url' => 'http://www.netcommons.org/', 'frame_height' => ''),
			array('url' => 'http://www.netcommons.org/', 'frame_height' => 0),
			array('url' => 'http://www.netcommons.org/', 'frame_height' => 2001),
			array('url' => 'http://www.netcommons.org/', 'frame_height' => -1),
			array('url' => 'http://www.netcommons.org/', 'frame_height' => 10000),
			array('url' => 'http://www.netcommons.org/', 'frame_height' => '１１１'),
			array('url' => 'http://www.netcommons.org/', 'frame_height' => 'あああ')
		);
		foreach ($datum as $data) {
			$frameId = 1;
			$userId = 1;
			$roomId = 1;
			$isEncode = false;
			$inputData['IframeDatum']['iframe_id'] = 1;
			$inputData['IframeDatum']['url'] = $data['url'];
			$inputData['IframeDatum']['frame_height'] = $data['frame_height'];
			$inputData['IframeDatum']['scrollbar_show'] = 1;
			$inputData['IframeDatum']['scrollframe_show'] = 1;
			$inputData['IframeDatum']['blockId'] = 0;
			$inputData['IframeDatum']['frameId'] = $frameId;
			$inputData['IframeDatum']['type'] = 'Publish';
			$inputData['IframeDatum']['langId'] = 2;
			$inputData['IframeDatum']['id'] = 0;
			$mine = $this->IframeDatum->saveData($inputData, $frameId, $userId, $roomId, $isEncode);
			$this->assertNull($mine, "inputData\n" . print_r($inputData, true) . "checkData\n" . print_r($inputData, true));
		}
	}

/**
 * frames.block_idが0の場合に、blockを作成してから、登録する
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testSaveDataNoBlockId() {
		$frameData = array(
			'room_id' => 1,
			'box_id' => 2,
			'plugin_id' => 1,
			'block_id' => null,
			'weight' => 1
		);
		$rtn = $this->IframeFrame->save($frameData);
		$frameId = $rtn["IframeFrame"]['id'];
		$inputData = array();
		$inputData['IframeDatum']['iframe_id'] = 1;
		$inputData['IframeDatum']['url'] = 'http://www.netcommons.org/';
		$inputData['IframeDatum']['frame_height'] = 400;
		$inputData['IframeDatum']['scrollbar_show'] = 1;
		$inputData['IframeDatum']['scrollframe_show'] = 1;
		$inputData['IframeDatum']['frameId'] = $frameId;
		$inputData['IframeDatum']['blockId'] = 0;
		$inputData['IframeDatum']['type'] = 'Draft';
		$inputData['IframeDatum']['langId'] = 2;
		$inputData['IframeDatum']['id'] = 0;
		$userId = 1;
		$roomId = 1;
		$isEncode = false;
		$rtn = $this->IframeDatum->saveData($inputData, $frameId, $userId, $roomId, $isEncode);
		//$this->assertTextEquals('', $rtn[$this->IframeDatum->name]['iframe_id']);
		$this->assertNull($rtn, "inputData\n" . print_r($inputData, true) . "checkData\n" . print_r($inputData, true));
	}
}