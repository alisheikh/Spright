
<?php echo $this->Form->create('Task', array(
    'inputDefaults' => array(
        'div' => 'form-group',
        'label' => array(
            'class' => 'col col-md-3 control-label'
        ),
        'wrapInput' => 'col col-md-9',
        'class' => 'form-control'
    ),
    'class' => 'form-horizontal completeTask'
)); ?> 

<?php echo $this->Form->input('id', array('type'=>'hidden'));?>
<?php echo $this->Form->input('statustype_id', array('type'=>'hidden','value'=> 3));?>

<label>Completion time</label>
    <div class="input-group date">
    <input id="TaskCompletiondate" name='data[Task][completiondate]' data-provide="datepicker" type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
    </div>

    <script>
        $(function () {
                $('#TaskCompletiondate').datetimepicker();
            });

    </script>


<?php echo $this->Form->input('faulttype_id', array('label'=>'Fault type','empty'=>'-- Select a Fault Type --'));?>


<?php echo $this->Form->input('completioncomments', array('placeholder' => 'What did you do to resolve this work order?','label'=>'Completion comments','type'=>'textarea'));?>

<button class="btn btn-success btn-lg btn-block completedTask" type="button" id="<?php echo $this->request->data['Task']['id']; ?>">Complete Task</button>


<?php echo $this->Form->end() ?>

