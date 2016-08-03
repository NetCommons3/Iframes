<?php
/**
 * iframe_frame_settingsテーブルの追加
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * iframe_frame_settingsテーブルの追加
 *
 * @package NetCommons\Iframes\Config\Migration
 */
class AddIframeFrameSettings extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_iframe_frame_settings';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'iframe_frame_settings' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
					'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'フレームKey', 'charset' => 'utf8'),
					'height' => array('type' => 'integer', 'null' => false, 'default' => '400', 'unsigned' => false, 'comment' => 'iframeの高さ'),
					'display_scrollbar' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => 'スクロールバーの表示  1:表示する、0:表示しない'),
					'display_frame' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'フレーム枠の表示  1:表示する、0:表示しない'),
					'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => '作成者'),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
					'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => '更新者'),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
			'drop_field' => array(
				'iframes' => array('height', 'display_scrollbar', 'display_frame'),
			),
		),
		'down' => array(
			'drop_table' => array(
				'iframe_frame_settings'
			),
			'create_field' => array(
				'iframes' => array(
					'height' => array('type' => 'integer', 'null' => false, 'default' => '400', 'unsigned' => false, 'comment' => 'iframeの高さ'),
					'display_scrollbar' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => 'スクロールバーの表示  1:表示する、0:表示しない'),
					'display_frame' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'フレーム枠の表示  1:表示する、0:表示しない'),
				),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
