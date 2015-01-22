<!DOCTYPE html>

<html lang="nl">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Smart Internet Work Reiskosten</title>
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/application.css" />
		<script type="text/javascript" src="/js/jquery.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script type="text/javascript">
		jQuery(document).ready(function($) {

		});
		</script>
	</head>

	<body>
		<header class="nav navbar-static-nav siw-navbar" role="banner">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".siw-navbar">
						<span class="sr-only">Toggle navigatie</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button> <!-- /.navbar-toggle -->

					<a href="<?php print action('ExpensesController@getIndex');?>" class="navbar-brand">SIW Reiskosten</a>
				</div> <!-- /.navbar-header -->

				<nav class="collapse navbar-collapse siw-navbar-collapse" role="navigation">
					<ul class="nav navbar-nav">
						<li><a href="<?php print action('ExpensesController@getIndex');?>">Reisoverzicht</a></li>
						<?php /* <li><a href="<?php print action('ExpensesController@getDeclarePeriod');?>">Reis declareren per periode</a></li> */ ?>
						<li><a href="<?php print action('ExpensesController@getDeclare', array('normal'));?>">Declareren</a></li>
					</ul> <!-- /.nav /.navbar-nav -->

					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php print action('UserController@getProfile');?>"><?php print Auth::user()->fullname;?></a></li>
						<?php if(Auth::user()->role == 'admin') : ?>
						<li><a href="<?php print action('DashboardController@getIndex');?>">Dashboard</a></li>
						<?php endif;?>
						<li><a href="<?php print URL::to('/logout');?>">Uitloggen</a></li>
					</ul> <!-- /.nav /.navbar-nav /.navbar-right -->
				</nav> <!-- /.collapse /.navbar-collapse /.siw-navbar-collapse -->
			</div> <!-- /.container -->
		</header> <!-- /.nav /.navbar-static-nav /.siw-navbar -->

		<div class="container">
			<div class="alert alert-warning siw-top-alert">
				Deze applicatie is op dit moment nog in ontwikkeling, met alle gevaren van dien.
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button> <!-- /.close -->
			</div> <!-- /.alert /.alert-warning -->

			<?php if(Session::has('message')) : ?>
			<div class="alert alert-info">
				<?php print Session::get('message');?>
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button> <!-- /.close -->
			</div> <!-- /.alert /.alert-info -->
			<?php endif;?>
		</div> <!-- /.container -->

		<?php print $content;?>
	</body>
</html>
