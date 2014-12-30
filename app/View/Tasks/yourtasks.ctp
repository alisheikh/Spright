           <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
         <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> false,
       //  'BtnTarget'=> '/job/edit/' . $this->data['Job']['id'], //Provice reletive URL
         'sticky'=> false,
         
     )); ?>
  

                <!-- Main content -->
                <section id="section" class="content createJob">

<div class="box box-primary ">
<div class="box-body">

<div class="box-body table-responsive">
            <table id="yourTasks-table" class="table table-bordered">
                <thead>
                    <th>Job #</th>
                    <th>Fullname</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>SiteCode</th>
                    <th>BuildingCode</th>
                    <th>FloorCode</th>
                    <th>RoomCode</th>
                    <th>QS1</th>
                    <th>QS2</th>
                    <th>QS3</th>
                    <th>QS4</th>
                    <th>QS5</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                </tbody>
            </table>



      </div>

 
</div>

</div>
</div>





                </section><!-- /.content -->
            </aside><!-- /.right-side -->







