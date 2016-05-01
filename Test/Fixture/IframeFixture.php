<?php
/**
 * IframeFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * IframeFixture
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Iframes\Test\Fixture
 */
class IframeFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'block_id' => '141',
			'key' => 'iframe_1',
			'url' => 'http://www.netcommons.org/',
			'height' => '400',
			'display_scrollbar' => true,
			'display_frame' => true,
		),
		array(
			'id' => '2',
			'block_id' => '142',
			'key' => 'iframe_2',
			'url' => 'http://www.netcommons.org/',
			'height' => '400',
			'display_scrollbar' => true,
			'display_frame' => true,
		),
		array(
			'id' => '3',
			'block_id' => '143',
			'key' => 'iframe_3',
			'url' => 'http://www.netcommons.org/',
			'height' => '400',
			'display_scrollbar' => true,
			'display_frame' => true,
		),
	);

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		require_once App::pluginPath('Iframes') . 'Config' . DS . 'Schema' . DS . 'schema.php';
		$this->fields = (new IframesSchema())->tables['iframes'];
		parent::init();
	}

}
