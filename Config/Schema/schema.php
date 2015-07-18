<?php
/**
 * Schema file
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Schema file
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Iframes\Config\Schema
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class AppSchema extends CakeSchema {

/**
 * Database connection
 *
 * @var string
 */
	public $connection = 'master';

/**
 * before
 *
 * @param array $event savent
 * @return bool
 */
	public function before($event = array()) {
		return true;
	}

/**
 * after
 *
 * @param array $event event
 * @return void
 */
	public function after($event = array()) {
	}

/**
 * iframes table
 *
 * @var array
 */
	public $iframes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID | | | '),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => 'block id | ブロックID | blocks.id | '),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'iframe key | iframeキー | Hash値 | ', 'charset' => 'utf8'),
		'url' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'iframe url | | | ', 'charset' => 'utf8'),
		'height' => array('type' => 'integer', 'null' => false, 'default' => '400', 'unsigned' => false, 'comment' => 'iframe height | iframeの高さ |  | '),
		'display_scrollbar' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => 'display scrollbar, 1: display or 0: no display | スクロールバーの表示  1:表示する、0:表示しない |  | '),
		'display_frame' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'display frame, 1: display or 0: no display | フレーム枠の表示  1:表示する、0:表示しない |  | '),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => 'created user | 作成者 | users.id | '),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created time | 作成日時 | | '),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => 'modified user | 更新者 | users.id | '),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified time | 更新日時 | | '),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
}
