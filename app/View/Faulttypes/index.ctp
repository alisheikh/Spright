



                      <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
        'saveBtn'=> false,
        'addBtn'=> true,
          'addBtnTarget'=> '/faulttypes/add/', //Provice reletive URL
         'sticky'=> true,
         
     )); 

     ?>


                <!-- Main content -->
                <section class="content">

            <div class="row">

            <div class="col-xs-12">
                            <div class="box">
                            
<div class="box-body table-responsive">
                        <table id="fault-codes" class="table table-striped table-bordered">
                <thead>
                    <th>Name</th>
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











