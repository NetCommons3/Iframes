<?php
/**
 * iframe edit view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>
<div class="form-group has-feedback"
		ng-class="(iframeEdit['data[Iframe][url]'].$valid ? 'has-success' : 'has-error')">
	<?php
		echo $this->Form->label('Iframe.url', __d('net_commons', 'URL'), array(
				'for' => 'data[Iframe][url]',
			));
		echo $this->Form->input('Iframe.url', array(
					'label' => false,
					'div' => false,
					'type' => 'text',
					'class' => 'form-control',
					'ng-model' => 'edit.data.Iframe.url',
					//CakeのValidationRuleに合わせる実装に変更予定。現状NC2の正規表現を引用。
					//lib/Cake/Utility/Validation.php->url()メソッド参照。
					'ng-pattern' => '/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/',
					'placeholder' => 'http://',
					'required' => 'true',
					'autofocus' => 'true',
				)
			);
	?>

	<span class="form-control-feedback"
			ng-class="iframeEdit['data[Iframe][url]'].$valid ?
		'glyphicon glyphicon-ok' : 'glyphicon glyphicon-remove'; ">

	</span>

	<span class="help-block">
		<span ng-show="iframeEdit['data[Iframe][url]'].$valid">
			<br />
		</span>

		<span ng-show="iframeEdit['data[Iframe][url]'].$error.required">
			<?php echo __d('net_commons', 'Required field.');?>
		</span>

		<span ng-show="iframeEdit['data[Iframe][url]'].$error.pattern">
			<?php echo __d('net_commons', 'Invalid input.');?>
		</span>

	</span>
</div>