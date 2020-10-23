<?php
if(include('include.php')){
}else{
die('##errMASTERofUSErERROR');
}

if((count($_POST) > 0)  or (count($_GET) > 0)){
	if((count($_POST) > 0)){
		if(isset($_SERVER['HTTP_REFERER'])){
		}else{
			die('Refferer Not Found');
		}
		if((strpos($_SERVER['HTTP_REFERER'],'http://communityvoice.ddns.net') == '0') or (strpos($_SERVER['HTTP_HOST'],'http://localhost/') == '0') or (strpos($_SERVER['HTTP_REFERER'],'http://192.168.1.') == '0'))
	{
	  //only process operation here
	}else{
		die('Only tld process are allowed');
	}
	}

}else{
	
	die(header('Location: master-action.php'));
	
}

/*
var_dump($_POST);
var_dump($_FILES);

foreach($_POST as $pkey=>$pval){
	echo '
	#---------------------------------------<br>
		if(isset($_POST[\''.$pkey.'\'])){<br>
		&nbsp;&nbsp;if(!is_string($_POST[\''.$pkey.'\'])){<br>
		&nbsp;&nbsp;die(\'Invalid Characters used in '.$pkey.'\');
		&nbsp;&nbsp;}<br>
		&nbsp;&nbsp;else{}<br>
		}else{<br>
		&nbsp;&nbsp;die(\'Enter '.$pkey.'\');<br>
		}<br>
	';
}
*/
/*---------------Home----------------*/
if(isset($_GET['lastid'])){
	if(!is_numeric($_GET['lastid'])){
		die();
	}
	$asoc = array();
	
	$sql = "SELECT * FROM tpt_stories where sto_valid =1 and sto_approved =1 and sto_id < ".$_GET['lastid']."  order by sto_id desc limit 4 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	$lid = '';
    while($row = $result->fetch_assoc()) {
$asoc[] = '								<article>
									<header>
									<span class="date">'.date('F j, Y', $row['sto_dnt']).'</span>
										<h2><a href="story.php?id='.md5(sha1('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-'.$row['sto_id'])).'" >'.$row['sto_title'].'</a></h2>
									</header>
									<a href="story.php?id='.md5(sha1('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-'.$row['sto_id'])).'" class="image fit">'.
                                    ($row['sto_image'] == '-' ? '<img src="images/pic03.jpg" alt="" />' : '<img src="'.$row['sto_image'].'" alt="" />').'
                                    </a>
									<p>'.substr($row['sto_content'],0,100).'....</p>
									<ul class="actions">
										<li><a href="story.php?id='.md5(sha1('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-'.$row['sto_id'])).'" class="button">Full Story</a></li>
									</ul>
								</article>';
								$lid = $row['sto_id'];
	}
} else {
    echo "That's All we got Amigos";
}
if($lid < 4 ){
	$d = 1;
}else{
	$d = 0;
}

	$callback = array($lid,implode('',$asoc),$d);
	echo json_encode($callback);
}
/*------------Add Story--------------------*/
if(isset($_POST['story_add'])){
#---------------------------------------
if(isset($_POST['story_name'])){
  if(!is_string($_POST['story_name'])){
  die('Invalid Characters used in story_name');   }
  else{}
}else{
  die('Enter Author Name');
}
#---------------------------------------
if(isset($_POST['story_title'])){
  if(!is_string($_POST['story_title'])){
  die('Invalid Characters used in story_title');   }
  else{}
}else{
  die('Enter Story Title');
}
#---------------------------------------
if(isset($_POST['story_subtitle'])){
  if(!is_string($_POST['story_subtitle'])){
  die('Invalid Characters used in story_subtitle');   }
  else{}
}else{
  die('Enter Story Subtitle');
}
#---------------------------------------
if(isset($_POST['story_content'])){
  if(!is_string($_POST['story_content'])){
  die('Invalid Characters used in story_content');   }
  else{}
}else{
  die('Enter Story Content');
}
#---------------------------------------
if(isset($_POST['story_terms'])){
  if(!is_string($_POST['story_terms'])){
  die('Invalid Characters used in story_terms');   }
  else{}
}else{
  die('Accept Terms and Conditions');
}
#---------------------------------------
if(isset($_POST['g-recaptcha-response'])){
  if(!is_string($_POST['g-recaptcha-response'])){
  die('Invalid Characters used in g-recaptcha-response');   }
  else{}
}else{
  die('Enter g-recaptcha-response');
}
#---------------------------------------



  	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LcgvikUAAAAAKXxvYCTKQzgSTnG8mDqHun1PH3e',
		'response' => $_POST["g-recaptcha-response"],
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'header' =>  "Content-Type: application/x-www-form-urlencoded\r\n",
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		#die('Captcha Failed Try Again');
	}
	
	
