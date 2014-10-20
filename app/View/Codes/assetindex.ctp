 <div id="page-wrapper" class='assetIndex'>
                <div class="panel-heading">
        <h1>Assets</h1>

    </div>

    <div class="btn-toolbar">
<a href="/assets/create" class="btn btn-success btn-sm">New Asset</a>
</div>
            <!-- /.row -->
            <div class="row">
<div class="col-md-9">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('id','Asset Code'); ?></th>
                        
                        <th><?php echo $this->Paginator->sort('description'); ?></th>
                        
                        <th><?php echo $this->Paginator->sort('site.code','Site'); ?></th>
                        <th><?php echo $this->Paginator->sort('building.code','Building'); ?></th>
                        <th><?php echo $this->Paginator->sort('floor.code','Floor'); ?></th>
                        <th><?php echo $this->Paginator->sort('room.code','Room'); ?></th>
<th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>

                <?php 
//debug($codes);

                foreach ($codes as $code): ?>
                    <tr>
                        <td><?php echo $this->Html->link($code['Code']['code'],
                          array('controller'=> 'codes','action' => 'assetview', $code['Code']['id']), array('escape' => false)); ?>  </td>


                        
                        <td><?php echo h($code['Code']['description']); ?>&nbsp;</td>
                        <td><?php echo h($code['Site']['code']); ?>&nbsp;</td>
                        <td><?php echo h($code['Building']['code']); ?>&nbsp;</td>
                        <td><?php echo h($code['Floor']['code']); ?>&nbsp;</td>
                        <td><?php echo h($code['Room']['code']); ?>&nbsp;</td>
                         <td><?php echo h($code['Code']['created']); ?>&nbsp;</td>

                        <td class="actions">
                           
                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span> ',
                          array('controller'=> 'codes','action' => 'assetview', $code['Code']['id']), array('escape' => false)); ?>     
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

        </div> <!-- end col md 9 -->
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
        