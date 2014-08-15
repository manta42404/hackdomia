<div class="files index">
	<h2><?php echo __('Files'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('subject'); ?></th>
			<th><?php echo $this->Paginator->sort('grade'); ?></th>
			<th><?php echo $this->Paginator->sort('editor'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($files as $file): ?>
	<tr>
		<td><?php echo h($file['File']['id']); ?>&nbsp;</td>
		<td><?php echo h($file['File']['title']); ?>&nbsp;</td>
		<td><?php echo h($file['File']['subject']); ?>&nbsp;</td>
		<td><?php echo h($file['File']['grade']); ?>&nbsp;</td>
		<td><?php echo h($file['File']['editor']); ?>&nbsp;</td>
		<td><?php echo h($file['File']['description']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $file['File']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $file['File']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $file['File']['id']), array(), __('Are you sure you want to delete # %s?', $file['File']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New File'), array('action' => 'add')); ?></li>
	</ul>
</div>
