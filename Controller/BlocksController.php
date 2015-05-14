<?php
/**
 * Blocks Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesAppController', 'Iframes.Controller');

/**
 * Blocks Controller
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Controller
 */
class BlocksController extends IframesAppController {

/**
 * layout
 *
 * @var array
 */
	public $layout = 'NetCommons.setting';

/**
 * use models
 *
 * @var array
 */
	public $uses = array(
		'Iframes.Iframe',
		'Blocks.Block',
	);

/**
 * use components
 *
 * @var array
 */
	public $components = array(
		'NetCommons.NetCommonsWorkflow',
		'NetCommons.NetCommonsRoomRole' => array(
			//コンテンツの権限設定
			'allowedActions' => array(
				'blockEditable' => array('index', 'add', 'edit', 'delete')
			),
		),
		'Paginator',
	);

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.Date',
	);

/**
 * beforeFilter
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('index');

		$results = $this->camelizeKeyRecursive($this->NetCommonsFrame->data);
		$this->set($results);

		if (isset($this->params['pass'][1])) {
			$blockId = (int)$this->params['pass'][1];
		} else {
			$blockId = null;
		}

		//タブの設定
		$settingTabs = array(
			'tabs' => array(
				'block_index' => array(
					'url' => array(
						'plugin' => $this->params['plugin'],
						'controller' => 'blocks',
						'action' => 'index',
						$this->viewVars['frameId'],
					)
				),
			),
			'active' => 'block_index'
		);
		$this->set('settingTabs', $settingTabs);

		$blockSettingTabs = array(
			'tabs' => array(
				'block_settings' => array(
					'url' => array(
						'plugin' => $this->params['plugin'],
						'controller' => 'blocks',
						'action' => $this->params['action'],
						$this->viewVars['frameId'],
						$blockId
					)
				),
			),
			'active' => 'block_settings'
		);
		$this->set('blockSettingTabs', $blockSettingTabs);
	}

/**
 * index
 *
 * @return void
 * @throws Exception
 */
	public function index() {
		$this->Paginator->settings = array(
			'Iframe' => array(
				'order' => array('Iframe.id' => 'desc'),
				'conditions' => array(
					'Block.language_id' => $this->viewVars['languageId'],
					'Block.room_id' => $this->viewVars['roomId'],
					'Block.plugin_key ' => $this->params['plugin'],
				),
			)
		);

		try {
			$iframes = $this->Paginator->paginate('Iframe');
		} catch (Exception $ex) {
			if (isset($this->request['paging']) && $this->params['named']) {
				$this->redirect('/iframes/blocks/index/' . $this->viewVars['frameId']);
				return;
			}
			CakeLog::error($ex);
			throw $ex;
		}

		if (! $iframes) {
			$this->view = 'Blocks/not_found';
			return;
		}

		$results = array(
			'iframes' => $iframes
		);
		$results = $this->camelizeKeyRecursive($results);
		$this->set($results);
	}

/**
 * add
 *
 * @return void
 */
	public function add() {
		$this->view = 'Blocks/edit';

		$this->set('blockId', null);
		$iframe = $this->Iframe->create(
			array(
				'id' => null,
				'key' => null,
				'block_id' => null,
				'url' => null,
			)
		);
		$block = $this->Block->create(
			array('id' => null, 'key' => null)
		);
		$data = Hash::merge($iframe, $block);
		$results = $this->camelizeKeyRecursive($data);
		$this->set($results);

		if ($this->request->isPost()) {
			if (! $data = $this->__saveIframe()) {
				return;
			}
			$results = $this->camelizeKeyRecursive($data);
			$this->set($results);
		}
	}

/**
 * edit
 *
 * @return void
 */
	public function edit() {
		if (! $this->NetCommonsBlock->validateBlockId()) {
			$this->throwBadRequest();
			return false;
		}
		$this->set('blockId', (int)$this->params['pass'][1]);

		if (! $iframe = $this->Iframe->getIframe($this->viewVars['blockId'], $this->viewVars['roomId'])) {
			$this->throwBadRequest();
			return false;
		}
		$results = $this->camelizeKeyRecursive($iframe);
		$this->set($results);

		if ($this->request->isPost()) {
			if (! $data = $this->__saveIframe()) {
				return;
			}
			$results = $this->camelizeKeyRecursive($data);
			$this->set($results);
		}
	}

/**
 * delete
 *
 * @throws BadRequestException
 * @return void
 */
	public function delete() {
		if (! $this->NetCommonsBlock->validateBlockId()) {
			$this->throwBadRequest();
			return false;
		}
		$this->set('blockId', (int)$this->params['pass'][1]);

		if (! $this->Iframe->getIframe($this->viewVars['blockId'], $this->viewVars['roomId'])) {
			$this->throwBadRequest();
			return false;
		}

		if ($this->request->isDelete()) {
			if ($this->Iframe->deleteIframe($this->data)) {
				if (! $this->request->is('ajax')) {
					$this->redirect('/iframes/blocks/index/' . $this->viewVars['frameId']);
				}
				return;
			}
		}

		$this->throwBadRequest();
	}

/**
 * Save data from request
 *
 * @return mixed Null on success, Validation's error on array
 */
	private function __saveIframe() {
		$data = $this->data;
		if ($data['Block']['public_type'] !== Block::TYPE_LIMITED) {
			unset($data['Block']['from'], $data['Block']['to']);
		}

		$this->Iframe->saveIframe($data);
		if ($this->handleValidationError($this->Iframe->validationErrors)) {
			if (! $this->request->is('ajax')) {
				$this->redirect('/iframes/blocks/index/' . $this->viewVars['frameId']);
			}
			return null;
		}
		$results = $this->camelizeKeyRecursive($data);
		$data = Hash::merge($this->viewVars, $results);

		return $data;
	}

}
