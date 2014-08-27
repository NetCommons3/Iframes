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
class IframeDatumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @var array
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
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IframeDatum = ClassRegistry::init('Iframes.IframeDatum');
	}

/**
 * tearDown method
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @return void
 */
	public function tearDown() {
		unset($this->IframeDatum);
		parent::tearDown();
	}

/**
 * saveData
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @return void
 */
	public function testGetDataIsSetting() {
		$blockId = 1;
		$lang = 2;
		$isSetting = 1;
		$rtn = $this->IframeDatum->getData($blockId, $lang, $isSetting);
		//セッティングモードなので下書きを含む最新がとれる
		$this->assertTextEquals($rtn['IframeDatum']['id'], 2);
	}

/**
 * saveData
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @return void
 */
	public function testGetData() {
		$blockId = 1;
		$lang = 2;
		$isSetting = 0;
		$rtn = $this->IframeDatum->getData($blockId, $lang, $isSetting);
		//セッティングモードOFFなので公開情報がとれる
		$this->assertTextEquals($rtn['IframeDatum']['id'], 1);
	}

}
