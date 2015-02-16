<?php
/**
 * iframe setting view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->Html->script('/net_commons/base/js/workflow.js', false); ?>
<?php echo $this->Html->script('/iframes/js/iframes.js', false); ?>

<div id="nc-iframes-<?php echo (int)$frameId; ?>"
	 ng-controller="IframeEdit"
	 ng-init="initialize(<?php echo h(json_encode($iframes)); ?>)">

	<?php $this->start('title'); ?>
	<?php echo __d('iframes', 'plugin_name'); ?>
	<?php $this->end(); ?>

	<!-- タブ生成 -->
	<?php $this->startIfEmpty('tabs'); ?>
		<!-- 編集タブ -->
		<li ng-class="{active:tab.isSet(0)}">
			<a href="" role="tab" data-toggle="tab">
				<?php echo __d('iframes', 'Iframe edit'); ?>
			</a>
		</li>
		<!-- 表示方法変更タブ:公開権限があれば表示 -->
		<?php if ($contentPublishable) : ?>
			<li ng-class="{active:tab.isSet(1)}">
				<a href="<?php echo $this->Html->url('/iframes/iframeFrameSettings/edit/' . $frameId) ?>">
					<?php echo __d('iframes', 'Display change'); ?>
				</a>
			</li>
		<?php endif; ?>
	<?php $this->end(); ?>

	<div class="modal-header">
		<?php $title = $this->fetch('title'); ?>
		<?php if ($title) : ?>
			<?php echo $title; ?>
		<?php else : ?>
			<br />
		<?php endif; ?>
	</div>

	<div class="modal-body">
		<?php $tabs = $this->fetch('tabs'); ?>
		<?php if ($tabs) : ?>
			<ul class="nav nav-tabs" role="tablist">
				<?php echo $tabs; ?>
			</ul>
			<br />
			<?php $tabId = $this->fetch('tabIndex'); ?>
			<div class="tab-content" ng-init="tab.setTab(<?php echo (int)$tabId; ?>)">
		<?php endif; ?>

		<div>
		<?php echo $this->Form->create('Iframe', array(
				'name' => 'form',
				'novalidate' => true,
			)); ?>
			<?php echo $this->Form->hidden('id'); ?>
			<?php echo $this->Form->hidden('Frame.id', array(
				'value' => $frameId,
			)); ?>
			<?php echo $this->Form->hidden('Block.id', array(
				'value' => $blockId,
			)); ?>

			<div class="panel panel-default" >
				<div class="panel-body has-feedback">
					<?php echo $this->element('Iframes/edit_form'); ?>

					<hr />

					<?php echo $this->element('Comments.form'); ?>
				</div>

				<div class="panel-footer text-center">
					<?php echo $this->element('NetCommons.workflow_buttons'); ?>
				</div>
			</div>

			<?php echo $this->element('Comments.index'); ?>

		<?php echo $this->Form->end(); ?>
	</div>
</div>