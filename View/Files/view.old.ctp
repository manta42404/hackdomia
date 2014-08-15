/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->File->exists($id)) {
			throw new NotFoundException(__('Invalid files copy'));
		}
		$options = array('conditions' => array('File.' . $this->File->primaryKey => $id));
		$this->set('file', $this->File->find('first', $options));
	}

<div class="files view">
<h2><?php echo __('File'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($file['File']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($file['File']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($file['File']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Level'); ?></dt>
		<dd>
			<?php echo h($file['File']['level']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Editor'); ?></dt>
		<dd>
			<?php echo h($file['File']['editor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($file['File']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit File'), array('action' => 'edit', $file['File']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete File'), array('action' => 'delete', $file['File']['id']), array(), __('Are you sure you want to delete # %s?', $file['File']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Files'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New File'), array('action' => 'add')); ?> </li>
	</ul>
</div>
