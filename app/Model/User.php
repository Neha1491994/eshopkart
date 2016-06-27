<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	var $name='User';
<<<<<<< HEAD
=======
	public $hasMany = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'user_id'
        ),
	);
>>>>>>> develop
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
		
<<<<<<< HEAD
        'birthday' => array(
            'rule' => 'date',
            'message' => 'Enter a valid date',
=======
        'mobile' => array(
            'rule' => 'number',
            'message' => 'Enter a valid number',
>>>>>>> develop
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
<<<<<<< HEAD

		if(!empty($email)){
=======
        //pr($email);
		if(!empty($email)){
			//pr($email);
>>>>>>> develop
			if($this->data[$this->alias]['id'] == $email['User']['id']){
				return true; 
			}else{
				return false; 
			}
		}else{
			return true; 
		}
    }
<<<<<<< HEAD
=======
	
	public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
         
        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }
     
        // fallback to our parent
        return parent::beforeSave($options);
    }
>>>>>>> develop


}

?>