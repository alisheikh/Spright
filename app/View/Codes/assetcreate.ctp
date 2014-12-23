
           <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array('title'=> 'Create Asset', 'saveBtn'=>true,'sticky'=>true)); ?>
  

                <!-- Main content -->
                <section class="content">


<div id="page-wrapper" class="assetCreate">
<div class="col-md-8">
            <div class="panel-body">

                <div class="row">

                       <?php echo $this->Form->create('Code', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'label' => array(
            'class' => 'col col-md-3 control-label'
        ),
        'wrapInput' => 'col col-md-9',
        'class' => 'form-control'
    ),
    'class' => 'form-horizontal raiseJobForm assetForm'
)); ?> 


                            

                            <div class="row" style="padding:20px">
                                



                 <?php echo $this->Form->input('Code.code', array('placeholder' => 'Unique Asset Code','label'=>'Asset Code','autofocus'=>'autofocus'));?>
  <?php echo $this->Form->input('Code.description', array('type'=>'textarea','placeholder' => 'Detailed description of the asset','label'=>'Description'));?>
<?php echo $this->Form->input('status',array('options' => array('Active','Decomissioned'))); ?>

<div id="chooseLocation">
  <?php echo $this->Form->input('Site.code',array('type' => 'select','class' => 'form-control','label'=>'Site','empty'=> '-- Select a site --')); ?>
  <?php echo $this->Form->input('Building.code',array('type' => 'select','class' => 'form-control','label'=>'Building')); ?>
  <?php echo $this->Form->input('Floor.code',array('type' => 'select','class' => 'form-control','label'=>'Floor')); ?>
  <?php echo $this->Form->input('Room.code',array('type' => 'select','class' => 'form-control','label'=>'Room')); ?>

</div>

<?php echo $this->Form->input('Code.manufacturer', array('placeholder' => 'Who is the Manufacturer?'));?>
<?php echo $this->Form->input('Code.supplier', array('placeholder' => 'Who is the supplier?'));?>
<?php echo $this->Form->input('Code.make', array('placeholder' => 'What is the make?'));?>
<?php echo $this->Form->input('Code.model', array('placeholder' => 'What is the model?'));?>
<?php echo $this->Form->input('Code.cost', array('placeholder' => 'What is the cost/value?'));?>

</div>
</div>
</div>
                   </div>

<?php echo $this->Form->end() ?>
               </div>
           </div>
       </div></div></div
       <!-- /.row -->
   </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->






