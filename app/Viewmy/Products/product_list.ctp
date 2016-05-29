<div class="users form">
<h1>Users</h1>
<table>
    <thead>
		<tr>
			<th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
			<th><?php echo $this->Paginator->sort('name', 'Name');?>  </th>
			<th><?php echo $this->Paginator->sort('type', 'Type');?></th>
			<th><?php echo $this->Paginator->sort('product_number', 'Product Number');?></th>
			<th><?php echo $this->Paginator->sort('quantity','Quantity');?></th>
			<th><?php echo $this->Paginator->sort('status','Status');?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>						
		<?php $count=0; ?>
		<?php foreach($products as $product): ?>				
		<?php $count ++;?>
		<?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
		<?php endif; ?>
			<td><?php echo $this->Form->checkbox('Product.id.'.$user['Product']['id']); ?></td>
			<td><?php echo $this->Html->link( $user['Product']['name']  ,   array('action'=>'edit', $user['Product']['id']),array('escape' => false) );?></td>
			<td style="text-align: center;"><?php echo $user['Product']['type']; ?></td>
			<td style="text-align: center;"><?php echo $user['Product']['product_number']; ?></td>
			<td style="text-align: center;"><?php echo $user['Product']['quantity']; ?></td>
			<td >
			<?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $user['Product']['id']) ); ?> | 
			<?php
				if( $user['User']['status'] != 0){ 
					echo $this->Html->link(    "Delete", array('action'=>'delete', $user['Product']['id']));}else{
					echo $this->Html->link(    "Re-Activate", array('action'=>'activate', $user['Product']['id']));
					}
			?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($user); ?>
	</tbody>
</table>
<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
<?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?>
<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>				
<?php echo $this->Html->link( "Add A New User.",   array('action'=>'add'),array('escape' => false) ); ?>
<br/>
<?php echo $this->Html->link( "Add A New Product.",   array('controller'=>'products','action' => 'add'),array('escape' => false) ); ?>
<br/>
<?php 
echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
?>