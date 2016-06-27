  <div class="navbar-collapse collapse templatemo-sidebar">
  <?php 
		$currentController = $this->params['controller'];
		$currentAction = $this->params['action'];
		$loginType = $this->Session->read('type');
		?>
        <ul class="templatemo-sidebar-menu">
          <li>
            <form class="navbar-form">
              <input type="text" class="form-control" id="templatemo_search_box" placeholder="Search...">
              <span class="btn btn-default">Go</span>
            </form>
          </li>
		  
          <li class="sub">
		  <?php echo $this->Html->link("Dashboard",array('controller'=>'users','action' => 'index'));?><br/>
		  </li>
		  <li class="sub">
<<<<<<< HEAD
		  <?php echo $this->Html->link( "Add A New User.",   array('action'=>'add'),array('escape' => false) ); ?><br/>
=======
		  <?php echo $this->Html->link( "Add A New User",   array('controller'=>'users','action'=>'add'),array('escape' => false) ); ?><br/>
>>>>>>> develop
          </li>
		  
		  <li class="sub">
           <?php echo $this->Html->link( "Categories",   array('controller'=>'categories','action'=>'category_list'),array('escape' => false) ); ?>
           <br/>
          </li>
		  
		  
		  <li class="sub">
           <?php echo $this->Html->link( "Products",   array('controller'=>'products','action'=>'product_list'),array('escape' => false) ); ?>
          <br/>
          </li>
		        
          <li>
		  <i class="fa fa-sign-out"></i><?php 
echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
?></a></li>
        </ul>
     </div>