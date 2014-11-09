<div class="schedules view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Schedule'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Schedule'), array('action' => 'edit', $schedule['Schedule']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Schedule'), array('action' => 'delete', $schedule['Schedule']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $schedule['Schedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Schedules'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Schedule'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Code'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Description'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['description']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Startdate'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['startdate']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Enddate'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['enddate']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Freq'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['freq']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Count'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['count']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Interval'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['interval']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Runtime'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['runtime']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Legend'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['legend']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($schedule['Schedule']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

