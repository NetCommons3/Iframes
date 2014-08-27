<?php
/**
 * index/status_label template elements
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.View.Elements.index
 */

//セッティングモード時のラベル表示部分
$statusOn[1] = 'false';
$statusOn[2] = 'false';
$statusOn[3] = 'false';
$statusOn[4] = 'false';

//下書き、申請中の状態表示
if (isset($item)
	&& isset($item['IframeDatum'])
	&& isset($item['IframeDatum']['status_id'])) {
	$status = $item['IframeDatum']['status_id'];
	if ($status == Configure::read('Iframes.Status.PublishRequest')) {
		$statusOn[2] = 'true';
	}
	if ($status == Configure::read('Iframes.Status.Draft')) {
		$statusOn[3] = 'true';
	}
	if ($status == Configure::read('Iframes.Status.Reject')) {
		$statusOn[4] = 'true';
	}
}

//公開中表示
$statusId = 0;
if (isset($item)
	&& isset($item['IframeDatum'])
	&& isset($item['IframeDatum']['status_id'])
) {
	$statusId = intval($item['IframeDatum']['status_id']);
}
if ($statusId == Configure::read('Iframes.Status.Publish')) {
	$statusOn[1] = 'true';
}

?>
<p id="nc-iframes-status-label-<?php echo intval($frameId); ?>"
   ng-init="statusId=<?php echo $statusId; ?>"
>
	<span
		ng-init="label.publish=<?php echo $statusOn[1];?>"
		ng-show="label.publish"
		class="label label-info ng-hide"
		><?php echo __('公開中'); ?></span>
	<span
		ng-init="label.draft=<?php echo $statusOn[3];?>"
		ng-show="label.draft"
		class="label label-info ng-hide"
		><?php echo __('下書き中'); ?></span>
	<span
		ng-init="label.request=<?php echo $statusOn[2];?>"
		ng-show="label.request"
		class="label label-danger ng-hide"
		><?php echo __('公開申請中'); ?></span>
	<span
		ng-init="label.reject=<?php echo $statusOn[4];?>"
		ng-show="label.reject"
		class="label label-default ng-hide"
		><?php echo __('差し戻し中'); ?></span>
	<span class="label label-danger ng-hide"
	      ng-show="View.edit.preview"
	><?php echo __('プレビュー表示中'); ?></span>
</p>