<?php
/**
 * IframeFixture
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
 * IframeFixture
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Fixture
 */
class IframeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @var      array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified_user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
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
			'block_id' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 2,
			'block_id' => 2,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 11,
			'block_id' => 11,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 12,
			'block_id' => 12,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 13,
			'block_id' => 13,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 14,
			'block_id' => 14,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
	);

}
