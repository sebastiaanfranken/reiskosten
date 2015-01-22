<div class="container">
	<ul class="nav nav-tabs">
		<li class="active"><a href="<?php print action('UserController@getProfile');?>">Je gegevens</a></li>
		<li><a href="<?php print action('UserController@getUpdate');?>">Je gegevens wijzigen</a></li>
		<?php if(Auth::user()->role == 'admin') : ?>
		<li><a href="<?php print action('UserController@getExport');?>">Je gegevens exporteren</a></li>
		<li><a href="<?php print action('UserController@getImport');?>">Je gegevens importeren</a></li>
		<?php endif;?>
	</ul> <!-- /.nav /.nav-tabs -->

	<h1 class="page-header">Profiel van <?php print $user->fullname;?></h1>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Sleutel</th>
				<th>Waarde</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td>Gebruikersnaam</td>
				<td><?php print $user->username;?></td>
			</tr>
			<tr>
				<td>Volledige naam</td>
				<td><?php print $user->fullname;?></td>
			</tr>
			<tr>
				<td>Postcode thuis</td>
				<td><?php print $user->zipcode_home;?></td>
			</tr>
			<tr>
				<td>Bankrekeningnummer</td>
				<td><?php print $user->bankaccount;?></td>
			</tr>
			<?php if(!$preferences->isEmpty()) : ?>
			<tr>
				<?php foreach($preferences as $preference) : ?>
				<td><?php print replace($preference->meta_key, $preferencesLabels);?></td>
				<td><?php print $preference->meta_value == 'roundtrip' ? 'Retour' : 'Enkele reis';?></td>
				<?php endforeach;?>
			</tr>
			<?php else : ?>
			<tr>
				<td colspan="2"><em>Geen custom voorkeuren</em></td>
			</tr>
			<?php endif;?>
		</tbody>
	</table> <!-- /.table /.table-striped -->
</div> <!-- /.container -->