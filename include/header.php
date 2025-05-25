<?php include "dbcon.php" ?>
<?php include "include/ulo.php" ?>
<?php session_start(); ?>


<?php
if(isset($_SESSION['user_id']))
		{
			//to display the qty of cart
			
			$user_id = $_SESSION['user_id'];	
			$query = $conn->prepare("SELECT SUM(cart_qty) as total_cart_qty FROM cart WHERE user_id = '$user_id' ");
			$query->execute();

			$cartval = $query->fetchAll(PDO::FETCH_OBJ);

			//to display the qty of wishlist
			$query = $conn->prepare("SELECT SUM(qty) as total_wish_qty FROM wishlist WHERE user_id = '$user_id' ");
			$query->execute();
			$wishval = $query->fetchAll(PDO::FETCH_OBJ);


			//to display all the products in wishlist
			$wish = $conn->prepare("SELECT wishlist.product_id,(products.price * qty) AS sub_amount, products.product_id, products.product_name,products.product_img, wishlist.qty FROM wishlist 
									JOIN products ON wishlist.product_id = products.product_id WHERE user_id = '$user_id' ");
			$wish->execute();
			$list = $wish->fetchAll(PDO::FETCH_OBJ);
			
			
			//to display all the products in cart
			$cart = $conn->prepare("SELECT products.product_id, (products.price * cart_qty) AS sub_amount, products.price, products.product_name, products.product_img, cart.product_id, cart.cart_qty 
									FROM cart 
									JOIN products
									ON cart.product_id = products.product_id 
									WHERE cart.user_id = '$user_id' ");
			$cart->execute();
			$product = $cart->fetchAll(PDO::FETCH_OBJ);

	
			
			//to show sub-total of cart
			$amount = $conn->prepare("SELECT SUM(products.price) as total_price FROM cart JOIN products ON cart.product_id = products.product_id
									  WHERE cart.user_id = '$user_id' ");
			$amount->execute();
			$a = $amount->fetch(PDO::FETCH_ASSOC);

			$totalamount = 0;
			foreach($product as $tots)
				$totalamount = $totalamount + $tots->sub_amount; 

			//to show sub-total of wishlist
			$amountwish = $conn->prepare("SELECT SUM(products.price) as total_pricee FROM wishlist JOIN products ON wishlist.product_id = products.product_id
									  WHERE wishlist.user_id = '$user_id' ");
			$amountwish->execute();
			$aw = $amountwish->fetch(PDO::FETCH_ASSOC);

			$totalamountt = 0;
			foreach($list as $tots)
				$totalamountt = $totalamountt + $tots->sub_amount; 
	
	    }	



?>

		




	<body>
	<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<!--<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
            -->
					<ul class="header-links pull-right">
						<?php if(!isset($_SESSION['username'])) : ?>
						<li><a href="#"><i class="fa fa-phone"></i> Contact</a></li>
						<li><a href="login.php"><i class="fa fa-user-o"></i> Login</a></li>
						<?php else : ?>
						<li><a href="#"> Hello! <?php echo $_SESSION['username'] ?></a></li>
						<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
						<li><a href="logout.php"><i class="fa fa-user-o"></i> Logout</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										<option value="1">Category 01</option>
										<option value="1">Category 02</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-heart-o"></i>
										<span>Wishlist</span>
										<div class="qty"><?php echo $wishval[0]->total_wish_qty ?? 0; ?></div>
									</a>
									
									<div class="cart-dropdown">
										
										<div class="cart-list">
										<?php foreach($list as $p) : ?>
											<div class="product-widget">
												
												<div class="product-img">
													<img src="img/<?php echo $p->product_img ?>" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#"><?php echo $p->product_name ?></a></h3>
													<h4 class="product-price"><span class="qty">x<?php echo $p->qty ?></span>PhP <?php echo number_format($p->sub_amount, 2) ?> 
													<div class="add-to-cart">
														<form method="POST" action="add-to-cart.php">
														<input type="hidden" name="product_id" value="<?php echo $p->product_id ?>">
														<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
														<input type="hidden" name="qty" value="<?php echo $p->qty ?>">
														<button name="wishtocart" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Add to cart </button>
														</form>
													</div>
												</h4>
												</div>
												<form method="POST" action="delete.php" ?>
												<input type="hidden" name="product_id" value="<?php echo $p->product_id ?>">
												<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>"> 
												<button name="deletee" class="delete"><i class="fa fa-close"></i></button>
												</form>
											</div>
											
											<?php endforeach; ?>
										</div>
										
										<div class="cart-summary">
											<small><?php echo $wishval[0]->total_wish_qty ?? 0; ?> Item(s) selected</small>
											<h5>SUBTOTAL: Php <?php echo number_format($totalamountt, 2) ?></h5>
										</div>
										
										<div class="cart-btns">
											
											<?php foreach($list as $qty) : ?>
											<form id="addToCartForm" method="POST" action="add-to-cart.php" style="display:none;">			
												<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
												<input type="hidden" name="product_id" value="<?php echo $qty->product_id; ?>">
												
											</form>
											<?php endforeach; ?>
											<a href="#" onclick="document.getElementById('addToCartForm').submit(); return false;">Add all to Cart <i class="fa fa-arrow-circle-right"></i></a>
											
										</div>
										
									
									</div>
									
								</div>
								
								<!-- /Wishlist -->

								<!-- Cart -->
								
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><?php echo $cartval[0]->total_cart_qty ?? 0; ?></div>
									</a>
									
									<div class="cart-dropdown">
										
										<div class="cart-list">
										<?php foreach($product as $p) : ?>
											<div class="product-widget">
												
												<div class="product-img">
													<img src="img/<?php echo $p->product_img ?>" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#"><?php echo $p->product_name ?></a></h3>
													<h4 class="product-price"><span class="qty">x<?php echo $p->cart_qty ?></span>PhP <?php echo number_format($p->sub_amount, 2) ?> 
												</h4>
												</div>
												<form method="POST" action="delete.php" ?>
												<input type="hidden" name="product_id" value="<?php echo $p->product_id ?>">
												<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>"> 
												<button name="delete" class="delete"><i class="fa fa-close"></i></button>
												</form>
											</div>
										<?php endforeach; ?>	
										
										</div>
										
										<div class="cart-summary">
											<small><?php echo $cartval[0]->total_cart_qty ?? 0; ?> Item(s) selected</small>
											<h5>SUBTOTAL: Php <?php echo number_format($totalamount, 2) ?></h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="checkout.php">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
									
								</div>
							
								
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="index.php">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->