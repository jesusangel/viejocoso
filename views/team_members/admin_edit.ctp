<div class="teamMembers form">
<?php echo $this->Form->create('TeamMember');?>
	<fieldset>
 		<legend><?php __('Admin Edit Team Member'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TeamMember.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TeamMember.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Team Members', true), array('action' => 'index'));?></li>
	</ul>
</div>