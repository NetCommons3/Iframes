<?php
/**
 * IframeFrameSettingsPostEditController Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('IframesController', 'Iframes.Controller');

/**
 * IframeFrameSettingPostEditController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test
 */
class IframeFrameSettingPostEditControllerTest extends ControllerTestCase {

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
		//Ajax有効化
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
		//Ajaxの設定を元に戻す。
		if (! isset($this->httpXRequestedWith)) {
			unset($_SERVER['HTTP_X_REQUESTED_WITH']);
		} else {
			$_SERVER['HTTP_X_REQUESTED_WITH'] = $this->httpXRequestedWith;
		}
		//ログアウト処理
		$this->Controller->Auth->logout();
		//セッティングモードOFF
		Configure::write('Pages.isSetting', false);
		parent::tearDown();
	}

/**
 * post edit method test
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testPostEdit() {
		$frameId = 1;
		$frameKey = '12345';

		$data = array();
		$data['Frame']['frame_key'] = $frameKey;
		$data['IframeFrameSetting']['height'] = 400;
		$data['IframeFrameSetting']['display_scrollbar'] = 1;
		$data['IframeFrameSetting']['display_frame'] = 1;

		Configure::write('Pages.isSetting', true);
		CakeSession::write('Auth.User.id', 1);
		$this->testAction('/iframes/iframes/iframeFrameSettingEdit/' . $frameId . '/',
			array(
				'method' => 'POST',
				'data' => $data
			)
		);
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * post edit method test
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotExistFrameKey() {
		$frameId = 1;
		$frameKey = '';

		$data = array();
		$data['Frame']['frame_key'] = $frameKey;
		$data['IframeFrameSetting']['height'] = 400;
		$data['IframeFrameSetting']['display_scrollbar'] = 1;
		$data['IframeFrameSetting']['display_frame'] = 1;

		Configure::write('Pages.isSetting', true);
		CakeSession::write('Auth.User.id', 1);
		$this->testAction('/iframes/iframes/iframeFrameSettingEdit/' . $frameId . '/',
			array(
				'method' => 'POST',
				'data' => $data
			)
		);
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * post edit method test
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotExistData() {
		$frameId = 1;
		$data = '';

		Configure::write('Pages.isSetting', true);
		CakeSession::write('Auth.User.id', 1);
		$this->testAction('/iframes/iframes/iframeFrameSettingEdit/' . $frameId . '/',
			array(
				'method' => 'POST',
				'data' => $data
			)
		);
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * post edit method test
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotExistFrameId() {
		$frameId = null;
		$frameKey = '12345';

		$data = array();
		$data['Frame']['frame_key'] = $frameKey;
		$data['IframeFrameSetting']['height'] = 400;
		$data['IframeFrameSetting']['display_scrollbar'] = 1;
		$data['IframeFrameSetting']['display_frame'] = 1;

		$this->testAction('/iframes/iframes/iframeFrameSettingEdit/' . $frameId . '/',
			array(
				'method' => 'POST',
				'data' => $data
			)
		);
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * post edit method test
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testSaveIframeFrameSettingError() {
		Configure::write('debug', 0);
		$frameId = 1;
		$frameKey = '12345';
		$data['Frame']['frame_key'] = $frameKey;
		Configure::write('Pages.isSetting', true);
		CakeSession::write('Auth.User.id', 1);
		$this->testAction('/iframes/iframes/iframeFrameSettingEdit/' . $frameId . '/',
			array(
				'method' => 'POST',
				'data' => $data
			)
		);
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * post edit method test
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testMethodError() {
		$datum = array(
			array('frameId' => 1, 'frameKey' => '12345', 'method' => 'GET'),
			array('frameId' => 1, 'frameKey' => '12345', 'method' => 'PUT'),
			array('frameId' => 1, 'frameKey' => '12345', 'method' => 'DELETE'),
			array('frameId' => 1, 'frameKey' => '12345', 'method' => 'aaaaaaa'),
		);

		foreach ($datum as $data) {
			$this->view = null;
			$this->setUp();

			$frameId = $data['frameId'];
			$frameKey = $data['frameKey'];
			$method = $data['method'];

			$data = array();
			$data['Frame']['frame_key'] = $frameKey;
			$data['IframeFrameSetting']['height'] = 400;
			$data['IframeFrameSetting']['display_scrollbar'] = 1;
			$data['IframeFrameSetting']['display_frame'] = 1;

			$this->testAction('/iframes/iframes/iframeFrameSettingEdit/' . $frameId . '/',
				array(
					'method' => $method,
					'data' => $data
				)
			);
			$this->assertTextNotContains('ERROR', $this->view, print_r($data, true));
			$this->tearDown();
		}
	}

}
