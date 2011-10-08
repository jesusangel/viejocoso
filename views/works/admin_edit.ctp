<div class="works form">
<?php echo $this->Form->create('Work');?>
	<fieldset>
 		<legend><?php __('Admin Edit Work'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('slug');
		echo $this->Form->input('date');
		echo $this->Form->input('work_category_id');
		echo $this->Form->input('photo_count');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Work.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Work.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Works', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Work Categories', true), array('controller' => 'work_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work Category', true), array('controller' => 'work_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos', true), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo', true), array('controller' => 'photos', 'action' => 'add')); ?> </li>
	</ul>
</div>