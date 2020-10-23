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
							<li class="active"><a href="home.php">Articles</a></li>
                                                        
							<li><a href="podcasts.php">Podcasts</a></li>

							<li><a href="addstory.php">Add Stories </a></li>
							<li><a href="contact.php">Contact Us</a></li>
						</ul>
						<?php echo $icons; ?>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Featured Post -->
							<article style="padding-bottom:0" class="post featured">
								<header class="major">
									<span class="date"><?php echo date('F', time()); ?> <?php echo date('j', time()); ?>, <?php echo date('Y', time()); ?></span>
									<h2><a href="#"><?php echo $title; ?></a></h2>
								</header>
							</article>

						<!-- Posts -->
							<section id="posts" class="posts">
                            <?php
$sql = "SELECT * FROM tpt_stories where sto_valid =1 and sto_approved =1 order by sto_id desc limit 4";
$result = $conn->query($sql);
$lastis = '';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
?>
								<article>
									<header>
									<span class="date"><?php echo date('F j, Y', $row['sto_dnt']); ?></span>
										<h2><a href="story.php?id=<?php echo md5(sha1('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-'.$row['sto_id'])); ?>" ><?php echo $row['sto_title'] ?></a></h2>
									</header>
									<a href="story.php?id=<?php echo md5(sha1('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-'.$row['sto_id'])); ?>" class="image fit">
                                    <?php if($row['sto_image'] == '-'){ echo '<img src="images/pic03.jpg" alt="" />';}else{echo '<img src="'.$row['sto_image'].'" alt="" />';} ?>
                                    </a>
									<p><?php echo substr($row['sto_content'],0,100).'....' ?></p>
									<ul class="actions">
										<li><a href="story.php?id=<?php echo md5(sha1('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-'.$row['sto_id'])); ?>" class="button">Full Story</a></li>
									</ul>
								</article>

<?php
$lastis = $row['sto_id'];
    }
} else {
    echo "No Stories";
}							
							
							?>
							</section>
                            <input type="hidden" id="lastid" value="<?php echo $lastis; ?>" />

						<!-- Footer -->
                            <footer>
								<div id="delafnone" class="pagination">
									<!--<a href="#" class="previous">Prev</a>-->
									<a id="loadmore" class="next">Load More</a>
								</div>
							</footer>


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
            <script>
$(document).ready(function() {
	// Each time the user scrolls
$(document).on('click', '#loadmore', function(e){  
     e.preventDefault();
  btnval = $('#lastid').val();
		// End of the document reached?
			$.ajax({
				url: 'master_action.php',
				dataType: 'html',
				data:{lastid:btnval},
				success: function(data) {
					var parsedData =  jQuery.parseJSON(data);
					$('section#posts').append(parsedData[1]);
					$('#lastid').val(parsedData[0]);
					if(parsedData[2] == '1'){
						$("#delafnone").html('<p>That\'s All we got folks</p>');	
					}
			}
		});
	});
});
			</script>

	</body>
</html>