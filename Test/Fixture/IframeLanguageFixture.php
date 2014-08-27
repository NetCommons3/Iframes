<?php
/**
 * IframeLanguageFixture
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
 * IframeLanguageFixture
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Case
 */
class IframeLanguageFixture extends CakeTestFixture {

/**
 * use table
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     bool
 */
	public $table = 'languages';

/**
 * Fields
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @var      array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 3, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => null),
		'is_active' => array('type' => 'boolean', 'null' => true, 'default' => null),
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
			'id' => '1',
			'code' => 'eng',
			'weight' => '1',
			'is_active' => true,
		),
		array(
			'id' => '2',
			'code' => 'jpn',
			'weight' => '2',
			'is_active' => true,
		),
	);

}
