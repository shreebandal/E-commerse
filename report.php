<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>

<?php
    $emailid          =    $_SESSION['email'];
 	 if (isset($_POST['register'])) {
    
    $email                   =    $_POST['email'];
    $feebacktype             =    $_POST['feebacktype'];
    $feedbackmsg             =    $_POST['feedbackmsg'];

    $imgname = $_FILES['prodpic']['name'];
    $temp =  $_FILES['prodpic']['tmp_name'];
    move_uploaded_file($temp,"report/".$emailid.$imgname);

    $query = "INSERT INTO report (email,feebacktype,feedbackmsg,feedbackpic) VALUES('$email','$feebacktype','$feedbackmsg','$emailid$imgname')";
    $query_run = mysqli_query($con, $query);
  
	// header("location:homepage.php");
	?>
    <script>
    alert("developer take appropriate action against it soon...")
    location.replace('homepage.php')
    </script>
    <?php
  }
  ?>

<style>
    input[type=file]{
    width:93px;
    color:transparent;
}
</style>
<section class="section-conten padding-y" style="min-height:84vh">
<div id="failure" class="alert alert-danger alert-dismissible fade" role="alert">
        <strong>ERROR!</strong> something went wrong 
      </div>
<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto" style="max-width: 390px; margin-top:50px; margin-bottom:50px;">
<output>
      <div class="card-body">
      <h4 class="card-title mb-12">Report User</h4>
      <form action="report.php" method="post" onsubmit="return validate()" enctype="multipart/form-data">
		<!-- <div class="form-group">
			<label>Email</label>
		  	<input type="text" class="form-control" placeholder="">
		</div> form-group end.// -->
		<div class="form-group">
			<label>What is report about?</label>
			<select class="form-control" name="feebacktype">
				<option>Select</option>
				<option value="Spam">Spam</option>
                <option value="Fraud">Fraud</option>
                <option value="Inappropriate profile picture">Inappropriate profile picture</option>
                <option value="This user is threatening me">This user is threatening me</option>
                <option value="This user is insulting me">This user is insulting me</option>
				<option value="other">other</option>
			</select>
		</div>
		<div class="form-group">
			<label>What is message behind report?</label>
			<textarea class="form-control" name="feedbackmsg" id="message" rows="3"></textarea>
			<span id="msg" class="text-danger"></span>
		</div>
		<div class="form-group">
			<label for="exampleFormControlFile1">Add Screenshot</label><br>
      		<img id="myImg" src="#" style="opacity:0;" height=100 width=100><br>
              <input type="file" class="mt-2" required id="exampleFormControlFile1" name="prodpic">
              <input type="hidden" value="<?php echo $_GET['email'];?>" name="email">
            <span id="picture" class="text-danger"></span>
    	</div>
		<button class="btn btn-primary btn-block" type="submit" name="register" value="submit">Complaint</button>
      </form>
      </div> <!-- card-body.// -->
</output>

</div>
</session>
<script type="text/javascript">
    /* The uploader form */
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
      document.getElementsByTagName("img")[2].removeAttribute("style");
        $('#myImg').attr('src', e.target.result);
	};

	const msg = document.getElementById('message');
	const pic = document.getElementById("exampleFormControlFile1");
	let validmsg = false;
	let validpic = false;
	
	msg.addEventListener('input', function () {
            let reg = /^[a-zA-Z0-9 ,".\n-]{30,300}$/;
            let str = msg.value;
            if (reg.test(str)) {
				msg.classList.remove('is-invalid');
				msg.classList.add('is-valid');
                document.getElementById("msg").innerHTML = "";
                validmsg = true;
            }
            else {
				msg.classList.add('is-invalid');
				msg.classList.remove('is-valid');
                document.getElementById("msg").innerHTML = "feedback message must be 30 to 300 characters long";
                validmsg = false;
            }

        });
    pic.addEventListener('input', function () {
        let str = pic.value;
        if (str.endsWith(".jpg") || str.endsWith(".png")) {
            pic.classList.remove('is-invalid');
            pic.classList.add('is-valid');
            document.getElementById("picture").innerHTML = "";
            validpic = true;
        }
        else {
            pic.classList.add('is-invalid');
            pic.classList.remove('is-valid');
            document.getElementById("picture").innerHTML = "Only pnj and jpg file allowed";
            validpic = false;
		}
	});
	function validate() {
    if (validpic && validmsg) {
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