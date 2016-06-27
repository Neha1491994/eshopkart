<!DOCTYPE html>
<?php


<<<<<<< HEAD
$cakeDescription = __d('cake_dev', 'eShopkart: Admin');
=======
$cakeDescription = __d('cake_dev', 'eShopKart: Admin');
>>>>>>> develop
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
<<<<<<< HEAD
  <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
=======
  
 <div class="navbar navbar-inverse" role="navigation">    
	 
	  <div class="navbar-header">
>>>>>>> develop
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
<<<<<<< HEAD
    // Line chart
	/*
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
    var lineChartData = {
      labels : ["January","February","March","April","May","June","July"],
      datasets : [
      {
        label: "My First dataset",
        fillColor : "rgba(220,220,220,0.2)",
        strokeColor : "rgba(220,220,220,1)",
        pointColor : "rgba(220,220,220,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      },
      {
        label: "My Second dataset",
        fillColor : "rgba(151,187,205,0.2)",
        strokeColor : "rgba(151,187,205,1)",
        pointColor : "rgba(151,187,205,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(151,187,205,1)",
        data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
      }
      ]

    }

    window.onload = function(){
      var ctx_line = document.getElementById("templatemo-line-chart").getContext("2d");
      window.myLine = new Chart(ctx_line).Line(lineChartData, {
        responsive: true
      });
    };
	*/
=======
    
>>>>>>> develop
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