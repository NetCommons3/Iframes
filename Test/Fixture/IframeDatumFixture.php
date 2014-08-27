<?php
/**
 * IframeDatumFixture
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
 * IframeDatumFixture
 *
 * @author	    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Fixture
 */
class IframeDatumFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @var      array
 */
	public $fields = array(
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
 * Records
 *
 * @author   Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since    NetCommons 3.0.0.0
 * @var      array
 */
	public $records = array(
		array(
			'id' => 1,
			'iframe_id' => 1,
			'status_id' => 1,
			'language_id' => 2,
			'is_original' => 1,
			'url' => 'http://www.netcommons.org/',
			'frame_height' => 400,
			'scrollbar_show' => 1,
			'scrollframe_show' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 2,
			'iframe_id' => 1,
			'status_id' => 2,
			'language_id' => 2,
			'is_original' => 1,
			'url' => 'http://www.netcommons.org/',
			'frame_height' => 400,
			'scrollbar_show' => 1,
			'scrollframe_show' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 5,
			'iframe_id' => 2,
			'status_id' => 3,
			'language_id' => 2,
			'is_original' => 1,
			'url' => 'http://www.netcommons.org/',
			'frame_height' => 400,
			'scrollbar_show' => 1,
			'scrollframe_show' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 6,
			'iframe_id' => 2,
			'status_id' => 4,
			'language_id' => 2,
			'is_original' => 1,
			'url' => 'http://www.netcommons.org/',
			'frame_height' => 400,
			'scrollbar_show' => 1,
			'scrollframe_show' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 11,
			'iframe_id' => 11,
			'status_id' => 1,
			'language_id' => 2,
			'is_original' => 1,
			'url' => 'http://www.netcommons.org/',
			'frame_height' => 400,
			'scrollbar_show' => 1,
			'scrollframe_show' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 12,
			'iframe_id' => 12,
			'status_id' => 2,
			'language_id' => 2,
			'is_original' => 1,
			'url' => 'http://www.netcommons.org/',
			'frame_height' => 400,
			'scrollbar_show' => 1,
			'scrollframe_show' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 13,
			'iframe_id' => 13,
			'status_id' => 3,
			'language_id' => 2,
			'is_original' => 1,
			'url' => 'http://www.netcommons.org/',
			'frame_height' => 400,
			'scrollbar_show' => 1,
			'scrollframe_show' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
		array(
			'id' => 14,
			'iframe_id' => 14,
			'status_id' => 4,
			'language_id' => 2,
			'is_original' => 1,
			'url' => 'http://www.netcommons.org/',
			'frame_height' => 400,
			'scrollbar_show' => 1,
			'scrollframe_show' => 1,
			'created' => '2014-07-05 22:56:58',
			'created_user_id' => 1,
			'modified' => '2014-07-05 22:56:58',
			'modified_user_id' => 1
		),
	);

}
