<?php 
/*
	*Model to handle data modifications and fetches related to Admin model(table)
*/
App::uses('AuthComponent', 'Controller/Component');
class Webservice extends AppModel {
	var $name='Webservice';
	var $useTable = "admins";
	
	public $validate = array(      
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'required' => true,
				'message' => 'Invalid email'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'required' => true,
				'message' => 'This email has already been taken.'
			)  
        )			
    );
	
	
	
	
}//End-class
?>