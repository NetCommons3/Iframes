<?php
/**
 * Migration file
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Config.Migration
 */

/**
 * Iframes Migration
 *
 * @author        Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since         NetCommons 3.0.0.0
 * @package       app.Plugin.Iframes.Config.Migration
 */
class Iframes extends CakeMigration {

/**
 * Migration description
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       string
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'iframe_data' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'iframe_id' => array('type' => 'integer', 'null' => false, 'default' => null),
					'status_id' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 3),
					'language_id' => array('type' => 'integer', 'null' => false, 'default' => '1'),
					'is_original' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 1),
					'url' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
					'frame_height' => array('type' => 'integer', 'null' => false, 'default' => '400'),
					'scrollbar_show' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
					'scrollframe_show' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'created_user_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'modified_user_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
				'iframes' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'block_id' => array('type' => 'integer', 'null' => false, 'default' => null),
					'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'created_user_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
					'modified_user_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'iframe_data', 'iframes'
			),
		),
	);

/**
 * Records keyed by model name.
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     array $records
 */
	public $records = array(
		'Plugin' => array(
			array(
				'id' => '3',
				'folder' => 'iframes',
				'type' => '1',
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction up or down direction of migration process
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @return boolean Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction up or down direction of migration process
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @return    boolean Should process continue
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
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  boolean Should process continue
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
