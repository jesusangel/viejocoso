<?php
class User extends AppModel {
	var $name = 'User';
	var $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('minlength', 1),
				'message' => 'User name cannot be empty',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('checkUnique', 'username'),
				'message' => 'User name taken. Use another'
			)
		),
		'nif' => array(
			'unique' => array(
				'rule' => array('checkUnique', 'nif'),
				'allowEmpty' => true
			)
		),
		'new_password' => array(
			'equalTo' => array(
				'rule' => array('equalTo', 'confirm_password'),
				'message' => 'Please re-enter your password twice so that the values match'
			),
			'between' => array(
				'rule' => array('between', 4, 20),
					'required' => false,
					'allowEmpty' => false,
					'message' => 'You password must be between 4 and 20 characters long'
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'rule' => array('minlength', 1),
				'required' => true,
				'allowEmpty' => false,
			),
		'email' => array(
			'notempty' => array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Please, enter a valid email'
			),
			'unique' => array(
				'rule' => array('checkUnique', 'email'),
				'message' => 'Email already registered. Did you forget your password?',
			)
		),
	);
	
	function beforeSave() {
		// FIXME: encapsulate transaction handling and save data in one method
		if ($this->_begin()) {
	    	$this->_setNewPassword();
			return true;
		} else {
			$this->_rollback();
			return false;
		}
	}
	
	/**
	 * sets the password to be equal to the verified value from the temporary password field
	 *
	 * Under AuthComponent, any time a form is submitted with a field name that matches the 
	 * expected password field, it is hashed before any other operation can be done.  This 
	 * prevents the equalTo() rule check from working, so we take the password in a form input
	 * named something else.  Then after verification, but before saving the record, we pass
	 * the hashed value to the correct password field.
	 *
	 * @return boolean TRUE
	 */
	private function _setNewPassword() {
	    if(!empty($this->data['User']['new_password_hash'])) {
		    $this->data['User']['password'] = $this->data['User']['new_password_hash'];
		}
		return true;
	}
		
	/**
	 * Overrides core equalTo() to verify that two form fields are equal
	 *
	 * @param array $field contains the name of the primary field and the value of that field
	 * @param string $compare_field contains the name of the field to compare the primary field to
	 * @access public
	 * @return boolean FALSE if the fields do not match TRUE if they do
	 */
	function equalTo( $field = array(), $compare_field = null ) {
		foreach( $field as $key => $value ){
			$v1 = $value;
			$v2 = $this->data[$this->name][$compare_field];
			if($v1 !== $v2) {
			    return false;
		    }
		}
		return true;
	}
	
	/*
	 * Static methods that can be used to retrieve the logged in user
	 * from anywhere
	 *
	 * Copyright (c) 2008 Matt Curry
	 * www.PseudoCoder.com
	 * http://github.com/mcurry/cakephp/tree/master/snippets/static_user
	 * http://www.pseudocoder.com/archives/2008/10/06/accessing-user-sessions-from-models-or-anywhere-in-cakephp-revealed/
	 *
	 * @author      Matt Curry <matt@pseudocoder.com>
	 * @license     MIT
	 *
	 */

	//in AppController::beforeFilter:
	//App::import('Model', 'User');
	//User::store($this->Auth->user());

	function &getInstance($user=null) {
		static $instance = array();
		$null = null;

		if ($user) {
			$instance[0] =& $user;
		}

		if (!$instance) {
			//trigger_error(__("User not set.", true), E_USER_WARNING);
			return $null;
		}

		return $instance[0];
	}

	function store($user) {
		$null = null;
		if (empty($user)) {
			return $null;
		}

		User::getInstance($user);
	}

	function get($path) {
		$null = null;
		$_user =& User::getInstance();

		$path = str_replace('.', '/', $path);
		if (strpos($path, 'User') !== 0) {
			$path = sprintf('User/%s', $path);
		}

		if (strpos($path, '/') !== 0) {
			$path = sprintf('/%s', $path);
		}

		$value = Set::extract($path, $_user);

		if (!$value) {
			return $null;
		}

		return $value[0];
	}

	/*
	 * A simpler solution:
	 * 
	 * Declare static var $auth in User model
	 * class User extends AppModel {
	 * 		var $name = 'User';
	 * 		static $auth;
	 * 		../..
	 * }
	 * 
	 * In AppController, store auth data in User::$auth var:
	 * App::import('Model', 'User');
	 * Class AppController extends Controller {
	 * 		../..
	 * 		function beforeFilter() {
	 *			../..
	 *			$auth = $this->Auth->user();
	 *			$this->set(compact(’user’));
	 *			User::$auth = $auth;
	 *			../.. 			
	 * 		} 
	 */	
}
?>