<?php include 'header.php'?>

<?php 
if(!isset($_SESSION['email']))
  header('location:login.php');
	$emailid           =    $_SESSION['email'];
	$prodtype          =    $_GET['prodtype'];
	$q="SELECT * FROM $prodtype WHERE prodseller='$emailid' ORDER BY prodid DESC";
	$q_run =mysqli_query($con, $q);

	if(!$q_run)
		die("Unable to connect to database".mysqli_error($con));

    $result = mysqli_fetch_array($q_run);
	$prodid = $result['prodid'];

// echo $prodtype,$prodid ; 
/**
* import checksum generation utility
* You can get this utility from https://developer.paytm.com/docs/checksum/
*/
require_once("encdec_paytm.php");
/* initialize an array with request parameters */
$paytmParams = array(
    
	/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	"MID" => "chpSXJ34530780696347",
    
	/* Find your WEBSITE in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	"WEBSITE" => "WEBSTAGING",
    
	/* Find your INDUSTRY_TYPE_ID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	"INDUSTRY_TYPE_ID" => "Retail",
    
	/* WEB for website and WAP for Mobile-websites or App */
	"CHANNEL_ID" => "WEB",
    
	/* Enter your unique order id */
	"ORDER_ID" => $emailid.'-'.$prodtype.'-'.$prodid,
    
	/* unique id that belongs to your customer */
	"CUST_ID" => $emailid,
    
	/* customer's mobile number */
	// "MOBILE_NO" => "CUSTOMER_MOBILE_NUMBER",
    
	/* customer's email */
	"EMAIL" => $emailid,
    
	/**
	* Amount in INR that is payble by customer
	* this should be numeric with optionally having two decimal points
	*/
	"TXN_AMOUNT" => 100,
    
	/* on completion of transaction, we will send you the response on this URL */
	"CALLBACK_URL" => "http://localhost/PDE/trial.php",
);

/**
* Generate checksum for parameters we have
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$checksum = getChecksumFromArray($paytmParams, "O9s!%PS!cEfyCqxX");

/* for Staging */
$url = "https://securegw-stage.paytm.in/order/process";

/* for Production */
// $url = "https://securegw.paytm.in/order/process";

/* Prepare HTML Form and Submit to Paytm */
?>
<html>
	<head>
		<title>Merchant Checkout Page</title>
	</head>
	<body>
		<center><h1>Please do not refresh this page...</h1></center>
		<form method='post' action='<?php echo $url; ?>' name='paytm_form'>
				<?php
					foreach($paytmParams as $name => $value) {
						echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
					}
				?>
				<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checksum ?>">
		</form>
		<script type="text/javascript">
			document.paytm_form.submit();
		</script>
	</body>
</html>