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

App::uses('IframesModelTestBase', 'Iframes.Test/Case/Model');

/**
 * Iframe Model Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframeSaveTest extends IframesModelTestBase {

/**
 * Expect Iframe->saveIframe()
 *
 * @return void
 */
	public function testSaveIframe() {
		$frameId = 1;
		$blockId = '141';
		$roomId = 1;

		//登録パラメータ
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
				'language_id' => 2,
				'room_id' => 1,
				'key' => 'block_1',
				'plugin_key' => 'iframes'
			),
		);

		//登録処理実行
		$this->Iframe->saveIframe($data);

		//結果取得
		$result = $this->Iframe->getIframe($blockId, $roomId);

		//期待値セット
		$expected = array(
			'Iframe' => array(
				'id' => '1',
				'block_id' => $blockId,
				'key' => 'iframe_1',
				'url' => 'http://www.netcommons2.org',
				'height' => 300,
				'display_scrollbar' => false,
				'display_frame' => false,
			),
			'Block' => array(
				'id' => $blockId,
				'language_id' => 2,
				'room_id' => 1,
				'key' => 'block_1',
				'plugin_key' => 'iframes',
				'name' => '',
				'public_type' => '1',
				'from' => null,
				'to' => null,
			),
		);

		//チェック
		$this->_assertArray($expected, $result);
	}

/**
 * Expect Iframe->saveIframe() fail on Iframe->save()
 * e.g.) connection error
 *
 * @return  void
 */
	public function testFailOnSave() {
		$this->setExpectedException('InternalErrorException');

		$frameId = 1;
		$blockId = '141';
		//$roomId = 1;

		$this->Iframe = $this->getMockForModel('Iframes.Iframe', array('save'));
		$this->Iframe->expects($this->any())
			->method('save')
			->will($this->returnValue(false));

		//登録パラメータ
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
				'language_id' => 2,
				'room_id' => 1,
				'key' => 'block_1',
				'plugin_key' => 'iframes'
			),
		);

		//登録処理実行
		$this->Iframe->saveIframe($data);
	}

}
