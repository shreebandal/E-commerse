<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>

<?php
if(isset($_GET['prodid'])){
	$prodid = $_GET['prodid'];
	$prodtype = $_GET['product'];

	$query = "INSERT INTO mycart (personname,producttype,productname,uniquecart) VALUES('$emailid','$prodtype','$prodid','$emailid$prodtype$prodid')";
	$query_run = mysqli_query($con, $query);
	
    // header('location:shoppingcart.php');
    ?>
    <script>location.replace('shoppingcart.php')</script>
    <?php
    
}

?>

<?php
$emailid = $_SESSION['email'];
$prodtype = $_GET['product'];
if(isset($_GET['range'])){
    $minval			=	$_POST['minval'];
    $maxval			=	$_POST['maxval'];
    $query="SELECT * FROM $prodtype WHERE prodnewprice BETWEEN $minval AND $maxval AND issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='$prodtype')";
}
else if(isset($_GET['quality'])){
    $condition			=	$_POST['myfilter_radio'];
    if($condition!=null)
        $query="SELECT * FROM $prodtype WHERE prodcondition='$condition' AND issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='$prodtype')";
    else
        $query="SELECT * FROM $prodtype WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='$prodtype')"; 
}
else{
    $search			=	$_POST['search'];
    if($search=='recent')
        $query="SELECT * FROM $prodtype WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='$prodtype') ORDER BY prodid DESC";
    else if($search=='cheap')
        $query="SELECT * FROM $prodtype WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='$prodtype') ORDER BY prodnewprice ASC";
    else
        $query="SELECT * FROM $prodtype WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='$prodtype') ORDER BY prodnewprice DESC"; 
}
$query_run =mysqli_query($con, $query);

if(!$query_run)
	die("Unable to connect to database".mysqli_error($con));

$number=mysqli_num_rows($query_run);
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
	    <li class="breadcrumb-item active" aria-current="page"><?php echo $prodtype;?></li>
	</ol>  
	</nav>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
<main class="col-md-12">
<?php if(isset($_POST['products'])){?>
<header class="border-bottom mb-4 pb-3">
		<div class="form-inline">
			<span class="mr-md-auto"><?php echo $number;?> Items found </span>
			<!-- <select class="mr-2 form-control">
				<option>Latest items</option>
				<option>Trending</option>
				<option>Most Popular</option>
				<option>Cheapest</option>
			</select>
			<div class="btn-group">
				<a href="products.php?product=<?php echo $prodtype;?>" class="btn btn-outline-secondary active" data-toggle="tooltip" title="List view"> 
					<i class="fa fa-bars"></i></a>
				<a href="gridproducts.php?product=<?php echo $prodtype;?>" class="btn  btn-outline-secondary" data-toggle="tooltip" title="Grid view"> 
					<i class="fa fa-th"></i></a>
			</div> -->
		</div>
</header><!-- sect-heading -->
<?php 
for($i=1;$i<=$number;$i++)
		{
$result = mysqli_fetch_array($query_run);
?>
<article class="card card-product-list">
	<div class="row no-gutters">
		<aside class="col-md-3">
			<a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>" class="img-wrap">
				<!-- <span class="badge badge-danger"> NEW </span> -->
				<?php echo '<img src="productpics/'.$result['prodpic'].'">' ;?>
			</a>
		</aside>
		<div class="col-md-6">
			<div class="info-main">
				<a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>" class="h5 title"><?php echo $result['prodname'];?></a>
          <!-- rating-wrap.// -->
				
				<p> <?php echo $result['proddesc'];?></a></p>
			</div> <!-- info-main.// -->
		</div> <!-- col.// -->
		<aside class="col-sm-3">
			<div class="info-aside">
				<div class="price-wrap">
					<span class="price h5">₹ <?php echo $result['prodnewprice'];?></span>	
					<del class="price-old">₹ <?php echo $result['prodoldprice'];?></del>
				</div> <!-- info-price-detail // -->
				<!-- <p class="text-success">Free shipping</p> -->
				<br>
				<p>
					<a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>" class="btn btn-primary btn-block"> Details </a>
                    <a href="showproducts.php?product=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>" class="btn btn-sm btn-block btn-outline-primary">Add to cart <i class="fa fa-shopping-cart"></i></a>
                    <!-- <a href="" class="btn btn-light btn-block"><i class="fa fa-heart"></i> 
						<span class="text">Add to wishlist</span>
					</a> -->
				</p>
			</div> <!-- info-aside.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</article> <!-- card-product .// -->
		<?php
 }	}
 else if(isset($_POST['gridproducts'])){?>
 <header class="border-bottom mb-4 pb-3">
		<div class="form-inline">
			<span class="mr-md-auto"><?php echo $number;?> Items found </span>
			<!-- <select class="mr-2 form-control">
				<option>Latest items</option>
				<option>Trending</option>
				<option>Most Popular</option>
				<option>Cheapest</option>
			</select>
			<div class="btn-group">
				<a href="products.php?product=<?php echo $prodtype;?>" class="btn btn-outline-secondary active" data-toggle="tooltip" title="List view"> 
					<i class="fa fa-bars"></i></a>
				<a href="gridproducts.php?product=<?php echo $prodtype;?>" class="btn  btn-outline-secondary" data-toggle="tooltip" title="Grid view"> 
					<i class="fa fa-th"></i></a>
			</div> -->
		</div>
</header><!-- sect-heading -->
<div class="row">
<?php 
for($i=1;$i<=$number;$i++)
		{
$result = mysqli_fetch_array($query_run);
?>
	<div class="col-md-3">
		<figure class="card card-product-grid">
			<div class="img-wrap"> 
				<!-- <span class="badge badge-danger"> NEW </span> -->
				<a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>"><?php echo '<img src="productpics/'.$result['prodpic'].'">' ;?></a>
				<a class="btn-overlay" href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>"><i class="fa fa-search-plus"></i> Quick view</a>
			</div> <!-- img-wrap.// -->
			<figcaption class="info-wrap">
				<div class="fix-height">
					<a href="buyproduct.php?prodtype=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>" class="title"><?php echo $result['prodname'];?></a>
					<div class="price-wrap mt-2">
						<span class="price h5">₹ <?php echo $result['prodnewprice'];?></span>	
						<del class="price-old">₹ <?php echo $result['prodoldprice'];?></del>
					</div> <!-- price-wrap.// -->
				</div>
				<a href="showproducts.php?product=<?php echo $prodtype;?>&prodid=<?php echo $result['prodid'];?>" class="btn btn-block btn-primary">Add to cart </a>
			</figcaption>
		</figure>
	</div> <!-- col.// -->
	<?php
 }	}?>
</div> <!-- row end.// -->
</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<?php include 'footer.php'?>