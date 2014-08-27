<?php
/**
 * setting/get_edit_form template
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.View.Iframes.setting
 */
?>

<div id="nc-iframes-data-<?php echo $frameId?>">
	<div style="display: none;">
	<?php echo $this->Form->create(null); ?>
		<?php
		echo $this->Form->input("IframeDatum.url", array(
				"type" => "text",
				"value" => "",
			)
		);
		echo $this->Form->input("IframeDatum.frame_height", array(
				"type" => "text",
				"value" => "",
			)
		);
		echo $this->Form->input("IframeDatum.scrollbar_show", array(
				"type" => "text",
				"value" => "",
			)
		);
		echo $this->Form->input("IframeDatum.scrollframe_show", array(
				"type" => "text",
				"value" => "",
			)
		);
		echo $this->Form->input("IframeDatum.frameId", array(
				"type" => "text",
				"value" => h($frameId),
			)
		);
		echo $this->Form->input("IframeDatum.blockId", array(
				"type" => "text",
				"value" => h($blockId),
			)
		);
		echo $this->Form->input("IframeDatum.type", array(
				"type" => "text",
				"value" => "",
			)
		);
		echo $this->Form->input("IframeDatum.langId", array(
				"type" => "text",
				"value" => $langId,
			)
		);
		echo $this->Form->input("IframeDatum.id", array(
				"type" => "text",
				"value" => "",
			)
		);
		?>
	<?php echo $this->Form->end(); ?>
	</div>
</div>