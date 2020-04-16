<?php include 'header.php'?>

<?php 
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['register'])) {

    $firstname       =    $_POST['firstname'];
    $lastname        =    $_POST['lastname'];
    $emailid         =    $_POST['emailid'];
    $address         =    $_POST['address'];
    $password        =    $_POST['password'];
    
    $q="SELECT * FROM customer WHERE email='$emailid' ";
    $q_run =mysqli_query($con, $q);

    $result = mysqli_fetch_array($q_run);
    if($result){
        ?>
        <div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
        you are alredy register <strong> please login your account</strong>    
      </div>
        <script>
          let failure = document.getElementById("failure")
			failure.classList.add("show")
			setTimeout(function () { failure.classList.remove("show"); }, 5000)
          </script>
          <?php
        }
	else{
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

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verify your email';
    $mail->Body    = " Hello $firstname $lastname &nbsp;<br> Thanks for registration.<br>
    <a href='http://localhost/PDE/activation.php?eid={$encrypted_email}&token={$token}&&exd={$expire_date}'>click here</a> to verify your email.
    <br> This is link is valid for only 5 minutes.";
    $mail->AltBody = 'email varification';

    $mail->send();
} catch (Exception $e) {
  die('Error: ' . $e->getMessage());  
}
  
            $imgname = $_FILES['pic']['name'];
            $temp =  $_FILES['pic']['tmp_name'];
            move_uploaded_file($temp,"profilepics/".$emailid.$imgname);
            $hash = password_hash($password, PASSWORD_BCRYPT, ['cost'=>10]);
            $query = "INSERT INTO customer (firstname,lastname,email,address,password,validation_key,picture) VALUES('$firstname','$lastname','$emailid','$address','$hash','$token','$emailid$imgname');";
            $query_run = mysqli_query($con, $query);
            $_SESSION['id']=$emailid;
            if (!$query_run) {
                die("Query failed ".mysqli_error($con));
            } else {
                unset($firstname);
                unset($lastname);
				unset($email);
				unset($gender);
                unset($password);
                mysqli_close($con);
                // exit(header("Location: /vendor/phpmailer/phpmailer/src/SMTP.php"));
				// header('location:login.php');
				?>
                <script>
                	location.replace('login.php')
                </script>
                <?php
            }
        }  
    }          
    ?>


<title>User Registeration</title>
<style>
    input[type=file]{
    width:93px;
    color:transparent;
}
</style>
</head>

<body>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">

<!-- ============================ COMPONENT REGISTER   ================================= -->
<div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
        <strong>ERROR!</strong> something went wrong 
      </div>
	<div class="card mx-auto" style="max-width:520px; margin-top:40px;">
      <article class="card-body">
		<header class="mb-4"><h4 class="card-title">Sign up</h4></header>
		<form onsubmit="return validate()" action="register.php" method="post" enctype="multipart/form-data">
				<div class="form-row">
					<div class="col form-group">
						<label for="firstName">First name</label>
					  	<input type="text" id="firstName" class="form-control" required name="firstname" placeholder="">
						  <span id="fname" class="text-danger"></span>
					</div> <!-- form-group end.// -->
					<div class="col form-group">
						<label for="lastName" >Last name</label>
					  	<input type="text" class="form-control" id="lastName" placeholder="" required name="lastname">
						  <span id="lname" class="text-danger"></span>
					</div> <!-- form-group end.// -->
				</div> <!-- form-row end.// -->
				<div class="form-group">
					<label for="Email-ID">Email</label>
					<input type="email" class="form-control" id="Email-ID" placeholder="" required name="emailid">
					<small class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div> <!-- form-group end.// -->
                <div class="form-group">
                    <label for="myaddress">Address</label>
                    <textarea  type="text" name="address" id="myaddress" class="form-control" required rows="3"></textarea>
                    <span id="add" class="text-danger"></span>
                </div>
				<div class="form-group">
                    <label for="exampleFormControlFile1">Profile Picture</label><br>
                    <img id="myImg" src="#" style="opacity:0;" height=100 width=100><br>
                    <input type="file" class="mt-2" required id="exampleFormControlFile1" name="pic">
                    <span id="picture" class="text-danger"></span>
                </div> <!-- form-group end.// -->
				<div class="form-row">
					<div class="form-group col">
						<label for="Profile Password">Create password</label>
					    <input class="form-control" type="password" name="password" id="Profile Password" placeholder="" required>
						<span id="passcode" class="text-danger"></span>
					</div> <!-- form-group end.// --> 
					<div class="form-group col">
						<label for="Confirm Password">Repeat password</label>
					    <input class="form-control" type="password" id="Confirm Password" placeholder="" required name="pass">
						<span id="passcode1" class="text-danger"></span>
					</div> <!-- form-group end.// -->  
				</div>    
			    <div class="form-group"> 
		            <label class="custom-control custom-checkbox"> <input type="checkbox" required class="custom-control-input" checked=""> <div class="custom-control-label"> I am agree with <a href="conditions.php">terms and contitions</a>  </div> </label>
                </div> <!-- form-group end.// -->  
                <div class="form-group">
			        <button type="submit" id="submit" value="register" name="register" class="btn btn-primary btn-block"> Register  </button>
			    </div> <!-- form-group// -->         
			</form>
		</article><!-- card-body.// -->
    </div> <!-- card .// -->
    <p class="text-center mt-4">Have an account? <a href="login.php">Log In</a></p>
    <br><br>
<!-- ============================ COMPONENT REGISTER  END.// ================================= -->


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<script src="validate.js"></script>
<script>
$(function () {
        $(":file").change(function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
      document.getElementsByTagName("img")[1].removeAttribute("style");
        $('#myImg').attr('src', e.target.result);
    };
</script>
<?php include 'footer.php'?>