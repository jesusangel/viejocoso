<div class="photos form">
<?php echo $this->Form->create('Photo');?>
	<fieldset>
 		<legend><?php __('Admin Add Photo'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Photos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Works', true), array('controller' => 'works', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work', true), array('controller' => 'works', 'action' => 'add')); ?> </li>
	</ul>
</div>