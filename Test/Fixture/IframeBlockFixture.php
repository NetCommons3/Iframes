<?php
/**
 * IframeBlockFixture
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
 * IframeBlockFixture
 *
 * @author	    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframe.Test.Fixture
 */
class IframeBlockFixture extends CakeTestFixture {

/**
 * db config
 * @author	    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @var         string
 */
	public $useDbConfig = 'test';

/**
 * table
 *
 * @author	    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @var         string
 */
	public $table = 'blocks';

/**
 * Fields
 *
 * @author	    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @var         array
 */
	public $fields = array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
					'room_id' => array('type' => 'integer', 'null' => true, 'default' => null),
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
 * @author	    Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @var         array
 */
	public $records = array(
		array(
			'id' => 1,
			'room_id' => 1,
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 2,
			'room_id' => 1,
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 11,
			'room_id' => 1,
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 12,
			'room_id' => 1,
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 13,
			'room_id' => 1,
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
		array(
			'id' => 14,
			'room_id' => 1,
			'created_user_id' => 1,
			'created' => '2014-07-08 15:34:16',
			'modified_user_id' => 1,
			'modified' => '2014-07-08 15:34:16',
		),
	);
}
