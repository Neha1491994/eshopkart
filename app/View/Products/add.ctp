
<body>
<div>
<?php
//echo $this->element('common/left_menu');
?>
</div>
<div class="contant-name"><b>Add New Product:</b></div>
<div class="form">
<?php echo $this->Form->create('Product');?>
    <fieldset>
        <?php 
		echo $this->Html->script('jquery.min');
	    echo $this->Form->input('category_id', array(
		'id' =>'category',
		'options' => $categories,
		'empty' => 'select category',
	));
//for subcategories
	echo $this->Html->image('ajax-loader.gif', array('alt' => 'lodding', 'id' => 'loding1'));
	echo $this->Form->input('subcategory_id', array(
		'id' =>'subcategory',
		//'type' => 'select'
		'options' => '$subcategories',
		'empty' => 'select subcategory',
	));
			?>
<div class="row">			
		<div class="col-md-6 margin-bottom-30">	 
		<?php echo $this->Form->input('product_name');?>
		</div>
		</div>
		
<div class="row">
		<div class="col-md-6 margin-bottom-30">
		<?php echo $this->Form->input('product_number'); ?>
		</div>
		<div class="col-md-6 margin-bottom-30">
        <?php echo $this->Form->input('quantity')."<br/>";?>
<div class="row">
<div class="col-md-6 margin-bottom-30">
                  <label for="exampleInputFile">Image</label>
				  <div id='Uploadcontainer'>
				  <input type='file' name='uploadfiles[]' class='uploadfile' />
				  <?php //echo $this->Form->input('Product.logo', array('type' => 'file','div' => '', 'label' => '')); ?>
				  </div>
				 <button id='extraUpload' onclick="return addAnother('Uploadcontainer')">Next Image</button>
					
 </div>
<div class="col-md-6 margin-bottom-30">
<?php		
		   echo $this->Form->input('status', array(
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
	
function addAnother(hookID)
{
    var hook = document.getElementById(hookID);
    var el      =   document.createElement('input');
    el.className    =   'uploadfile';
    el.setAttribute('type','file');
    el.setAttribute('name','uploadfiles[]');
    hook.appendChild(el);
    return false;
}
	
</script>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
</div>
</body>