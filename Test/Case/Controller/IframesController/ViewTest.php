<?php
/**
 * IframesController::view()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesControllerTestCase', 'Iframes.TestSuite');

/**
 * IframesController::view()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Controller\IframesController
 */
class IframesControllerViewTest extends IframesControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'iframes';

/**
 * Controller name
 *
 * @var string
 */
	protected $_controller = 'iframes';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//ログイン
		TestAuthGeneral::login($this);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		//ログアウト
		TestAuthGeneral::logout($this);

		parent::tearDown();
	}

/**
 * viewアクションのテスト用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - expected: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderView() {
		$results = array();

		$results[0] = array(
			'urlOptions' => array('frame_id' => '6', 'block_id' => '2'),
			'expected' =>
				'<article>' .
					'<iframe width="100%" src="http://www.netcommons.org/" height="200" scrolling="yes" frameborder="1"></iframe>' .
				'</article>',
		);
		$results[1] = array(
			'urlOptions' => array('frame_id' => '7', 'block_id' => '2'),
			'expected' =>
				'<article>' .
					'<iframe width="100%" src="http://www.netcommons.org/" height="300" scrolling="no" frameborder="0"></iframe>' .
				'</article>',
		);

		return $results;
	}

/**
 * viewアクションのテスト
 *
 * @param array $urlOptions URLオプション
 * @param array $expected テストの期待値
 * @param string|null $exception Exception
 * @param string $return testActionの実行後の結果
 * @dataProvider dataProviderView
 * @return void
 */
	public function testView($urlOptions, $expected, $exception = null, $return = 'view') {
		//テスト実施
		$url = Hash::merge(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'view',
		), $urlOptions);

		$this->_testGetAction($url, null, $exception, $return);

		//チェック
		$this->assertEquals($expected, $this->_parseView($this->view));
	}

}
