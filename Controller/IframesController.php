<?php
/**
 * Iframes Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesAppController', 'Iframes.Controller');

/**
 * Iframes Controller
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Iframes\Controller
 */
class IframesController extends IframesAppController {

/**
 * 使用するModel
 *
 * @var array
 */
	public $uses = array(
		'Iframes.Iframe',
	);

/**
 * view method
 *
 * @return void
 */
	public function view() {
		//Iframeデータを取得
		$iframe = $this->Iframe->getIframe();
		if (! $iframe) {
			return $this->emptyRender();
		}
		$this->set('iframe', $iframe['Iframe']);
	}
}
