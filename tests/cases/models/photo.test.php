<?php
/* Photo Test cases generated on: 2011-08-11 00:27:30 : 1313015250*/
App::import('Model', 'Photo');

class PhotoTestCase extends CakeTestCase {
	var $fixtures = array('app.photo', 'app.work');

	function startTest() {
		$this->Photo =& ClassRegistry::init('Photo');
	}

	function endTest() {
		unset($this->Photo);
		ClassRegistry::flush();
	}

}
?>