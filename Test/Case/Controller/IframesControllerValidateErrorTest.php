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
 * @package NetCommons\Iframes\Test\Case\Controller
 */
class IframesControllerValidateErrorTest extends IframesAppTest {

/**
 * testEditWithInvalidStatus method
 *
 * @return void
 */
	public function testEditWithInvalidStatus() {
		$this->_generateController('Iframes.Iframes');
		$this->_loginAdmin();

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'key' => 'iframe_1',
				'url' => '',
			),
			'Frame' => array(
				'id' => '1'
			),
			'Comment' => array(
				'plugin_key' => 'iframes',
				'content_key' => 'iframe_1',
				'comment' => 'edit comment',
			),
		);

		$this->setExpectedException('BadRequestException');
		$this->testAction(
				'/iframes/iframes/edit/1',
				array(
					'method' => 'post',
					'data' => $postData,
					'return' => 'contents'
				)
			);
		/* $this->_logout(); */
	}

/**
 * testEditWithInvalidStatusJson method
 *
 * @return void
 */
	public function testEditWithInvalidStatusJson() {
		$this->_generateController('Iframes.Iframes');
		$this->_loginAdmin();

		$postData = array(
			'Iframe' => array(
				'block_id' => '1',
				'key' => 'iframe_1',
				'url' => '',
			),
			'Frame' => array(
				'id' => '1'
			),
			'Comment' => array(
				'plugin_key' => 'iframes',
				'content_key' => 'iframe_1',
				'comment' => 'edit comment',
			),
		);

		$ret = $this->testAction(
				'/iframes/iframes/edit/1.json',
				array(
					'method' => 'post',
					'data' => $postData,
					'type' => 'json',
					'return' => 'contents'
				)
			);
		$result = json_decode($ret, true);

		$this->assertArrayHasKey('code', $result, print_r($result, true));
		$this->assertEquals(400, $result['code'], print_r($result, true));
		/* $this->_logout(); */
	}

/**
 * testEditCommentError method
 *
 * @return void
 */
	public function testEditCommentError() {
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
				'plugin_key' => 'iframes',
				'content_key' => 'iframe_1',
				'comment' => '',
			),
			sprintf('save_%s', NetCommonsBlockComponent::STATUS_DISAPPROVED) => '',
		);

		$view = $this->testAction(
				'/iframes/iframes/edit/1.json',
				array(
					'method' => 'post',
					'data' => $postData,
					'type' => 'json',
					'return' => 'contents'
				)
			);
		$result = json_decode($view, true);

		$this->assertArrayHasKey('code', $result, print_r($result, true));
		$this->assertEquals(400, $result['code'], print_r($result, true));
		$this->assertArrayHasKey('name', $result, print_r($result, true));
		$this->assertArrayHasKey('error', $result, print_r($result, true));
		$this->assertArrayHasKey('validationErrors', $result['error'], print_r($result, true));

		/* $this->_logout(); */
	}
}
