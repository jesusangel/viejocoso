<div class="users form">
<?php echo $form->create('User', array('legend' => __('Reset your password', true), 'url' => array('controller' => 'users', 'action' => 'resetPassword', $username, $ttl, $otp)));?>
	<fieldset>
 		<legend><?php __('Reset password');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('new_password', array('type' => 'password', 'div' => array('class' => 'required')));
		echo $form->input('confirm_password', array('type' => 'password', 'div' => array('class' => 'required')));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>