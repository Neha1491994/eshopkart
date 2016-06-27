
<div>
<?php
echo $this->element('common/left_menu');
?>
</div>
<div class="templatemo-content">
<div class="contant-name"><b>Users:</b></div>
            <div class="row margin-bottom-30">
            <div class="col-md-12">
<table class="table table-striped table-hover table-bordered">
    <thead>
		<tr>
			<th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
			<th><?php echo $this->Paginator->sort('username', 'Username');?>  </th>
			<th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
			<th><?php echo $this->Paginator->sort('mobile','Mobile');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Created');?></th>
			<th><?php echo $this->Paginator->sort('modified','Last Update');?></th>
			<th><?php echo $this->Paginator->sort('status','Status');?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>						
		<?php $count=0; ?>
		<?php foreach($users as $user): ?>				
		<?php $count ++;?>
		<?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
		<?php endif; ?>
			<td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td>
			<td><?php echo $this->Html->link( $user['User']['username']  ,   array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
			<td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
			<td style="text-align: center;"><?php echo $user['User']['mobile']; ?></td>
			<td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
			<td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['updated']); ?></td>
			<td style="text-align: center;"><?php echo $user['User']['status']; ?></td>
			<td >
			<div class="btn-group">
                          <button type="button" class="btn btn-info">Action</button>
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
						     <li><?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $user['User']['id']) ); ?></li>
                            <li><?php if( $user['User']['status'] != 0){
							echo $this->Html->link("Delete",array('action'=>'delete', $user['User']['id']),null,'Are you sure you want to delete this category ?');}
						else{
					    echo $this->Html->link(    "Re-Activate", array('action'=>'activate', $user['User']['id']));
					    }?>
						</li>
                        </ul>
                        </div>
			
			 
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($user); ?>
	</tbody>
</table>

<ul class="pagination pull-right">
			  <?php echo $this->Paginator->prev('«',array('tag' => 'li'),null,array('tag' => 'li','class' => 'disabled'));
					echo $this->Paginator->numbers();
					echo $this->Paginator->next('»',array('tag' => 'li'),null,array('class' => 'disabled'));
					?>			
              </ul>
</div>	
</div>			
</div>


