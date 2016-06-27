<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<div class="templatemo-content">
          <ol class="breadcrumb">
            <li><?php echo $this->Html->link("List Products",array('action' => 'product_list'));?></li>
				<li class="active">Product Detail</li>
          </ol>
          <h1>Product Detail</h1>
          <div class="row">
            <div class="col-md-12">
              
			  <?php 
			//pr($this->request->data);exit;
			    $product = $this->request->data['Product']; 		
				$category = $this->request->data['Category'];
				$galleries = $this->request->data['Gallery'];
					//pr($product);exit;
				
			    ?>
				 <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label class="control-label" for="AdminType">Product Name</label>
					<p class="form-control-static" id="username"> <?php echo $product['product_name']; ?></p>
                  </div>
				  <div class="col-md-6 margin-bottom-15">
                    <label class="control-label" for="AdminFullName">Category/Subcatejory</label>
					<p class="form-control-static" id="username"> <?php echo $category['category_name'];?></p>
                  </div>
                </div>
				
				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label class="control-label" for="AdminFirstName">Product Number</label>
					<p class="form-control-static" id="username"> <?php echo $product['product_number'];?></p>
                  </div>
				
                  
				</div>
				
				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label class="control-label" for="AdminFirstName">Product in Stock</label>
					<p class="form-control-static" id="username"> <?php echo $product['unitsinstock'];?></p>
                  </div>
				
                  <div class="col-md-6 margin-bottom-15">
                    <label class="control-label" for="AdminFirstName">Product ordered</label>
					<p class="form-control-static" id="username"> <?php echo $product['unitsonorder'];?></p>
                  </div>
				</div>
				
                <div class="row">
                  <div class="col-md-12 margin-bottom-15">
                    <label class="control-label" for="AdminFirstName">Product colours</label>
					<p class="form-control-static" id="username"> <?php echo $product['colour'];?></p>
                  </div>
				
			
                  <div class="col-md-12 margin-bottom-15">
                    <label class="control-label" for="AdminFirstName">Price</label>
					<p class="form-control-static" id="username"> <?php echo $product['unitprice'];?></p>
                  </div>
				
				</div>
				
                  				
                  <div class="row">
                   <div class="col-md-6 margin-bottom-15">
                    <label class="control-label" for="AdminFirstName">Images</label>
					<p class="form-control-static" id="username">
					<?php 
					foreach($galleries as $gallery )
					{
					  if($gallery['images']!= ''):
					  ?>
						  
						<div class="showhim" style="float:left;"><?php echo $this->Html->image('/files/thumbs100x100/' .$gallery['images']); ?>
					 <div class="showme"><?php echo $this->Html->image('/files/images/' .$gallery['images'], array( 'style' => "margin-top: -86px; position: absolute;z-index: 2;max-width: 200px;max-height: 200px" ));?></div></div>
						<?php
					  else:
						echo '<p class="help-block">No photo available.</p>';
					  endif;
					}
					?></p>
                  </div>
				</div>
			 
			  <div class="row">
                  <div class="col-md-12 margin-bottom-15">
                    <label for="AdminPassword">Description</label>
					<p class="form-control-static" id="username"> <?php echo $product['product_description'];?></p>  
                  </div>
                </div>
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
				<?php /*echo $this->Html->link(
									"Edit",
									array('action' => 'add', $admin['id']),
									array('class'=>'btn btn-primary')
								); */
				?>&nbsp;
				<?php echo $this->Html->link(
									"Back",
									array('action' => 'product_list'),
									array('class'=>'btn btn-default')
								); 
				?>   
                </div>
              </div>
          
          </div>
        </div>
      </div>