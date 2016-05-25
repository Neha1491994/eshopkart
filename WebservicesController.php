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
			$token = md5($find_user['User']['email'].time());
			//pr($token);exit;
			$this->User->saveField("token_id", $token);
			$find_user['Admin']['token_id'] = $token;
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
				//pr($find_user);exit;
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
            $user = $this->User->find("all",array("conditions" => array("User.token_id" =>$user_id)));
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
		 $this->request->data['Category']['category_name'] = $this->request->data['category_name'];
		 $category_name = $this->request->data['Category']['category_name'];
		 if($category_name)
		 {
			 $category_details = $this->Category->find('first',array("conditions" =>array('Category.category_name'=>$category_name)));
			 //pr($category_details);exit;
			 if($category_details){
			 $id = $category_details['Category']['id'];
			 $subcategory_details = $this->Category->find('all',array("conditions" =>array('Category.parent_id'=>$id)));
			 //pr($subcategory_details);exit;
			 $subcate = array();
			 $i=0;
			 foreach($subcategory_details as $subcategory)
			 {
			    $subcate[$i] =  $subcategory['Category']['category_name'];
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
	
	public function select_subcategory(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			 $this->request->data['Category']['category_name'] = $this->request->data['category_name'];
			  $subcategory_name = $this->request->data['Category']['category_name'];
			  //pr($subcategory_name);exit;
		 if($subcategory_name)
		 {
			 $subcategory_details = $this->Category->find('first',array("conditions" =>array('Category.category_name'=>$subcategory_name)));
			 //pr($category_details);exit;
			 if($subcategory_details){
			 $id = $subcategory_details['Category']['id'];
			 $this->Product->recursive =2;
			 //$product_category = $this->Category->find('all',array("conditions" =>array('Category.parent_id'=>$id)));
			 $product_category = $this->Product->find('all',array("conditions" =>array('Product.category_id'=>$id)));
			 //pr($product_category);exit;
			 $subcate = array();
			 $id = array();
			 $i=0;$k = 0;
			 foreach($product_category as $Product)
			 {
			    $subcate[$i]['name'] =  $Product['Product']['product_name'];
				$subcate[$i]['image'] =  $Product['Product_gallery'][$k]['images'];
				//$subcate[$i]['special_price'] =  $Product['Price']['total_ammount'];
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
			$product = $this->Product->find("first",array("condition"=>array("Product.id"=>$id)));
			$carddetail = $this->Cart_detail->find("all",array("conditions"=>array("Cart_detail.product_id"=>$id, "Cart_detail.user_id"=>$user_id)));
			//pr($carddetail);exit;
			//foreach($carddetail as $card){
			//pr($card);exit;
			if($carddetail){
			        pr("This product is available in your cart");
					exit;
			}else{
			if(isset($this->request->data) && $user_id!= ""){
				    $this->Cart_detail->set($this->request->data);
					$this->request->data['Cart_detail']['user_id'] = $user_id;
					$this->request->data['Cart_detail']['product_id'] = $id;
					$this->request->data['Cart_detail']['quantity'] = $quantity;
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
			$data[$i]['name'] = $prod['Product']['product_name'];
			$data[$i]['price'] = $prod['Price']['ammount'];
			$data[$i]['quantity'] = $prod['Cart_detail'][$i]['quantity'];
			$data[$i]['color'] = $prod['Product']['colour'];
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
	
	
}

