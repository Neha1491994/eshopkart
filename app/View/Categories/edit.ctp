<<<<<<< HEAD

<div class="users form">
<?php echo $this->Form->create('Category'); ?>
    <fieldset>
        <legend><?php echo __('Edit Category'); ?></legend>
        <?php 
		echo $this->Form->hidden('id', array('value' => $this->data['Category']['id']));
		echo $this->Form->input('category_name' 
		//array( 'readonly' => 'readonly', 'label' => 'Category name cannot be changed!')
		);
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
=======
<?php echo $this->Html->script('ckeditor/ckeditor.js');
	$edit = false;
	//pr($this->request->data);exit;
	if(isset($this->request->data['Product']['id'])){
		$edit = true;
	}
?>
<?php
echo $this->element('common/left_menu');
?>
<div class="templatemo-content">
        
					
			
<div class="contant-name"><b>Edit Category: <?php if($this->Session->check('categ')){
	$categ = $this->Session->read('categ');
}
 if($this->Session->check('type')){echo $this->Session->read('categ');}?></b></div>	
	

 <div class="row">
     <div class="col-md-12">
<?php echo $this->Form->create('Category',array('controller'=>'category','action'=>'edit','novalidate'=>true));?>
    
       <div class="row">
       <div class="col-md-6 margin-bottom-15">
				  <label class="control-label" for="AdminType">Category Name</label>
				  <?php echo $this->Form->input('Category.category_name',array('class'=>'form-control', 'div' => '', 'label' => '',));?>
		</div>
	    </div>	
		
		<div class="row">
       <div class="col-md-6 margin-bottom-15">
                    <label for="AdminPassword">Description</label>
                    <?php //$this->Ck->input('Admin.description', array('div' => '','label' => ''));
					echo $this->Form->textarea('Category.description',array('class'=>'form-control', 'div' => '', 'label' => '',)); ?>  
                  </div>
         </div>		
  
 <div class="row templatemo-form-buttons">
                <div class="col-md-12">
				<?php echo $this->Form->input('Category.id', array('type' => 'hidden')); ?>
                  <button class="btn btn-primary" type="submit" >Edit Category</button>
                  <button class="btn btn-default" onClick="history.back(0);">Cancel</button>    
                </div>
              </div>
  
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>


>>>>>>> develop
