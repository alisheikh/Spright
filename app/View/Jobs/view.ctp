
                      <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> true,
     //    'editBtn'=> true,
       //  'editBtnTarget'=> '/job/edit/' . $this->data['Job']['id'], //Provice reletive URL
         'sticky'=> true,
         
     ));  
     ?>


                <!-- Main content -->
                <section class="content">

            <div class="row">






                                    <div class="col-xs-12">
                            <div class="nav-tabs-custom">



      

                <ul id="tabs" class="nav nav-tabs">
                                
                                <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                                <li><a href="#tasks" data-toggle="tab">Tasks</a></li>
                                <li><a href="#complete" data-toggle="tab">Complete</a></li>
                          
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="details">
                                    <h4></h4>

                                   


                                      <?php echo $this->Form->create('Job', array(
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



                                    <?php echo $this->Form->hidden('id');?>

                                       <div class="row" style="padding:20px">
                                <div class="col-md-6">
                    <?php echo $this->Form->input('fullname', array('label'=>'Requestor', 'disabled' => 'disabled','id'=>'Job.fullnameDISABLED'));?>

                    <?php echo $this->Form->input('email', array('placeholder' => 'User Id','label'=>'Email'));?>

                    <?php echo $this->Form->input('phone', array('placeholder' => 'User Id','label'=>'Phone'));?>

                    <?php echo $this->Form->input('site_id'); ?>

                    <?php echo $this->Form->input('building_id'); ?>

                    <?php echo $this->Form->input('floor_id'); ?>

                    <?php echo $this->Form->input('room_id');?>

                    <?php echo $this->Form->input('description', array('placeholder' => 'Description'));?>

                    <?php echo $this->Form->input('statustype_id', array('label' => 'Status'));?>
                </div>
                                <div class="col-md-6">

                    <?php echo $this->Form->input('Qs1.code', array('label' => 'Questions' , 'disabled' => 'disabled'));?>

                    <?php if($this->data['Job']['qs2']) echo $this->Form->input('Qs2.code', array('label' => ' ', 'disabled' => 'disabled'));?>

                    <?php if($this->data['Job']['qs3']) echo $this->Form->input('Qs3.code', array('label' => ' ', 'disabled' => 'disabled'));?>

                    <?php if($this->data['Job']['qs4']) echo $this->Form->input('Qs4.code', array('label' => ' ', 'disabled' => 'disabled'));?>

                    <?php if($this->data['Job']['qs5']) echo $this->Form->input('Qs5.code', array('label' => ' ', 'disabled' => 'disabled'));?>
                </div>

                    

                </div>
                            </div>

            

                                <div class="tab-pane fade" id="tasks">
                                <br />
<!-- Tasks -->
<div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped jobTasks" >
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Status</th>
                                            <th>Scheduled</th>
                                            <th>Resource</th>
                                            <th>Created</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach ($this->data['Task'] as $task): ?>    
                                    
                                        <tr data-child-completioncomments="<?php echo $task['completioncomments']; ?>" data-child-completiondate="<?php echo $task['completiondate']; ?>">
                                        <td class="details-control"><i class="fa fa-plus"></i></td>
                                             <td><?php echo $task['id']; ?></td>
                                            <td><?php echo $task['code']; ?></td>
                                            <td><?php echo $task['statustype_id']; ?></td>
                                            <td> 
                                            <?php if ($task['scheduled']): ?>
                                             <i class="fa fa-check" style="color:green"></i>
                                            <?php else: ?>
                                                 <i class="fa fa-times" style="color:red"></i>
                                            <?php endif; ?>
                                            
                                            </td>
                                             <td><?php if (!$task['user_id']): echo "-"; else: echo $task['user_id']; endif; ?></td>
                                             
                                            <td><?php echo $task['created']; ?></td>
                                            
    
                                        </tr>
                                <?php endforeach; ?>        
          
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
            <!-- End Tasks -->        
            

 

                                </div>


                                <div class="tab-pane fade" id="history">


                                </div>
                                <div class="tab-pane fade" id="complete">

   <div class="row" style="padding:20px">
                                <div class="col-md-8">

<label>Completion time</label>
                    <div class="input-group date form_datetime" style="max-width:30%" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
      <input class="form-control" size="16" type="text" value="" readonly="" id="JobCompletiondate" name='data[Job][completiondate]'>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>

<?php echo $this->Form->input('completioncomments', array('placeholder' => 'What did you do to resolve this work order?','label'=>'Completion comments','type'=>'textarea'));?>
</div>
</div>
                               

                                 
                                </div>
                    
                            </div>
                            
                            <?php echo $this->Form->end() ?>
             
        
            </div>
 </div>
   </div>
   </div>
            </div>
            <!-- /.row -->
        </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->











