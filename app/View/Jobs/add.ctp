<style>
.form-horizontal .control-label{
  /* text-align:right; */
  text-align:left;
  background-color:#ffa;
}

</style>

<div id="page-wrapper" class="createJob">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-tasks fa-fw"></i> Raise a job
<button class="btn btn-success pull-right" type="submit" id="saveBtn">Save </button>


                    </h1>
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
                        <?php echo $this->Form->create('Job', array('role' => 'form','class'=>'raiseJobForm')); ?>
                        
                        <?php
                        //We need to store the ID's as well because its need to find the job templat to use 
                        echo $this->Form->hidden( 'qs1ID');
                        echo $this->Form->hidden( 'qs2ID');
                        echo $this->Form->hidden( 'qs3ID');
                        echo $this->Form->hidden( 'qs4ID');
                        echo $this->Form->hidden( 'qs5ID');
                        ?>



                <div class="form-group">
                    <?php echo $this->Form->hidden('fullname', array('class' => 'form-control', 'placeholder' => 'Requestors full name'));?>
                </div>
                        <div class="form-group">

                    <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Requestors email','value'=>$this->session->read('Auth.User.email')));?>
                </div>
                        <div class="form-group">
                    <?php echo $this->Form->input('phone', array('class' => 'form-control', 'placeholder' => 'Requestors contact number','value'=>$this->session->read('Auth.User.contact')));?>
                </div>

        <div id="chooseLocation">
         <div class="form-group"><?php
            echo $this->Form->input('site_id', array('type' => 'select', 'class' => 'form-control', 'label' => 'Site'));?>
        </div>





        <div class="form-group"><?php
            echo $this->Form->input('building_id', array('type' => 'select', 'class' => 'form-control', 'label' => 'Building'));?>

        </div>

        <div class="select2-wrapper"><?php
            echo $this->Form->input('floor_id', array('type' => 'select', 'class' => 'form-control', 'label' => 'Floor'));?>
        </div>
        <div class="form-group"><?php
            echo $this->Form->input('room_id', array('type' => 'select', 'class' => 'form-control', 'label' => 'Room'));?>
        </div>
    </div> 

                <div class="form-group">
                    <?php echo $this->Form->input('description', array('class' => 'form-control', 'placeholder' => 'In detail please describe what you need help with?'));?>
                    
                </div>

                <button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>
             
                                </div>
                                <!-- /.col-lg-6 (nested) -->
<!-- What do you need help with Start -->
                      <div class="col-lg-6" id="helpwith">

                              <div class="form-group"><?php
            echo $this->Form->input('asset_id', array('type' => 'text', 'class' => 'form-control'));?>
        </div>
                
                                    <h3>What do you need help with?</h3>



                 <div class="form-group">



					<?php echo $this->Form->input('qs1',array('class' => 'form-control','type'=>'select','label'=>false,'empty' => '--')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('qs2', array('class' => 'form-control', 'type'=>'select','label'=>false));?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('qs3', array('class' => 'form-control', 'type'=>'select','label'=>false));?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('qs4', array('class' => 'form-control', 'type'=>'select','label'=>false));?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('qs5', array('class' => 'form-control', 'type'=>'select','label'=>false));?>
                </div>
                
<?php echo $this->Form->end() ?>
              
                                 
                                </div>
<!-- What do you need help with end-->                                
                                <!-- /.col-lg-6 (nested) -->

  


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
      




