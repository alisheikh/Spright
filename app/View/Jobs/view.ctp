
<?php
//debug($job);

?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">


                    <h1><span class="btn btn-info" type="button"><?php echo $job['Statustype']['code']; ?> </span> Details <small>WO<?php echo $job['Job']['id']; ?></small>
<a href="#" class="btn btn-primary pull-right save"><i class="fa fa-pencil"></i> Edit</a>
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
                                
                                <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                                <li><a href="#tasks" data-toggle="tab">Tasks</a></li>
                                <li><a href="#complete" data-toggle="tab">Complete</a></li>
                          
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="details">
                                    <h4></h4>


                                       <div class="row" style="padding:20px">
                                <div class="col-md-6"><div class="form-group">
					<?php echo $this->Form->input('fullname', array('class' => 'form-control', 'value' => $job['Job']['fullname'],'label'=>'Requestor', 'disabled' => 'disabled'));?>
				</div>
					<div class="form-group">
					<?php echo $this->Form->input('email', array('class' => 'form-control', 'value' => $job['Job']['email'],'label'=>'Email', 'disabled' => 'disabled'));?>
				</div>
					<div class="form-group">
					<?php echo $this->Form->input('phone', array('class' => 'form-control', 'placeholder' => 'User Id','label'=>'Phone', 'value' => $job['Job']['phone'],'disabled' => 'disabled'));?>
				</div>
							    <div class="form-group">
                   <?php echo $this->Form->input('Site.code', array('class' => 'form-control', 'value' => $job['Site']['code'],'label'=>'Site', 'disabled' => 'disabled'));?>
                </div>
			    <div class="form-group">
                   <?php echo $this->Form->input('Building.code', array('class' => 'form-control', 'value' => $job['Building']['code'],'label'=>'Building', 'disabled' => 'disabled'));?>
                </div>

			    <div class="form-group">
                   <?php echo $this->Form->input('Floor.code', array('class' => 'form-control', 'value' => $job['Floor']['code'],'label'=>'Floor', 'disabled' => 'disabled'));?>
                </div>
                			    <div class="form-group">
                   <?php echo $this->Form->input('Room.code', array('class' => 'form-control', 'value' => $job['Room']['code'],'label'=>'Room', 'disabled' => 'disabled'));?>
                </div>

				
		
				</div>
                                <div class="col-md-6">
                                <div class="form-group">
					<?php echo $this->Form->input('Jobtype.code', array('class' => 'form-control', 'value' => $job['Jobtype']['code'],'label'=>'Job Type','disabled' => 'disabled'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('code', array('class' => 'form-control', 'value' => $job['Asset']['code'],'label'=>'Asset','disabled' => 'disabled'));?>
				</div>

                                <div class="form-group">
					<?php echo $this->Form->input('qs1', array('class' => 'form-control', 'label' => 'Questions' , 'disabled' => 'disabled', 'value' => $job['Qs1']['code']));?>
				</div>
				<div class="form-group">
					<?php if($job['Job']['qs2']) echo $this->Form->input('qs2', array('class' => 'form-control', 'label' => false, 'value' => $job['Qs2']['code']));?>
				</div>
				<div class="form-group">
					<?php if($job['Job']['qs3']) echo $this->Form->input('qs3', array('class' => 'form-control', 'label' => false, 'value' => $job['Qs3']['code']));?>
				</div>
				<div class="form-group">
					<?php if($job['Job']['qs4']) echo $this->Form->input('qs4', array('class' => 'form-control', 'label' => false, 'value' => $job['Qs4']['code']));?>
				</div>
				<div class="form-group">
					<?php if($job['Job']['qs5']) echo $this->Form->input('qs5', array('class' => 'form-control', 'label' => false, 'value' => $job['Qs5']['code']));?>
				</div>

				<div class="form-group">
					<?php echo $this->Form->input('description', array('type'=>'textarea','class' => 'form-control', 'value' => $job['Job']['description'],'label'=>'Description','disabled' => 'disabled'));?>
				</div>
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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Scheduled</th>
                                            
                                            <th>Created</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach ($job['Task'] as $task): ?>    
                                    
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


                                <div class="tab-pane fade" id="history">


                                </div>
                                <div class="tab-pane fade" id="complete">
                                    <h4></h4>
<?php echo $this->Form->create('Job', array('role' => 'form','action'=>'complete')); ?>
        <?php echo $this->Form->hidden('id', array('class' => 'form-control', 'value' => $job['Job']['id']));?>
<div class="form-group">
<label>Completion time</label>
					<div class="input-group date form_datetime" style="max-width:30%" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" value="" readonly="" id="JobCompletiondate" name="data[Job][completiondate]">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
				</div>


                                    	<div class="form-group">
					<?php echo $this->Form->input('completioncomments', array('class' => 'form-control', 'placeholder' => 'What did you do to resolve this work order?','label'=>'Completion comments','type'=>'textarea'));?>
				</div>

				<button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-check"></i> Complete</button>
                     <?php echo $this->Form->end() ?>            
                                </div>
                    
                            </div>
                            
                      
             
        
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->




