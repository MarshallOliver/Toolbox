<!DOCTYPE html>

<html>

<head>
	<link rel="stylesheet" href="http://toolbox.andrettikarting.com/css/app.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
	<title>@yield('title')</title>
</head>
<body>
	<nav class="navbar" role="navigation" aria-label="main navigation">
		<div class="container">

			<div id="navigation" class="navbar-menu">
				<div class="navbar-start">
					<a href="/" class="navbar-item">
						Home
					</a>

					<a class="navbar-item" href="https://github.com/MarshallOliver/Toolbox">
						Github
					</a>

				</div>

				<div class="navbar-end">
					<div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link">
							Settings
						</a>

						<div class="navbar-dropdown">
							<a class="navbar-item" href="/locations">
								Locations
							</a>

						</div>
					</div>
				</div>

			</div>

		</div>	
	</nav>

	@yield('content')

</body>
</html>