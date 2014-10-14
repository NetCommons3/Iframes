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
 * Model name
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $uses = array(
		'Frames.Frame',
		'Iframes.Iframe',
		'Iframes.IframeFrameSetting',
	);

/**
 * beforeFilter
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return void
 */
	public function beforeFilter() {
		//親処理
		parent::beforeFilter();
		//未ログインでもアクセスを許可
		$this->Auth->allow();
	}

/**
 * index
 *
 * @param int $frameId frames.id
 * @param string $lang language
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return CakeResponse
 */
	public function index($frameId = 0, $lang = '') {
		return $this->view($frameId, $lang);
	}

/**
 * view
 *
 * @param int $frameId frames.id
 * @param string $lang language
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return CakeResponse
 */
	public function view($frameId = 0, $lang = '') {
		//フレーム初期化処理
		if (! $this->_initializeFrame($frameId, $lang)) {
			$this->response->statusCode(400);
			return $this->render(false);
		}
		//iframeの取得
		$iframe = $this->Iframe->getIframe($this->viewVars['blockId'],
								$this->viewVars['contentEditable']);
		//iframeFrameSettingの取得
		$frame = $this->Frame->findById($frameId);
		$frameKey = $frame[$this->Frame->name]['key'];
		$iframeFrameSetting =
				$this->IframeFrameSetting->getIFrameFrameSetting($frameKey);
		//ログインしているか否か or 編集権限があるか否か
		if (! CakeSession::read('Auth.User') ||
			! $this->viewVars['contentEditable']
		) {
			if ($iframe && $iframeFrameSetting) {
				//公開中のiframeを表示
				$this->set('iframe', $iframe);
				$this->set('iframeFrameSetting', $iframeFrameSetting);
				return $this->render('Iframes/publish');
			}
			return $this->render(false);
		}
		if (! $iframe) {
			$iframe = $this->Iframe->create();
			$iframe[$this->Iframe->name]['status'] = '';
			$iframe[$this->Iframe->name]['url'] = '';
		}
		if (! $iframeFrameSetting) {
			//iframeFrameSettingが無い時、初期値をセットする。
			$iframeFrameSetting = $this->IframeFrameSetting->create();
		}
		$this->set('iframe', $iframe);
		$this->set('iframeFrameSetting', $iframeFrameSetting);
		//セッティングモードOFF
		if (! Configure::read('Pages.isSetting')) {
			//下書き等含めた最新のiframeを表示
			return $this->render('Iframes/latest');
		}
		//セッティングモードON
		return $this->render('Iframes/edit');
	}

/**
 * get edit form
 *
 * @param int $frameId frames.id
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return CakeResponse
 */
	public function iframeForm($frameId = 0) {
		$this->layout = false;
		$this->isSetting = true;
		//フレーム初期化処理
		if (! $this->_initializeFrame($frameId)) {
			$this->response->statusCode(400);
			return $this->render(false);
		}
		//編集権限がない場合
		if (! $this->viewVars['contentEditable']) {
			return $this->render(false);
		}
		//iframeの取得
		$iframe = $this->Iframe->getIframe($this->viewVars['blockId'],
										$this->viewVars['contentEditable']);
		//iframeFrameSettingの取得
		$frame = $this->Frame->findById($frameId);
		$frameKey = $frame[$this->Frame->name]['key'];
		$iframeFrameSetting =
				$this->IframeFrameSetting->getIFrameFrameSetting($frameKey);
		if (! $iframe) {
			$iframe = $this->Iframe->create();
		}
		if (! $iframeFrameSetting) {
			$iframeFrameSetting = $this->IframeFrameSetting->create();
		}
		$this->set('iframe', $iframe);
		$this->set('iframeFrameSetting', $iframeFrameSetting);
		return $this->render('Iframes/iframe_form');
	}

/**
 * edit iframe
 *
 * @param int $frameId frames.id
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return CakeResponse
 */
	public function iframeEdit($frameId = 0) {
		if (! $this->request->isPost()) {
			return $this->_renderJson(400, __d('iframes', 'I failed to save'));
		}
		//フレーム初期化処理
		$this->_initializeFrame($frameId);
		if (! $this->viewVars['contentEditable']) {
			//権限エラー
			return $this->_renderJson(403, __d('iframes', 'I failed to save'));
		}
		//保存
		$rtn = $this->Iframe->saveIframe(
			$this->data,
			$frameId,
			$this->viewVars['roomId']
		);
		if (! $rtn) {
			//失敗結果を返す
			return $this->_renderJson(500, __d('iframes', 'I failed to save'), $rtn);
		} else {
			//成功結果を返す
			return $this->_renderJson(200, __d('iframes', 'Saved'), $rtn);
		}
	}

/**
 * get edit frame setting form
 *
 * @param int $frameId frames.id
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return CakeResponse
 */
	public function iframeFrameSettingForm($frameId = 0) {
		$this->layout = false;
		$this->isSetting = true;
		//フレーム初期化処理
		if (! $this->_initializeFrame($frameId)) {
			$this->response->statusCode(400);
			return $this->render(false);
		}
		//編集権限がない場合
		if (! $this->viewVars['contentEditable']) {
			return $this->render(false);
		}
		//iframeFrameSettingの取得
		$frame = $this->Frame->findById($frameId);
		$frameKey = $frame[$this->Frame->name]['key'];
		$iframeFrameSetting =
				$this->IframeFrameSetting->getIFrameFrameSetting($frameKey);
		if (! $iframeFrameSetting) {
			$iframeFrameSetting = $this->IframeFrameSetting->create();
		}
		$this->set('frameKey', $frameKey);
		$this->set('iframeFrameSetting', $iframeFrameSetting);
		return $this->render('Iframes/iframe_frame_setting_form');
	}

/**
 * edit iframe frame setting
 *
 * @param int $frameId frames.id
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return CakeResponse
 */
	public function iframeFrameSettingEdit($frameId = 0) {
		if (! $this->request->isPost()) {
			return $this->_renderJson(400, __d('iframes', 'I failed to save'));
		}
		//フレーム初期化処理
		$this->_initializeFrame($frameId);
		if (! $this->viewVars['contentEditable']) {
			//権限エラー
			return $this->_renderJson(403, __d('iframes', 'I failed to save'));
		}
		//保存
		$frame = $this->Frame->findById($frameId);
		$frameKey = $frame[$this->Frame->name]['key'];
		$rtn = $this->IframeFrameSetting->saveIframeFrameSetting(
			$this->data,
			$frameKey
		);
		if (! $rtn) {
			//失敗結果を返す
			return $this->_renderJson(500, __d('iframes', 'I failed to save'), $rtn);
		} else {
			//成功結果を返す
			return $this->_renderJson(200, __d('iframes', 'Saved'), $rtn);
		}
	}

}