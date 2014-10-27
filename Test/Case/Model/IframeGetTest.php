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
class IframeGetTest extends CakeTestCase {

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
		$this->Block = ClassRegistry::init('Blocks.Block');
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
 * testGetIframe method
 *
 * @return void
 */
	public function testGetIframe() {
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
 * testGetIframeByNoEditable method
 *
 * @return void
 */
	public function testGetIframeByNoEditable() {
		$blockId = 1;
		$contentEditable = false;
		$result = $this->Iframe->getIframe($blockId, $contentEditable);

		$expected = array(
			'Iframe' => array(
				'id' => '1',
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
 * testGetIframeByNoBlockId method
 *
 * @return void
 */
	public function testGetIframeByNoBlockId() {
		$blockId = 0;
		$contentEditable = false;
		$result = $this->Iframe->getIframe($blockId, $contentEditable);

		$expected = array(
			'Iframe' => array(
				'block_id' => '0',
				'status' => '0',
				'url' => '',
				'id' => '0'
			),
		);

		$this->__assertGetIframe($expected, $result);
	}
}
