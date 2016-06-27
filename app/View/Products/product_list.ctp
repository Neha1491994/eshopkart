<script>
function goBack() {
    window.history.back();
}
</script>
<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<div class="templatemo-content">
 <div class="row margin-bottom-30">
            <div class="col-md-12">
			
<div class="contant-name">
<b><?php if($this->Session->check('categ')){
	                      ?><a href="javascript:void(0);" onclick="goBack();">Subcategory/</a>Products:
						 <?php echo $this->Session->read('categ');}
						else{
						echo "Products:";
						}?></b></div>
<div class="contant-tag">
<?php echo $this->Html->link( "Add New Product",   array('controller'=>'products','action' => 'add'),array('escape' => false) ); ?>  </div><br/>
<table  class="table table-striped table-hover table-bordered">
    <thead>
		<tr>
			<th>Logo</th>
			<th><?php echo $this->Paginator->sort('product_name', 'Name');?>  </th>
			<th><?php echo $this->Paginator->sort('product_number', 'Product Number');?></th>
			<th><?php echo $this->Paginator->sort('quantity','Quantity');?></th>
			<th><?php echo $this->Paginator->sort('status','Status');?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>						
		<?php $count=0; ?>
		
		<?php foreach($products as $product): 
      //pr($product['Gallery'][0]['images']); exit;		?>
		<?php $count ++;?>
		<?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
		<?php endif; ?>
			<td><?php if($product['Gallery']!= ''){
					  echo $this->Html->image('/files/thumbs100x100/'.$product['Gallery'][0]['images']); 
					  }?></td>
			<td><?php echo $this->Html->link( $product['Product']['product_name']  ,   array('action'=>'product_detail', $product['Product']['id']),array('escape' => false) );?></td>
			<td style="text-align: center;"><?php echo $product['Product']['product_number']; ?></td>
			<td style="text-align: center;"><?php echo $product['Product']['unitsinstock']; ?></td>
			<td style="text-align: center;"><?php echo $product['Product']['status']; ?></td>
			<td >
			
			<div class="btn-group">
                          <button type="button" class="btn btn-info">Action</button>
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><?php echo $this->Html->link("Edit",array('action' => 'add', $product['Product']['id']));?></li>
                            <li><?php echo $this->Html->link("Delete",array('action' => 'product_delete', $product['Product']['id']),null,'Are you sure you want to delete this category ?');?></li>
                          </ul>
                        </div>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($product); ?>
	</tbody>
</table>


<ul class="pagination pull-right">
			  <?php echo $this->Paginator->prev('«',array('tag' => 'li'),null,array('tag' => 'li','class' => 'disabled'));
					echo $this->Paginator->numbers();
					echo $this->Paginator->next('»',array('tag' => 'li'),null,array('class' => 'disabled'));
					?>			
              </ul>
</div>
</div>
</div>