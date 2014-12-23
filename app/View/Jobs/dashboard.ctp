              <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> false,
         'addBtn'=> false,
         //'saveBtnTarget'=> '/assets/create/' //Provice reletive URL
     )); ?>
  

                <!-- Main content -->
                <section class="content">

            <div class="row">

<div class="col-md-6">
 
<div class="small-box bg-aqua">
<div class="inner">
<h3>
150
</h3>
<p>
Open Work Orders
</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a class="small-box-footer" href="/jobs ">
Work Order List <i class="fa fa-arrow-circle-right"></i>
</a>
</div>
</div>

<div class="col-md-6">
 
<div class="small-box bg-green">
<div class="inner">
<h3>
53<sup style="font-size: 20px"></sup>
</h3>
<p>
Unassigned Tasks
</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a class="small-box-footer" href="/tasks/workplanner">
Work Planner <i class="fa fa-arrow-circle-right"></i>
</a>
</div>
</div>
                                    <div class="col-xs-12">


                            <div class="box">
                                                    <div class="box-header">
                                  <i class="fa fa-tasks"></i>
<h3 class="box-title">Work Orders Raised by You</h3>
</div>

<div class="box-body table-responsive">
            <table id="your-jobs-table" class="jobs-table table table-striped table-bordered">
                <thead>
                    <th>Job #</th>
                    <th>Requestor</th>
                    <th>Site</th>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>Room</th>
                    <th>Status</th>
                    <th>QS1</th>
                    <th>QS2</th>
                    <th>QS3</th>
                    <th>QS4</th>
                    <th>QS5</th>
                    <th>Created</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                </tbody>
            </table>

   </div>
   </div>
            </div>
            <!-- /.row -->
        </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->






