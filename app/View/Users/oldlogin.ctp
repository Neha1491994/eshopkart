<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<div class="template-page-wrapper">
<?php echo $this->Form->create('User',array('label' => false,'div'=>'','class'=>'form-horizontal templatemo-signin-form')); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label" style="margin-left: 1px;">Username:</label>
            <div class="col-sm-10">
				<?php echo $this->form->input('User.username',array('label' => false,'div'=>'','class'=>'form-control')); ?>
            </div>
          </div>              
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <label for="password" class="col-sm-2 control-label" style="margin-left: 1px;">Password:</label>
            <div class="col-sm-10">
				<?php echo $this->form->input('User.password',array('label' => false,'div'=>'','class'=>'form-control')); ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <?php echo $this->form->submit('Login',array('label' => false,'class'=>'bg372D21 b333333 cfff','div'=>'')); ?>
            </div>
          </div>
        </div>
    </fieldset>
	</div>
</div>
