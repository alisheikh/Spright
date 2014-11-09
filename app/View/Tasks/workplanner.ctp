
<style>

.scheduleHighlight {

    border: 3px dashed #f2dede !important;
    background: none;
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
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Work Planner</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<div class="container1">
<div class="row container">



<button id="newJobs" type="button">Any New Jobs</button>
<div class="table-responsive">
<table class="table" id="resources">
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



<td id="<?php echo $user['User']['id']; ?>">
<ul class="list-group">

    <?php if (count($user['Task'])===0): ?>

    <li class="list-group-item" id="empty_<?php echo $user['User']['id']; ?>"><i class="fa fa-child"></i> Empty</li>

    <?php else: ?>

      <?php foreach ($user['Task'] as $task): ?>
            <li class="list-group-item"><i class="fa fa-bars"></i><?php echo $task['id']; ?></li>
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

      <div><h3>Unscheduled Tasks</h3></div>

      <div id="unscheduled">
      <div class="table-responsive">
            <table id="tasks-table" class="table table-striped table-bordered">
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
        <!-- /#page-wrapper -->

