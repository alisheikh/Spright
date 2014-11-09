<div class="schedules form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Schedule'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Schedule.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Schedule.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Schedules'), array('action' => 'index'), array('escape' => false)); ?></li>
														</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Schedule', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('code', array('class' => 'form-control', 'placeholder' => 'Code'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('description', array('class' => 'form-control', 'placeholder' => 'Description'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('startdate', array('class' => 'form-control', 'placeholder' => 'Startdate'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('enddate', array('class' => 'form-control', 'placeholder' => 'Enddate'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('freq', array('class' => 'form-control', 'placeholder' => 'Freq'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('count', array('class' => 'form-control', 'placeholder' => 'Count'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('interval', array('class' => 'form-control', 'placeholder' => 'Interval'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('runtime', array('class' => 'form-control', 'placeholder' => 'Runtime'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('legend', array('class' => 'form-control', 'placeholder' => 'Legend'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
