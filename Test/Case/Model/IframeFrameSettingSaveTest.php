<?php
/**
 * IframeFrameSetting Model Test Case
 *
 * @property IframeFrameSetting $IframeFrameSetting
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframeFrameSetting', 'Iframes.Model');
App::uses('NetCommonsFrameComponent', 'NetCommons.Controller/Component');

/**
 * IframeFrameSetting Model Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframeFrameSettingSaveTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.iframes.iframe',
		'plugin.iframes.iframe_frame_setting',
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
		$this->IframeFrameSetting = ClassRegistry::init('Iframes.IframeFrameSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IframeFrameSetting);
		unset($this->Frame);
		parent::tearDown();
	}

/**
 * __assertGetIframe method
 *
 * @param array $expected correct data
 * @param array $result result data
 * @return void
 */
	private function __assertGetIframeFrameSetting($expected, $result) {
		$unsets = array(
			'created_user',
			'created',
			'modified_user',
			'modified'
		);

		//IframeFrameSettingデータのテスト
		foreach ($unsets as $key) {
			if (array_key_exists($key, $result['IframeFrameSetting'])) {
				unset($result['IframeFrameSetting'][$key]);
			}
		}

		$this->assertArrayHasKey('IframeFrameSetting', $result, 'Error ArrayHasKey Iframe');
		$this->assertEquals($expected['IframeFrameSetting'], $result['IframeFrameSetting'], 'Error Equals Iframe');
	}

/**
 * testSaveIframe method
 *
 * @return void
 */
	public function testSaveIframeFrameSetting() {
		$this->Frame = ClassRegistry::init('Frames.Frame');

		$postData = array(
			'IframeFrameSetting' => array(
				'height' => '400',
				'display_scrollbar' => false,
				'display_frame' => false,
				'frame_key' => 'frame_1',
			)
		);
		$result = $this->IframeFrameSetting->saveIframeFrameSetting($postData);
		$this->assertArrayHasKey('IframeFrameSetting', $result, 'Error saveIframe');

		$frameKey = 'frame_1';
		$result = $this->IframeFrameSetting->getIframeFrameSetting($frameKey);

		$expected = array(
			'IframeFrameSetting' => array(
				'height' => '400',
				'display_scrollbar' => false,
				'display_frame' => false,
				'frame_key' => 'frame_1',
				'id' => '3',
			)
		);

		$this->__assertGetIframeFrameSetting($expected, $result);
	}

/**
 * testSaveIframeFrameSettingRollbackByError method
 *
 * @return void
 */
	public function testSaveIframeFrameSettingRollbackByError() {
		$this->Frame = ClassRegistry::init('Frames.Frame');

		$postData = array(
			'IframeFrameSetting' => array(
				'height' => null,
				'display_scrollbar' => false,
				'display_frame' => false,
				'frame_key' => 'frame_1',
			)
		);
		$result = $this->IframeFrameSetting->saveIframeFrameSetting($postData);
		$this->assertFalse($result, 'saveIframeFrameSetting');

		$frameKey = 'frame_1';
		$result = $this->IframeFrameSetting->getIframeFrameSetting($frameKey);

		$expected = array(
			'IframeFrameSetting' => array(
				'height' => '400',
				'display_scrollbar' => true,
				'display_frame' => false,
				'frame_key' => 'frame_1',
				'id' => '2',
			)
		);

		$this->__assertGetIframeFrameSetting($expected, $result);
	}
}
