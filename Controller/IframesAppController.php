<?php
/**
 * IframesApp Controller
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

/**
 * IframesApp Controller
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Controller
 */
class IframesAppController extends AppController {

/**
 * setting mode
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       bool
 */
	public $isSetting = false;

/**
 * Edit authority
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       bool
 */
	public $isEditor = false;

/**
 * Publish authority
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       bool
 */
	public $isPublisher = false;

/**
 * Login
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       bool
 */
	public $isLogin = false;

/**
 * Language ID
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       int
 */
	public $langId = 2;

/**
 * Lang parameter
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       string
 */
	public $lang = 'jpn';

/**
 * Languages list
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       array
 */
	public $langList = array();

/**
 * userId
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       bool
 */
	protected $_userId = null;

/**
 * roomId
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       bool
 */
	protected $_roomId = null;

/**
 * Judgment result of asynchronous
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       bool
 */
	protected $_isAjax = false;

/**
 * Component name
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       array
 */
	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		'Asset',
		'Auth' => array(
			'loginAction' => array(
				'plugin' => 'auth',
				'controller' => 'auth',
				'action' => 'login',
			),
			'loginRedirect' => array(
				'plugin' => 'pages',
				'controller' => 'pages',
				'action' => 'index',
			),
			'logoutRedirect' => array(
				'plugin' => 'auth',
				'controller' => 'auth',
				'action' => 'login',
			)
		),
		'RequestHandler',
		'Security'
	);

/**
 * SettingMode settings
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	protected function _setSetting() {
		$this->isSetting = Configure::read('Pages.isSetting');
		$this->set('isSetting', $this->isSetting);
	}

/**
 * user_id setting
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	protected function _setUserId() {
		$this->isLogin = $this->Auth->loggedIn();
		if ($this->isLogin) {
			$this->_userId = 1;
		} else {
			$this->_userId = 0;
		}
		$this->set('isLogin', $this->isLogin);
	}

/**
 * Check the editor, to set
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   bool
 */
	protected function _checkEditor() {
		if (! $this->isLogin) {
			$this->isEditor = false;
		} else {
			$this->isEditor = true;
		}
		$this->set('isEditer', $this->isEditor);
		return $this->isEditor;
	}

/**
 * Check the publisher, to set
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	protected function _checkPublisher() {
		if (! $this->isLogin) {
			$this->isPublisher = false;
		} else {
			$this->isPublisher = true;
		}
		$this->set('isPublisher', $this->isPublisher);
		return $this->isPublisher;
	}

/**
 * Check the author, to set
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	protected function _checkAuthor() {
		$this->set('isAuthor', true);
	}

/**
 * processing asynchronous
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	protected function _checkAjax() {
		if ($this->request->is('ajax')) {
			$this->_isAjax = 1;
		}
	}

/**
 * Language settings
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	protected function _setLang() {
		$this->langList = array(
			1 => 'eng',
			2 => 'jpn'
		);
		$this->lang = 'jpn';
		$this->langId = 2;
		$this->set('langId', $this->langId);
	}

/**
 * No asynchronous process if the layout settings.
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	protected function _setLayout() {
		if ($this->_isAjax) {
			$this->layout = false;
		}
	}

/**
 * room_id setting
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   void
 */
	protected function _setRoomtId() {
		$this->_roomId = 1;
	}

/**
 * save error
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @return   CakeResponse
 */
	protected function _ajaxPostError() {
		//post以外の場合、エラー
		$this->response->statusCode(400);
		$result = array(
			'status' => 'error',
			'message' => __('Security Error! Unauthorized input.'),
		);
		$this->set(compact('result'));
		$this->set('_serialize', 'result');
		return $this->render();
	}

}

