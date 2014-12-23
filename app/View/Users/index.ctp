              <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
     
     <?php echo $this->element('contentHeader', array(
         'title'=> $pageTitle,
         'saveBtn'=> false,
         'addBtn'=> true,
         'addBtnTarget'=> '/users/add/' //Provice reletive URL
     )); ?>
  

                <!-- Main content -->
                <section class="content">

            <div class="row">

                                    <div class="col-xs-12">
                            <div class="box">


<div class="box-body table-responsive">
            <table cellpadding="0" cellspacing="0" class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('username'); ?></th>
                        <th><?php echo $this->Paginator->sort('fullname','Full name'); ?></th>                       
                        <th><?php echo $this->Paginator->sort('Group.name','Role'); ?></th>
                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                        <th><?php echo $this->Paginator->sort('contact'); ?></th>

                        <th class="actions"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php 

                    foreach ($users as $user): ?>
                    <tr>                        
                        <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['fullname']); ?>&nbsp;</td>
                        <td><?php echo h($user['Group']['name']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['contact']); ?>&nbsp;</td>
                        <td class="actions">

                          <?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span> ',
                          array('controller'=> 'users','action' => 'view', $user['User']['id']), array('escape' => false)); ?>     
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
   </div>
            </div>
            <!-- /.row -->
        </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->







