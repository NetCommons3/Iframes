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
App::uses('IframesControllerTest', 'Iframes.Test/Case/Controller');

/**
 * IframesController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Controller
 */
class IframesControllerTestIndex extends IframesControllerTest {

/**
 * Expect index action
 *
 * @return void
 */
	public function testIndex() {
		$view = $this->testAction(
				'/iframes/iframes/index/141',
				array(
					'method' => 'get',
					'return' => 'view',
				)
			);
		$this->assertTextEquals('view', $this->controller->view);

		$this->assertTextContains('<iframe', $view);
	}
}
