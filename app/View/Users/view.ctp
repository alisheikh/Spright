 <div id="page-wrapper" class='assetIndex'>
    <div class="panel-heading">
        <h1>User</h1>
        <div class="btn-group">
            <a href="/users/edit/<?php echo h($user['User']['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
            <a href="/users/disable/<?php echo h($user['User']['id']); ?>" class="btn btn-danger btn-sm">Disable</a>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-9">
           <table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>

</tr>
<tr>
		<th><?php echo __('Username'); ?></th>
		<td>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Full name'); ?></th>
		<td>
			<?php echo h($user['User']['fullname']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Group'); ?></th>
		<td>
			<?php echo h($user['Group']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Email'); ?></th>
		<td>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Contact'); ?></th>
		<td>
			<?php echo h($user['User']['contact']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
    </div> <!-- end col md 9 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->

