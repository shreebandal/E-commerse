<?php include 'header.php'?>
<?php
if(isset($_SESSION['email']))
    header('location:homepage.php');
if(isset($_GET['email'])){
  $email = $_GET['email'];
  $_SESSION['email']=$email;
  header('location:homepage.php');
}
?>
<?php
include 'config.php';

if(isset($_POST['register'])){
    $emailid=$_POST['emailid'];
    $password=$_POST['password'];

        $q="SELECT * FROM customer WHERE email='$emailid' ";
        $q_run =mysqli_query($con, $q);

        if(!$q_run)
            die("Unable to connect to database".mysqli_error($con));

        $result = mysqli_fetch_array($q_run);
        if($result){
      if($result['mailotp']==1){
        if(password_verify($password, $result['password'])){
            $_SESSION['email']=$emailid;
            unset($emailid);
            unset($password);
            unset($_SESSION['id']);
            header('location:homepage.php');
        }
        else{
          ?>
        <div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
        Password doesn't match <strong> please enter valid password</strong>    
      </div>
        <script>
          let failure = document.getElementById("failure")
					failure.classList.add("show")
					setTimeout(function () { failure.classList.remove("show"); }, 5000)
          </script>
          <?php
        }
      }
      else{
        ?>
        <div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
        Confirmation link send in your Email Account <strong> link will be expire after 5 minutes</strong>  
        <a href="resendmail.php"><button class="btn btn-primary ml-5"> Resend Link </button></a>
      </div>
        <script>
          let failure = document.getElementById("failure")
					failure.classList.add("show")
					setTimeout(function () { failure.classList.remove("show"); }, 10000)
          </script>
          <?php
      }
        }
        else{
          header('location:register.php');
        }
    mysqli_close($con);
    
    }
?>

<title>Login Page</title>
</head>

<body>
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-conten padding-y" style="min-height:84vh">

<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto" style="max-width: 380px; margin-top:70px;">
      <div class="card-body">
      <h4 class="card-title mb-4">Sign in</h4>
      <form action="login.php" method="post">
      	  <a href="<?php echo $gClient->createAuthUrl(); ?>" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp  Sign in with Google</a>
          <div class="form-group">
			 <input name="emailid" class="form-control" id="email" placeholder="Username" type="email">
          </div> <!-- form-group// -->
          <div class="form-group">
			<input name="password" id="password" class="form-control" placeholder="Password" type="password">
          </div> <!-- form-group// -->
          
          <div class="form-group">
          	<a href="forgotpassword.php" class="float-right">Forgot password?</a> 
            <!-- <label class="float-left custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input" checked=""> <div class="custom-control-label"> Remember </div> </label> -->
          </div> <!-- form-group form-check .// -->
          <div class="form-group">
              <button type="submit" name="register" class="btn btn-primary btn-block"> Login  </button>
          </div> <!-- form-group// -->    
      </form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->

     <p class="text-center mt-4">Don't have account? <a href="register.php">Sign up</a></p>
     <br><br>
<!-- ============================ COMPONENT LOGIN  END.// ================================= -->


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<?php include 'footer.php'?>