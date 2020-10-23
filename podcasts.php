<?php 
include('include.php');
?>

<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Podcasts</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <link rel="icon" href="images/Pendulum.png" />
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper" class="fade-in">

				<!-- Header -->
					<header id="header">
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<li><a href="home.php">Stories</a></li>
							<li class="active"><a href="podcasts.php">Podcasts</a></li>
							<li><a href="addstory.php">Add Stories </a></li>
							<li><a href="contact.php">Contact Us</a></li>
						</ul>
						<?php echo $icons; ?>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Posts -->
                            <section class="post">
								<header class="major">
									<span class="date"></span>
									<h1>Children after natural disaster?</h1>
									<p>By - Ayan and Ayush</p>
									<p><a href="https://www.youtube.com/watch?v=l-kctMsOJpc">https://www.youtube.com/watch?v=l-kctMsOJpc</a></p>
							</section>


					</div>

				<!-- Copyright -->
					<div id="copyright">
						<ul><li>&copy; <?php echo $sitebasics['bsc_copy']; ?></li></ul>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>


	</body>
</html>