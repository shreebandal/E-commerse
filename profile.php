<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>
<?php
$emailid=$_SESSION['email'];

	$q="SELECT * FROM customer WHERE email='$emailid' ";
	$q_run =mysqli_query($con, $q);

	if(!$q_run)
		die("Unable to connect to database".mysqli_error($con));

	$result = mysqli_fetch_array($q_run);

	if (isset($_POST['submit'])) {
		$address = $_POST['address'];

		$query = "UPDATE customer SET address='$address' where email='$emailid'";
        $query_run = mysqli_query($con, $query);
		// header('location:profile.php');
		?>
		<script>location.replace('profile.php')</script>
		<?php
	}
	if (isset($_POST['update'])) {
		$imgname = $_FILES['pic']['name'];
		$temp =  $_FILES['pic']['tmp_name'];
		move_uploaded_file($temp,"profilepics/".$emailid.$imgname);

		$query = "UPDATE customer SET picture='$emailid$imgname' where email='$emailid'";
        $query_run = mysqli_query($con, $query);
		// header('location:profile.php');
		?>
		<script>location.replace('profile.php')</script>
		<?php
	}
	if (isset($_GET['stat'])) {
		if ($_GET['stat']=='sold'){
			$prodid = $_GET['prodid'];
			$prodtype = $_GET['prodtype'];
			$query = "UPDATE $prodtype SET issold=1 where prodseller='$emailid' AND prodid='$prodid'";
			$query_run = mysqli_query($con, $query);
			$temp = $prodtype."-".$prodid;
			mysqli_query($con, "DELETE FROM chatmsg WHERE product='$temp'");
		}
		else if ($_GET['stat']=='remove'){
			$prodid = $_GET['prodid'];
			$prodtype = $_GET['prodtype'];
			$query = "DELETE FROM $prodtype where prodseller='$emailid' AND prodid='$prodid'";
        	$query_run = mysqli_query($con, $query);
		}	
		
		// header('location:profile.php');
		?>
		<!-- <script>location.replace('profile.php')</script> -->
		<?php
	}
?>

<?php
$emailid = $_SESSION['email'];

$q="SELECT * FROM mycart WHERE personname='$emailid'";
$q_run =mysqli_query($con, $q);

if(!$q_run)
	die("Unable to connect to database".mysqli_error($con));

$num=mysqli_num_rows($q_run);
?>

<?php
$query1 =mysqli_query($con, "SELECT * FROM instruments WHERE prodseller='$emailid'");
$query2 =mysqli_query($con, "SELECT * FROM vehicals WHERE prodseller='$emailid'");
$query3 =mysqli_query($con, "SELECT * FROM electronics WHERE prodseller='$emailid'");
$query4 =mysqli_query($con, "SELECT * FROM books WHERE prodseller='$emailid'");
$query5 =mysqli_query($con, "SELECT * FROM fitness WHERE prodseller='$emailid'");
$query6 =mysqli_query($con, "SELECT * FROM clothing WHERE prodseller='$emailid'");
$query7 =mysqli_query($con, "SELECT * FROM fashionables WHERE prodseller='$emailid'");
$query8 =mysqli_query($con, "SELECT * FROM other WHERE prodseller='$emailid'");

$num1=mysqli_num_rows($query1);
$num2=mysqli_num_rows($query2);
$num3=mysqli_num_rows($query3);
$num4=mysqli_num_rows($query4);
$num5=mysqli_num_rows($query5);
$num6=mysqli_num_rows($query6);
$num7=mysqli_num_rows($query7);
$num8=mysqli_num_rows($query8);

$myselling = $num1+$num2+$num3+$num4+$num5+$num6+$num7+$num8;
?>

<title>Profile</title>
<style>
    input[type=file]{
    width:0px;
    color:transparent;
}
</style>
</head>

