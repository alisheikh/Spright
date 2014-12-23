              <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> true,
       //  'addBtn'=> true,
       //  'addBtnTarget'=> '/users/add/' //Provice reletive URL
     )); ?>
  

                <!-- Main content -->
                <section class="content">
                <div class="col-md-8">

            <div class="row">

                                    <div class="col-xs-12">
                            <div class="box">


<div class="box-body">

   			                            <?php echo $this->Form->create('User', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'label' => array(
            'class' => 'col col-md-3 control-label'
        ),
        'wrapInput' => 'col col-md-9',
        'class' => 'form-control'
    ),
    'class' => 'form-horizontal'
)); ?> 


				
					<?php echo $this->Form->input('username', array('placeholder' => 'Username'));?>
					<?php echo $this->Form->input('password', array('placeholder' => 'Password'));?>
					<?php echo $this->Form->input('group_id', array('placeholder' => 'Role','label'=>'Role'));?>
					<?php echo $this->Form->input('fullname', array('placeholder' => 'Full name'));?>
					<?php echo $this->Form->input('email', array('placeholder' => 'Email address'));?>
					<?php echo $this->Form->input('contact', array('placeholder' => 'Contact number'));?>

			<?php echo $this->Form->end() ?>
           
            <!-- /.row -->
        </div>

        </div>
        </div>
</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->








