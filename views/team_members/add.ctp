<div class="teamMembers form">
<?php echo $this->Form->create('TeamMember');?>
	<fieldset>
 		<legend><?php __('Add Team Member'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Team Members', true), array('action' => 'index'));?></li>
	</ul>
</div>