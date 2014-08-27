<?php
/**
 * IframeDatum Test Case
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Model.Case
 */

App::uses('IframeDatum', 'Iframes.Model');

/**
 * IframeDatum Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Model.Case
 */
class IframeDatumGetDataTest extends CakeTestCase {

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
 * testGetPublishData
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testGetPublishData() {
		$blockId = 1;
		$langId = 2;
		$mine = $this->IframeDatum->getPublishData($blockId, $langId);
		$this->assertTrue(is_numeric($mine['IframeDatum']['id']));
		$this->assertTextEquals(1, $mine['IframeDatum']['id']);
	}

/**
 * testGetPublishData error
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testGetPublishDataError() {
		$datum = array(
			array('blockId' => 999999999, 'langId' => 2),
			array('blockId' => null, 'langId' => 2),
			array('blockId' => 1, 'langId' => 999999999),
			array('blockId' => 1, 'langId' => null),
		);

		foreach ($datum as $data) {
			$blockId = $data['blockId'];
			$langId = $data['langId'];

			$mine = $this->IframeDatum->getPublishData($blockId, $langId);
			$this->assertTrue(empty($mine) && is_array($mine), print_r($data, true));
		}
	}

/**
 * testGetData no isSetting
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testGetDataNoIsSetting() {
		$data = array(
			'blockId' => 1, 'langId' => 2
		);
		$blockId = $data['blockId'];
		$langId = $data['langId'];
		$isSetting = true;

		$mine = $this->IframeDatum->getData($blockId, $langId);

		$this->assertTrue(is_numeric($mine['IframeDatum']['id']), print_r($data, true));
		$this->assertTextEquals(1, $mine['IframeDatum']['id'], print_r($data, true));

		$datum = array(
			array('blockId' => 1, 'langId' => 2, 'isSetting' => null),
			array('blockId' => 1, 'langId' => 2, 'isSetting' => false),
		);
		foreach ($datum as $data) {
			$blockId = $data['blockId'];
			$langId = $data['langId'];
			$isSetting = $data['isSetting'];

			$mine = $this->IframeDatum->getData($blockId, $langId, $isSetting);

			$this->assertTrue(is_numeric($mine['IframeDatum']['id']), print_r($data, true));
			$this->assertTextEquals(1, $mine['IframeDatum']['id'], print_r($data, true));
		}
	}

/**
 * testGetData isSetting
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testGetDataIsSetting() {
		$isSetting = true;

		$blockId = 1;
		$langId = 2;
		$mine = $this->IframeDatum->getData($blockId, $langId, $isSetting);
		$this->assertTrue(is_numeric($mine['IframeDatum']['id']));
		$this->assertTextEquals(2, $mine['IframeDatum']['id']);
	}

/**
 * testGetData error
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testGetDataError() {
		$datum = array(
			array('blockId' => null, 'langId' => null, 'isSetting' => false),
			array('blockId' => null, 'langId' => null, 'isSetting' => true),
			array('blockId' => null, 'langId' => null, 'isSetting' => null),

			array('blockId' => 999999999, 'langId' => 999999999, 'isSetting' => false),
			array('blockId' => 999999999, 'langId' => 999999999, 'isSetting' => true),
			array('blockId' => 999999999, 'langId' => 999999999, 'isSetting' => null),

			array('blockId' => 999999999, 'langId' => 2, 'isSetting' => false),
			array('blockId' => 999999999, 'langId' => 2, 'isSetting' => true),
			array('blockId' => 999999999, 'langId' => 2, 'isSetting' => null),

			array('blockId' => null, 'langId' => 2, 'isSetting' => false),
			array('blockId' => null, 'langId' => 2, 'isSetting' => true),
			array('blockId' => null, 'langId' => 2, 'isSetting' => null),

			array('blockId' => 1, 'langId' => 999999999, 'isSetting' => false),
			array('blockId' => 1, 'langId' => 999999999, 'isSetting' => true),
			array('blockId' => 1, 'langId' => 999999999, 'isSetting' => null),

			array('blockId' => 1, 'langId' => null, 'isSetting' => false),
			array('blockId' => 1, 'langId' => null, 'isSetting' => true),
			array('blockId' => 1, 'langId' => null, 'isSetting' => null),
		);
		foreach ($datum as $data) {
			$blockId = $data['blockId'];
			$langId = $data['langId'];
			$isSetting = $data['isSetting'];

			$mine = $this->IframeDatum->getData($blockId, $langId, $isSetting);

			$this->assertTrue(empty($mine) && is_array($mine), print_r($data, true));
		}
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

		parent::tearDown();
	}

}
