<?php
/* WorkCategory Test cases generated on: 2011-08-11 00:27:30 : 1313015250*/
App::import('Model', 'WorkCategory');

class WorkCategoryTestCase extends CakeTestCase {
	var $fixtures = array('app.work_category');

	function startTest() {
		$this->WorkCategory =& ClassRegistry::init('WorkCategory');
	}

	function endTest() {
		unset($this->WorkCategory);
		ClassRegistry::flush();
	}

}
?>