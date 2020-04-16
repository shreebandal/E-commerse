<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>

<?php
if(isset($_GET['prodid'])){
	$prodid = $_GET['prodid'];
	$prodtype = $_GET['product'];
	$t = $_GET['t'];

	$query = "INSERT INTO mycart (personname,producttype,productname,uniquecart) VALUES('$emailid','$prodtype','$prodid','$emailid$prodtype$prodid')";
	$query_run = mysqli_query($con, $query);
	
	// header('location:gridproducts.php?product='.$prodtype.'&t='.$t.'');
	?>
	<script>location.replace('gridproducts.php?product=<?php echo $prodtype ?>&t=<?php echo $t ?>')</script>
	<?php
}

?>

<?php
$emailid = $_SESSION['email'];
$prodtype = $_GET['product'];

$query="SELECT * FROM $prodtype WHERE issold=0  ORDER BY prodid DESC";
$query_run =mysqli_query($con, $query);

if(!$query_run)
	die("Unable to connect to database".mysqli_error($con));

$number=mysqli_num_rows($query_run);

$myresult = mysqli_fetch_array($query_run);
$mytemp = $myresult['prodid'];

$q="SELECT * FROM $prodtype";
$q_run =mysqli_query($con, $q);

if(!$q_run)
	die("Unable to connect to database".mysqli_error($con));

$num=mysqli_num_rows($q_run);
?>

<title>Products</title>
</head>
<body>
<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">Category products</h2>
	<nav>
	<ol class="breadcrumb text-white">
	    <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
	    <li class="breadcrumb-item active"><?php echo $prodtype;?></li>
	</ol>  
	</nav>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col-md-3">
		
<div class="card">
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Product type</h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_1" style="">
			<div class="card-body">
				<!-- <form class="pb-3">
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Search">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
				  </div>
				</div>
				</form> -->
				
			<ul class="list-menu">
				<li class="nav-item">
					<a class="nav-link" href="gridproducts.php?product=instruments&t=1">College Instruments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gridproducts.php?product=vehicals&t=1">Vehicals</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gridproducts.php?product=electronics&t=1">Electronics</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gridproducts.php?product=books&t=1">Books &amp Notes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gridproducts.php?product=fitness&t=1">Fitness sport</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gridproducts.php?product=clothing&t=1">Clothing</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gridproducts.php?product=fashionables&t=1">Fashionables</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gridproducts.php?product=other&t=1">Others</a>
				</li>
			</ul>

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group  .// -->
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Price range </h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_3" style="">
			<div class="card-body">
				<!-- <input type="range" class="custom-range" min="0" max="100" name=""> -->
				<form action="showproducts.php?product=<?php echo $prodtype;?>&range=range" method="post">
				<div class="form-row">
				<div class="form-group col-md-6">
				  <label>Min</label>
				  <input class="form-control" name="minval" required placeholder="₹0" type="number">
				</div>
				<div class="form-group text-right col-md-6">
				  <label>Max</label>
				  <input class="form-control" name="maxval" required placeholder="₹1,0000" type="number">
				</div>
				</div> <!-- form-row.// -->
				<button type="submit" name="gridproducts" value="gridproducts" class="btn btn-block btn-primary">Apply</button>
				</form>
			</div><!-- card-body.// -->
		</div>
	</article> <!-- filter-group .// -->
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">More filter </h6>
			</a>
		</header>
		<div class="filter-content collapse in" id="collapse_5" style="">
			<div class="card-body">
				<form action="showproducts.php?product=<?php echo $prodtype;?>&quality=quality" method="post">
					<label class="custom-control custom-radio">
					<input type="radio" name="myfilter_radio" checked="" value="" class="custom-control-input">
					<div class="custom-control-label">Any condition</div>
					</label>

					<label class="custom-control custom-radio">
					<input type="radio" name="myfilter_radio" value="new" class="custom-control-input">
					<div class="custom-control-label">Brand new </div>
					</label>

					<label class="custom-control custom-radio">
					<input type="radio" name="myfilter_radio" value="used" class="custom-control-input">
					<div class="custom-control-label">Used items</div>
					</label>

					<label class="custom-control custom-radio">
					<input type="radio" name="myfilter_radio" value="old" class="custom-control-input">
					<div class="custom-control-label">Very old</div>
					</label>
					<button type="submit" name="gridproducts" value="gridproducts" class="btn btn-block btn-primary">Apply</button>
				</form>
			</div><!-- card-body.// -->
		</div>
	</article> <!-- filter-group .// -->
</div> <!-- card.// -->

	</aside> <!-- col.// -->
	<main class="col-md-9">

