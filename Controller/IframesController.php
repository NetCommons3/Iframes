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
		'Iframes.IframeFrameSetting',
		'Comments.Comment',
	);

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'NetCommons.NetCommonsBlock',
		'NetCommons.NetCommonsFrame',
		'NetCommons.NetCommonsRoomRole' => array(
			//コンテンツの権限設定
			'allowedActions' => array(
				'contentEditable' => array('edit')
			),
		),
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.Token'
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->view = 'Iframes/view';
		$this->view();
	}

/**
 * view method
 *
 * @return void
 */
	public function view() {
		//Iframeデータを取得
		$this->__setIframe();
		//IframeFrameSettingデータを取得
		$this->__setIframeFrameSetting();

		if ($this->viewVars['contentEditable']) {
			$this->view = 'Iframes/viewForEditor';
		}
	}

/**
 * edit method
 *
 * @return void
 */
	public function edit() {
		$this->__setIframe();
		if ($this->request->isGet()) {
			$referer = $this->request->referer();
			if (! strstr($referer, '/iframes')) {
				CakeSession::write('backUrl', $this->request->referer());
			}
		}
		//登録処理
		if ($this->request->isPost()) {
			if (!$status = $this->__parseStatus()) {
				return;
			}

			$data = Hash::merge(
				$this->data,
				['Iframe' => ['status' => $status]]
			);

			if (!$iframe = $this->Iframe->getIframe(
				(int)$data['Frame']['id'],
				isset($data['Block']['id']) ? (int)$data['Block']['id'] : null,
				true
			)) {
				$iframe = $this->Iframe->create(['key' => Security::hash('iframe' . mt_rand() . microtime(), 'md5')]);
				$iframe['Iframe']['block_id'] = '0';
			}
			$data = Hash::merge($iframe, $data);
			if (! $iframe = $this->__saveIframe($data)) {
				return;
			}
			$this->set('blockId', $iframe['Iframe']['block_id']);
			if (!$this->request->is('ajax')) {
				$backUrl = CakeSession::read('backUrl');
				CakeSession::delete('backUrl');
				$this->redirect($backUrl);
			}
			return;
		}
	}

/**
 * Set iframe method
 *
 * @return void
 */
	private function __setIframe() {
		if (!$iframes = $this->Iframe->getIframe(
				$this->viewVars['frameId'],
				$this->viewVars['blockId'],
				$this->viewVars['contentEditable']
		)) {
			$iframes = $this->Iframe->create();
			$iframes['Iframe']['status'] = '';
		}
		$comments = $this->Comment->getComments(
			array(
				'plugin_key' => 'iframes',
				'content_key' => isset($iframes['Iframe']['key']) ? $iframes['Iframe']['key'] : null,
			)
		);
		$results = array(
			'iframes' => $iframes['Iframe'],
			'comments' => $comments,
			'contentStatus' => $iframes['Iframe']['status'],
		);
		$results = $this->camelizeKeyRecursive($results);
		$this->set($results);
	}

/**
 * Set iframeFrameSetting method
 *
 * @return void
 */
	private function __setIframeFrameSetting() {
		$iframeFrameSetting =
			$this->IframeFrameSetting->getIFrameFrameSetting(
				$this->viewVars['frameKey']
			);
		$results = array(
			'iframeFrameSettings' => $iframeFrameSetting['IframeFrameSetting'],
		);
		//$results = $this->camelizeKeyRecursive($results);
		$this->set($results);
	}

/**
 * Parse content status from request
 *
 * @throws BadRequestException
 * @return mixed status on success, false on error
 */
	private function __parseStatus() {
		if ($matches = preg_grep('/^save_\d/', array_keys($this->data))) {
			list(, $status) = explode('_', array_shift($matches));
		} else {
			if ($this->request->is('ajax')) {
				$this->renderJson(
					['error' => ['validationErrors' => ['status' => __d('net_commons', 'Invalid request.')]]],
					__d('net_commons', 'Bad Request'), 400
				);
			} else {
				throw new BadRequestException(__d('net_commons', 'Bad Request'));
			}
			return false;
		}
		return $status;
	}

/**
 * Save iframe method
 *
 * @param array $data iframe save data
 * @return array iframe data
 */
	private function __saveIframe($data) {
		if (!$iframe = $this->Iframe->saveIframe($data)) {
			if (!$this->__handleValidationError($this->Iframe->validationErrors)) {
				return $iframe;
			}
		}

		return $iframe;
	}

/**
 * Handle validation error
 *
 * @param array $errors validation errors
 * @return bool true on success, false on error
 */
	private function __handleValidationError($errors) {
		if (is_array($errors)) {
			$this->validationErrors = $errors;
			if ($this->request->is('ajax')) {
				$results = ['error' => ['validationErrors' => $errors]];
				$this->renderJson($results, __d('net_commons', 'Bad Request'), 400);
			}
			return false;
		}
		return true;
	}
}