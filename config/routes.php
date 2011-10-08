<?php
/* SVN FILE: $Id: routes.php,v 1.10 2010-08-28 12:11:08 jpozdom Exp $ */
/**
 * Controller routes.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author			jpozdom
 * @copyright		Copyright 2009-2010 Jesús Ángel del Pozo
 * @package			catalogoPFC
 * @subpackage		catalogoPFC.app.config
 * @since			catalogoPFC v 1.1
 * @version			$Revision: 1.10 $
 * @modifiedby		$LastChangedBy: jpozdom $
 * @lastmodified	$Date: 2010-08-28 12:11:08 $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * We need to let Cake know to parse .json extentions
 */
Router::parseExtensions('json', 'rss');
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.thtml)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	
/**
 * Here, we are connecting '/signup' to controller called 'Users',
 * its action called 'signup'
 */
	Router::connect('/signup', array('controller' => 'users', 'action' => 'signup'));
/**
 * Here, we are connecting '/login' to controller called 'Users',
 * its action called 'login'
 */
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
/**
 * Here, we are connecting '/logout' to controller called 'Users',
 * its action called 'users'
 */
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	
/**
 * 
 */
	Router::connect(
		'/forgotpassword',
		array(
			'controller' => 'users',
			'action' => 'askForPasswordReset'
		)
	);
	
/**
 * 
 */
	Router::connect(
		'/pwreset/:username/:ttl/:otp',
		array(
			'controller' => 'users',
			'action' => 'resetPassword'
		),
		array(
			'pass' => array('username', 'ttl', 'otp'),
			'username' => '[a-zA-Z]+',
			'ttl' => '[0-9\.]+',
			'otp' => '[a-z0-9]+'
		)
	);
/**
 * 
 */
	Router::connect(
		'/confirm/:id-:code',
		array(
			'controller' => 'users',
			'action' => 'confirm'
		),
		array(
			'pass' => array('id', 'code'),
			'id' => '[0-9]+'
		)
	);
/**
 * 
 */
	Router::connect('/search', array('controller' => 'resources', 'action' => 'search'));
/**
 * 
 */
	Router::connect('/forum', array('plugin' => 'forum', 'controller' => 'home', 'action' => 'index'));
/**
 * 
 */
	/*
	Router::connect(
		// E.g. /resource/list_by_category/1-Recursos
	    '/resources/list_by_category/:id-:slug',
    	array('controller' => 'resources', 'action' => 'list_by_category'),
    	array(
	        // order matters since this will simply map ":id" to the first param in the action
    	    'pass' => array('id', 'slug'),
	        'id' => '[0-9]+'
    	)
	);
	*/
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
/**
 * Then we connect url '/test' to our test controller. This is helpfull in
 * developement.
 */
	Router::connect('/tests', array('controller' => 'tests', 'action' => 'index'));
/**
 * Admin routing
 */
	Router::connect('/admin/pages/*', array('controller' => 'pages', 'action' => 'display', 'admin' => true));
	Router::connect('/admin', array('controller' => 'pages', 'action' => 'display', 'admin' => true, 'home'));
?>
