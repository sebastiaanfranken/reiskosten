<div class="container">
	<h1 class="page-header">Dashboard</h1>

	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="<?php print action('DashboardController@getIndex');?>">Gebruikers</a></li>
		<li><a href="<?php print action('DashboardController@getCreateUser');?>">Gebruiker toevoegen</a></li>
		<li><a href="<?php print action('DashboardController@getOverview');?>">Globaal reiskostenoverzicht</a></li>
	</ul> <!-- /.nav /.nav-tabs -->

	<div class="tab-content">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Gebruikersnaam</th>
					<th>Rol</th>
					<th>Acties</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($users as $user) : ?>
				<tr>
					<td><?php print $user->fullname;?></td>
					<td><?php print replace($user->role, array('admin' => 'Beheerder', 'user' => 'Gebruiker'));?></td>
					<td>
						<a href="<?php print action('DashboardController@getUpdateUser', array($user->id));?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Wijzigen</a>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table> <!-- /.table /.table-striped -->
	</div> <!-- /.tab-content -->
</div> <!-- /.container -->