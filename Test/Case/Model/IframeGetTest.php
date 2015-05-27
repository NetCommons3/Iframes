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
class IframeGetTest extends IframesModelTestBase {

/**
 * Expect Iframe->getIframe()
 *
 * @return void
 */
	public function testGetIframe() {
		$roomId = 1;
		$blockId = '141';

		//テスト実行
		$result = $this->Iframe->getIframe($blockId, $roomId);

		//期待値
		$expected = array(
			'Iframe' => array(
				'id' => '1',
				'block_id' => $blockId,
				'key' => 'iframe_1',
				'url' => 'http://www.netcommons.org/',
				'height' => '400',
				'display_scrollbar' => true,
				'display_frame' => true,
			),
			'Block' => array(
				'id' => '141',
				'language_id' => '2',
				'room_id' => '1',
				'plugin_key' => 'iframes',
				'key' => 'block_141',
				'name' => '',
				'public_type' => '1',
				'from' => null,
				'to' => null,
			),
		);

		$this->_assertArray($expected, $result);
	}

}
