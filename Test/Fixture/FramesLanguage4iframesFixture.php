<?php
/**
 * FramesLanguageFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('FramesLanguageFixture', 'Frames.Test/Fixture');

/**
 * FramesLanguageFixture
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Blocks\Test\Fixture
 */
class FramesLanguage4iframesFixture extends FramesLanguageFixture {

/**
 * Model name
 *
 * @var string
 */
	public $name = 'FramesLanguage';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'frames_languages';

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		//メイン
		array(
			'id' => '6',
			'language_id' => '2',
			'frame_id' => '6',
			'name' => 'Test frame main',
			'is_origin' => true,
			'is_translation' => false,
			'is_original_copy' => false,
		),
		array(
			'id' => '7',
			'language_id' => '2',
			'frame_id' => '7',
			'name' => 'Test frame main',
			'is_origin' => true,
			'is_translation' => false,
			'is_original_copy' => false,
		),
		array(
			'id' => '8',
			'language_id' => '2',
			'frame_id' => '8',
			'name' => 'Test frame main',
			'is_origin' => true,
			'is_translation' => false,
			'is_original_copy' => false,
		),
	);

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		parent::init();
	}

}
