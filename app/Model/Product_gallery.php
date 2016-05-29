<?php
class Product_gallery extends AppModel {
	var $name='Product_gallery';
	public $belongsTo = array(
        'Product' => array(
            'className' => 'Product_gallery',
            'foreignKey' => 'product_id'
        )
	);
	
	
	}
?>