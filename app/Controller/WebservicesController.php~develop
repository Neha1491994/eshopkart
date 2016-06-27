<?php 
class WebservicesController extends AppController {
	//Specify View folder
	var $name     = 'Webservices';
	// Specify models and tabel
	var $uses = array('Category','User','Product','Webservice','Cart_detail','Order','Orderdetail','Page');
	var $components = array('Session','RequestHandler');
	var $helper = ('Session');
	
# function checks individually if the admin/user's function required login or not.
	public function beforeFilter() {
		$this->Auth->allow();		
    }
	
	public function verification(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$email = $this->request->data['email'];
			if($email =="" || $email ==null){
				$json_return['code'] = "1006";
				//$json_return['message'] = ER1006;
				$json_return['message'] = "Please enter valid email id ";
				echo json_encode($json_return);
				exit;
			}else{
				$find_user = $this->User->find("first", array("conditions" => array("User.email" => $email)));
				//pr($find_user);
				if(!$find_user){
					$json_return['code'] = "1006";
					$json_return['message'] = "Please enter valid email id ";
					echo json_encode($json_return);
					exit;
				}else{
					$code = mt_rand(100000,999999);
					//pr($code);
					$this->User->id = $find_user['User']['id'];
					$this->User->saveField("code", $code);
					$this->sendMail($email, 'Verify your account','verificationcode', array('title_for_layout' =>'Welcome to eShopkart', "code"=>$code));
					//$json_return = json_encode($code);
					$json_return['message'] = "OTP send successfully";
					$json_return['code'] = "1000"; 
					$find_user['OTP'] = $code;
					echo json_encode($find_user);
					exit;
                }
			}	
		}
	}
	
	public function login_user(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			$username = $this->request->data['email'];
			$password = $this->request->data['password'];
			$find_user = array();
			$find_user = $this->User->find('first', array("conditions" => array("User.email" => $username,"User.password"=>AuthComponent::password($password))));
			//pr($find_user);exit;
			if($find_user){
				$this->User->id = $find_user['User']['id'];	
				$token = md5($find_user['User']['email'].time());
				//pr($token);exit;
				$this->User->saveField("token_id", $token);
				$this->User->saveField("status",1);
				$find_user['User']['token_id'] = $token;
				$find_user['User']['change_token_id'] = $token;
				//$find_user = $this->User->find('first', array("conditions" => array("User.email" => $username)));
				//pr($find_user);exit;
				$json_return = json_encode($find_user);
			}else{
				$message_array = array();
				$message_array['message'] = "Invalid user or password";
				$message_array['code'] = "1003";
				//$message_array['message'] = ER1003;
				$json_return = json_encode($message_array);
			}
			    echo $json_return;
			    exit;
		}else{	
			$json_return['message'] = "Invalid data";
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
				$json_return['message'] = "Please enter valid email id and password";
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
					$this->request->data['User']['password'] = $password;
					$this->request->data['User']['mobile'] = $mobile;
					$exist = $this->User->find("count", array("conditions" => array("User.email" => $email)));
					//pr($exist);exit;
					if($exist == 0){
						if($this->User->save($this->request->data)){				
							$lastInsertedId = $this->User->id;
							$token = md5($lastInsertedId.time());
							//$this->User->id = $find_user['User']['id'];
							$userDetail = $this->User->find("first", array("conditions" => array("User.id" => $lastInsertedId)));
							//pr($userDetail);exit;
							$token = md5($userDetail['User']['email'].time());
							$userDetail['User']['token_id'] = $token;
							$this->User->id = $userDetail['User']['id'];
							$this->User->saveField("token_id", $token);
							//signup mail
							$this->sendMail($userDetail['User']['email'], 'Welcome to eshopkart', 'welcome', array('title_for_layout' =>'Welcome to eShopkart'));
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
						$json_return['message'] = "email already registered";
						echo json_encode($json_return);
						exit;
					}
				}else{
					$json_return['code'] = "1042";
					//$json_return['message'] = ER1042;
					$json_return['message'] = "Please enter valid and unique email id";
					echo json_encode($json_return);
					exit;
				}			
			}
		}else{	
			$json_return['message'] = "invalid data";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}
		
	}
	
	public function change_password() {
		$json_return = array();
		$token    = $this->request->data['token_id'];
		$newpassword = $this->request->data['password'];
		$code   = $this->request->data['otp'];
		if($token == ""){
				$json_return['code'] = "1001";
				//$json_return['message'] = ER1001;
			    $json_return['message'] = "Invalid token";			
		}else{
				$find_user = array();
				$find_user = $this->User->find("first", array("conditions" => array("User.token_id" => $token)));
				//pr($find_user);
					if($find_user['User']['code'] == $code){
						//echo $find_user['User']['id'];
						$this->User->id = $find_user['User']['id'];
						$this->User->saveField("password",$newpassword);
						$json_return['msg'] = "Password changes successfully";
						$json_return['code'] = "1000";
						//$json_return['message'] = ER1000;
					}else{
						$json_return['code'] = "1003";
						$json_return['message'] = "invalid OTP";
						//$json_return['message'] = ER1003;
						echo json_encode($json_return);
						exit;
				   }
				}   
		echo json_encode($json_return);
		exit;
	}
	
	public function forgetpassword() {
		$json_return = array();
		$email = $this->request->data['email'];
		$password = $this->request->data['password'];
			if($email == ""){
					$json_return['code'] = "1006";
					//$json_return['message'] = ER1042;
					$json_return['message'] = "Invalid email";			
			}else{
					$find_user = array();
					$find_user = $this->User->find("first", array("conditions" => array("User.email" => $email)));
					//pr($find_user);
						if($find_user){
							//$find_user['User']['id'];
							$this->User->set($this->request->data);
							if($this->User->validates(array('fieldList' => array('password')))){
								$this->User->id = $find_user['User']['id'];
								$this->User->saveField("password",$password);
								$json_return['message'] = "password change successfully";
								$json_return['code'] = "1000";
								echo json_encode($find_user);
								exit;
							}else{
								$json_return['code'] = "1003";
								$json_return['message'] = "password should be 6 character long";
								echo json_encode($json_return);
								exit;
							}
						}else{
							$json_return['code'] = "1003";
							$json_return['message'] = "internal error";
							//$json_return['message'] = ER1003;
							echo json_encode($json_return);
							exit;
						}
			}		   
		echo json_encode($json_return);
		exit;
	}
	
	public function check_otp() {
		$json_return = array();
		$code   = $this->request->data['otp'];
		$email  = $this->request->data['email'];
				$find_user = array();
				$find_user = $this->User->find("first", array("conditions" => array("User.code" => $code,"User.email" => $email)));
				//pr($find_user);
					if($find_user){
						//echo $find_user['User']['id'];
						//$this->User->id = $find_user['User']['id'];
						//$this->User->saveField("password",$newpassword);
						$json_return['message'] = "correct otp";
						$json_return['code'] = "1000";
						echo json_encode($find_user);
						exit;
						//$json_return['message'] = ER1000;
					}else{
						$json_return['code'] = "1003";
						$json_return['message'] = "invalid OTP or  invalid email";
						//$json_return['message'] = ER1003;
						echo json_encode($json_return);
						exit;
				    }		   
		echo json_encode($json_return);
		exit;
	}
	
	public function user_logout(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {	
			$this->request->data['User']['token_id'] = $this->request->data['token_id'];
			$user_id = $this->request->data['User']['token_id'];
            $user = $this->User->find("first",array("conditions" => array("User.token_id" =>$user_id)));
            //pr($user);exit; 			
			if($user){	
				$this->User->id = $user['User']['id'];
				$this->User->saveField("token_id", "");
				$this->User->saveField("status",0);
				$json_return['code'] = "1000";
				//$json_return['message'] = ER1000;
				$json_return['msg'] = "logout successfully";
				echo json_encode($json_return);
				exit;
			}else{
				$json_return['message'] = "Invalid token";
				$json_return['code'] = "1001";
				//$json_return['message'] = ER1001;
				echo json_encode($json_return);
				exit;
			}
		}else{	
			$json_return['message'] = "invalid tokenid";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}
	}
	
	public function get_categories()
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
			      $json_return['message'] = "invalid data";
			      $json_return['code'] = "1002";
			     //$json_return['message'] = ER1002;
			      echo json_encode($json_return);
			      exit;
		}
	}
	
	
	public function get_products(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			 $category_id = $this->request->data['category_id'];
			if($this->request->data)
			{
				$subcategory_details = $this->Category->find('list',array("conditions" =>array('Category.parent_id'=>$category_id)));
				$subcategory_details = $subcategory_details + array($category_id => $category_id);
				//pr($subcategory_details);exit;
				if($subcategory_details)
				{
					$this->Product->recursive = 1;
					$product_category = $this->Product->find('all',array("conditions" =>array('Product.category_id'=>$subcategory_details)));
					//pr($product_category);exit;
					$subcate = array();
					$id = array();
					$i=0;$k = 0;
					foreach($product_category as $Product)
                                       {
                                               
                                               $subcate[$i]['id'] =  $Product['Product']['id'];
                                               $subcate[$i]['colour'] =  $Product['Product']['colour'];
                                               $subcate[$i]['price'] =  $Product['Product']['unitprice'];
                                               $subcate[$i]['name'] =  $Product['Product']['product_name'];
                                               $subcate[$i]['status'] = $Product['Product']['status'];
                                               $subcate[$i]['product_description'] = $Product['Product']['product_description'];
                                               $subcate[$i]['Gallery'] =$Product['Gallery'];                                                
                                               $i++;
                                       }
					//pr($subcate);exit;
					echo json_encode($subcate); 
					exit;
				}else{
					$json_return['message'] = "this category id is not exist";
					$json_return['code'] = "1010"; 
					echo json_encode($json_return);
					exit;
				}
		    }else{
			      $json_return['message'] = "Please select any category";
			      $json_return['code'] = "1009"; 
			      echo json_encode($json_return);
			      exit;
		    }
		}else{
				$json_return['message'] = "invalid data";
				$json_return['code'] = "1002";
				//$json_return['message'] = ER1002;
				echo json_encode($json_return);
				exit;
		}
	}
	
	public function get_product_details(){
		$json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) {
			 $product_id = $this->request->data['product_id'];
			 $Product = $this->Product->find('first',array("conditions" =>array('Product.id'=>$product_id)));
				if($Product)
				{
					//pr($product);exit;
					$subcate = array();
					$subcate['id'] =  $Product['Product']['id'];
                    $subcate['colour'] =  $Product['Product']['colour'];
                    $subcate['price'] =  $Product['Product']['unitprice'];
                    $subcate['name'] =  $Product['Product']['product_name'];
                    $subcate['status'] = $Product['Product']['status'];
                    $subcate['product_description'] = $Product['Product']['product_description'];
                    $subcate['Gallery'] =$Product['Gallery']; 
					echo json_encode($subcate); 
					exit;
				}else{
					$json_return['message'] = "Product not found";
					$json_return['code'] = "1010"; 
					echo json_encode($json_return);
					exit;
				}
		}else{
				$json_return['message'] = "invalid data";
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
			//pr($product);exit;
			$carddetail = $this->Cart_detail->find("first",array("conditions"=>array("Cart_detail.product_id"=>$id, "Cart_detail.user_id"=>$user_id)));
			$totalunitsinstock = $product['Product']['unitsinstock'];
			$totalunitsonorder = $product['Product']['unitsonorder'];
			//pr($carddetail);exit;
			if($quantity <=  $totalunitsinstock){
				if($carddetail){
						$json_return['message'] = "quantity increase sucessfully";
						$json_return['code'] = "1002";
						$quantity_incart = $carddetail['Cart_detail']['quantity'] + $quantity;
						$this->Cart_detail->query("UPDATE cart_details set quantity = '".$quantity_incart."' where user_id = '".$user_id."' and product_id = '".$id."'");
						echo json_encode($json_return);	    
				}else{
					
						$this->Cart_detail->set($this->request->data);
						$this->request->data['Cart_detail']['user_id'] = $user_id;
						$this->request->data['Cart_detail']['product_id'] = $id;
						$this->request->data['Cart_detail']['quantity'] = $quantity;
						if($this->Cart_detail->save($this->request->data)){	
								$json_return['message'] = "Successfully added to cart";
								$json_return['code'] = "1011";
								//$json_return['mesage'Cart_detail] = ER1011;
								echo json_encode($json_return);
						}else{
								$json_return['message'] = "invalid data";
								$json_return['code'] = "1002";
								//$json_return['message'] = ER1002;
								echo json_encode($json_return);
								exit;
						}
						
				}	
					$remaining_quantity = $totalunitsinstock - $quantity;
					$order_quantity =  $totalunitsonorder + $quantity;
					$this->Product->query("UPDATE products set unitsinstock = '".$remaining_quantity."', unitsonorder = '".$order_quantity."' where id = '".$id."'");
					exit;				
			}else{
				$json_return['code'] = "1013";
				$json_return['message'] = "out of stock ";
				echo json_encode($json_return);
				exit;
			}	
		}else{
			    $json_return['message'] = "invalid request";
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
			$this->Cart_detail->recursive = 2;
		    $carddetail = $this->Cart_detail->find("all",array("conditions" => array("Cart_detail.user_id" => $user_id)));
			//pr($carddetail);exit;
			$data = array();
			$i = 0;
			foreach($carddetail as $prod){
				//pr($prod);exit;
				if(isset($prod['Product']['Gallery'][0])){
					$img = $prod['Product']['Gallery'][0]['images'];
				}else{
					$img = "";	
				}
					$data[$i]['id'] = $prod['Product']['id'];
					$data[$i]['name'] = $prod['Product']['product_name'];
					$data[$i]['product_number'] = $prod['Product']['product_number'];
					$data[$i]['description'] = $prod['Product']['product_description'];
					$data[$i]['colour'] = $prod['Product']['colour'];
					$data[$i]['unitprice'] = $prod['Product']['unitprice'];
					$data[$i]['status'] = $prod['Product']['status'];
					$data[$i]['quantity'] = $prod['Cart_detail']['quantity'];
					$data[$i]['image'] =  $img;
					$i++;
			}
			//pr($data);exit;
			echo json_encode($data); 
			exit;	
		}else{
			      $json_return['message'] = "invalid request";
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
			$carddetail = $this->Cart_detail->find("all",array("conditions" => array("Cart_detail.user_id" => $user_id)));
			if($carddetail){
					if(isset($this->request->data['product_id']) && $this->request->data['product_id'] != ""){
							$product_id = $this->request->data['product_id'];
							$carddetail = $this->Cart_detail->find("first",array("conditions" => array("Cart_detail.user_id" => $user_id,"Cart_detail.product_id" => $product_id)));
							$quantity = $carddetail['Cart_detail']['quantity'];
							$unitinstock = $carddetail['Product']['unitsinstock'] + $quantity; 
							$unitonorder = $carddetail['Product']['unitsonorder'] - $quantity;
							$this->Product->query("UPDATE products set unitsinstock = '".$unitinstock."', unitsonorder = '".$unitonorder."' where id = '".$product_id."'");
							$this->Cart_detail->query("DELETE FROM cart_details WHERE user_id = '".$user_id."' AND product_id = '".$product_id."'");
					}else{
								
							foreach($carddetail as $card){
									$product_id = $card['Product']['id'];
									$quantity = $card['Cart_detail']['quantity'];
									$unitinstock = $card['Product']['unitsinstock'] + $quantity; 
									$unitonorder = $card['Product']['unitsonorder'] - $quantity;
								    $this->Product->query("UPDATE products set unitsinstock = '".$unitinstock."', unitsonorder = '".$unitonorder."' where id = '".$product_id."'");	
							}
							$this->Cart_detail->query("DELETE FROM cart_details WHERE user_id = '".$user_id."'");
					}
					$json_return['message'] = "you have successfully clear your cart";
					$json_return['code'] = "1000";
					//$json_return['message'] = ER1000;
					echo json_encode($json_return);
					exit;
			}else{
				$json_return['message'] = "You have no product in your cart";
			    $json_return['code'] = "1002";
			    //$json_return['message'] = ER1002;
			    echo json_encode($json_return);
			    exit;
			}
		}else{
			$json_return['message'] = "invalid request";
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
				$token_id = $this->request->data['token_id'];
				$userDetail = $this->User->find("first", array("conditions" => array("User.token_id" => $token_id)));
				$user_id = $userDetail['User']['id'];
				//$ordernumber = md5($user_id.time());
				$ordernumber = mt_rand(10000000,99999999);
			if(isset($this->request->data['product_id']) && $this->request->data['product_id'] != ""){
					$product_id = $this->request->data['product_id'];
					$prod = $this->Product->find("first",array("conditions" => array("Product.id" => $product_id)));
					$totalunitsinstock = $prod['Product']['unitsinstock'];
					//pr($prod);
					if($prod['Product']['unitsinstock']>0){
							$data['Order']['user_id'] = $user_id;
							$data['Order']['status'] = "Pending";
							$data['Order']['ordernumber'] = $ordernumber;
							//pr($data);
							if($this->Order->saveAll($data)){
									$json_return['msg'] = "Request successfull";
									$json_return['code'] = "1000";
									$order= $this->Order->find("first",array("conditions" => array("Order.ordernumber" =>$ordernumber)));
									$orderdetail['Orderdetail']['order_id'] = $order['Order']['id'];
									$orderdetail['Orderdetail']['product_id'] = $prod['Product']['id'];
									$orderdetail['Orderdetail']['quantity'] =1;
									//pr($orderdetail);exit;
									$unitinstock = $prod['Product']['unitsinstock'] - 1; 
									$unitonorder = $prod['Product']['unitsonorder'] + 1;
									//pr($product_id);exit;
									$this->Product->query("UPDATE products set unitsinstock = '".$unitinstock."', unitsonorder = '".$unitonorder."' where id = '".$product_id."'");
							}
					}else{
							$json_return['code'] = "1013";
							$json_return['msg'] = "out of stock ";
							echo json_encode($json_return);
							exit;
					}
			}else{
					$carddetail = $this->Cart_detail->find("all",array("conditions" => array("Cart_detail.user_id" => $user_id)));
					//pr($carddetail);exit;
					$data = array();
					$product_id = array();
					$i= 0;
					foreach($carddetail as $card){
							//pr($card);
							$product_id[$i] = $card['Cart_detail']['product_id'];
							$data['Order']['user_id'] = $card['Cart_detail']['user_id'];
							$data['Order']['status'] = "Pending";
							$data['Order']['ordernumber'] = $ordernumber;
							$i++;
					}	
					//pr($product_id);
					if($this->Order->saveAll($data)){
							$order= $this->Order->find("first",array("conditions" => array("Order.ordernumber" =>$ordernumber)));
							$this->Product->recursive = 1;
							$Product= $this->Product->find("all",array("conditions" => array("Product.id" => $product_id)));
							$this->Cart_detail->query("DELETE FROM cart_details WHERE user_id = '".$user_id."'");
							//pr($Product);exit;
							$orderdetail = array();
							$i=0;$k=0;
							foreach($Product as $prod){
							$orderdetail[$i]['Orderdetail']['order_id'] = $order['Order']['id'];
							$orderdetail[$i]['Orderdetail']['product_id'] = $prod['Product']['id'];
							$card_quantity = $this->Cart_detail->find("first",array("conditions" => array("Cart_detail.user_id" => $user_id,"Cart_detail.product_id" =>$prod['Product']['id'])));
							//pr($cardunitsinstock);exit;
							$orderdetail[$i]['Orderdetail']['quantity'] =$card_quantity['Cart_detail']['quantity'] ;
							$i++;
							}
					}else{
							$json_return['msg'] = "due to some internal error request not send";
							$json_return['code'] = "1017";
							//$json_return['message'] = ER1017;
							echo json_encode($json_return);
							exit;
					}
			}															
			if($this->Orderdetail->saveAll($orderdetail)){
					$json_return['msg'] = "Request is send successfully Please check your mail for get code";
					$json_return['code'] = "1000";
					echo json_encode($json_return);
					$this->sendMail($userDetail['User']['email'],'Request delievery mail', 'request_for_code', array('title_for_layout' =>'Request_for_code delievery mail',"ordernumber"=>$ordernumber));
					exit;
			}else{
					$json_return['msg'] = "internal error";
					$json_return['code'] = "1017";
					//$json_return['message'] = ER1017;
					echo json_encode($json_return);
					exit;
			}    
		}else{
			$json_return['msg'] = "invalid request";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}	
	}
	
	public function search() {
	    $json_return = array();		
		if ($this->request->is('post') || $this->request->is('put')) 
		{	
	        $keyword = $this->request->data('keyword');
			$search = $this->Product->query("SELECT * FROM products WHERE product_name LIKE '".$keyword."%' OR product_description LIKE '%".$keyword."%'");
			//$search[1] = $this->Category->query("SELECT * FROM categories WHERE category_name LIKE '".$keyword."%' OR description LIKE '%".$keyword." ! %' ESCAPE '!'");
			//pr($search);exit;
			if($search){
						$subcate = array();
						$i = 0;
						foreach($search as $Product){	
						//pr($product);exit;
											   $subcate[$i]['id'] =  $Product['products']['id'];
											  //$subcate[$i]['category_id'] =  $Product['products']['category_id'];
											   $subcate[$i]['name'] =  $Product['products']['product_name'];
                                               //$subcate[$i]['colour'] =  $Product['products']['colour'];
                                               //$subcate[$i]['price'] =  $Product['products']['unitprice'];
                                               //$subcate[$i]['status'] = $Product['products']['status'];
                                               //$subcate[$i]['product_description'] = $Product['products']['product_description'];
						$i++;
						}
						//pr($subcate);exit;
						echo json_encode($subcate);
						exit;
			}
			else{
				$json_return['message'] = "product not found due to some error";
				$json_return['code'] = "1014";
				//$json_return['message'] = ER1014;
				echo json_encode($json_return);
				exit;
			}
		}else{
			$json_return['message'] = "invalid request";
			$json_return['code'] = "1002";
			//$json_return['message'] = ER1002;
			echo json_encode($json_return);
			exit;
		}		
    }
}

