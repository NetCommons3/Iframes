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
		'Frames.Frame',
		'Iframes.Iframe',
		'Iframes.IframeFrameSetting',
	);

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'NetCommons.NetCommonsBlock',
		'NetCommons.NetCommonsFrame',
		'NetCommons.NetCommonsRoomRole',
	);

/**
 * beforeFilter
 *
 * @return void
 * @throws ForbiddenException
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();

		$frameId = (isset($this->params['pass'][0]) ? (int)$this->params['pass'][0] : 0);
		//Frameのデータをviewにセット
		if (! $this->NetCommonsFrame->setView($this, $frameId)) {
			throw new ForbiddenException('NetCommonsFrame');
		}
		//Roleのデータをviewにセット
		if (! $this->NetCommonsRoomRole->setView($this)) {
			throw new ForbiddenException('NetCommonsRoomRole');
		}
	}

/**
 * index method
 *
 * @param int $frameId frames.id
 * @return CakeResponse A response object containing the rendered view.
 */
	public function index($frameId = 0) {
		return $this->view($frameId);
	}

/**
 * view method
 *
 * @param int $frameId frames.id
 * @return CakeResponse
 */
	public function view($frameId = 0) {
		//Iframeデータの取得
		$iframe = $this->Iframe->getIframe(
				$this->viewVars['blockId'],
				$this->viewVars['contentEditable']
			);
		//公開データのみ表示する
		if ($iframe['Iframe']['status'] === '0' && ! $this->Auth->loggedIn()) {
			return $this->render(false);
		}
		//IframeFrameSettingデータの取得
		$iframeFrameSetting =
			$this->IframeFrameSetting->getIFrameFrameSetting(
				$this->viewVars['frameKey']
			);
		//Iframeデータをviewにセット
		$this->set('iframe', $iframe);
		//IframeFrameSettingデータをviewにセット
		$this->set('iframeFrameSetting', $iframeFrameSetting);

		return $this->render('Iframes/view');
	}

}