<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($timeline) ? $timeline->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Food id', 'food_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('food_id', Input::post('food_id', isset($timeline) ? $timeline->food_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Food id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Ate at', 'ate_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('ate_at', Input::post('ate_at', isset($timeline) ? $timeline->ate_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Ate at')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Calorie', 'calorie', array('class'=>'control-label')); ?>

				<?php echo Form::input('calorie', Input::post('calorie', isset($timeline) ? $timeline->calorie : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Calorie')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Price', 'price', array('class'=>'control-label')); ?>

				<?php echo Form::input('price', Input::post('price', isset($timeline) ? $timeline->price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Price')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted at', 'deleted_at', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted_at', Input::post('deleted_at', isset($timeline) ? $timeline->deleted_at : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted at')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Deleted', 'deleted', array('class'=>'control-label')); ?>

				<?php echo Form::input('deleted', Input::post('deleted', isset($timeline) ? $timeline->deleted : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Deleted')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>