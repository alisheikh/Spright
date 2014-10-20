<div id="page-wrapper" class="assetCreate">
    <div class="row">
        <div class="col-lg-12">


            <h1>Asset <small><?php echo $this->data['Code']['code']; ?></small></h1>

            <div class="btn-group">
                <button  class="btn btn-primary btn-sm btnSaveMode">Save</button>

            </div>

        </div>
        <!-- /.col-lg-12 -->
    </div> 

    <div class="row">
        <div class="col-lg-12">


            <div class="panel-body">
                <div class="row">


                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#general" data-toggle="tab">General <i class="fa"></i></a></li>
                        <li><a href="#detailed" data-toggle="tab">Detailed <i class="fa"></i></a></li>
                        <li><a href="#attachments" data-toggle="tab">Attachments</a></li>
                        

                    </ul>

                    <!-- Tab panes -->


                        <?php echo $this->Form->create('Code', array('role' => 'form','class'=>'assetForm')); 
                            echo $this->Form->hidden('Code.id');
                            ?>
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="general">

         

                            <div class="row" style="padding:20px">
                                <div class="col-md-6">



                                    <div class="form-group">
                                     <?php echo $this->Form->input('Code.code', array('class' => 'form-control', 'placeholder' => 'Unique Asset Code','label'=>'Asset Code'));?>
                                 </div>
                                 <div class="form-group">
                                     <?php echo $this->Form->textarea('Code.description', array('class' => 'form-control', 'placeholder' => 'Detailed description of the asset','label'=>'Asset Description'));?>
                                 </div>               
                                 <div class="form-group">
                                     <?php  $statusOptions = array(
                                                1 => 'Active',
                                                2 => 'Decomissioned'

                                            );
                                  echo    $this->Form->input('status', array('type' => 'select','class' => 'form-control',
                                        'options' => $statusOptions
                                        ));?>
                                    </div>  
                                    
                                    
                                <?php echo $this->Element('LocationTree'); ?>
</div>
                                </div>
                            



                            <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                        </div> <!-- general tab end -->

                        <div class="tab-pane fade in" id="detailed">

                            <div class="row" style="padding:20px">
                                <div class="col-md-6"> <!-- col-md-6 tusrt> -->
                                    <div class="form-group">    
                                        <?php echo $this->Form->input('Code.bookable', array('label'=> 'Bookable Space' ,'class' => 'form-control','options' => array('Yes','No'),'empty' => 'Is this space Bookable?'));?>
                                    </div>

                                    <div class="form-group">
                                     <?php echo $this->Form->input('Code.capacity', array('class' => 'form-control', 'placeholder' => 'How many people can fit in this room?'));?>
                                 </div>

                                 <div class="form-group">
                                     <?php echo $this->Form->input('Code.manufacturer', array('class' => 'form-control', 'placeholder' => 'Who is the Manufacturer?'));?>
                                 </div>

                                 <div class="form-group">
                                     <?php echo $this->Form->input('Code.supplier', array('class' => 'form-control', 'placeholder' => 'Who is the supplier?'));?>
                                 </div>

                                 <div class="form-group">
                                     <?php echo $this->Form->input('Code.make', array('class' => 'form-control', 'placeholder' => 'What is the make?'));?>
                                 </div>

                                 <div class="form-group">
                                     <?php echo $this->Form->input('Code.model', array('class' => 'form-control', 'placeholder' => 'What is the model?'));?>
                                 </div>
      <div class="form-group">
                                     <?php echo $this->Form->input('Code.cost', array('class' => 'form-control', 'placeholder' => 'What is the cost?'));?>
                                 </div>
                          </div>
                      </div> <!-- col-md-6 end> -->
                      <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                  </div> <!-- detailed tab end -->
                  
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


<!-- /.row -->
</div> 
<!-- /#page-wrapper -->




