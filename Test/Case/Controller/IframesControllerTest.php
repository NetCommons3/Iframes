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

/**
 * IframesController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test
 */
class IframesControllerTest extends ControllerTestCase {

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
 * setUp
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function setUp() {
		parent::setUp();
	}

/**
 * tearDown method
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function tearDown() {
		parent::tearDown();
	}

/**
 * test index
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testIndex() {
		$frameId = 1;
		$this->testAction('/iframes/iframes/index/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * test view latest data
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testView() {
		$frameId = 1;
		$this->testAction('/iframes/iframes/view/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * test view publishing data
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testViewPublishingData() {
		CakeSession::write('Auth.User.id', 0);
		$frameId = 3;
		$this->testAction('/iframes/iframes/view/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * test view non publishing data
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testViewNonPublishingData() {
		CakeSession::write('Auth.User.id', 0);
		$frameId = 4;
		$this->testAction('/iframes/iframes/view/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * test not exist iframe
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotExistIframe() {
		$frameId = 2;
		//セッティングモードON
		Configure::write('Pages.isSetting', true);
		$this->testAction('/iframes/iframes/view/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * test not exist frameId
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotExistFrameId() {
		$frameId = 1000;
		$this->testAction('/iframes/iframes/view/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

/**
 * test not AuthUser and not exist iframe
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function testNotAuthUserAndNotExistIframe() {
		CakeSession::write('Auth.User.id', 0);
		$frameId = 2;
		$this->testAction('/iframes/iframes/view/' . $frameId . '/', array('method' => 'get'));
		$this->assertTextNotContains('ERROR', $this->view);
	}

}