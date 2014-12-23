<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">


                    <h1>Details <small>WO<?php echo $this->data['Job']['id']; ?></small>

<div class="btn-group pull-right">
<button class="btn btn-success" id="saveJob">Save</button>
  <button class="btn btn-default" id="cancelJob">Cancel</button>

</div>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                   
                      
                        <div class="panel-body">
                            <div class="row">
                            <!-- Nav tabs -->
                            <ul id="tabs" class="nav nav-tabs">
                                
                                <li class="active"><a href="#details" data-toggle="tab" id="detailsTab">Details</a></li>
                                <li><a href="#tasks" data-toggle="tab" id="taskTab">Tasks</a></li>
                                <li><a href="#complete" data-toggle="tab" id="completeTab">Complete</a></li>
                          
                            </ul>

                         <?php echo $this->Form->create('Job', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'label' => array(
            'class' => 'col col-md-3 control-label'
        ),
        'wrapInput' => 'col col-md-9',
        'class' => 'form-control'
    ),
    'class' => 'form-horizontal jobAttributes'
)); ?>   

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="details">
                                    <h4></h4>
        
        <div class="col-xs-8">
        <h3>Requestor</h3>
            <?php echo $this->Form->hidden('id');?>
            <?php echo $this->Form->input('fullname', array('placeholder' => 'Full name of the requestor','label'=>'Requestor', 'disabled' => 'disabled'));?>
            <?php echo $this->Form->input('email', array('placeholder' => 'Please provide a valid email','label'=>'Email'));?>           
            <?php echo $this->Form->input('phone', array( 'placeholder' => 'User Id','label'=>'Phone'));?>
         <h3>Location</h3>
            <?php echo $this->Form->input('site_id'); ?>    
            <?php echo $this->Form->input('building_id'); ?>
            <?php echo $this->Form->input('floor_id'); ?>
            <?php echo $this->Form->input('room_id');?>
         <h3>Details</h3>   
            <?php echo $this->Form->input('description', array( 'placeholder' => 'Description'));?>
            <?php echo $this->Form->input('statustype_id', array( 'label' => 'Status'));?>
            <?php echo $this->Form->input('Qs1.code', array( 'label' => 'Questions' , 'disabled' => 'disabled'));?>

            <?php if($this->data['Job']['qs2']) echo $this->Form->input('Qs2.code', array( 'label' => '', 'disabled' => 'disabled'));?>
            <?php if($this->data['Job']['qs3']) echo $this->Form->input('Qs3.code', array( 'label' => '', 'disabled' => 'disabled'));?>
            <?php if($this->data['Job']['qs4']) echo $this->Form->input('Qs4.code', array( 'label' => '', 'disabled' => 'disabled'));?>
            <?php if($this->data['Job']['qs5']) echo $this->Form->input('Qs5.code', array( 'label' => '', 'disabled' => 'disabled'));?>
       </div>
                            </div>                                   
                             
                                <div class="tab-pane fade" id="tasks">
                                <br />
<!-- Tasks -->
<div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Scheduled</th>
                                            
                                            <th>Created</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach ($this->data['Task'] as $task): ?>    
                                    
                                        <tr>
                                            
                                            <td><?php echo $task['code']; ?></td>
                                            <td> 
                                                  <?php if ($task['scheduled' ]===0): ?>
                                             <?php  echo $task['user_id']; ?></i>
                                            <?php else: ?>
                                                 <i class="fa fa-times" style="color:red"></i>
                                            <?php endif; ?>
                                            
                                            </td>
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

                                <div class="tab-pane fade" id="complete">
                                    <h4></h4>

                    <?php echo $this->Form->input('faulttype_id', array('empty'=>'-- Select a fault type --','label'=>'Fault Type'));?>
                
<div class="form-group">
                    <label class="col col-md-3 control-label">Completion time</label>
                    <div class="col col-md-9">
                    <div class="input-group date form_datetime" style="max-width:30%" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">

      <input class="form-control" size="16" type="text" value="" readonly="" id="JobCompletiondate" name='data[Job][completiondate]'>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>

                    </div>
                </div>
                </div>

                <?php echo $this->Form->input('completioncomments', array( 'placeholder' => 'What did you do to resolve this work order?','label'=>'Completion comments','type'=>'textarea'));?>
                </div>

                            <?php echo $this->Form->end() ?>
             
        
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->