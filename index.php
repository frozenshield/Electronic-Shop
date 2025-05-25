<?php include "include/ulo.php" ?>
<?php include "include/header.php" ?>
<?php include "dbcon.php" ?>



<?php

	$query = $conn->prepare("SELECT * FROM products WHERE status = 1 ORDER BY RAND()");
	$query->execute();

	$data = $query->fetchAll(PDO::FETCH_OBJ);
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

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop01.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Laptop<br>Collection</h3>
								<a href="store.php?category=laptop" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop03.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Accessories<br>Collection</h3>
								<a href="store.php?category=accessory" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="./img/shop02.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Cameras<br>Collection</h3>
								<a href="store.php?category=camera" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">New Products</h3>
							<div class="section-nav">
								
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<!-- product -->
										 <?php foreach($data as $product) : ?>
														<div class="product">
															<div class="product-img">
																<img src="./img/<?php echo $product->product_img ?>" alt="">
																<div class="product-label">
																	<span class="sale">-30%</span>
																	<span class="new">NEW</span>
																</div>
															</div>
															<div class="product-body">
																<p class="product-category"><?php echo $product->category ?></p>
																<h3 class="product-name"><a href="product.php?product_id=<?php echo $product->product_id ?>"><?php echo $product->product_name ?></a></h3>
																<h4 class="product-price">PhP<?php echo number_format($product->price, 2) ?> <del class="product-old-price"><?php echo number_format($product->price + ($discount = $product->price * .30), 2) ?></del></h4>
																<div class="product-rating">
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																	<i class="fa fa-star"></i>
																</div>
																<form method="POST" action="add-to-wishlist.php">
																<div class="product-btns">
																	<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
																	<input type="hidden" name="product_id" value="<?php echo $product->product_id ?>">
																	<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
													                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
																</div>
										 						</form>
															</div>
															<form method="POST" action="add-to-cart.php">
															<div class="add-to-cart">
																<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
																<input type="hidden" name="product_id" value="<?php echo $product->product_id ?>">
																<button name="addcart" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
															</div>
										 					</form>
														</div>
										<?php endforeach; ?>
	
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown" id="countdown">
                        <li>
                            <div>
                                <h3 id="days">02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3 id="hours">10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3 id="minutes">34</h3>
                                <span>Mins</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3 id="seconds">60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 30% OFF</p>
                    <a class="primary-btn cta-btn" href="#">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->



		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Top selling</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#laptop">Laptops</a></li>
									<li><a data-toggle="tab" href="#headphone">Headphones</a></li>
									<li><a data-toggle="tab" href="#console">Consoles</a></li>
									<li><a data-toggle="tab" href="#tablet">Tablets</a></li>
									<li><a data-toggle="tab" href="#smartphone">Smartphones</a></li>
									<li><a data-toggle="tab" href="#camera">Cameras</a></li>
									<li><a data-toggle="tab" href="#accessory">Accessories</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

				
					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- Dynamically generate tabs for each category -->
								<?php foreach (['laptop', 'headphone', 'console', 'tablet','smartphone', 'camera', 'accessory'] as $category): ?>
									<div id="<?php echo $category ?>" class="tab-pane fade <?php echo $category === 'laptop' ? 'in active' : '' ?>">
										<div class="products-slick" data-nav="#slick-nav-<?php echo $category ?>">
											<?php foreach ($data as $fortab): ?>
												<?php if ($fortab->category === $category): ?>
													<div class="product">
														<div class="product-img">
															<img src="./img/<?php echo $fortab->product_img ?>" alt="">
															<div class="product-label">
																<span class="sale">-30%</span>
																<span class="new">NEW</span>
															</div>
														</div>
														<div class="product-body">
															<p class="product-category"><?php echo $fortab->category ?></p>
															<h3 class="product-name"><a href="product.php?product_id=<?php echo $fortab->product_id ?>"><?php echo $fortab->product_name ?></a></h3>
															<h4 class="product-price"><?php echo number_format($fortab->price, 2) ?>
																<del class="product-old-price"><?php echo number_format($fortab->price + ($discount = $fortab->price * .30), 2) ?></del>
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
																<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
																<input type="hidden" name="product_id" value="<?php echo $fortab->product_id ?>">
																<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
																<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
															</div>
															</form>
														</div>
														<form method="POST" action="add-to-cart.php">
														<div class="add-to-cart">
															<input type="hidden" name="product_id" value="<?php echo $fortab->product_id ?>">
															<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">   
															<button class="add-to-cart-btn" name="addcart"><i class="fa fa-shopping-cart"></i> add to cart</button>
														</div>
														</form>
													</div>
												<?php endif; ?>
											<?php endforeach; ?>
										</div>
										<div id="slick-nav-<?php echo $category ?>" class="products-slick-nav"></div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
												
							

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Most Viewed Product</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							
							<div>
								<!-- product widget -->
								<?php 
								 $topSelling = array_slice($data, 0, 3);
								 foreach($topSelling as $a) : ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/<?php echo $a->product_img ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $a->category ?></p>
										<h3 class="product-name"><a href="#"><?php echo $a->product_name ?></a></h3>
										<h4 class="product-price">PhP<?php echo number_format($a->price, 2) ?> <del class="product-old-price">PhP<?php echo $a->price ?></del></h4>
									</div>
								</div>
								<?php endforeach; ?>
								<!-- /product widget -->
							</div>
								<!-- product widget -->
								

							<div>
							    <?php 
								 $topSellingg = array_slice($data, 3, 3);
								 foreach($topSellingg as $b) : ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/<?php echo $b->product_img ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $b->category ?></p>
										<h3 class="product-name"><a href="#"><?php echo $b->product_name ?></a></h3>
										<h4 class="product-price">PhP<?php echo number_format($b->price, 2) ?> <del class="product-old-price">PhP<?php echo $a->price ?></del></h4>
									</div>
								</div>
								<?php endforeach; ?>	
								<!-- /product widget -->
							</div>
						</div>
					</div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Most Buy Products</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								<!-- product widget -->
								<?php 
								 $topSelling = array_slice($data, 9, 3);
								 foreach($topSelling as $a) : ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/<?php echo $a->product_img ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $a->category ?></p>
										<h3 class="product-name"><a href="#"><?php echo $a->product_name ?></a></h3>
										<h4 class="product-price">PhP<?php echo number_format($a->price, 2) ?> <del class="product-old-price">PhP<?php echo $a->price ?></del></h4>
									</div>
								</div>
								<?php endforeach; ?>
								<!-- /product widget -->

								
							</div>

							<div>
								<!-- product widget -->
								<?php 
								 $topSellingg = array_slice($data, 12, 3);
								 foreach($topSellingg as $b) : ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/<?php echo $b->product_img ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $b->category ?></p>
										<h3 class="product-name"><a href="#"><?php echo $b->product_name ?></a></h3>
										<h4 class="product-price">PhP<?php echo number_format($b->price, 2) ?> <del class="product-old-price">PhP<?php echo $a->price ?></del></h4>
									</div>
								</div>
								<?php endforeach; ?>
								<!-- /product widget -->

								
							</div>
						</div>
					</div>

					<div class="clearfix visible-sm visible-xs"></div>

					<div class="col-md-4 col-xs-6">
						<div class="section-title">
							<h4 class="title">Most Wishlist Product</h4>
							<div class="section-nav">
								<div id="slick-nav-5" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-5">
							<div>
								<!-- product widget -->
								<?php 
								 $topSelling = array_slice($data, 15, 3);
								 foreach($topSelling as $a) : ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/<?php echo $a->product_img ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $a->category ?></p>
										<h3 class="product-name"><a href="product.php?product_id=<?php echo $a->product_id ?>"><?php echo $a->product_name ?></a></h3>
										<h4 class="product-price">PhP<?php echo number_format($a->price, 2) ?> <del class="product-old-price">PhP<?php echo $a->price ?></del></h4>
									</div>
								</div>
								<?php endforeach; ?>
								<!-- /product widget -->

							
							</div>

							<div>
								<!-- product widget -->
								<?php 
								 $topSellingg = array_slice($data, 18, 3);
								 foreach($topSellingg as $b) : ?>
								<div class="product-widget">
									<div class="product-img">
										<img src="./img/<?php echo $b->product_img ?>" alt="">
									</div>
									<div class="product-body">
										<p class="product-category"><?php echo $b->category ?></p>
										<h3 class="product-name"><a href="product.php?product_id=<?php echo $b->product_id ?>"><?php echo $b->product_name ?></a></h3>
										<h4 class="product-price">PhP<?php echo number_format($b->price, 2) ?> <del class="product-old-price">PhP<?php echo $a->price ?></del></h4>
									</div>
								</div>
								<?php endforeach; ?>
								<!-- /product widget -->

						
							</div>
						</div>
					</div>

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

<?php require "include/footer.php" ?>