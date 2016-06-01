<<<<<<< HEAD:app/Controller/WebservicesController.php
<?php 
class WebservicesController extends AppController {
	//Specify View folder
	var $name     = 'Webservices';
	// Specify models and tabel
	var $uses = array('Category','User','Product','Webservice','Cart_detail');
	var $components = array('RequestHandler');
	var $helper = ('Session');
	
# function checks individually if the admin/user's function required login or not.
	public function beforeFilter() {
		$this->Auth->allow();		
    }
	
	public function login_user(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$username = $this->request->data['email'];
			$password = $this->request->data['password'];
			$find_user = array();
			$find_user = $this->User->find('first', array("conditions" => array("User.email" => $username,"User.password"=>$password)));
			//pr($find_user);exit;
			if($find_user){
			$this->User->id = $find_user['User']['id'];	
			$token = md5($find_user['User']['email'].time());
			//pr($token);exit;
			$this->User->saveField("token_id", $token);
			$find_user['User']['change_token_id'] = $token;
			//pr($find_user);exit;
			$json_return = json_encode($find_user);
			}
			else{
				$err_array = array();
				$err_array['err'] = "Invalid user or password";
				$err_array['code'] = "1003";
				//$err_array['message'] = ER1003;
				$json_return = json_encode($err_array);
			}
			echo $json_return;
			exit;
		}else{	
			$json_return['err'] = "Invalid data";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
	}
	}
	
	public function signup() {
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$fullname = $this->request->data['firstname']." ".$this->request->data['lastname'];
			$firstname = $this->request->data['firstname'];
			$lastname = $this->request->data['lastname'];
			$email    = $this->request->data['email'];
			$password = $this->request->data['password'];
			$mobile = $this->request->data['mobile'];
			$json_return = array();
			//$this->request->data['Webservice']['email'] = $email;
			if($email == "" || $password == "" ){
				$json_return['code'] = "1006";
				//$json_return['message'] = ER1006;
				$json_return['err'] = "Please enter valid email id and password";
				echo json_encode($json_return);
				exit;
			}else{
				//$this->Webservice->set($this->request->data);
				if($this->request->data){
					$this->User->set($this->request->data);
					$this->request->data['User']['username'] = $fullname;
					$this->request->data['User']['firstname'] = $firstname;
					$this->request->data['User']['lastname'] = $lastname;
					$this->request->data['User']['email'] = $email;
					$this->request->data['User']['password'] = md5($password);
					$this->request->data['User']['mobile'] = $mobile;
					
			//pr($this->request->data);exit;
			if($this->User->save($this->request->data)){				
				    $lastInsertedId = $this->User->id;
					$token = md5($lastInsertedId.time());
				  //$this->User->id = $find_user['User']['id'];
				  
				  $userDetail = $this->User->find("first", array("conditions" => array("User.id" => $lastInsertedId)));
				  //pr($userDetail);exit;
						$token = md5($userDetail['User']['email'].time());
						//signup email
						
						$this->sendMail($userDetail['User']['email'], 'Welcome to eshopkart', 'welcome', array('title_for_layout' =>'Welcome to eShopkart'));
						
						$userDetail['User']['token_id'] = $token;
						$this->User->id = $userDetail['User']['id'];
						$this->User->saveField("token_id", $token);
						$json_return['code'] = "1000";
						//$json_return['message'] = ER1000;
						$json_return['msg'] = "Signup successfully";
						$json_return['token_id'] = $token;
						
						echo json_encode($userDetail);
						exit;
					}else{
						echo json_encode($this->User->invalidFields());
						exit;
					}
				}else{
					$json_return['code'] = "1042";
					//$json_return['message'] = ER1042;
					$json_return['err'] = "Please enter valid and unique email id";
					echo json_encode($json_return);
					exit;
				}			
			}
		}else{	
			$json_return['err'] = "invalid data";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}
		
	}
	
	public function changepassword() {
		$json_return = array();
		$token    = $this->request->data['token_id'];
		$newpassword = $this->request->data['password'];
		//$mobile = $this->request->data['mobile'];
		if($token == ""){
				$json_return['code'] = "1001";
				//$json_return['message'] = ER1001;
			    $json_return['message'] = "Invalid token";			
		}else{
				$find_user = array();
				$find_user = $this->User->find("first", array("conditions" => array("User.token_id" => $token)));
				//pr($find_user);
				if($find_user){
					//echo $find_user['Admin']['id'];
					$this->User->id = $find_user['User']['id'];
					$this->User->saveField("password",$newpassword);
					$json_return['msg'] = "Password changes successfully";
					$json_return['code'] = "1000";
					//$json_return['message'] = ER1000;
				}else{
					//$err_array = array();
					$json_return['err'] = 'Invalid user or password';
					$json_return['code'] = "1003";
					//$json_return['message'] = ER1003;
					//$json_return = json_encode($err_array);
				}
			}	
		
		echo json_encode($json_return);
			exit;
		//$chk_user = $this->Admin->find("first", array("conditions"=> ));
	}
	
	public function logout_user(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {	
			$this->request->data['User']['token_id'] = $this->request->data['token_id'];
			$user_id = $this->request->data['User']['token_id'];
            $user = $this->User->find("first",array("conditions" => array("User.token_id" =>$user_id)));
            //pr($user);exit; 			
			if($user){	
				$this->User->id = $user['User']['id'];
				$this->User->saveField("token_id", "");
				$json_return['code'] = "1000";
				//$json_return['message'] = ER1000;
				$json_return['msg'] = "logout successfully";
					echo json_encode($json_return);
					exit;
			}else{
				$json_return['err'] = "Invalid data";
				$json_return['code'] = "1001";
				//$json_return['message'] = ER1001;
				echo json_encode($json_return);
				exit;
			}
		}else{	
			$json_return['err'] = "invalid tokenid";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}
	}
	
	public function select_category()
	{
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {	
		 //$this->request->data['Category']['parent_id'] = $this->request->data['parent_id'];
		 $this->request->data['Category']['id'] = $this->request->data['category_id'];
		 $category_id = $this->request->data['Category']['id'];
		 if($category_id)
		 {
			/* $category_details = $this->Category->find('first',array("conditions" =>array('Category.id'=>$category_id)));
			 //pr($category_details);exit;
			 if($category_details){
			 $id = $category_details['Category']['id'];*/
			 $subcategory_details = $this->Category->find('all',array("conditions" =>array('Category.parent_id'=>$category_id)));
			 //pr($subcategory_details);exit;
			 $subcate = array();
			 $i=0;
			 foreach($subcategory_details as $subcategory)
			 {
				$subcate[$i]['id'] =  $subcategory['Category']['id'];
			    $subcate[$i]['subcategory_name'] =  $subcategory['Category']['category_name'];
				$i++;
			 }
			 //pr($subcate);exit;
			 echo json_encode($subcate); 
			 exit;
			 }else{
				  $json_return['err'] = "This category is not exist";
			      $json_return['code'] = "1008"; 
			      echo json_encode($json_return);
			      exit;
			 }
		    }else{
			      $json_return['err'] = "invalid data";
			      $json_return['code'] = "1002";
			     //$json_return['message'] = ER1002;
			      echo json_encode($json_return);
			      exit;
		}
	}
	
	public function select_subcategory(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			 //$this->request->data['Category']['id'] = $this->request->data['category_id'];
			 //$category_id = $this->request->data['category_id'];
			 $subcategory_id = $this->request->data['subcategory_id'];
		if($this->request->data)
		 {
			 $subcategory_details = $this->Category->find('first',array("conditions" =>array('Category.id'=>$subcategory_id)));
			 //pr($subcategory_details);exit;
			 if($subcategory_details && $subcategory_details['Category']['parent_id']!=0){
			 $this->Product->recursive = 2;
			 $product_category = $this->Product->find('all',array("conditions" =>array('Product.subcategory_id'=>$subcategory_id)));
			 //pr($product_category);exit;
			 $subcate = array();
			 $id = array();
			 $i=0;$k = 0;
			 foreach($product_category as $Product)
			 {
				if(isset($Product['Product_gallery'][0])){
                $img = $Product['Product_gallery'][0]['images'];
				}else{
				$img = "";	
				}
			    $subcate[$i]['name'] =  $Product['Product']['product_name'];
				//if($img!= NULL || $img!= ""){
				$subcate[$i]['image'] =  $img;
				$i++;
			 }
			 //pr($id);exit;
			 echo json_encode($subcate); 
			 exit;
			 }else{
				  $json_return['err'] = "This subcategory is not exist";
			      $json_return['code'] = "1010"; 
			      echo json_encode($json_return);
			      exit;
		    }
		    }else{
			      $json_return['err'] = "Please select any category";
			      $json_return['code'] = "1009"; 
			      echo json_encode($json_return);
			      exit;
		    }
		    }else{
			      $json_return['err'] = "invalid data";
			      $json_return['code'] = "1002";
			     //$json_return['message'] = ER1002;
			      echo json_encode($json_return);
			      exit;
		   }
	}
	
	public function add_to_cart(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$user_id = $this->request->data['user_id'];
			$id = $this->request->data['product_id'];
			$quantity = $this->request->data['quantity'];
			$this->Product->recursive = 1;
			$product = $this->Product->find("first",array("conditions"=>array("Product.id"=>$id)));
			$carddetail = $this->Cart_detail->find("all",array("conditions"=>array("Cart_detail.product_id"=>$id, "Cart_detail.user_id"=>$user_id)));
			//pr($product['Product']['quantity']);exit;
			$totalquantity = $product['Product']['quantity'];
			//pr($card);exit;
			if($carddetail){
			        pr("This product is available in your cart");
					exit;
			}else{
			if(isset($this->request->data)){
				    if($quantity <=  $totalquantity){
				    $this->Cart_detail->set($this->request->data);
					$this->request->data['Cart_detail']['user_id'] = $user_id;
					$this->request->data['Cart_detail']['product_id'] = $id;
					$this->request->data['Cart_detail']['quantity'] = $quantity;
					$remaining_quntity = $totalquantity - $quantity;
					//$this->Product->saveField("quantity", $remaining_quntity);
					$this->Product->query("UPDATE products set quantity = '".$remaining_quntity."' where id = '".$id."'");
                    if($this->Cart_detail->save($this->request->data)){	
					$json_return['msg'] = "Successfully added to cart";
			        $json_return['code'] = "1011";
			        //$json_return['message'] = ER1011;
			        echo json_encode($json_return);
			        exit;
					}else{
						//$json_return['err'] = "internal error";
			            $json_return['code'] = "1012";
			            $json_return['message'] = ER1012;
			            echo json_encode($json_return);
			            exit;
					}
					}else{
						$json_return['code'] = "1013";
			            $json_return['message'] = "Sorry! :( quantity is not available that you entered ";
			            echo json_encode($json_return);
			            exit;
					}
			}else{
                    $json_return['err'] = "invalid data";
			        $json_return['code'] = "1002";
			       //$json_return['message'] = ER1002;
			        echo json_encode($json_return);
			        exit;
				}}
			
			//pr($product);exit;	
		}else{
			      $json_return['err'] = "invalid request";
			      $json_return['code'] = "1002";
			     //$json_return['message'] = ER1002;
			      echo json_encode($json_return);
			      exit;
		     }
	}
	
	public function view_cart(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$user_id = $this->request->data['user_id'];
		    $carddetail = $this->Cart_detail->find("all",array("conditions" => array("Cart_detail.user_id" => $user_id)));
			//pr($carddetail);exit;
			$id = array();
			$i = 0;
			//pr($card);exit;	
			foreach($carddetail as $card){
			$id[$i] = $card['Product']['id'];
			$i++;
			}
			//pr($id);exit;
            $product = $this->Product->find("all",array("conditions" => array("Product.id"=>$id)));
			//pr($product);exit;
			$data = array();
			$i = 0;
			foreach($product as $prod){
			if(isset($prod['Product_gallery'][0])){
                $img = $prod['Product_gallery'][0]['images'];
				}else{
				$img = "";	
				}
			$data[$i]['name'] = $prod['Product']['product_name'];
			$data[$i]['quantity'] = $carddetail[$i]['Cart_detail']['quantity'];
			$data[$i]['image'] =  $img;
			$i++;
			}
			//pr($data);exit;
			echo json_encode($data); 
			exit;
			
		}else{
			      $json_return['err'] = "invalid request";
			      $json_return['code'] = "1002";
			     //$json_return['message'] = ER1002;
			      echo json_encode($json_return);
			      exit;
		     }
    }
	
		public function clear_cart(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$user_id = $this->request->data['user_id'];
			$product_id = $this->request->data['product_id'];
			if($this->request->data){
				$this->Cart_detail->query("DELETE FROM cart_details WHERE user_id = '".$user_id."' AND product_id = '".$product_id."'");
				$json_return['msg'] = "success";
			    $json_return['code'] = "1000";
			   //$json_return['message'] = ER1000;
			    echo json_encode($json_return);
			    exit;
			}else{
				$json_return['err'] = "invalid request";
			    $json_return['code'] = "1002";
			    //$json_return['message'] = ER1002;
			    echo json_encode($json_return);
			    exit;
			}
			}else{
				$json_return['err'] = "invalid request";
			    $json_return['code'] = "1002";
			    //$json_return['message'] = ER1002;
			    echo json_encode($json_return);
			    exit;
			}
	}
	
	
}

