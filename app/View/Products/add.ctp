<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<div class="templatemo-content">
<div class="contant-name"><b>Add New Product:</b></div>
<div class="row">
            <div class="col-md-12">
<?php echo $this->Form->create('Product', array('url' => array('action' => 'add'), 'enctype' => 'multipart/form-data'));?>
    <fieldset>
	<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label class="control-label" for="AdminType">Category</label>
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
                    <label class="control-label" for="AdminType">Subcategory</label>
					
	<?php
	echo $this->Html->image('ajax-loader.gif', array('alt' => 'lodding', 'id' => 'loding1'));
	echo $this->Form->input('Product.category_id', array(
		'id' =>'subcategory',
		//'type' => 'select'
		'options' => '$subcategory',
		'empty' => 'select subcategory',
		'class'=>'form-control', 'div' => '', 'label' => '',
	));
	?>
	</div>
	</div>
<div class="row">			
		<div class="col-md-6 margin-bottom-30">	
        <label class="control-label" for="AdminType">Product Name</label>		
		<?php echo $this->Form->input('Product.product_name',array('class'=>'form-control', 'div' => '', 'label' => '',));?>
		</div>
		</div>
		
<div class="row">
		<div class="col-md-6 margin-bottom-30">
		<label class="control-label" for="AdminType">Product Number</label>
		<?php echo $this->Form->input('Product.product_number',array('class'=>'form-control', 'div' => '', 'label' => '',)); ?>
		</div>
		<div class="col-md-6 margin-bottom-30">
		<label class="control-label" for="AdminType">Quantity</label>
        <?php echo $this->Form->input('Product.quantity',array('class'=>'form-control', 'div' => '', 'label' => '',))."<br/>";?>
		</div>
	</div>
<div class="row">
<div class="col-md-6 margin-bottom-30">
<label class="control-label" for="AdminType">Images</label>
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
		<div class="col-md-6 margin-bottom-30">
		<label class="control-label" for="AdminType">Status</label>
<?php		
		
        echo $this->Form->input('Product.status', array('class'=>'form-control', 'div' => '', 'label' => '',
            'options' => array( 'available' => 'Available','pending' => 'Pending')
        ))."<br/>";
?>
</div>
</div>
<div class="row">
<div class="col-md-6 margin-bottom-30">
	<?php	
		echo $this->Form->submit('Add Product', array('class' => 'form-submit',  'title' => 'Click here to add the product') ); 
?>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#loding1").hide();
		$("#category").on('change',function() {
			var id = $(this).val();
			$("#loding1").show();
			$("#subcategory").find('option').remove();
			if (id) {
				var dataString = 'id='+ id;
				$.ajax({
					type: "POST",
					url: '<?php echo Router::url(array("controller" => "Products", "action" => "subcategory")); ?>' ,
					data: dataString,
					cache: false,
					success: function(html) {
						$("#loding1").hide();
						$.each(html, function(key, value) {              
							$('<option>').val('').text('select');
							$('<option>').val(key).text(value).appendTo($("#subcategory"));
						});
					} 
				});
			}
		});
	});	
	
function show(target){
	document.getElementById(target).style.display = 'block';
}
function hide(target){
	document.getElementById(target).style.display = 'none';
}
	
</script>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>
</body>