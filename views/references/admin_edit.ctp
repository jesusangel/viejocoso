<div class="references form">
<?php echo $this->Form->create('Reference');?>
	<fieldset>
 		<legend><?php __('Admin Edit Reference'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('text');
		echo $this->Form->input('url');
		echo $this->datePicker->picker('date', null, $this->Form);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Reference.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Reference.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List References', true), array('action' => 'index'));?></li>
	</ul>
</div>