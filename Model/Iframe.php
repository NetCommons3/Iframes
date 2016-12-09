<?php
/**
 * Iframe Model
 *
 * @property Block $Block
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesAppModel', 'Iframes.Model');

/**
 * Iframe Model
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Iframes\Model
 */
class Iframe extends IframesAppModel {

/**
 * 使用するBehaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Blocks.Block' => array(
			'name' => 'Iframe.url',
		),
		'NetCommons.OriginalKey'
	);

/**
 * バリデーションルール
 * __d()を使うため、[self::beforeValidate()](#method_beforeValidate)でセットする
 *
 * @var array
 */
	public $validate = array();

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
			'url' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('iframes', 'URL')),
					'required' => true,
				),
				'url' => array(
					'rule' => array('url'),
					'message' => sprintf(
						__d('net_commons', 'Unauthorized pattern for %s. Please input the data in %s format.'),
						__d('net_commons', 'URL'),
						__d('net_commons', 'URL')
					),
					'allowEmpty' => false,
					'required' => true,
				),
			),
		));

		if ($this->data['Iframe']['url'] === 'http://') {
			$this->data['Iframe']['url'] = '';
		}

		return parent::beforeValidate($options);
	}

/**
 * iframeデータの取得
 *
 * @return array
 */
	public function getIframe() {
		$iframe = $this->find('first', array(
			'recursive' => 0,
			'conditions' => $this->getBlockConditionById(),
		));

		return $iframe;
	}

/**
 * iframeデータの登録
 *
 * @param array $data リクエストデータ
 * @return bool
 * @throws InternalErrorException
 */
	public function saveIframe($data) {
		//トランザクションBegin
		$this->begin();

		$this->set($data);
		if (! $this->validates()) {
			return false;
		}

		try {
			//登録処理
			if (! $this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			//トランザクションCommit
			$this->commit();

		} catch (Exception $ex) {
				//トランザクションRollback
			$this->rollback($ex);
		}

		return true;
	}

/**
 * iframeデータの削除
 *
 * @param array $data リクエストデータ
 * @return bool
 * @throws InternalErrorException
 */
	public function deleteIframe($data) {
		//トランザクションBegin
		$this->begin();

		try {
			//iframeデータ削除
			if (! $this->deleteAll(array($this->alias . '.key' => $data['Iframe']['key']), false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			//blockデータ削除
			$this->deleteBlock($data['Block']['key']);

			//トランザクションCommit
			$this->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$this->rollback($ex);
		}

		return true;
	}

}
