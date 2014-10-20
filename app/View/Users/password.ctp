

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Change Password</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<?php
echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'password'
    )
));
?>
<div class="col-lg-5">

<h4>You are currently logged in as <strong><i><?php echo AuthComponent::user('username'); ?></i></strong>, not you? <a href="/logout" title="logout">logout</a>.</i></h4>

<?php echo $this->Session->flash(); ?>

   <div class="form-group">
                    <?php echo $this->Form->input('current', array('class' => 'form-control', 'placeholder' => 'Enter your current password','type'=>'password','label'=> 'Your current password'));?>
   </div>

   <div class="form-group">
                    <?php echo $this->Form->input('password1', array('class' => 'form-control', 'placeholder' => 'New password','type'=>'password','label'=> 'New Password'));?>
   </div>

      <div class="form-group">
                    <?php echo $this->Form->input('password2', array('class' => 'form-control', 'placeholder' => 'Repeat password','type'=>'password','label'=> 'Repeat Password'));?>
   </div>

                           <div class="form-group">
                               <button type="submit" class="btn btn-primary btn-lg btn-block">Change Password</button>
                           </div>

      </div>



        </div>
        <!-- /#page-wrapper -->

