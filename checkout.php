<?php include "include/ulo.php" ?>
<?php include "include/header.php" ?>
<?php include "dbcon.php" ?>


<?php
	//query the details of the user from billing

	$query = $conn->prepare("SELECT * FROM billing WHERE user_id = :user_id ");
	$query->execute([

		':user_id' => $user_id

	]);

	$billinginfo = $query->fetch(PDO::FETCH_OBJ);

	// Query to check if billing data exists for the user
	$bill = $conn->prepare("SELECT COUNT(*) FROM billing WHERE user_id = :user_id ");
	$bill->execute([
		
		  ':user_id' => $user_id]);

	$billing_exists = $bill->fetchColumn() > 0;


?>
		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						<li><a href="store.php?category=hotdeal">Hot Deals</a></li>
						<li><a href="store.php?category=console">Consoles</a></li>
						<li><a href="store.php?category=laptop">Laptops</a></li>
						<li><a href="store.php?category=smartphone">Smartphones</a></li>
						<li><a href="store.php?category=camera">Cameras</a></li>
						<li><a href="store.php?category=headphone">Headphones</a></li>
						<li><a href="store.php?category=accessory">Accessories</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">Checkout</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing address</h3>
							</div>
							<form method="POST" action="add-to-billing.php" id="billingForm">
								<?php if (!$billing_exists): ?>
									<!-- Input fields for adding new billing details -->
									<input class="hidden" type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
									<div class="form-group">
										<input class="input" type="text" name="fname" placeholder="First Name" required>
									</div>
									<div class="form-group">
										<input class="input" type="text" name="lname" placeholder="Last Name" required>
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address" required>
									</div>
									<div class="form-group">
										<input class="input" type="number" name="zipcode" placeholder="Zip Code" required>
									</div>
									<div class="form-group">
										<input class="input" type="number" name="phone" placeholder="Mobile Phone" required>
									</div>
									<button name="addbilling" class="primary-btn order-submit">Save</button>
								<?php else: ?>
									<!-- Display saved billing details -->
									<div id="billingDetails">
										<p><strong>First Name:</strong> <span><?php echo htmlspecialchars($billinginfo->fname); ?></span></p>
										<p><strong>Last Name:</strong> <span><?php echo htmlspecialchars($billinginfo->lname); ?></span></p>
										<p><strong>Address:</strong> <span><?php echo htmlspecialchars($billinginfo->address); ?></span></p>
										<p><strong>Zip Code:</strong> <span><?php echo htmlspecialchars($billinginfo->zipcode); ?></span></p>
										<p><strong>Mobile Phone:</strong> <span><?php echo htmlspecialchars($billinginfo->phone); ?></span></p>
										<button type="button" id="editButton" class="primary-btn order-submit">Edit</button>
									</div>

									<!-- Editable input fields -->
									<div id="billingEdit" style="display: none;">
										<input class="hidden" type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
										<div class="form-group">
											<input class="input" type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($billinginfo->fname); ?>" required>
										</div>
										<div class="form-group">
											<input class="input" type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($billinginfo->lname); ?>" required>
										</div>
										<div class="form-group">
											<input class="input" type="text" name="address" id="address" value="<?php echo htmlspecialchars($billinginfo->address); ?>" required>
										</div>
										<div class="form-group">
											<input class="input" type="number" name="zipcode" id="zipcode" value="<?php echo htmlspecialchars($billinginfo->zipcode); ?>" required>
										</div>
										<div class="form-group">
											<input class="input" type="number" name="phone" id="phone" value="<?php echo htmlspecialchars($billinginfo->phone); ?>" required>
										</div>
										<button type="submit" name="editbilling" class="primary-btn order-submit">Save</button>
									</div>
								<?php endif; ?>
							</form>

							<script>
								const editButton = document.getElementById('editButton');
								const billingDetails = document.getElementById('billingDetails');
								const billingEdit = document.getElementById('billingEdit');

								// Show input fields for editing
								editButton.addEventListener('click', () => {
									billingDetails.style.display = 'none';
									billingEdit.style.display = 'block';
								});
							</script>

								</form>			
							
						</div>
				

						
					</div>

					<!-- Order Details -->
					 
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<form method="POST" action="add-to-order.php"> 
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<?php foreach($product as $c) : ?>
							<div class="order-products">
								<div class="order-col">
									<input class="hidden" type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
									<div><?php echo $c->cart_qty ?>x  <?php echo $c->product_name ?></div>
									<div>PhP <?php echo number_format($c->price,2) ?></div>
								</div>
							</div>
							<?php endforeach; ?>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">PhP<?= number_format($totalamount, 2) ?></strong></div>
							</div>
						</div>
						
						<div class="payment-method">
							
							<div class="input-radio">
								<input type="radio" name="payment_method" id="payment-3" value="paypal">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms" required>
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<button name="addorder" class="primary-btn order-submit">Place order</a>
					</div>
					</form>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

<?php include "include/footer.php" ?>