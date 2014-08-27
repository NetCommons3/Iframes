<?php
/**
 * setting/form_button template elements
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.View.Elements.setting
 */

// セッティングモード エディタ用ボタン
//表示非表示初期値制御
$hidden['draft'] = "";
$hidden['preview'] = "";
$hidden['previewCLose'] = "hidden";
$hidden['draft'] = "";
$hidden['reject'] = "";
$hidden['publish'] = "";

if ($item
	&& isset($item['IframeDatum'])
	&& isset($item['IframeDatum']['status_id'])
	&& $item['IframeDatum']['status_id'] == Configure::read('Iframes.Status.PublishRequest')) {
	$hidden['draft'] = ' hidden';
	$hidden['reject'] = '';
} else {
	$hidden['draft'] = '';
	$hidden['reject'] = ' hidden';
}

?>
<p class="text-center"
	id="nc-iframes-edit-button-<?php echo intval($frameId); ?>"
	style="padding-top: 10px;"
>
	<button
		class="btn btn-default iframe-edit-button-close"
		ng-click="closeForm(<?php echo intval($frameId);?>)"
		<?php //ng-disabled="sendRock" ?>
	>
		<span class="glyphicon glyphicon-remove"></span> <span><?php echo __('閉じる'); ?></span></button>
	<button
		class="btn btn-default iframe-edit-button-preview "
		id="nc-iframes-button-preview-<?php echo intval($frameId);?>"
		ng-click="showPreview(<?php echo intval($frameId);?>)"
		ng-hide="View.edit.preview"
		<?php //ng-disabled="sendRock" ?>
		>
		<span class="glyphicon glyphicon-file"></span> <span><?php echo __('プレビュー'); ?></span></button>
	<button
		class="btn btn-default iframe-edit-button-preview-close"
		ng-click="closePreview(<?php echo intval($frameId);?>)"
		ng-show="View.edit.preview"
		<?php //ng-disabled="sendRock" ?>
		>
		<span class="glyphicon glyphicon-file"></span> <span><?php echo __('プレビューを閉じる'); ?></span></button>
	<button
		class="btn btn-default"
		ng-click="post('Draft', <?php echo intval($frameId);?>)"
		ng-hide="label.request"
		<?php //ng-disabled="sendRock" ?>
	>
		<span class="glyphicon glyphicon-pencil"></span> <span><?php echo __('下書き'); ?></span></button>

	<button
		class="btn btn-default"
		ng-click="post('Reject', <?php echo intval($frameId);?>)"
		ng-show="label.request"
		<?php //ng-disabled="sendRock" ?>
		>
		<span class="glyphicon glyphicon-pencil"></span> <span><?php echo __('差し戻し'); ?></span>
	</button>

	<button
		class="btn btn-primary iframe-edit-button-request"
		ng-click="post('PublishRequest', <?php echo intval($frameId);?>)"
		<?php //ng-disabled="sendRock" ?>
		>
		<span class="glyphicon glyphicon-share-alt"></span> <span><?php echo __('公開申請'); ?></span></button>
	<button
		class="btn btn-primary iframe-edit-button-publish"
		ng-click="post('Publish', <?php echo intval($frameId);?>)"
		<?php //ng-disabled="sendRock" ?>
	>
		<span class="glyphicon glyphicon-share-alt"></span> <span><?php echo __('公開'); ?></span></button>
</p>