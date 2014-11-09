
<style>
   
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
                    <h1 class="page-header">Work Planners</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<div class="container1">
<div class="row container">


<?php  foreach ($users as $user): ?>

        <div class="col-xs-6 col-md-4 panel panel-default">
         <div class="panel-body step resource" id="001">
<?php echo $user['User']['fullname']; ?>

<?php debug($user['Task']); ?>

            </div>
        </div>

<?php endforeach; ?>
      


      </div>

<style>


html {
overflow: -moz-scrollbars-vertical !important;
overflow-y: scroll !important;
}

.scroll{
    overflow: -moz-scrollbars-vertical; 
overflow-y: scroll;
width:80%;

}

.handle{
    cursor: move;
}


</style>


<?php 

function getStatusIcon($status){

switch ($status) {
  case 1:
   echo "<i class=\"fa fa-exclamation-triangle\"></i>";
    break;
    case 2:
    echo "<i class=\"fa fa-check\"></i>";

    
}
}

?>

      <div class="container">----</div>

      <div class="container step worklist" style="background-color:#666;height:300px" id="unscheduled">
  
<?php  debug($jobs['Job']['Task']); foreach ($jobs as $job): ?>



        <div class="image" id="<?php echo $job['Job']['id']; ?>"><span class="handle"><?php getStatusIcon($job['Job']['statustype_id']); ?></i></span> #<?php echo $job['Job']['id']; ?></div>

<?php endforeach; ?>

      </div>

      </div>



            


<div id="result">
</div>

        </div>
        <!-- /#page-wrapper -->

