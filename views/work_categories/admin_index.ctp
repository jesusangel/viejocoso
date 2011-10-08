<div class="workCategories index">
	<h2><?php __('Work Categories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('lft');?></th>
			<th><?php echo $this->Paginator->sort('rght');?></th>
			<th><?php echo $this->Paginator->sort('level');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('parent_id');?></th>
			<th><?php echo $this->Paginator->sort('work_count');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($workCategories as $workCategory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $workCategory['WorkCategory']['id']; ?>&nbsp;</td>
		<td><?php echo $workCategory['WorkCategory']['title']; ?>&nbsp;</td>
		<td><?php echo $workCategory['WorkCategory']['lft']; ?>&nbsp;</td>
		<td><?php echo $workCategory['WorkCategory']['rght']; ?>&nbsp;</td>
		<td><?php echo $workCategory['WorkCategory']['level']; ?>&nbsp;</td>
		<td><?php echo $workCategory['WorkCategory']['slug']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($workCategory['ParentWorkCategory']['title'], array('controller' => 'work_categories', 'action' => 'view', $workCategory['ParentWorkCategory']['id'])); ?>
		</td>
		<td><?php echo $workCategory['WorkCategory']['work_count']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $workCategory['WorkCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $workCategory['WorkCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $workCategory['WorkCategory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $workCategory['WorkCategory']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Work Category', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Work Categories', true), array('controller' => 'work_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Work Category', true), array('controller' => 'work_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>