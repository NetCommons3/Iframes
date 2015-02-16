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
App::uses('IframesAppTest', 'Iframes.Test/Case/Controller');

/**
 * IframesController Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Announcements\Test\Case\Controller
 */
class IframesControllerErrorTest extends IframesAppTest {

/**
 * testEditLoginError method
 *
 * @return void
 */
	public function testEditLoginError() {
		$this->setExpectedException('ForbiddenException');
		$this->testAction('/iframes/iframes/edit/1.json', array('method' => 'get'));
	}

/**
 * testContentEditableError method
 *
 * @return void
 */
	public function testContentEditableError() {
		$this->setExpectedException('ForbiddenException');

		$this->_generateController('Iframes.Iframes');
		$this->_loginVisitor();

		$this->testAction('/iframes/iframes/edit/1.json', array('method' => 'get'));

		/* $this->_logout(); */
	}

/**
 * testLogin method
 *
 * @return void
 */
	public function testLogin() {
		$this->_generateController('Iframes.Iframes');
		$roles = ['admin', 'editor', 'visitor'];
		foreach ($roles as $role) {
			$method = sprintf('_login%s', ucfirst($role));
			$this->$method();
		}
	}

/**
 * testEditStatusError method
 *
 * @return void
 */
	public function testEditStatusError() {
		$this->_generateController('Iframes.Iframes');
		$this->_loginAdmin();

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'key' => 'iframe_1',
				'url' => 'http://www.netcommons.org',
			),
			'Comment' => array(
				'comment' => 'edit comment',
			),
			'Frame' => array(
				'id' => '1'
			),
		);

		$view = $this->testAction(
				'/iframes/iframes/edit/1.json',
				array(
					'method' => 'post',
					'type' => 'json',
					'data' => $postData,
					'return' => 'contents'
				)
			);

		$result = json_decode($view, true);
		$this->assertArrayHasKey('code', $result, print_r($result, true));
		$this->assertEquals(400, $result['code'], print_r($result, true));

		/* $this->_logout(); */
	}

/**
 * testEditContentPublishedError method
 *
 * @return void
 */
	public function testEditContentPublishedError() {
		$this->_generateController('Iframes.Iframes');
		$this->_loginEditor();

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'key' => 'iframe_1',
				'url' => 'http://www.netcommons.org',
			),
			'Comment' => array(
				'comment' => 'edit comment',
			),
			'Frame' => array(
				'id' => '1'
			),
			sprintf('save_%s', NetCommonsBlockComponent::STATUS_PUBLISHED) => '',
		);

		$view = $this->testAction(
				'/iframes/iframes/edit/1.json',
				array(
					'method' => 'post',
					'type' => 'json',
					'data' => $postData,
					'return' => 'contents'
				)
			);

		$result = json_decode($view, true);
		$this->assertArrayHasKey('code', $result, print_r($result, true));
		$this->assertEquals(400, $result['code'], print_r($result, true));

		/* $this->_logout(); */
	}

/**
 * testEditContentDisapprovedError method
 *
 * @return void
 */
	public function testEditContentDisapprovedError() {
		$this->_generateController('Iframes.Iframes');
		$this->_loginEditor();

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'key' => 'iframe_1',
				'url' => 'http://www.netcommons.org',
			),
			'Comment' => array(
				'comment' => 'edit comment',
			),
			'Frame' => array(
				'id' => '1'
			),
			sprintf('save_%s', NetCommonsBlockComponent::STATUS_DISAPPROVED) => '',
		);

		$view = $this->testAction(
				'/iframes/iframes/edit/1.json',
				array(
					'method' => 'post',
					'type' => 'json',
					'data' => $postData,
					'return' => 'contents'
				)
			);
		$result = json_decode($view, true);
		$this->assertArrayHasKey('code', $result, print_r($result, true));
		$this->assertEquals(400, $result['code'], print_r($result, true));

		/* $this->_logout(); */
	}
}
