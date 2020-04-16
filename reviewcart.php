<?php include 'header.php'?>

<?php
if(!isset($_SESSION['email']))
  header('location:login.php');
  ?>

<?php
$emailid = $_SESSION['email'];

$q="SELECT * FROM mycart WHERE personname='$emailid'";
$q_run =mysqli_query($con, $q);

if(!$q_run)
	die("Unable to connect to database".mysqli_error($con));

$num=mysqli_num_rows($q_run);
?>

<section class="section-conten padding-y" style="min-height:84vh">

<!-- ============================ COMPONENT LOGIN   ================================= -->
	<div class="card mx-auto" style="max-width: 780px; margin-top:100px; margin-bottom:100px;">
		<output>
		<div class="card">
			<article class="card-body">
				<header class="mb-4">
					<h4 class="card-title">Review cart</h4>
				</header>
					<div class="row">
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
						<div class="col-md-6">
							<figure class="itemside  mb-3">
								<div class="aside"><?php echo '<img class="border img-xs" src="productpics/'.$result['prodpic'].'">' ;?></div>
								<figcaption class="info">
									<p><?php echo $result['prodname'];?></p>
									<span> Total: ₹ <?php echo $result['prodnewprice'];?> </span>
								</figcaption>
							</figure>
						</div> <!-- col.// -->
					<?php } ?>
					</div> <!-- row.// -->
			</article> <!-- card-body.// -->
			<article class="card-body border-top">

				<dl class="row">
				  <dt class="col-sm-10">Subtotal: <span class="float-right text-muted"><?php echo $num;?> items</span></dt>
				  <dd class="col-sm-2 text-right"><strong>₹ <?php echo $totaloldprice;?></strong></dd>

				  <dt class="col-sm-10">Discount: <span class="float-right text-muted"><?php echo ceil(($totaloldprice-$totalnewprice)*100/$totaloldprice);?>% offer</span></dt>
				  <dd class="col-sm-2 text-danger text-right"><strong>₹ <?php echo $totaloldprice-$totalnewprice;?></strong></dd>

				  <dt class="col-sm-10">Total: </dt>
				  <dd class="col-sm-2 text-right text-success"><strong>₹ <?php echo $totalnewprice;?></strong></dd>
                </dl>
                <a href="chat.php" class="btn  btn-primary"> Chat now </a>
			</article> <!-- card-body.// -->
		</div>	
		</output>
</div>
</session>

<?php include 'footer.php'?>