<?php 
include('include.php');
?>
<?php 
if(isset($_GET['id'])){
	if(!ctype_alnum($_GET['id'])){
		header('Location: home.php');
		die();
	}
	$getstory = getdatafromsql($conn, "select * from tpt_stories where md5(sha1(concat('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-',sto_id))) = '".$_GET['id']."' ");
	if(!is_array($getstory)){
		header('Location: home.php');
		die();
	}
}else{
	header('Location: home.php');
	die();
}
?>

<?php 


if($getstory['sto_approved'] == '0'){
#Yet to get approved

if($getstory['sto_ip'] == $_SERVER['REMOTE_ADDR']){
	{
?>
<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Approval Awaited <?php echo strip_tags($getstory['sto_title']);  ?> - Pened By  <?php echo strip_tags($getstory['sto_author_name']); ?></title>
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
							<li><a href="addstory.php">Add Stories </a></li>
							<li><a href="contact.php">Contact Us</a></li>
						</ul>
						<?php echo $icons; ?>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Posts -->
                            <section class="post">
                            	<p>Your Article will be live in no time.<br> Visit this page after 24 hours to see your article.</p>
                            	<p>Your Link: <a><strong><?php echo $serverlink.'/story.php?id='.md5(sha1('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-'.$getstory['sto_id'])) ?></strong></a></p>
							</section>


					</div>

				<!-- Copyright -->
					<div id="copyright">
						<ul><li>&copy; <?php echo $sitebasics['bsc_copy']; ?></li></ul>
					</div>

			</div>

	</body>
</html>
<?php
	}
}else{
	header('Location: home.php');
	die();
}


die;
}else if($getstory['sto_approved'] == '2'){
#Disapproved
{
	$getreason = getdatafromsql($conn, "select * from tpt_disapprovals where daprvl_rel_sto_id = ".$getstory['sto_id']." and daprvl_valid = 1");
	if(is_array($getreason)){
		$reasonfordisap = $getreason['daprvl_desc'];
	}else{
		$reasonfordisap = 'There is no reason, it\'s all we know';
	}
	
?>

<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Disapproved Article <?php echo strip_tags($getstory['sto_title']);  ?> - Pened By  <?php echo strip_tags($getstory['sto_author_name']); ?></title>
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
							<li><a href="addstory.php">Add Stories </a></li>
							<li><a href="contact.php">Contact Us</a></li>
						</ul>
						<?php echo $icons; ?>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Posts -->
                            <section class="post">
                            	<p>The Article has been disapproved by our team due to the following reason:</p>
                                <hr>
                            	<p><?php echo $reasonfordisap; ?></p>
							</section>


					</div>

				<!-- Copyright -->
					<div id="copyright">
						<ul><li>&copy; <?php echo $sitebasics['bsc_copy']; ?></li></ul>
					</div>

			</div>

	</body>
</html>

<?php
}
die;
}



?>
<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo strip_tags($getstory['sto_title']);  ?> - Pened By  <?php echo strip_tags($getstory['sto_author_name']); ?></title>
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
							<li><a href="home.php">Articles</a></li>
                                                        
							<li><a href="podcasts.php">Podcasts</a></li>

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
									<span class="date"><?php echo date('F j, Y', $getstory['sto_dnt']); ?></span>
									<h1><?php echo $getstory['sto_title'] ?></h1>
									<p>Pened By - <?php echo $getstory['sto_author_name'] ?></p>
									<p><?php echo ($getstory['sto_subtitle'] == '-' ?  '' : $getstory['sto_subtitle']) ?></p>
								</header>
                                <?php if($getstory['sto_image'] == '-'){
									echo '<div class="image main"><img src="images/pic01.jpg" alt="Image not loaded, refresh page" /></div>';
									}else{
									echo '<div class="image main"><img src="'.$getstory['sto_image'].'" alt="Image not loaded, refresh page" /></div>';
								} ?>
								<p><?php echo $getstory['sto_content'] ?></p>
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