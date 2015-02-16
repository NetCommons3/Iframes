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

App::uses('IframeFrameSettingAppModelTest', 'Iframes.Test/Case/Model');

/**
 * IfrIframeFrameSettingame Model Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframeFrameSettingTest extends IframeFrameSettingAppModelTest {

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
 * testGetIframeFrameSetting method
 *
 * @return void
 */
	public function testGetIframeFrameSetting() {
		$frameKey = 'frame_1';

		$result = $this->IframeFrameSetting->getIframeFrameSetting($frameKey);

		$expected = array(
			'IframeFrameSetting' => array(
				'id' => '1',
				'frame_key' => $frameKey,
			),
			/* 'Frame' => array( */
			/* 	'id' => $frameId */
			/* ), */
		);
		/* var_dump($result); */

		$this->_assertArray(null, $expected, $result);
	}

/**
 * testGetIframeFrameSettingByNoFrameKey method
 *
 * @return void
 */
	public function testGetIframeFrameSettingByNoFrameKey() {
		$frameKey = 'frame_10';
		$result = $this->IframeFrameSetting->getIframeFrameSetting($frameKey);

		$expected = array(
		);

		$this->_assertArray(null, $expected, $result);
	}

/**
 * testSaveIframeFrameSetting method
 *
 * @return void
 */
	public function testSaveIframeFrameSetting() {
		$frameKey = 'frame_1';

		$postData = array(
			'IframeFrameSetting' => array(
				'frame_key' => $frameKey,
				'height' => 300,
				'display_scrollbar' => false,
				'display_frame' => false,
			),
			'Frame' => array(
				'key' => $frameKey
			),
		);
		$this->IframeFrameSetting->saveIframeFrameSetting($postData);

		$result = $this->IframeFrameSetting->getIframeFrameSetting($frameKey);

		$expected = array(
			'IframeFrameSetting' => array(
				'id' => '2',
				'frame_key' => $frameKey,
			),
		);

		$this->_assertArray(null, $expected, $result);
	}

}
