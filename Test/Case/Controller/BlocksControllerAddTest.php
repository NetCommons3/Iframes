<?php
/**
 * BlocksController Test Case
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesController', 'Iframes.Controller');
App::uses('BlocksControllerTestBase', 'Iframes.Test/Case/Controller');

/**
 * BlocksController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Controller
 */
class BlocksControllerAddTest extends BlocksControllerTestBase {

/**
 * Expect get add action
 *
 * @return void
 */
	public function testGet() {
		RolesControllerTest::login($this);

		$frameId = 1;
		$view = $this->testAction(
				'/iframes/blocks/add/' . $frameId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('Blocks/edit', $this->controller->view);

		$this->assertTextContains('/iframes/blocks/add/' . $frameId, $view);
		$this->assertTextContains('name="save"', $view);
		$this->assertTextContains('type="submit"', $view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect post add action
 *
 * @return void
 */
	public function testPost() {
		RolesControllerTest::login($this);

		$frameId = 1;
		$data = array(
			'Iframe' => array(
				'id' => '',
				'block_id' => '',
				'key' => '',
				'url' => 'http://www.netcommons2.org',
				'height' => 300,
				'display_scrollbar' => false,
				'display_frame' => false,
			),
			'Frame' => array(
				'id' => $frameId
			),
			'Block' => array(
				'id' => '',
				'language_id' => '2',
				'room_id' => '1',
				'key' => '',
				'plugin_key' => 'iframes',
				'public_type' => Block::TYPE_PRIVATE,
				'from' => '2015-04-01 12:34',
				'to' => '2015-04-02 01:45',
			),
		);

		$this->testAction(
				'/iframes/blocks/add/' . $frameId,
				array(
					'method' => 'post',
					'data' => $data,
					'return' => 'view',
				)
			);
		$this->assertTextEquals('Blocks/edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect post add action on validation error.
 *
 * @return void
 */
	public function testPostValidationError() {
		RolesControllerTest::login($this);

		$frameId = 1;
		$data = array(
			'Iframe' => array(
				'id' => '',
				'block_id' => '',
				'key' => '',
				'url' => '',
				'height' => 300,
				'display_scrollbar' => false,
				'display_frame' => false,
			),
			'Frame' => array(
				'id' => $frameId
			),
			'Block' => array(
				'id' => '',
				'language_id' => '2',
				'room_id' => '1',
				'key' => '',
				'plugin_key' => 'iframes',
				'public_type' => Block::TYPE_PRIVATE,
				'from' => '2015-04-01 12:34',
				'to' => '2015-04-02 01:45',
			),
		);

		$this->testAction(
				'/iframes/blocks/add/' . $frameId,
				array(
					'method' => 'post',
					'data' => $data,
					'return' => 'view',
				)
			);
		$this->assertTextEquals('Blocks/edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}
}
