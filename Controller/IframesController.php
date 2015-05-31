<?php
/**
 * Iframes Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesAppController', 'Iframes.Controller');

/**
 * Iframes Controller
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Controller
 */
class IframesController extends IframesAppController {

/**
 * use model
 *
 * @var array
 */
	public $uses = array(
		'Iframes.Iframe',
	);

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'NetCommons.NetCommonsRoomRole' => array(),
	);

/**
 * view method
 *
 * @return void
 */
	public function view() {
		//Iframeデータを取得
		if (! $iframe = $this->Iframe->getIframe($this->viewVars['blockId'], $this->viewVars['roomId'])) {
			$this->autoRender = false;
			$iframe = $this->Iframe->create();
		}
		//Viewにセット
		$results = array(
			'iframe' => $iframe['Iframe']
		);
		$results = $this->camelizeKeyRecursive($results);
		$this->set($results);
	}
}
