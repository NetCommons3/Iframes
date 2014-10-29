<?php
/**
 * IframesController Test Case
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
 * IframesController Test Case
 *
 * @package NetCommons\Iframes\Test\Case\Controller
 */
class IframesControllerTest extends ControllerTestCase {

/**
 * mock controller object
 *
 * @var null
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
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		Configure::write('Config.language', null);
		parent::tearDown();
	}

/**
 * testBeforeFilterByNoSetFrameId method
 *
 * @return void
 */
	public function testBeforeFilterByNoSetFrameId() {
		$this->setExpectedException('ForbiddenException');
		$this->testAction('/iframes/iframes/index', array('method' => 'get'));
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->testAction('/iframes/iframes/index/1', array('method' => 'get'));

		$expected = 'http://www.netcommons.org/';
		$this->assertTextContains($expected, $this->view);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->testAction('/iframes/iframes/view/1', array('method' => 'get'));

		$expected = 'http://www.netcommons.org/';
		$this->assertTextContains($expected, $this->view);
	}

}
