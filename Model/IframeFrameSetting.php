<?php
/**
 * IframeFrameSetting Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('IframesAppModel', 'Iframes.Model');

/**
 * Summary for IframeFrameSetting Model
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Model
 */
class IframeFrameSetting extends IframesAppModel {

/**
 * IframeFrameSetting minimum value of the height of the frame
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var int
 */
	const MINIMUM_VALUE = '1';

/**
 * IframeFrameSetting maximum value of the height of the frame
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var int
 */
	const MAXIMUM_VALUE = '2000';

/**
 * Validation rules
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $validate = array(
		'height' => array(
			'numeric' => array(
				'rule' => array('range', 0, 2001),
				'message' => 'Invalid request.',
			),
		),
		'display_scrollbar' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid request.',
			),
		),
		'display_frame' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid request.',
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
			'className' => 'Frames.Frame',
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
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return array IframeFrameSetting
 */
	public function getIFrameFrameSetting($frameKey) {
		$conditions = array(
			'frame_key' => $frameKey,
		);
		return $this->find('first', array(
			'conditions' => $conditions,
			'order' => $this->name . '.id DESC'
		));
	}

/**
 * save iframe
 *
 * @param array $data received post data
 * @param int $frameKey frames.key
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return mixed array IframeFrameSetting, false error
 */
	public function saveIframeFrameSetting($data, $frameKey) {
		$models = array(
			'Frames.Frame' => 'Frame'
		);
		foreach ($models as $class => $model) {
			$this->$model = ClassRegistry::init($class);
			$this->$model->setDataSource('master');
		}
		if (! $data || ! $frameKey) {
			return false;
		}
		//frameKey check
		if (! isset($data[$this->Frame->name]['frame_key']) ||
			$frameKey !== $data[$this->Frame->name]['frame_key']) {
			return false;
		}
		//DBへの登録
		$dataSource = $this->getDataSource();
		$dataSource->begin();
		try {
			//iframesテーブル登録
			$insertData = array();
			$insertData[$this->name]['frame_key'] = $data[$this->Frame->name]['frame_key'];
			$insertData[$this->name]['height'] = (int)$data[$this->name]['height'];
			$insertData[$this->name]['display_scrollbar'] = $data[$this->name]['display_scrollbar'];
			$insertData[$this->name]['display_frame'] = $data[$this->name]['display_frame'];
			$insertData[$this->name]['created_user'] = (int)CakeSession::read('Auth.User.id');
			//保存結果を返す
			$insertData = $this->save($insertData);
			$dataSource->commit();
		} catch (Exception $ex) {
			//CakeLog::error($ex->getTraceAsString());
			$dataSource->rollback();
			return false;
		}
		return $insertData;
	}

}
