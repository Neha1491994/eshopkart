<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<div class="row margin-bottom-30">
<div class="table-responsive">
<div class="contant-name"><b>Products:</b></div><div class="contant-tag"><?php echo $this->Html->link( "Add New Product",   array('controller'=>'products','action' => 'add'),array('escape' => false) ); ?>  </div><br/>
<table  class="table table-striped table-hover table-bordered">
    <thead>
		<tr>
			<th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
			<th><?php echo $this->Paginator->sort('product_name', 'Name');?>  </th>
			<th><?php echo $this->Paginator->sort('product_number', 'Product Number');?></th>
			<th><?php echo $this->Paginator->sort('quantity','Quantity');?></th>
			<th><?php echo $this->Paginator->sort('status','Status');?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>						
		<?php $count=0; ?>
		
		<?php foreach($products as $product): ?>
        <?php// pr($product);exit; ?>		
		<?php $count ++;?>
		<?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
		<?php endif; ?>
			<td><?php echo $this->Form->checkbox('Product.id'.$product['Product']['id']); ?></td>
			<td><?php echo $this->Html->link( $product['Product']['product_name']  ,   array('action'=>'edit', $product['Product']['id']),array('escape' => false) );?></td>
			<td style="text-align: center;"><?php echo $product['Product']['product_number']; ?></td>
			<td style="text-align: center;"><?php echo $product['Product']['quantity']; ?></td>
			<td style="text-align: center;"><?php echo $product['Product']['status']; ?></td>
			<td >
			<?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $product['Product']['id']) ); ?> | 
			<?php
				if( $product['Product']['status'] != 0){ 
					echo $this->Html->link(    "Delete", array('action'=>'delete', $product['Product']['id']));}else{
					echo $this->Html->link(    "Re-Activate", array('action'=>'activate', $product['Product']['id']));
					}
			?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($product); ?>
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