<?php
/**
 * IframeBlock Test Case
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Model.Case
 */

App::uses('IframeBlock', 'Iframe.Model');

/**
 * IframeBlock Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Model.Case
 */
class IframeBlockTest extends CakeTestCase {

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
		$this->IframeBlock = ClassRegistry::init('Iframes.IframeBlock');
	}

/**
 * testIndex
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testIndex() {
		$this->assertTrue(true);
	}

/**
 * testSaveBlockId
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testSaveBlockId() {
		$dd['IframeBlock']['id'] = 1;
		$dd['IframeBlock']['room_id'] = 1;
		$dd['IframeBlock']['create_user_id'] = 1;
		$mine = $this->IframeBlock->save($dd);
		$this->assertTrue(is_numeric($mine['IframeBlock']['id']));
	}

/**
 * tearDown method
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function tearDown() {
		unset($this->IframeBlock);

		parent::tearDown();
	}

}
