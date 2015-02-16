<?php
/**
 * Iframe Frame Settings Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesAppController', 'Iframes.Controller');

/**
 * Iframe Frame Settings Controller
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Controller
 */
class IframeFrameSettingsController extends IframesAppController {

/**
 * use model
 *
 * @var array
 */
	public $uses = array(
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
 * edit method
 *
 * @return void
 */
	public function edit() {
		$this->__setIframeFrameSetting();

		//登録処理
		if ($this->request->isPost()) {
			$data = $this->data;
			$iframeFrameSetting = $this->IframeFrameSetting->getIframeFrameSetting(
					$data['Frame']['key']
				);

			$data['IframeFrameSetting']['display_scrollbar'] =
				($data['IframeFrameSetting']['display_scrollbar'] === '1')? true : false;

			$data['IframeFrameSetting']['display_frame'] =
				($data['IframeFrameSetting']['display_frame'] === '1')? true : false;

			$data = Hash::merge($iframeFrameSetting, $data);

			if (! $iframeFrameSetting = $this->IframeFrameSetting->saveIframeFrameSetting($data)) {
				if (!$this->__handleValidationError($this->IframeFrameSetting->validationErrors)) {
					return;
				}
			}

			if (!$this->request->is('ajax')) {
				$backUrl = CakeSession::read('backUrl');
				CakeSession::delete('backUrl');
				$this->redirect($backUrl);
			}
			return;
		}
	}

/**
 * __setIframeFrameSetting method
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
		$this->set($results);
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