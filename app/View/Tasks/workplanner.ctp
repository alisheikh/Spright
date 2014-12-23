
              <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> false,
         'addBtn'=> false,
         //  'sticky'=>true
         //'saveBtnTarget'=> '/jobs/add/' //Provice reletive URL
     ));
      ?>
  

                <!-- Main content -->
                <section class="content">

            <div class="row ">

<style>

.modal.fade:not(.in) .modal-dialog {
    -webkit-transform: translate3d(25%, 0, 0);
    transform: translate3d(25%, 0, 0);
}

.scheduleHighlight {

    border: 1px dashed #f2dede !important;
    background: none;
    cursor:pointer;
    background-color: #DFF0D8;
}
   
.container{
overflow-x: scroll;

}

    .image {
        background-color:#ffcb05;
    }

        .valid {
       background-color:#dff0d8;

        cursor:move;
    }

        .image2 {
        background-color:#dff0d8;
        width:200px !important;
        cursor:move;
    }
    .step {
        background-color:#e7e7e7e7;

    
    }


    .drag { 
    border-radius:2px;  
  
    color:#777777; 
    font-size: 10px
}
.rf-ind-drag.default {

    background-color: red;  
}
    </style>

<div id="resourcesContainer" class="col-xs-12 ">

 <div class="box box-success">
                                  <div class="box-header">

                                  <i class="fa fa-users"></i>
<h3 class="box-title">Resources</h3>
</div>
<table class="table table-bordered" id="resources">
    <thead >
        <tr>

        <?php //debug($users); 
        foreach ($users as $user): ?>

            <th><?php echo $user['User']['fullname']; ?></th>

            <?php endforeach; ?>
        </tr>
    </thead>

     <tbody>

        <tr>
        
        <?php  foreach ($users as $user): ?>



<td id="<?php echo $user['User']['id']; ?>" class="col-md-5">
<ul class="list-group">

    <?php if (count($user['Task'])===0): ?>

    <li class="list-group-item" id="empty_<?php echo $user['User']['id']; ?>"><i class="fa fa-child"></i> Empty</li>

    <?php else: ?>

      <?php foreach ($user['Task'] as $task): ?>

        <?php 

           switch ($task['statustype_id']) {
            case 1:

            $fontawesome = "fa fa-bars";
                
            break;  
            case 2:
            $fontawesome = "fa fa-calendar wp_scheduled";
        
            break;

            } 

         ?>

            <li data-jobid="<?php echo $task['job_id']; ?>" data-placement="bottom" data-toggle="popover" data-title="Task Details" data-container="body" type="button" data-html="true" class="list-group-item scheduledTask" id="<?php echo $task['id']; ?>"><i class="<?php echo $fontawesome; ?>"></i> <?php echo "#" . $task['id'] . " "; echo $task['code']; ?>


            </li>
        <?php endforeach; ?>
     <?php endif; ?>   

        <?php endforeach; ?>
</ul>
</td>
        </tr>



    </tbody>
</table>

</div>



      </div>

      <div id="unscheduled" class="col-xs-12">
                                  <div class="box">
                                  <div class="box-header">
                                  <i class="fa fa-tasks"></i>
<h3 class="box-title">Unscheduled Tasks</h3>
</div>
                            
<div class="box-body table-responsive">
            <table id="tasks-table" class="table table-bordered scheduler">
                <thead>
                    <th>Job #</th>
                    <th>Fullname</th>
                    <th>SiteCode</th>
                    <th>BuildingCode</th>
                    <th>FloorCode</th>
                    <th>RoomCode</th>
                    <th>QS1</th>
                    <th>QS2</th>
                    <th>QS3</th>
                    <th>QS4</th>
                    <th>QS5</th>
                
                </thead>
                <tbody>
                </tbody>
            </table>



      </div>
      </div>

      </div>


<div class="modal fade" id="quickView">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p><h1 id="jobid"></h1></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

            </aside><!-- /.right-side -->