<header class="border-bottom mt-3 mb-4 pb-3">
		<div class="form-inline">
			<span class="mr-md-auto"><?php echo $num;?> Items found </span>
			<form action="showproducts.php?product=<?php echo $prodtype;?>" method="post">
				<select name="search" class="form-control">
					<option value="recent">Recently Added</option>
					<option  value="cheap">Cheapest</option>
					<option  value="costly">Costly</option>
				</select>
				<button class="btn form-control btn-primary" name="gridproducts" value="gridproducts" type="submit">
					<i class="fa fa-search"></i>
				</button>
			</form>
			<div class="btn-group ml-2">
				<a href="products.php?product=<?php echo $prodtype;?>&t=1" class="btn btn-outline-secondary" data-toggle="tooltip" title="List view"> 
					<i class="fa fa-bars"></i></a>
				<a href="gridproducts.php?product=<?php echo $prodtype;?>&t=1" class="btn  btn-outline-secondary active" data-toggle="tooltip" title="Grid view"> 
					<i class="fa fa-th"></i></a>
			</div>
		</div>
</header><!-- sect-heading -->

<div class="row">
<?php 
$temptemp = 6;
if(isset($_GET['t'])){
	$my_temp = $_GET['t']; 
	$temptemp += $my_temp;
	$my_temptemp = $_GET['t'];
}
while($my_temp!=$mytemp+1)
		{
			$myquery="SELECT * FROM $prodtype WHERE prodid='$my_temp' AND issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='$prodtype') ";
			$myquery_run =mysqli_query($con, $myquery);
			$myresults = mysqli_fetch_array($myquery_run);
			$mynumber=mysqli_num_rows($myquery_run);
			if($myresults){
?>
	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="img-wrap"> 
				<!-- <span class="badge badge-danger"> NEW </span> -->
				<a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $myresults['prodid'];?>"><?php echo '<img src="productpics/'.$myresults['prodpic'].'">' ;?></a>
				<a class="btn-overlay" href="buyproduct.php?prodtype=<?php echo $myresults;?>&prodid=<?php echo $myresults['prodid'];?>"><i class="fa fa-search-plus"></i> Quick view</a>
			</div> <!-- img-wrap.// -->
			<figcaption class="info-wrap">
				<div class="fix-height">
					<a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $myresults['prodid'];?>" class="title"><?php echo $myresults['prodname'];?></a>
					<div class="price-wrap mt-2">
						<span class="price h5">₹ <?php echo $myresults['prodnewprice'];?></span>	
						<del class="price-old">₹ <?php echo $myresults['prodoldprice'];?></del>
					</div> <!-- price-wrap.// -->
				</div>
				<a href="gridproducts.php?product=<?php echo $prodtype;?>&prodid=<?php echo $myresults['prodid'];?>&t=<?php echo $my_temptemp;?>" class="btn btn-block btn-primary">Add to cart </a>
			</figcaption>
		</figure>
	</div> <!-- col.// -->
	<?php
		}
		$my_temp += 1;	
		if($mynumber==0){ $temptemp += 1; }
		if($my_temp==$temptemp){ break; }
 }
 ?>
 </div>
 <?php
 $arr = array();
 $index	= 0;
 if(isset($_GET['p'])) { 
	$p = $_GET['p'];
	$index = $_GET['index'];
	$Text = urldecode($_REQUEST['arr']);
	$arr = json_decode($Text);
	$arr[$index] = $p;
	$index += 1;
}
if(isset($_GET['a'])) {
	$Text = urldecode($_REQUEST['arr']);
	$arr = json_decode($Text);
	array_pop($arr);
	$index = $_GET['index'];
}
$Text = json_encode($arr);
$RequestText = urlencode($Text);
 ?>
<nav aria-label="Page navigation sample">
<div class="card-body border-top">
	<?php if($my_temptemp!=1){ ?>
	<a href="gridproducts.php?product=<?php echo $prodtype;?>&t=<?php echo $arr[$index-1];?>&a=a&index=<?php echo $index-1;?>&arr=<?php echo $RequestText;?>" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Back </a>
	<?php } if($my_temp!=$mytemp+1){ ?>
	<a href="gridproducts.php?product=<?php echo $prodtype;?>&t=<?php echo $my_temp;?>&p=<?php echo $my_temptemp;?>&index=<?php echo $index;?>&arr=<?php echo $RequestText;?>" class="btn btn-primary float-md-right"> Next <i class="fa fa-chevron-right"></i> </a>
	<?php } ?>
</div>
</nav>

	</main> <!-- col.// -->

</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<?php include 'footer.php'?>