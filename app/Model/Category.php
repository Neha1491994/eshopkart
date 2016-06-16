<?php
class Category extends AppModel {
	 var $name='Category';
	 public $primaryKey = 'id';
	 public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
			'foreignKey' => 'category_id'
        )
    );
	}
?>