<?php
$html->addCrumb(__('Home', true), '/');
$html->addCrumb(__('Login', true), '/login');
?>
<div class="users form">
<?php echo $form->create('User', array('action' => 'login')); ?>
	<fieldset>
 		<legend><?php __('Login');?></legend>
 		<p><?php echo $html->link(__('Login using DNIE', true), array('controller' => 'pages', 'action' => 'display', 'tractislogin')); ?></p>
	<?php
	    echo $form->input('username');
	    echo $form->input('password', array('type' => 'password', 'div' => array('class' => 'required')));
	    echo $form->input('remember_me', array('type' => 'checkbox'));
	    echo $html->link(__('Did you forget your password?', true), array('controller' => 'users', 'action' => 'askForPasswordReset'));
	?>
	</fieldset>
<?php e($form->end(__('Login', true))); ?>
</div>