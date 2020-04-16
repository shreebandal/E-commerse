<?php
    include 'session.php';
    session_start();
    $emailid = $_SESSION['email'];
    mysqli_query($con,"UPDATE chats SET isonline=CURRENT_TIMESTAMP() WHERE reciver='$emailid';");
    if(isset($emailid)){
    unset($_SESSION['email']);
    header('location:login.php');
    }
?>