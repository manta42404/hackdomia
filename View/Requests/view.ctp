<div class="requests view">
<h2><?php echo __('Request'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($request['Request']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($request['Request']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo h($request['Request']['level']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Editor'); ?></dt>
		<dd>
			<?php echo h($request['Request']['editor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($request['Request']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($request['Request']['user_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Request'), array('action' => 'edit', $request['Request']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Request'), array('action' => 'delete', $request['Request']['id']), array(), __('Are you sure you want to delete # %s?', $request['Request']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Requests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request'), array('action' => 'add')); ?> </li>
	</ul>
</div>
