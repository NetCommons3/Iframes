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
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'NetCommons.Publishable'
	);

/**
 * Validation rules
 *
 * @var array
 */
	//const COMMENT_PLUGIN_KEY = 'iframes';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Blocks.Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge($this->validate, array(
			'block_id' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message' => __d('net_commons', 'Invalid request.'),
					'allowEmpty' => false,
					'required' => true,
				)
			),
			'key' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				)
			),

			//status to set in PublishableBehavior.

			'url' => array(
				'website' => array(
					'rule' => array('url', true),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('iframes', 'URL')),
					'required' => true,
				),
			),
		));

		return parent::beforeValidate($options);
	}

/**
 * get iframe data
 *
 * @param int $frameId frames.id
 * @param int $blockId blocks.id
 * @param bool $contentEditable true can edit the content, false not can edit the content.
 * @return array
 */
	public function getIframe($frameId, $blockId, $contentEditable) {
		$conditions = array(
			'block_id' => $blockId,
		);
		if (! $contentEditable) {
			$conditions['status'] = NetCommonsBlockComponent::STATUS_PUBLISHED;
		}

		$iframe = $this->find('first', array(
				'recursive' => -1,
				'conditions' => $conditions,
				'order' => 'Iframe.id DESC',
			)
		);

		return $iframe;
	}

/**
 * save iframe
 *
 * @param array $data received post data
 * @return mixed On success Model::$data if its not empty or true, false on failure
 * @throws InternalErrorException
 */
	public function saveIframe($data) {
		$this->loadModels([
			'Iframe' => 'Iframes.Iframe',
			'Block' => 'Blocks.Block',
			'Comment' => 'Comments.Comment',
		]);

		//トランザクションBegin
		$dataSource = $this->getDataSource();
		$dataSource->begin();

		try {
			if (!$this->validateIframe($data)) {
				return false;
			}
			if (!$this->Comment->validateByStatus($data, array('caller' => $this->name))) {
				$this->validationErrors = Hash::merge($this->validationErrors, $this->Comment->validationErrors);
				return false;
			}

			//ブロックの登録
			$block = $this->Block->saveByFrameId($data['Frame']['id'], false);

			//Iframeデータの登録
			$this->data['Iframe']['block_id'] = (int)$block['Block']['id'];
			$iframe = $this->save(null, false);
			if (! $iframe) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
			//コメントの登録
			if ($this->Comment->data) {
				if (! $this->Comment->save(null, false)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}
			//トランザクションCommit
			$dataSource->commit();
		} catch (Exception $ex) {
			//トランザクションRollback
			$dataSource->rollback();
			//エラー出力
			CakeLog::write(LOG_ERR, $ex);
			throw $ex;
		}

		return $iframe;
	}

/**
 * validate iframe
 *
 * @param array $data received post data
 * @return bool True on success, false on error
 */
	public function validateIframe($data) {
		$this->set($data);
		$this->validates();
		return $this->validationErrors ? false : true;
	}
}