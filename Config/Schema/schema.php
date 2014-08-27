<?php
/**
 * Schema file
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Config.Schema
 */

/**
 * Iframe Schema
 *
 * @author        Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since         NetCommons 3.0.0.0
 * @package       app.Plugin.Iframes.Config.Schema
 */
class IframesSchema extends CakeSchema {

/**
 * Database connection
 *
 * @author        Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     string
 */
	public $connection = 'master';

/**
 * before
 *
 * @param array $event savent
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @return    bool
 */
	public function before($event = array()) {
		return true;
	}

/**
 * after
 *
 * @param array $event event
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @return    void
 */
	public function after($event = array()) {
	}

/**
 * iframe_data table
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       array
 */
	public $iframe_data = array(
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
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 *  iframes table
 *
 * @author    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since     NetCommons 3.0.0.0
 * @var       array
 */
	public $iframes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_user_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified_user_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}
