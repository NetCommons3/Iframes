<?php
/**
 * IframeEditControllerLoginUser Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesController', 'Iframes.Controller');
App::uses('NetCommonsFrameComponent', 'NetCommons.Controller/Component');
App::uses('NetCommonsBlockComponent', 'NetCommons.Controller/Component');
App::uses('NetCommonsRoomRoleComponent', 'NetCommons.Controller/Component');

/**
 * IframeEditControllerLoginUser Test Case
 *
 * @package NetCommons\Iframes\Test\Case\Controller
 */
class IframeEditControllerLoginUserTest extends ControllerTestCase {

/**
 * mock controller object
 *
 * @var Controller
 */
	public $Controller = null;

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'site_setting',
		'plugin.iframes.iframe',
		'plugin.iframes.iframe_frame_setting',
		'plugin.iframes.block',
		'plugin.iframes.frame',
		'plugin.iframes.plugin',
		'plugin.frames.box',
		'plugin.frames.language',
		'plugin.rooms.room',
		'plugin.rooms.roles_rooms_user',
		'plugin.rooms.roles_room',
		'plugin.rooms.room_role_permission',
		'plugin.rooms.user',
		'plugin.roles.default_role_permission',
		'plugin.pages.page',
	);

/**
 * setUp
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		Configure::write('Config.language', 'ja');
		$this->login();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		$this->logout();
		Configure::write('Config.language', null);
		parent::tearDown();
	}

/**
 * login　method
 *
 * @return void
 */
	public function login() {
		//ログイン処理
		$this->Controller = $this->generate('Iframes.IframeEdit', array(
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
				'role_key' => 'system_administrator',
			)
		);
		$this->assertTrue($this->Controller->Auth->loggedIn(), 'login');
	}

/**
 * logout method
 *
 * @return void
 */
	public function logout() {
		//ログアウト処理
		$this->Controller->Auth->logout();
		$this->assertFalse($this->Controller->Auth->loggedIn(), 'logout');

		CakeSession::write('Auth.User', null);
		unset($this->Controller);
	}

/**
 * authUserCallback method
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @return array user
 */
	public function authUserCallback() {
		$user = array(
			'id' => 1,
			'username' => 'admin',
			'role_key' => 'system_administrator',
		);
		CakeSession::write('Auth.User', $user);
		return $user;
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->testAction('/iframes/iframe_edit/index/1', array('method' => 'get'));

		//iframe編集
		$this->assertTextContains('<input name="data[Iframe][url]"', $this->view);

		$this->assertTextContains('ng-click="cancel()"', $this->view);
		$this->assertTextContains('ng-click="save(\'3\')"', $this->view);
		$this->assertTextContains('ng-click="save(\'1\')"', $this->view);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->testAction('/iframes/iframe_edit/view/1', array('method' => 'get'));

		//iframe編集
		$this->assertTextContains('<input name="data[Iframe][url]"', $this->view);

		$this->assertTextContains('ng-click="cancel()"', $this->view);
		$this->assertTextContains('ng-click="save(\'3\')"', $this->view);
		$this->assertTextContains('ng-click="save(\'1\')"', $this->view);
	}

/**
 * testForm method
 *
 * @return void
 */
	public function testForm() {
		$this->testAction('/iframes/iframe_edit/form/1', array('method' => 'get'));

		//登録前のForm取得
		$this->assertTextContains('<form action="', $this->view);
		$this->assertTextContains('/iframes/iframe_edit/form/1', $this->view);
		$this->assertTextContains('name="data[Iframe][url]"', $this->view);
		$this->assertTextContains('type="hidden" name="data[Frame][id]"', $this->view);
		$this->assertTextContains('type="hidden" name="data[Iframe][block_id]"', $this->view);
		$this->assertTextContains('select name="data[Iframe][status]"', $this->view);
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'status' => '1',
				'url' => 'http://www.netcommons.org/',
			),
			'Frame' => array(
				'id' => '1'
			)
		);

		$this->testAction('/iframes/iframe_edit/edit/1.json',
			array(
				'method' => 'post',
				'data' => $postData
			)
		);

		$this->assertEquals('result', $this->vars['_serialize']);

		$result = array_shift($this->vars['result']);
		$this->assertEquals(__d('net_commons', 'Successfully finished.'), $result);

		$this->assertArrayHasKey('iframe', $this->vars['result']);
	}
}
