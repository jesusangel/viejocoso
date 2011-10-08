<?php
/**
 * Remember me component for remember user autentication between sessions
 *
 * PHP versions 4 and 5
 *
 * Based on code from http://dsi.vozibrale.com/articles/view/rememberme-component-the-final-word
 *
 * @filesource
 * @author		jpozdom
 * @copyright		Copyright 2009-2010 Jesús Ángel del Pozo
 * @package		viejocoso
 * @subpackage		viejocoso.app.controller.components
 * @since		viejocoso v 0
 * @version		$Revision: 1.3.1 $
 * @modifiedby		$LastChangedBy: jpozdom $
 * @lastmodified	$Date: 2011-08-12 00:51:00 $
 * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Remember me factory class.
 *
 * Looks for ACL implementation class in core config, and returns an instance of that class.
 * 
 */
class RememberMeComponent extends Object
{
	var $components = array('Auth', 'Cookie');
	var $controller = null;

	/**
	 * Cookie retention period.
	 *
	 * @var string
	 */
	var $period = '+2 weeks';
	/**
	 * Cookie name.
	 *
	 * @var string
	 */
	var $cookieName = 'User';

	function startup(&$controller)
	{
		$this->controller =& $controller;
	}

	/**
	 * Saves the User cookie with auth information.
	 *  
	 * @param $username User's login name
	 * @param $password User's password hash
	 * @return unknown_type
	 */
	function remember($username, $password)
	{
		$cookie = array();
		$cookie[$this->Auth->fields['username']] = $username;
		$cookie[$this->Auth->fields['password']] = $password;

		$this->Cookie->write(
			$this->cookieName,
			$cookie,
			true,
			$this->period
		);
	}

	/**
	 * Checks for User cookie and tries to authenticate the user
	 * @return unknown_type
	 */
	function check()
	{
		$cookie = $this->Cookie->read($this->cookieName);

		if (!is_array($cookie) || $this->Auth->user())
		{
			return;
		}

		if ($this->Auth->login($cookie))
		{
			$this->Cookie->write(
				$this->cookieName,
				$cookie,
				true,
				$this->period
			);
		}
		else
		{
			$this->delete();
		}
	}

	/**
	 * Deletes de User cookie
	 * 
	 * @return unknown_type
	 */
	function delete()
	{
		// Changed from del() to delete()
		$this->Cookie->delete($this->cookieName);
	}
}
?>
