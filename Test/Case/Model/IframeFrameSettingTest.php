<?php
/**
 * IframeFrameSetting Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('IframeFrameSetting', 'Iframes.Model');

/**
 * IframeFrameSetting Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package app.Plugin.Iframes.Model
 */
class IframeFrameSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $fixtures = array(
		'plugin.iframes.iframe',
		'plugin.iframes.iframe_frame_setting',
		'plugin.iframes.frame',
		'plugin.iframes.box',
		'plugin.iframes.block',
		'plugin.iframes.plugin',
		'plugin.iframes.part',
		'plugin.iframes.parts_rooms_user',
		'plugin.iframes.room',
		'plugin.iframes.user',
		'plugin.iframes.room_part',
		'plugin.iframes.language',
		'plugin.iframes.languages_part',
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
		parent::tearDown();
	}

/**
 * a method test
 *
 * @return void
 */
	public function testGetIFrameFrameSetting() {
		$frameKey = '12345';
		$rtn = $this->IframeFrameSetting->getIframeFrameSetting($frameKey);
		$this->assertEqual(1, $rtn[$this->IframeFrameSetting->name]['id']);
	}

}
