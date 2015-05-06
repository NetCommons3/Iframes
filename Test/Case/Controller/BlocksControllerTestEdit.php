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
class BlocksControllerTestEdit extends BlocksControllerTest {

/**
 * Expect get edit action
 *
 * @return void
 */
	public function testGet() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$view = $this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('edit', $this->controller->view);

		$this->assertTextContains('/iframes/blocks/edit/' . $frameId . '/' . $blockId, $view);
		$this->assertTextContains('name="save"', $view);
		$this->assertTextContains('type="submit"', $view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect get edit action without block.
 *
 * @return void
 */
	public function testGetWithoutBlock() {
		$this->setExpectedException('BadRequestException');

		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '144';
		$this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect get edit action without block.
 *
 * @return void
 */
	public function testGetWithoutBlockJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '144';
		$contents = $this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
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
 * Expect post edit action
 *
 * @return void
 */
	public function testPost() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$data = array(
			'Iframe' => array(
				'id' => '1',
				'block_id' => $blockId,
				'key' => 'iframe_1',
				'url' => 'http://www.netcommons2.org',
				'height' => 300,
				'display_scrollbar' => false,
				'display_frame' => false,
			),
			'Frame' => array(
				'id' => $frameId
			),
			'Block' => array(
				'id' => $blockId,
				'language_id' => '2',
				'room_id' => '1',
				'key' => 'block_141',
				'plugin_key' => 'iframes',
				'public_type' => Block::TYPE_PRIVATE,
				'from' => '2015-04-01 12:34',
				'to' => '2015-04-02 01:45',
			),
		);

		$this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
					'data' => $data,
					'return' => 'view',
				)
			);
		$this->assertTextEquals('edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect post edit action on validation error.
 *
 * @return void
 */
	public function testPostValidationError() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$data = array(
			'Iframe' => array(
				'id' => '1',
				'block_id' => $blockId,
				'key' => 'iframe_1',
				'url' => '',
				'height' => 300,
				'display_scrollbar' => false,
				'display_frame' => false,
			),
			'Frame' => array(
				'id' => $frameId
			),
			'Block' => array(
				'id' => $blockId,
				'language_id' => '2',
				'room_id' => '1',
				'key' => 'block_1',
				'plugin_key' => 'iframes',
				'public_type' => Block::TYPE_PRIVATE,
				'from' => '2015-04-01 12:34',
				'to' => '2015-04-02 01:45',
			),
		);

		$this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
					'data' => $data,
					'return' => 'view',
				)
			);
		$this->assertTextEquals('edit', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect bad request by null in blockId on POST request
 *
 * @return void
 */
	public function testNullBlockIdOnPost() {
		$this->setExpectedException('BadRequestException');
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
					'data' => array('Block' => array('id' => null)),
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect bad request by difference in blockId on POST json request
 *
 * @return void
 */
	public function testNullBlockIdOnPostJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$contents = $this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
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
 * Expect bad request by difference in blockId on POST request
 *
 * @return void
 */
	public function testDifferenceBlockIdOnPost() {
		$this->setExpectedException('BadRequestException');
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
					'data' => array('Block' => array('id' => '2')),
					'return' => 'view',
				)
			);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect bad request by difference in blockId on POST json request
 *
 * @return void
 */
	public function testDifferenceBlockIdOnPostJson() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$blockId = '141';
		$contents = $this->testAction(
				'/iframes/blocks/edit/' . $frameId . '/' . $blockId,
				array(
					'method' => 'post',
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
				'/iframes/blocks/edit/' . $frameId . '/',
				array(
					'method' => 'post',
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
				'/iframes/blocks/edit/' . $frameId . '/',
				array(
					'method' => 'post',
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
				'/iframes/blocks/edit/' . $frameId . '/2',
				array(
					'method' => 'post',
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
				'/iframes/blocks/edit/' . $frameId . '/2',
				array(
					'method' => 'post',
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
