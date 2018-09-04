<?php
/**
 * IframeFrameSetting Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesAppModel', 'Iframes.Model');

/**
 * IframeFrameSetting Model
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Iframes\Model
 */
class IframeFrameSetting extends IframesAppModel {

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
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

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
		$this->validate = array_merge($this->validate, array(
			'frame_key' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				),
			),
			'height' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('iframes', 'Frame height')),
					'required' => true,
				),
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
 * IframeFrameSettingデータ取得
 *
 * @return array
 */
	public function getIframeFrameSetting() {
		$conditions = array(
			'frame_key' => Current::read('Frame.key')
		);

		$iframeFrameSetting = $this->find('first', array(
			'recursive' => -1,
			'conditions' => $conditions,
		));

		if (! $iframeFrameSetting) {
			$iframeFrameSetting = $this->create(array(
				'id' => null,
			));
		}

		return $iframeFrameSetting;
	}

/**
 * Save access counter settings
 *
 * @param array $data received post data
 * @return bool True on success, false on failure
 * @throws InternalErrorException
 */
	public function saveIframeFrameSetting($data) {
		//トランザクションBegin
		$this->begin();

		//バリデーション
		$this->set($data);
		if (! $this->validates()) {
			return false;
		}

		try {
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

}
