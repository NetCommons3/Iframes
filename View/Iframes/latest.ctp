<?php echo $this->Html->script('/iframes/js/iframes.js'); ?>

<div>
	<?php
		//iframeの表示
		echo $this->element('Iframes/iframe');
	?>
</div>

<div ng-controller="Iframes"
	ng-init="initialize(<?php echo h(json_encode($iframe)); ?>,
				<?php echo (int)$frameId; ?>)">
	<?php
		//状態ラベルの表示
		echo $this->element('Iframes/status_label');
	?>
</div>