<body>
<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">My account</h2>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<main class="col-md-12">

		<article class="card mb-3">
			<div class="card-body">
				
				<figure class="icontext">
						<div class="icon">
							<?php if($result['picture']==null)
							echo '<img class="rounded-circle img-sm border" id="img" src="'.$result['pic'].'">' ;
							else
							echo '<img class="rounded-circle img-sm border" id="img" src="profilepics/'.$result['picture'].'">' ;
							?>
							<form action="profile.php" method="post" enctype="multipart/form-data">
							<div id="sendpic"><input type="file" required id="exampleFormControlFile1" name="pic"></div>
							</form>
						</div>
						<div class="text" id="txt">
							<strong> <?php echo $result['firstname']." ".$result['lastname'];?> </strong> <br> 
							<?php echo $emailid;?><br><br>
							<a id="click" href="#"><label for="exampleFormControlFile1">Edit pic</label></a>
							<span id="picture" class="text-danger"></span>
						</div>
				</figure>
				<hr>
				<p id="text">
					<i class="fa fa-map-marker text-muted"></i> &nbsp; My address: Lonere
					 <br>
					<?php if($result['address']!=null){
					echo $result['address'];?>
					<a id="clk" href="#" class="btn-link"> Edit</a>
					<?php } else { ?>
					<a id="clk" href="#" class="btn-link"> add address</a>
					<?php } ?>
				</p>

				

				<article class="card-group">
					<!-- <figure class="card bg">
						<div class="p-3">
							 <h5 class="card-title">38</h5>
							<span>Orders</span>
						</div>
					</figure> -->
					<figure class="card bg">
						<div class="p-3">
							 <h5 class="card-title"><?php echo $num;?></h5>
							<span>My Cart</span>
						</div>
					</figure>
					<figure class="card bg">
						<div class="p-3">
							 <h5 class="card-title"><?php echo $myselling; ?></h5>
							<span>my Sellings</span>
						</div>
					</figure>
					<!-- <figure class="card bg">
						<div class="p-4">
							 <h5 class="card-title">0</h5>
							<span>Sold Products</span>
						</div>
					</figure> -->
				</article>
				

			 </div> <!-- card-body .// -->
		  </article> <!--card.// -->
		<!-- <article class="card  mb-3">
			<div class="card-body">
				<h5 class="card-title mb-4">My orders </h5>	

				<div class="row">
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><img src="images/img1.jpg" class="border img-sm"></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> 12.09.2019</time>
							<p>Great item name goes here </p>
							<span class="text-warning">Pending</span>
						</figcaption>
					</figure>
				</div> col.//
			</div> row.//
			</div> card-body .//
		</article> card.// -->


			<article class="card  mb-3">
			<div class="card-body">
				<h5 class="card-title mb-4">My sellings </h5>	
				<div class="row">
<?php
for($i=1;$i<=$num1;$i++)
{
	$result1 = mysqli_fetch_array($query1);
	if($result1){
?>
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><?php echo '<img class="border img-sm" src="productpics/'.$result1['prodpic'].'">' ;?></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> <?php echo $result1['proddate'];?></time>
							<p><?php echo $result1['prodname'];?></p>
							<?php if($result1['issold']==0){?>
							<span class="text-warning">Pending</span>
							<a href="profile.php?prodid=<?php echo $result1['prodid']?>&stat=sold&prodtype=instruments">add to sold</a>
							<?php } else{?>
							<span class="text-success">Sold</span>
							<a href="profile.php?prodid=<?php echo $result1['prodid']?>&stat=remove&prodtype=instruments">remove</a>
							<?php } ?>
						</figcaption>
					</figure>
				</div> <!-- col.// -->
				<?php 
				} }
for($i=1;$i<=$num2;$i++)
{
	$result2 = mysqli_fetch_array($query2);
	if($result2){
?>
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><?php echo '<img class="border img-sm" src="productpics/'.$result2['prodpic'].'">' ;?></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> <?php echo $result2['proddate'];?></time>
							<p><?php echo $result2['prodname'];?></p>
							<?php if($result2['issold']==0){?>
							<span class="text-warning">Pending</span>
							<a href="profile.php?prodid=<?php echo $result2['prodid']?>&stat=sold&prodtype=vehicals">add to sold</a>
							<?php } else{?>
							<span class="text-success">Sold</span>
							<a href="profile.php?prodid=<?php echo $result2['prodid']?>&stat=remove&prodtype=vehicals">remove</a>
							<?php } ?>
						</figcaption>
					</figure>
				</div> <!-- col.// -->
				<?php
 } } 
