<div class="works index">
	<h2><?php __('Works');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('work_category_id');?></th>
			<th><?php echo $this->Paginator->sort('photo_count');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($works as $work):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $work['Work']['id']; ?>&nbsp;</td>
		<td><?php echo $work['Work']['title']; ?>&nbsp;</td>
		<td><?php echo $work['Work']['slug']; ?>&nbsp;</td>
		<td><?php echo $work['Work']['date']; ?>&nbsp;</td>
		<td><?php echo $work['Work']['created']; ?>&nbsp;</td>
		<td><?php echo $work['Work']['modified']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($work['WorkCategory']['title'], array('controller' => 'work_categories', 'action' => 'view', $work['WorkCategory']['id'])); ?>
		</td>
		<td><?php echo $work['Work']['photo_count']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $work['Work']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $work['Work']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $work['Work']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $work['Work']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Work', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Work Categories', true), array('controller' => 'work_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Work Category', true), array('controller' => 'work_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos', true), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo', true), array('controller' => 'photos', 'action' => 'add')); ?> </li>
	</ul>
</div>