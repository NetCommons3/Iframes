<?php
/**
 * Init migration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Init migration
 *
 * @package NetCommons\Iframes\Config\Migration
 */
class Init extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'init';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'iframes' => array(
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
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'iframes'
			),
		),
	);

/**
 * recodes
 *
 * @var array $records
 */
	public $records = array(
		'Plugin' => array(
			array(
				'language_id' => 2,
				'key' => 'iframes',
				'namespace' => 'netcommons/iframes',
				'name' => 'iframe',
				'type' => 1,
				'default_action' => 'iframes/view',
				'default_setting_action' => 'iframe_blocks/index',
			),
		),
		'PluginsRole' => array(
			array(
				'role_key' => 'room_administrator',
				'plugin_key' => 'iframes'
			),
		),
		'PluginsRoom' => array(
			array(
				'room_id' => '1',
				'plugin_key' => 'iframes'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction up or down direction of migration process
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction up or down direction of migration process
 * @return bool Should process continue
 */
	public function after($direction) {
		if ($direction === 'down') {
			return true;
		}

		foreach ($this->records as $model => $records) {
			if (!$this->updateRecords($model, $records)) {
				return false;
			}
		}

		return true;
	}

/**
 * Update model records
 *
 * @param string $model model name to update
 * @param string $records records to be stored
 * @return bool Should process continue
 */
	public function updateRecords($model, $records) {
		$Model = $this->generateModel($model);
		foreach ($records as $record) {
			$Model->create();
			if (!$Model->save($record, false)) {
				return false;
			}
		}

		return true;
	}
}
