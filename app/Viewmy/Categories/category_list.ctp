<div class="users form">
<h1>Category <?php echo $this->Html->link("Add New Category",   array('action'=>'add') );?></h1>
<table>
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
			<td><?php echo $this->Html->link( $Category['Category']['category_name']  ,   array('action'=>'edit', $Category['Category']['id']),array('escape' => false) );?></td>
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
<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
<?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?>
<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>				
<?php echo $this->Html->link( "Add A New User.",   array('action'=>'add'),array('escape' => false) ); ?>
<br/>
<?php echo $this->Html->link( "Category",   array('controller'=>'categorys','action'=>'category_list'),array('escape' => false) ); ?>
<br/>
<?php echo $this->Html->link( "Add A New Product.",   array('controller'=>'products','action'=>'add'),array('escape' => false) ); ?>
<br/>
<?php 
echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
?>