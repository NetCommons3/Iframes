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
class IframeEditControllerEditorUserTest extends ControllerTestCase {

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
 * login method
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
				'username' => 'editor',
				'password' => 'editor',
				'role_key' => 'editor',
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
 * @return array user
 */
	public function authUserCallback() {
		$user = array(
			'id' => 3,
			'username' => 'editor',
			'role_key' => 'editor',
		);
		CakeSession::write('Auth.User', $user);
		return $user;
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
}
