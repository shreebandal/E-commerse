<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>

<?php
$emailid = $_SESSION['email'];

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$product = $_GET['prodtype'];

	$deletequery="DELETE FROM mycart WHERE uniquecart='$emailid$product$id'";
	$deletequery_run =mysqli_query($con, $deletequery);

	// header('location:shoppingcart.php');
	?>
    <script>location.replace('shoppingcart.php')</script>
    <?php
}
?>

<?php
$q="SELECT * FROM mycart WHERE personname='$emailid'";
$q_run =mysqli_query($con, $q);

if(!$q_run)
	die("Unable to connect to database".mysqli_error($con));

$num=mysqli_num_rows($q_run);
?>

<title>Cart</title>
</head>

<body>
<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">Shopping cart</h2>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<?php if($num){ ?>

<section class="section-content padding-y">
<div class="container">

<div class="row">
	<main class="col-md-9">
<div class="card">

<table class="table table-borderless table-shopping-cart">
<thead class="text-muted">
<tr class="small text-uppercase">
  <th scope="col">Product</th>
  <!-- <th scope="col" width="120">Quantity</th> -->
  <th scope="col" width="120">Price</th>
  <th scope="col" class="text-right" width="200"> </th>
</tr>
</thead>

<?php
$totalnewprice = 0;
$totaloldprice = 0;
for($i=1;$i<=$num;$i++)
{
$results = mysqli_fetch_array($q_run);
$prodtype = $results['producttype'];
$prodid = $results['productname'];

$query="SELECT * FROM $prodtype WHERE prodid='$prodid'";
$query_run =mysqli_query($con, $query);

$result = mysqli_fetch_array($query_run);

$totalnewprice += $result['prodnewprice'];
$totaloldprice += $result['prodoldprice'];
?>

<tbody>
<tr>
	<td>
		<figure class="itemside">
			<div class="aside"><a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $prodid;?>"><?php echo '<img class="img-sm" src="productpics/'.$result['prodpic'].'">' ;?></a></div>
			<figcaption class="info">
				<a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $prodid;?>" class="title text-dark"><?php echo $result['prodname'];?></a>
				<p class="text-muted small"><?php echo $result['proddesc'];?></p>
			</figcaption>
		</figure>
	</td>
	<!-- <td> 
		<select class="form-control">
			<option>1</option>
			<option>2</option>	
			<option>3</option>	
			<option>4</option>	
		</select> 
	</td> -->
	<td> 
		<div class="price-wrap"> 
			<var class="price">₹ <?php echo $result['prodnewprice'];?></var> 
			<small class="text-muted"><del class="price-old">₹ <?php echo $result['prodoldprice'];?></del></small> 
		</div> <!-- price-wrap .// -->
	</td>
	<td class="text-right"> 
	<!-- <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip"> <i class="fa fa-heart"></i></a>  -->
	<a href="shoppingcart.php?id=<?php echo $result['prodid'];?>&prodtype=<?php echo $prodtype;?>" class="btn btn-light"> Remove</a>
	</td>
</tr>
</tbody>
<?php } ?>
</table>

<div class="card-body border-top">
	<a href="reviewcart.php" class="btn btn-primary float-md-right"> Make Purchase <i class="fa fa-chevron-right"></i> </a>
	<a href="homepage.php" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
</div>	
</div> <!-- card.// -->

<!-- <div class="alert alert-success mt-3">
	<p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
</div> -->

	</main> <!-- col.// -->
	<aside class="col-md-3">
		<!-- <div class="card mb-3">
			<div class="card-body">
			<form>
				<div class="form-group">
					<label>Have coupon?</label>
					<div class="input-group">
						<input type="text" class="form-control" name="" placeholder="Coupon code">
						<span class="input-group-append"> 
							<button class="btn btn-primary">Apply</button>
						</span>
					</div>
				</div>
			</form>
			</div>  card-body.// 
		</div>  card .// -->
		<div class="card">
			<div class="card-body">
					<dl class="dlist-align">
					  <dt>Total price:</dt>
					  <dd class="text-right">₹ <?php echo $totaloldprice;?></dd>
					</dl>
					<dl class="dlist-align">
					  <dt>Discount:</dt>
					  <dd class="text-right">₹ <?php echo $totaloldprice-$totalnewprice;?></dd>
					</dl>
					<dl class="dlist-align">
					  <dt>Total:</dt>
					  <dd class="text-right  h5"><strong>₹ <?php echo $totalnewprice;?></strong></dd>
					</dl>
					<hr>
					<p class="text-center mb-3">
						<img src="images/payments.png" height="26">
					</p>
					
			</div> <!-- card-body.// -->
		</div>  <!-- card .// -->
	</aside> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<?php } ?>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name bg padding-y">
<div class="container">
<h6>Payment and refund policy</h6>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

</div><!-- container // -->
</section>
<?php include 'footer.php'?>