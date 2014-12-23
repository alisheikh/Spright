      <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> false,
         'addBtn'=> true,
         'addBtnTarget'=> '/assets/create/' //Provice reletive URL
     )); ?>
  

                <!-- Main content -->
                <section class="content">

            <div class="row">

                                    <div class="col-xs-12">
                            <div class="box">

<div class="box-body table-responsive">
            <table id="assets-table" class="jobs-table table table-striped table-bordered">
                <thead>
                    <th>Asset Code</th>
                    <th>Description</th>
                    <th>Site</th>
                    <th>Buidling</th>
                    <th>Floor</th>
                    <th>Room</th>
                     <th>Created</th>
                     <th>Action</th>
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






