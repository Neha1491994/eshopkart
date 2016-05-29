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
		
		'Product_gallery' => array(
            'className' => 'Product_gallery',
            'foreignKey' => 'products_id'
        )
		
    );
	}
?>