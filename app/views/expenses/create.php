<div class="container">
	<h1 class="page-header">Reis toevoegen</h1>

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
	<?php if(Meta::userField('roundtrip_preference', Auth::user()->id) == false || Meta::userField('roundtrip_preference', Auth::user()->id) == 'roundtrip') : ?>
	<input type="hidden" name="origin" value="home" />
	<input type="hidden" name="destination" value="work" />
	<input type="hidden" name="roundtrip" value="true" />
	<?php endif;?>
	<div class="form-group">
		<?php print Form::label('date', 'Datum', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::text('date', Input::old('date', timestamp('now')), array('class' => 'form-control', 'placeholder' => 'Datum', 'required'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<?php if(Meta::userField('roundtrip_preference', Auth::user()->id) == 'singletrip') : ?>
	<div class="form-group">
		<?php print Form::label('origin', 'Van', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::select('origin', array('home' => 'Huis', 'work' => 'Werk'), Input::old('origin', 'home'), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<div class="form-group">
		<?php print Form::label('destination', 'Naar', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::select('destination', array('home' => 'Huis', 'work' => 'Werk'), Input::old('destination', 'work'), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<?php endif;?>
	<div class="form-group">
		<?php print Form::label('price', 'Prijs', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<div class="input-group">
				<div class="input-group-addon">&euro;</div>
				<?php print Form::text('price', Input::old('price'), array('class' => 'form-control', 'placeholder' => 'Prijs', 'required'));?>
			</div> <!-- /.input-group -->
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /form-group -->
	<?php if(Meta::userField('roundtrip_preference', Auth::user()->id) == 'singletrip') : ?>
	<div class="form-group">
		<?php print Form::label('roundtrip', 'Retour', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::select('roundtrip', array('true' => 'Ja', 'false' => 'Nee'), Input::old('roundtrip', 'false'), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<?php endif;?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<?php print Form::submit('Versturen', array('class' => 'btn btn-info'));?>
			<?php print Form::reset('Opnieuw', array('class' => 'btn btn-default'));?>
		</div> <!-- /.col-sm-offset-2 /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<?php print Form::close();?>
</div> <!-- /.container -->