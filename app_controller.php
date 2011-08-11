<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	/**
	 * components property
	 *
	 * @var array
	 * @access public
	 */
	public $components = array(
	//'Acl',
                'Auth',
                'RememberMe',
                'Cookie',
				'DebugKit.Toolbar',
                'RequestHandler',
                'Security'
                
                );

                public function beforeFilter() {
                	if (!$this->Auth->user('id'))
                	{
                		$this->RememberMe->check();
                	}

                	$admin = Configure::read('Routing.admin');
                	if (isset($this->params[$admin]) && $this->params[$admin] && (!$this->Auth->user('id') || $this->Auth->user('username') != 'admin')) {
                		$this->Session->setFlash(__('The page you tried to access is restricted. You have been redirected to the page below.', true), 'flash_bad');
                		$this->redirect('/');
                	}

                	//User::store($this->Auth->user());
                	$this->set('userId', $this->Auth->user('id'));
                	$this->set('first_name', $this->Auth->user('first_name'));

                }
}
