<div class="workCategories view">
<h2><?php  __('Work Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $workCategory['WorkCategory']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $workCategory['WorkCategory']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $workCategory['WorkCategory']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $workCategory['WorkCategory']['rght']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Level'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $workCategory['WorkCategory']['level']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $workCategory['WorkCategory']['slug']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Work Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($workCategory['ParentWorkCategory']['title'], array('controller' => 'work_categories', 'action' => 'view', $workCategory['ParentWorkCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Work Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $workCategory['WorkCategory']['work_count']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Work Category', true), array('action' => 'edit', $workCategory['WorkCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Work Category', true), array('action' => 'delete', $workCategory['WorkCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $workCategory['WorkCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Work Categories', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work Category', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Work Categories', true), array('controller' => 'work_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Work Category', true), array('controller' => 'work_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Work Categories');?></h3>
	<?php if (!empty($workCategory['ChildWorkCategory'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Lft'); ?></th>
		<th><?php __('Rght'); ?></th>
		<th><?php __('Level'); ?></th>
		<th><?php __('Slug'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Work Count'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($workCategory['ChildWorkCategory'] as $childWorkCategory):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childWorkCategory['id'];?></td>
			<td><?php echo $childWorkCategory['title'];?></td>
			<td><?php echo $childWorkCategory['lft'];?></td>
			<td><?php echo $childWorkCategory['rght'];?></td>
			<td><?php echo $childWorkCategory['level'];?></td>
			<td><?php echo $childWorkCategory['slug'];?></td>
			<td><?php echo $childWorkCategory['parent_id'];?></td>
			<td><?php echo $childWorkCategory['work_count'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'work_categories', 'action' => 'view', $childWorkCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'work_categories', 'action' => 'edit', $childWorkCategory['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'work_categories', 'action' => 'delete', $childWorkCategory['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $childWorkCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Work Category', true), array('controller' => 'work_categories', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
