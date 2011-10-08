<?php
class WorkCategoriesController extends AppController {

	var $name = 'WorkCategories';

	function index() {
		$this->WorkCategory->recursive = 0;
		$this->set('workCategories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid work category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('workCategory', $this->WorkCategory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->WorkCategory->create();
			if ($this->WorkCategory->save($this->data)) {
				$this->Session->setFlash(__('The work category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work category could not be saved. Please, try again.', true));
			}
		}
		$parentWorkCategories = $this->WorkCategory->ParentWorkCategory->find('list');
		$this->set(compact('parentWorkCategories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid work category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->WorkCategory->save($this->data)) {
				$this->Session->setFlash(__('The work category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->WorkCategory->read(null, $id);
		}
		$parentWorkCategories = $this->WorkCategory->ParentWorkCategory->find('list');
		$this->set(compact('parentWorkCategories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for work category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->WorkCategory->delete($id)) {
			$this->Session->setFlash(__('Work category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Work category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->WorkCategory->recursive = 0;
		$this->set('workCategories', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid work category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('workCategory', $this->WorkCategory->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->WorkCategory->create();
			if ($this->WorkCategory->save($this->data)) {
				$this->Session->setFlash(__('The work category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work category could not be saved. Please, try again.', true));
			}
		}
		$parentWorkCategories = $this->WorkCategory->ParentWorkCategory->find('list');
		$this->set(compact('parentWorkCategories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid work category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->WorkCategory->save($this->data)) {
				$this->Session->setFlash(__('The work category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The work category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->WorkCategory->read(null, $id);
		}
		$parentWorkCategories = $this->WorkCategory->ParentWorkCategory->find('list');
		$this->set(compact('parentWorkCategories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for work category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->WorkCategory->delete($id)) {
			$this->Session->setFlash(__('Work category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Work category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>