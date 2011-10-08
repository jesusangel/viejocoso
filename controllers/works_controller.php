<?php
class WorksController extends AppController {

	var $name = 'Works';

	function index() {
		$this->Work->recursive = 0;
		$this->set('works', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid work', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('work', $this->Work->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Work->create();
			if ($this->Work->save($this->data)) {
				$this->Session->setFlash(__('The work has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work could not be saved. Please, try again.', true));
			}
		}
		$workCategories = $this->Work->WorkCategory->find('list');
		$this->set(compact('workCategories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid work', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Work->save($this->data)) {
				$this->Session->setFlash(__('The work has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Work->read(null, $id);
		}
		$workCategories = $this->Work->WorkCategory->find('list');
		$this->set(compact('workCategories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for work', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Work->delete($id)) {
			$this->Session->setFlash(__('Work deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Work was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Work->recursive = 0;
		$this->set('works', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid work', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('work', $this->Work->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Work->create();
			if ($this->Work->save($this->data)) {
				$this->Session->setFlash(__('The work has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work could not be saved. Please, try again.', true));
			}
		}
		$workCategories = $this->Work->WorkCategory->find('list');
		$this->set(compact('workCategories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid work', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Work->save($this->data)) {
				$this->Session->setFlash(__('The work has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Work->read(null, $id);
		}
		$workCategories = $this->Work->WorkCategory->find('list');
		$this->set(compact('workCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for work', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Work->delete($id)) {
			$this->Session->setFlash(__('Work deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Work was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>