<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>

<?php
$emailid = $_SESSION['email'];
if(isset($_GET['prodtype'])){
$prodtype = $_GET['prodtype'];
$prodid = $_GET['prodid'];

$query="SELECT * FROM $prodtype WHERE prodid='$prodid'";
$query_run =mysqli_query($con, $query);

if(!$query_run)
	die("Unable to connect to database".mysqli_error($con));

$result = mysqli_fetch_array($query_run);
}
?>

<?php
if(isset($_GET['product'])){
	$prodtype = $_GET['product'];
	$prodid = $_GET['prodid'];

	$query = "INSERT INTO mycart (personname,producttype,productname,uniquecart) VALUES('$emailid','$prodtype','$prodid','$emailid$prodtype$prodid')";
	$query_run = mysqli_query($con, $query);
	
	// header('location:products.php?product='.$prodtype.'&t='.$t.'');
	?>
	<script>location.replace('homepage.php')</script>
	<?php
}

?>

<style>
	#img{
		height: 100%;
    	width: 100%;
	}
</style>
<section class="section-conten padding-y">

<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto" style="max-width: 980px; margin-top:30px; margin-bottom:30px;">
<output>
	<div class="card">
	<div class="row no-gutters">
		<aside class="col-md-6">
<article class="gallery-wrap">
<div class="img-wrap"> 
<a href="#"><?php echo '<img id="img" src="productpics/'.$result['prodpic'].'">' ;?></a>
</div> 
<!-- <div class="thumbs-wrap">
  <a href="" class="item-thumb"> <img src="images/shooe1.jpg"></a>
  <a href="" class="item-thumb"> <img src="images/shooe2.jpg"></a>
  <a href="" class="item-thumb"> <img src="images/shooe3.jpg"></a>
</div> slider-nav.// -->
</article> 
		</aside>
		<main class="col-md-6 border-left">
<article class="content-body">

<h1 class="title"><?php echo $result['prodname'];?></h1>

<!-- <div class="rating-wrap my-3">
	<ul class="rating-stars">
		<li style="width:80%" class="stars-active">
			<i class="fa fa-star"></i> <i class="fa fa-star"></i>
			<i class="fa fa-star"></i> <i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
		</li>
		<li>
			<i class="fa fa-star"></i> <i class="fa fa-star"></i>
			<i class="fa fa-star"></i> <i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
		</li>
	</ul>
	<small class="label-rating text-muted">132 reviews</small>
	<small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders </small>
</div> rating-wrap.// -->

<div class="mb-3 mt-3">
	<strong>Price</strong><br>
	<var class="price h4">₹ <?php echo $result['prodnewprice'];?></var>
	<span class="text-muted"><del class="price-old">₹ <?php echo $result['prodoldprice'];?></del></span>
</div> <!-- price-detail-wrap .// -->

<p><strong>Describtion</strong><br><?php echo $result['proddesc'];?></p>

<?php if($result['prodfetures']){?>
<dl class="row">
  <dt class="col-sm-12">Features</dt>
  <dd class="col-sm-12"><?php echo $result['prodfetures'];?></dd>
</dl>
<?php } ?>

<hr>
	<!-- <div class="form-row">
		<div class="form-group col-md flex-grow-0">
			<label>Quantity</label>
			<div class="input-group mb-3 input-spinner">
			  <div class="input-group-prepend">
			    <button class="btn btn-light" type="button" id="button-plus"> + </button>
			  </div>
			  <input type="text" class="form-control" value="1">
			  <div class="input-group-append">
			    <button class="btn btn-light" type="button" id="button-minus"> − </button>
			  </div>
			</div> -->
		<!-- </div> col.// -->
		<!-- <div class="form-group col-md">
				<label>Select size</label>
				<div class="mt-1">
					<label class="custom-control custom-radio custom-control-inline">
					  <input type="radio" name="select_size" checked="" class="custom-control-input">
					  <div class="custom-control-label">Small</div>
					</label>

					<label class="custom-control custom-radio custom-control-inline">
					  <input type="radio" name="select_size" class="custom-control-input">
					  <div class="custom-control-label">Medium</div>
					</label>

					<label class="custom-control custom-radio custom-control-inline">
					  <input type="radio" name="select_size" class="custom-control-input">
					  <div class="custom-control-label">Large</div>
					</label>

				</div> -->
		<!-- </div> col.// -->
	<!-- </div> row.//  -->
    <a href="chat.php?email=<?php echo $result['prodseller'];?>&prodtype=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>" class="btn  btn-primary" >Chat Now</a>
	<a href="buyproduct.php?product=<?php echo $prodtype; ?>&prodid=<?php echo $prodid;?>" class="btn  btn-outline-primary"> <span class="text">Add to cart</span> <i class="fas fa-shopping-cart"></i>  </a>
</article> <!-- product-info-aside .// -->
		</main> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->
</output>
</div>
</section>
<?php include 'footer.php'?>