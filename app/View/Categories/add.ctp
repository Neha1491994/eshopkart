<div>
<?php
echo $this->element('common/left_menu');
//row margin-bottom-30

?>
</div>
<div class="form">

<?php echo $this->Form->create('Category');?>
    <fieldset>
        <legend><?php 
		echo __('Add Category'); ?></legend>
        <table><tr><td><?php echo $this->Form->input('category_name');?></td>
		           <td><?php echo $this->Form->input('description');?></td></tr>
                    
		    <tr><td><?php echo $this->Form->submit('Add Category', array('class' => 'form-submit',  'title' => 'Click here to add the user') ); ?></td></tr>
		</table>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php /*
if($this->Session->check('Auth.User')){
echo $this->Html->link( "Return to Dashboard",   array('controller'=>'users','action'=>'index') ); 
echo "<br>";
echo $this->Html->link( "Logout",   array('controller'=>'users','action'=>'logout') ); 
}else{
echo $this->Html->link( "Return to Login Screen",   array('controller'=>'users','action'=>'login') ); 
}*/
?>
</div>