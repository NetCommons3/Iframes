<?php
/**
 * Iframes Controller
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Controller
 */

App::uses('AppController', 'Controller');
App::uses('IframesAppController', 'Iframes.Controller');

/**
 * Iframes Controller
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package     app.Plugin.Iframes.Controller
 * @since       NetCommons 3.0.0.0
 */
class IframesController extends IframesAppController {

/**
 * name property
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       string
 */
	public $name = 'IframesController';

/**
 * Model name
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       array
 */
	public $uses = array(
		'Iframes.Iframe',
		'Iframes.IframeBlock',
		'Iframes.IframeDatum',
		'Iframes.IframeFrame',
	);

/**
 * beforeFilter
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @return    void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
		//blockIdの初期値セット
		$this->set('blockId', 0);
		//セッティングモードの状態
		$this->_setSetting();
		//ユーザIDの設定
		$this->_setUserId();
		//編集権限のチェックと設定値の格納
		$this->_checkEditor();
		//公開権限のチェックと設定値の格納
		$this->_checkPublisher();
		//著者かどうかの確認と設定値の格納
		$this->_checkAuthor();
		//Ajax判定と設定値の格納
		$this->_checkAjax();
		//言語設定
		$this->_setLang();
		//ルームIDの設定
		$this->_setRoomtId();
	}

/**
 * index
 *
 * @param int $frameId frames.id
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @return    CakeResponse
 */
	public function index($frameId = 0) {
		//変数の初期値
		$frameId = intval($frameId);
		//レイアウトの切り替え（Ajaxと通常のときの切り替え）
		$this->_setLayout();
		//blockIdの取得
		$blockId = $this->IframeFrame->getBlockId($frameId);
		//ブロックが設定されておらず、セッティングモードOFF
		if (! $blockId && ! $this->isSetting) {
			return $this->render("Iframes/notice");
		}
		//ログインなし もしくは、編集権限および公開権限なし
		if (! $this->isLogin || ! $this->isEditor && ! $this->isPublisher) {
			if (! $blockId) {
				//セッティングモードなし
				return $this->render("Iframes/notice");
			} else {
				//セッティングモードあり
				return $this->__indexNologin($frameId, $blockId);
			}
		}
		//セッティングモードOffであり、編集権限がある場合
		if (! $this->isSetting) {
			return $this->__indexNoSetting($frameId, $blockId);
		}
		//編集権限もしくは公開権限あり
		return $this->__indexEditor($frameId, $blockId);
	}

/**
 * index (no login)
 *
 * @param int $frameId frames.id
 * @param int $blockId blocks.id
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   CakeResponse
 */
	private function __indexNologin($frameId, $blockId) {
		//公開データの取得
		$data = $this->IframeDatum->getPublishData($blockId, $this->langId);
		if (! $data) {
			return $this->render("Iframes/notice");
		}
		$this->set('item', $data);
		//IDセット
		$this->set('frameId', $frameId);
		$this->set('blockId', $blockId);
		//Viewの指定
		return $this->render("Iframes/index/default");
	}

/**
 * index (Setting off, Edit on)
 *
 * @param int $frameId frames.id
 * @param int $blockId blocks.id
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   CakeResponse
 */
	private function __indexNoSetting($frameId, $blockId) {
		//データの取得
		$data = $this->IframeDatum->getData($blockId, $this->langId, true);
		if (! $data) {
			//iframeのデータ未作成時
			return $this->render("Iframes/notice");
		}
		$this->set('item', $data);
		//IDセット
		$this->set('frameId', $frameId);
		$this->set('blockId', $blockId);
		//Viewの指定
		return $this->render("Iframes/index/editor");
	}

/**
 * index (editor)
 *
 * @param int $frameId frames.id
 * @param int $blockId blocks.id
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   CakeResponse
 */
	private function __indexEditor($frameId, $blockId) {
		$data = $this->IframeDatum->getData($blockId, $this->langId, true);
		$this->set('item', $data);
		//IDセット
		$this->set('frameId', $frameId);
		$this->set('blockId', $blockId);
		//Viewの指定
		return $this->render("Iframes/setting/index");
	}

/**
 * edit iframes
 *
 * @param int $frameId frames.id
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   CakeResponse
 */
	public function edit($frameId = 0) {
		$this->viewClass = 'Json';
		//レイアウトの設定
		$this->_setLayout();
		//POSTチェック
		if (! $this->request->isPost()) {
			//post以外の場合、エラー
			return $this->_ajaxPostError();
		}
		//保存
		$rtn = $this->IframeDatum->saveData(
			$this->data,
			$frameId,
			$this->_userId,
			$this->_roomId,
			$this->_isAjax
		);
		if ($rtn) {
			//成功結果を返す
			$rtn['IframeDatum']['url'] = rawurlencode($rtn['IframeDatum']['url']);
			$rtn['IframeDatum']['frame_height'] = rawurlencode($rtn['IframeDatum']['frame_height']);
			$rtn['IframeDatum']['scrollbar_show'] = rawurlencode($rtn['IframeDatum']['scrollbar_show']);
			$rtn['IframeDatum']['scrollframe_show'] = rawurlencode($rtn['IframeDatum']['scrollframe_show']);
			$result = array(
				'status' => 'success',
				'message' => __('保存しました'),
				'data' => $rtn
			);
			$this->set(compact('result'));
			$this->set('_serialize', 'result');
			return $this->render();
		} else {
			//失敗結果を返す
			$this->response->statusCode(500);
			$result = array(
				'status' => 'error',
				'message' => __('Failed to register.'),
				'data' => $rtn
			);
			$this->set(compact('result'));
			$this->set('_serialize', 'result');
			return $this->render();
		}
	}

/**
 * iframe設定変更用のformを取得する
 *
 * @param int $frameId frames.id
 * @param int $blockId blocks.id
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	public function get_edit_form($frameId = 0, $blockId = 0) {
		$this->layout = false;
		$this->set('frameId', $frameId);
		$this->set('blockId', $blockId);
		return $this->render("Iframes/setting/get_edit_form");
	}

}