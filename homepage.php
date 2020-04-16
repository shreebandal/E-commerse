<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>
<?php
$emailid=$_SESSION['email'];

$product=array('instruments','vehicals','electronics','books','fitness','clothing','fashionables','other');

$query1 =mysqli_query($con, "SELECT * FROM instruments WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='instruments')");
$query2 =mysqli_query($con, "SELECT * FROM vehicals WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='vehicals')");
$query3 =mysqli_query($con, "SELECT * FROM electronics WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='electronics')");
$query4 =mysqli_query($con, "SELECT * FROM books WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='books')");
$query5 =mysqli_query($con, "SELECT * FROM fitness WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='fitness')");
$query6 =mysqli_query($con, "SELECT * FROM clothing WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='clothing')");
$query7 =mysqli_query($con, "SELECT * FROM fashionables WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='fashionables')");
$query8 =mysqli_query($con, "SELECT * FROM other WHERE issold=0 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='other')");

$q1 =mysqli_query($con, "SELECT * FROM instruments WHERE issold=0 AND prodadd=1 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='instruments')");
$q2 =mysqli_query($con, "SELECT * FROM vehicals WHERE issold=0 AND prodadd=1 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='vehicals')");
$q3 =mysqli_query($con, "SELECT * FROM electronics WHERE issold=0 AND prodadd=1 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='electronics')");
$q4 =mysqli_query($con, "SELECT * FROM books WHERE issold=0 AND prodadd=1 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='books')");
$q5 =mysqli_query($con, "SELECT * FROM fitness WHERE issold=0 AND prodadd=1 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='fitness')");
$q6 =mysqli_query($con, "SELECT * FROM clothing WHERE issold=0 AND prodadd=1 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='clothing')");
$q7 =mysqli_query($con, "SELECT * FROM fashionables WHERE issold=0 AND prodadd=1 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='fashionables')");
$q8 =mysqli_query($con, "SELECT * FROM other WHERE issold=0 AND prodadd=1 AND prodid NOT IN (SELECT productname FROM mycart WHERE producttype='other')");
?>

<?php
if(isset($_GET['prodid'])){
	$prodid = $_GET['prodid'];
	$prodtype = $_GET['prodtype'];

	$query = "INSERT INTO mycart (personname,producttype,productname,uniquecart) VALUES('$emailid','$prodtype','$prodid','$emailid$prodtype$prodid')";
	$query_run = mysqli_query($con, $query);
	
	// header('location:homepage.php');
	?>
    <script>location.replace('homepage.php')</script>
    <?php
}

?>
<title>HomePage</title>
</head>

<body>
<nav class="navbar navbar-main navbar-expand-lg navbar-light">
  <div class="container">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav">
      	<li class="nav-item dropdown">
          <a class="nav-link pl-0" data-toggle="dropdown" href="#"><strong> <i class="fa fa-bars"></i> &nbsp  All category</strong></a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="products.php?product=food&t=1">Hotel Foods</a>
			<a class="dropdown-item" href="products.php?product=water&t=1">Water can</a>
			<a class="dropdown-item" href="products.php?product=biryani&t=1">Biryani</a>
			<a class="dropdown-item" href="products.php?product=cake&t=1">Cake</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="products.php?product=books&t=1">Books and Notes</a>
			<a class="dropdown-item" href="products.php?product=instruments&t=1">College Instruments</a>
			<a class="dropdown-item" href="products.php?product=fashionables&t=1">Fashionables</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php?product=instruments&t=1">College Instruments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php?product=vehicals&t=1">Vehicals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php?product=electronics&t=1">Electronics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php?product=books&t=1">Books &amp Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php?product=fitness&t=1">Fitness sport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php?product=clothing&t=1">Clothing</a>
		</li>
		<li class="nav-item">
          <a class="nav-link" href="products.php?product=fashionables&t=1">Fashionables</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="products.php?product=other&t=1">Others</a>
        </li>
      </ul>
    </div> <!-- collapse .// -->
  </div> <!-- container .// -->
</nav>

</header> <!-- section-header.// -->



<!-- ========================= SECTION INTRO ========================= -->
<section class="section-intro">

<div class="intro-banner-wrap">
	<img src="images/banner.jpg" class="w-100 img-fluid">
</div>

</section>
<!-- ========================= SECTION INTRO END// ========================= -->


