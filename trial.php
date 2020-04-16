<?php include 'session.php' ?>
<?php
/**
* import checksum generation utility
*/
require_once("encdec_paytm.php");

$paytmChecksum = "";

/* Create a Dictionary from the parameters received in POST */
$paytmParams = array();
foreach($_POST as $key => $value){
	if($key == "CHECKSUMHASH"){
		$paytmChecksum = $value;
	} else {
		$paytmParams[$key] = $value;
	}
}

/**
* Verify checksum
* Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
*/
$isValidChecksum = verifychecksum_e($paytmParams, "O9s!%PS!cEfyCqxX", $paytmChecksum);
if($isValidChecksum == "TRUE") {
    if (isset($_POST) && count($_POST)>0 )
	{ 
        $ORDERID = $_POST["ORDERID"];
        $product = explode("-",$ORDERID);
        $prodseller = $product[0];
        $prodtype = $product[1];
        $prodid = $product[2];

        $query = "UPDATE $prodtype SET prodadd='1' where prodseller='$prodseller' AND prodid='$prodid'";
        $query_run = mysqli_query($con, $query);

		header('location:homepage.php');
	}

} else {
	echo "Checksum Mismatched";
}
?>