$st_name = $_POST['story_name'];	
$st_title = $_POST['story_title'];	
$st_subtitle = $_POST['story_subtitle'];	
$st_content = $_POST['story_content'];


if((str_word_count($st_name) > 100) or(str_word_count($st_title) > 100) or (str_word_count($st_subtitle) > 4000) or (str_word_count($st_content) > 6000)){
	die('Word Count Exceded in either Name, Title, Subtitle or Content');
}
 
if(isset($_FILES['story_image']) and ($_FILES['story_image']['size'] > 0) ){
					
					$target_dir = "post_images/";
$ext =  extension(basename($_FILES["story_image"]["name"]));

$target_file = $target_dir .md5($st_name.$st_title.sha1((time().uniqid()))).'.'.$ext;

$uploadOk = 1;
$imageFileType = strtolower($ext);
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["story_image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["story_image"]["size"] > 3000000) {
    echo "Sorry, your file is too large. <br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    die("<br>Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["story_image"]["tmp_name"], $target_file) ) {
		


    } else {
        die( "Sorry, there was an error uploading your file.");
    }
}

}else{
$target_file = '-';
}

$insert = "INSERT INTO `tpt_stories`(`sto_author_name`, `sto_keywords`, `sto_title`, `sto_subtitle`, `sto_image`, `sto_content`, `sto_dnt`, `sto_ip`) VALUES 

(
'".$st_name."',
'-',
'".$st_title."',
'".$st_subtitle."',
'".$target_file."',
'".$st_content."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."'
)";

if($conn->query($insert)){
	header('Location: story.php?id='.md5(sha1('blowfishsecretnottobesharedhellohiiamayanthecoder.][.,;;()(.=-=-'.$conn->insert_id)));
}else{
	die('Couldn\'t Insert post');
}

}
/*-------------Contact-------------------*/
if(isset($_POST['contact'])){
	#---------------------------------------
if(isset($_POST['name'])){
  if(!is_string($_POST['name'])){
  die('Invalid Characters used in name');   }
  else{}
}else{
  die('Enter name');
}
#---------------------------------------
if(isset($_POST['email'])){
  if(!is_email($_POST['email'])){
  die('Invalid Characters used in email');   }
  else{}
}else{
  die('Enter email');
}
#---------------------------------------
if(isset($_POST['message'])){
  if(!is_string($_POST['message'])){
  die('Invalid Characters used in message');   }
  else{}
}else{
  die('Enter message');
}
#---------------------------------------
if(isset($_POST['g-recaptcha-response'])){
  if(!is_string($_POST['g-recaptcha-response'])){
  die('Invalid Characters used in g-recaptcha-response');   }
  else{}
}else{
  die('Enter g-recaptcha-response');
}
#---------------------------------------



  	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6LcgvikUAAAAAKXxvYCTKQzgSTnG8mDqHun1PH3e',
		'response' => $_POST["g-recaptcha-response"],
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'header' =>  "Content-Type: application/x-www-form-urlencoded\r\n",
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		die('Captcha Failed Try Again');
	}


$name = $_POST['name'];
$email= $_POST['email'];
$msg = $_POST['message'];

if((str_word_count($name) >500) or(str_word_count($email) > 500) or (str_word_count($name) > 50000)){
	die('Word Limit Exceeded');
}

$insert = "INSERT INTO `tpt_contact`( `ct_email`, `ct_name`, `ct_msg`, `ct_ip`, `ct_dnt`) VALUES (
'".$email."',
'".$name."',
'".$msg."',
'".$_SERVER['REMOTE_ADDR']."',
'".time()."'
)";
if($conn->query($insert)){
	header('Location: contact.php?oauth='.md5(time()));
}else{
	die('ERRORMA238');
}

}

?>
