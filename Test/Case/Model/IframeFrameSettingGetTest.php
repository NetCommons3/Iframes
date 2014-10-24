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
class IframeFrameSettingGetTest extends CakeTestCase {

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
		$this->Frame = ClassRegistry::init('Frames.Frame');
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
		$this->assertArrayHasKey('IframeFrameSetting', $result, 'Error ArrayHasKey IframeFrameSetting');
		$this->assertEquals($expected['IframeFrameSetting'], $result['IframeFrameSetting'], 'Error Equals IframeFrameSetting');
	}

/**
 * testGetIframe method
 *
 * @return void
 */
	public function testGetIframeFrameSetting() {
		$frameKey = 'frame_1';
		$result = $this->IframeFrameSetting->getIframeFrameSetting($frameKey);

		$expected = array(
			'IframeFrameSetting' => array(
				'id' => '2',
				'frame_key' => 'frame_1',
				'height' => '400',
				'display_scrollbar' => true,
				'display_frame' => false,
			)
		);

		$this->__assertGetIframeFrameSetting($expected, $result);
	}

/**
 * testGetIframeByNoEditable method
 *
 * @return void
 */
	public function testGetIframeFrameSettingByNoEditable() {
		$frameKey = 'frame_1';
		$result = $this->IframeFrameSetting->getIframeFrameSetting($frameKey);

		$expected = array(
			'IframeFrameSetting' => array(
				'id' => '2',
				'frame_key' => 'frame_1',
				'height' => '400',
				'display_scrollbar' => true,
				'display_frame' => false,
			)
		);

		$this->__assertGetIframeFrameSetting($expected, $result);
	}

}
