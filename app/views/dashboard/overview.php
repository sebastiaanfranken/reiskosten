<div class="container">
	<h1 class="page-header">Dashboard</h1>

	<ul class="nav nav-tabs" role="tablist">
		<li><a href="<?php print action('DashboardController@getIndex');?>">Gebruikers</a></li>
		<li><a href="<?php print action('DashboardController@getCreateUser');?>">Gebruiker toevoegen</a></li>
		<li class="active"><a href="<?php print action('DashboardController@getOverview');?>">Globaal reiskostenoverzicht</a></li>
	</ul> <!-- /.nav /.nav-tabs -->

	<div class="tab-content">
		<?php print Form::open(array('class' => 'form-horizontal', 'role' => 'form'));?>
		<div class="form-group">
			<?php print Form::label('user', 'Werknemer', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::select('user', $employees, Input::old('user'), array('class' => 'form-control'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('year', 'Jaar', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::text('year', Input::old('year', date('Y')), array('class' => 'form-control', 'required' => 'required'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('month', 'Maand', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::select('month', $months, Input::old('month'), array('class' => 'form-control'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<?php print Form::submit('Toon reiskosten', array('class' => 'btn btn-info'));?>
				<?php print Form::reset('Opnieuw', array('class' => 'btn btn-default'));?>
			</div> <!-- /.col-sm-offset-2 /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<?php print Form::close();?>
	</div> <!-- /.tab-content -->
</div> <!-- /.container -->