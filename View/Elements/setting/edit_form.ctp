<?php
/**
 * setting/edit_form template elements
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.View.Elements.setting
 */
?>

<!-- 設定フォーム -->
<div class="" id="nc-iframes-edit-form-<?php echo intval($frameId);?>">
<?php
	echo $this->Form->create(null, array(
				'class' => 'form-horizontal',
				'style' => 'margin-bottom: 15px; padding: 0px 15px;',
				'default' => false,
			)
		);
?>

	<div class='form-group'>
		<?php
			//URL
			$values = (isset($item['IframeDatum']['url'])) ? $item['IframeDatum']['url'] : "";
			echo $this->Form->label('IframeDatum.url', __('URL'), array(
						'class' => 'control-label glyphicon glyphicon-link',
					)
				);
			echo $this->Form->input('IframeDatum.url', array(
						"id" => 'nc-iframes-edit-url-' . intval($frameId),
						'label' => false,
						'type' => 'url',
						'placeholder' => 'http://',
						'value' => h($values),
						'class' => 'form-control',
					)
				);
		?>
	</div>

	<div class='form-group'>
		<?php
			//フレームの高さ
			$values = (isset($item['IframeDatum']['frame_height'])) ? $item['IframeDatum']['frame_height'] : 400;
			echo $this->Form->label('IframeDatum.frame_height', __('フレームの高さ'), array(
						'class' => 'control-label',
					)
				);
			echo $this->Form->input('IframeDatum.frame_height', array(
						"id" => 'nc-iframes-edit-height-' . intval($frameId),
						'label' => false,
						'type' => 'text',
						'placeholder' => 'フレームの高さを入力してください。',
						'value' => h($values),
						'class' => 'form-control',
					)
				);
		?>
	</div>

    <!-- 詳細設定ボタン(リンク) -->
    <div
		class="text-center form-group"
		id="nc-iframes-edit-link-detail-<?php echo intval($frameId); ?>"
		style="padding-top: 10px;"
		ng-hide="View.edit.detail"
	>
	    <button
			class="btn btn-link"
            ng-click="detailFormOpen(<?php echo intval($frameId);?>)"
		>
			<span class="glyphicon glyphicon-plus"></span>
			<span><?php echo __('詳細設定'); ?></span>
        </button>
    </div>

    <!-- 詳細設定フォーム -->
    <div class="" id="nc-iframes-edit-form-detail-<?php echo intval($frameId);?>" ng-show="View.edit.detail">

		<div class='form-group'>
			<?php
				//スクロールバー
				$values = (! isset($item['IframeDatum']) || $item['IframeDatum']['scrollbar_show'] == 1) ? 1 : 0;
				echo $this->Form->label('IframeDatum.scrollbar_show', __('スクロールバー'), array(
							'class' => 'control-label',
						)
					);
				echo '</br>';
				echo $this->Form->radio(
						$fieldName = 'IframeDatum.scollbar_show',
						$options = array(
							1 => ' あり ',
							0 => ' なし ',
						),
						$attributes = array(
							'id' => 'nc-iframes-edit-scrollbar-' . intval($frameId) . '-',
							'value' => h($values),
							'label' => false,
							'legend' => false,
						)
					);
			?>
		</div>

		<div class='form-group'>
			<?php
				//フレーム枠
				$values = (! isset($item['IframeDatum']) || $item['IframeDatum']['scrollframe_show'] == 0) ? 0 : 1;
				echo $this->Form->label('IframeDatum.scrollframe_show', __('フレーム枠'), array(
							'class' => 'control-label',
						)
					);
				echo '</br>';
				echo $this->Form->radio(
						$fieldName = 'IframeDatum.scrollframe_show',
						$options = array(
							1 => ' あり ',
							0 => ' なし ',
						),
						$attributes = array(
							'id' => 'nc-iframes-edit-scrollframe-' . intval($frameId) . '-',
							'value' => h($values),
							'label' => false,
							'legend' => false,
						)
					);
			?>
		</div>
    </div>

<?php
	echo $this->Form->end();
?>

</div>