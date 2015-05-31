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
class BlocksControllerIndexTest extends BlocksControllerTestBase {

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BlocksController);
		parent::tearDown();
	}

/**
 * Expect index action
 *
 * @return void
 */
	public function testIndex() {
		RolesControllerTest::login($this);

		$frameId = '141';
		$view = $this->testAction(
				'/iframes/iframe_blocks/index/' . $frameId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('index', $this->controller->view);

		$this->assertTextContains('/frames/frames/edit/' . $frameId, $view);
		$this->assertTextContains('/iframes/iframe_blocks/add/' . $frameId, $view);
		$this->assertTextContains('/iframes/iframe_blocks/edit/' . $frameId . '/141', $view);
		$this->assertTextContains('/iframes/iframe_blocks/edit/' . $frameId . '/142', $view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect index action without Block
 *
 * @return void
 */
	public function testWithoutBlock() {
		RolesControllerTest::login($this);

		$frameId = '144';
		$view = $this->testAction(
				'/iframes/iframe_blocks/index/' . $frameId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('not_found', $this->controller->view);

		$this->assertTextContains('/iframes/iframe_blocks/add/' . $frameId, $view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect index action without Block
 *
 * @return void
 */
	public function testPageError() {
		$this->setExpectedException('NotFoundException');

		RolesControllerTest::login($this);

		$frameId = '141';
		$this->testAction(
				'/iframes/iframe_blocks/index/' . $frameId . '/page:2',
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('index', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}

/**
 * Expect index action by fail on Paginator->paginate()
 * e.g.) connection error
 *
 * @return void
 * @throws BadRequestException
 */
	public function testFailOnPaginator() {
		RolesControllerTest::login($this);

		$this->generate(
			'Iframes.IframeBlocks',
			[
				'components' => [
					'Auth' => ['user'],
					'Session',
					'Security',
					'Paginator'
				]
			]
		);
		$this->controller->Components->Paginator
			->expects($this->once())
			->method('paginate')
			->will($this->returnCallback(function () {
				throw new BadRequestException();
			}));

		$this->setExpectedException('BadRequestException');

		$frameId = '141';
		$this->testAction(
				'/iframes/iframe_blocks/index/' . $frameId,
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('index', $this->controller->view);

		AuthGeneralControllerTest::logout($this);
	}
}
