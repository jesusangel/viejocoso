<div class="references index">
	<h2><?php __('References');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('text');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('date');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($references as $reference):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $reference['Reference']['id']; ?>&nbsp;</td>
		<td><?php echo $reference['Reference']['title']; ?>&nbsp;</td>
		<td><?php echo $reference['Reference']['text']; ?>&nbsp;</td>
		<td><?php echo $reference['Reference']['url']; ?>&nbsp;</td>
		<td><?php echo $reference['Reference']['date']; ?>&nbsp;</td>
		<td><?php echo $reference['Reference']['created']; ?>&nbsp;</td>
		<td><?php echo $reference['Reference']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $reference['Reference']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $reference['Reference']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $reference['Reference']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $reference['Reference']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Reference', true), array('action' => 'add')); ?></li>
	</ul>
</div>