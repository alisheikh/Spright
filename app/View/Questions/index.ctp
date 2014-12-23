
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





<div class="col-lg-6">
<div class="panel panel-default">
<div class="panel-heading">
<div class="btn-group">
<button type="button" class="btn btn-default" id="deleteQuestion">Delete</button>
<button type="button" class="btn btn-default" id="editQuestion">Configure</button>
<button type="button" class="btn btn-default" id="addQuestion">Add</button>
</div>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div id="questions"></div>
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<div class="col-lg-6">
<div class="panel panel-default">
<div class="panel-heading">
<button type="button" class="btn btn-danger" id="saveQuestion">Save</button>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div id="questionsView">
<?php echo $this->Form->create('Question', array('role' => 'form')); ?>
<div class="form-group">
<?php echo $this->Form->hidden('Question.id');?>
<?php echo $this->Form->input('Question.code', array('class' => 'form-control', 'placeholder' => 'Name','label'=>'Name'));?>
</div>
<div class="form-group">
<?php //echo $this->Form->hidden('Jobtemplate.id');?>
<?php //echo $this->Form->input('Jobtemplate.id', array('class' => 'form-control', 'label'=>'Job Template'));?>
<?php echo $this->Form->input('jobtemplate_id', array('type'=>'select','class' => 'form-control', 'placeholder' => 'Jobtemplate Id','options'=>$jobTemplates));?>
</div>
<?php echo $this->Form->end() ?>
</div>
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
   </div>
   </div>
            </div>
            <!-- /.row -->
        </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->












