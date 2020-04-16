<?php include 'header.php'?>

<?php
include 'config.php';

if(isset($_POST['register'])){
    $emailid=$_POST['email'];
    $password=$_POST['password'];

        $q="SELECT * FROM customer WHERE email='$emailid' ";
        $q_run =mysqli_query($con, $q);

        if(!$q_run)
            die("Unable to connect to database".mysqli_error($con));

        $result = mysqli_fetch_array($q_run);
        if(password_verify($password, $result['password'])){
            ?>
            <div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
            Choose a Password that not use before.    
          </div>
            <script>
              let failure = document.getElementById("failure")
                failure.classList.add("show")
                setTimeout(function () { failure.classList.remove("show"); }, 5000)
              </script>
              <?php
        }
        else{
            $hash = password_hash($password, PASSWORD_BCRYPT, ['cost'=>10]);
            $query = "UPDATE customer SET password='$hash' where email='$emailid'";
            $query_run = mysqli_query($con, $query);
            if(!$query_run)
                die("Connection to database failed!".mysqli_error($con));
            header('location:login.php');

        }
    }
?>
<title>change Password</title>
</head>

<body>


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-conten padding-y" style="min-height:84vh">
<div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
        please enter valid <strong> Password</strong>    
        </div>
<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
      <div class="card-body">
      <h4 class="card-title mb-4">Change Password</h4>
      <form onsubmit="return validate()" action="changepassword.php" method="post">
          <div class="form-group">
            <label for="Profile Password">Create password</label>
		    <input class="form-control" type="password" name="password" id="Profile Password" placeholder="" required>
			<span id="passcode" class="text-danger"></span>
          </div> <!-- form-group// -->
          <div class="form-group">
            <label for="Confirm Password">Repeat password</label>
		    <input class="form-control" type="password" id="Confirm Password" placeholder="" required name="pass">
			<span id="passcode1" class="text-danger"></span>
          </div> <!-- form-group// -->
          <div class="form-group">
          <input class="form-control" type="hidden" id="email" placeholder="" required value="<?php echo $_GET['email'];?>"name="email">
              <button type="submit" name="register" class="btn btn-primary btn-block"> Login  </button>
          </div> <!-- form-group// -->    
      </form>
      </div> <!-- card-body.// -->
    </div> <!-- card .// -->
<!-- ============================ COMPONENT LOGIN  END.// ================================= -->


</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<script>
const password = document.getElementsByName("password")[0];
const pass = document.getElementsByName("pass")[0];
let validpassword = false;
let validpass = false;
password.addEventListener('input', function () {
    let reg1 = /([A-Z])/;
    let reg2 = /([a-z])/;
    let reg3 = /([0-9])/;
    let reg4 = /[~!@#$%^&]/;
    let str = password.value;
    if (reg1.test(str) && str.length <= 20 && str.length >= 8 && reg2.test(str) && reg3.test(str) && reg4.test(str)) {
        password.classList.remove('is-invalid');
        password.classList.add('is-valid');
        document.getElementById("passcode").innerHTML = "";
        validpassword = true;
    }
    else {
        password.classList.add('is-invalid');
        password.classList.remove('is-valid');
        document.getElementById("passcode").innerHTML = "Password must be at least 8 to 20 characters long where 1 upper case, 1 lower case, 1 number and 1 special character";
        validpassword = false;
    }

});
pass.addEventListener('input', function () {
    let str1 = password.value;
    let str2 = pass.value;
    if (str1 == str2) {
        pass.classList.remove('is-invalid');
        pass.classList.add('is-valid');
        document.getElementById("passcode1").innerHTML = "";
        validpass = true;
    }
    else {
        pass.classList.add('is-invalid');
        pass.classList.remove('is-valid');
        document.getElementById("passcode1").innerHTML = "Password doesn't matched";
        validpass = false;
    }

});
function validate() {
    if (validpassword && validpass) {
        return true;
    }
    else {
        let failure = document.getElementById("failure");
        failure.classList.add('show');
        setTimeout(function () {
            failure.classList.remove('show');
        }, 5000)
        return false;
    }
}
</script>

<?php include 'footer.php'?>