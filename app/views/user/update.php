<div class="container">
	<ul class="nav nav-tabs">
		<li><a href="<?php print action('UserController@getProfile');?>">Je gegevens</a></li>
		<li class="active"><a href="<?php print action('UserController@getUpdate');?>">Je gegevens wijzigen</a></li>
		<?php if(Auth::user()->role == 'admin') : ?>
		<li><a href="<?php print action('UserController@getExport');?>">Je gegevens exporteren</a></li>
		<li><a href="<?php print action('UserController@getImport');?>">Je gegevens importeren</a></li>
		<?php endif;?>
	</ul> <!-- /.nav /.nav-tabs -->

	<h1 class="page-header">Je gegevens aanpassen</h1>

	<?php if(isset($errors) && count($errors) > 0) : ?>
	<div class="alert alert-danger">
		<ul>
			<?php foreach($errors->all() as $error) : ?>
			<li><?php print $error;?></li>
			<?php endforeach;?>
		</ul>
	</div> <!-- /.alert /.alert-danger -->
	<?php endif;?>

	<?php print Form::model($user, array('class' => 'form-horizontal', 'role' => 'form'));?>
	<div class="form-group">
		<?php print Form::label('fullname', 'Je naam', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::text('fullname', Input::old('fullname'), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<div class="form-group">
		<?php print Form::label('zipcode_home', 'Postcode thuis', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::text('zipcode_home', Input::old('zipcode_home'), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<div class="form-group">
		<?php print Form::label('bankaccount', 'Bankrekening (IBAN)', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::text('bankaccount', Input::old('bankaccount'), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<!-- Custom preferences from here -->
	<div class="form-group">
		<?php print Form::label('roundtrip_preference', 'Retour of enkele reis', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::select('roundtrip_preference', array('singletrip' => 'Enkele reis', 'roundtrip' => 'Retour'), Meta::userField('roundtrip_preference', Auth::user()->id), array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<?php print Form::submit('Wijzigen', array('class' => 'btn btn-info'));?>
			<?php print Form::reset('Opnieuw', array('class' => 'btn btn-default'));?>
		</div> <!-- /.col-sm-offset-2 /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<?php print Form::close();?>
</div> <!-- /.container -->