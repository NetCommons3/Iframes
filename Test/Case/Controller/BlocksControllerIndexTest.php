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
class BlocksControllerIndexTest extends IframesControllerTestCase {

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
 * Expect index action
 *
 * @return void
 */
	public function testIndex() {
		RolesControllerTest::login($this);

		$frameId = 1;
		$view = $this->testAction(
				'/iframes/blocks/index/' . $frameId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('index', $this->controller->view);

		$this->assertTextContains('/frames/frames/edit/' . $frameId, $view);
		$this->assertTextContains('/iframes/blocks/add/' . $frameId, $view);
		$this->assertTextContains('/iframes/blocks/edit/' . $frameId . '/1', $view);
		$this->assertTextContains('/iframes/blocks/edit/' . $frameId . '/5', $view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect index action without Block
 *
 * @return void
 */
	public function testWithoutBlock() {
		RolesControllerTest::login($this);

		$frameId = 3;
		$view = $this->testAction(
				'/iframes/blocks/index/' . $frameId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('Blocks/not_found', $this->controller->view);

		$this->assertTextContains('/iframes/blocks/add/' . $frameId, $view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect index action without Block
 *
 * @return void
 */
	public function testPageError() {
		RolesControllerTest::login($this);

		$frameId = 1;
		$this->testAction(
				'/iframes/blocks/index/' . $frameId . '/page:2',
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('index', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}
}
