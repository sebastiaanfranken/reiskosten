<!DOCTYPE html>

<html lang="nl">
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Sebastiaan Franken" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Reiskostendeclaratie</title>
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/pdf.css" />
	</head>

	<body>
		<div class="container">
			<header id="top-header">
				<img src="/images/logo-siw.svg" class="company-logo" />
				<h1>Reiskostendeclaratie</h1>
			</header> <!-- /#top-header -->

			<section>
				<h3>Werknemersgegevens</h3>
				<table class="table">
					<tr>
						<td>Naam</td>
						<td><?php print $user->fullname;?></td>
					</tr>
					<tr>
						<td>Afdeling</td>
						<td></td>
					</tr>
					<tr>
						<td>Inleverdatum</td>
						<td><?php print timestamp(date('d-m-Y'));?></td>
					</tr>
					<tr>
						<td>Bankrekeningnummer</td>
						<td><?php print $user->bankaccount;?></td>
					</tr>
					<tr>
						<td>Handtekening</td>
						<td></td>
					</tr>
				</table>
			</section>

			<section>
				<h3>Overzicht</h3>
				<?php if(count($trips) > 0) : ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Datum</th>
							<th>Van</th>
							<th>Naar</th>
							<th>Bedrag &euro;</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach($trips as $trip) : $total += $trip->price; ?>
						<tr>
							<td><?php print timestamp($trip->date, null, 'd-m-Y');?></td>
							<td><?php print replace($trip->origin, $labels);?></td>
							<td><?php print replace($trip->destination, $labels);?></td>
							<td>&euro; <?php print number_format($trip->price, 2, ',', '.');?></td>
						</tr>
						<?php endforeach;?>
						<tr>
							<td></td>
							<td></td>
							<td>Totaal</td>
							<td><strong>&euro; <?php print number_format($total, 2, ',', '.');?></strong></td>
						</tr>
					</tbody>
				</table> <!-- /.table /.table-striped -->
				<?php else : ?>
				<p>Hier ging iets niet goed.</p>
				<?php endif;?>
			</section>

			<section>
				<h3>Administratief</h3>
				<table class="table">
					<tr>
						<td>Betaald op</td>
						<td></td>
					</tr>
					<tr>
						<td>Opmerkingen</td>
						<td></td>
					</tr>
				</table>
			</section>
		</div> <!-- /.container -->
	</body>
</html>