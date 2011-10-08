<?php
/* CVS FILE: $Id: app_model.php,v 1.6 2010-08-28 16:21:05 jpozdom Exp $ */
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @link			http://book.cakephp.org/view/154/Error-Handling
 * @author			jpozdom
 * @copyright		Copyright 2009-2010 Jesús Ángel del Pozo
 * @package			catalogoPFC
 * @subpackage		catalogoPFC.app
 * @since			catalogoPFC v 1.1
 * @version			$Revision: 1.6 $
 * @modifiedby		$LastChangedBy: jpozdom $
 * @lastmodified	$Date: 2010-08-28 16:21:05 $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */
class AppModel extends Model{
	var $actsAs = array('Containable');
	
	public function beforeSave() {
		parent::beforeSave();
		
		$this->_stripTags();
		return true;
	}
	
	/**
	 * Checks for unique fields in the DB
	 *
	 * @param array $data
	 * @param string $fieldname
	 * @return boolean FALSE in the username already exists in the DB TRUE otherwise
	 */
	function checkUnique($data, $fieldName)	{
		$valid = false;
		if ( isset($fieldName) && $this->hasField($fieldName)) {
			$valid = $this->isUnique(array($fieldName => $data));
		}
		return $valid;
	}

	/**
	 * Removes HTML tags from data
	 * 
	 * Modifies $this->data array
	 * 
	 * @author jpozdom
	 */
	private function _stripTags() {
		if (count($this->data[$this->name]) > 0) {
			foreach ($this->data[$this->name] as $field => $value) {
				if (isset($this->_schema[$field])) {
					switch ($this->_schema[$field]['type']) {
						case 'string':
							$this->data[$this->name][$field] = trim(strip_tags($value));
						break;
						case 'text':
							//$this->data[$this->name][$field] = trim(strip_tags($value), array('h1','h2','h3','h4','h5','h6','p','em','strong','ul','ol','li','img','a','del'));
						break;
					}
				}
			}
		}
	}

	/**
	 * Custom find types
	 * 
	 * Let's first introduce a model based member variable called $_types,
	 * where we define the specific needs of each custom find type. Therefore,
	 * that variable will hold what we need as conditions, order, etc
	 * 
	 * protected $_types = array(
	 *	'latest' => array(
	 *		'order' => array('Resource.created' => 'desc'),
	 *		'limit' => 5
	 *	)
	 * );
	 * 
	 * if we wanted to paginate with the above custom find type? Just as we set 
	 * pagination parameters through the controller member variable $paginate, 
	 * we can specify which find type pagination we'll use. We do so by specifying 
	 * the find type in the index 0 of the pagination settings.
	 * 
	 * $this->paginate['Resource'] = array(
	 *   'latest',
	 *   'limit' => 10
	 * );
	 * $posts = $this->paginate('Resource');
	 * 
	 * (non-PHPdoc)
	 * @see libs/model/Model#find($conditions, $fields, $order, $recursive)
	 */
	public function find($type, $options = array(), $order = null, $recursive = null) {
		if (!empty($this->_types)) {
			$types = array_keys($this->_types);
			$type = (is_string($type) ? $type : null);
			if (!empty($type)) {
				if (($type == 'count' && !empty($options['type']) && in_array($options['type'], $types)) || in_array($type, $types)) {
					$options = Set::merge(
						$this->_types[($type == 'count' ? $options['type'] : $type)],
						array_diff_key($options, array('type'=>true))
					);
				}
				if (in_array($type, $types)) {
					$type = (!empty($this->_types[$type]['type']) ? $this->_types[$type]['type'] : 'all');
				}
			}
		}
		return parent::find($type, $options, $order, $recursive);
	}
	
	/*
	 * Transaction handling
	 */
	
	protected function _begin() {
		if (empty($this->db)) {
			$this->db =& ConnectionManager::getDataSource($this->useDbConfig);
		}
		return $this->db->begin($this);
	}
	
	protected function _commit() {
		return $this->db->commit($this);
	}
	
	protected function _rollback() {
		return $this->db->rollback($this);
	}
	
/**
 * construct method
 *
 * @param bool $id
 * @param mixed $table
 * @param mixed $ds
 * @return void
 * @access private
 */
	public function __construct($id = false, $table = null, $ds = null) {
		if (Configure::read() && (!$this->actsAs || !in_array('MiDevelopment.Development', $this->actsAs))) {
			$this->actsAs[] = 'MiDevelopment.Development';
		}
		$this->actsAs[] = 'Mi.SwissArmy';
		//$this->actsAs[] = 'Mi.RestrictSite';
		//$this->actsAs[] = 'Mi.OneQuery';
		parent::__construct($id, $table, $ds);
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
		parent::log(RequestHandlerComponent::getClientIP() . "\t" . $message, $type);
	}
	
}
?>