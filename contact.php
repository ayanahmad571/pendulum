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
		<title><?php echo $title ?> - Contact</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <link rel="icon" href="images/Pendulum.png" />
		<script src='https://www.google.com/recaptcha/api.js'></script>

	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper" class="fade-in">

				<!-- Intro -->
					<div id="intro">
						<h1><?php echo $title;?></h1>
						<p><?php echo $subheading ?></p>
						<ul class="actions">
							<li><a href="#header" class="button icon solo fa-arrow-down scrolly">Continue</a></li>
						</ul>
					</div>

				<!-- Header -->
					<header id="header">
						<a href="#" class="logo"><?php echo $title; ?></a>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<li><a href="home.php">Stories</a></li>
							<li><a href="addstory.php">Add Stories </a></li>
							<li class="active"><a href="contact.php">Contact Us</a></li>
						</ul>
						<?php echo $icons; ?>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Posts -->
                        <?php 
						if(!isset($_GET['oauth'])){
						?>
							<section id="posts" class="posts">
					<section>
							<form method="post" action="master_action.php">
								<div class="field">
									<label for="name">Name</label>
									<input type="text" name="name" id="name" />
								</div>
								<div class="field">
									<label for="email">Email</label>
									<input type="text" name="email" id="email" />
								</div>
								<div class="field">
									<label for="message">Message</label>
									<textarea name="message" id="message" rows="3"></textarea>
								</div>
                                <div class="field">
                                    <div class="g-recaptcha" data-sitekey="6LcgvikUAAAAAIFe_QS3sorSYTASK4oHiFr9Xn8Z"></div>
                                </div>

								<ul class="actions">
									<li><input type="submit" name="contact" value="Send Message" /></li>
								</ul>
							</form>
						</section>
						<section class="split contact">
							<section class="alt">
								<h3>Address</h3>
								<p>Somewhere on Planet Earth</p>
							</section>
<?php	/*						<section>
								<h3>Phone</h3>
								<p><a href="#">(971) 55-952-3302</a></p>
							</section> */ ?>
							<section>
								<h3>Email</h3>
								<p><a>thependuluminfo@gmail.com</a></p>
							</section>
							<section>
								<h3>Social</h3>
						<?php echo $icons; ?>
							</section>
						</section>							
                        </section>
                        <?php 
						}else{
							?>
                            <section id="posts" class="posts">
								<p>Our Team Will surely get back to you!</p>						
                        </section>
                            <?php
						}
						?>



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