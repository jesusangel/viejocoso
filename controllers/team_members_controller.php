<?php
class TeamMembersController extends AppController {

	var $name = 'TeamMembers';

	function index() {
		$this->TeamMember->recursive = 0;
		$this->set('teamMembers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid team member', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('teamMember', $this->TeamMember->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TeamMember->create();
			if ($this->TeamMember->save($this->data)) {
				$this->Session->setFlash(__('The team member has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team member could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid team member', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TeamMember->save($this->data)) {
				$this->Session->setFlash(__('The team member has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team member could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TeamMember->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team member', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TeamMember->delete($id)) {
			$this->Session->setFlash(__('Team member deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team member was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->TeamMember->recursive = 0;
		$this->set('teamMembers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid team member', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('teamMember', $this->TeamMember->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->TeamMember->create();
			if ($this->TeamMember->save($this->data)) {
				$this->Session->setFlash(__('The team member has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team member could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid team member', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TeamMember->save($this->data)) {
				$this->Session->setFlash(__('The team member has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team member could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TeamMember->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for team member', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TeamMember->delete($id)) {
			$this->Session->setFlash(__('Team member deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Team member was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>