<?php
/**
 * Iframe Model Test Case
 *
 * @property Iframe $Iframe
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframeModelTestCase', 'Iframes.Test/Case/Model');

/**
 *Iframe Model Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframeValidateTest extends IframeModelTestCase {

/**
 * default value
 *
 * @var array
 */
	private $__default = array(
			'Iframe' => array(
				'id' => '1',
				'key' => 'iframe_1',
				'url' => 'http://www.netcommons2.org',
				'height' => 300,
				'display_scrollbar' => false,
				'display_frame' => false,
			),
			'Frame' => array(),
			'Block' => array(
				'language_id' => 2,
				'room_id' => 1,
				'key' => 'block_1',
				'plugin_key' => 'iframes'
			),
		);

/**
 * __assertSave
 *
 * @param string $field Field name
 * @param array $data Save data
 * @param array $expected Expected value
 * @return void
 */
	private function __assertSave($field, $data, $expected) {
		//初期処理
		$this->setUp();
		//登録処理実行
		$result = $this->Iframe->saveIframe($data);
		//戻り値テスト
		$this->assertFalse($result, 'Result error: ' . $field . ' ' . print_r($data, true));
		//validationErrorsテスト
		$this->assertEquals($this->Iframe->validationErrors, $expected,
							'Validation error: ' . $field . ' ' . print_r($this->Iframe->validationErrors, true) . print_r($data, true));
		//終了処理
		$this->tearDown();
	}

/**
 * Expect Iframe->saveIframe() to notEmpty error
 *
 * @return void
 */
	public function testNotEmpty() {
		$frameId = 1;
		$blockId = 1;

		//Checkカラム
		$fields = array(
			'url' => sprintf(__d('net_commons', 'Please input %s.'), __d('iframes', 'URL')),
		);
		//Check項目
		$checks = array(
			null, '', false,
		);

		foreach ($fields as $field => $message) {
			//データ生成
			$data = Hash::merge(
				$this->__default,
				array(
					'Frame' => array('id' => $frameId),
					'Block' => array('id' => $blockId),
					'Iframe' => array('block_id' => $blockId),
				)
			);

			//期待値
			$expected = array(
				$field => array($message)
			);

			//テスト実施(カラムなし)
			unset($data['Iframe'][$field]);
			$this->__assertSave($field, $data, $expected);

			//テスト実施
			foreach ($checks as $check) {
				$data['Iframe'][$field] = $check;
				$this->__assertSave($field, $data, $expected);
			}
		}
	}

/**
 * Expect Iframe->saveIframe() to url error
 *
 * @return void
 */
	public function testUrl() {
		$frameId = 1;
		$blockId = 1;

		//Checkカラム
		$fields = array(
			'url' => sprintf(__d('net_commons', 'Unauthorized pattern for %s. Please input the data in %s format.'), __d('iframes', 'URL'), __d('iframes', 'URL')),
		);
		//Check項目
		$checks = array(
			'http:', 'https:', 'ftp:', 'javascript:',
			'http:/', 'https:/', 'ftp:/', 'javascript:/',
			'http://', 'https://', 'ftp://', 'javascript://',
			'http://test', 'https://test', 'ftp://test', 'javascript:test', 'abc://exapmle.com',
		);

		foreach ($fields as $field => $message) {
			//データ生成
			$data = Hash::merge(
				$this->__default,
				array(
					'Frame' => array('id' => $frameId),
					'Block' => array('id' => $blockId),
					'Iframe' => array('block_id' => $blockId),
				)
			);

			//期待値
			$expected = array(
				$field => array($message)
			);

			//テスト実施
			foreach ($checks as $check) {
				$data['Iframe'][$field] = $check;
				$this->__assertSave($field, $data, $expected);
			}
		}
	}

/**
 * Expect Iframe->saveIframe() to notEmpty error
 *
 * @return void
 */
	public function testRangeByHeight() {
		$frameId = 1;
		$blockId = 1;

		//Checkカラム
		$fields = array(
			'height' => sprintf(__d('iframes', 'Frame height must be a number bigger than %s and less than %s'), Iframe::HEIGHT_MIN_VALUE, Iframe::HEIGHT_MAX_VALUE),
		);
		//Check項目
		$checks = array(
			-1, Iframe::HEIGHT_MIN_VALUE - 1, Iframe::HEIGHT_MAX_VALUE + 1, 99999999, 'aaaa', null
		);

		foreach ($fields as $field => $message) {
			//データ生成
			$data = Hash::merge(
				$this->__default,
				array(
					'Frame' => array('id' => $frameId),
					'Block' => array('id' => $blockId),
					'Iframe' => array('block_id' => $blockId),
				)
			);

			//期待値
			$expected = array(
				$field => array($message)
			);

			//テスト実施
			foreach ($checks as $check) {
				$data['Iframe'][$field] = $check;
				$this->__assertSave($field, $data, $expected);
			}
		}
	}

/**
 * Expect Iframe->saveIframe() to url error
 *
 * @return void
 */
	public function testBlock() {
		$frameId = 1;
		$blockId = 1;

		//データ生成
		$data = Hash::merge(
			$this->__default,
			array(
				'Frame' => array('id' => $frameId),
				'Block' => array('id' => $blockId, 'room_id' => null),
				'Iframe' => array('block_id' => $blockId),
			)
		);

		$result = $this->Iframe->saveIframe($data);

		//戻り値テスト
		$this->assertFalse($result);
	}

}
