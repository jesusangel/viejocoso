<?php 
	$html->addCrumb(__('Home', true), '/');
	$html->addCrumb(__('My account', true), array('controller' => 'users', 'action' => 'view', $this->data['User']['id']));
	$html->addCrumb(__('Change password', true), array('controller' => 'users', 'action' => 'changePassword', $this->data['User']['id']));
?>
<div class="users form">
<?php echo $form->create('User', array('legend' => __('Change your password', true), 'url' => array('controller' => 'users', 'action' => 'changePassword')));?>
	<fieldset>
 		<legend><?php __('Change password');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('username', array('type' => 'hidden'));
		echo $form->input('password', array('value' => '', 'div' => array('class' => 'required')));
		echo $form->input('new_password', array('type' => 'password'));
		echo $form->input('confirm_password', array('type' => 'password'));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>