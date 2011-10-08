<div class="teamMembers view">
<h2><?php  __('Team Member');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamMember['TeamMember']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamMember['TeamMember']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamMember['TeamMember']['text']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamMember['TeamMember']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamMember['TeamMember']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Team Member', true), array('action' => 'edit', $teamMember['TeamMember']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Team Member', true), array('action' => 'delete', $teamMember['TeamMember']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teamMember['TeamMember']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Team Members', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team Member', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
