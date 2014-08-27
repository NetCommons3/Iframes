<?php
/**
 * IframeFrameFixture
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Fixture
 */

/**
 * IframeFrameFixture
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Fixture
 */
class IframeFrameFixture extends CakeTestFixture {

/**
 * table
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @var      string
 */
	public $table = 'frames';

/**
 * Fields
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @var      array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'room_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'box_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'plugin_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'block_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => null),
		'is_published' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'from' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'to' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created_user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
	);

/**
 * Records
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @var      array
 */
	public $records = array(
		array(
			'id' => 1,
			'room_id' => 1,
			'box_id' => 3, //Main box
			'plugin_id' => 3,
			'block_id' => 1,
			'weight' => null,
			'is_published' => true,
			'from' => '2014-07-08 15:34:16',
			'to' => '2014-08-08 15:34:16',
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 2,
			'room_id' => 1,
			'box_id' => 3, //Main box
			'plugin_id' => 3,
			'block_id' => 2,
			'weight' => null,
			'is_published' => true,
			'from' => '2014-07-08 15:34:16',
			'to' => '2014-08-08 15:34:16',
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 3,
			'room_id' => 1,
			'box_id' => 3, //Main box
			'plugin_id' => 3,
			'block_id' => 3,
			'weight' => null,
			'is_published' => true,
			'from' => '2014-07-08 15:34:16',
			'to' => '2014-08-08 15:34:16',
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 4,
			'room_id' => 1,
			'box_id' => 3, //Main box
			'plugin_id' => 3,
			'block_id' => null,
			'weight' => null,
			'is_published' => true,
			'from' => '2014-07-08 15:34:16',
			'to' => '2014-08-08 15:34:16',
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 11,
			'room_id' => 1,
			'box_id' => 3, //Main box
			'plugin_id' => 3,
			'block_id' => 11,
			'weight' => null,
			'is_published' => true,
			'from' => '2014-07-08 15:34:16',
			'to' => '2014-08-08 15:34:16',
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 12,
			'room_id' => 1,
			'box_id' => 3, //Main box
			'plugin_id' => 3,
			'block_id' => 12,
			'weight' => null,
			'is_published' => false,
			'from' => '2014-07-08 15:34:16',
			'to' => '2014-08-08 15:34:16',
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 13,
			'room_id' => 1,
			'box_id' => 3, //Main box
			'plugin_id' => 3,
			'block_id' => 13,
			'weight' => null,
			'is_published' => false,
			'from' => '2014-07-08 15:34:16',
			'to' => '2014-08-08 15:34:16',
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 14,
			'room_id' => 1,
			'box_id' => 3, //Main box
			'plugin_id' => 3,
			'block_id' => 14,
			'weight' => null,
			'is_published' => false,
			'from' => '2014-07-08 15:34:16',
			'to' => '2014-08-08 15:34:16',
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
	);

}
