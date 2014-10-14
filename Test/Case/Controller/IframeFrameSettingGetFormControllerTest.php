<?php
/**
 * IframeFrameSettingGetFormController Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('IframesController', 'Iframes.Controller');

/**
 * IframeFrameSettingGetFormController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package app.Plugin.Iframes.Test
 */
class IframeFrameSettingGetFormController extends ControllerTestCase {

/**
 * Controller name
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var string
 */
	public $name = 'IframesControllerTest';

/**
 * Fixtures
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $fixtures = array(
		'app.Page',
		'app.Session',
		'app.SiteSetting',
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
 * httpXRequestedWith
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $httpXRequestedWith = null;

/**
 * setUp
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
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
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return array
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
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
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
 * get form method
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testIframeFrameSettingGetForm() {
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
		Configure::write('Pages.isSetting', true);
		CakeSession::write('Auth.User.id', 1);
		$frameId = 1;
		$this->testAction('/iframes/iframes/IframeFrameSettingForm/' . $frameId . '/', array('method' => 'get'));
		$this->Controller->Auth->logout();
	}

/**
 * get form method `not login`
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotLogin() {
		CakeSession::write('Auth.User.id', 0);
		$frameId = 3;
		$this->testAction('/iframes/iframes/IframeFrameSettingForm/' . $frameId . '/', array('method' => 'get'));
	}

/**
 * get form method `not exist frameId`
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotExistFrameId() {
		$frameId = 1000;
		$this->testAction('/iframes/iframes/IframeFrameSettingForm/' . $frameId . '/', array('method' => 'get'));
	}

/**
 * get form method `not exist iframe`
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotExistIframe() {
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
		Configure::write('Pages.isSetting', true);
		CakeSession::write('Auth.User.id', 1);
		$frameId = 2;
		$this->testAction('/iframes/iframes/IframeFrameSettingForm/' . $frameId . '/', array('method' => 'get'));
		$this->Controller->Auth->logout();
	}

}
