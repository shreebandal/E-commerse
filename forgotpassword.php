<?php include 'header.php'?>
<?php
if (isset($_GET['id'])) {
    ?>
    <div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
    Change password link has been send<strong> please check your email account</strong>    
  </div>
    <script>
        let failure = document.getElementById("failure")
        failure.classList.add("show")
      </script>
      <?php
}
?>
<?php 
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['register'])) {

    $emailid=$_POST['emailid'];

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

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Change Password';
    $mail->Body    = " Hello $emailid &nbsp;<br> Change your old password.<br>
    <a href='http://localhost/PDE/changepassword.php?email=$emailid'>click here</a> to Change password.";
    $mail->AltBody = 'Change Password';

    $mail->send();
} catch (Exception $e) {
  die('Error: ' . $e->getMessage());  
}
?>
        <script>
            location.replace('forgotpassword.php?id=ok')
        </script>
  <?php
} 
else{
    ?>
        <div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
        Your email will not register <strong> please register</strong>    
        </div>
        <script>
            let failure = document.getElementById("failure")
            failure.classList.add("show")
            setTimeout(function () { failure.classList.remove("show"); }, 5000)
        </script>
  <?php
}
    }           
    ?>
<title>Forgot Password</title>
</head>

<body>


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-conten padding-y" style="min-height:84vh">

<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
      <div class="card-body">
      <h4 class="card-title mb-4">Forgot Password</h4>
      <form action="forgotpassword.php" method="post">
          <div class="form-group">
            <label for="email">Email</label>
		    <input name="emailid" class="form-control" id="email" placeholder="Username" type="email">
          </div> <!-- form-group// -->
          <div class="form-group">
              <button type="submit" name="register" class="btn btn-primary btn-block"> Login  </button>
          </div> <!-- form-group// -->    
      </form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->
<!-- ============================ COMPONENT LOGIN  END.// ================================= -->


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->


<?php include 'footer.php'?>