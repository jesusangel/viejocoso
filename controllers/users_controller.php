<?php
/* CVS FILE: $Id: users_controller.php,v 1.14 2010-08-28 12:30:31 jpozdom Exp $ */
/**
 * Users controller.
 * 
 * Users management methods.
 *
 * PHP versions 4 and 5
 *
 * @filesource
 * @author			jpozdom
 * @copyright		Copyright 2009-2010 Jesús Ángel del Pozo
 * @package			catalogoPFC
 * @subpackage		catalogoPFC.app.controller
 * @since			catalogoPFC v 1.1
 * @version			$Revision: 1.14 $
 * @modifiedby		$LastChangedBy: jpozdom $
 * @lastmodified	$Date: 2010-08-28 12:30:31 $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array(
		'RecaptchaPlugin.Recaptcha'
	);
	var $components = array(
		'SwiftMailer',
		'RecaptchaPlugin.Recaptcha',
		'Otp'
	);
	
	/**
	 * User Model
	 *
	 * @var User
	 */
	 var $User;
	
	function beforeFilter() {
		parent::beforeFilter();
		// TODO: Comprobar si esto es necesario. No debería serlo tras
		// cambiar la autorización al modelo "authorize"
		//$this->Auth->allowedActions = array('login', 'tractisok', 'signup', 'confirm', 'logout', 'askForPasswordReset', 'resetPassword');
		$this->Security->requireAuth('login');
		//$this->Security->requirePost('login');
	}
	
	function login() {
		if (!$this->Auth->user()) {
			return;
		}
		
		if (empty($this->data))	{
			$this->redirect($this->Auth->loginRedirect);
		}
		
		if (empty($this->data['User']['remember_me'])) {
			$this->RememberMe->delete();
		} else {
			$this->RememberMe->remember(  
				$this->data['User']['username'],  
				$this->data['User']['password']  
			);
		}
		
		$this->log('User ' . $this->Auth->user('username') . ' (id=' . $this->Auth->user('id') . ') logged in', LOG_DEBUG);
		
		unset($this->data['User']['remember_me']);
		$this->redirect($this->Auth->loginRedirect);
	}
	
	/**
	 * Validates data received from Tractis after DNIE validation
	 * 
	 * Params are received in the query string
	 * 
	 */
	function tractisok() {
		// Tenemos que pasarle a /data_verifications todos los parámetros que nos ha enviado Tractis
		// junto con nuestra API Key
		$data = $this->params['url'];
		$data['api_key'] = Configure::read('Tractis.apikey');
		
		$s = curl_init();
		
		curl_setopt($s,CURLOPT_URL, Configure::read('Tractis.data_verification_url'));
		curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($s,CURLOPT_POST,true);
		curl_setopt($s,CURLOPT_POSTFIELDS,$data);
		
		curl_exec($s);
		$status = curl_getinfo($s,CURLINFO_HTTP_CODE);
		
		if ($status == 200) {
			$user_record = $this->User->find('first', array(
                    	'conditions' => array('dni' => $data['tractis:attribute:dni']),
                    	'fields' => array('User.dni', 'User.username', 'User.password'),
                    	'contain' => array()
					)
			);
			
			if (!empty($user_record)) {
				$this->Auth->fields = array('username' => 'dni', 'password' => 'password');
				$this->Auth->login($user_record);
				$this->log('User ' . $this->Auth->user('username') . ' (id=' . $this->Auth->user('id') . ') logged in via Tractis API', LOG_DEBUG);
				$this->redirect($this->Auth->redirect());
			} else {
				$this->log('Received  DNI (' . $data['tractis:attribute:dni'] . ' )id=' . $this->Auth->user('id') . ') logged in via Tractis API', LOG_DEBUG);
				$this->Session->setFlash(__('User unknown', true), 'flash_bad');
				$this->redirect(array('controller' => 'pages', 'action' => 'display', 'tractislogin'));
			}
		} else {
			$this->Session->setFlash(__('Authentication failure', true), 'flash_bad');
			$this->redirect(array('controller' => 'pages', 'action' => 'display', 'tractislogin'));
		}
		$this->render(false);
	}
	
	function logout() {
		$this->RememberMe->delete();
		$this->Session->setFlash(__('You have been logged out', true), 'flash_good');
		$this->log('User ' . $this->Auth->user('username') . ' (id=' . $this->Auth->user('id') . ') logged out', LOG_DEBUG);
		$this->redirect($this->Auth->logout());
	}
	
	// TODO: no es necesario en esta aplicación
	function signup() {
		if (!empty($this->data)) {
			if ( !$this->Captcha->validate() ) {
				$this->Session->setFlash(__('Wrong captcha code. Please, try again.', true), 'flash_bad');
				$this->Redirect(array('action' => 'signup'));
			}
			
			$this->_hashPassword();
			// FIXME: think a better way for assign a default role to new users
			$this->data['User']['role_id'] = 1;	// FIXME: set up default role in a config file
			$this->data['User']['active'] = 1;
			$this->data['User']['confirm_code'] = String::uuid();
			$this->User->create();
			if ( $this->User->save($this->data)) {
				$this->data['User']['id'] = $this->User->getLastInsertID();
				// Send email with code to reset password
				$to = $this->data['User']['email'];
				$subject = __('Catálogo PFC new account', true);	// TODO: get app name from config var
				$template = 'confirmation';
				$viewVars = array(
					'username' => $this->data['User']['username'],
					'name' => $this->data['User']['first_name'],
					'serverName' => $_SERVER['SERVER_NAME'],
					'id' => $this->data['User']['id'],
					'code' => $this->data['User']['confirm_code']
				);
				if ($this->_mail($to, $subject, $template, $viewVars)) {
					$this->Session->setFlash(__('Congratulations! You have signed up!. Confirmation mail sent. Please, check your inbox', true), 'flash_good');
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
				} else {
					$this->User->del($this->data['User']['id']);
					$this->Session->setFlash(__('There were a problem sending the confirmation mail. Please, try again.', true), 'flash_bad');
				}				
			} else {
				$this->Session->setFlash(__('There was an error signing up. Please, try again.', true), 'flash_bad');
				$this->data = null;
			}
		}
	}
	
	// No es necesario en esta aplicación
	function confirm($user_id = null, $code = null)	{
		$confirmed = false;
		
		if ($user = $this->User->read(null, $user_id)) {		
			if ( !empty($code) && $user['User']['confirm_code'] == $code ) {
				$this->User->id = $user_id;
				$this->User->saveField('confirmed', 1);
				$this->User->saveField('confirm_code', '');
				$confirmed = true;
			}
		}
		
		$this->set(compact('confirmed'));
	}
	
	public function askForPasswordReset() {
		if (!empty($this->data)) {
			$this->User->contain();
			if (!empty($this->data['User']['username'])) {
				$user = $this->User->findByUsername(trim($this->data['User']['username']));
			} else if (!empty($this->data['User']['email'])) {
				$user = $this->User->findByEmail(trim($this->data['User']['email']));
			}
			
			if (!empty($user)) {
				$ttl = microtime(true) + Configure::read('OTP.TTL') * 3600;
				$otp = $this->Otp->createOTP(
					array(
						'user' => $user['User']['username'],
						'password' => $user['User']['password'],
						'ttl'=> $ttl
					)	
				); 
				// Send email with code to reset password
				$to = $user['User']['email'];
				$subject = __('Viejocoso password reset', true);
				$template = 'passwordReset';
				$viewVars = array(
					'name' => $user['User']['first_name'],
					'serverName' => $_SERVER['SERVER_NAME'],
					'username' => $user['User']['username'],
					'ttl' => $ttl,
					'otp' => $otp
				);
				if ($this->_mail($to, $subject, $template, $viewVars)) {
					$this->Session->setFlash(__('Password reset mail sent. Please, check your inbox.', true), 'flash_good');
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
				} else {
					$this->Session->setFlash(__('There were a problem sending the confirmation mail. Please, try again.', true), 'flash_bad');
				}
			} else {
				$this->Session->setFlash(__('User or email not registered.', true), 'flash_bad');
			}
		}
	}
	
	public function _sendNewAccountEmail($data) {
		// TODO: send email to admins notifing new account creation
	}
	
	public function index() {
		$this->flash("This page is not available for this content.", "/");
	}

	public function view($id = null) {
		if (!$this->_checkUsersOwnRecord($id)) {
			$this->Session->setFlash(__('Invalid User', true), 'flash_bad');
			$this->SwissArmy->back();
		}
		
		$this->User->contain();
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		$this->flash("This page is not available for this content.", "/");
	}

	function edit($id = null) {
		if (!$this->_checkUsersOwnRecord($id)) {
			$this->Session->setFlash(__('Invalid User', true), 'flash_bad');
			$this->SwissArmy->back();
		}
		
		if (!empty($this->data)) {
			$this->User->id = $id;
			if ($this->User->getPassword() == $this->data['User']['password']) {
				//TODO: should I allow user to change his email?
				if ($this->User->save($this->data, true, array('first_name', 'email', 'dni'))) {
					$this->Session->write('Auth.User.name', $this->data['User']['first_name']);
					$this->Session->setFlash(__('The data has been saved', true), 'flash_good');
					$this->SwissArmy->back();
				} else {
					$this->Session->setFlash(__('The data could not be saved. Please, try again.', true), 'flash_bad');
				}
			} else {
				$this->Session->setFlash(__('Wrong password.', true), 'flash_bad');
			}
		} else {
			$this->User->contain();
			$this->data = $this->User->read(null, $id);
		}
	}
	
	function changePassword($id = null) {
		if (!$this->_checkUsersOwnRecord($id)) {
			$this->Session->setFlash(__('Invalid User', true), 'flash_bad');
			$this->redirect(array('controller' => 'users', 'action' => 'view', User::get('id')));
		}
		
		if (!empty($this->data)) {
			$this->User->id = $this->data['User']['id'] = $id;
			if ($this->User->getPassword() == $this->data['User']['password']) {
				$this->_hashPassword();			
				if ($this->User->save($this->data, true, array('password', 'new_password', 'confirm_password'))) {
					$this->Session->setFlash(__('Password changed', true), 'flash_good');
					$this->SwissArmy->back();
				} else {
					$this->Session->setFlash(__('The data could not be saved. Please, try again.', true), 'flash_bad');
				}
			} else {
				$this->Session->setFlash(__('Wrong password.', true), 'flash_bad');
			}
		} else {
			$this->User->contain();
			$this->data = $this->User->read(null, $id);
		}
	}
	
	public function resetPassword($username = null, $ttl = null, $otp = null) {
		$user = $this->User->FindByUsername($username, array('id', 'password'));
		if ($user) {
			$passwordHash = $user["User"]["password"];

            $now = microtime(true);
            // check expiration date. the experition date should be greater them now.
            if ( $now <  $ttl ) {
				// validate OTP
				if ( $this->Otp->authenticateOTP($otp, array('user' => $username, 'password' => $passwordHash, 'ttl'=> $ttl)) ) { 
					if (!empty($this->data)) {
						$this->_hashPassword();
						if ($this->User->save($this->data, true, array('password', 'new_password', 'confirm_password'))) {
							$this->Session->setFlash(__('Password changed', true), 'flash_good');
							$this->Redirect(array('controller' => 'users', 'action' => 'login'));
						} else {
							$this->Session->setFlash(__('The data could not be saved. Please, try again.', true), 'flash_bad');
						}
					} else {
						$this->data = $user;						
					}
				} else {
					$this->Session->setFlash(__('Code not valid. Ask for another password reset.', true), 'flash_bad');
				}			
			} else {		
				$this->Session->setFlash(__('Code has expired. Ask for another password reset.', true), 'flash_bad');
			}               	
		} else {
			$this->Session->setFlash(__('Invalid data.', true), 'flash_bad');
			$this->redirect(array('controller' => 'users', 'action' => 'askForPasswordReset'));
		}
		
		$this->set(compact('username', 'ttl', 'otp'));
	}

	function delete($id = null) {
		$this->flash("This page is not available for this content.", "/");
	}
	
	/**
     * Checks if logged in user has same id as one being edited
     *
     * @params string $recordId the id of the record being accessed
     * @returns boolean True if logged in User id is same as id being edited, otherwise false
     */
	function _checkUsersOwnRecord($recordId = null) {
		if ($recordId && $this->Auth->user('id') == $recordId) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
     * Get a hashed value of submitted password which we will enter into database.
     * This value will use the same hash technique used by the AuthComponent during a
     * user login submission. 
     *
     */
	private function _hashPassword()
	{
	    if (!empty($this->data['User']['new_password'])) {
		    $this->data['User']['new_password_hash'] = $this->Auth->password($this->data['User']['new_password']);
		}
	}

}
?>