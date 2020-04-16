<?php include 'session.php';?>
<?php 
session_start();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    $emailid = $_SESSION['id'];

    $q="SELECT * FROM customer WHERE email='$emailid' ";
    $q_run =mysqli_query($con, $q);

    if(!$q_run)
        die("Unable to connect to database".mysqli_error($con));

    $result = mysqli_fetch_array($q_run);
    if($result){
	
// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'shreebandal0@gmail.com';                     // SMTP username
    $mail->Password   = 'shree@123';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('shreebandal0@gmail.com', 'Shree bandal');           // your Mail and name
    $mail->addAddress($emailid);     // Add a recipient. name is optional
    $mail->addReplyTo('no-reply@gmail.com');
 
    date_default_timezone_set("Asia/Kolkata");
    $date = date("Y-m-d H:i:s");

    //email conformation
    function getToken($len){
      $random_string = md5(uniqid(mt_rand(),true));
      $base64_encoded = base64_encode($random_string);
      $modified_base64_encoded = str_replace(array('+','='), array('', ''), $base64_encoded);
      $token = substr($modified_base64_encoded, 0, $len);
      return $token;
    }
    $token = getToken(32);
    $encrypted_email = base64_encode(urlencode($emailid ));

    $expire_date = date("Y-m-d H:i:s", time() + 300);
    $expire_date = base64_encode(urlencode($expire_date));

    $query = "UPDATE customer SET validation_key='$token' where email='$emailid'";
    $query_run = mysqli_query($con, $query);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verify your email';
    $mail->Body    = " Hello $emailid &nbsp;<br> Thanks for registration.<br>
    <a href='http://localhost/PDE/activation.php?eid={$encrypted_email}&token={$token}&&exd={$expire_date}'>click here</a> to verify your email.
    <br> This is link is valid for only 5 minutes.";
    $mail->AltBody = 'email varification';

    $mail->send();
    ?>
                <script>
                	location.replace('login.php')
                </script>
    <?php
} catch (Exception $e) {
  die('Error: ' . $e->getMessage());  
}
    }
?>