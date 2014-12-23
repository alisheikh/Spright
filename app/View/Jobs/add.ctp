           <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
         <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> true,
       //  'BtnTarget'=> '/job/edit/' . $this->data['Job']['id'], //Provice reletive URL
         'sticky'=> true,
         
     )); ?>
  

                <!-- Main content -->
                <section id="section" class="content createJob">
<div class="col-md-8">
<div class="box box-primary ">
<div class="box-body">

                         <?php echo $this->Form->create('Job', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'label' => array(
            'class' => 'col col-md-3 control-label'
        ),
        'wrapInput' => 'col col-md-9',
        'class' => 'form-control'
    ),
    'class' => 'form-horizontal raiseJobForm jobAttributes'
)); ?> 

    <?php echo $this->Form->input('fullname', array('placeholder' => 'Contact full name'));?>
    <?php echo $this->Form->input('email', array('placeholder' => 'Contact email','value'=>$this->session->read('Auth.User.email')));?>
    <?php echo $this->Form->input('phone', array('placeholder' => 'Contact number','value'=>$this->session->read('Auth.User.contact')));?>

<h4>Where is the issue</h4>
    <div id="chooseLocation">
<?php echo $this->Form->input('asset_id', array('type' => 'text'));?>

<?php echo $this->Form->input('site_id', array('type' => 'select','label' => 'Site'));?>
<?php echo $this->Form->input('building_id', array('type' => 'select', 'label' => 'Building'));?>
<?php echo $this->Form->input('floor_id', array('type' => 'select', 'label' => 'Floor'));?>
<?php echo $this->Form->input('room_id', array('type' => 'select', 'label' => 'Room'));?>
        </div>

<h4>What is the issue?</h4>
<div id="helpwith">
                


    <?php echo $this->Form->input('qs1',array('type'=>'select','label'=>'','empty' => '--')); ?>
    <?php echo $this->Form->input('qs2', array('type'=>'select','label'=>''));?>
    <?php echo $this->Form->input('qs3', array('type'=>'select','label'=>''));?>
    <?php echo $this->Form->input('qs4', array('type'=>'select','label'=>''));?>
    <?php echo $this->Form->input('qs5', array('type'=>'select','label'=>''));?>

                    
    <?php echo $this->Form->end() ?>
              
</div>

 
</div>

</div>
</div>





                </section><!-- /.content -->
            </aside><!-- /.right-side -->







