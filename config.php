<?php
require_once "API/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("77552038326-ctj99n0e4nsmg5rekdjq8v4o562e4lqr.apps.googleusercontent.com");
$gClient->setClientSecret("myMiHW8mZKvgorpVA4Pj861e");
$gClient->setApplicationName("Smart Selling System");
$gClient->setRedirectUri("http://localhost/PDE/LoginWithGoogle.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>