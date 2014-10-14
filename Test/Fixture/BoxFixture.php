<?php
/**
 * BoxFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Summary for BoxFixture
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test
 */
class BoxFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'container_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'type' => array('type' => 'integer', 'null' => true, 'default' => null),
		'space_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'room_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'page_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => null),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null),
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
			'container_id' => 1,
			'type' => 1,
			'space_id' => 1,
			'room_id' => 1,
			'page_id' => 1,
			'weight' => 1,
		),
	);

}
