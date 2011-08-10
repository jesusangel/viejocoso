<?php
/* Reference Test cases generated on: 2011-08-11 00:27:30 : 1313015250*/
App::import('Model', 'Reference');

class ReferenceTestCase extends CakeTestCase {
	var $fixtures = array('app.reference');

	function startTest() {
		$this->Reference =& ClassRegistry::init('Reference');
	}

	function endTest() {
		unset($this->Reference);
		ClassRegistry::flush();
	}

}
?>