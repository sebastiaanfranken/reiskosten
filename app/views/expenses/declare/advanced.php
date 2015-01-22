<div class="container">
	<h1 class="page-header">Reiskosten declareren per periode</h1>
	
	<ul class="nav nav-tabs" role="tablist">
		<li><a href="<?php print action('ExpensesController@getDeclare', array('normal'));?>">Per maand</a></li>
		<li class="active"><a href="<?php print action('ExpensesController@getDeclare', array('advanced'));?>">Per periode</a></li>
	</ul> <!-- /.nav /.nav-tabs -->

	<div class="tab-content">
		<?php if(isset($errors) && count($errors->all()) > 0) : ?>
		<div class="alert alert-danger">
			<ul>
				<?php foreach($errors->all() as $error) : ?>
				<li><?php print $error;?>
				<?php endforeach;?>
			</ul>
		</div> <!-- /.alert /.alert-info -->
		<?php endif;?>

		<?php print Form::open(array('class' => 'form-horizontal', 'role' => 'form'));?>
		<div class="form-group">
			<?php print Form::label('start_date', 'Startdatum', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::text('start_date', Input::old('start_date'), array('class' => 'form-control', 'required' => 'required'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('end_date', 'Einddatum', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::text('end_date', Input::old('end_date'), array('class' => 'form-control', 'required' => 'required'));?>
			</div> <!-- /.col-sm-10- -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<?php print Form::submit('Declareren', array('class' => 'btn btn-info'));?>
				<?php print Form::reset('Opnieuw', array('class' => 'btn btn-default'));?>
			</div> <!-- /.col-sm-offset-2 /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<?php print Form::close();?>
	</div> <!-- /.tab-content -->
</div> <!-- /.container -->