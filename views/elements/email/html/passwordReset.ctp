<p>Hola <?php e($name); ?></p>

<p>Este es un email para cambiar la clave de su cuenta en Viejocoso Arquitectos. Si usted no solicitó el cambio. haga caso omiso de este mensaje y elimineló. Su contraseña permanecerá inalterada.</p>

<p>Para cambiar su contraseña, por favor pulse en el siguiente enlace:</p>

<p>
	<?php
		$url =  $html->url(
			array(
				'controller' => 'users',
				'action' => 'resetPassword',
				'username' => $username, 
				'ttl' => $ttl, 
				'otp' => $otp
			)
		);
		
		e($html->link(
			'Cambiar mi clave',
			'http://'.$serverName.$url
		));
	?>
</p>

<p>Si el enlace anterior no funciona, copie y pegue la siguiente URL en su navegador:<br/>http://<?php e($serverName); ?><?php  e($url); ?></p>