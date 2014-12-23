<div id="page-wrapper" class="createSchedule">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Planned Work</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<div id="rootwizard">
	<div class="navbar">
	  <div class="navbar-inner">
	    <div class="container">
	<ul> 
	  	<li><a href="#tab1" data-toggle="tab"><span class="badge">1</span> Details</a></li>
	  	<li><a href="#tab2" data-toggle="tab"><span class="badge">2</span>  Frequency</a></li>
		<li><a href="#tab3" data-toggle="tab"><span class="badge">3</span>  Tasks</a></li>
		<li><a href="#tab4" data-toggle="tab"><span class="badge">4</span>  Finish</a></li>
	</ul>
	 </div>
	  </div>
	</div>


<div class="progress">
  <div class="bar progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" >
   
  </div>
</div>
<?php echo $this->Form->create('Schedule', array('role' => 'form')); ?>
	<div class="tab-content">
	    <div class="tab-pane" id="tab1">
	                <?php  echo $this->Form->input('code', array('label'=>'Name','class' => 'form-control','placeholder'=>'Brief description')); ?>
          <?php  echo $this->Form->input('description', array('label'=>'Detailed description (<i class="fa fa-question"></i>)','type'=>'textarea','class' => 'form-control','placeholder'=>'Detailed description of the work which needs carrying out.')); ?>
<?php  echo $this->Form->input('completiontime', array('label'=>'Est Hours to Complete','class' => 'form-control','value'=>'0.5')); ?>




                
	    </div>
	    <div class="tab-pane" id="tab2">
	      
<?php
$freqOptions = array(
        array('DAILY' => 'Daily', 'WEEKLY' => 'Weekly', 'MONTHLY' => 'Monthly', 'YEARLY' => 'Yearly')
 );
 
 echo $this->Form->input('freq', array('label'=>'Occurs','class' => 'form-control','type'=>'select', 'options'=>$freqOptions));


 $intOptions = array(
        array('1' => '1', '2' => '2', '3' => '3','4' => '4'  , '5' => '5'    , '6' => '6'    , '7' => '7'    , '8' => '8'    , '9' => '9'    , '10' => '10'  , '11' => '11'  , '12' => '12'  , '13' => '13'  , '14' => '14'  , '15' => '15'  , '16' => '16'  , '17' => '17'  , '18' => '18'  , '19' => '19'  , '20' => '20'  , '21' => '21'  , '22' => '22'  , '23' => '23'  , '24' => '24'  , '25' => '25'  , '26' => '26'  , '27' => '27'  , '28' => '28'  , '29' => '29'  , '30' => '30'));
 
 echo $this->Form->input('intval', array('label'=>'Repeat every','class' => 'form-control','type'=>'select', 'options'=>$intOptions));
?> 

<p class="help-block" id="repeatLabel">Days</p>
   
   <div id="weekly" style="display: none;">
   <label>
          <input type="checkbox" id="MO" value="MO" name="data[Schedule][byday][]" checked> MON
        </label>

        <label>
          <input type="checkbox" id="TU" value="TU" name="data[Schedule][byday][]" checked> TUE
        </label>
                <label>
          <input type="checkbox" id="WE" value="WE" name="data[Schedule][byday][]" checked> WED
        </label>
                <label>
          <input type="checkbox" id="TH" value="TH" name="data[Schedule][byday][]" checked> TUE
        </label>
                <label>
          <input type="checkbox" id="FR" value="FR" name="data[Schedule][byday][]" checked> FRI
        </label>
                <label>
          <input type="checkbox" id="SA" value="SA" name="data[Schedule][byday][]"> SAT
        </label>
             <label>
          <input type="checkbox" id="SU" value="SU" name="data[Schedule][weekday][]"> SUN
        </label>

</div>

        <br /> 

        <label>Starts on</label>
                    <div class="input-group date form_datetime" style="max-width:30%" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" >
                    <input class="form-control" size="16" type="text" id="startdate" name="data[Schedule][startdate]">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
<br />

<label>Ends</label><br />
<input type="radio" name="data[Schedule][runtime]" id="runtimeNever" value="NEVER" checked>Never<br>

<input type="radio" name="data[Schedule][runtime]" id="runtimeScheduled" value="SCHEDULED">On                     <span class="input-group date form_datetime" style="max-width:30%" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" >
                    <input class="form-control" size="16" type="text" id="enddate" name="data[Schedule][enddate]">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </span>



<label>Color</label>
<select id="scheduleLegend" name="data[Schedule][legend]">
<option value="#e1e1e1" selected>Gray</option>
  <option value="#fbd75b">Yellow</option>
  <option value="#ff887c">Red</option>


  
</select>


	    </div>

	    <div class="tab-pane" id="tab3">

	    <h3>Assign a job template</h3>

	    		<div class="form-group">
					 <?php echo $this->Form->input('jobtemplate_id', array('type'=>'select','class' => 'form-control', 'placeholder' => 'Jobtemplate Id','options'=>$jobTemplates,'label'=>'Job Template'));?>
				</div>

	    </div>

	    <div class="tab-pane" id="tab4">

	    <h3>Click finish if you agree with the following schedule</h3>

	    </div>

		<ul class="pager wizard">
			<li class="previous" style="float:left;"><input type='button' class='btn btn-default' name='next' value='Previous' /></li>
		  	<li class="next"><input type='button' class='btn btn-danger pull-right' name='next' value='Next' /></li>
			<li class="next finish" style="display:none;"><button type="submit" class="btn btn-success pull-right"><i class="fa fa-check"></i> Save</button></li>
		</ul>
	</div>	
</div>



 <?php echo $this->Form->end() ?>

        </div>
        <!-- /#page-wrapper -->