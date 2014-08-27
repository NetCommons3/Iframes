<?php
/**
 * IframesPostEditController Test Case
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
 * IframesPostEditController Test Case
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Test.Controller.Case
 */
class IframesPostEditControllerTest extends ControllerTestCase {

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
		//Ajaxの設定を元に戻す。
		if (! isset($this->httpXRequestedWith)) {
			unset($_SERVER['HTTP_X_REQUESTED_WITH']);
		} else {
			$_SERVER['HTTP_X_REQUESTED_WITH'] = $this->httpXRequestedWith;
		}

		//ログアウト処理
		$this->Controller->Auth->logout();
		//$this->assertFalse($this->Controller->Auth->loggedIn());

		//セッティングモードOFF
		Configure::write('Pages.isSetting', false);

		parent::tearDown();
	}

/**
 * post edit
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testPostEdit() {
		$this->view = null;
		$this->setUp();

		$frameId = 1;
		$blockId = 1;
		$langId = 2;

		$inputData = array();
		$inputData['IframeDatum']['frame_id'] = $frameId;
		$inputData['IframeDatum']['block_id'] = $blockId;
		$inputData['IframeDatum']['type'] = 'Draft';
		$inputData['IframeDatum']['langId'] = $langId;
		$inputData['IframeDatum']['id'] = 0;
		$inputData['IframeDatum']['url'] = 'http://www.netcommons.org/';
		$inputData['IframeDatum']['frame_height'] = 400;
		$inputData['IframeDatum']['scrollbar_show'] = 1;
		$inputData['IframeDatum']['scrollframe_show'] = 1;
		$this->testAction('/iframes/iframes/edit/' . $frameId . '/',
			array(
				'method' => 'post',
				'data' => $inputData
			)
		);

		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * post edit "GET"
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testPostEditMethodError() {
		$datum = array(
			array('frameId' => 1, 'blockId' => 1, 'langId' => 2, 'method' => 'get'),
			array('frameId' => 1, 'blockId' => 1, 'langId' => 2, 'method' => 'put'),
			array('frameId' => 1, 'blockId' => 1, 'langId' => 2, 'method' => 'delete'),
			array('frameId' => 1, 'blockId' => 1, 'langId' => 2, 'method' => 'aaaaaa'),
		);

		foreach ($datum as $data) {
			$this->view = null;
			$this->setUp();

			$frameId = $data['frameId'];
			$blockId = $data['blockId'];
			$langId = $data['langId'];
			$method = $data['method'];

			$inputData = array();
			$inputData['IframeDatum']['frame_id'] = $frameId;
			$inputData['IframeDatum']['block_id'] = $blockId;
			$inputData['IframeDatum']['type'] = 'Draft';
			$inputData['IframeDatum']['langId'] = $langId;
			$inputData['IframeDatum']['id'] = 0;
			$inputData['IframeDatum']['url'] = 'http://www.netcommons.org/';
			$inputData['IframeDatum']['frame_height'] = 400;
			$inputData['IframeDatum']['scrollbar_show'] = 1;
			$inputData['IframeDatum']['scrollframe_show'] = 1;
			$this->testAction('/iframes/iframes/edit/' . $frameId . '/',
				array(
					'method' => $method,
					'data' => $inputData
				)
			);

			$this->assertTextNotContains('ERROR', $this->view, print_r($inputData, true));

			$this->tearDown();
		}
	}

/**
 * post edit "GET"
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function testPostEditSaveError() {
		$datum = array(
			array('frameId' => null, 'blockId' => 1, 'langId' => 2),
		);
		foreach ($datum as $data) {
			$this->view = null;
			$this->setUp();

			$frameId = $data['frameId'];
			$blockId = $data['blockId'];
			$langId = $data['langId'];

			$inputData = array();
			$inputData['IframeDatum']['frame_id'] = $frameId;
			$inputData['IframeDatum']['block_id'] = $blockId;
			$inputData['IframeDatum']['id'] = 1;
			$inputData['IframeDatum']['url'] = 'http://www.netcommons.org/';
			$inputData['IframeDatum']['frame_height'] = 400;
			$inputData['IframeDatum']['scrollbar_show'] = 1;
			$inputData['IframeDatum']['scrollframe_show'] = 1;
			$inputData['IframeDatum']['type'] = 3;
			$inputData['IframeDatum']['langId'] = $langId;
			$this->testAction('/iframes/iframes/edit/' . $frameId . '/',
				array(
					'method' => 'post',
					'data' => $inputData
				)
			);

			$this->assertTextNotContains('ERROR', $this->view, 'inputData=' . print_r($inputData, true) . "\ninputData=" . print_r($inputData, true));

			$this->tearDown();
		}
	}

}
