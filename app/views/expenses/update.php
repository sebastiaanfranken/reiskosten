<div class="container">
	<h1 class="page-header">Reis wijzigen</h1>

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
		<?php print Form::label('date', 'Datum', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::text('date', Input::old('date', timestamp($expenses->date)), array('class' => 'form-control', 'placeholder' => 'Datum', 'required'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<div class="form-group">
		<?php print Form::label('origin', 'Van', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::select('origin', array('home' => 'Huis', 'work' => 'Werk'), Input::old('origin', $expenses->origin), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<div class="form-group">
		<?php print Form::label('destination', 'Naar', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::select('destination', array('home' => 'Huis', 'work' => 'Werk'), Input::old('destination', $expenses->destination), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<div class="form-group">
		<?php print Form::label('price', 'Prijs', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<div class="input-group">
				<div class="input-group-addon">&euro;</div>
				<?php print Form::text('price', Input::old('price', $expenses->price), array('class' => 'form-control', 'placeholder' => 'Prijs', 'required'));?>
			</div> <!-- /.input-group -->
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /form-group -->
	<div class="form-group">
		<?php print Form::label('roundtrip', 'Retour', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::select('roundtrip', array('true' => 'Ja', 'false' => 'Nee'), Input::old('roundtrip', $expenses->roundtrip), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<?php print Form::submit('Wijzigen', array('class' => 'btn btn-info'));?>
			<?php print Form::reset('Opnieuw', array('class' => 'btn btn-default'));?>
			<a href="<?php print action('ExpensesController@getDelete', array($expenses->id));?>" class="btn btn-danger pull-right">Verwijderen</a>
		</div> <!-- /.col-sm-offset-2 /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<?php print Form::close();?>
</div> <!-- /.container -->