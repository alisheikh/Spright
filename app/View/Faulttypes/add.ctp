
                      <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
        'saveBtn'=> true,
      //  'addBtn'=> true,
         // 'addBtnTarget'=> '/faulttypes/add/', //Provice reletive URL
         'sticky'=> true,
         
     )); 

     ?>


                <!-- Main content -->
                <section class="content">

            <div class="row">

            <div class="col-xs-12">
                            <div class="box">
                            
<div class="box-body table-responsive">


                         <?php echo $this->Form->create('Faulttype', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'label' => array(
            'class' => 'col col-md-3 control-label'
        ),
        'wrapInput' => 'col col-md-9',
        'class' => 'form-control'
    ),
    'class' => 'form-horizontal raiseJobForm jobAttributes'
)); ?> 

					<?php echo $this->Form->input('code', array('placeholder' => 'Code'));?>

					<?php echo $this->Form->input('description', array('placeholder' => 'Description'));?>

			<?php echo $this->Form->end() ?>
</div>
</div>
                           
            </div>
            <!-- /.row -->
        </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->












