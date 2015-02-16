<?php
/**
 * UserFixture
 *
 * @author Jun Nishikawa <topaz2@m0n0m0n0.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * Summary for UserFixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'role_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role_key' => 'system_administrator',
			'created_user' => 1,
			'created' => '2014-06-02 16:18:08',
			'modified_user' => 1,
			'modified' => '2014-06-02 16:18:08'
		),
		array(
			'id' => 2,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role_key' => 'chief_editor',
			'created_user' => 1,
			'created' => '2014-06-02 16:18:08',
			'modified_user' => 1,
			'modified' => '2014-06-02 16:18:08'
		),
		array(
			'id' => 3,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role_key' => 'editor',
			'created_user' => 1,
			'created' => '2014-06-02 16:18:08',
			'modified_user' => 1,
			'modified' => '2014-06-02 16:18:08'
		),
		array(
			'id' => 4,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'role_key' => 'visitor',
			'created_user' => 1,
			'created' => '2014-06-02 16:18:08',
			'modified_user' => 1,
			'modified' => '2014-06-02 16:18:08'
		),
	);

}
