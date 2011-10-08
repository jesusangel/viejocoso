Hola <?php e($name); ?>

Este es un email para cambiar la clave de su cuenta en Viejocoso Arquitectos. Si usted no solicitó el cambio. haga caso omiso de este mensaje y elimineló. Su contraseña permanecerá inalterada.

Para cambiar su contraseña, copie el siguiente enlace y péguelo en la barra de direcciones de su navegador web:

http://<?php e($serverName); ?><?php e($html->url(array('controller' => 'users', 'action' => 'resetPassword', 'username' => $username, 'ttl' => $ttl, 'otp' => $otp))); ?>