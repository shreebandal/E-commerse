<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>
  <?php
    $emailid          =    $_SESSION['email'];
  if (isset($_POST['register'])) {
    
    $prodtype             =    $_POST['prodtype'];
    $prodname             =    $_POST['prodname'];
    $prodoldprice         =    $_POST['prodoldprice'];
    $prodnewprice         =    $_POST['prodnewprice'];
    $prodcondition        =    $_POST['prodcondition'];
    $proddesc             =    $_POST['proddesc'];
    $prodfetures          =    $_POST['prodfetures'];
    if(isset($_POST['prodadd'])){ $prodadd  =  $_POST['prodadd']; }

    $prodfeture = "";
    for($i=1;$i<=$prodfetures;$i++){
          $prodfeture    .=     $_POST['prodfeture'.$i]."<br>";
    }

    $imgname = $_FILES['prodpic']['name'];
    $temp =  $_FILES['prodpic']['tmp_name'];
    move_uploaded_file($temp,"productpics/".$emailid.$imgname);

    $query = "INSERT INTO $prodtype (prodname,prodoldprice,prodnewprice,prodcondition,proddesc,prodfetures,prodpic,prodseller) VALUES('$prodname','$prodoldprice','$prodnewprice','$prodcondition','$proddesc','$prodfeture','$emailid$imgname','$emailid')";
    $query_run = mysqli_query($con, $query);
  
    if(isset($prodadd)){
      ?>
      <script>
       	location.replace('test.php?prodtype=<?php echo $prodtype;?>')
      </script>
      <?php
      // header("location:test.php?prodtype='.$prodtype.'&prodid='.$prodid.''");
    }
    else{
      ?>
      <script>
       	location.replace('profile.php')
      </script>
      <?php
    }
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
	<div class="card mx-auto" style="max-width: 580px; margin-top:50px; margin-bottom:50px;">
<output>
      <div class="card-body">
      <h4 class="card-title mb-12">Sell Product</h4>
      <form action="sellproduct.php" method="post" onsubmit="return validate()" enctype="multipart/form-data">
		<div class="form-group">
			<label for="name">Product Name</label>
		  	<input type="text" name="prodname" id="name" class="form-control" required placeholder="">
        <span id="pname" class="text-danger"></span>
    </div> <!-- form-group end.// -->
    <div class="form-group">
			<label for="oldprice">Market Price</label>
		  	<input type="number" name="prodoldprice" id="oldprice" class="form-control" required placeholder="">
        <span id="price" class="text-danger"></span>
		</div>
    <div class="form-group">
			<label for="newprice">Your Price</label>
		  	<input type="number" name="prodnewprice" id="newprice" class="form-control" required placeholder="">
        <span id="pprice" class="text-danger"></span>
    </div>
    <div class="form-group"> Product Conditon 
      <label class="custom-control custom-radio">
			  <input type="radio" name="prodcondition" value="new" checked="" class="custom-control-input">
			  <div class="custom-control-label mt-2">Brand new </div>
      </label>
      <label class="custom-control custom-radio">
				<input type="radio" name="prodcondition" value="used" class="custom-control-input">
			  <div class="custom-control-label">Used items</div>
      </label>
      <label class="custom-control custom-radio">
				<input type="radio" name="prodcondition" value="old" class="custom-control-input">
			  <div class="custom-control-label">Very old</div>
      </label>
    </div>
		<div class="form-group">
			<label for="describtion">Product Describtion</label>
			<textarea  type="text" name="proddesc" id="describtion" class="form-control" required rows="3"></textarea>
      <span id="pdesc" class="text-danger"></span>
		</div>
    <div class="form-group">
			<label for="fetures">How many fetures wanna add ?</label>
		  	<input type="number" name="prodfetures" id="fetures" class="form-control" placeholder="">
        <input type="hidden" name="prodtype" value="<?php echo $_GET['product']; ?>">
        <span id="pfetures" class="text-danger"></span>
    </div>
    <div class="form-group" id="validate"></div>
		<div class="form-group">
			<label for="exampleFormControlFile1">Add Product Picture</label><br>
      <img id="myImg" src="#" style="opacity:0;" height=100 width=100><br>
          <input type="file" class="mt-2" required id="exampleFormControlFile1" name="prodpic">
          <span id="picture" class="text-danger"></span>
    </div>
    <div class="form-group custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" id="switch1" name="prodadd">
      <label class="custom-control-label" for="switch1">Add to HomePage for 7 days (in just ₹ 100)</label>
    </div>
		<button type="submit" name="register" value="submit" class="btn btn-primary btn-block">Sell</button>
      </form>
      <!-- <a href='https://www.payumoney.com/paybypayumoney/#/AF509E97C2244F9D9B10EA9637466B13'><img src='https://www.payumoney.com/media/images/payby_payumoney/new_buttons/21.png' /> -->
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

    const fetures = document.getElementById('fetures');
    const name = document.getElementById('name');
    const oldprice = document.getElementById('oldprice');
    const newprice = document.getElementById('newprice');
    const describtion = document.getElementById('describtion');
    const pic = document.getElementById("exampleFormControlFile1");
    let validname = false;
    let validprice = false;
    let validdesc = false;
    let validpic = false;

    fetures.addEventListener('input', function () {
      let validfetures = false;
          let html = '';
          let validate = document.getElementById('validate');
          if(fetures.value<=5){
          for (let i = 1; i <= fetures.value; i++) {
            html += `
            <label for="feture${i}">Feture${i}</label>
		  	        <input type="text" name="prodfeture${i}" required id="feture${i}" class="form-control" placeholder="">
        `;
          } 
          fetures.classList.remove('is-invalid');
          fetures.classList.add('is-valid');
          document.getElementById("pfetures").innerHTML = "";
          validfetures = true;
          }
          else{
            fetures.classList.add('is-invalid');
            fetures.classList.remove('is-valid');
            document.getElementById("pfetures").innerHTML = "you can't add more than 5 features";
            validfetures = false;
          }
          validate.innerHTML = html;
        });
        name.addEventListener('input', function () {
            let reg = /^[a-zA-Z0-9 ,".-]{5,50}$/;
            let str = name.value;
            if (reg.test(str)) {
              name.classList.remove('is-invalid');
              name.classList.add('is-valid');
                document.getElementById("pname").innerHTML = "";
                validname = true;
            }
            else {
              name.classList.add('is-invalid');
              name.classList.remove('is-valid');
                document.getElementById("pname").innerHTML = "Product name must be 5 to 30 characters long";
                validname = false;
            }

        });
        newprice.addEventListener('input', function () {
          if (newprice.value>=100 && newprice.value<=50000 && parseInt(newprice.value)<=parseInt(oldprice.value) ){
              newprice.classList.remove('is-invalid');
              newprice.classList.add('is-valid');
                document.getElementById("pprice").innerHTML = "";
                validprice = true;
            }
            else {
              newprice.classList.add('is-invalid');
              newprice.classList.remove('is-valid');
                document.getElementById("pprice").innerHTML = "price is not less than 100 and not greater than 50,000 and market price";
                validprice = false;
            }

        });

        describtion.addEventListener('input', function () {
            let reg = /^[a-zA-Z0-9 ,".\n-]{30,300}$/;
            let str = describtion.value;
            if (reg.test(str)) {
              describtion.classList.remove('is-invalid');
              describtion.classList.add('is-valid');
                document.getElementById("pdesc").innerHTML = "";
                validdesc = true;
            }
            else {
              describtion.classList.add('is-invalid');
              describtion.classList.remove('is-valid');
                document.getElementById("pdesc").innerHTML = "Product describtion must be 30 to 300 characters long";
                validdesc = false;
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
    if (validpic && validfetures && validname && validprice && validdesc) {
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