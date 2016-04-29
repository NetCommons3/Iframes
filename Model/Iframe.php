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
 * フレーム高さの最小値
 *
 * @var int
 */
	const HEIGHT_MIN_VALUE = '1';

/**
 * フレーム高さの最大値
 *
 * @var int
 */
	const HEIGHT_MAX_VALUE = '2000';

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
			'height' => array(
				'numeric' => array(
					'rule' => array('range', self::HEIGHT_MIN_VALUE - 1, self::HEIGHT_MAX_VALUE + 1),
					'message' => sprintf(
						__d('iframes', 'Frame height must be a number bigger than %s and less than %s'),
						self::HEIGHT_MIN_VALUE,
						self::HEIGHT_MAX_VALUE
					),
					'required' => true,
				),
			),
			'display_scrollbar' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				),
			),
			'display_frame' => array(
				'boolean' => array(
					'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				),
			),
		));

		return parent::beforeValidate($options);
	}

/**
 * IFrameデータ取得
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
		]);

		//トランザクションBegin
		$dataSource = $this->getDataSource();
		$dataSource->begin();

		try {
			if (!$this->validateIframe($data, ['block'])) {
				return false;
			}

			//ブロックの登録
			$block = $this->Block->saveByFrameId($data['Frame']['id']);

			//Iframeデータの登録
			$this->data['Iframe']['block_id'] = (int)$block['Block']['id'];
			$iframe = $this->save(null, false);
			if (! $iframe) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			//トランザクションCommit
			$dataSource->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$dataSource->rollback();
			//エラー出力
			CakeLog::error($ex);
			throw $ex;
		}

		return $iframe;
	}

/**
 * validate iframe
 *
 * @param array $data received post data
 * @param array $contains Optional validate sets
 * @return bool True on success, false on error
 */
	public function validateIframe($data, $contains = []) {
		$this->set($data);
		$this->validates();
		if ($this->validationErrors) {
			return false;
		}

		if (in_array('block', $contains, true)) {
			if (! $this->Block->validateBlock($data)) {
				$this->validationErrors = Hash::merge($this->validationErrors, $this->Block->validationErrors);
				return false;
			}
		}
		return true;
	}

/**
 * Delete iframe
 *
 * @param array $data received post data
 * @return mixed On success Model::$data if its not empty or true, false on failure
 * @throws InternalErrorException
 */
	public function deleteIframe($data) {
		$this->setDataSource('master');

		$this->loadModels([
			'Iframe' => 'Iframes.Iframe',
			'Block' => 'Blocks.Block',
			'Frame' => 'Frames.Frame',
		]);

		//トランザクションBegin
		$dataSource = $this->getDataSource();
		$dataSource->begin();

		try {
			//iframeデータ削除
			if (! $this->deleteAll(array($this->alias . '.key' => $data['Iframe']['key']), false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			//blockデータ削除
			$this->Block->deleteBlock($data['Block']['key']);

			//トランザクションCommit
			$dataSource->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$dataSource->rollback();
			CakeLog::error($ex);
			throw $ex;
		}

		return true;
	}

}
