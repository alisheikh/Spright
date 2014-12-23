            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> false,
         'addBtn'=> true,
         'saveBtnTarget'=> '/jobs/add/' //Provice reletive URL
     )); ?>
  

                <!-- Main content -->
                <section class="content">

            <div class="row">

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


        </div>
        <!-- /#page-wrapper -->

        </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->