<!-- ========================= SECTION SPECIAL ========================= -->
<section class="section-specials padding-y border-bottom">
<div class="container">	
<div class="row">
<div class="col-md-4">	
			<figure class="itemside">
				<div class="aside">
					<span class="icon-sm rounded-circle bg-primary">
						<i class="fa fa-money-bill-alt white"></i>
					</span>
				</div>
				<figcaption class="info">
					<h6 class="title">Reasonable prices</h6>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labor </p>
				</figcaption>
			</figure> <!-- iconbox // -->
	</div><!-- col // -->
	<div class="col-md-4">
			<figure class="itemside">
				<div class="aside">
					<span class="icon-sm rounded-circle bg-danger">
						<i class="fa fa-comment-dots white"></i>
					</span>
				</div>
				<figcaption class="info">
					<h6 class="title">Customer support 24/7 </h6>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labor </p>
				</figcaption>
			</figure> <!-- iconbox // -->
	</div><!-- col // -->
	<div class="col-md-4">
			<figure class="itemside">
				<div class="aside">
					<span class="icon-sm rounded-circle bg-success">
						<i class="fa fa-comment-dots white fa-lock"></i></span>
					</span>
				</div>
				<figcaption class="info" class="pt-3">
					<h6 class="title">High secured </h6>
					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labor </p>
				</figcaption>
			</figure> <!-- iconbox // -->
	</div><!-- col // -->
</div> <!-- row.// -->

</div> <!-- container.// -->
</section>
<!-- ========================= SECTION SPECIAL END// ========================= -->




<!-- ========================= SECTION  ========================= -->
<section class="section-name  padding-y-sm">
<div class="container">

<header class="section-heading">
	<!-- <a href="#" class="btn btn-outline-primary float-right">See all</a> -->
	<h3 class="section-title">Popular products</h3>
