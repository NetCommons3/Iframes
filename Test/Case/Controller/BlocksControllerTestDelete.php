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
App::uses('BlocksControllerTest', 'Iframes.Test/Case/Controller');

/**
 * BlocksController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Controller
 * @SuppressWarnings(PHPMD.TooManyMethods)
 */
class BlocksControllerTestDelete extends BlocksControllerTest {

/**
 * Expect get delete action
 *
 * @return void
 */
	public function testPost() {
		$this->setExpectedException('BadRequestException');

		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
					'return' => 'view',
					'data' => array('Block' => array('id' => $blockId)),
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect get delete action
 *
 * @return void
 */
	public function testPostJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$contents = $this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
					'return' => 'view',
					'data' => array('Block' => array('id' => $blockId)),
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
	public function testPostWithoutBlock() {
		$this->setExpectedException('BadRequestException');

		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '144';
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
					'return' => 'view',
					'data' => array('Block' => array('id' => $blockId)),
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect get delete action without block.
 *
 * @return void
 */
	public function testPostWithoutBlockJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '144';
		$contents = $this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
					'return' => 'view',
					'data' => array('Block' => array('id' => $blockId)),
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

		$frameId = '141';
		$blockId = '141';
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

/**
 * Expect bad request by null in blockId on DELETE request
 *
 * @return void
 */
	public function testNullBlockIdOnDelete() {
		$this->setExpectedException('BadRequestException');
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'delete',
					'data' => array('Block' => array('id' => null)),
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect bad request by difference in blockId on DELETE json request
 *
 * @return void
 */
	public function testNullBlockIdOnDeleteJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$contents = $this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'delete',
					'data' => array('Block' => array('id' => null)),
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
 * Expect bad request by difference in blockId on DELETE request
 *
 * @return void
 */
	public function testDifferenceBlockIdOnDelete() {
		$this->setExpectedException('BadRequestException');
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'delete',
					'data' => array('Block' => array('id' => '2')),
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect bad request by difference in blockId on DELETE json request
 *
 * @return void
 */
	public function testDifferenceBlockIdOnDeleteJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$contents = $this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/' . $blockId,
				array(
					'method' => 'delete',
					'data' => array('Block' => array('id' => '2')),
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
 * Expect bad request by difference in blockId on GET request
 *
 * @return void
 */
	public function testNullBlockIdOnGet() {
		$this->setExpectedException('BadRequestException');
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/',
				array(
					'method' => 'delete',
					'data' => array('Block' => array('id' => $blockId)),
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect bad request by difference in blockId on GET json request
 *
 * @return void
 */
	public function testNullBlockIdOnGetJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$contents = $this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/',
				array(
					'method' => 'delete',
					'data' => array('Block' => array('id' => $blockId)),
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
 * Expect bad request by difference in blockId on GET request
 *
 * @return void
 */
	public function testDifferenceBlockIdOnGet() {
		$this->setExpectedException('BadRequestException');
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/2',
				array(
					'method' => 'delete',
					'data' => array('Block' => array('id' => $blockId)),
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect bad request by difference in blockId on GET json request
 *
 * @return void
 */
	public function testDifferenceBlockIdOnGetJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$contents = $this->testAction(
				'/iframes/blocks/delete/' . $frameId . '/2',
				array(
					'method' => 'delete',
					'data' => array('Block' => array('id' => $blockId)),
					'type' => 'json',
					'return' => 'contents'
				)
			);
		$result = json_decode($contents, true);

		$this->assertArrayHasKey('code', $result);
		$this->assertEquals(400, $result['code']);

		AuthGeneralControllerTest::logout($this);
	}
}
