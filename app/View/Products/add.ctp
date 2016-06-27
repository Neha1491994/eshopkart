<?php echo $this->Html->script('ckeditor/ckeditor.js');
	$edit = false;
	//pr($this->request->data['Category']);exit;
	if(isset($this->request->data['Product']['id'])){
		$edit = true;
	}
?>
<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<div class="templatemo-content">
        <?php if($edit):?>
			<ol class="breadcrumb">
				<li><?php echo $this->Html->link("List Products",array('action' => 'product_list'));?></li>
				<li class="active">Edit Product</li>
			</ol>
			<?php endif;?>
			
          <h1><?php echo ($edit)? 'Edit Product':'Add New Product';?></h1>
 <div class="row">
     <div class="col-md-12">
     <?php //echo $this->Form->create('Product', array('url' => array('action' => 'add'), 'enctype' => 'multipart/form-data',));
echo $this->Form->create('Product', array('controller'=>'product','action'=>'add','type' => 'file','novalidate'=>true));?>
   
	 
	<div class="row">
    <div class="col-md-6 margin-bottom-15">
				  <label class="control-label" for="ProductCategory">Category</label>
        <?php 
		echo $this->Html->script('jquery.min');
	    echo $this->Form->input('Category', array(
		'id' =>'category',
		'options' => $categories,
		'empty' => 'select category',
		'class'=>'form-control', 'div' => '', 'label' => '',
	));?>
	</div>
	</div>
	

    <div class="row">
    <div class="col-md-6 margin-bottom-15">
    <label class="control-label" for="ProductSubcategory">Subcategory</label>
					
	<?php
	echo $this->Html->image('ajax-loader.gif', array('alt' => 'lodding', 'id' => 'loding1'));
	echo $this->Form->input('Product.category_id', array(
		'id' =>'subcategory',
		//'type' => 'select'
		'options' => '$subcategory',
		//'empty' => 'select subcategory',
		'class'=>'form-control', 'div' => '', 'label' => '',
	));
	?>
	</div>
	</div>
    <div class="row">			
	<div class="col-md-6 margin-bottom-15">	
        <label class="control-label" for="ProductName">Product Name</label>		
		<?php echo $this->Form->input('Product.product_name',array('class'=>'form-control', 'type'=>'text', 'div' => '', 'label' => '',));?>
	</div>
	
	<div class="col-md-6 margin-bottom-15">
		<label class="control-label" for="ProductNumber">Product Number</label>
		<?php echo $this->Form->input('Product.product_number',array('class'=>'form-control', 'type'=>'text', 'div' => '', 'label' => '',)); ?>
	</div>
	</div>
	
	<div class="row">
	<div class="col-md-6 margin-bottom-15">
		<label class="control-label" for="ProductQuantity">Quantity</label>
		<?php echo $this->Form->input('Product.unitsinstock',array('class'=>'form-control','type'=>'text', 'div' => '', 'label' => '',)); ?>
	</div>
	<div class="col-md-6 margin-bottom-15">
		<label class="control-label" for="ProductPrice">Price</label>
		<?php echo $this->Form->input('Product.unitprice',array('class'=>'form-control','type'=>'text', 'div' => '', 'label' => '',)); ?>
	</div>
	</div>
	
	<div class="row">
	   <div class="col-md-6 margin-bottom-15">
	   <label class="control-label" for="ProductStatus">Status</label>
        <?php		
		
        echo $this->Form->input('Product.status', array('class'=>'form-control', 'div' => '', 'label' => '',
            'options' => array( 'available' => 'Available','pending' => 'Pending')
        ))."<br/>";
       ?>
       </div>
	   <div class="col-md-6 margin-bottom-15">
        <label for="ProductDescription">Description</label>
        <?php //$this->Ck->input('Admin.description', array('div' => '','label' => ''));
		echo $this->Form->textarea('Product.product_description',array('class'=>'form-control', 'div' => '', 'label' => '',)); ?>  
        </div>
    </div>

        <div class="row">
         <div class="col-md-6 margin-bottom-15">
           <?php
           for($i=1; $i<4; $i++)
           {
            ?>
            <div  id="attachment<?php echo $i;?>" <?php if($i !=1) echo "style='display:none;'";?> >
         	<div>
            <?php echo $this->Form->input('image'.$i,array('class'=>'form-control','type'=>'file','label' => false,'div' => false));?>
            </div>
            <div  id="attachmentlink<?php echo $i;?>"  <?php if($i==3) echo "style='display:none;'";?>><a href="javascript:void(0);" onclick="show('attachment<?php echo $i+1;?>'); hide('attachmentlink<?php echo $i;?>');">Add Another Attachment</a></div>
            </div>
            <?php } ?>
		 </div>
        </div>
 
 
        
	         <div class="row templatemo-form-buttons">
                <div class="col-md-12">
				<?php echo $this->Form->input('Product.id', array('type' => 'hidden')); ?>
                  <button class="btn btn-primary" type="submit">Submit</button>
                  <button class="btn btn-default" onClick="history.back(0);">Cancel</button>    
                </div>
              </div>


</div>
</div>
</div><?php echo $this->Form->end(); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#loding1").hide();
		
		<?php 
			$subcat_id = 0;
			if(isset($this->request->data['Category'])){
				if($this->request->data['Category']['parent_id'] > 0){
					$subcat_id = $this->request->data['Category']['id'];
				}
			}?>	
		
		
		$("#category").on('change',function() {
			var id = $(this).val();
			$("#loding1").show();
			$("#subcategory").find('option').remove();
			if (id) {
				var dataString = 'id='+ id;
				//alert('<?php echo Router::url(array("controller" => "Products", "action" => "subcategory")); ?>')
				$.ajax({
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "Products", "action" => "subcategory")); ?>' ,
					data: dataString,
					cache: false,
					success: function(html) {
						$("#loding1").hide();
						$.each(html, function(key, value) {              
							$('<option>').val('').text('select');
							if(key == <?=$subcat_id?>){
								$('<option>').val(key).text(value).attr('selected', 'selected').appendTo($("#subcategory"));
							}else{
								$('<option>').val(key).text(value).appendTo($("#subcategory"));
							}
							
						});
					} 
				});
			}
		});
		
		
		<?php if(!empty($this->request->data['Category'])){
			if($this->request->data['Category']['parent_id'] == 0){
				$cat_id = $this->request->data['Category']['id']; 
			}else{
				$cat_id = $this->request->data['Category']['parent_id'];
			}?>
				$("#category>option").each(function(key, obj){
						if($(obj).attr('value') == <?=$cat_id?>){
							$(obj).attr('selected', 'selected').trigger('change');
						}
				});
		<?php
		}?>	
		
	});	
	
function show(target){
	document.getElementById(target).style.display = 'block';
}
function hide(target){
	document.getElementById(target).style.display = 'none';
}
	
</script>
    