</header><!-- sect-heading -->

	
<div class="row">
<?php 
$num1 = mysqli_num_rows($q1);
$result1 = mysqli_fetch_array($query1);
if($num1>0){
	for($i=1;$i<=$num1;$i++)
	{
		$results1 = mysqli_fetch_array($q1);
?>
<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results1['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results1['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$results1['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results1['prodid'];?>" class="title"><?php echo $results1['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $results1['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $results1['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $results1['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
	}
}
// $temp1 = mt_rand(1, $num1);
// $query_run1 =mysqli_query($con, "SELECT * FROM instruments WHERE prodid='$temp1'");
else if($result1){
?>
	<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $result1['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $result1['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$result1['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $result1['prodid'];?>" class="title"><?php echo $result1['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $result1['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $result1['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $result1['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php 
}
$num2 = mysqli_num_rows($q2);
$result2 = mysqli_fetch_array($query2);
if($num2>0){
	for($i=1;$i<=$num2;$i++)
	{
		$results2 = mysqli_fetch_array($q2);
?>
<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results2['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results2['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$results2['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results2['prodid'];?>" class="title"><?php echo $results2['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $results2['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $results2['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $results2['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
	}
}
// $temp2 = mt_rand(1, $num2);
// $query_run2 =mysqli_query($con, "SELECT * FROM vehicals WHERE prodid='$temp2'");
else if($result2){
?>
	<div class="col-md-3">
		<div href="buyproduct.php?prodtype=vehicals&prodid=<?php echo $result2['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=vehicals&prodid=<?php echo $result2['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$result2['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=vehicals&prodid=<?php echo $result2['prodid'];?>" class="title"><?php echo $result2['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $result2['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $result2['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=vehicals&prodid=<?php echo $result2['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
} 
$num3 = mysqli_num_rows($q3);
$result3 = mysqli_fetch_array($query3);
if($num3>0){
	for($i=1;$i<=$num3;$i++)
	{
		$results3 = mysqli_fetch_array($q3);
?>
<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results3['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results3['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$results3['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results3['prodid'];?>" class="title"><?php echo $results3['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $results3['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $results3['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $results3['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
	}
}
// $temp3 = mt_rand(1, $num3);
// $query_run3 =mysqli_query($con, "SELECT * FROM electronics WHERE prodid='$temp3'");
else if($result3){
?>
	<div class="col-md-3">
		<div href="buyproduct.php?prodtype=electronics&prodid=<?php echo $result3['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=electronics&prodid=<?php echo $result3['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$result3['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=electronics&prodid=<?php echo $result3['prodid'];?>" class="title"><?php echo $result3['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $result3['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $result3['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=electronics&prodid=<?php echo $result3['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php 
}
$num4 = mysqli_num_rows($q4);
$result4 = mysqli_fetch_array($query4);
if($num4>0){
	for($i=1;$i<=$num4;$i++)
	{
		$results4 = mysqli_fetch_array($q4);
?>
<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results4['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results4['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$results4['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results4['prodid'];?>" class="title"><?php echo $results4['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $results4['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $results4['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $results4['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
	}
}
// $temp4 = mt_rand(1, $num4);
// $query_run4 =mysqli_query($con, "SELECT * FROM books WHERE prodid='$temp4'");
else if($result4){
?>
	<div class="col-md-3">
		<div href="buyproduct.php?prodtype=books&prodid=<?php echo $result4['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=books&prodid=<?php echo $result4['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$result4['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=books&prodid=<?php echo $result4['prodid'];?>" class="title"><?php echo $result4['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $result4['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $result4['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=books&prodid=<?php echo $result4['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
} 
$num5 = mysqli_num_rows($q5);
$result5 = mysqli_fetch_array($query5);
if($num5>0){
	for($i=1;$i<=$num5;$i++)
	{
		$results5 = mysqli_fetch_array($q5);
?>
<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results5['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results5['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$results5['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results5['prodid'];?>" class="title"><?php echo $results5['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $results5['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $results5['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $results5['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
	}
}
// $temp5 = mt_rand(1, $num5);
// $query_run5 =mysqli_query($con, "SELECT * FROM fitness WHERE prodid='$temp5'");
else if($result5){
?>
	<div class="col-md-3">
		<div href="buyproduct.php?prodtype=fitness&prodid=<?php echo $result5['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=fitness&prodid=<?php echo $result5['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$result5['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=fitness&prodid=<?php echo $result5['prodid'];?>" class="title"><?php echo $result5['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $result5['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $result5['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=fitness&prodid=<?php echo $result5['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php 
}
$num6 = mysqli_num_rows($q6);
$result6 = mysqli_fetch_array($query6);
if($num6>0){
	for($i=1;$i<=$num6;$i++)
	{
		$results6 = mysqli_fetch_array($q6);
?>
<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results6['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results6['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$results6['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results6['prodid'];?>" class="title"><?php echo $results6['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $results6['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $results6['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $results6['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
	}
}
// $temp6 = mt_rand(1, $num6);
// $query_run6 =mysqli_query($con, "SELECT * FROM clothing WHERE prodid='$temp6'");
else if($result6){
?>
	<div class="col-md-3">
		<div href="buyproduct.php?prodtype=clothing&prodid=<?php echo $result6['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=clothing&prodid=<?php echo $result6['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$result6['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=clothing&prodid=<?php echo $result6['prodid'];?>" class="title"><?php echo $result6['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $result6['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $result6['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=clothing&prodid=<?php echo $result6['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php 
}
$num7 = mysqli_num_rows($q7);
$result7 = mysqli_fetch_array($query7);
if($num7>0){
	for($i=1;$i<=$num7;$i++)
	{
		$results7 = mysqli_fetch_array($q7);
?>
<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results7['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results7['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$results7['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results7['prodid'];?>" class="title"><?php echo $results7['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $results7['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $results7['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $results7['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
	}
}
// $temp7 = mt_rand(1, $num7);
// $query_run7 =mysqli_query($con, "SELECT * FROM fashionables WHERE prodid='$temp7'");
else if($result7){
?>
	<div class="col-md-3">
		<div href="buyproduct.php?prodtype=fashionables&prodid=<?php echo $result7['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=fashionables&prodid=<?php echo $result7['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$result7['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=fashionables&prodid=<?php echo $result7['prodid'];?>" class="title"><?php echo $result7['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $result7['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $result7['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=fashionables&prodid=<?php echo $result7['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php 
}
$num8 = mysqli_num_rows($q8);
$result8 = mysqli_fetch_array($query8);
if($num8>0){
	for($i=1;$i<=$num8;$i++)
	{
		$results8 = mysqli_fetch_array($q8);
?>
<div class="col-md-3">
		<div href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results8['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results8['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$results8['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=instruments&prodid=<?php echo $results8['prodid'];?>" class="title"><?php echo $results8['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $results8['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $results8['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=instruments&prodid=<?php echo $results8['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->

<?php
	}
}
// $temp8 = mt_rand(1, $num8);
// $query_run8 =mysqli_query($con, "SELECT * FROM other WHERE prodid='$temp8'");
else if($result8){
?>
	<div class="col-md-3">
		<div href="buyproduct.php?prodtype=other&prodid=<?php echo $result8['prodid'];?>" class="card card-product-grid">
			<a href="buyproduct.php?prodtype=other&prodid=<?php echo $result8['prodid'];?>" class="img-wrap"><?php echo '<img src="productpics/'.$result8['prodpic'].'">' ;?> </a>
			<figcaption class="info-wrap">
				<a href="buyproduct.php?prodtype=other&prodid=<?php echo $result8['prodid'];?>" class="title"><?php echo $result8['prodname'];?></a>
				<div class="price mt-1"><del class="price-old">₹ <?php echo $result8['prodoldprice'];?></del></div>
				<div class="price mt-1 ml-1">₹ <?php echo $result8['prodnewprice'];?></div> <!-- price-wrap.// -->
				<a href="homepage.php?prodtype=other&prodid=<?php echo $result8['prodid'];?>" class="btn btn-sm btn-outline-primary float-right">Add to cart <i class="fa fa-shopping-cart"></i></a>
			</figcaption>
		</div>
	</div> <!-- col.// -->
<?php } ?>
</div> <!-- row.// -->

</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->


<?php include 'footer.php'?>