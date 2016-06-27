<div>
<?php
echo $this->element('common/left_menu');
<<<<<<< HEAD
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
=======
?>
</div>
<div class="templatemo-content">
<div class="contant-name"><b>Add <?php if($this->Session->check('categ')){
	$categ = $this->Session->read('categ');
}
 if($this->Session->check('type')){echo "Subcategory : ".$this->Session->read('categ');}else{echo "Category : ";}?></b></div>
 <div class="row">
     <div class="col-md-12">
	 
 <?php echo $this->Form->create('Category');?>
   
         <div class="row">
       <div class="col-md-6 margin-bottom-15">
	   <label class="control-label" for="AdminType">Category Name</label>
        <?php echo $this->Form->input('category_name',array('class'=>'form-control', 'div' => '', 'label' => '',));?>
		</div>
	    </div>	
		
		<div class="row">
       <div class="col-md-6 margin-bottom-15">
	    <label for="AdminPassword">Description</label>
		<?php echo $this->Form->input('description',array('class'=>'form-control', 'div' => '', 'label' => '',));?>
		</div>
	    </div>
		
		
		 <div class="row templatemo-form-buttons">
                <div class="col-md-12">
				<?php echo $this->Form->input('Admin.id', array('type' => 'hidden')); ?>
                  <button class="btn btn-primary" type="submit">Add Category</button>
                  <button class="btn btn-default" onClick="history.back(0);">Cancel</button>    
                </div>
              </div>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>

>>>>>>> develop
