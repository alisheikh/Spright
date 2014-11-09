

<?php

//($jobs);

?>


 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-tasks fa-fw"></i> Work Orders
<a href="/jobs/add/" class="btn btn-danger pull-right" id="addButton"><i class="fa fa-plus"></i> Raise Work Order</a>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

 
            <table id="jobs-table" class="table table-striped table-bordered">
                <thead>
                    <th>Job #</th>
                    <th>Name</th>
                    <th>Site</th>
                    <th>Building</th>
                    <th>Floor</th>
                    <th>Room</th>
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
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        
        <!-- Modal -->
        <style>
        
        .modal-dialog {
        float:right;
  width: 60%;
  height: 100%;
  padding: 0;
}

.modal-content {
  height: 100%;
  border-radius: 0;
}
        </style>
        
        
        
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
        