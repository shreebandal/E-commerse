<?php if(!isset($_SESSION['email'])){?>
<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top padding-y">
	<div class="container">
		<p class="float-md-right"> 
			&copy Copyright 2020 All rights reserved to Code Alliance
		</p>
		<p>
			<a href="conditions.php">Terms and conditions</a>
		</p>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->
<?php } else{?>
<!-- ========================= FOOTER ========================= -->
<footer class="section-footer border-top">
	<div class="container">
		<section class="footer-top padding-y">
			<div class="row">
				<aside class="col-md col-6">
					<h6 class="title">Brands</h6>
					<ul class="list-unstyled">
						<li> <a href="https://www.adidas.co.in/" target="_blank">Adidas</a></li>
						<li> <a href="https://in.puma.com/" target="_blank">Puma</a></li>
						<li> <a href="https://www.reebok.com/us" target="_blank">Reebok</a></li>
						<li> <a href="https://www.nike.com/in/" target="_blank">Nike</a></li>
					</ul>
				</aside>
				<aside class="col-md col-6">
					<h6 class="title">Help</h6>
					<ul class="list-unstyled">
						<li> <a href="conditions.php">Rules and terms</a></li>
						<li> <a href="feedback.php">Give Feedback</a></li>
					</ul>
				</aside>
				<aside class="col-md col-6">
					<h6 class="title">Account</h6>
					<ul class="list-unstyled">
						<li> <a href="profile.php"> Account Overview </a></li>
						<li> <a href="shoppingcart.php"> My Orders </a></li>
					</ul>
				</aside>
				<aside class="col-md">
					<h6 class="title">Social</h6>
					<ul class="list-unstyled">
						<li><a href="https://www.facebook.com/" target="_blank"> <i class="fab fa-facebook"></i> Facebook </a></li>
						<li><a href="https://twitter.com/login" target="_blank"> <i class="fab fa-twitter"></i> Twitter </a></li>
						<li><a href="https://www.instagram.com/?hl=en" target="_blank"> <i class="fab fa-instagram"></i> Instagram </a></li>
						<li><a href="https://www.youtube.com/" target="_blank"> <i class="fab fa-youtube"></i> Youtube </a></li>
					</ul>
				</aside>
			</div> <!-- row.// -->
		</section>	<!-- footer-top.// -->

		<section class="footer-bottom border-top row">
			<div class="col-md-2">
				<p class="text-muted"> &copy 2020 Code Alliance </p>
			</div>
			<div class="col-md-8 text-md-center">
				<span  class="px-2">shreebandal0@gmail.com</span>
				<span  class="px-2">+91 9975362433</span>
				<span  class="px-2">Dbatu Lonere</span>
			</div>
			<div class="col-md-2 text-md-right text-muted">
				<i class="fab fa-lg fa-cc-visa"></i>
				<i class="fab fa-lg fa-cc-paypal"></i>
				<i class="fab fa-lg fa-cc-mastercard"></i>
			</div>
		</section>
	</div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->
<?php } ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<!-- custom javascript -->
<script src="js/script.js" type="text/javascript"></script>

<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

}); 
// jquery end
</script>
</body>
</html>