<?php
/**
 * Iframe Model Test
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsBlockComponent', 'NetCommons.Controller/Component');
App::uses('NetCommonsRoomRoleComponent', 'NetCommons.Controller/Component');
App::uses('Iframe', 'Iframes.Model');
App::uses('YACakeTestCase', 'NetCommons.TestSuite');
App::uses('AuthComponent', 'Component');

/**
 * Iframe Model Test
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframesModelTestBase extends YACakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.blocks.block',
		'plugin.blocks.block_role_permission',
		'plugin.boxes.box',
		'plugin.frames.frame',
		'plugin.iframes.iframe',
		'plugin.m17n.language',
		'plugin.net_commons.plugin',
		'plugin.rooms.room',
		'plugin.rooms.roles_room',
		'plugin.users.user',
		'plugin.users.user_attributes_user',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Iframe = ClassRegistry::init('Iframes.Iframe');
		$this->Block = ClassRegistry::init('Blocks.Block');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Iframe);
		unset($this->Block);
		parent::tearDown();
	}

/**
 * _assertArray method
 *
 * @param array $expected expected data
 * @param array $result result data
 * @return void
 */
	protected function _assertArray($expected, $result) {
		$result = Hash::remove($result, 'created');
		$result = Hash::remove($result, 'created_user');
		$result = Hash::remove($result, 'modified');
		$result = Hash::remove($result, 'modified_user');
		$result = Hash::remove($result, '{s}.created');
		$result = Hash::remove($result, '{s}.created_user');
		$result = Hash::remove($result, '{s}.modified');
		$result = Hash::remove($result, '{s}.modified_user');
		$result = Hash::remove($result, 'TrackableCreator');
		$result = Hash::remove($result, 'TrackableUpdater');

		$this->assertEquals($expected, $result);
	}
}
