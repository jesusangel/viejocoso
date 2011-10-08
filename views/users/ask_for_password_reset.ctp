<?php
	$html->addCrumb(__('Home', true), '/');
	$html->addCrumb(__('Login', true), '/login');
	$html->addCrumb(__('Password reset', true), '/users/askForPasswordReset');
?>
<div class="users form">
<?php echo $form->create('User', array('action' => 'askForPasswordReset')); ?>
	<fieldset>
 		<legend><?php __('Password reset');?></legend>
 		<p><?php __('Enter your username or email')?></p>
	<?php
	    echo $form->input('username');
	    echo $form->input('email');
	?>
	</fieldset>
<?php e($form->end(__('Submit', true))); ?>
</div>