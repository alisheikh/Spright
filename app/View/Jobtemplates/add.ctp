
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create job template</h1>
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
					<?php echo $this->Form->input('code', array('class' => 'form-control', 'placeholder' => 'Create a descriptive name. e.g. Cleaning (Chemical Spill)', 'label' => 'Name'));?>
				</div>

				<div class="form-group">
					<?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-default')); ?>
				</div>

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