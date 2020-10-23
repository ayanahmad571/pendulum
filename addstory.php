<!DOCTYPE HTML>
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
		<title><?php echo $title ?> - Stories</title>
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
							<li><a href="home.php">Articles</a></li>
							<li><a href="podcasts.php">Podcasts</a></li>
							<li class="active"><a href="addstory.php">Add Stories </a></li>
							<li><a href="contact.php">Contact Us</a></li>
						</ul>
						<?php echo $icons; ?>
					</nav>

				<!-- Main -->

				<!-- Main -->
					<div id="main">
									<form method="post" action="master_action.php" enctype="multipart/form-data" class="alt">
										<div class="row uniform">
											<div class="6u 12u$(xsmall)">
                                            <strong>Name:</strong><br>
												<input type="text" name="story_name" required value="" placeholder="Name, Will be Displayed As Author Name" />
											</div>
											<div class="6u$ 12u$(xsmall)">
                                            <strong>Title of The Story (Max 20 Words):</strong>
												<input type="text" name="story_title" required value="" placeholder="Title of Your Story" maxlength="220" />
											</div>

											<!-- Break -->
											<div class="12u$">
												<strong>Upload Image (Max 2MB): </strong><input type="file" name="story_image"  />
											</div>
											<!-- Break -->


											<!-- Break -->
											<div class="12u$">
                                            <strong>Subtitle (Max 100 Words):</strong><br>
												<textarea name="story_subtitle" placeholder="Subtitle" required rows="2"  maxlength="1100" ></textarea>
											</div>
											<!-- Break -->

											<!-- Break -->
											<div class="12u$">
                                            <strong>The Content (Max 3500 Words):</strong><br>
												<textarea name="story_content" placeholder="Story" required rows="10" maxlength="40000" ></textarea>
											</div>
											<!-- Break -->

											<!-- Break -->
											<div class="6u$ 12u$(xsmall)">
												<input required type="checkbox" id="demo-copy" name="story_terms">
												<label for="demo-copy">I <a href="terms.php" onclick="window.open(this.href, 'Snopzer',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0,scrollbars=1'); return false;" >agree to the terms and conditions</a></label>
											</div>

											<div class="6u$ 12u$(xsmall)">
                                                <div class="g-recaptcha" data-sitekey="6LcgvikUAAAAAIFe_QS3sorSYTASK4oHiFr9Xn8Z"></div>
											</div>

											<div class="12u$">
												<ul class="actions">
													<li><input type="submit" name="story_add" value="Add Story" class="special" /></li>
												</ul>
											</div>

										</div>
									</form>

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