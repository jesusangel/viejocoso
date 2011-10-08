Hola <?php e($name); ?>

Gracias por registrarte en Catálogo PFC. Para completar el registro, por favor copia el siguiente enlace y pégalo en la barra de direcciones de tu navegador web:

http://<?php e($serverName); ?><?php e($html->url(array('controller' => 'users', 'action' => 'confirm', 'id' => $id, 'code' => $code))); ?>