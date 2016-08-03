<?php
/**
 * IframeFrameSettingFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * IframeFrameSettingFixture
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Iframes\Test\Fixture
 */
class IframeFrameSettingFixture extends CakeTestFixture {

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'frame_key' => 'Lorem ipsum dolor sit amet',
			'height' => 1,
			'display_scrollbar' => 1,
			'display_frame' => 1,
			'created_user' => 1,
			'created' => '2016-07-13 13:15:36',
			'modified_user' => 1,
			'modified' => '2016-07-13 13:15:36'
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
