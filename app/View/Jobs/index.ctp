

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

            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th><?php echo $this->Paginator->sort('Job.id','#'); ?></th>
                        <th><?php echo $this->Paginator->sort('description'); ?></th>
                        
                        <th><?php echo $this->Paginator->sort('building.code'); ?></th>
                        <th><?php echo $this->Paginator->sort('room.code'); ?></th>
                        <th><?php echo $this->Paginator->sort('statustype_id','Status'); ?></th>
                        <th><?php echo $this->Paginator->sort('qs1','#1'); ?></th>
                        <th><?php echo $this->Paginator->sort('qs2','#2'); ?></th>
                        <th><?php echo $this->Paginator->sort('qs3','#3'); ?></th>
                        <th><?php echo $this->Paginator->sort('qs4','#4'); ?></th>
                        <th><?php echo $this->Paginator->sort('qs5','#5'); ?></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                        <td>
                        <a class='btn btn-primary btn-circle quickView' data-direction='right'><i class="fa fa-list"></i></a>
                        &nbsp;</td>


                        <td> <?php echo $this->Html->link($job['Job']['id'],
                          array('action' => 'view', $job['Job']['id']), array('escape' => false)); ?>  &nbsp;</td>
                        <td><?php echo h($job['Job']['description']); ?>&nbsp;</td>
                        <td><?php echo h($job['Building']['code']); ?>&nbsp;</td>
                        <td><?php echo h($job['Room']['code']); ?>&nbsp;</td>
                        <td><?php echo h($job['Statustype']['code']); ?>&nbsp;</td>
                        <td><?php echo h($job['Qs1']['code']); ?>&nbsp;</td>
                        <td><?php echo h($job['Qs2']['code']); ?>&nbsp;</td>
                        <td><?php echo h($job['Qs3']['code']); ?>&nbsp;</td>
                        <td><?php echo h($job['Qs4']['code']); ?>&nbsp;</td>
                        <td><?php echo h($job['Qs5']['code']); ?>&nbsp;</td>
                         <td><?php echo h($job['Job']['created']); ?>&nbsp;</td>
                        <td class="actions">
                           
                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-ok-sign" style="color:#d9534f"></span>',
                          array('action' => 'edit', $job['Job']['id'] .'#complete'), array('escape' => false)); ?>     
                          
                          
                       
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <p>
                <small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
            </p>

            <?php
            $params = $this->Paginator->params();
            if ($params['pageCount'] > 1) {
            ?>
            <ul class="pagination pagination-sm">
                <?php
                    echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
                    echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
                    echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
                ?>
            </ul>
            <?php } ?>

   
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
        