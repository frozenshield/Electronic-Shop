<?php include "include/ulo.php" ?>
<?php include "include/header.php" ?>
<?php include "dbcon.php" ?>

<?php

	if(isset($_GET['category']))
			{
				$category = $_GET['category'];
				$items = $conn->prepare("SELECT * FROM products WHERE category = :category ");
				$items->execute([
					
					':category' => $category
				]); 

				$product = $items->fetchAll(PDO::FETCH_OBJ);

				
				$quantity = $conn->prepare("SELECT category, COUNT(*) AS total_quantity FROM products
										    GROUP BY category ORDER BY category");
				$quantity->execute();

				$tots = $quantity->fetchAll(PDO::FETCH_ASSOC);

				$checkbox = $conn->prepare("SELECT * FROM products ORDER BY RAND()");
				$checkbox->execute();

				$box = $checkbox->fetchAll(PDO::FETCH_OBJ);

				 // Fetch all products where status = 1
				 $show = $conn->prepare("SELECT * FROM products WHERE status = 1 ORDER BY RAND()");
				 $show->execute();
				 $products = $show->fetchAll(PDO::FETCH_OBJ); // Same variable name for consistency
				
			}

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
						<li><a href="store.php?category=tablet">Tablets</a></li>
						<li><a href="store.php?category=laptop">Laptops</a></li>
						<li><a href="store.php?category=smartphone">Smartphones</a></li>
						<li><a href="store.php?category=camera">Cameras</a></li>
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
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li class="active">#</li>
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
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Brand</h3>
							<div class="checkbox-filter">
								<div class="input-checkbox">
									<input type="checkbox" id="brand-1">
									<label for="brand-1">
										<span></span>
										SAMSUNG
										<small>(578)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-2">
									<label for="brand-2">
										<span></span>
										LG
										<small>(125)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-3">
									<label for="brand-3">
										<span></span>
										SONY
										<small>(755)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-4">
									<label for="brand-4">
										<span></span>
										SAMSUNG
										<small>(578)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-5">
									<label for="brand-5">
										<span></span>
										LG
										<small>(125)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" id="brand-6">
									<label for="brand-6">
										<span></span>
										SONY
										<small>(755)</small>
									</label>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
					
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							<?php 
								// Limit the number of top-selling products to 3
								$topSelling = array_slice($box, 0, 3); 
								foreach($topSelling as $lot) : 
							?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/<?php echo $lot->product_img ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="product.php?product_id=<?php echo $lot->product_id ?>"><?php echo $lot->product_name ?></a></h3>
										<h4 class="product-price">PhP<?php echo number_format($lot->price, 2) ?> <del class="product-old-price">$990.00</del></h4>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

							<div class="row">
							<!-- product -->
							<!-- Product Loop -->
							<?php if (!empty($product)) : ?>
								<?php foreach ($product as $p) : ?>
								
									<div class="col-md-4 col-xs-6">
										<div class="product" data-category="<?php echo htmlspecialchars($p->category); ?>">
											<div class="product-img">
												<img src="./img/<?php echo htmlspecialchars($p->product_img); ?>" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo htmlspecialchars($p->category); ?></p>
												<h3 class="product-name">
													<a href="product.php?product_id=<?php echo htmlspecialchars($p->product_id); ?>">
														<?php echo htmlspecialchars($p->product_name); ?>
													</a>
												</h3>
												<h4 class="product-price">
													PhP<?php echo number_format($p->price, 2); ?>
													<del class="product-old-price">
														PhP<?php echo number_format($p->price + ($p->price * 0.30), 2); ?>
													</del>
												</h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<form method="POST" action="add-to-wishlist.php">
													<div class="product-btns">
														<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
														<input type="hidden" name="product_id" value="<?php echo htmlspecialchars($p->product_id); ?>">
														<button class="add-to-wishlist">
															<i class="fa fa-heart-o"></i>
															<span class="tooltipp">add to wishlist</span>
														</button>
														<button class="quick-view">
															<i class="fa fa-eye"></i>
															<span class="tooltipp">quick view</span>
														</button>
													</div>
												</form>
											</div>
											<form method="POST" action="add-to-cart.php">
												<div class="add-to-cart">
													<input type="hidden" name="product_id" value="<?php echo htmlspecialchars($p->product_id); ?>">
													<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
													<button class="add-to-cart-btn" name="addcart">
														<i class="fa fa-shopping-cart"></i> add to cart
													</button>
												</div>
											</form>
										</div>
									</div>
								<?php endforeach; ?>
							<?php else : ?>
								<?php 
									$tots = array_slice($products, 0, 9);
									foreach ($tots as $c) : ?>
									
									<div class="col-md-4 col-xs-6">
										<div class="product" data-category="<?php echo htmlspecialchars($c->category); ?>">
											<div class="product-img">
												<img src="./img/<?php echo htmlspecialchars($c->product_img); ?>" alt="">
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category"><?php echo htmlspecialchars($c->category); ?></p>
												<h3 class="product-name">
													<a href="product.php?product_id=<?php echo htmlspecialchars($c->product_id); ?>">
														<?php echo htmlspecialchars($c->product_name); ?>
													</a>
												</h3>
												<h4 class="product-price">
													PhP<?php echo number_format($c->price, 2); ?>
													<del class="product-old-price">
														PhP<?php echo number_format($c->price + ($c->price * 0.30), 2); ?>
													</del>
												</h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<form method="POST" action="add-to-wishlist.php">
													<div class="product-btns">
														<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
														<input type="hidden" name="product_id" value="<?php echo htmlspecialchars($c->product_id); ?>">
														<button class="add-to-wishlist">
															<i class="fa fa-heart-o"></i>
															<span class="tooltipp">add to wishlist</span>
														</button>
														<button class="quick-view">
															<i class="fa fa-eye"></i>
															<span class="tooltipp">quick view</span>
														</button>
													</div>
												</form>
											</div>
											<form method="POST" action="add-to-cart.php">
												<div class="add-to-cart">
													<input type="hidden" name="product_id" value="<?php echo htmlspecialchars($c->product_id); ?>">
													<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
													<button class="add-to-cart-btn" name="addcart">
														<i class="fa fa-shopping-cart"></i> add to cart
													</button>
												</div>
											</form>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
							<!-- /product -->
						</div>

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
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

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>




	</body>
</html>
