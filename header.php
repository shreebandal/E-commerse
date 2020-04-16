<?php
session_start();   
?>
<?php include 'session.php'?>

<?php
if(isset($_SESSION['email'])){
 $emailid          =    $_SESSION['email'];

 $query="SELECT * FROM mycart WHERE personname='$emailid'";
 $query_run =mysqli_query($con, $query);
 
 if(!$query_run)
	 die("Unable to connect to database".mysqli_error($con));
 
 $num = mysqli_num_rows($query_run);

//  $q = "SELECT * FROM chats WHERE isread=0 AND reciver='$emailid'";
//  $q_run =mysqli_query($con, $q);
 
//  if(!$q_run)
// 	 die("Unable to connect to database".mysqli_error($con));
 
//  $number = mysqli_num_rows($q_run);
//  $temp = 0;
//  if($number>0){
// 	$result = mysqli_fetch_array($q_run);
// 	$product = $result['product'];
// 	$arr = array($product);
// 	$temp = 1;
// 	for($i=2;$i<=$number;$i++)
// 	{
// 		$result = mysqli_fetch_array($q_run);
// 		$product = $result['product'];
// 		if (!in_array($product, $arr)){
// 			$arr[$i-1] = $product;
// 			$temp += 1;
// 		}
// 	}
// }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="max-age=604800" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/">

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href="images/aj.webp" rel="shortcut icon" type="image/x-icon">

<!-- jQuery -->
<script src="js/jquery.js" type="text/javascript"></script> 

<!-- Font awesome 5 -->
<link href="fontawesome/css/all.min.css" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<header class="section-header">
<?php if(isset($_SESSION['email'])){ ?>
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger intent="" chat-title="AJ" agent-id="73f0c5c5-cde3-4548-b2ce-5c4752a2f183" language-code="en"></df-messenger>
<?php } ?>
<section class="header-main border-bottom">
	<div class="container">
<div class="row align-items-center">
	<div class="col-lg-4 col-4">
		<a href="homepage.php" class="brand-wrap">
			<img class="logo" src="images/aj.webp"><strong style="font-size: 25px;">HomePage</strong>
		</a> <!-- brand-wrap.// -->
	</div>
	 <div class="col-lg-4 col-sm-12">
		<!--<form action="#" class="search">
			<div class="input-group w-100">
			    <input type="text" class="form-control" placeholder="Search">
			    <div class="input-group-append">
			      <button class="btn btn-primary" type="submit">
			        <i class="fa fa-search"></i>
			      </button>
			    </div>
		    </div> -->
		<!-- </form> search-wrap .end// -->
	</div> 
	<div class="col-lg-4 col-sm-6 col-12">
		<div class="widgets-wrap float-md-right">
			<div class="widget-header  mr-3">
				<a href="shoppingcart.php" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
				<?php if(isset($_SESSION['email'])){ ?>
				<span class="badge badge-pill badge-danger notify" name="cart"><?php echo $num;?></span>
				<?php } else {?>
				<span class="badge badge-pill badge-danger notify" name="cart">0</span>
				<?php } ?>
			</div>
			<div class="widget-header  mr-3">
				<a href="chat.php" class="icon icon-sm rounded-circle border"><i class="fa fa-comment-dots"></i></a>
				<!-- <?php if(isset($_SESSION['email'])){ ?>
				<span class="badge badge-pill badge-danger notify" name="cart"><?php echo $temp;?></span>
				<?php } else {?>
				<span class="badge badge-pill badge-danger notify" name="cart">0</span>
				<?php } ?> -->
			</div>
			<div class="widget-header icontext">
				<?php if(!isset($_SESSION['email'])){ ?>
					<a href="profile.php" class="icon icon-sm rounded-circle border">
					<i class="fa fa-user"></i></a>
				<?php } 
				else{
					?>
					<a href="profile.php">
					<?php
						$email = $_SESSION['email'];

						$q="SELECT * FROM customer WHERE email='$email' ";
						$q_run =mysqli_query($con, $q);

						if(!$q_run)
							die("Unable to connect to database".mysqli_error($con));

						$result = mysqli_fetch_array($q_run);

						if($result['picture']==null)
							echo '<img class="rounded-circle icon img-xs border" src="'.$result['pic'].'">' ;
						else
							echo '<img class="rounded-circle icon img-xs border" src="profilepics/'.$result['picture'].'">' ;
				}
				?></a>
				</div>
				<div class="widget-header">
				<div class="text">
					<span class="text-muted">Welcome! </span>
					<div> 
					<?php if(isset($_SESSION['email'])){?>
						<a href="logout.php">logout</a>
							<ul class="navbar-nav">
								<li class="nav-item dropdown">
								<a class="nav-link pl-0" data-toggle="dropdown" href="#"><strong> <i class="fas fa-camera"></i> &nbsp  SELL</strong></a>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="sellproduct.php?product=instruments">College Instruments</a>
									<a class="dropdown-item" href="sellproduct.php?product=vehicals">Vehicals</a>
									<a class="dropdown-item" href="sellproduct.php?product=electronics">Electronics</a>
									<a class="dropdown-item" href="sellproduct.php?product=books">Books &amp Notes</a>
									<a class="dropdown-item" href="sellproduct.php?product=fitness">Fitness sport</a>
									<a class="dropdown-item" href="sellproduct.php?product=clothing">Clothing</a>
									<a class="dropdown-item" href="sellproduct.php?product=fashionables">Fashionables</a>
									<a class="dropdown-item" href="sellproduct.php?product=other">other</a>
								</div>
								</li>
							</ul>
					<?php } else {?>
						<a href="login.php">Sign in</a> |  
						<a href="register.php"> Register</a>
						<?php } ?>
					</div>
				</div>
			</div>

		</div> <!-- widgets-wrap.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->
	</div> <!-- container.// -->
</section> <!-- header-main .// -->
</header> <!-- section-header.// -->
