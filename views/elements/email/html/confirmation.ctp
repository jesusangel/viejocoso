<p>Hola <?php e($name); ?></p>

<p>Gracias por registrarte en Catálogo PFC. Para completar el registro, por favor pulsa en el siguiente enlace:</p>

<p><?php e($html->link('Confirma tu cuenta', 'http://'.$serverName.$html->url(array('controller' => 'users', 'action' => 'confirm', 'id' => $id, 'code' => $code))));?></p>

<p>Si el enlace anterior no funciona, copia y pega la siguiente URL en tu navegador:<br/>http://<?php e($serverName); ?><?php e($html->url(array('controller' => 'users', 'action' => 'confirm', 'id' => $id, 'code' => $code))); ?></p>