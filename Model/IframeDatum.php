<?php
/**
 * IframeDatum Model
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('AppModel', 'Model');

/**
 * Summary for IframeDatum Model
 */
class IframeDatum extends AppModel {

/**
 * Validation rules
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     array
 */
	public $validate = array(
		'iframe_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Security Error! Unauthorized input. (iframe_id)',
			),
		),
		'status_id' => array(
			'numeric' => array(
				'rule' => array('range', 0, 5),
				'message' => 'The input `status_id` must be a number bigger than 4 and less than 1.',
			),
		),
		'is_original' => array(
			'numeric' => array(
				'rule' => array('boolean'),
			),
		),
		'url' => array(
			'website' => array(
				'rule' => array('url', true),
				'message' => 'The input `url` must be a correct URL.',
			),
		),
		'frame_height' => array(
			'numeric' => array(
				'rule' => array('range', 1, 2001),
				'message' => 'The input `frame_height` must be a number bigger than 1 and less than 2000.',
			),
		),
	);

/**
 * belongsTo associations
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     array
 */
	public $belongsTo = array(
		'Iframe' => array(
			'className' => 'Iframe',
			'foreignKey' => 'iframe_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Language' => array(
			'className' => 'Language',
			'foreignKey' => 'language_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * iframe model object
 *
 * @var null
 */
	private $__Iframe = null;

/**
 * iframe_data model object
 *
 * @var null
 */
	private $__IframeDatum = null;

/**
 * iframe_blocks model object
 *
 * @var null
 */
	private $__IframeBlock = null;

/**
 * frames model object
 *
 * @var null
 */
	private $__IframeFrame = null;

/**
 * 最新のデータを取得する
 *
 * @param int $blockId  blocks.id
 * @param string $lang  language_id
 * @param null $isSetting セッティングモードの状態 trueならon
 * @return array
 */
	public function getData($blockId, $lang, $isSetting = null) {
		if (! $isSetting) {
			return $this->getPublishData($blockId, $lang);
		}
		return $this->find('first', array(
			'conditions' => array(
				'Iframe.block_id' => $blockId,
				'IframeDatum.language_id' => $lang,
			),
			'order' => 'IframeDatum.id DESC',
		));
	}

/**
 * 最新の公開情報を取得する。
 *
 * @param int $blockId blocks.id
 * @param int $lang  language_id
 * @return array
 */
	public function getPublishData($blockId, $lang) {
		return $this->find('first', array(
			'conditions' => array(
				'Iframe.block_id' => $blockId,
				'IframeDatum.language_id' => $lang,
				'IframeDatum.status_id' => Configure::read('Iframes.Status.Publish'),
			),
			'order' => 'IframeDatum.id DESC'
		));
	}

/**
 * save
 *
 * @param array $data post data
 * @param int $frameId Frame.id
 * @param int $userId  users.id
 * @param int $roomId  rooms.id
 * @param bool $isEncode ajax通信かどうかの判定 ajax通信の場合はjavascript側でurlencodeされているため。
 * @return mixed null 失敗  array 成功
 */
	public function saveData($data, $frameId, $userId, $roomId, $isEncode = null) {
		//Modelセット
		$this->__setModel();
		if (! $frameId || ! $userId || ! $roomId) {
			return null;
		}
		//validation実行（URL、フレームの高さ）
		// $validateData = array();
		// $validateData[$this->name]['url'] = $data[$this->name]['url'];
		// $validateData[$this->name]['frame_height'] = $data[$this->name]['frame_height'];
		// //ダミーデータ
		// $validateData[$this->name]['iframe_id'] = '0';
		// $validation = $this->save($validateData);
		// if (! $validation) {
		// 	return null;
		// }
		//フレーム取得
		$frame = $this->__getFrame($frameId, $userId, $roomId);
		if (! $frame) {
			return null;
		}
		//ブロックIDセット
		$blockId = $frame['IframeFrame']['block_id'];
		//複合
		$data = $this->__decodeContent($data, $isEncode);
		//status_idの取得
		$statusId = $this->__getStatusId($data);
		//本体を取得する
		$iframeId = $this->__Iframe->getByBlockId($blockId);
		if (! $iframeId) {
			//なければ作成
			$iframeId = $this->__createIframe($blockId, $data[$this->name]['langId'], $userId);
		}
		//登録情報をつくる
		$insertData = array();
		$insertData[$this->name]['iframe_id'] = $iframeId;
		$insertData[$this->name]['created_user_id'] = $userId;
		$insertData[$this->name]['language_id'] = $data[$this->name]['langId'];
		$insertData[$this->name]['status_id'] = $statusId;
		$insertData[$this->name]['is_original'] = 1;
		$insertData[$this->name]['url'] = $data[$this->name]['url'];
		$insertData[$this->name]['frame_height'] = $data[$this->name]['frame_height'];
		$insertData[$this->name]['scrollbar_show'] = $data[$this->name]['scrollbar_show'];
		$insertData[$this->name]['scrollframe_show'] = $data[$this->name]['scrollframe_show'];
		//保存結果を返す
		$rtn = $this->save($insertData);
		if ($data = $this->checkDataSave($rtn)) {
			//master
			$frame = $this->__IframeFrame->findById($frameId);
			$rtn[$this->__IframeFrame->name] = $frame[$this->__IframeFrame->name];
			return $rtn;
		}
	}

/**
 * saveされたかどうかチェック
 *
 * @param array $rtn save data
 * @return mix array or null
 */
	public function checkDataSave($rtn) {
		if (isset($rtn[$this->name])
			&& isset($rtn[$this->name]['id'])
			&& $rtn[$this->name]['id']
		) {
			return $rtn;
		}
	}

/**
 * get frame data
 *
 * @param int $frameId frames.id
 * @param int $userId  users.id
 * @param int $roomId  rooms.id
 * @return int
 */
	private function __getFrame($frameId, $userId, $roomId) {
		//フレームを取得
		$frame = $this->__IframeFrame->findById($frameId);
		if (! $frame) {
			//存在しないframe
			return null;
		}
		//フレームIDのデータを取得する。
		$blockId = $frame['IframeFrame']['block_id'];
		if (! $blockId) {
			$block = array();
			$block['IframeBlock']['room_id'] = $roomId;
			$block['IframeBlock']['created_user_id'] = $userId;
			$block = $this->__IframeBlock->save($block);
			//blockIdをframeに格納
			$frame['IframeFrame']['block_id'] = $block['IframeBlock']['id'];
			$frame = $this->__IframeFrame->save($frame);
		}
		return $frame;
	}

/**
 * create Iframes
 *
 * @param int $blockId blocks.id
 * @param int $langId languages.id
 * @param int $userId  users.id
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  int
 */
	private function __createIframe($blockId, $langId, $userId) {
		//Iframe作成
		$data = array();
		$data['Iframe']['block_id'] = $blockId;
		$data['Iframe']['created_user_id'] = $userId;
		$data['Iframe']['modified_user_id'] = $userId;
		$iframe = $this->__Iframe->save($data);
		//IframeDatum作成
		$data = array();
		$data['IframeDatum']['iframe_id'] = $iframe['Iframe']['id'];
		$data['IframeDatum']['language_id'] = $langId;
		$data['IframeDatum']['created_user_id'] = $userId;
		$data['IframeDatum']['modified_user_id'] = $userId;
		$this->__IframeDatum->save($data);
		return $iframe['Iframe']['id'];
	}

/**
 * Ajax通信用にエンコードされている本文をデコードする。
 *
 * @param array $data postされたデータ
 * @param bool $isEncode ajax判定
 * @return array mixed 加工されたデータ
 */
	private function __decodeContent($data, $isEncode) {
		if ($isEncode) {
			//decode
			$data[$this->name]['url'] = rawurldecode($data[$this->name]['url']);
			$data[$this->name]['frame_height'] = rawurldecode($data[$this->name]['frame_height']);
			$data[$this->name]['scrollbar_show'] = rawurldecode($data[$this->name]['scrollbar_show']);
			$data[$this->name]['scrollframe_show'] = rawurldecode($data[$this->name]['scrollframe_show']);
		}
		return $data;
	}

/**
 * statusを設定する。
 *
 * @param array $data postされたデータ
 * @return array
 */
	private function __getStatusId($data) {
		$statusId = null;
		$statuses = Configure::read('Iframes.Status');
		$status = $data[$this->name]['type'];
		if (isset($statuses[$status])) {
			$statusId = $statuses[$status];
		}
		return intval($statusId);
	}

/**
 * model objectを格納する
 *
 * @return void
 */
	private function __setModel() {
		$this->__Iframe = Classregistry::init("Iframes.Iframe");
		$this->__IframeDatum = Classregistry::init("Iframes.IframeDatum");
		$this->__IframeFrame = Classregistry::init("Iframes.IframeFrame");
		$this->__IframeBlock = Classregistry::init("Iframes.IframeBlock");
	}
}
