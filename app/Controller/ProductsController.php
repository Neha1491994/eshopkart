<?php

class ProductsController extends AppController {
	
	var $uses = array('Category','Product');
	public $components = array('Session','Paginator','RequestHandler');
	var $helpers = array('Html', 'Form','Session','Paginator','Js' => array('Jquery'));
	
	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('product.name' => 'asc' ) 
    );
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add'); 
    }
	


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

    public function product_list($id = Null) {
		if($id)
		{
			$this->Paginator->settings= array(
			'conditions' => array('Product.subcategory_id' => $id),
			'limit' => 6,
			'order' => array('Products.product_name' => 'asc' )
		);	
		}
		else{
		$this->Paginator->settings= array(
			'limit' => 6,
			'order' => array('Products.product_name' => 'asc' )
		);
		}
		$products = $this->Paginator->paginate('Product');
		$this->set(compact('products'));
		
			
    }

	
	
	public function subcategory() {
		$subcategory = array();
		if (isset($this->request['data']['id'])) {
			$subcategory = $this->Category->find('list', array(
				'fields' => array(
					'id',
					'category_name',
				),
				'conditions' => array(
					'Category.parent_id' => $this->request['data']['id']
				)
			));
		}
		//pr($subcategory);exit;
		header('Content-Type: application/json');
		echo json_encode($subcategory);
		exit();
	}

    public function add($id = Null) {
		
		      $categories = $this->Category->find('list', array(
			'fields' => array(
				'id',
				'category_name',
				
			),'conditions'=>array('Category.parent_id' => 0),
		));
              $this->set('categories',$categories);
	
        if ($this->request->is('post')) {
			
			$productdata = $this->request->data['Product'];
	//pr($productdata);exit;			
			$this->Product->create();
			if ($this->Product->save($productdata)) {
				$this->Session->setFlash(__('The Product has been Added'));
				$this->redirect(array('action' => 'product_list'));
			} else {
				$this->Session->setFlash(__('The Product could not be Added. Please, try again.'));
			}	
        }
    }

    public function edit($id = null) {

		    if (!$id) {
				$this->Session->setFlash('Please provide a product id');
				$this->redirect(array('action'=>'list'));
			}

			$user = $this->Product->findById($id);
			if (!$user) {
				$this->Session->setFlash('Invalid Product ID Provided');
				$this->redirect(array('action'=>'list'));
			}

			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Product->id = $id;
				if ($this->Product->save($this->request->data)) {
					$this->Session->setFlash(__('The product detail has been updated'));
					$this->redirect(array('action' => 'edit', $id));
				}else{
					$this->Session->setFlash(__('Unable to update your product detail.'));
				}
			}

			if (!$this->request->data) {
				$this->request->data = $product;
			}
    }

    public function delete($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('Please provide a product id');
			$this->redirect(array('action'=>'index'));
		}
		
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid product id provided');
			$this->redirect(array('action'=>'list'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('Product deleted'));
            $this->redirect(array('action' => 'list'));
        }
        $this->Session->setFlash(__('Product was not deleted'));
        $this->redirect(array('action' => 'list'));
    }
	
	public function activate($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('Please provide a Product id');
			$this->redirect(array('action'=>'list'));
		}
		
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id product');
			$this->redirect(array('action'=>'list'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('Product re-activated'));
            $this->redirect(array('action' => 'list'));
        }
        $this->Session->setFlash(__('Product was not re-activated'));
        $this->redirect(array('action' => 'list'));
    }

}

?>