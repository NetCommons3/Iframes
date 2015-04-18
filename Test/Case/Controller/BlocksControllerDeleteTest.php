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
App::uses('IframesControllerTestCase', 'Iframes.Test/Case/Controller');

/**
 * BlocksController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Controller
 */
class BlocksControllerDeleteTest extends IframesControllerTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		$this->generate(
			'Iframes.Blocks',
			[
				'components' => [
					'Auth' => ['user'],
					'Session',
					'Security',
				]
			]
		);
		parent::setUp();
	}

/**
 * Expect get delete action
 *
 * @return void
 */
	public function testGet() {
		$this->setExpectedException('BadRequestException');

		RolesControllerTest::login($this);

		$frameId = 1;
		$blockId = 1;
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect get delete action
 *
 * @return void
 */
	public function testGetJson() {
		RolesControllerTest::login($this);

		$frameId = 1;
		$blockId = 1;
		$contents = $this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'get',
					'return' => 'view',
					'type' => 'json',
					'return' => 'contents'
				)
			);
		$result = json_decode($contents, true);

		$this->assertArrayHasKey('code', $result);
		$this->assertEquals(400, $result['code']);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect get delete action without block.
 *
 * @return void
 */
	public function testGetWithoutBlock() {
		$this->setExpectedException('BadRequestException');

		RolesControllerTest::login($this);

		$frameId = 1;
		$blockId = 3;
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect get delete action without block.
 *
 * @return void
 */
	public function testGetWithoutBlockJson() {
		RolesControllerTest::login($this);

		$frameId = 1;
		$blockId = 3;
		$contents = $this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'get',
					'return' => 'view',
					'type' => 'json',
					'return' => 'contents'
				)
			);
		$result = json_decode($contents, true);

		$this->assertArrayHasKey('code', $result);
		$this->assertEquals(400, $result['code']);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect post delete action
 *
 * @return void
 */
	public function testDelete() {
		RolesControllerTest::login($this);

		$frameId = 1;
		$blockId = 1;
		$data = array(
			'Iframe' => array(
				'id' => '1',
				'key' => 'iframe_1',
			),
			'Block' => array(
				'id' => $blockId,
				'key' => 'block_1',
			),
		);
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'delete',
					'data' => $data,
					'return' => 'view',
				)
			);
		$this->assertTextEquals('delete', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}
}
