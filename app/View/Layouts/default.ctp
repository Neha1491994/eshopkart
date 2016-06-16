<!DOCTYPE html>
<?php


$cakeDescription = __d('cake_dev', 'eShopKart: Admin');
?>
<head>
  <meta charset="utf-8">
  <title><?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?></title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">  
  <?php echo $this->Html->css('main') ?>  
</head>
<body>
  
 <div class="navbar navbar-inverse" role="navigation">    
	 
	  <div class="navbar-header">
        <div class="logo"><h1><?php echo $cakeDescription; ?></h1></div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> 
      </div>   
    </div>
    <div class="template-page-wrapper">
		
		<?php echo $content_for_layout ?>
		<footer class="templatemo-footer">
			<div class="templatemo-copyright">
			  <p>Copyright &copy; <?php echo date('Y').' '.$cakeDescription;  ?></p>
			</div>
		</footer>
    </div>
    <?php echo $this->Html->script('jquery.min') ?> 
	<?php echo $this->Html->script('bootstrap.min') ?>
	<?php echo $this->Html->script('Chart.min') ?> 	
	<?php echo $this->Html->script('main') ?> 
	
    <script type="text/javascript">
    
	jQuery(document).ready(function($) {
		$('#myTab a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});

		$('#loading-example-btn').click(function () {
		  var btn = $(this);
		  btn.button('loading');
		  // $.ajax(...).always(function () {
		  //   btn.button('reset');
		  // });
		});
	});
    
  </script>
</body>
</html>