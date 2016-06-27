<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<<<<<<< HEAD
<div class="row margin-bottom-30">
<div class="table-responsive">
<div class="contant-name"><b>Subcategories:</b></div>
=======
<div class="templatemo-content">
 <div class="row margin-bottom-30">
            <div class="col-md-12">
<div class="contant-name"><b>Subcategories :<?php echo $this->Session->read('categ');?></b></div>

>>>>>>> develop
<table class="table table-striped table-hover table-bordered">
    <thead>
		<tr>
			<th><?php echo $this->Form->checkbox('all', array('category_name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
			<th><?php echo $this->Paginator->sort('category_name', 'Category Name');?>  </th>
			<th><?php echo $this->Paginator->sort('description', 'Description');?></th>
			
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>						
		<?php $count=0; ?>
		<?php //pr($categorys);exit;
		 foreach($categorys as $Category): ?>				
		<?php $count ++;?>
		<?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
		<?php endif; ?>
			<td><?php echo $this->Form->checkbox('Category.id.'.$Category['Category']['id']); ?></td>
			<td><?php echo $this->Html->link( $Category['Category']['category_name']  , array('controller' => 'Products', 'action'=>'product_list', $Category['Category']['id']),array('escape' => false) );?></td>
			<td style="text-align: center;"><?php echo $Category['Category']['description']; ?></td>
			
			<td >
<<<<<<< HEAD
			<?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $Category['Category']['id']) ); 
			      echo $this->Html->link(    "Delete", array('action'=>'category_delete', $Category['Category']['id']));
			?>  
		
=======
			 
		<div class="btn-group">
                          <button type="button" class="btn btn-info">Action</button>
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><?php echo $this->Html->link("Edit",array('action' => 'edit', $Category['Category']['id']));?></li>
                            <li><?php echo $this->Html->link("Delete",array('action' => 'category_delete', $Category['Category']['id']),null,'Are you sure you want to delete this Subcategory ?');?></li>
                          </ul>
                        </div>
>>>>>>> develop
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($Category); ?>
	</tbody>
</table>
<<<<<<< HEAD
</div>	
=======

>>>>>>> develop
<ul class="pagination pull-right">
			  <?php echo $this->Paginator->prev('«',array('tag' => 'li'),null,array('tag' => 'li','class' => 'disabled'));
					echo $this->Paginator->numbers();
					echo $this->Paginator->next('»',array('tag' => 'li'),null,array('class' => 'disabled'));
					?>			
              </ul>

</div>
<<<<<<< HEAD
=======

</div>
</div>
>>>>>>> develop
