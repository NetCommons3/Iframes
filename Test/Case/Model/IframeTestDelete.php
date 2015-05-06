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

App::uses('IframesModelTestCase', 'Iframes.Test/Case/Model');

/**
 *Iframe Model Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframeTestDelete extends IframesModelTestCase {

/**
 * Expect Iframe->deleteIframe()
 *
 * @return void
 */
	public function testSaveIframe() {
		//$frameId = 1;
		//$roomId = 1;
		$blockId = '141';

		//登録パラメータ
		$data = array(
			'Iframe' => array(
				'key' => 'iframe_1',
			),
			'Block' => array(
				'id' => $blockId,
				'key' => 'block_1',
			),
		);

		//登録処理実行
		$this->Iframe->deleteIframe($data);

		//チェック
		$this->assertEquals(0, $this->Iframe->find('count', array(
					'recursive' => -1,
					'conditions' => array('key' => $data['Iframe']['key'])
				))
			);
		$this->assertEquals(0, $this->Block->find('count', array(
					'recursive' => -1,
					'conditions' => array('key' => $data['Block']['key'])
				))
			);
	}

/**
 * Expect Block->deleteBlock() fail on Block->deleteAll()
 * e.g.) connection error
 *
 * @return  void
 */
	public function testFailOnDeleteAll() {
		$this->setExpectedException('InternalErrorException');

		//$frameId = 1;
		//$roomId = 1;
		$blockId = '141';

		$this->Iframe = $this->getMockForModel('Iframes.Iframe', array('deleteAll'));
		$this->Iframe->expects($this->any())
			->method('deleteAll')
			->will($this->returnValue(false));

		//登録パラメータ
		$data = array(
			'Iframe' => array(
				'key' => 'iframe_1',
			),
			'Block' => array(
				'id' => $blockId,
				'key' => 'block_1',
			),
		);

		//登録処理実行
		$this->Iframe->deleteIframe($data);
	}

}
