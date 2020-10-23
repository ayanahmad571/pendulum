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
		if((strpos($_SERVER['HTTP_REFERER'],'http://stilewell.ddns.net') == '0') or (strpos($_SERVER['HTTP_HOST'],'http://localhost/') == '0') or (strpos($_SERVER['HTTP_REFERER'],'http://192.168.1.') == '0'))
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
if(isset($_POST['from_email']) and isset($_POST['from_name']) and isset($_POST['subj_ml']) and isset($_POST['message_ml'])){
	
	$email = $_POST['from_email'];
	$name = $_POST['from_name'];
	$subject = $_POST['subj_ml'];
	$message = $_POST['message_ml'];
	$hash = md5(sha1($_SERVER['REMOTE_ADDR']));
	$ip = $_SERVER['REMOTE_ADDR'];
	$timest = time();	
	
	
$sql = "INSERT INTO `mun_mails`(`ml_from_email`, `ml_from_name`, `ml_subject`, `ml_body`, `ml_hash`, `ml_from_ip`, `mun_time`) VALUES (
'".$email."',
'".$name."',
'".$subject."',
'".$message."',
'".$hash."',
'".$ip."',
'".$timest."'
)";

if ($conn->query($sql) === TRUE) {
    header('Location: home.php?mailsent');
} else {
  die('#ERRMASTACT1');
}

	
}
#
if(isset($_POST['ok'])){
if(!isset($_POST['usr_nm']) or !isset($_POST['usr_pass']) or !isset($_POST['usr_eml'])){
	die('Please Enter all the data');
}


$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
if(($ip=='::1') or (strpos($ip,'192.168.1.40') === true)){
	
}


$email = $_POST['usr_eml'];
$name =  $_POST['usr_nm'];
$pw = md5(md5(sha1($_POST['usr_pass'])));

########################################################################################################3
$ui = explode(' ',$name);
$fn = str_split($ui[0]);
$ln = str_split(end($ui));
$fncount = count($fn)-1;
$lncount = count($ln)-1;
$ujl=array();
for($sa=0;$sa<9;$sa++){
	$fr = rand(1,2);
	if($fr==1){
		$sr = rand(0,$fncount);
		$ujl[]=$fn[$sr];
	}else if($fr==2){
		$tr = rand(0,$lncount);
		$ujl[]=$ln[$tr];
	}else{
		die('ERROR#MA3');
	}
	
}
#######################################################################################################3


$usr = strtolower($ujl[0].$ujl[1].$ujl[3].$ujl[4].$ujl[5].$ujl[6].$ujl[7].$ujl[8].rand(1,10));

$iv = 1098541894 .rand(100000,999999);
$regtm = time();
$regip = $_SERVER['REMOTE_ADDR'];
$hash = gen_hash($pw,$email);
#pass and email and secret md5(sha1())


$sqla = "
INSERT INTO `sw_logins`(`lum_rel_tu_id`,`lum_email`, `lum_username`, `lum_password`, `lum_hash_mix`) VALUES (
'2',
'".$email."',
'".$usr."',
'".$pw."',
'".$hash."'
)
";


if ($conn->query($sqla) === TRUE) {
	
	$ltid = $conn->insert_id;
	$sqlb = "INSERT INTO `sb_users`(`usr_rel_sch_id`,`usr_name`, `usr_rel_lum_id`,  `usr_iv`, `usr_reg_dnt`, `usr_reg_ip`) VALUES (
'0',
'".$name."',
'".$ltid."',
'".$iv."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."'
)";

	if ($conn->query($sqlb) === TRUE) {
	
    header('Location: login.php');
} else {
    echo $conn->error."Error##ma55";
}
	
    } else {
    die($conn->error."Error###maa4");
}


}
#
if(isset($_POST['lo_eml']) and isset($_POST['lo_pass'])){
	
	$eml=$_POST['lo_eml'];
	$pas=md5(md5(sha1($_POST['lo_pass'])));
	$hash = gen_hash($pas,$eml);
	
	if(ctype_alnum($eml) or is_numeric($eml) or is_email($eml)){
	}else{
		die("Invalid Email");
	}
	 
	
	if(ctype_alnum($hash.$pas)){
	}else{
		die("Credentials Not valid");
	}
	
	
$selectusersfromdbsql = "SELECT * FROM sw_logins where 
lum_email= '".$eml."' and
lum_password = '".$pas."' and
lum_hash_mix= '".$hash."' and
lum_valid = 1

";
$usrres = $conn->query($selectusersfromdbsql);
if ($usrres->num_rows == 1) {
    // output data of each row
    while($usrrw = $usrres->fetch_assoc()) {
        session_regenerate_id();

			$selectusersdatafromdbsql = "
SELECT * FROM sw_users where 
usr_rel_lum_id = '".$usrrw['lum_id']."' and usr_valid =1";
echo $selectusersfromdbsql	;
$dataobbres = $conn->query($selectusersdatafromdbsql);

if ($dataobbres->num_rows == 1) {
    // output data of each row
    while($dataobbrw = $dataobbres->fetch_assoc()) {
		###
        session_regenerate_id();
		
		$_SESSION['STWL_SESS_ID'] = md5(sha1(md5(md5(sha1('SecrejtBall')).uniqid().time()).time()).uniqid());
		$_SESSION['STWL_LUM_DB_ID'] = $usrrw['lum_id'];
		$_SESSION['STWL_LUM_TU_ID'] = $usrrw['lum_rel_tu_id'];
		session_write_close();
			header('Location: home.php');
		
		###
	}
}else{
	die('User Mapping Not found, Please Ask Administrator for assistance');
}
		
		
		###big en
    }
} else {
	header('Location: login.php?notss');
    die();
}
	
		
}
#

	
	/**//**//**//**/ 
	#$serverdir = 'http://localhost/muncircuit/';
	$serverdir = 'http://stilewell.ddns.net/';
