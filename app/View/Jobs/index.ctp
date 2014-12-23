              <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> false,
         'addBtn'=> true,
         'addBtnTarget'=> '/jobs/add/' //Provice reletive URL
     )); ?>
  

                <!-- Main content -->
                <section class="content">

            <div class="row">

                                    <div class="col-xs-12">
                            <div class="box">
                            
<div class="box-body table-responsive">
          <table id="jobs-table" class="jobs-table table table-striped table-bordered">
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






