<?php
/**
 * index/editor template
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
<div
	id="nc-iframes-editor-<?php echo $frameId; ?>"
	ng-controller="Iframes.edit"
	ng-init="setInit(<?php echo intval($frameId); ?>,
		<?php echo intval($blockId); ?>,
		<?php echo intval($langId); ?>)"
>
	<!-- iframeの表示 -->
	<?php echo $this->element("Iframes.index/iframe_data"); ?>

	<!-- ラベルの表示 -->
	<?php echo $this->element("Iframes.index/status_label"); ?>

</div>