for($i=1;$i<=$num3;$i++)
{
	$result3 = mysqli_fetch_array($query3);
	if($result3){
?>
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><?php echo '<img class="border img-sm" src="productpics/'.$result3['prodpic'].'">' ;?></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> <?php echo $result3['proddate'];?></time>
							<p><?php echo $result3['prodname'];?></p>
							<?php if($result3['issold']==0){?>
							<span class="text-warning">Pending</span>
							<a href="profile.php?prodid=<?php echo $result3['prodid']?>&stat=sold&prodtype=electronics">add to sold</a>
							<?php } else{?>
							<span class="text-success">Sold</span>
							<a href="profile.php?prodid=<?php echo $result3['prodid']?>&stat=remove&prodtype=electronics">remove</a>
							<?php } ?>
						</figcaption>
					</figure>
				</div> <!-- col.// -->
				<?php
		 } }
for($i=1;$i<=$num4;$i++)
{
	$result4 = mysqli_fetch_array($query4);
	if($result4){
?>
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><?php echo '<img class="border img-sm" src="productpics/'.$result4['prodpic'].'">' ;?></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> <?php echo $result4['proddate'];?></time>
							<p><?php echo $result4['prodname'];?></p>
							<?php if($result4['issold']==0){?>
							<span class="text-warning">Pending</span>
							<a href="profile.php?prodid=<?php echo $result4['prodid']?>&stat=sold&prodtype=books">add to sold</a>
							<?php } else{?>
							<span class="text-success">Sold</span>
							<a href="profile.php?prodid=<?php echo $result4['prodid']?>&stat=remove&prodtype=books">remove</a>
							<?php } ?>
						</figcaption>
					</figure>
				</div> <!-- col.// -->
				<?php
				 } }
for($i=1;$i<=$num5;$i++)
{
	$result5 = mysqli_fetch_array($query5);
	if($result5){
?>
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><?php echo '<img class="border img-sm" src="productpics/'.$result5['prodpic'].'">' ;?></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> <?php echo $result5['proddate'];?></time>
							<p><?php echo $result5['prodname'];?></p>
							<?php if($result5['issold']==0){?>
							<span class="text-warning">Pending</span>
							<a href="profile.php?prodid=<?php echo $result5['prodid']?>&stat=sold&prodtype=fitness">add to sold</a>
							<?php } else{?>
							<span class="text-success">Sold</span>
							<a href="profile.php?prodid=<?php echo $result5['prodid']?>&stat=remove&prodtype=fitness">remove</a>
							<?php } ?>
						</figcaption>
					</figure>
				</div> <!-- col.// -->
				<?php
 } } 
for($i=1;$i<=$num6;$i++)
{
	$result6 = mysqli_fetch_array($query6);
	if($result6){
?>
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><?php echo '<img class="border img-sm" src="productpics/'.$result6['prodpic'].'">' ;?></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> <?php echo $result6['proddate'];?></time>
							<p><?php echo $result6['prodname'];?></p>
							<?php if($result6['issold']==0){?>
							<span class="text-warning">Pending</span>
							<a href="profile.php?prodid=<?php echo $result6['prodid']?>&stat=sold&prodtype=clothing">add to sold</a>
							<?php } else{?>
							<span class="text-success">Sold</span>
							<a href="profile.php?prodid=<?php echo $result6['prodid']?>&stat=remove&prodtype=clothing">remove</a>
							<?php } ?>
						</figcaption>
					</figure>
				</div> <!-- col.// -->
				<?php
				 } } 
