<?php

class ProductsController extends AppController {
	
<<<<<<< HEAD
	var $uses = array('Category','Product');
	public $components = array('Session','Paginator','RequestHandler');
=======
	var $uses = array('Category','Product','Gallery');
	public $components = array('Session','Paginator','RequestHandler','Qimage');
>>>>>>> develop
	var $helpers = array('Html', 'Form','Session','Paginator','Js' => array('Jquery'));
	
	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('product.name' => 'asc' ) 
    );
	
    public function beforeFilter() {
        parent::beforeFilter();
<<<<<<< HEAD
        $this->Auth->allow('login','add'); 
=======
        $this->Auth->allow('login','add', 'subcategory'); 
>>>>>>> develop
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
<<<<<<< HEAD
			$this->Paginator->settings= array(
			'conditions' => array('Product.subcategory_id' => $id),
			'limit' => 6,
=======
			 $subcategory = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
		 // pr($category);exit;
		   //pr($category['category_name']);exit;
		       if(isset($id)){
			   $this->Session->write("type",'subcategory');
			   $this->Session->write("categ",$subcategory['Category']['category_name']);
			   }
			$this->Paginator->settings= array(
			'conditions' => array('Product.category_id' => $id),
			'limit' => 10,
>>>>>>> develop
			'order' => array('Products.product_name' => 'asc' )
		);	
		}
		else{
<<<<<<< HEAD
		$this->Paginator->settings= array(
			'limit' => 6,
=======
			$this->Session->delete('type');
			$this->Session->delete('categ');
		$this->Paginator->settings= array(
			'limit' => 10,
>>>>>>> develop
			'order' => array('Products.product_name' => 'asc' )
		);
		}
		$products = $this->Paginator->paginate('Product');
		$this->set(compact('products'));
		
			
    }
<<<<<<< HEAD
=======
	
	public function product_detail($id = Null){
		if($id){
			$this->Product->recursive = 1;
			 $this->request->data = $this->Product->find('first',array('conditions' => array('Product.id' => $id)));
			//pr($product);exit;
		}
		
	}
>>>>>>> develop

	
	
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
<<<<<<< HEAD
		//pr($subcategory);exit;
=======
		//pr($this->request);exit;
>>>>>>> develop
		header('Content-Type: application/json');
		echo json_encode($subcategory);
		exit();
	}

    public function add($id = Null) {
		
<<<<<<< HEAD
=======
		/*if($id){
			$subcategoryid = $this->Product->find('first', array('conditions' => array('Product.id' => $id),'recursive' => 0));
			//pr($subcategoryid['Category']['parent_id']);exit;
			
			$categories = $this->Category->find('list', array(
			'fields' => array(
				'id',
				'category_name',
				
			),'conditions'=>array('Category.id' => $subcategoryid['Category']['parent_id']),
		));
		//pr($categories);exit;
		}else{*/
>>>>>>> develop
		      $categories = $this->Category->find('list', array(
			'fields' => array(
				'id',
				'category_name',
				
			),'conditions'=>array('Category.parent_id' => 0),
		));
<<<<<<< HEAD
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
=======
		
		//}
              $this->set('categories',$categories);
	
	
	     $this->Product->create();
			if ($this->request->is('post')||$this->request->is('put')) {
			//pr($this->request->data[]);exit;
			$postData=$this->data['Product'];
			//pr($postData);exit;
			if ($this->Product->save($postData)) 
 			{
              $lastInsertedId = $this->Product->id;	
              //pr($postData);exit;			  
			  for($i=1;$i<4;$i++)
				{
					if(is_array($postData['image'.$i]) && $postData['image'.$i]['name']!='') {
					$name = explode('.', $postData['image'.$i]['name']);
					//pr($name);exit;
						$ext	=	strtolower($name[count($name)-1]);
						$file_name = 'image'.$i.'_'.$lastInsertedId.'_'.strtotime(date('Y-m-d H:i:s')).".".$ext;
						$finalPath = "../webroot/files/images/";
						$postData['image'.$i]['name']= $file_name;
						$imagedata['file'] = $postData['image'.$i];
						$imagedata['path'] = $finalPath;
						$uploadedImage = $this->Qimage->copy($imagedata);
						$thumbData['file'] = $uploadedImage;
						$thumbData['width'] = '100';
						$thumbData['height'] = '100';
						$thumbData['output'] = "../webroot/files/thumbs100x100/";
						$this->Qimage->resize($thumbData);
						
						$errors = $this->Qimage->getErrors();
						if(count($errors)>0){
							//pr($errors);exit;
							//if any error dont save
						}
						 else{
							
							$data = array();
							//$this->Gallery>create();
                            $data['Gallary']['product_id'] = $lastInsertedId;
							$data['Gallary']['images'] = $file_name;
							//pr($data['Gallary']);
							$this->Gallery->saveAll($data['Gallary']);
							  
							 
						}
					}
				}			
			
			
				$this->Session->setFlash('Your product has been saved.');
				$this->redirect(array('action' => 'product_list'));
			}
			else 
			{
				$this->Session->setFlash('Unable to add your product.');
			}	
        }
		
		if($id != null){
			$product = $this->Product->find('first', array('conditions' => array('Product.id' => $id),'recursive' => 0));
			//$parentcateg = $this->Category->find('first', array('conditions' => array('Category.id' => $product['Category']['parent_id']),'recursive' => 0 ));
			//pr($product);
			//pr($parentcateg);exit;
			//pr(array($product,$parentcateg));exit;
			//$this->request->data = array($product,$parentcateg);
			$this->request->data =$product; 
			
		}
>>>>>>> develop
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

<<<<<<< HEAD
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
=======
     public function product_delete($id = null) {
//pr($id);exit;
    if ($this->Product->delete($id)) {
        $this->Session->setFlash(__('Product deleted'));
    } else {
        $this->Session->setFlash(__('Product was not deleted'));
    }

    return $this->redirect(array('action' => 'product_list'));
    }
	
	
>>>>>>> develop

}

?>