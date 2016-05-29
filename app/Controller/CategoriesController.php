<?php

class CategoriesController extends AppController {

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('Categories.category_name' => 'asc' ) 
    );
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add'); 
    }
	
    public $components = array('Session','Paginator');
	var $helpers = array('Session','Paginator','Js' => array('Jquery'));

	public function login() {
		
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));		
		}
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				//pr($this->Auth); exit;
				$this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('Invalid username or password'));
			}
		} 
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

  public function category_list() {
		$this->Paginator->settings= array(
		     'conditions' => array('Category.parent_id' => 0),
			'limit' => 6,
			'order' => array('Categories.category_name' => 'asc' )
		);
		$categorys = $this->Paginator->paginate('Category');
		$this->set(compact('categorys'));
    }
public function subcategory_list($id = Null) {
	//pr($id);exit;
	//$this->Paginator->settings = $this->paginate;
	
		$this->Paginator->settings = array(
		    'conditions' => array('Category.parent_id' => $id),
			'limit' => 6,
		    //'order' => array('Category.category_name' => 'asc' )
		);
		$categorys = $this->Paginator->paginate('Category');
		//$this->Paginator->settings = array("conditions" => array('Category.parent_id' => $id));
		//$categorys = $this->paginate('category');
		
		//pr($categorys);exit;
		
		$this->set(compact('categorys'));
    }

    public function add($id = null) {
		//pr($id);exit;
		if($id)
		{
			   if ($this->request->is('post')){
				   $postdata=$this->request->data['Category'];
			     $this->Category->create();
		         if ($this->Category->save($postdata)){
		   		 $lastInsertedId = $this->Category->id;
				    if($lastInsertedId != null){
					$this->Category->id = $lastInsertedId;
					$this->Category->saveField("parent_id", $id);
				    }
				 $this->Session->setFlash(__('The Subcategory has been created'));
				 $this->redirect(array('action' => 'category_list'));
			    } else {
				  $this->Session->setFlash(__('The Subcategory could not be created. Please, try again.'));
			      }	
			   }
			
		}else{
        if ($this->request->is('post')) {
				
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The Category has been created'));
				$this->redirect(array('action' => 'category_list'));
			} else {
				$this->Session->setFlash(__('The Category could not be created. Please, try again.'));
			}	
        }
	 }
    }

    public function edit($id = null) {

		    if (!$id) {
				$this->Session->setFlash('Please provide a category id');
				$this->redirect(array('action'=>'category_list'));
			}

			$Category = $this->Category->findById($id);
			if (!$Category) {
				$this->Session->setFlash('Invalid Category ID Provided');
				$this->redirect(array('action'=>'category_list'));
			}

			if ($this->request->is('post') || $this->request->is('put')){
				$this->Category->id = $id;
				if ($this->Category->save($this->request->data)) {
					$this->Session->setFlash(__('The Category has been updated'));
					$this->redirect(array('action' => 'edit', $id));
				}else{
					$this->Session->setFlash(__('Unable to update your Category.'));
				}
			}

			if (!$this->request->data) {
				$this->request->data = $Category;
			}
    }

    public function category_delete($id = null) {
//pr($id);exit;
    if ($this->Category->delete($id)) {
        $this->Session->setFlash(__('Category deleted'));
    } else {
        $this->Session->setFlash(__('Category was not deleted'));
    }

    return $this->redirect(array('action' => 'category_list'));
    }
	
}	

?>