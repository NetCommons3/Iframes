<?php echo $this->Html->script('/iframes/js/iframes.js'); ?>

<div ng-controller="Iframes"
	ng-init="initialize(<?php echo h(json_encode($iframe)); ?>,
				<?php echo h(json_encode($iframeFrameSetting)); ?>,
				<?php echo (int)$frameId; ?>)">

	<div id="nc-iframes-manage-modal-<?php echo (int)$frameId; ?>" class="modal fade">
		<div class="ng-scope">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button data-dismiss="modal" class="close" type="button">
							<span aria-hidden="true">×</span>
							<span class="sr-only">Close</span>
						</button>
						<h4 class="modal-title">
							<?php echo __d('iframes', 'Manage'); ?>
						</h4>
					</div>
					<div class="modal-body">
						<?php echo $this->element('Iframes/manage'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
		//ヘッダーボタン(ブロック設定、編集、公開する)の表示
		echo $this->element('Iframes/header_button');

		//結果メッセージの表示
		echo $this->element('Iframes/edit_message');

		//iframeの表示
		echo $this->element('Iframes/iframe');

		//状態ラベルの表示
		echo $this->element('Iframes/status_label');
	?>

	<div class="hidden" id="nc-iframes-post-form-area-<?php echo (int)$frameId; ?>">
		<?php
			//登録POST用のフォーム
		?>
	</div>

</div>