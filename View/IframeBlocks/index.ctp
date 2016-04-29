<?php
/**
 * ブロック一覧viewファイル
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<article class="block-setting-body">
	<?php echo $this->BlockTabs->main(BlockTabsHelper::MAIN_TAB_BLOCK_INDEX); ?>

	<div class="tab-content">
		<?php echo $this->BlockIndex->create(); ?>
			<div class="text-right">
				<?php echo $this->Button->addLink(); ?>
			</div>

			<?php echo $this->BlockIndex->hidden('Frame.id'); ?>

			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<?php echo $this->BlockIndex->tableHeader('Frame.id'); ?>

							<th>
								<?php echo $this->Paginator->sort('Block.name', __d('announcements', 'Content')); ?>
							</th>
							<th>
								<?php echo $this->Paginator->sort('Announcement.modified', __d('net_commons', 'Updated date')); ?>
							</th>
						</tr>
					</thead>

				</table>
			</div>
		<?php echo $this->BlockIndex->end(); ?>

		<?php echo $this->element('NetCommons.paginator'); ?>
	</div>
</article>




<div class="modal-body">
	<?php echo $this->element('NetCommons.setting_tabs', $settingTabs); ?>

	<div class="tab-content">
		<div class="text-right">
			<a class="btn btn-success" href="<?php echo $this->Html->url('/iframes/iframe_blocks/add/' . $frameId);?>">
				<span class="glyphicon glyphicon-plus"> </span>
			</a>
		</div>

		<div id="nc-iframe-setting-<?php echo $frameId; ?>">
			<?php echo $this->Form->create('', array(
					'url' => '/frames/frames/edit/' . $frameId
				)); ?>

				<?php echo $this->Form->hidden('Frame.id', array(
						'value' => $frameId,
					)); ?>

				<table class="table table-hover">
					<thead>
						<tr>
							<th></th>
							<th>
								<?php echo $this->Paginator->sort('Iframe.url', __d('iframes', 'URL')); ?>
							</th>
							<th>
								<?php echo $this->Paginator->sort('Iframe.modified', __d('net_commons', 'Updated date')); ?>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($iframes as $iframe) : ?>
							<tr<?php echo ($blockId === $iframe['block']['id'] ? ' class="active"' : ''); ?>>
								<td>
									<?php echo $this->Form->input('Frame.block_id',
										array(
											'type' => 'radio',
											'name' => 'data[Frame][block_id]',
											'options' => array((int)$iframe['block']['id'] => ''),
											'div' => false,
											'legend' => false,
											'label' => false,
											'hiddenField' => false,
											'checked' => (int)$iframe['block']['id'] === (int)$blockId,
											'onclick' => 'submit()'
										)); ?>
								</td>
								<td>
									<a href="<?php echo $this->Html->url('/iframes/iframe_blocks/edit/' . $frameId . '/' . (int)$iframe['block']['id']); ?>">
										<?php echo h($iframe['iframe']['url']); ?>
									</a>
								</td>
								<td>
									<?php echo $this->Date->dateFormat($iframe['iframe']['modified']); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php echo $this->Form->end(); ?>

			<div class="text-center">
				<?php echo $this->element('NetCommons.paginator', array(
						'url' => Hash::merge(
							array('controller' => 'iframe_blocks', 'action' => 'index', $frameId),
							$this->Paginator->params['named']
						)
					)); ?>
			</div>
		</div>
	</div>
</div>




