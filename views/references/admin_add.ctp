<div class="references form">
<?php echo $this->Form->create('Reference');?>
	<fieldset>
 		<legend><?php __('Nueva referencia'); ?></legend>
	<?php
		echo $this->Form->input('title', array('label' => __('Título', true)));
		echo $this->Form->input('text', array('label' => __('Descripción', true)));
		echo $this->Form->input('url', array('label' => 'URL'));
		echo $this->Form->input('date', array('label' => __('Fecha', true), 'maxYear' => date('Y')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Lista de referencias', true), array('action' => 'index'));?></li>
	</ul>
</div>