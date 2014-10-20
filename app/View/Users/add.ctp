 <div id="page-wrapper" class='createUser'>
    <div class="panel-heading">
        <h1>Create User</h1>

    </div>
    <!-- /.row -->
    <div class="row">
       <div class="col-md-6">
            			<?php echo $this->Form->create('User', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('group_id', array('class' => 'form-control', 'placeholder' => 'Role','label'=>'Role'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('fullname', array('class' => 'form-control', 'placeholder' => 'Full name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('contact', array('class' => 'form-control', 'placeholder' => 'Contact number'));?>
				</div>

				<div class="form-group">
					 <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
				</div>

			<?php echo $this->Form->end() ?>
    </div> <!-- end col md 9 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->
