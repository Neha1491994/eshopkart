


<?php
echo $this->element('common/left_menu');
?>
<div class="templatemo-content">
        
			
<div class="contant-name"><b>Add <?php if($this->Session->check('categ')){
	$categ = $this->Session->read('categ');
}
 if($this->Session->check('type')){echo "Subcategory : ".$this->Session->read('categ');}else{echo "Category : ";}?></b></div>	
	

 <div class="row">
     <div class="col-md-12">
<?php echo $this->Form->create('Category',array('controller'=>'category','action'=>'add','novalidate'=>true));?>
    
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
				<?php echo $this->Form->input('Admin.id', array('type' => 'hidden')); ?>
                  <button class="btn btn-primary" type="submit">Add Category</button>
                  <button class="btn btn-default" onClick="history.back(0);">Cancel</button>    
                </div>
              </div>
  
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>


