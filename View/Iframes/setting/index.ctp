<?php
/**
 * Iframes index() view template
 *
 * @author        Noriko Arai <arai@nii.ac.jp>
 * @author        Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link          http://www.netcommons.org NetCommons Project
 * @license       http://www.netcommons.org/license.txt NetCommons License
 * @copyright     Copyright 2014, NetCommons Project
 * @since         NetCommons 3.0.0.0
 * @package       app.Plugin.Iframes.View.Iframes.setting
 */
?>
<div
	id="nc-iframes-<?php echo $frameId; ?>"
	ng-controller="Iframes.edit"
	ng-init="setInit(<?php echo intval($frameId); ?>,
		<?php echo intval($blockId); ?>,
		<?php echo intval($langId); ?>)"
>

<!-- 編集ボタン -->
<?php echo $this->element("Iframes.setting/edit_botton");?>

	<!-- メッセージ -->
	<p>
		<div class="alert hidden" id="nc-iframes-mss-<?php echo intval($frameId);?>">
			<span class="pull-right" ng-click="postAlertClose(<?php echo intval($frameId);?>)">
			<span class="glyphicon glyphicon-remove"> </span></span>
			<span class="message"> </span>
		</div>
	</p>

	<!-- プレビュー-->
	<div
		<?php //ng-init="Preview.html=''" ?>
		ng-init="View.edit.preview=false"
		ng-show="View.edit.preview"
		<?php //ng-bind-html='Preview.html' ?>
	    class="ng-hide"
		id="nc-iframes-preview-<?php echo intval($frameId);?>"
	>
			<!--{{Preview.html}}-->
	</div>

	<!-- iframeの表示 -->
	<?php echo $this->element("Iframes.index/iframe_data"); ?>

	<!-- ラベル -->
	<?php echo $this->element("Iframes.index/status_label"); ?>

	<!-- 編集枠  -->
	<div id="nc-iframes-form-<?php echo intval($frameId);?>" ng-show="View.edit.body">

		<!-- 編集フォーム -->
		<?php echo $this->element("Iframes.setting/edit_form");?>

		<!-- ボタン類 -->
		<?php echo $this->element("Iframes.setting/form_button");?>

	</div>

	<div id="nc-iframes-post-<?php echo $frameId;?>"></div>
	<div id="nc-iframes-block-setting-<?php echo intval($frameId);?>"></div>

</div>
