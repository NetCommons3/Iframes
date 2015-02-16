<?php
/**
 * IframeFrameSetting Model
 *
 * @property Frame $Frame
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframesAppModel', 'Iframes.Model');

/**
 * IframeFrameSetting Model
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Model
 */
class IframeFrameSetting extends IframesAppModel {

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'NetCommons.Trackable'
	);

/**
 * Minimum value of the height of the frame
 *
 * @var int
 */
	const HEIGHT_MIN_VALUE = '1';

/**
 * Maximum value of the height of the frame
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Frame' => array(
			'className' => 'Frames.Frame',
			'foreignKey' => 'frame_key',
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
			'frame_key' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __d('net_commons', 'Invalid request.'),
					'required' => true,
				)
			),
			'height' => array(
				'numeric' => array(
					'rule' => array('range', self::HEIGHT_MIN_VALUE - 1, self::HEIGHT_MAX_VALUE + 1),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('iframes', 'Frame height must be a number bigger than 1 and less than 2000')),
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
 * get iframe frame setting data
 *
 * @param string $frameKey frames.key
 * @return array
 */
	public function getIFrameFrameSetting($frameKey) {
		$conditions = array(
			'frame_key' => $frameKey,
		);

		$iframeFrameSetting = $this->find('first', array(
				'recursive' => -1,
				'conditions' => $conditions,
				'order' => 'IframeFrameSetting.id DESC'
			)
		);

		if (! $iframeFrameSetting) {
			$default = array(
				'frame_key' => $frameKey,
			);
			$iframeFrameSetting = $this->create($default);
			$this->saveIframeFrameSetting($iframeFrameSetting);
		}

		return $iframeFrameSetting;
	}

/**
 * save iframeFrameSetting
 *
 * @param array $data received post data
 * @return mixed On success Model::$data if its not empty or true, false on failure
 * @throws InternalErrorException
 */
	public function saveIframeFrameSetting($data) {
		//トランザクションBegin
		$dataSource = $this->getDataSource();
		$dataSource->begin();

		try {
			if (!$this->validateIframeFrameSetting($data)) {
				return false;
			}

			//IframesFrameSettingデータの登録
			$iframeFrameSetting = $this->save(null, false);
			if (! $iframeFrameSetting) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
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

		return $iframeFrameSetting;
	}

/**
 * validate iframeFrameSetting
 *
 * @param array $data received post data
 * @return bool True on success, false on error
 */
	public function validateIframeFrameSetting($data) {
		$this->set($data);
		$this->validates();
		return $this->validationErrors ? false : true;
	}
}
