<?php
/* TeamMember Test cases generated on: 2011-08-11 00:27:30 : 1313015250*/
App::import('Model', 'TeamMember');

class TeamMemberTestCase extends CakeTestCase {
	var $fixtures = array('app.team_member');

	function startTest() {
		$this->TeamMember =& ClassRegistry::init('TeamMember');
	}

	function endTest() {
		unset($this->TeamMember);
		ClassRegistry::flush();
	}

}
?>