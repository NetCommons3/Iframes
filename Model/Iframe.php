<?php
/**
 * Iframe Model
 *
 * @property Block $Block
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesAppModel', 'Iframes.Model');

/**
 * Iframe Model
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Model
 */
class Iframe extends IframesAppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'block_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid request.',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid request.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'range' => array(
				'rule' => array('range', 0, 5),
				'message' => 'Invalid request.',
			),
		),
		'url' => array(
			'website' => array(
				'rule' => array('url', true),
				'message' => 'Invalid request.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * get iframe data
 *
 * @param int $blockId blocks.id
 * @param bool $contentEditable true can edit the content, false not can edit the content.
 * @return array
 */
	public function getIframe($blockId, $contentEditable) {
		$conditions = array(
			'block_id' => $blockId,
		);
		if (! $contentEditable) {
			$conditions['status'] = NetCommonsBlockComponent::STATUS_PUBLISHED;
		}

		$iframe = $this->find('first', array(
				'conditions' => $conditions,
				'order' => 'Iframe.id DESC',
			)
		);

		if (! $iframe) {
			$iframe = $this->create();
			$iframe['Iframe']['url'] = '';
			$iframe['Iframe']['status'] = '0';
			$iframe['Iframe']['block_id'] = '0';
			$iframe['Iframe']['id'] = '0';
		}

		return $iframe;
	}

/**
 * save iframe
 *
 * @param array $postData received post data
 * @return bool true success, false error
 * @throws ForbiddenException
 */
	public function saveIframe($postData) {
		$models = array(
			'Frame' => 'Frames.Frame',
			'Block' => 'Blocks.Block',
		);
		foreach ($models as $model => $class) {
			$this->$model = ClassRegistry::init($class);
			$this->$model->setDataSource('master');
		}

		//Frame関連のセット
		$frame = $this->Frame->findById($postData['Frame']['id']);
		if (! $frame) {
			return false;
		}

		//DBへの登録
		$dataSource = $this->getDataSource();
		$dataSource->begin();
		try {
			$blockId = $this->__saveBlock($frame);

			//Iframesテーブル登録
			$iframe['Iframe'] = $postData['Iframe'];
			$iframe['Iframe']['block_id'] = $blockId;
			$iframe['Iframe']['created_user'] = CakeSession::read('Auth.User.id');

			$iframe = $this->save($iframe);
			if (! $iframe) {
				throw new ForbiddenException(serialize($this->validationErrors));
			}
			$dataSource->commit();
			return $iframe;

		} catch (Exception $ex) {
			CakeLog::error($ex->getTraceAsString());
			$dataSource->rollback();
			return false;
		}
	}

/**
 * save block
 *
 * @param array $frame frame data
 * @return int blocks.id
 * @throws ForbiddenException
 */
	private function __saveBlock($frame) {
		if (! isset($frame['Frame']['block_id']) ||
				$frame['Frame']['block_id'] === '0') {
			//blocksテーブル登録
			$block = array();
			$block['Block']['room_id'] = $frame['Frame']['room_id'];
			$block['Block']['language_id'] = $frame['Frame']['language_id'];
			$block = $this->Block->save($block);
			if (! $block) {
				throw new ForbiddenException(serialize($this->Block->validationErrors));
			}
			$blockId = (int)$block['Block']['id'];

			//framesテーブル更新
			$frame['Frame']['block_id'] = $blockId;
			if (! $this->Frame->save($frame)) {
				throw new ForbiddenException(serialize($this->Frame->validationErrors));
			}
		}

		return (int)$frame['Frame']['block_id'];
	}

}