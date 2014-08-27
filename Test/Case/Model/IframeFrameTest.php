<?php
/**
 * Iframe Test Case
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Test.Model.Case
 */

App::uses('IframeFrame', 'Iframes.Model');
App::uses('IframeBlock', 'Iframes.Model');


/**
 * IframeFrame Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Model.Case
 */
class IframeFrameTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @var         array
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
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @return      void
 */
	public function setUp() {
		parent::setUp();
		$this->IframeFrame = ClassRegistry::init('Iframes.IframeFrame');
	}

/**
 * tearDown method
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @return      void
 */
	public function tearDown() {
		unset($this->IframeFrame);
		parent::tearDown();
	}

/**
 * testGetBlockId
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @return      void
 */
	public function testGetBlockId() {
		$frameId = 1;
		$rtn = $this->IframeFrame->getBlockId($frameId);
		$this->assertTextEquals($rtn, 1);
	}

/**
 * testGetBlockIdNoData
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @return      void
 */
	public function testGetBlockIdNoData() {
		$frameId = 9999999999;
		$rtn = $this->IframeFrame->getBlockId($frameId);
		$this->assertNull($rtn);
	}
}
