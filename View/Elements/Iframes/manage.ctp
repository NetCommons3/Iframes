<ul class="nav nav-tabs" role="tablist">
	<li class="small active" id="nc-iframes-edit-tab-<?php echo (int)$frameId; ?>">
		<a href="#nc-iframes-edit-<?php echo (int)$frameId; ?>"
				role="tab" data-toggle="tab">
			<?php echo __d('iframes', 'edit iframe'); ?>
		</a>
	</li>
	<li class="small" id="nc-iframes-frame-setting-tab-<?php echo (int)$frameId; ?>">
		<a href="#nc-iframes-frame-setting-<?php echo (int)$frameId; ?>"
				role="tab" data-toggle="tab"
				ng-click="showIframeFrameSetting()">
			<?php echo __d('iframes', 'modify display style'); ?>
		</a>
	</li>
</ul>

<br />

<div class="tab-content">
	<div class="tab-pane active" id="nc-iframes-edit-<?php echo (int)$frameId; ?>">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php echo $this->element('Iframes/form_url'); ?>
			</div>
		</div>
		<?php echo $this->element('Iframes/edit_button'); ?>
	</div>
	<div class="tab-pane" id="nc-iframes-frame-setting-<?php echo (int)$frameId; ?>">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php echo $this->element('Iframes/setting_message'); ?>
				<?php echo $this->element('Iframes/iframe_frame_setting'); ?>
			</div>
		</div>
		<?php echo $this->element('Iframes/setting_button'); ?>
	</div>

</div>