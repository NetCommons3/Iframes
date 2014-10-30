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
 * Minimum value of the height of the frame
 *
 * @var int
 */
	const MINIMUM_VALUE = 1;

/**
 * Maximum value of the height of the frame
 *
 * @var int
 */
	const MAXIMUM_VALUE = 2000;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'height' => array(
			'numeric' => array(
				'rule' => array('range', 0, 2001),
				'message' => 'Invalid request.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'display_scrollbar' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid request.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'display_frame' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid request.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

/**
 * belongsTo associations
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $belongsTo = array(
		'Frame' => array(
			'className' => 'Frame',
			'foreignKey' => 'frame_key',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * get iframe frame setting
 *
 * @param int $frameKey frames.key
 * @return array IframeFrameSetting
 */
	public function getIFrameFrameSetting($frameKey) {
		$conditions = array(
			'frame_key' => $frameKey,
		);

		$iframeFrameSetting = $this->find('first', array(
				'conditions' => $conditions,
				'order' => 'IframeFrameSetting.id DESC'
			)
		);

		if (! $iframeFrameSetting) {
			//初期値を設定
			$iframeFrameSetting = $this->create();
			$iframeFrameSetting['IframeFrameSetting']['frame_key'] = $frameKey;
			$iframeFrameSetting['IframeFrameSetting']['id'] = '0';
		}

		return $iframeFrameSetting;
	}

/**
 * save iframeFrameSetting
 *
 * @param array $postData received post data
 * @return bool true success, false error
 * @throws ForbiddenException
 */
	public function saveIframeFrameSetting($postData) {
		$models = array(
			'Frame' => 'Frames.Frame',
		);
		foreach ($models as $model => $class) {
			$this->$model = ClassRegistry::init($class);
			$this->$model->setDataSource('master');
		}

		//DBへの登録
		$dataSource = $this->getDataSource();
		$dataSource->begin();
		try {
			//IframesFrameSettingテーブル登録
			$iframeFrameSetting['IframeFrameSetting']['height'] =
								(int)$postData['IframeFrameSetting']['height'];

			$iframeFrameSetting['IframeFrameSetting']['frame_key'] =
								$postData['IframeFrameSetting']['frame_key'];

			$iframeFrameSetting['IframeFrameSetting']['created_user'] =
								CakeSession::read('Auth.User.id');

			$iframeFrameSetting['IframeFrameSetting']['display_scrollbar'] =
				($postData['IframeFrameSetting']['display_scrollbar'] === 'true' ? 1 : 0);

			$iframeFrameSetting['IframeFrameSetting']['display_frame'] =
				($postData['IframeFrameSetting']['display_frame'] === 'true' ? 1 : 0);

			$iframeFrameSetting = $this->save($iframeFrameSetting);

			if (! $iframeFrameSetting) {
				throw new ForbiddenException(serialize($this->validationErrors));
			}
			$dataSource->commit();
			return $iframeFrameSetting;

		} catch (Exception $ex) {
			CakeLog::error($ex->getTraceAsString());
			$dataSource->rollback();
			return false;
		}
	}

}
