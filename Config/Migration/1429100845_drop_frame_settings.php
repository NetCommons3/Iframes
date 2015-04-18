<?php
/**
 * Migration file
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Iframes CakeMigration
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Config\Migration
 */
class DropFrameSettings extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'drop_frame_settings';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'iframes' => array(
					'height' => array('type' => 'integer', 'null' => false, 'default' => '400', 'comment' => 'iframe height | iframeの高さ |  | ', 'after' => 'url'),
					'display_scrollbar' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => 'display scrollbar, 1: display or 0: no display | スクロールバーの表示  1:表示する、0:表示しない |  | ', 'after' => 'height'),
					'display_frame' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'display frame, 1: display or 0: no display | フレーム枠の表示  1:表示する、0:表示しない |  | ', 'after' => 'display_scrollbar'),
				),
			),
			'drop_field' => array(
				'iframes' => array('status'),
			),
			'drop_table' => array(
				'iframe_frame_settings'
			),
		),
		'down' => array(
			'drop_field' => array(
				'iframes' => array('height', 'display_scrollbar', 'display_frame'),
			),
			'create_field' => array(
				'iframes' => array(
					'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'comment' => 'public status, 1: public, 2: public pending, 3: draft during 4: remand | 公開状況 1:公開中、2:公開申請中、3:下書き中、4:差し戻し | | '),
				),
			),
			'create_table' => array(
				'iframe_frame_settings' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary', 'comment' => 'ID |  |  | '),
					'frame_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'frame key | フレームKey | frames.key | ', 'charset' => 'utf8'),
					'height' => array('type' => 'integer', 'null' => false, 'default' => '400', 'comment' => 'iframe height | iframeの高さ |  | '),
					'display_scrollbar' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => 'display scrollbar, 1: display or 0: no display | スクロールバーの表示  1:表示する、0:表示しない |  | '),
					'display_frame' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'display frame, 1: display or 0: no display | フレーム枠の表示  1:表示する、0:表示しない |  | '),
					'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'created user | 作成者 | users.id | '),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created time | 作成日時 |  | '),
					'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'comment' => 'modified user | 更新者 | users.id | '),
					'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified time | 更新日時 |  | '),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
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
