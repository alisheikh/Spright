 <div id="page-wrapper" class='assetIndex'>
    <div class="panel-heading">
        <h1>User</h1>
        <div class="btn-group">
            <a href="/users/edit/<?php echo h($users['User']['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
            <a href="/users/disable/<?php echo h($users['User']['id']); ?>" class="btn btn-danger btn-sm">Disable</a>
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
			<?php echo h($users['User']['username']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Full name'); ?></th>
		<td>
			<?php echo h($users['User']['fullname']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Group'); ?></th>
		<td>
			<?php echo h($users['Group']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Email'); ?></th>
		<td>
			<?php echo h($users['User']['email']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Contact'); ?></th>
		<td>
			<?php echo h($users['User']['contact']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
    </div> <!-- end col md 9 -->
</div>
<!-- /.row -->

<!-- Skills -->
    <div class="row">
        <div class="col-md-9">
<h3>Skills</h3>

            <table cellpadding="0" cellspacing="0" class="table table-striped" id="UserSkillsTable">
                <thead>
                    <tr>
                        <th>Type</th>


                        <th class="actions"><button class="btn btn-success btn-sm pull-right" id="addSkill"><i class="fa fa-plus"></i></button></th>
                    </tr>
                </thead>
                <tbody>

                    <?php 

                    foreach ($users['Skill'] as $skill): ?>
                    <tr>                        
                        <td><?php echo h($skill['code']); ?>&nbsp;</td>
                        <td class="actions">
    
                      </td>
                  </tr>
              <?php endforeach; ?>
          </tbody>
      </table>
        </div>
        </div>

</div>
<!-- /#page-wrapper -->

