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
			'id' => '1',
			'frame_key' => 'frame_3',
			'height' => '200',
			'display_scrollbar' => true,
			'display_frame' => true,
		),
		array(
			'id' => '2',
			'frame_key' => 'frame_4',
			'height' => '300',
			'display_scrollbar' => false,
			'display_frame' => false,
		),
	);

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		require_once App::pluginPath('Iframes') . 'Config' . DS . 'Schema' . DS . 'schema.php';
		$this->fields = (new IframesSchema())->tables['iframe_frame_settings'];
		parent::init();
	}

}
