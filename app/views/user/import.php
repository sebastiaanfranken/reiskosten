<div class="container">
	<ul class="nav nav-tabs">
		<li><a href="<?php print action('UserController@getProfile');?>">Je gegevens</a></li>
		<li><a href="<?php print action('UserController@getUpdate');?>">Je gegevens wijzigen</a></li>
		<?php if(Auth::user()->role == 'admin') : ?>
		<li><a href="<?php print action('UserController@getExport');?>">Je gegevens exporteren</a></li>
		<li class="active"><a href="<?php print action('UserController@getImport');?>">Je gegevens importeren</a></li>
		<?php endif;?>
	</ul> <!-- /.nav /.nav-tabs -->

	<h1 class="page-header">Gegevensimport voor <?php print Auth::user()->fullname;?></h1>

	<?php print Form::open(array('class' => 'form form-horizontal', 'role' => 'form'));?>
	<div class="form-group">
		<?php print Form::label('file', 'Exportbestand', array('class' => 'col-sm-2 control-label'));?>
		<div class="col-sm-10">
			<?php print Form::file('file', array('class' => 'form-control'));?>
		</div> <!-- /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<?php print Form::submit('Importeren', array('class' => 'btn btn-info'));?>
		</div> <!-- /.col-sm-offset-2 /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<?php print Form::close();?>
</div> <!-- /.container -->