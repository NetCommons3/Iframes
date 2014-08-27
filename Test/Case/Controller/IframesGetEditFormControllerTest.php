<?php
/**
 * IframesGetEditFormController Test Case
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
 * IframesGetEditFormController Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Test.Controller.Case
 */
class IframesGetEditFormControllerTest extends ControllerTestCase {

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
 * httpXRequestedWith
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     array
 */
	public $httpXRequestedWith = null;

/**
 * setUp
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function setUp() {
		parent::setUp();

		//Ajaxを有効にする
		$this->httpXRequestedWith = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : null;
		$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
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

		//Ajaxの設定を元に戻す。
		if (! isset($this->httpXRequestedWith)) {
			unset($_SERVER['HTTP_X_REQUESTED_WITH']);
		} else {
			$_SERVER['HTTP_X_REQUESTED_WITH'] = $this->httpXRequestedWith;
		}

		parent::tearDown();
	}

/**
 * get form edit
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testGetEditForm() {
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

		$frameId = 1;
		$this->testAction('/iframes/iframes/get_edit_form/' . $frameId . '/', array('method' => 'get'));

		//ログアウト処理
		$this->Controller->Auth->logout();
		//$this->assertFalse($this->Controller->Auth->loggedIn());
	}

/**
 * get form edit no login
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testGetEditFormNoLogin() {
		$frameId = 1;
		$this->testAction('/iframes/iframes/get_edit_form/' . $frameId . '/', array('method' => 'get'));
	}

}
