<!--<html>
<head><link href="css/bootstrap.min.css" rel="stylesheet"></head>-->
<nav class="navbar navbar-inverse">
<ul class="nav nav-pills" class="navbar navbar-left">
               <li><a href="" style="color:#fff"><h3>eShopKart<h3></a></li>              
</ul>
</nav>
     <div class="container">
		<div class="row">
		  <div class="col-md-3"></div>
		  <div class="col-md-6">
	  <form name="loginform" id="loginform" class='form-horizontal templatemo-signin-form' action="<?php array('controller'=>'users','action' =>'login')?>" method="post">
	    <div class="form-group">
          <div class="col-md-12">
		   <?php
	         echo $this->Session->flash();
	         echo $this->Session->flash('auth');
	       ?>
		  </div>
		</div>
        <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
				<?php echo $this->form->input('User.username',array('label' => false,'div'=>'','class'=>'form-control')); ?>
            </div>
		    <div class="col-sm-0"></div>
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
				<?php echo $this->form->input('User.password',array('label' => false,'div'=>'','class'=>'form-control')); ?>
            </div> 
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
                  <?php echo $this->form->submit('Login',array('label' => false,'class'=>'bg372D21 b333333 cfff','div'=>'')); ?>
            </div>
          </div>
        </div>
       </form>           
				 
	   </div>
      <div class="col-md-3"></div>
	 </div>
	</div>
<!--<nav class="navbar navbar-default navbar-fixed-bottom" style="background:a2b3c1">
<ul class="pager">
    <li><a href="#">Previous</a></li>
    <li><a href="#">Next</a></li>
</ul>
</nav>
</html>-->