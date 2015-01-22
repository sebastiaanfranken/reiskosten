<div class="container">
	<ul class="nav nav-tabs">
		<li><a href="<?php print action('UserController@getProfile');?>">Je gegevens</a></li>
		<li><a href="<?php print action('UserController@getUpdate');?>">Je gegevens wijzigen</a></li>
		<?php if(Auth::user()->role == 'admin') : ?>
		<li class="active"><a href="<?php print action('UserController@getExport');?>">Je gegevens exporteren</a></li>
		<li><a href="<?php print action('UserController@getImport');?>">Je gegevens importeren</a></li>
		<?php endif;?>
	</ul> <!-- /.nav /.nav-tabs -->

	<h1 class="page-header">Gegevensexport van <?php print Auth::user()->fullname;?></h1>
	<p>Op dit moment is het alleen mogelijk om je reiskosten te exporteren.</p>

	<?php print Form::open(array('class' => 'form form-horizontal', 'role' => 'form'));?>
	<div class="form-group">
		<div class="col-sm-12">
			<?php print Form::submit('Exporteren', array('class' => 'btn btn-info'));?>
		</div> <!-- /.col-sm-offset-2 /.col-sm-10 -->
	</div> <!-- /.form-group -->
	<?php print Form::close();?>
</div> <!-- /.container -->