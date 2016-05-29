<!DOCTYPE html>
<html>
<head><link href="css/bootstrap.min.css" rel="stylesheet"></head>
<nav class="navbar navbar-inverse">
<ul class="nav nav-pills" class="navbar navbar-left">
               <li><a href="" style="color:#fff"><h3>eShopKart<h3></a></li>
              
</ul>

</nav>

<body bgcolor="pink">
              <?php
			    echo $this->Session->flash();
			    echo $this->Session->flash('auth');
			  ?>
              <div class="container">
				<div class="row">
				 <div class="col-md-3"></div>
				 <div class="col-md-6">
				 <form class="form-horizontal">
                       <div class="form-group">
                         <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
                         <div class="col-sm-9">
                            <?php echo $this->form->input('username',array('label' => false,'div'=>'','class'=>'form-control')); ?>
                         </div>
                       </div>
                       <div class="form-group">
                         <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                         <div class="col-sm-9">
                            <?php echo $this->form->input('password',array('label' => false,'div'=>'','class'=>'form-control')); ?>
                         </div>
                       </div>
                       <div class="form-group">
                         <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                           <label>
                           <input type="checkbox"> Remember me
                           </label>
                        </div>
                       </div>
                      </div>
                     <div class="form-group">
                     <div class="col-sm-offset-3 col-sm-9">
                      <?php echo $this->form->submit('Login',array('label' => false,'class'=>'bg372D21 b333333 cfff','div'=>'')); ?>
                     </div>
                     </div>
                 </form>
				 
				 </div>
				 <div class="col-md-3"></div>
				</div>
			  </div>

</body>
<!--<nav class="navbar navbar-default navbar-fixed-bottom" style="background:a2b3c1">
<ul class="pager">
    <li><a href="#">Previous</a></li>
    <li><a href="#">Next</a></li>
</ul>
</nav>-->
</html>