
                <div id="page-wrapper">
   
            <div class="row">
                            <div class="col-lg-12">
                     <h1 class="page-header"><i class="fa fa-sitemap fa-fw"></i></i> Locations</h1>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="btn-group">
  <button type="button" class="btn btn-default" id="deleteLocation">Delete</button>
  <button type="button" class="btn btn-default" id="addLocation">Add</button>

</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="locationTree"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-danger" id="saveLocation">Save</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="questionsView">

                            <h3 id="locationHeader"></h3>
                                <?php echo $this->Form->create('Code', array('role' => 'form')); ?>
                                                <div class="form-group">
                    <?php echo $this->Form->hidden('Code.id');?>                            
                    <?php echo $this->Form->input('Code.code', array('class' => 'form-control site building floor room', 'placeholder' => 'Name','label'=>'Name'));?>
 <?php echo $this->Form->input('Code.description', array('class' => 'form-control site building floor room','type'=>'textarea'));?>
 <?php echo $this->Form->input('Code.address', array('class' => 'form-control site'));?>

 <?php $bookableOptions = array(
    array('name' => 'No', 'value' => '0'),
    array('name' => 'Yes', 'value' => '1'),
 );?>

 <?php echo $this->Form->input('Code.bookable', array('class' => 'form-control room','type'=>'select','options'=>$bookableOptions));?>
  <?php echo $this->Form->input('Code.capacity', array('class' => 'form-control room'));?>
   <?php echo $this->Form->input('Code.sqm', array('class' => 'form-control room'));?>
<!--                                   <div class="form-group">
				<input type="text" location-type="site;building;floor;room" required="required" id="CodeCode" maxlength="200" class="form-control" name="data[Code][code]">

				<textarea type="text" location-type="site;building;floor;room" id="CodeDescription" maxlength="2000" class="form-control" name="data[Code][description]"></textarea>
                </div> -->
                </div>

<?php echo $this->Form->end() ?>

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
               
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
