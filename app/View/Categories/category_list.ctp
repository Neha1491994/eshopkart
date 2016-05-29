<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<div class="row margin-bottom-30">
<div class="table-responsive">
<div class="contant-name"><b>Categories:</b></div> <div class="contant-tag"> <?php echo $this->Html->link("Add New Category",   array('action'=>'add') );?> </div><br/>
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
		<?php foreach($categorys as $Category): ?>				
		<?php $count ++;?>
		<?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
		<?php endif; ?>
			<td><?php echo $this->Form->checkbox('Category.id.'.$Category['Category']['id']); ?></td>
			<td><?php echo $this->Html->link( $Category['Category']['category_name']  ,   array('action'=>'subcategory_list', $Category['Category']['id']),array('escape' => false) );?></td>
			<td style="text-align: center;"><?php echo $Category['Category']['description']; ?></td>
			
			<td >
			<?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $Category['Category']['id']) ); 
			      echo $this->Html->link(    "Delete", array('action'=>'category_delete', $Category['Category']['id']));
				  echo $this->Html->link(    "Add Subcetagary", array('action'=>'add', $Category['Category']['id']));
			?>  
		
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($Category); ?>
	</tbody>
</table>
</div>	
<ul class="pagination pull-right">
			  <?php echo $this->Paginator->prev('«',array('tag' => 'li'),null,array('tag' => 'li','class' => 'disabled'));
					echo $this->Paginator->numbers();
					echo $this->Paginator->next('»',array('tag' => 'li'),null,array('class' => 'disabled'));
					?>			
              </ul>
</div>
