<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit job template</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
			<?php echo $this->Form->create('Jobtemplate', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('code', array('class' => 'form-control', 'placeholder' => 'Code', 'label' => 'Name'));?>
				</div>
				 <h3>Tasks</h3>


          <table id="job-template-tasks" class="jobs-table table table-striped table-bordered">
                <thead>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Skill</th>
                    <th>Created</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                </tbody>
            </table>

			<?php echo $this->Form->end() ?>
            
                                </div>




                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->