<?php
class ReferencesController extends AppController {

	var $name = 'References';

	function index() {
		$this->Reference->recursive = 0;
		$this->set('references', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid reference', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('reference', $this->Reference->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Reference->create();
			if ($this->Reference->save($this->data)) {
				$this->Session->setFlash(__('The reference has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reference could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid reference', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Reference->save($this->data)) {
				$this->Session->setFlash(__('The reference has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reference could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Reference->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for reference', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Reference->delete($id)) {
			$this->Session->setFlash(__('Reference deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Reference was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Reference->recursive = 0;
		$this->set('references', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid reference', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('reference', $this->Reference->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Reference->create();
			if ($this->Reference->save($this->data)) {
				$this->Session->setFlash(__('The reference has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reference could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid reference', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Reference->save($this->data)) {
				$this->Session->setFlash(__('The reference has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reference could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Reference->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for reference', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Reference->delete($id)) {
			$this->Session->setFlash(__('Reference deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Reference was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>