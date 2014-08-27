<?php
/**
 * IframesLoginController Test Case
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
 * IframesLoginController Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Test.Controller.Case
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class IframesLoginControllerTest extends ControllerTestCase {

/**
 * Controller name
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     string
 */
	public $name = 'IframesControllerTest';

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
 * setUp
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function setUp() {
		parent::setUp();

		//ログイン処理
		$this->Controller = $this->generate('Iframes.Iframes', array(
			'components' => array(
				'Auth' => array('user'),
				'Session',
				'Security',
				'RequestHandler',
			),
		));

		$this->Controller->Auth
			->staticExpects($this->any())
			->method('user')
			->will($this->returnCallback(array($this, 'authUserCallback')));

		$this->Controller->Auth->login(array(
				'username' => 'admin',
				'password' => 'admin',
			)
		);

		$this->assertTrue($this->Controller->Auth->loggedIn());
	}

/**
 * authUserCallback
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   mixed
 */
	public function authUserCallback() {
		$auth = array(
			'id' => 1,
			'username' => 'admin',
		);
		return $auth;
	}

/**
 * tearDown method
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  void
 */
	public function tearDown() {
		//セッティングモードOFF
		Configure::write('Pages.isSetting', false);

		//ログアウト処理
		$this->Controller->Auth->logout();

		$this->assertFalse($this->Controller->Auth->loggedIn());

		parent::tearDown();
	}

/**
 * index no publish
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testIndexNoPlubish() {
		$this->setUp();
		Configure::write('Pages.isSetting', true);

		$frameId = 12;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));
		$correct = 'nc-iframes-view-' . $frameId;
		$this->assertContains($correct, $this->view, $correct);

		$this->setUp();
		Configure::write('Pages.isSetting', true);

		$frameId = 13;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));
		$correct = 'nc-iframes-view-' . $frameId;
		$this->assertContains($correct, $this->view, $correct);

		$this->setUp();
		Configure::write('Pages.isSetting', true);

		$frameId = 14;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));
		$correct = 'nc-iframes-view-' . $frameId;
		$this->assertContains($correct, $this->view, $correct);
	}

/**
 * index "login" and "setting off"
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testIndexLoginSettingOff() {
		$this->setUp();
		Configure::write('Pages.isSetting', false);

		//フレームID、ブロックIDあり
		$frameId = 11;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));
		$correct = 'nc-iframes-view-' . $frameId;
		$this->assertContains($correct, $this->view, $correct);

		$this->setUp();
		Configure::write('Pages.isSetting', false);
		//フレームIDあり、ブロックIDなし
		$frameId = 3;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
		$this->assertTextEquals('', trim($this->view));
	}

}