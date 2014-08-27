<?php
/**
 * setting/edit_button template elements
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.View.Elements.setting
 */

//公開するボタンの非表示
/*
	$publishBtnHidden = "hidden";
	if ( isset($item)
			&& isset($item['IframeDatum'])
			&& (! isset($item['IframeDatum']['status_id']) || $item['IframeDatum']['status_id'] == Configure::read('Iframes.Status.PublishRequest') ) ) {
		$publishBtnHidden = "";
	}
*/
?>

<!-- 編集ボタン 状態表示-->
<p class="text-right" style="margin-top: 5px;"
   id="nc-iframes-edit-open-button-<?php echo intval($frameId); ?>"
   ng-hide="View.edit.body"
>
	<!-- block setting-->
	<?php //if (isset($isBlockEdit) && $isBlockEdit) { ?>
	<button class="btn btn-default"
		ng-click="openBlockSetting(<?php echo intval($frameId); ?>)"
		ng-disabled="sendRock"
		><span class="glyphicon glyphicon-cog"> <?php echo __("ブロック設定"); ?></span></button>
	<?php //} ?>
	<!-- edit buttun -->
	<?php //if($isEditor) { ?>
	<button class="btn btn-primary"
		ng-click="getEditor(<?php echo intval($frameId); ?>)"
		ng-disabled="sendRock"
	><span class="glyphicon glyphicon-pencil"> <?php echo __("編集"); ?></span></button>
	<?php //} ?>
	<!-- publich button -->
	<?php //if($isPublisher) { ?>
	<button class="btn btn-danger ng-hide"
		ng-show="label.request"
		ng-click="post('Publish', <?php echo intval($frameId);?>)"
		ng-disabled="sendRock"
	><span class="glyphicon glyphicon-share-alt"> <?php echo __("公開する"); ?></span></button>
	<?php //} ?>
</p>