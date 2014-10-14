<form method="post" accept-charset="utf-8" name="iframeEdit"
		id="nc-iframes-input-form-<?php echo (int)$frameId; ?>" novalidate>

	<div class="form-group has-feedback"
		ng-class="(iframeEdit['data[Iframe][url]'].$valid ? 'has-success' : 'has-error')">
		<?php
			echo $this->Form->label('Iframe.url', __d('iframes', 'URL'), array(
					'for' => 'data[Iframe][url]',
				));
			echo $this->Form->input('Iframe.url', array(
						'label' => false,
						'div' => false,
						'type' => 'text',
						'class' => 'form-control',
						'ng-model' => 'iframeUrl',
						//CakeのValidationRuleに合わせる実装に変更予定。現状NC2の正規表現を引用。
						//lib/Cake/Utility/Validation.php->url()メソッド参照。
						'ng-pattern' => '/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/',
						'placeholder' => 'http://',
						'required' => 'true',
					)
				);
		?>

		<span class="form-control-feedback"
			  ng-class="iframeEdit['data[Iframe][url]'].$valid ?
				'glyphicon glyphicon-ok' :
				'glyphicon glyphicon-remove'; ">
		</span>
		<span class="help-block">
			<?php echo $this->element('Iframes/form_url_error'); ?>
		</span>
	</div>

</form>