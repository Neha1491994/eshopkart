<?php
class Product extends AppModel {
	var $name='Product';
	
	 public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
			'foreignKey' => 'category_id'
        )
		    
    );
	
	/*public $hasOne = array(
        'Price' => array(
            'className' => 'Price',
            'foreignKey' => 'products_id'
        )
    );*/
	
	public $hasMany = array(
        'Cart_detail' => array(
            'className' => 'Cart_detail',
            'foreignKey' => 'product_id'
        ),
		
		'Gallery' => array(
            'className' => 'Gallery',
            'foreignKey' => 'product_id'
        )
		
    );
	}
?>