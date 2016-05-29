<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	var $name='User';
	public $validate = array(
        'password' => array(
            'rule' => array('minLength', '6'),
            'message' => 'Minimum 6 characters long'
        ),
		'confirm_password' => array(
            'rule'      => array('validate_passwords'),
			'message' => 'The passwords you entered do not match.',
        ),
		
        'email' => array(
			'required' => array(
				'rule' => array('email', true),    
				'message' => 'Please provide a valid email address.'    
			),
			 'unique' => array(
				'rule'    => array('isUniqueEmail'),
				'message' => 'This email is already in use'
			)	
		),
		
        'birthday' => array(
            'rule' => 'date',
            'message' => 'Enter a valid date',
            'allowEmpty' => true
        )
    );
	public function validate_passwords() {
		return ($this->data['User']['password'] === $this->data['User']['confirm_password']);
	}
	
	function isUniqueEmail($check) {

		$email = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id'
				),
				'conditions' => array(
					'User.email' => $check['email']
				)
			)
		);

		if(!empty($email)){
			if($this->data[$this->alias]['id'] == $email['User']['id']){
				return true; 
			}else{
				return false; 
			}
		}else{
			return true; 
		}
    }


}

?>