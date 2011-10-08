<div class="photos form">
<?php echo $this->Form->create('Photo');?>
	<fieldset>
 		<legend><?php __('Edit Photo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('text');
		echo $this->Form->input('file_path');
		echo $this->Form->input('work_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Photo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Photo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Photos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Works', true), array('controller' => 'works', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work', true), array('controller' => 'works', 'action' => 'add')); ?> </li>
	</ul>
</div>