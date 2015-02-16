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
App::uses('IframeFrameSettingsController', 'Iframes.Controller');
App::uses('IframesAppTest', 'Iframes.Test/Case/Controller');

/**
 * IframesController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Controller
 */
class IframesControllerTest extends IframesAppTest {

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->testAction(
				'/iframes/iframes/index/1',
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('Iframes/view', $this->controller->view);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->testAction(
				'/iframes/iframes/view/1',
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('view', $this->controller->view);
	}

/**
 * testViewJson method
 *
 * @return void
 */
	//public function testViewJson() {
		/*$ret = $this->testAction(
				'/iframes/iframes/view/1.json',
				array(
					'method' => 'get',
					'type' => 'json',
					'return' => 'contents',
				)
			);*/
		//$result = json_decode($ret, true);

		//$this->assertTextEquals('view', $this->controller->view);
		//$this->assertArrayHasKey('code', $result, print_r($result, true));
		//$this->assertEquals(200, $result['code'], print_r($result, true));
	//}

/**
 * testView method
 *
 * @return void
 */
	public function testViewByAdmin() {
		$this->_generateController('Iframes.Iframes');
		$this->_loginAdmin();

		$view = $this->testAction(
				'/iframes/iframes/view/1',
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);

		$this->assertTextContains('nc-iframes-1', $view, print_r($view, true));

		$this->_logout();
	}

/**
 * testEditPost method
 *
 * @return void
 */
	public function testEditGet() {
		$this->_generateController('Iframes.Iframes');
		$this->_loginAdmin();

		/* $view = $this->testAction( */
		$this->testAction(
				'/iframes/iframes/edit/1',
				array(
					'method' => 'get',
					'return' => 'contents'
				)
			);
		/* $result = json_decode($view, true); */

		$this->assertTextEquals('edit', $this->controller->view);
		/* $this->assertArrayHasKey('code', $result, print_r($result, true)); */
		/* $this->assertEquals(200, $result['code'], print_r($result, true)); */
		/* $this->assertEquals(200, $, print_r($result, true)); */
		/* $this->assertArrayHasKey('name', $result, print_r($result, true)); */
		/* $this->assertArrayHasKey('results', $result, print_r($result, true)); */
		/* $this->assertArrayHasKey('announcement', $result['results'], print_r($result, true)); */
		/* $this->assertArrayHasKey('Announcement', $result['results']['announcement'], print_r($result, true)); */
		/* $this->assertArrayHasKey('comments', $result['results'], print_r($result, true)); */

		$this->_logout();
	}

/**
 * testEditPost method
 *
 * @return void
 */
	public function testEditPost() {
		$this->_generateController('Iframes.Iframes');
		$this->_loginAdmin();

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'key' => 'iframe_1',
				'url' => 'http://www.netcommons.org',
			),
			'Frame' => array(
				'id' => '1'
			),
			'Comment' => array(
				'comment' => 'edit comment',
			),
			sprintf('save_%s', NetCommonsBlockComponent::STATUS_PUBLISHED) => '',
		);

		$this->testAction(
				'/iframes/iframes/edit/1',
				array(
					'method' => 'post',
					'data' => $postData,
					'return' => 'contents'
				)
			);
		$this->assertTextEquals('edit', $this->controller->view);

		$this->_logout();
	}
}
