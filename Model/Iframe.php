<?php
/**
 * Iframe Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('IframesAppModel', 'Iframes.Model');

/**
 * Summary for Iframe Model
 *
 * @property Iframe $Iframe
 * @property Block $Block
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Model
 */
class Iframe extends IframesAppModel {

/**
 * Iframes status published
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var int
 */
	const STATUS_PUBLISHED = '1';

/**
 * Iframes status approved
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var int
 */
	const STATUS_APPROVED = '2';

/**
 * Iframes status drafted
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var int
 */
	const STATUS_DRAFTED = '3';

/**
 * Iframes status disapproved
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var int
 */
	const STATUS_DISAPPROVED = '4';

/**
 * Validation rules
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $validate = array(
		'block_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid request.',
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Invalid request.',
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
		'Block' => array(
			'className' => 'Blocks.Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * get iframe
 *
 * @param int $blockId blocks.id
 * @param bool $editable false:publish latest iframe|true:all latest iframe
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return array Iframe
 */
	public function getIframe($blockId, $editable = 0) {
		$conditions = array(
			'block_id' => $blockId
		);
		if (! $editable) {
			$conditions['status'] = self::STATUS_PUBLISHED;
		}
		return $this->find('first', array(
			'conditions' => $conditions,
			'order' => $this->name . '.id DESC'
		));
	}

/**
 * save iframe
 *
 * @param array $data received post data
 * @param int $frameId frames.id
 * @param int $roomId rooms.id
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return mixed array Iframe, false error
 */
	public function saveIframe($data, $frameId, $roomId) {
		$models = array(
			'Frames.Frame' => 'Frame',
			'Blocks.Block' => 'Block',
		);
		foreach ($models as $class => $model) {
			$this->$model = ClassRegistry::init($class);
			$this->$model->setDataSource('master');
		}
		//ブロックID取得
		$frame = $this->__getFrame($data, $frameId);
		if (! $frame) {
			return false;
		}
		$blockId = $frame[$this->Frame->name]['block_id'];
		//DBへの登録
		$dataSource = $this->getDataSource();
		$dataSource->begin();
		try {
			if (! $blockId) {
				//blocksテーブル登録
				$block = array();
				$block[$this->Block->name]['room_id'] = (int)$roomId;
				$block[$this->Block->name]['created_user'] = (int)CakeSession::read('Auth.User.id');
				$block = $this->Block->save($block);
				//ブロックID格納
				$blockId = $block[$this->Block->name]['id'];
				//framesテーブル更新
				$frame[$this->Frame->name]['block_id'] = (int)$block[$this->Block->name]['id'];
				$this->Frame->save($frame);
			}
			//iframesテーブル登録
			$insertData = array();
			$insertData[$this->name]['block_id'] = (int)$blockId;
			$insertData[$this->name]['status'] = (int)$data[$this->name]['status'];
			$insertData[$this->name]['url'] = $data[$this->name]['url'];
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

/**
 * get frame
 *
 * @param array $data received post data
 * @param int $frameId frames.id
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @return mixed array frame, false error
 */
	private function __getFrame($data, $frameId) {
		$frameId = (int)$frameId;
		if (! $data || ! $frameId) {
			return false;
		}
		//frameId check
		if (! isset($data[$this->Frame->name]['frame_id']) ||
			$frameId !== (int)$data[$this->Frame->name]['frame_id']) {
			return false;
		}
		//フレーム取得
		return $this->Frame->findById($frameId);
	}

}
