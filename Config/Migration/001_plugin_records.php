<?php
/**
 * Add plugin migration
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * Add plugin migration
 *
 * @package NetCommons\PluginManager\Config\Migration
 */
class PluginRecords extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'plugin_records';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(),
		'down' => array(),
	);

/**
 * plugin data
 *
 * @var array $migration
 */
	public $records = array(
		'Plugin' => array(
			//日本語
			array(
				'language_id' => '2',
				'key' => 'iframes',
				'namespace' => 'netcommons/iframes',
				'name' => 'iframe',
				'type' => 1,
				'default_action' => 'iframes/view',
				'default_setting_action' => 'iframe_blocks/index',
			),
			//英語
			array(
				'language_id' => '1',
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
			//パブリックスペース
			array('room_id' => '2', 'plugin_key' => 'iframes', ),
			//プライベートスペース
			array('room_id' => '3', 'plugin_key' => 'iframes', ),
			//グループスペース
			array('room_id' => '4', 'plugin_key' => 'iframes', ),
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
		$this->loadModels([
			'Plugin' => 'PluginManager.Plugin',
		]);

		if ($direction === 'down') {
			$this->Plugin->uninstallPlugin($this->records['Plugin'][0]['key']);
			return true;
		}

		foreach ($this->records as $model => $records) {
			if (!$this->updateRecords($model, $records)) {
				return false;
			}
		}
		return true;
	}
}