=======
<?php 
class WebservicesController extends AppController {
	//Specify View folder
	var $name     = 'Webservices';
	// Specify models and tabel
	var $uses = array('Category','User','Product','Webservice','Cart_detail','Order','Orderdetail');
	var $components = array('Session','RequestHandler');
	var $helper = ('Session');
	
# function checks individually if the admin/user's function required login or not.
	public function beforeFilter() {
		$this->Auth->allow();		
    }
	
	public function login_user(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$username = $this->request->data['email'];
			$password = $this->request->data['password'];
			$find_user = array();
			$find_user = $this->User->find('first', array("conditions" => array("User.email" => $username,"User.password"=>$password)));
			//pr($find_user);exit;
			if($find_user){
				$this->User->id = $find_user['User']['id'];	
				$token = md5($find_user['User']['email'].time());
				//pr($token);exit;
				$this->User->saveField("token_id", $token);
				$find_user['User']['change_token_id'] = $token;
				//pr($find_user);exit;
				$json_return = json_encode($find_user);
			}else{
				$err_array = array();
				$err_array['err'] = "Invalid user or password";
				$err_array['code'] = "1003";
				//$err_array['message'] = ER1003;
				$json_return = json_encode($err_array);
			}
			    echo $json_return;
			    exit;
		}else{	
			$json_return['err'] = "Invalid data";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
	}
	}
	
	public function signup() {
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$fullname = $this->request->data['firstname']." ".$this->request->data['lastname'];
			$firstname = $this->request->data['firstname'];
			$lastname = $this->request->data['lastname'];
			$email    = $this->request->data['email'];
			$password = $this->request->data['password'];
			$mobile = $this->request->data['mobile'];
			$json_return = array();
			//$this->request->data['Webservice']['email'] = $email;
			if($email == "" || $password == "" ){
				$json_return['code'] = "1006";
				//$json_return['message'] = ER1006;
				$json_return['err'] = "Please enter valid email id and password";
				echo json_encode($json_return);
				exit;
			}else{
				//$this->Webservice->set($this->request->data);
				if($this->request->data){
					$this->User->set($this->request->data);
					$this->request->data['User']['username'] = $fullname;
					$this->request->data['User']['firstname'] = $firstname;
					$this->request->data['User']['lastname'] = $lastname;
					$this->request->data['User']['email'] = $email;
					$this->request->data['User']['password'] = md5($password);
					$this->request->data['User']['mobile'] = $mobile;
					
					//pr($this->request->data);exit;
					if($this->User->save($this->request->data)){				
						$lastInsertedId = $this->User->id;
						$token = md5($lastInsertedId.time());
						//$this->User->id = $find_user['User']['id'];
						$userDetail = $this->User->find("first", array("conditions" => array("User.id" => $lastInsertedId)));
						//pr($userDetail);exit;
						$token = md5($userDetail['User']['email'].time());
						//signup email
						$this->sendMail($userDetail['User']['email'], 'Welcome to eshopkart', 'welcome', array('title_for_layout' =>'Welcome to eShopkart'));
						$userDetail['User']['token_id'] = $token;
						$this->User->id = $userDetail['User']['id'];
						$this->User->saveField("token_id", $token);
						$json_return['code'] = "1000";
						//$json_return['message'] = ER1000;
						$json_return['msg'] = "Signup successfully";
						$json_return['token_id'] = $token;
						
						echo json_encode($userDetail);
						exit;
					}else{
						echo json_encode($this->User->invalidFields());
						exit;
					}
				}else{
					$json_return['code'] = "1042";
					//$json_return['message'] = ER1042;
					$json_return['err'] = "Please enter valid and unique email id";
					echo json_encode($json_return);
					exit;
				}			
			}
		}else{	
			$json_return['err'] = "invalid data";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}
		
	}
	
	public function changepassword() {
		$json_return = array();
		$token    = $this->request->data['token_id'];
		$newpassword = $this->request->data['password'];
		//$mobile = $this->request->data['mobile'];
		if($token == ""){
				$json_return['code'] = "1001";
				//$json_return['message'] = ER1001;
			    $json_return['message'] = "Invalid token";			
		}else{
				$find_user = array();
				$find_user = $this->User->find("first", array("conditions" => array("User.token_id" => $token)));
				//pr($find_user);
				if($find_user){
					//echo $find_user['Admin']['id'];
					$this->User->id = $find_user['User']['id'];
					$this->User->saveField("password",$newpassword);
					$json_return['msg'] = "Password changes successfully";
					$json_return['code'] = "1000";
					//$json_return['message'] = ER1000;
				}else{
					//$err_array = array();
					$json_return['err'] = 'Invalid user or password';
					$json_return['code'] = "1003";
					//$json_return['message'] = ER1003;
					//$json_return = json_encode($err_array);
				}
			}	
		
		echo json_encode($json_return);
			exit;
		//$chk_user = $this->Admin->find("first", array("conditions"=> ));
	}
	
	public function logout_user(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {	
			$this->request->data['User']['token_id'] = $this->request->data['token_id'];
			$user_id = $this->request->data['User']['token_id'];
            $user = $this->User->find("first",array("conditions" => array("User.token_id" =>$user_id)));
            //pr($user);exit; 			
			if($user){	
				$this->User->id = $user['User']['id'];
				$this->User->saveField("token_id", "");
				$json_return['code'] = "1000";
				//$json_return['message'] = ER1000;
				$json_return['msg'] = "logout successfully";
					echo json_encode($json_return);
					exit;
			}else{
				$json_return['err'] = "Invalid data";
				$json_return['code'] = "1001";
				//$json_return['message'] = ER1001;
				echo json_encode($json_return);
				exit;
			}
		}else{	
			$json_return['err'] = "invalid tokenid";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}
	}
	
	public function select_category()
	{
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {	
			$category_id  = (isset($this->request->data['category_id']) ?$this->request->data['category_id'] :0);
		    if($category_id >=0)
		    {
				$subcategory_details = $this->Category->find('all',array("conditions" =>array('Category.parent_id'=>$category_id)));
				//pr($subcategory_details);exit;
				$subcate = array();
				$i=0;
				foreach($subcategory_details as $subcategory)
				{
					$subcate[$i]['id'] =  $subcategory['Category']['id'];
					$subcate[$i]['category_name'] =  $subcategory['Category']['category_name'];
					$i++;
				}
				//pr($subcate);exit;
				echo json_encode($subcate); 
				exit;
			}
		}else{
			      $json_return['err'] = "invalid data";
			      $json_return['code'] = "1002";
			     //$json_return['message'] = ER1002;
			      echo json_encode($json_return);
			      exit;
		}
	}
	
	public function select_subcategory(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			 $subcategory_id = $this->request->data['subcategory_id'];
			if($this->request->data)
			{
				$subcategory_details = $this->Category->find('first',array("conditions" =>array('Category.id'=>$subcategory_id)));
				//pr($subcategory_details);exit;
				if($subcategory_details['Category']['parent_id']!=0)
				{
					$this->Product->recursive = 2;
					$product_category = $this->Product->find('all',array("conditions" =>array('Product.subcategory_id'=>$subcategory_id)));
					//pr($product_category);exit;
					$subcate = array();
					$id = array();
					$i=0;$k = 0;
					foreach($product_category as $Product)
					{
						if(isset($Product['Gallery'][0])){
							$img = $Product['Gallery'][0]['images'];
						}else{
							$img = "";	
						}
						$subcate[$i]['name'] =  $Product['Product']['product_name'];
						//if($img!= NULL || $img!= ""){
						$subcate[$i]['image'] =  $img;
						$i++;
					}
					//pr($id);exit;
					echo json_encode($subcate); 
					exit;
				}else{
					$json_return['err'] = "This subcategory is not exist";
					$json_return['code'] = "1010"; 
					echo json_encode($json_return);
					exit;
				}
		    }else{
			      $json_return['err'] = "Please select any category";
			      $json_return['code'] = "1009"; 
			      echo json_encode($json_return);
			      exit;
		    }
		}else{
				$json_return['err'] = "invalid data";
				$json_return['code'] = "1002";
				//$json_return['message'] = ER1002;
				echo json_encode($json_return);
				exit;
		}
	}
	
	public function add_to_cart(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$user_id = $this->request->data['user_id'];
			$id = $this->request->data['product_id'];
			$quantity = $this->request->data['quantity'];
			$this->Product->recursive = 1;
			$product = $this->Product->find("first",array("conditions"=>array("Product.id"=>$id)));
			$carddetail = $this->Cart_detail->find("all",array("conditions"=>array("Cart_detail.product_id"=>$id, "Cart_detail.user_id"=>$user_id)));
			$totalquantity = $product['Product']['quantity'];
			//pr($card);exit;
			if($carddetail){
			        pr("This product is available in your cart");
					exit;
			}else{
					if($quantity <=  $totalquantity){
						$this->Cart_detail->set($this->request->data);
						$this->request->data['Cart_detail']['user_id'] = $user_id;
						$this->request->data['Cart_detail']['product_id'] = $id;
						$this->request->data['Cart_detail']['quantity'] = $quantity;
						$remaining_quntity = $totalquantity - $quantity;
						//$this->Product->saveField("quantity", $remaining_quntity);
						$this->Product->query("UPDATE products set quantity = '".$remaining_quntity."' where id = '".$id."'");
						if($this->Cart_detail->save($this->request->data)){	
							$json_return['msg'] = "Successfully added to cart";
							$json_return['code'] = "1011";
							//$json_return['message'] = ER1011;
							echo json_encode($json_return);
							exit;
						}else{
							$json_return['err'] = "invalid data";
							$json_return['code'] = "1002";
							//$json_return['message'] = ER1002;
							echo json_encode($json_return);
							exit;
						}	
					}else{
							$json_return['code'] = "1013";
							$json_return['message'] = "Sorry! :( quantity is not available that you entered ";
							echo json_encode($json_return);
							exit;
					}
			}
			//pr($product);exit;	
		}else{
			      $json_return['err'] = "invalid request";
			      $json_return['code'] = "1002";
			     //$json_return['message'] = ER1002;
			      echo json_encode($json_return);
			      exit;
		     }
	}
	
	public function view_cart(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$user_id = $this->request->data['user_id'];
		    $carddetail = $this->Cart_detail->find("all",array("conditions" => array("Cart_detail.user_id" => $user_id)));
			//pr($carddetail);exit;
			$id = array();
			$i = 0;
			//pr($card);exit;	
			foreach($carddetail as $card){
				$id[$i] = $card['Product']['id'];
				$i++;
			}
			//pr($id);exit;
            $product = $this->Product->find("all",array("conditions" => array("Product.id"=>$id)));
			//pr($product);exit;
			$data = array();
			$i = 0;
			foreach($product as $prod){
				if(isset($prod['Gallery'][0])){
					$img = $prod['Gallery'][0]['images'];
				}else{
					$img = "";	
				}
				$data[$i]['name'] = $prod['Product']['product_name'];
				$data[$i]['quantity'] = $carddetail[$i]['Cart_detail']['quantity'];
				$data[$i]['image'] =  $img;
				$i++;
			}
			//pr($data);exit;
			echo json_encode($data); 
			exit;
			
		}else{
			      $json_return['err'] = "invalid request";
			      $json_return['code'] = "1002";
			     //$json_return['message'] = ER1002;
			      echo json_encode($json_return);
			      exit;
		}
    }
	
	public function clear_cart(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$user_id = $this->request->data['user_id'];
			$product_id = $this->request->data['product_id'];
			if($this->request->data){
				$this->Cart_detail->query("DELETE FROM cart_details WHERE user_id = '".$user_id."' AND product_id = '".$product_id."'");
				$json_return['msg'] = "success";
			    $json_return['code'] = "1000";
			   //$json_return['message'] = ER1000;
			    echo json_encode($json_return);
			    exit;
			}else{
				$json_return['err'] = "invalid data";
			    $json_return['code'] = "1002";
			    //$json_return['message'] = ER1002;
			    echo json_encode($json_return);
			    exit;
			}
		}else{
			$json_return['err'] = "invalid request";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}
	}
	
	public function request_for_code(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$user_id = $this->request->data['user_id'];
			$carddetail = $this->Cart_detail->find("all",array("conditions" => array("Cart_detail.user_id" => $user_id)));
			//pr($carddetail);
			$ordernumber = md5($user_id.time());
			$data = array();
			$pid = array();
			$i= 0;
			foreach($carddetail as $card){
				//pr($card);
				$product_id[$i] = $card['Cart_detail']['product_id'];
				$data['Order']['user_id'] = $card['Cart_detail']['user_id'];
				$data['Order']['status'] = "Pending";
				$data['Order']['ordernumber'] = $ordernumber;
				$i++;
			}	
			//pr($product_id);exit;
			if($this->Order->saveAll($data)){
				$json_return['msg'] = "Request successfull";
			    $json_return['code'] = "1000";
			    //echo json_encode($json_return);
				$order= $this->Order->find("first",array("conditions" => array("Order.user_id" => $user_id)));
			    //pr($order);exit;
			    $this->Product->recursive = 1;
				$Product= $this->Product->find("all",array("conditions" => array("Product.id" => $product_id)));
				//pr($Product);exit;
				$orderdetail = array();
				$i=0;$k=0;
				foreach($Product as $prod){
					$orderdetail[$i]['Orderdetail']['order_id'] = $order['Order']['id'];
					$orderdetail[$i]['Orderdetail']['product_id'] = $prod['Product']['id'];
					$cardquantity = $this->Cart_detail->find("first",array("conditions" => array("Cart_detail.user_id" => $user_id,"Cart_detail.product_id" =>$prod['Product']['id'])));
					//pr($cardquantity['Cart_detail']['quantity']);
					$orderdetail[$i]['Orderdetail']['quantity'] =$cardquantity['Cart_detail']['quantity'] ;
					$i++;
				}
				
				//pr($orderdetail);exit;
				if($this->Orderdetail->saveAll($orderdetail)){
					$json_return['msg'] = "successfully placed order";
					$json_return['code'] = "1000";
					echo json_encode($json_return);
					$this->Cart_detail->query("DELETE FROM cart_details WHERE user_id = '".$user_id."'");
					exit;
				}else{
					$json_return['err'] = "internal error";
					$json_return['code'] = "1017";
					//$json_return['message'] = ER1017;
					echo json_encode($json_return);
					exit;
			    }    
			}else{
				$json_return['err'] = "order has nothing for saved";
				$json_return['code'] = "1017";
				//$json_return['message'] = ER1017;
				echo json_encode($json_return);
				exit;
			}
		}else{
			$json_return['err'] = "invalid request";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}	
	}
	
	
}

>>>>>>> develop:WebservicesController.php
