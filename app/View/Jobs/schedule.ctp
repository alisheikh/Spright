<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Planned Work</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">

            <?php echo $this->Form->create('Job', array('role' => 'form')); ?>

            <?php  echo $this->Form->input('code', array('label'=>'Name','class' => 'form-control')); ?>
            <?php  echo $this->Form->input('description', array('label'=>'Detailed description','type'=>'textarea','class' => 'form-control')); ?>
<?php
$freqOptions = array(
        array('DAILY' => 'Daily', 'WEEKLY' => 'Weekly', 'MONTHLY' => 'Monthly', 'YEARLY' => 'Yearly')
 );
 
 echo $this->Form->input('freq', array('label'=>'Occurs','class' => 'form-control','type'=>'select', 'options'=>$freqOptions));


 $intOptions = array(
        array('1' => '1', '2' => '2', '3' => '3','4' => '4'  , '5' => '5'    , '6' => '6'    , '7' => '7'    , '8' => '8'    , '9' => '9'    , '10' => '10'  , '11' => '11'  , '12' => '12'  , '13' => '13'  , '14' => '14'  , '15' => '15'  , '16' => '16'  , '17' => '17'  , '18' => '18'  , '19' => '19'  , '20' => '20'  , '21' => '21'  , '22' => '22'  , '23' => '23'  , '24' => '24'  , '25' => '25'  , '26' => '26'  , '27' => '27'  , '28' => '28'  , '29' => '29'  , '30' => '30'));
 
 echo $this->Form->input('interval', array('label'=>'Repeat every','class' => 'form-control','type'=>'select', 'options'=>$intOptions));
?>
<p class="help-block" id="repeatLabel">Days</p>
   
   <div id="weekly" style="display: none;">
   <label>
          <input type="checkbox" id="MO" value="MO" name="data[Job][weekday]"> MON
        </label>

        <label>
          <input type="checkbox" id="TU" value="TU" name="data[Job][weekday]"> TUE
        </label>
                <label>
          <input type="checkbox" id="WE" value="WE" name="data[Job][weekday]"> WED
        </label>
                <label>
          <input type="checkbox" id="TH" value="TH" name="data[Job][weekday]"> TUE
        </label>
                <label>
          <input type="checkbox" id="FR" value="FR" name="data[Job][weekday]"> FRI
        </label>
                <label>
          <input type="checkbox" id="SA" value="SA" name="data[Job][weekday]"> SAT
        </label>
             <label>
          <input type="checkbox" id="SU" value="SU" name="data[Job][weekday]"> SUN
        </label>


</div>

        <br /> 

        <label>Starts on</label>
                    <div class="input-group date form_datetime" style="max-width:30%" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" >
                    <input class="form-control" size="16" type="text" id="startdate" name="data[Job][startdate]">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
<br />

<label>Ends</label><br />
<input type="radio" name="data[Job][runtime]" value="NEVER" checked>Never<br>
<input type="radio" name="data[Job][runtime]" value="COUNT">After <input type="number" id="COUNT" placeholder="Occurences" name="data[Job][count]"> <br />
<input type="radio" name="data[Job][runtime]" value="SCHEDULED">On                     <span class="input-group date form_datetime" style="max-width:30%" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1" >
                    <input class="form-control" size="16" type="text" id="startdate" name="data[Job][enddate]">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </span>



<label>Color</label>
<select id="scheduleLegend" name="data[Job][legend]">
<option value="#e1e1e1" selected>Gray</option>
  <option value="#fbd75b">Yellow</option>
  <option value="#ff887c">Red</option>
  
</select>



                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-check"></i>Submit</button>

 <?php echo $this->Form->end() ?>


<pre>
            
    </pre>        
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->