<?php
/**
 * index/iframe_data template
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.View.Iframes.index
 */
?>

<div class="item" id="nc-iframes-view-<?php echo intval($frameId); ?>" 
	ng-init="View.default=true"
	ng-show="View.default"
>
	<?php if (isset($item)
		&& isset($item['IframeDatum'])
		&& isset($item['IframeDatum']['url'])) : ?>

		<iframe id="nc-iframes-view-attr-<?php echo intval($frameId); ?>"
			src="<?php echo $item['IframeDatum']['url']; ?>"
			height="<?php echo $item['IframeDatum']['frame_height']; ?>"
			width="100%"
			scrolling="<?php echo $item['IframeDatum']['scrollbar_show'] ? 'auto' : 'no'; ?>"
			frameborder="<?php echo $item['IframeDatum']['scrollframe_show'] ? 1 : 0; ?>"
		></iframe>
	<?php else : ?>
		<p><?php echo __("URLが登録されていません。"); ?></p>
	<?php endif; ?>
</div>
