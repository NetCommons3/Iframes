<?php
/**
 * setting/label template elements
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.View.Elements.setting
 */

//セッティングモード時のラベル表示部分

$statusHidden[1] = "hidden";
$statusHidden[2] = "hidden";
$statusHidden[3] = "hidden";
$statusHidden[4] = "hidden";

//下書き、申請中、差し戻しの状態表示
if (isset($item)
	&& isset($item['IframeDatum'])
	&& isset($item['IframeDatum']['status_id'])) {
	$status = $item['IframeDatum']['status_id'];
	if ($status == 2) {
		$statusHidden[2] = "";
	}
	if ($status == 3) {
		$statusHidden[3] = "";
	}
	if ($status == 4) {
		$statusHidden[4] = "";
	}
}

?>
<p id="iframe-status-label-<?php echo intval($frameId); ?>">
	<span class="label label-info iframe-status-1 <?php echo $statusHidden[1]; ?>">
		<?php echo __('公開中'); ?>
	</span>
	<span class="label label-danger iframe-status-2 <?php echo $statusHidden[2]; ?>">
		<?php echo __('公開申請あり'); ?>
	</span>
	<span class="label label-info iframe-status-3 <?php echo $statusHidden[3]; ?>">
		<?php echo __('下書きあり'); ?>
	</span>
	<span class="label label-default iframe-status-4 <?php echo $statusHidden[4]; ?>">
		<?php echo __('差し戻しあり'); ?>
	</span>
	<span class="label label-danger iframe-preview hidden">
		<?php echo __("プレビュー表示中"); ?>
	</span>
</p>