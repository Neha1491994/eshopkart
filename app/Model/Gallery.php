<?php
class Gallery extends AppModel {
	var $name='Gallery';
	public $belongsTo = array(
        'Product' => array(
            'className' => 'Gallery',
            'foreignKey' => 'product_id'
        )
	);
	
	
	}
?>