if(isset($_POST['ch_pw'])){
			 if(isset($_SESSION['STWL_LUM_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from sw_logins where lum_id = ".$_SESSION['STWL_LUM_DB_ID']." and lum_valid = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}


	
	if(!isset($_POST['pw'])){
		die('Enter all fields');
	}

	if(!isset($_POST['npw'])){
		die('Enter all fields');
	}
	
	if($_POST['pw'] == $_POST['npw']){
		$lum = getdatafromsql($conn,'select * from sw_logins where lum_id = '.$_SESSION['STWL_LUM_DB_ID']);
		if(is_string($lum)){
			die('#ERRRMA39UET05G8T');
		}
		$pw = md5(md5(sha1($_POST['pw'])));
		$hash = gen_hash($pw,trim($lum['lum_email']));
		
		
		if($pw== $lum['lum_password']){
			die('The new password cant be same as the old one!');
		}else{
			$upsql = "UPDATE `sw_logins` SET `lum_password`='".trim($pw)."',`lum_hash_mix`='".trim($hash)."' WHERE lum_id = ".$_SESSION['STWL_LUM_DB_ID'];
			if($conn->query($upsql)){
						##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['STWL_LUM_DB_ID'],'sw_logins','update', $upsql ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%wsrhizuTGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




				session_destroy();
				if(count($_SESSION)>0){
					header('Location: login.php');
				}else{
					die('ERRMASESSND');
				}
			}else{
				die("#ERRRKJIOJTOJHB");
			}
			
		}
		
		
		
	}else{
		die('Passwords Dont Match');
	}


}
if(isset($_POST['re_pw'])){
	if(isset($_POST['rec_eml'])){
		if(is_email($_POST['rec_eml'])){
			$validemail = getdatafromsql($conn,"select * from sw_logins where lum_email = '".trim($_POST['rec_eml'])."'");
			
			if(is_array($validemail)){
				$hasho = gen_hash_pw('oi4jg9v 5g858r hgh587rhg85rhgvu85rht9gi vj98rjg984he98t hj4 9v8r hb9uirhbu');
			  $hasht = gen_hash_pw_2($validemail['lum_id'],'984j5t8gj48 g8 5hg085hr988rt09g409rhj 9borjh09oj58r hj094jh 98obh498toeihg');
			  
			  
			  
				$ins_pwrc = "INSERT INTO `sw_recover`(`rv_rel_lum_id`, `rv_hash`, `rv_valid_till`, `rv_hash_2`) VALUES (
'".$validemail['lum_id']."',
'".$hasho."',
'".(time()+10810)."',				
'".$hasht."'
)";
if($conn->query($ins_pwrc)){
			##### Insert Logs ##################################################################VV3###
		if(preplogs($validemail,"0",'sw_recover','insert', $ins_pwrc,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGweafTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	###eml
	$to = $validemail['lum_email'];
$subject = "Stilewell Password Recovery ";

$message = "
<html>
<head>
<title>Click on the Link below</title>
</head>
<body>
<h2>You have requested an option to recover your account's password</h2>
<p>You can either click on the link below or copy it and paste it in your browser to reset your accounts password</p>
<p>The link is only valid for 5hrs and is one time useable</p>
<a href='http://schoolvault.ddns.net/recover.php?id=".$hasho.$hasht."'>".$serverdir."recover.php?id=".$hasho.$hasht."</a>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <anonymous.code.anonymous@gmail.com>' . "\r\n";

if(mail($to,$subject,$message,$headers)){
header('Location: recover.php?newmade');
}else{
	die('#ERRMAjuigtuj');
}
	###eml
}else{
	die('#ERRMA9309399JG');
}
				
				
				
				
			}else{
				echo 'Dont know';
			}
			
		}else{
			die('Enter a Valid Email');
		}
	}else{
		die('Enter All fields');
	}
}
#
#
if(isset($_POST['rec_action_pw'])){
	if(isset($_POST['recover_npw']) and isset($_POST['rec_pw_u'])){
		if(ctype_alnum(trim(strtolower($_POST['rec_pw_u'])))){
			$usrh = $_POST['rec_pw_u'];
			$newp = $_POST['recover_npw'];
			$user_det = getdatafromsql($conn,"select * from sw_logins where md5(sha1(concat(lum_id,'3oijg9i3u8uh'))) = '".$usrh."' and lum_valid = 1");
			
			if(is_array($user_det)){
				$new_pw=md5(md5(sha1($newp)));
				$new_hash = gen_hash($new_pw,trim($user_det['lum_email']));

	


if($conn->query("update sw_logins set lum_password = '".$new_pw."', lum_hash_mix ='".$new_hash."' where lum_id = ".$user_det['lum_id']."")){




	session_destroy();
	header('Location: login.php');
	
}else{
	die("ERRMAUSRPWCHOI03J4");
}
	
			}else{
				die('Invalid User');
			}
		}else{
			die("Invalid hash");
		}
	}else{
		die("Enter all Values");
	}
}

if(isset($_POST['mod_add'])){
	if(isset($_SESSION['STWL_LUM_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from sw_logins where lum_id = ".$_SESSION['STWL_LUM_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	############################33333333
	if(isset($_POST['mod_a_long_name'])){
		$nm = $_POST['mod_a_long_name'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_href'])){
		$href = $_POST['mod_a_href'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_icon'])){
		$ico = $_POST['mod_a_icon'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_for'])){
		$mofor = $_POST['mod_a_for'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['mod_a_sub_menu']) and is_numeric($_POST['mod_a_sub_menu'])){
		if(in_range($_POST['mod_a_sub_menu'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$subm = $_POST['mod_a_sub_menu'];
	}else{
		die('Enter all Fields Correctly');
	}
	if(isset($_POST['mod_a_valid']) and is_numeric($_POST['mod_a_valid'])){
		if(in_range($_POST['mod_a_valid'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 6');
		}
		$vali_s = $_POST['mod_a_valid'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333

	if($conn->query("INSERT INTO `sw_modules`(`mo_name`, `mo_href`, `mo_for`, `mo_icon`,  `mo_sub_mod`, `mo_valid`) VALUES (
	'".$nm."',
	'".$href."',
	'".$mofor."',
	'".$ico."',
	".$subm.",
	".$vali_s."
	)")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['STWL_LUM_DB_ID'],'sw_modules','insert', "INSERT INTO `sw_modules`(`mo_name`, `mo_href`, `mo_for`, `mo_icon`,  `mo_sub_mod`, `mo_valid`) VALUES (
	'".$nm."',
	'".$href."',
	'".$mofor."',
	'".$ico."',
	".$subm.",
	".$vali_s."
	)",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




		header('Location: admin_mods.php');
	}else{
		die('ERRMAGRTBRHR%Y$T%HTIEB(FD');
	}
}
if(isset($_POST['add_user'])){
	if(isset($_SESSION['STWL_LUM_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from sw_logins where lum_id = ".$_SESSION['STWL_LUM_DB_ID']." and lum_valid = 1 and lum_ad = 1 ");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}

	############################33333333
	if(isset($_POST['usr_f_name']) and trim($_POST['usr_f_name']) !== ''){
		$fnm = $_POST['usr_f_name'];
	}else{
		die('Enter usr_f_name Correctly1');
	}
	############################33333333
	if(isset($_POST['usr_l_name']) and trim($_POST['usr_l_name']) !== ''){
		$lnm = $_POST['usr_l_name'];
	}else{
		die('Enter usr_l_name Correctly1');
	}
	if(isset($_POST['usr_email'])){
		if(is_email($_POST['usr_email'])){
		$eml = $_POST['usr_email'];
		}else{
			die('Email not Valid');
		}
	}else{
		die('Enter Email Correctly');
	}
	############################33333333
	############################33333333
	if(isset($_POST['usr_type'])){
		if(is_numeric($_POST['usr_type']) and (($_POST['usr_type'] == 1) or ($_POST['usr_type'] == 2) or ($_POST['usr_type'] == 3))){
		$usr_type = $_POST['usr_type'];
		}else{
			die('User Type not Valid');
		}
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['usr_contact_no'])){
		if(is_numeric($_POST['usr_contact_no'])){
		$number = $_POST['usr_contact_no'];
		}else{
			die('Contact not Valid');
		}
	}else{
		die('Enter Contact Correctly');
	}
	############################33333333
	if(isset($_POST['usr_pw'])){
		$pw = md5(md5(sha1($_POST['usr_pw'])));
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['usr_dob']) and (strtotime($_POST['usr_dob']) == true)){
			$dob = $_POST['usr_dob'];
	}else{
		die('Enter DOB Correctly');
	}
	############################33333333
	if(isset($_POST['usr_validtill']) and is_numeric($_POST['usr_validtill'])){
		$vldtll = $_POST['usr_validtill'];
		if(trim($vldtll) == 0){
			$valid_till = 0;
			$defpw = '-';
		}else{
			$valid_till = (time()+ ($vldtll*60));
			$defpw=base64_encode($_POST['usr_pw']);
		}
	}else{
		die('Enter all Fields Correctly 1');
	}
	############################33333333


$usr = strtolower(rand(1,10).$fnm);
$hash = gen_hash($pw,$eml);

$checkusrnm = getdatafromsql($conn,"select * from sw_logins where lum_username = '".trim($usr)."'");
if(is_array($checkusrnm)){
	die("Please refresh the Page and resend the post values .");
}

#########################
	if($conn->query("INSERT INTO `sw_logins`(`lum_rel_tu_id`,`lum_email`, `lum_username`, `lum_password`, `lum_hash_mix`, `lum_ad`, `lum_ad_level`,`lum_pass_def`) VALUES 
	('".trim($usr_type)."','".trim($eml)."', '".trim($usr)."', '".trim($pw)."', '".trim($hash)."', '0', '0'
	,'".$_POST['usr_pw']."')")){





	##
		$ltid = $conn->insert_id;
		
						##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['STWL_LUM_DB_ID'],'sw_logins','insert', "INSERT INTO `sw_logins`(`lum_email`, `lum_username`, `lum_password`, `lum_hash_mix`, `lum_ad`, `lum_ad_level`) VALUES 
	('".trim($eml)."', '".trim($usr)."', '".trim($pw)."', '".trim($hash)."', '".trim($ad)."', '".trim($adlvl)."')" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###



	$sqlb = "INSERT INTO `sw_users`(`usr_fname`,`usr_lname`, `usr_dob`,`usr_contact_no`,`usr_rel_lum_id` , `usr_reg_dnt`, `usr_reg_ip`,`usr_validtill`) VALUES (
'".$fnm."',
'".$lnm."',
'".strtotime($dob)."',
'".$number."',
'".$ltid."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."',
'".$valid_till."')";

	if ($conn->query($sqlb) === TRUE) {
				##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['STWL_LUM_DB_ID'],'sw_users','insert', $sqlb ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	
    header('Location: admin_users.php');
} else {
    die($conn->error."Error##rujioma");
}
	

	##
	
	}else{
		die($conn->error.'ERRMAIGOTURG');
	}
}
#_______________________________START MODULES_______________________
if(isset($_POST['hash_ac']) and isset($_POST['tab_act'])){
	if(ctype_alnum(trim($_POST['hash_ac']))){
		$checkit = getdatafromsql($conn,"select * from sw_modules where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'njhifverkof2njbivjwj bfurhib2jw'))))))) = '".$_POST['hash_ac']."' and mo_valid =0");
		
		if(is_array($checkit)){
			if($conn->query("update sw_modules set mo_valid =1 where mo_id= ".$checkit['mo_id']."")){
				##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['STWL_LUM_DB_ID'],'sw_modules','update', "update sw_modules set mo_valid =1 where mo_id= ".$checkit['mo_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_mods.php');
			}else{
				die('ERRRMA!JOIrfedNJFO');
			}
		}else{
			die("No Modules\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
if(isset($_POST['hash_inc']) and isset($_POST['tab_inact'])){
	if(ctype_alnum(trim($_POST['hash_inc']))){
		$checkit = getdatafromsql($conn,"select * from sw_modules where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'hbujeio03ir94urghnjefr 309i4wef'))))))) = '".$_POST['hash_inc']."' and mo_valid =1");
		
		if(is_array($checkit)){
			if($conn->query("update sw_modules set mo_valid =0 where mo_id= ".$checkit['mo_id']."")){				
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['STWL_LUM_DB_ID'],'sw_modules','update', "update sw_modules set mo_valid =0 where mo_id= ".$checkit['mo_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###


								header('Location: admin_mods.php');
			}else{
				die('ERRRMAjn4rifJOINJFWFEAO');
			}
		}else{
			die("No Modules\'s Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#_______________________________START USER_______________________
if(isset($_POST['yh_com']) and isset($_POST['usr_make_ac'])){
	if(ctype_alnum(trim($_POST['yh_com']))){
		$checkit = getdatafromsql($conn,"select * from sw_logins where 
		md5(md5(sha1(sha1(md5(md5(concat(lum_id,'hir39efnewsfejirjeofkvjrjdnjjenfkvkijonreij3nj'))))))) = '".$_POST['yh_com']."' and lum_valid = 0");
		
		if(is_array($checkit)){
			if($checkit['lum_email'] == 'ayanzcap@hotmail.com'){
				die('Super user can\'t be modified');
			}
			if($conn->query("update sw_logins set lum_valid =1 where lum_id= ".$checkit['lum_id']."")){
								
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['STWL_LUM_DB_ID'],'sw_logins','update', "update sw_logins set lum_valid =1 where lum_id= ".$checkit['lum_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

								header('Location: admin_users.php');
			}else{
				die('ERRMA3jonkj34oirvfingj');
			}
		}else{
			die("No User Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
if(isset($_POST['yh_com']) and isset($_POST['usr_make_inac'])){
	if(ctype_alnum(trim($_POST['yh_com']))){
		$checkit = getdatafromsql($conn,"select * from sw_logins where 
		md5(md5(sha1(sha1(md5(md5(concat(lum_id,'hir39efnewsfejirjrjdnjjenfkv ijfkorkvnkorvfk'))))))) = '".$_POST['yh_com']."' and lum_valid = 1");
		
		if(is_array($checkit)){
			if($checkit['lum_email'] == 'ayanzcap@hotmail.com'){
				die('Super user can\'t be deleted');
			}
			if($conn->query("update sw_logins set lum_valid =0 where lum_id= ".$checkit['lum_id']."")){
				
##### Insert Logs ##################################################################VV3###
		if(preplogs($checkit,$_SESSION['STWL_LUM_DB_ID'],'sw_logins','update', "update sw_logins set lum_valid =0 where lum_id= ".$checkit['lum_id']."" ,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




				
								header('Location: admin_users.php');
			}else{
				die('ERRMA3joingj');
			}
		}else{
			die("No User Found");
		}
	}else{
		die('Invalid Entries');
	}
}
#
#_______________________________END USER_______________________
if(isset($_POST['edit_mod'])){
	if(isset($_SESSION['STWL_LUM_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from sw_logins where lum_id = ".$_SESSION['STWL_LUM_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_emmp__1i'])){
		if(ctype_alnum(trim($_POST['hash_emmp__1i']))){
			$editmun = getdatafromsql($conn,"select * from sw_modules where md5(md5(sha1(sha1(md5(md5(concat(mo_id,'lkoegnuifvh bnn njenjn'))))))) = '".$_POST['hash_emmp__1i']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	############################33333333
	if(isset($_POST['edit_mod_lngnme'])){
		$nm = $_POST['edit_mod_lngnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_shrtnme'])){
		$href = $_POST['edit_mod_shrtnme'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_icon'])){
		$ico = $_POST['edit_mod_icon'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_for'])){
		$mofor = $_POST['edit_mod_for'];
	}else{
		die('Enter all Fields Correctly');
	}
	############################33333333
	if(isset($_POST['edit_mod_sub']) and is_numeric($_POST['edit_mod_sub'])){
		if(in_range($_POST['edit_mod_sub'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$subm = $_POST['edit_mod_sub'];
	}else{
		die('Enter all Fields Correctly');
	}
	
	if(1==0){
		#You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes #
		die("You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes ");
	}else{
		if($conn->query("UPDATE `sw_modules` SET 
`mo_name`= '".$nm."',
`mo_href`='".$href."',
`mo_for` = '".$mofor."',
`mo_icon`='".$ico."',
`mo_sub_mod`='".$subm."'
where mo_id = ".trim($editmun['mo_id'])."")){
	
	
	##### Insert Logs ##################################################################VV3###
		if(preplogs($editmun,$_SESSION['STWL_LUM_DB_ID'],'sw_modules','update',"UPDATE `sw_modules` SET 
`mo_name`= '".$nm."',
`mo_href`='".$href."',
`mo_for` = '".$mofor."',
`mo_icon`='".$ico."',
`mo_sub_mod`='".$subm."'
where mo_id = ".trim($editmun['mo_id'])."",$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###




	header('Location: admin_mods.php');
		}else{
			die('ERRMAerskirore9njr3ei9jinj');
		}
	}

}
if(isset($_POST['edit_user'])){
	if(isset($_SESSION['STWL_LUM_DB_ID'])){
		$getdatus = getdatafromsql($conn,"select * from sw_logins where lum_id = ".$_SESSION['STWL_LUM_DB_ID']." and lum_valid = 1 and lum_ad = 1");
		if(is_string($getdatus)){
			die('Access Denied');
		}
	}else{
		die('Login to do this action');
	}
	if(isset($_POST['hash_chkr'])){
		if(ctype_alnum(trim($_POST['hash_chkr']))){
			$editmun = getdatafromsql($conn,"select * from sw_logins where md5(md5(sha1(sha1(md5(md5(concat(lum_id,'f2frbgbe 2fgtegrfr3gbter 24rfgr324frgtr3f 3gr32fgr32f4gr'))))))) = '".$_POST['hash_chkr']."'");
			#f0b9915082de5819bf562d53aa59b2d2
			
			if(is_string($editmun)){
				die('Hash Not Found');
			}
		}else{
			die('Invalid hash');
		}
	}else{
		die('Hash Not Valid');
	}
	
	if(isset($_POST['edit_f_nme'])){
		$fnm = trim($_POST['edit_f_nme']);
	}else{
		die('Enter  edit_f_nme');
	}
	if(isset($_POST['edit_l_nme'])){
		$lnm = trim($_POST['edit_l_nme']);
	}else{
		die('Enter  edit_l_nme');
	}
	if(isset($_POST['edit_us_contact']) and is_numeric($_POST['edit_us_contact'])  and (trim($_POST['edit_us_contact']) !=='')){
		$number = trim($_POST['edit_us_contact']);
	}else{
		die('Enter  edit_us_contact');
	}
	if(isset($_POST['edit_us_pw'])){
		$pt = trim($_POST['edit_us_pw']);
		if(trim($pt) == '-'){
			$pw = $editmun['lum_password'];
			$hash = $editmun['lum_hash_mix'];
		}else{
			$pw = md5(md5(sha1(trim($_POST['edit_us_pw']))));
			$hash = gen_hash($pw,trim($editmun['lum_email']));
		}
	}else{
		die('Enter  edit_us_pw');
	}
	
	if(isset($_POST['edit_us_adm']) and is_numeric($_POST['edit_us_adm'])){
		if(in_range($_POST['edit_us_adm'],0,1,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$admer = $_POST['edit_us_adm'];
	}else{
		die('Enter  edit_us_adm');
	}
	
	if(isset($_POST['edit_us_amdlvl']) and is_numeric($_POST['edit_us_amdlvl'])){
		if(in_range($_POST['edit_us_amdlvl'],0,10,true)){
		}else{
			die('Values other than 1 or 0 are not allowed 1');
		}
		$admlvl = $_POST['edit_us_amdlvl'];
	}else{
		die('Enter  edit_us_amdlvl');
	}
	

	
	if(isset($_POST['edit_us_prfpic'])){
		$nprofpic = trim($_POST['edit_us_prfpic']);
	}else{
		die('Enter  edit_us_prfpic');
	}
	
	
	
	if(isset($_POST['edit_us_till'])){
		$startday =trim($_POST['edit_us_till']);
		if(($startday == '0') or ($startday == 0)){
			$usrtill = 0;
		}else{
			$usrtill = time() + (60*$_POST['edit_us_till']);
		}
	}else{
		die('Enter edit_us_till ');
	}
		
	if(1==0){
		#You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes #
		die("You have not been authorised by MUNCIURCUIT but by trustee so the user has to grant your changes ");
	}else{
		$querytobeinserted = "
UPDATE 
	`sw_logins` a,
	`sw_users` b 
SET 
	a.lum_password='".trim($pw)."',
	a.lum_hash_mix='".$hash."',
	a.lum_ad='".$admer."',
	a.lum_ad_level='".$admlvl."',
	b.usr_fname='".$fnm."',
	b.usr_lname='".$lnm."',
	b.usr_contact_no='".$number."',
	b.usr_prof_pic='".$nprofpic."',
	b.usr_back_pic = '".$nprofbg."',
	b.usr_validtill='".trim($usrtill)."'
WHERE
	a.lum_id = b.usr_rel_lum_id and 
	a.lum_id = ".trim($editmun['lum_id'])."";
		if($conn->query($querytobeinserted)){
		
##### Insert Logs ##################################################################VV3###
		if(preplogs($getdatus,$_SESSION['STWL_LUM_DB_ID'],'sw_logins','update',$querytobeinserted,$conn,$_SESSION['SESS_USR_LOG_MS_VIEW_MD5_ID'])){
		}else{
			die('ERRINCMA%TGTBTR$WESDF');
		}
##### Insert Logs ##################################################################VV3###

	header('Location: admin_users.php');
		}else{
			die('EmrfuRRMAers');
		}
	}

}
##--------------------------------------------------------------------------------------///------------------------------
/*-------------------------------------------------------------------*/
if(isset($_POST['add_snippet_product'])){
#---------------------------------------
#---------------------------------------
if(isset($_POST['add_snippet_product_name'])){
  if(!is_string($_POST['add_snippet_product_name'])){
  die('Invalid Characters used in add_snippet_product_name');   }
  else{}
}else{
  die('Enter add_snippet_product_name');
}
#---------------------------------------
if(isset($_POST['add_snippet_product_code'])){
  if(!is_string($_POST['add_snippet_product_code'])){
  die('Invalid Characters used in add_snippet_product_code');   }
  else{}
}else{
  die('Enter add_snippet_product_code');
}
#---------------------------------------
if(isset($_POST['add_snippet_product_type'])){
  if(!is_string($_POST['add_snippet_product_type'])){
  die('Invalid Characters used in add_snippet_product_type');   }
  else{}
}else{
  die('Enter add_snippet_product_type');
}
#---------------------------------------
if(isset($_POST['add_snippet_product_supplier'])){
  if(!is_string($_POST['add_snippet_product_supplier'])){
  die('Invalid Characters used in add_snippet_product_supplier');   }
  else{}
}else{
  die('Enter add_snippet_product_supplier');
}
#---------------------------------------
if(isset($_POST['add_snippet_product_qty'])){
  if(!is_numeric($_POST['add_snippet_product_qty'])){
  die('Invalid Characters used in add_snippet_product_qty');   }
  else{}
}else{
  die('Enter add_snippet_product_qty');
}
#---------------------------------------
if(isset($_POST['add_snippet_product_ref_qty'])){
  if(!is_string($_POST['add_snippet_product_ref_qty'])){
  die('Invalid Characters used in add_snippet_product_ref_qty');   }
  else{}
}else{
  die('Enter add_snippet_product_ref_qty');
}
#---------------------------------------
if(isset($_POST['add_snippet_product_cost'])){
  if(!is_string($_POST['add_snippet_product_cost'])){
  die('Invalid Characters used in add_snippet_product_cost');   }
  else{}
}else{
  die('Enter add_snippet_product_cost');
}
#---------------------------------------
if(isset($_POST['add_snippet_product_desc'])){
  if(!is_string($_POST['add_snippet_product_desc'])){
  die('Invalid Characters used in add_snippet_product_desc');   }
  else{}
}else{
  die('Enter add_snippet_product_desc');
}
#---------------------------------------
if(isset($_POST['add_snippet_href'])){
  if(!is_string($_POST['add_snippet_href'])){
  die('Invalid Characters used in add_snippet_href');   }
  else{}
}else{
  die('Enter add_snippet_href');
}
#---------------------------------------

$getsupplierdetails = getdatafromsql($conn,"select * from sw_suppliers where md5(sha1(md5(concat('iuergeirjgvjioe',sup_id)))) = '".$_POST['add_snippet_product_supplier']."'");
if(!is_array($getsupplierdetails)){
	die('Supplier Not Found');
}

$getptypedetails = getdatafromsql($conn,"select * from sw_prod_types where md5(sha1(md5(concat('iuergejgvjioe',prty_id)))) = '".$_POST['add_snippet_product_type']."'");
if(!is_array($getptypedetails)){
	die('Product type Not Found');
}
$target_dir = "pr_imgs/";
if(isset($_FILES['add_snippet_product_img']) and ($_FILES['add_snippet_product_img']['size']==0)){
$target_file = $target_dir .'default.png';
$target_file_2 = $target_dir .'default.png';
$target_file_3 = $target_dir .'default.png';
}else if(isset($_FILES['add_snippet_product_img']) and ($_FILES['add_snippet_product_img']['size'] >0)){

					
					
$ext =  extension(basename($_FILES["add_snippet_product_img"]["name"]));
$fold_name =uniqid().'-'.$_POST['add_snippet_product_code'].$_POST['add_snippet_product_name'].$getptypedetails['prty_id'].'-'.$_POST['add_snippet_qty'].'/';
if(mkdir('pr_imgs/'.$fold_name)){
}

$target_file = $target_dir .$fold_name. $_POST['add_snippet_product_code'].''.$_POST['add_snippet_product_name'].'_1.'.$ext;
$target_file_2 = $target_dir .$fold_name. $_POST['add_snippet_product_code'].''.$_POST['add_snippet_product_name'].'_2.'.$ext;
$target_file_3 = $target_dir .$fold_name. $_POST['add_snippet_product_code'].''.$_POST['add_snippet_product_name'].'_3.'.$ext;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["add_snippet_product_img"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["add_snippet_product_img"]["size"] > 10000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    die("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["add_snippet_product_img"]["tmp_name"], $target_file) and
	    copy($target_file, $target_file_2) and  
		copy($target_file, $target_file_3) ) {
		

if(resize(120,$target_file_2,$target_file_2)){
	if(resize(300,$target_file_3,$target_file_3)){
}else{
		die('I c N R');
	}

}else{
	die('Images Could not be resized');
}

    } else {
        die( "Sorry, there was an error uploading your file.");
    }
}
}else{
$target_file = $target_dir .'default.png';
$target_file_2 = $target_dir .'default.png';
$target_file_3 = $target_dir .'default.png';	
}
$inssql = "INSERT INTO `sw_products_raw`(`pr_rel_prty_id`,`pr_rel_sup_id`,`pr_code`,`pr_img`,`pr_img_2`,`pr_img_3`,`pr_name`, `pr_desc`, `pr_price`,`pr_dnt`) VALUES (
'".$getptypedetails['prty_id']."',
'".$getsupplierdetails['sup_id']."',
'".$_POST['add_snippet_product_code']."',
'".$target_file."',
'".$target_file_2."',
'".$target_file_3."',
'".$_POST['add_snippet_product_name']."',
'".$_POST['add_snippet_product_desc']."',
'".$_POST['add_snippet_product_cost']."',
'".time()."'
)";



if ($conn->query($inssql) === TRUE) {
	$prraw = $conn->insert_id;
	
			$inserRt = "INSERT INTO `sw_products_qty`(`pq_rel_pr_id`, `pq_ref`, `pq_qty`, `pq_dnt`, `pq_ip`, `pq_rel_lum_id`) VALUES (
		'".$prraw."',
		'".$_POST['add_snippet_product_ref_qty']."',
		'".$_POST['add_snippet_product_qty']."',
		'".time()."',
		'".$_SERVER['REMOTE_ADDR']."',
		'".$_SESSION['STWL_LUM_DB_ID']."'
		)";

if ($conn->query($inserRt) === TRUE){header('Location: '.$_POST['add_snippet_href']);}else{die('No qty inserted');}


	
			
}else {
	die( "ERRMA(PA), Error Inserting Product");
}





}
/*-------------------------------------------------------------------*/
if(isset($_POST['add_client'])){
	if(!isset($_SESSION['STWL_LUM_DB_ID'])){
		die("You Must Login to continue");
	}
#---------------------------------------
if(isset($_POST['add_client_name'])){
  if(!is_string($_POST['add_client_name'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_name');
}
#---------------------------------------
if(isset($_POST['add_client_bnkdet'])){
  if(!is_string($_POST['add_client_bnkdet'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_bnkdet');
}
#---------------------------------------
if(isset($_POST['add_client_tax_code'])){
  if(!is_string($_POST['add_client_tax_code'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_tax_code');
}
#---------------------------------------
if(isset($_POST['add_client_code'])){
  if(!is_string($_POST['add_client_code'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_code');
}
#---------------------------------------
if(isset($_POST['add_client_email'])){
  if(!is_email($_POST['add_client_email'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_email');
}
#---------------------------------------
if(isset($_POST['add_client_bill_addr'])){
  if(!is_string($_POST['add_client_bill_addr'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_bill_addr');
}
#---------------------------------------
if(isset($_POST['_wysihtml5_mode'])){
  if(!is_numeric($_POST['_wysihtml5_mode']) and ($_POST['_wysihtml5_mode'] !== 1) ){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter _wysihtml5_mode');
}
#---------------------------------------
if(isset($_POST['add_client_ship_addr'])){
  if(!is_string($_POST['add_client_ship_addr'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_ship_addr');
}
#---------------------------------------
if(isset($_POST['add_client_phone'])){
  if(!is_string($_POST['add_client_phone'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_phone');
}
#---------------------------------------
if(isset($_POST['add_client_desc'])){
  if(!is_string($_POST['add_client_desc'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_desc');
}
#---------------------------------------
if(isset($_POST['add_client_pyt'])){
  if(!is_string($_POST['add_client_pyt'])){
  die('Invalid Characters used');   }
  else{}
}else{
  die('Enter add_client_pyt');
}
#---------------------------------------

$ins_sql = "INSERT INTO `sw_clients`( `cli_name`, `cli_bank_details`, `cli_tax_code`, `cli_code`, `cli_desc`, `cli_bill_addr`, `cli_ship_addr`, `cli_email`, `cli_contact_no`, `cli_pay_terms`, `cli_dnt`, `cli_ip`, `cli_added_rel_lum_id`) VALUES 
(
'".$_POST['add_client_name']."',
'".$_POST['add_client_bnkdet']."',
'".$_POST['add_client_tax_code']."',
'".$_POST['add_client_code']."',
'".$_POST['add_client_desc']."',
'".$_POST['add_client_bill_addr']."',
'".$_POST['add_client_ship_addr']."',
'".$_POST['add_client_email']."',
'".$_POST['add_client_phone']."',
'".$_POST['add_client_pyt']."',
'".time()."',
'".$_SERVER['REMOTE_ADDR']."',
'".$_SESSION['STWL_LUM_DB_ID']."'
)";

if($conn->query($ins_sql)){
	header('Location: sw_clients.php');
}else{
	die('ERRMA(#)TJ Inserting Client, Contact Admin');
}
	
}
if(isset($_POST['edit_client'])){
	if(!isset($_SESSION['STWL_LUM_DB_ID'])){
		die("You Must Login to continue");
	}
#---------------------------------------
if(isset($_POST['edit_client_name'])){
  if(!is_string($_POST['edit_client_name'])){
  die('Invalid Characters used in edit_client_name');   }
  else{}
}else{
  die('Enter edit_client_name');
}
#---------------------------------------
if(isset($_POST['edit_client_txcd'])){
  if(!is_string($_POST['edit_client_txcd'])){
  die('Invalid Characters used in edit_client_txcd');   }
  else{}
}else{
  die('Enter edit_client_txcd');
}
#---------------------------------------
if(isset($_POST['edit_client_bkdet'])){
  if(!is_string($_POST['edit_client_bkdet'])){
  die('Invalid Characters used in edit_client_bkdet');   }
  else{}
}else{
  die('Enter edit_client_bkdet');
}
#---------------------------------------
if(isset($_POST['edit_client_desc'])){
  if(!is_string($_POST['edit_client_desc'])){
  die('Invalid Characters used in edit_client_desc');   }
  else{}
}else{
  die('Enter edit_client_desc');
}
#---------------------------------------
if(isset($_POST['edit_us_contact'])){
  if(!is_string($_POST['edit_us_contact'])){
  die('Invalid Characters used in edit_us_contact');   }
  else{}
}else{
  die('Enter edit_us_contact');
}
#---------------------------------------
if(isset($_POST['edit_client_email'])){
  if(!is_email($_POST['edit_client_email'])){
  die('Invalid Characters used in edit_client_email');   }
  else{}
}else{
  die('Enter edit_client_email');
}
#---------------------------------------
if(isset($_POST['edit_client_pay_terms'])){
  if(!is_string($_POST['edit_client_pay_terms'])){
  die('Invalid Characters used in edit_client_pay_terms');   }
  else{}
}else{
  die('Enter edit_client_pay_terms');
}
#---------------------------------------
if(isset($_POST['edit_client_bill_addr'])){
  if(!is_string($_POST['edit_client_bill_addr'])){
  die('Invalid Characters used in edit_client_bill_addr');   }
  else{}
}else{
  die('Enter edit_client_bill_addr');
}
#---------------------------------------
if(isset($_POST['_wysihtml5_mode'])){
  if(!is_numeric($_POST['_wysihtml5_mode'])){
  die('Invalid Characters used in _wysihtml5_mode');   }
  else{}
}else{
  die('Enter _wysihtml5_mode');
}
#---------------------------------------
if(isset($_POST['edit_client_ship_addr'])){
  if(!is_string($_POST['edit_client_ship_addr'])){
  die('Invalid Characters used in edit_client_ship_addr');   }
  else{}
}else{
  die('Enter edit_client_ship_addr');
}
#---------------------------------------
if(isset($_POST['edit_client_hash'])){
  if(!ctype_alnum(trim($_POST['edit_client_hash']))){
  die('Invalid Characters used in edit_client_hash');   }
  else{}
}else{
  die('Enter edit_client_hash');
}
#---------------------------------------
$getclient = getdatafromsql($conn,"select * from sw_clients  where cli_valid =1 and md5(md5(sha1(sha1(md5(md5(concat(cli_id,'kjwj 2fgtegrfr3gbter 24rfgr324frgtr3f 3gr32fgr32f4gr'))))))) = '".$_POST['edit_client_hash']."'");
if(is_array($getclient)){
}else{
	die('Client Not found');
}

$ins_sql = "UPDATE `sw_clients` SET 
`cli_name`='".$_POST['edit_client_name']."',
`cli_bank_details`='".$_POST['edit_client_bkdet']."',
`cli_tax_code`='".$_POST['edit_client_txcd']."',
`cli_desc`='".$_POST['edit_client_desc']."',
`cli_bill_addr`='".$_POST['edit_client_bill_addr']."',
`cli_ship_addr`='".$_POST['edit_client_ship_addr']."',
`cli_email`='".$_POST['edit_client_email']."',
`cli_contact_no`='".$_POST['edit_us_contact']."',
`cli_pay_terms`='".$_POST['edit_client_pay_terms']."',
`cli_added_rel_lum_id`=concat(`cli_added_rel_lum_id`,',".$_SESSION['STWL_LUM_DB_ID']."')
 WHERE cli_id = ".$getclient['cli_id']."
";

if($conn->query($ins_sql)){
	header('Location: sw_clients.php');
}else{
	die('ERRMA(#)TH Updating Client, Contact Admin');
}
	
}
/*-------------------------------------------------------------------*/
if(isset($_POST['approve_story'])){
#---------------------------------------
if(isset($_POST['approve_story_hash'])){
  if(!ctype_alnum($_POST['approve_story_hash'])){
  die('Invalid Characters used in approve_story_hash');   }
  else{}
}else{
  die('Enter approve_story_hash');
}
#---------------------------------------

$checkvalid = getdatafromsql($conn, "SELECT * FROM `tpt_stories` where sto_approved=0 and sto_valid =1 and md5(sto_id) = '".$_POST['approve_story_hash']."'");

if(is_array($checkvalid)){
	$update = "update tpt_stories set sto_approved =1 where sto_id = ".$checkvalid['sto_id']." ";
	if($conn->query($update)){
		header('Location: admin_stories.php');
	}else{
		die('ERRMA1438');
	}
}else{
	die('Invalid Story');
}

}
if(isset($_POST['disapprove_story'])){
#---------------------------------------
if(isset($_POST['disapprove_story_reason'])){
  if(!is_string($_POST['disapprove_story_reason'])){
  die('Invalid Characters used in disapprove_story_reason');   }
  else{}
}else{
  die('Enter disapprove_story_reason');
}
#---------------------------------------
if(isset($_POST['disapprove_story_hash'])){
  if(!ctype_alnum($_POST['disapprove_story_hash'])){
  die('Invalid Characters used in disapprove_story_hash');   }
  else{}
}else{
  die('Enter disapprove_story_hash');
}
#---------------------------------------

$checkvalid = getdatafromsql($conn, "SELECT * FROM `tpt_stories` where sto_approved=0 and sto_valid =1 and md5(sto_id) = '".$_POST['disapprove_story_hash']."'");

if(is_array($checkvalid)){
	$update = "update tpt_stories set sto_approved =2  where sto_id = ".$checkvalid['sto_id']." ";
	if($conn->query($update)){


	$update2 = "INSERT INTO `tpt_disapprovals`( `daprvl_rel_sto_id`, `daprvl_desc`, `daprvl_dnt`, `daprvl_ip`) VALUES (
	'".$checkvalid['sto_id']."',
	'".$_POST['disapprove_story_reason']."',
	'".time()."',
	'".$_SERVER['REMOTE_ADDR']."'	)";
	if($conn->query($update2)){
		header('Location: admin_stories.php');
	}else{
		die('ERRMA1438');
	}


	}else{
		die('ERRMA1438');
	}
}else{
	die('Invalid Story');
}

}
/*-*--------*/
if(isset($_POST['send_contact'])){
#---------------------------------------
if(isset($_POST['send_contact_email'])){
  if(!is_string($_POST['send_contact_email'])){
  die('Invalid Characters used in send_contact_email');   }
  else{}
}else{
  die('Enter send_contact_email');
}
#---------------------------------------
if(isset($_POST['send_contact_email_hash'])){
  if(!ctype_alnum($_POST['send_contact_email_hash'])){
  die('Invalid Characters used in send_contact_email_hash');   }
  else{}
}else{
  die('Enter send_contact_email_hash');
}
#---------------------------------------
	
	$checkvalid = getdatafromsql($conn, "select * from tpt_contact where ct_valid = 1 and ct_replied = 0 and md5(ct_id)= '".$_POST['send_contact_email_hash']."'");
	if(!is_array($checkvalid)){
		die('Query not found');
	}
require_once "mail/PHPMailerAutoload.php";
$mail = new PHPMailer;
$mail->SMTPDebug = 0;                               
$mail->isSMTP();            
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;                          
$mail->Username = "thependuluminfo@gmail.com";                 
$mail->Password = "Ayanahmad2001.";                           
$mail->SMTPSecure = "ssl";                           
$mail->Port = 465;                                   
$mail->From = "thependuluminfo@gmail.com";
$mail->FromName = "Pendulum Service";
$mail->addAddress($checkvalid['ct_email'], $checkvalid['ct_name']);
$mail->isHTML(true);
$mail->Subject = "Pendulum Contact";
$mail->Body = $_POST['send_contact_email'];
$mail->AltBody = "If you can not find the content of the mail please write an email to us at, thependuluminfo@gmail.com";
if(!$mail->send()) 
{
		die('Mail not sent ');	
} 
else 
{
		$update = "update tpt_contact set ct_replied = 1   where ct_id = ".$checkvalid['ct_id']." ";
	if($conn->query($update)){


	$update2 = "
	INSERT INTO `tpt_replies`(`rep_rel_ct_id`, `rep_msg`, `rep_ip`, `rep_dnt`, `rep_rel_lum_id`, `rep_email_sent`) VALUES (
	'".$checkvalid['ct_id']."',
	'".$_POST['send_contact_email']."',
	'".$_SERVER['REMOTE_ADDR']."',
	'".time()."',
	'1',
	'1'
	
	
	)";
	if($conn->query($update2)){
		header('Location: admin_contact.php');
	}else{
		die('ERRMA1438');
	}


	}else{
		die('ERRMA1438');
	}


}

}































?>