for($i=1;$i<=$num7;$i++)
{
	$result7 = mysqli_fetch_array($query7);
	if($result7){
?>
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><?php echo '<img class="border img-sm" src="productpics/'.$result7['prodpic'].'">' ;?></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> <?php echo $result7['proddate'];?></time>
							<p><?php echo $result7['prodname'];?></p>
							<?php if($result7['issold']==0){?>
							<span class="text-warning">Pending</span>
							<a href="profile.php?prodid=<?php echo $result7['prodid']?>&stat=sold&prodtype=fashionables">add to sold</a>
							<?php } else{?>
							<span class="text-success">Sold</span>
							<a href="profile.php?prodid=<?php echo $result7['prodid']?>&stat=remove&prodtype=fashionables">remove</a>
							<?php } ?>
						</figcaption>
					</figure>
				</div> <!-- col.// -->
				<?php 
} } 
for($i=1;$i<=$num8;$i++)
{
	$result8 = mysqli_fetch_array($query8);
	if($result8){
?>
				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<div class="aside"><?php echo '<img class="border img-sm" src="productpics/'.$result8['prodpic'].'">' ;?></div>
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> <?php echo $result8['proddate'];?></time>
							<p><?php echo $result8['prodname'];?></p>
							<?php if($result8['issold']==0){?>
							<span class="text-warning">Pending</span>
							<a href="profile.php?prodid=<?php echo $result8['prodid']?>&stat=sold&prodtype=other">add to sold</a>
							<?php } else{?>
							<span class="text-success">Sold</span>
							<a href="profile.php?prodid=<?php echo $result8['prodid']?>&stat=remove&prodtype=other">remove</a>
							<?php } ?>
						</figcaption>
					</figure>
				</div> <!-- col.// -->
				<?php } } ?>
			</div> <!-- row.// -->
			<!-- <a href="#" class="btn btn-outline-primary"> See all Products  </a> -->
			</div> <!-- card-body .// -->
		</article> <!-- card.// -->

	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
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
    //   document.getElementsByTagName("img")[1].removeAttribute("style");
        $('#img').attr('src', e.target.result);
    };
const clk = document.getElementById("clk");
clk.addEventListener('click', function () {
let text = document.getElementById("text");
text.innerHTML = `
<i class="fa fa-map-marker text-muted"></i> &nbsp; My address: Lonere
<br>
<form action="profile.php" method="post">
	<textarea  type="text" name="address" id="myaddress" class="form-control" required rows="3"></textarea>
	<button class="btn btn-primary mt-2" type="submit" name="submit" value="update">update</button>
	<span id="add" class="text-danger"></span>
</form>
 `;
const myaddress = document.getElementById("myaddress");
let validmyaddress = false;
myaddress.addEventListener('input', function () {
        let reg = /^[a-zA-Z0-9 \n]{10,300}$/;
        let str = myaddress.value;
        if (reg.test(str)) {
            myaddress.classList.remove('is-invalid');
            myaddress.classList.add('is-valid');
            document.getElementById("add").innerHTML = "";
            validmyaddress = true;
        }
        else {
            myaddress.classList.add('is-invalid');
            myaddress.classList.remove('is-valid');
            document.getElementById("add").innerHTML = "Address must be 10 to 300 characters long (only letters and numbers are allowed)";
            validmyaddress = false;
        }

	});
});
const pic = document.getElementById("exampleFormControlFile1");
pic.addEventListener('input', function () {
	const click = document.getElementById("click");
	const sendpic = document.getElementById("sendpic");
	const txt = document.getElementById("txt");
        let str = pic.value;
        if (str.endsWith(".jpg") || str.endsWith(".png")) {
            pic.classList.remove('is-invalid');
            pic.classList.add('is-valid');
            document.getElementById("picture").innerHTML = "";
			validpic = true;
				let element = document.createElement('button');
				element.innerHTML = 'Update';
				element.className = 'btn btn-primary mt-2';
				element.setAttribute('type','submit');
				element.setAttribute('name','update');
				element.setAttribute('value','submit');
				element.setAttribute('placeholder','Update');
				txt.removeChild(click);
				sendpic.appendChild(element);
        }
        else {
            pic.classList.add('is-invalid');
            pic.classList.remove('is-valid');
            document.getElementById("picture").innerHTML = "Only pnj and jpg file allowed";
            validpic = false;
		}
	});
</script>
<?php include 'footer.php'?>