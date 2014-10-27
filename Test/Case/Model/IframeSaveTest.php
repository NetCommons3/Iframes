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

App::uses('Iframe', 'Iframes.Model');
App::uses('NetCommonsBlockComponent', 'NetCommons.Controller/Component');

/**
 * Iframe Model Test Case
 *
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframeSaveTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.iframes.iframe',
		'plugin.iframes.block',
		'plugin.iframes.frame',
		'plugin.iframes.plugin',
		'plugin.frames.box',
		'plugin.frames.language',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Iframe = ClassRegistry::init('Iframes.Iframe');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Iframe);
		unset($this->Block);
		parent::tearDown();
	}

/**
 * __assertGetIframe method
 *
 * @param array $expected correct data
 * @param array $result result data
 * @return void
 */
	private function __assertGetIframe($expected, $result) {
		$unsets = array(
			'created_user',
			'created',
			'modified_user',
			'modified'
		);

		//Iframeデータテスト
		foreach ($unsets as $key) {
			if (array_key_exists($key, $result['Iframe'])) {
				unset($result['Iframe'][$key]);
			}
		}
		$this->assertArrayHasKey('Iframe', $result, 'Error ArrayHasKey Iframe');
		$this->assertEquals($expected['Iframe'], $result['Iframe'], 'Error Equals Iframe');

		//Blockデータのテスト
		if (isset($expected['Block'])) {
			foreach ($unsets as $key) {
				if (array_key_exists($key, $result['Block'])) {
					unset($result['Block'][$key]);
				}
			}

			$this->assertArrayHasKey('Block', $result, 'Error ArrayHasKey Block');
			$this->assertEquals($expected['Block'], $result['Block'], 'Error Equals Block');
		}
	}

/**
 * testSaveIframe method
 *
 * @return void
 */
	public function testSaveIframe() {
		$this->Block = ClassRegistry::init('Blocks.Block');

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'status' => '1',
				'url' => 'http://www.netcommons.org/',
			),
			'Frame' => array(
				'id' => '1'
			)
		);
		$result = $this->Iframe->saveIframe($postData);
		$this->assertArrayHasKey('Iframe', $result, 'Error saveIframe');

		$blockId = 1;
		$contentEditable = true;
		$result = $this->Iframe->getIframe($blockId, $contentEditable);

		$expected = array(
			'Iframe' => array(
				'id' => '3',
				'block_id' => '1',
				'status' => '1',
				'url' => 'http://www.netcommons.org/',
			),
			'Block' => array(
				'id' => '1',
				'language_id' => '2',
				'room_id' => '1',
				'key' => 'block_1',
				'name' => '',
			)
		);

		$this->__assertGetIframe($expected, $result);
	}

/**
 * testSaveIframeByErrorFrameId method
 *
 * @return void
 */
	public function testSaveIframeByErrorFrameId() {
		$this->Block = ClassRegistry::init('Blocks.Block');

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'status' => '1',
				'url' => 'http://www.netcommons.org/',
			),
			'Frame' => array(
				'id' => '10'
			)
		);
		$result = $this->Iframe->saveIframe($postData);
		$this->assertFalse($result, 'saveIframe');

		$blockId = 1;
		$contentEditable = true;
		$result = $this->Iframe->getIframe($blockId, $contentEditable);

		$expected = array(
			'Iframe' => array(
				'id' => '2',
				'block_id' => '1',
				'status' => '3',
				'url' => 'http://www.netcommons.org/',
			),
			'Block' => array(
				'id' => '1',
				'language_id' => '2',
				'room_id' => '1',
				'key' => 'block_1',
				'name' => '',
			)
		);

		$this->__assertGetIframe($expected, $result);
	}

/**
 * testSaveIframeByNoBlockId method
 *
 * @return void
 */
	public function testSaveIframeByNoBlockId() {
		$this->Block = ClassRegistry::init('Blocks.Block');

		$postData = array(
			'Iframe' => array(
				'status' => '1',
				'url' => 'http://www.netcommons.org/',
			),
			'Frame' => array(
				'id' => '2'
			)
		);
		$result = $this->Iframe->saveIframe($postData);
		$this->assertArrayHasKey('Iframe', $result, 'Error saveIframe');

		$blockId = 2;
		$contentEditable = true;
		$result = $this->Iframe->getIframe($blockId, $contentEditable);

		$this->assertArrayHasKey('key', $result['Block'], 'Error ArrayHasKey Block.key');
		$this->assertTrue(strlen($result['Block']['key']) > 0, 'Error strlen Block.key');
		unset($result['Block']['key']);

		$expected = array(
			'Iframe' => array(
				'id' => '3',
				'block_id' => '2',
				'status' => '1',
				'url' => 'http://www.netcommons.org/',
			),
			'Block' => array(
				'id' => '2',
				'language_id' => '2',
				'name' => '',
				'room_id' => '1',
			)
		);

		$this->__assertGetIframe($expected, $result);
	}

/**
 * testSaveIframeRollbackByError method
 *
 * @return void
 */
	public function testSaveIframeRollbackByError() {
		$this->Block = ClassRegistry::init('Blocks.Block');

		//登録処理
		$postData = array(
			'Iframe' => array(
				'block_id' => 1,
				'status' => null, //Error
				'url' => 'http://www.netcommons.org/',
			),
			'Frame' => array(
				'id' => '1'
			)
		);
		$result = $this->Iframe->saveIframe($postData);
		$this->assertFalse($result, 'saveIframe');

		//データ確認
		$blockId = 1;
		$contentEditable = true;
		$result = $this->Iframe->getIframe($blockId, $contentEditable);

		$expected = array(
			'Iframe' => array(
				'id' => '2',
				'block_id' => '1',
				'status' => '3',
				'url' => 'http://www.netcommons.org/',
			),
			'Block' => array(
				'id' => '1',
				'language_id' => '2',
				'room_id' => '1',
				'key' => 'block_1',
				'name' => '',
			)
		);

		$this->__assertGetIframe($expected, $result);
	}

/**
 * testSaveIframeByBlockSaveError method
 *
 * @return void
 */
	public function testSaveIframeByBlockSaveError() {
		$this->Block = $this->getMockForModel('Blocks.Block', array('save'));
		$this->Block->expects($this->any())
			->method('save')
			->will($this->returnValue(false));

		$postData = array(
			'Iframe' => array(
				'status' => '1',
				'url' => 'http://www.netcommons.org/',
			),
			'Frame' => array(
				'id' => '2'
			)
		);
		$result = $this->Iframe->saveIframe($postData);
		$this->assertFalse($result);
	}

/**
 * testSaveIframeByFrameSaveError method
 *
 * @return void
 */
	public function testSaveIframeByFrameSaveError() {
		$this->Frame = $this->getMockForModel('Frames.Frame', array('save'));
		$this->Frame->expects($this->any())
			->method('save')
			->will($this->returnValue(false));

		$postData = array(
			'Iframe' => array(
				'status' => '1',
				'url' => 'http://www.netcommons.org/',
			),
			'Frame' => array(
				'id' => '2'
			)
		);
		$result = $this->Iframe->saveIframe($postData);
		$this->assertFalse($result);

		unset($this->Frame);
	}

}
