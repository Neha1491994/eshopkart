<!-- app/View/Users/add.ctp -->
<div class="users form">

<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Add Product'); ?></legend>
        <?php echo $this->Form->input('type', array(
            'options' => array( 'ELECTRONICS' => 'Electronics', 'HOME & APPLIANCES' => 'Home & Application', 'LIFESTYLE' => 'Lifestyle', 'AUTOMOTIVE' => 'Automotive', 'BOOKS & MORE' => 'Books & More', 'DAILY NEEDS' => 'Daily Needs')
        ));
		 echo $this->Form->input('name');
		echo $this->Form->input('Product Number');
        echo $this->Form->input('Quantity');
        echo $this->Form->input('type', array(
            'options' => array( 'available' => 'Available','pending' => 'Pending')
        ));
		
		echo $this->Form->submit('Add Product', array('class' => 'form-submit',  'title' => 'Click here to add the product') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php 
if($this->Session->check('Auth.User')){
echo $this->Html->link( "Return to Dashboard",   array('controller'=>'users','action'=>'index') ); 
echo "<br>";
echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
}else{
echo $this->Html->link( "Return to Login Screen",   array('action'=>'login') ); 
}
?>