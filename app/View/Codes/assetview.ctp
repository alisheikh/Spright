



<style>
.btn-group{
      bottom: 15px;
    position: relative;
    top: 15px;

}
</style>

<div id="page-wrapper" class="assetCreate">

            <div class="panel-body">

                <div class="row">
<div class="page-header col-md-6">
      <h3 class="pull-left">
        View Asset
      </h3>
      <div class="pull-right">
        <div class="btn-group">
          <button class="btn btn-success" id="saveAsset" style="width:60px">
            Save
          </button>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
         <div class="clearfix"></div>              
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#general" data-toggle="tab">General <i class="fa"></i></a></li>
                        <li><a href="#attachments" data-toggle="tab">Attachments</a></li>
                        

                    </ul>

                    <!-- Tab panes -->



  <?php echo $this->Form->create('Code', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'label' => array(
            'class' => 'col col-md-3 control-label'
        ),
        'wrapInput' => 'col col-md-9',
        'class' => 'form-control assetForm'
    ),
    'class' => 'form-horizontal raiseJobForm assetForm'
)); ?> 


                            
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="general">

         

                            <div class="row" style="padding:20px">
                                <div class="col-md-6">
<?php echo $this->Form->hidden('Code.id'); ?>
<?php echo $this->Form->input('Code.code', array('placeholder' => 'Unique Asset Code','label'=>'Asset Code'));?>
<?php echo $this->Form->hidden('Code.code',array('name'=>'orginalCode','id'=>'orginalCode'));?>
<?php echo $this->Form->input('Code.description', array('type'=>'textarea','placeholder' => 'Detailed description of the asset','label'=>'Description'));?>
  
  <?php  $statusOptions = array(1 => 'Active',2 => 'Decomissioned');
         echo    $this->Form->input('status', array('type' => 'select','options' => $statusOptions
                                        ));?>
                                    

    <?php echo $this->Form->input('Code.manufacturer', array('placeholder' => 'Who is the Manufacturer?'));?>
    <?php echo $this->Form->input('Code.supplier', array('placeholder' => 'Who is the supplier?'));?>
    <?php echo $this->Form->input('Code.make', array('placeholder' => 'What is the make?'));?>
    <?php echo $this->Form->input('Code.model', array('placeholder' => 'What is the model?'));?>
    <?php echo $this->Form->input('Code.cost', array('placeholder' => 'What is the cost?'));?>
                                
     <div id="chooseLocation">
<?php echo $this->Form->input('Site.code', array('type' => 'select','label' => 'Site', 'options' => $sites, 'selected' => $this->data['Site']['id']));?>
<?php echo $this->Form->input('Building.code', array('type' => 'select','label' => 'Building', 'options' => $buildings, 'selected' => $this->data['Building']['id']));?>
<?php echo $this->Form->input('Floor.code', array('type' => 'select','label' => 'Floor', 'options' => $floors, 'selected' => $this->data['Floor']['id']));?>

<?php
echo $this->Form->input('Room.code', array('type' => 'select','label' => 'Room', 'options' => $rooms, 'selected' => $this->data['Room']['id']));
?>
     
    </div> 
</div>
                                </div>

                        </div> <!-- general tab end -->
                  
<?php echo $this->Form->end() ?>
                  

                  <div class="tab-pane fade in" id="attachments">

                    <div class="row" style="padding:20px">
                        <div class="col-md-6"> <!-- col-md-6 start> -->

                         <form id="upload" method="post" action="/codes/upload" enctype="multipart/form-data">

                            <span class="btn btn-lg btn-block btn-warning btn-file">
                                Browse to Upload Documents<input type="file" name="upl" multiple>
                            </span>


                            <ul class="list-group">
                                <!-- The file uploads will be shown here -->
                            </ul>


                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="assetUpload">
                                    <thead>
                                        <tr>

                                            <th>File name</th>
                                            <th>File Type</th>
                                            <th>Size</th>
                                            <th>Uploaded</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- /.table-responsive -->
                                        <?php foreach ($this->data['Attachment'] as $attachment): ?>

                                          <tr id="asset_<?php echo $attachment['id']; ?>">

                                            <td> <a href=/files/<?php echo $attachment['attachment']; ?> title="download"><?php echo $attachment['name']; ?></a></td>
                                            <td><?php echo $attachment['type']; ?></td>
                                            <td><?php echo $attachment['size']; ?></td>
                                            <td><?php echo $attachment['createdate']; ?></td>
                                            <td>



                                                <button class="btn btn-danger btn-circle btnDelAttach" type="button" id="<?php echo $attachment['id']; ?>"><i class="fa fa-times"></i>
                                                </button>
                                        </td>
                                    </tr>



                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div> <!-- table-responsive end -->


                </form> <!-- attachments form end -->

   


        </div>
        
    </div> <!-- attachments row end -->
</div> <!-- attachments end  -->

</div>
</div>
</div>
                   </div>

<?php echo $this->Form->end() ?>
      









