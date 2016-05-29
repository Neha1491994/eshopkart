
<div class="users form">
<?php echo $this->Form->create('Category'); ?>
    <fieldset>
        <legend><?php echo __('Edit Category'); ?></legend>
        <?php 
		echo $this->Form->hidden('id', array('value' => $this->data['Category']['id']));
		echo $this->Form->input('category_name', array( 'readonly' => 'readonly', 'label' => 'Category name cannot be changed!'));
		echo $this->Form->input('description');
		

		//echo $this->Form->input('role', array(
        //   'options' => array( 'king' => 'King', 'queen' => 'Queen', 'rook' => 'Rook', 'bishop' => 'Bishop', 'knight' => 'Knight', 'pawn' => 'Pawn')
        //));
		echo $this->Form->submit('Edit Category', array('class' => 'form-submit',  'title' => 'Click here to add the Category') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php 
echo $this->Html->link( "Return to Dashboard",   array('action'=>'category_list') ); 
?>
<br/>
<?php 
echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
?>