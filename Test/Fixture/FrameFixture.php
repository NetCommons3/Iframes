<?php
/**
 * FrameFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Summary for FrameFixture
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test
 */
class FrameFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'language_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'room_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'box_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'plugin_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'plugin_key' => array('type' => 'text', 'null' => false, 'default' => null),
		'name' => array('type' => 'text', 'null' => true, 'default' => null),
		'block_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => null),
		'key' => array('type' => 'text', 'null' => false, 'default' => null),
		'is_published' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'from' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'to' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created_user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'language_id' => 2,
			'room_id' => 1,
			'box_id' => 3,
			'plugin_id' => 1,
			'plugin_key' => '',
			'name' => '',
			'block_id' => 1,
			'key' => '12345',
			'weight' => 1,
			'is_published' => 1,
			'from' => '2014-07-25 08:10:53',
			'to' => '2014-07-25 08:10:53',
		),
		array(
			'id' => 2,
			'language_id' => 2,
			'room_id' => 1,
			'box_id' => 3,
			'plugin_id' => 1,
			'plugin_key' => '',
			'name' => '',
			'block_id' => '',
			'key' => '12121',
			'weight' => 1,
			'is_published' => 1,
			'from' => '2014-07-25 08:10:53',
			'to' => '2014-07-25 08:10:53',
		),
		array(
			'id' => 3,
			'language_id' => 2,
			'room_id' => 0,
			'box_id' => 3,
			'plugin_id' => 1,
			'plugin_key' => '',
			'name' => '',
			'block_id' => 2,
			'key' => '123456',
			'weight' => 1,
			'is_published' => 1,
			'from' => '2014-07-25 08:10:53',
			'to' => '2014-07-25 08:10:53',
		),
		array(
			'id' => 4,
			'language_id' => 2,
			'room_id' => 0,
			'box_id' => 3,
			'plugin_id' => 1,
			'plugin_key' => '',
			'name' => '',
			'block_id' => 2,
			'key' => '',
			'weight' => 1,
			'is_published' => 1,
			'from' => '2014-07-25 08:10:53',
			'to' => '2014-07-25 08:10:53',
		),
	);

}
