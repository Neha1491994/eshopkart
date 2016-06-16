<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<div>
<div class="contant-name"><b>Add <?php if($this->Session->check('categ')){
	$categ = $this->Session->read('categ');
}
 if($this->Session->check('type')){echo "Subcategory : ".$this->Session->read('categ');}else{echo "Category : ";}?></b></div>
<?php echo $this->Form->create('Category');?>
    <fieldset>
        
        <?php echo $this->Form->input('category_name');
		echo $this->Form->input('description');
//        echo $this->Form->input('role', array(
  //          'options' => array( 'king' => 'King', 'queen' => 'Queen', 'rook' => 'Rook', 'bishop' => 'Bishop', 'knight' => 'Knight', 'pawn' => 'Pawn')
   //     ));
		
		echo $this->Form->submit('Add Category', array('class' => 'form-submit',  'title' => 'Click here to add the user') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>

