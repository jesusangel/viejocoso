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

App::import('Model', 'User');

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
	 * helpers property
	 *
	 * @var array
	 * @access public
	 */
	var $helpers = array('Html', 'Form', 'Javascript', 'Session');

	/**
	 * components property
	 *
	 * @var array
	 * @access public
	 */
	public $components = array(
		'Auth',
		'RememberMe',
		'Cookie',
		'DebugKit.Toolbar',
		'RequestHandler',
		'Security',
		'Session',
	);

	public function isAuthorized() {
		/*
		 * Only admin users are allowed to enter admin area
		 */
		if (
			$this->_isAdminAction()
			&& (!$this->Auth->user('id') || $this->Auth->user('role') != ADMIN_ROLE)
		)
		{
			$this->Session->setFlash(__('The page you tried to access is restricted. You have been redirected to the page below.', true), 'flash_bad');
			$this->auth->deny();
			return false;
		}

		/*
		 * Allow all users non admin actions
		 */
		return true;
	}

	public function beforeFilter() {

		// Where do we go to login?
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
		// Where do we go after a successful login?
		$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'index', 'admin' => true);
		// Where do we go after a successful logout?
		$this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display', 'home', 'admin' => false);

		/*
		 * The admin wants to be redirected to the admin area, and not to the link
		 * he came from before login in.
		 */
		$this->Auth->autoRedirect = false;

		$this->Auth->authorize = 'controller';
			
		// Allow all users access to non admin actions
		if ( !$this->_isAdminAction() ) {
			$this->Auth->allow();
		}
		
		$this->Auth->userScope = array('User.active' => 1);
		 
		if (!$this->Auth->user('id'))
		{
			$this->RememberMe->check();
		}

		$this->set('userId', $this->Auth->user('id'));
		$this->set('first_name', $this->Auth->user('first_name'));

	}

	function beforeRender () {

		/*
		 * Switch layout from 'default' to 'admin' when the user enters the admin area
		 */
		if (
			$this->_isAdminAction()
			&& !$this->RequestHandler->isAjax()
		)
		{
			$this->layout = 'admin';
		}
	}
	
	protected function _isAdminAction() {
		return (isset($this->params['admin']) && $this->params['admin']);
    }

	/**
	 * Send email using email.php configuration
	 *
	 * @param string $to email's recipient
	 * @param string $subject email's subject
	 * @param string $template email's template
	 * @param array $viewVars vars for the view
	 */
	protected function _mail($to, $subject, $template, $viewVars) {
		$this->SwiftMailer->to = $to;

		//register logger plugin
		//$this->SwiftMailer->registerPlugin('LoggerPlugin', new Swift_Plugins_Loggers_ArrayLogger());

		$this->set($viewVars);

		try {
			if(!$this->SwiftMailer->send($template, $subject)) {
				foreach($this->SwiftMailer->postErrors as $failed_send_to) {
					$this->log("Failed to send email to: $failed_send_to", LOG_DEBUG);
				}
				return false;
			}
			$this->log("Email $subject sent to $to", LOG_DEBUG);
			return true;
		}
		catch(Exception $e) {
			$this->log("Failed to send email: ".$e->getMessage(), LOG_DEBUG);
			return false;
		}
	}

	/**
	 * The following functions are copyright by:
	 * Copyright (c) 2009, Andy Dawson
	 * Licensed under The MIT License
	 */
	/**
	 * redirect method
	 *
	 * If it's an ajax request, and the $force parameter is true - render a js redirect
	 *
	 * @param mixed $url
	 * @param mixed $code null
	 * @param bool $exit trues
	 * @param bool $force false
	 * @return void
	 * @access public
	 */
	public function redirect($url, $code = null, $exit = true, $force = false) {
		if (isset($this->SwissArmy)) {
			if ($this->SwissArmy->redirect($url, $code, $exit, $force) && $exit) {
				$this->_stop();
			}
		}
		return parent::redirect($url, $code, $exit);
	}

	/**
	 * back method
	 *
	 * (hopefully) Intelligent referer logic
	 * Convenience method to call the back method in the Swiss army component. Can be overriden if the true
	 * referer is not actually useful.
	 *
	 * @param int $steps
	 * @return void
	 * @access protected
	 */
	protected function _back($steps = 1, $force = false) {
		if (isset($this->SwissArmy)) {
			if (($force || in_array($this->action, $this->postActions)) && $this->RequestHandler->isAjax()) {
				$url = $this->SwissArmy->back($steps, null, false);
				return $this->redirect($url, null, true, true);
			}
			return $this->SwissArmy->back($steps);
		}
		return $this->redirect($this->referer('/', true));
	}

	/**
	 * black hole method
	 *
	 * If a GET request is made for a method that must be run via POST/DELETE
	 * present a confirmation screen which submits by POST/DELETE
	 *
	 * @param mixed $reason
	 * @return void
	 * @access protected
	 */
	public function _blackHole($reason = null) {
		if (isset($this->SwissArmy)) {
			return $this->SwissArmy->blackHole($reason);
		}
		return false;
	}

	/**
	 * log method
	 *
	 * Always log the ip
	 *
	 * @param mixed $message
	 * @param mixed $type
	 * @return void
	 * @access public
	 */
	public function log($message, $type = null) {
		if (!class_exists('RequestHandlerComponent')) {
			App::import('Component', 'RequestHandler');
		}
		if (!is_string($message)) {
			$message = print_r($message, true); //@ignore
		}
		$message = RequestHandlerComponent::getClientIP() . "\t" . $message;
		parent::log($message, $type);
	}

}
