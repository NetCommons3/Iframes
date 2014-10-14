<?php
/**
 * RoomPartFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Summary for RoomPartFixture
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test
 */
class RoomPartFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'part_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => null),
		'hierarchy' => array('type' => 'integer', 'null' => true, 'default' => null),
		'read_page' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'edit_page' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'create_page' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'publish_page' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'read_block' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'edit_block' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'create_block' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'publish_block' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'read_content' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'edit_content' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'create_content' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
		'publish_content' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 2),
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
			'part_id' => 1,
			'weight' => 1,
			'hierarchy' => 1,
			'read_page' => 1,
			'edit_page' => 1,
			'create_page' => 1,
			'publish_page' => 1,
			'read_block' => 1,
			'edit_block' => 1,
			'create_block' => 1,
			'publish_block' => 1,
			'read_content' => 1,
			'edit_content' => 1,
			'create_content' => 1,
			'publish_content' => 1,
		),
		array(
			'id' => 2,
			'part_id' => 2,
			'weight' => 1,
			'hierarchy' => 1,
			'read_page' => 1,
			'edit_page' => 1,
			'create_page' => 1,
			'publish_page' => 1,
			'read_block' => 1,
			'edit_block' => 1,
			'create_block' => 1,
			'publish_block' => 1,
			'read_content' => 1,
			'edit_content' => 0,
			'create_content' => 1,
			'publish_content' => 1,
		),
	);

}
