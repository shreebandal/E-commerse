<?php
	require_once "config.php";
	include 'session.php';
	if (isset($_SESSION['access_token']))
		$gClient->setAccessToken($_SESSION['access_token']);
	else if (isset($_GET['code'])) {
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	} else {
		header('Location:login.php');
	}
	$oAuth = new Google_Service_Oauth2($gClient);
	$userData = $oAuth->userinfo->get();
	$id = $userData['id'];
	$email = $userData['email'];
    $lastname = $userData['family_name'];
	$firstname = $userData['given_name'];
	$gender = $userData['gender'];
	$pic = $userData['picture'];
    $query = "INSERT INTO customer (validation_key,firstname,lastname,email,mailotp,pic,gender) VALUES('$id','$firstname','$lastname','$email',1,'$pic','$gender');";
	mysqli_query($con,$query);
	header('location:login.php?email='.$email.'');

?>