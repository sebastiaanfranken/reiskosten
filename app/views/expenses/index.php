<div class="container">
	<h1 class="page-header">Reiskostenoverzicht</h1>

	<ul class="nav nav-tabs" role="tablist">
		<?php foreach($expenses as $counter => $values) : ?>
		<li <?php print ($counter == date('m')) ? 'class="active"' : '';?>>
			<a href="#<?php print strtolower($months[$counter]);?>" role="tab" data-toggle="tab"><?php print $months[$counter];?></a>
		</li>
		<?php endforeach;?>
	</ul> <!-- /.nav /.nav-tabs -->

	<div class="tab-content">
		<?php foreach($expenses as $counter => $values) : ?>
		<div class="tab-pane <?php print ($counter == date('m')) ? 'active' : '';?>" id="<?php print strtolower($months[$counter]);?>">
			<?php if(count($values) > 0) : ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Datum</th>
						<th>Van</th>
						<th>Naar</th>
						<th>Bedrag</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($values as $value) : $year = $value->date->year; $month = $value->date->month; ?>
					<tr>
						<td><?php print timestamp($value->date);?></td>
						<td><?php print replace($value->origin, $labels);?></td>
						<td><?php print replace($value->destination, $labels);?></td>
						<td>&euro; <?php print number_format($value->price, 2, ',', '.');?></td>
						<td>
							<a href="<?php print action('ExpensesController@getUpdate', array($value->id));?>"><span class="glyphicon glyphicon-edit"></span> Wijzigen</a>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table> <!-- /.table /.table-striped -->
			<!-- <a href="<?php print URL::to('rapport', array($year, $month));?>" class="btn btn-info">Declareren</a> -->
			<a href="<?php print action('ExpensesController@getCreate');?>" class="btn btn-info">Reis toevoegen</a>
			<?php else : ?>
			<p>Je hebt voor deze maand nog geen reiskosten ingevoerd. Wil je dat <a href="<?php print action('ExpensesController@getCreate');?>">nu doen</a>?</p>
			<?php endif;?>
		</div> <!-- /.tab-pane /#<?php print strtolower($months[$counter]);?> -->
		<?php endforeach;?>
	</div> <!-- /.tab-content -->
</div> <!-- /.container -->