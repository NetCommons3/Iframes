<?php
/**
 * Iframe Model Test Case
 *
 * @property Iframe $Iframe
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('IframeAppModelTest', 'Iframes.Test/Case/Model');

/**
 *Iframe Model Test Case
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Test\Case\Model
 */
class IframeValidateErrorTest extends IframeAppModelTest {

/**
 * testSaveAnnouncemenByStatus method
 *
 * @return void
 */
	/* public function testSaveAnnouncemenByStatus() { */
	/* 	$postData = array( */
	/* 		'Iframe' => array( */
	/* 			'block_id' => 1, */
	/* 			'key' => 'iframe_1', */
	/* 			'content' => 'edit content', */
	/* 			'is_auto_translated' => true, */
	/* 			'translation_engine' => 'edit translation_engine', */
	/* 		), */
	/* 		'Frame' => array( */
	/* 			'id' => '1' */
	/* 		), */
	/* 		'Comment' => array( */
	/* 			'plugin_key' => 'iframes', */
	/* 			'content_key' => 'iframe_1', */
	/* 			'comment' => 'edit comment', */
	/* 		) */
	/* 	); */
	/* 	$result = $this->Iframe->saveIframe($postData); */
	/* 	$this->assertFalse($result, 'saveIframe test No.0 data = ' . print_r($postData, true)); */

	/* 	$checkes = array( */
	/* 		null, '', -1, 0, 5, 9999, 'abcde', */
	/* 	); */
	/* 	foreach ($checkes as $i => $check) { */
	/* 		$postData['Iframe']['status'] = $check; */
	/* 		$result = $this->Iframe->saveIframe($postData); */
	/* 		$this->assertFalse($result, 'saveIframe test No.' . ($i + 1) . print_r($postData, true)); */
	/* 	} */
	/* } */

/**
 * testSaveIframeByContent method
 *
 * @return void
 */
	/* public function testSaveIframeByContent() { */
	/* 	$postData = array( */
	/* 		'Iframe' => array( */
	/* 			'block_id' => 1, */
	/* 			'key' => 'iframe_1', */
	/* 			'status' => '1', */
	/* 			'is_auto_translated' => true, */
	/* 			'translation_engine' => 'edit translation_engine', */
	/* 		), */
	/* 		'Frame' => array( */
	/* 			'id' => '1' */
	/* 		), */
	/* 		'Comment' => array( */
	/* 			'plugin_key' => 'iframes', */
	/* 			'content_key' => 'iframe_1', */
	/* 			'comment' => 'edit comment', */
	/* 		) */
	/* 	); */
	/* 	$result = $this->Iframe->saveIframe($postData); */
	/* 	$this->assertFalse($result, 'saveIframe test No.0 data = ' . print_r($postData, true)); */

	/* 	$checkes = array( */
	/* 		null, '', */
	/* 	); */
	/* 	foreach ($checkes as $i => $check) { */
	/* 		$postData['Iframe']['content'] = $check; */
	/* 		$result = $this->Iframe->saveIframe($postData); */
	/* 		$this->assertFalse($result, 'saveIframe test No.' . ($i + 1) . print_r($postData, true)); */
	/* 	} */
	/* } */

/**
 * testSaveAnnouncemenByContent method
 *
 * @return void
 */
	/* public function testSaveAnnouncemenByComment() { */
	/* 	$postData = array( */
	/* 		'Iframe' => array( */
	/* 			'block_id' => 1, */
	/* 			'key' => 'iframe_1', */
	/* 			'status' => NetCommonsBlockComponent::STATUS_DISAPPROVED, */
	/* 			'content' => 'edit content', */
	/* 			'is_auto_translated' => true, */
	/* 			'translation_engine' => 'edit translation_engine', */
	/* 		), */
	/* 		'Frame' => array( */
	/* 			'id' => '1' */
	/* 		), */
	/* 		'Comment' => array( */
	/* 			'plugin_key' => 'iframes', */
	/* 			'content_key' => 'iframe_1', */
	/* 		) */
	/* 	); */
	/* 	$result = $this->Iframe->saveIframe($postData); */
	/* 	$this->assertFalse($result, 'saveIframe test No.0 data = ' . print_r($postData, true)); */

	/* 	$checkes = array( */
	/* 		null, '', */
	/* 	); */
	/* 	foreach ($checkes as $i => $check) { */
	/* 		$postData['Comment']['comment'] = $check; */
	/* 		$result = $this->Iframe->saveIframe($postData); */
	/* 		$this->assertFalse($result, 'saveIframe test No.' . ($i + 1) . print_r($postData, true)); */
	/* 	} */
	/* } */
}
