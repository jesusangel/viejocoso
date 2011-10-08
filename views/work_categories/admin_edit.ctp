<div class="workCategories form">
<?php echo $this->Form->create('WorkCategory');?>
	<fieldset>
 		<legend><?php __('Admin Edit Work Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
		echo $this->Form->input('level');
		echo $this->Form->input('slug');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('work_count');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('WorkCategory.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('WorkCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Work Categories', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Work Categories', true), array('controller' => 'work_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Work Category', true), array('controller' => 'work_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>