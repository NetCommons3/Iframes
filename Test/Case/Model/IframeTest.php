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

App::uses('Iframe', 'Iframes.Model');

/**
 * Iframe Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.AccessCounters.Test.Model.Case
 */
class IframeTest extends CakeTestCase {

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
		$this->Iframe = ClassRegistry::init('Iframes.Iframe');
	}

/**
 * tearDown method
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function tearDown() {
		unset($this->Iframe);
		parent::tearDown();
	}

/**
 * testSaveBlockId
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testSaveBlockId() {
		$dd['Iframe']['block_id'] = 1;
		$dd['Iframe']['created_user_id'] = 1;
		$dd['Iframe']['modified_user_id'] = 1;
		$mine = $this->Iframe->save($dd);
		$this->assertTrue(is_numeric($mine['Iframe']['id']));
	}

/**
 * testGetByBlockId
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testGetByBlockId() {
		//blockId1のデータを作成
		$dd['Iframe']['block_id'] = 1;
		$dd['Iframe']['created_user_id'] = 1;
		$dd['Iframe']['modified_user_id'] = 1;
		$mine = $this->Iframe->save($dd);
		$this->assertTrue(is_numeric($mine['Iframe']['id']));
		$data = $this->Iframe->getByBlockId(1);
		$this->assertTrue(is_numeric($data));
	}

/**
 * testGetByBlockIdNoData
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testGetByBlockIdNoData() {
		//blockId1のデータを作成
		$dd['Iframe']['block_id'] = 1;
		$dd['Iframe']['created_user_id'] = 1;
		$dd['Iframe']['modified_user_id'] = 1;
		$mine = $this->Iframe->save($dd);
		$this->assertTrue(is_numeric($mine['Iframe']['id']));
		$data = $this->Iframe->getByBlockId(99999);
		$this->assertNull($data);
	}

}
