<?php
/**
 * IframesController Test Case
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Test.Controller.Case
 */

App::uses('IframesController', 'Iframes.Controller');

/**
 * IframesController Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Test.Controller.Case
 */
class IframesControllerTest extends ControllerTestCase {

/**
 * setUp method
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function setUp() {
		parent::setUp();
	}

/**
 * Fixtures
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     array
 */
	public $fixtures = array(
		'app.Session',
		'app.SiteSetting',
		'app.SiteSettingValue',
		'app.Page',
		'plugin.users.user',
		'plugin.iframes.iframe',
		'plugin.iframes.iframe_language',
		'plugin.iframes.iframe_block',
		'plugin.iframes.iframe_frame',
		'plugin.iframes.iframe_datum'
	);

/**
 * testIndex
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testIndex() {
		$this->testAction('/iframes/iframes/index', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * index no frameId
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testIndexNoFrameId() {
		$this->testAction('/iframes/iframes/index', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		$this->assertTextEquals('', trim($this->view));
	}

/**
 * index no blockId
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testIndexNoBlockId() {
		$frameId = 3;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));

		$this->assertTextNotContains('ERROR', $this->view);
		$this->assertTextEquals('', trim($this->view));
	}

/**
 * index "setting on" and "no login"
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testIndexNoLoginSettingOn() {
		Configure::write('Pages.isSetting', true);

		//フレームID、ブロックIDあり
		$frameId = 1;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));

		$this->assertTextNotContains('ERROR', $this->view);

		$correct = 'nc-iframes-view-' . $frameId;
		$this->assertContains($correct, $this->view, $correct);
	}

/**
 * index "setting on" and "no login" and "no blockId"
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testIndexNoLoginNoBlockId() {
		Configure::write('Pages.isSetting', true);

		//ブロックIDなし
		$frameId = 4;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));

		$this->assertTextNotContains('ERROR', $this->view);
		$this->assertTextEquals('', trim($this->view));
	}

/**
 * get_edit_form
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function testGetEditForm() {
		$this->testAction('/iframes/iframes/get_edit_form/1/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

}