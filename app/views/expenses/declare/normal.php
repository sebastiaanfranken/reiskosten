<div class="container">
	<h1 class="page-header">Reiskosten declareren</h1>
	
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="<?php print action('ExpensesController@getDeclare', array('normal'));?>">Per maand</a></li>
		<li><a href="<?php print action('ExpensesController@getDeclare', array('advanced'));?>">Per periode</a></li>
	</ul> <!-- /.nav /.nav-tabs -->

	<div class="tab-content">
		<?php print Form::open(array('class' => 'form-horizontal', 'role' => 'form'));?>
		<input type="hidden" name="year" value="<?php print date('Y');?>" />
		<div class="form-group">
			<?php print Form::label('month', 'Maand', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::select('month', $months, Input::old('month', date('m')), array('class' => 'form-control', 'required' => 'required'));?>
			</div> <!-- /.col-sm-10 -->
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