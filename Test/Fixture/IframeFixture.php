<?php
/**
 * IframeFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Summary for IframeFixture
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test
 */
class IframeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'ID | | | '),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'block id | ブロックID | blocks.id | '),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'comment' => 'public status, 1: public, 2: public pending, 3: draft during 4: remand | 公開状況 1:公開中、2:公開申請中、3:下書き中、4:差し戻し | | '),
		'url' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'iframe url | iframeに設定するURL | | ', 'charset' => 'utf8'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'created user | 作成者 | users.id | '),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created time | 作成日時 | | '),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'modified user | 更新者 | users.id | '),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified time | 更新日時 | | '),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'block_id' => 1,
			'status' => 1,
			'url' => 'http://www.netcommons.org/',
			'created_user' => 1,
			'created' => '2014-10-03 03:08:42',
			'modified_user' => 1,
			'modified' => '2014-10-03 03:08:42'
		),
		array(
			'id' => 2,
			'block_id' => 2,
			'status' => 1,
			'url' => 'http://www.netcommons.org/',
			'created_user' => 1,
			'created' => '2014-10-03 03:08:42',
			'modified_user' => 1,
			'modified' => '2014-10-03 03:08:42'
		),
	);

}
