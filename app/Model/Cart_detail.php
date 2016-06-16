<?php
class Cart_detail extends AppModel {
	var $name='Cart_detail';
	public $belongsTo = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id'
        )
	);
	
	
	}
?>