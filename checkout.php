<?php
include("includes/db.php");
include("functions/functions.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Show website</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/style.css">
</head>

<body>
  <div class="container=fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <a class="navbar-brand" href="index.php">Shopsite</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="all_products.php">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customer/myaccount.php">My Account</a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Shopping Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Coutact Us</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="results.php">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_query">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit"value="submit">Search</button>
        </form>
      </div>
    </nav>
    <div class="row">
      <div class="col-2 cat">
        <h4 class="cat_name">Categories</h4>
        <ul class="product_cat">
          <?php getCat();?>
        </ul>

        <h4 class="brand_name">Brands</h4>
        <ul class="product_brand">

          <?php
  getBrand();
?>
        </ul>
      </div>


      <div style="padding-right:0px;" class="col-sm-10">
        <div class="shop_bar">
        <?php cart(); ?>
          <p class="float-right" style="color:#ded5d8">
          <span>
						<?php
						if(isset($_SESSION['customer_email'])){
							echo "  Welcome:  <b>" . $_SESSION['customer_email']." </b>";
						}
						else{
							echo "<b>Wecome Guest</b>";
						}
						
						?>
					</span>
           <span>Shopping Cart -</span>
            <span>Item :- <?php item(); ?> Total Price :- <?php total_price(); ?> - <a style="color:yellow" href="cart.php">Goto Cart</a></span>&nbsp;
            <?php if(!isset($_SESSION['customer_email'])){
              echo "<a href='customer-register.php' style='color:white'>Register</a>";
            }
            else{
              echo "<a href='logout.php' style='color:white'>Logout</a>";
            }
            
          ?>
          </p>





        </div>

        <div class="all_pro">
          
              <br>
            <?php 
                $ip = getUserIP();
                $sel_cart = "select * from cart where ip_add='$ip' ";
                $run_cart = mysqli_query($con, $sel_cart);
                $check_cart = mysqli_num_rows($run_cart);
                if(isset($_SESSION['customer_email']) AND $check_cart==0){
                  
                  echo "<script>window.open('customer/my_account.php','_self')</script>";		
                }
                if(!isset($_SESSION['customer_email'])){
					include("customer/customer_login.php");
				}
				else{
					include("payment-option.php");
				}
            
            ?>
          </div>
        
      </div>


    </div>





    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>