<div class="container">
	<h1 class="page-header">Dashboard</h1>

	<ul class="nav nav-tabs" role="tablist">
		<li><a href="<?php print action('DashboardController@getIndex');?>">Gebruikers</a></li>
		<li><a href="<?php print action('DashboardController@getCreateUser');?>">Gebruiker toevoegen</a></li>
		<li><a href="<?php print action('DashboardController@getOverview');?>">Globaal reiskostenoverzicht</a></li>
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
	
		<?php print Form::model($user, array('class' => 'form-horizontal', 'role' => 'form'));?>
		<div class="form-group">
			<?php print Form::label('username', 'Gebruikersnaam', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::text('username', Input::old('username'), array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Een gebruikersnaam zonder spaties graag'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('fullname', 'Echte naam', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::text('fullname', Input::old('fullname'), array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'De echte naam van de gebruiker'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('password', 'Wachtwoord', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::password('password', array('class' => 'form-control', 'placeholder' => 'Het wachtwoord'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('password_check', 'Controle wachtwoord', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::password('password_check', array('class' => 'form-control', 'placeholder' => 'Het wachtwoord, nogmaals'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('role', 'Rol', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::select('role', array('user' => 'Gebruiker', 'admin' => 'Beheerder'), Input::old('role', 'user'), array('class' => 'form-control', 'required' => 'required'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('bankaccount', 'Bankrekening (IBAN)', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::text('bankaccount', Input::old('bankaccount'), array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Een geldig IBAN rekeningnummer'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<?php print Form::label('zipcode_home', 'Postcode thuis', array('class' => 'col-sm-2 control-label'));?>
			<div class="col-sm-10">
				<?php print Form::text('zipcode_home', Input::old('zipcode_home'), array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'De postcode van thuis'));?>
			</div> <!-- /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<?php print Form::submit('Opslaan', array('class' => 'btn btn-info'));?>
				<?php print Form::reset('Opnieuw', array('class' => 'btn btn-default'));?>
				<a href="<?php print action('DashboardController@getDeleteUser', array($user->id));?>" class="btn btn-danger pull-right">Verwijderen</a>
			</div> <!-- /.col-sm-offset-2 /.col-sm-10 -->
		</div> <!-- /.form-group -->
		<?php print Form::close();?>
	</div> <!-- /.tab-content -->
</div> <!-- /.container -->