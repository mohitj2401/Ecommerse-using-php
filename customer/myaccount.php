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
            <a class="nav-link" href="../all_products.php">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../myaccount.php">My Account</a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="../cart.php">Shopping Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contact.php">Coutact Us</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="results.php">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_query">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit"value="submit">Search</button>
        </form>
      </div>
    </nav>
    <div class="row">
     

      <div style="padding-right:0px;" class="col-sm-10">
        <div class="shop_bar">
          <p class="float-right" style="color:#ded5d8">
          <span>
						<?php
						if(isset($_SESSION['customer_email'])){
							echo "  Welcome:  <b>" . $_SESSION['customer_email']." </b>  ";

              echo "<a href='../logout.php' style='color:black'>Logout</a>";
            }
            else
            {
              echo "<script>window.open('../checkout.php','_self')</script>";
            }
          ?>
          </p>


         

        </div>

        <div class="all_pro">
          <h1 style="font-size:20px; text-align: center;  background-color: black;padding: 10px; color:white;">Manage Your Account Here</h1> 
          <?php getDefault(); 
           ?>
           <?php
           if(isset($_GET['my_orders'])){
            include('my_orders.php');
           }
           if(isset($_GET['edit_account'])){
            include('edit_account.php');
           }
           if(isset($_GET['change_pass'])){
            include('change_pass.php');
           }
           if(isset($_GET['delete_account'])){
            include('delete_account.php');
           }
           ?>
        </div>

      </div>

      <div class="col-sm-2" style="padding-left: 0px;padding-right: 0px;">
        <h4 class="headi">Manage Account</h4>
        <ul class="product_cat">
          
                
        <?php
           $user_session = $_SESSION['customer_email'];
           $get_customer = "select * from customer where customer_email = '$user_session'";
             $run_customer = mysqli_query($con,$get_customer);
             $row_customer = mysqli_fetch_array($run_customer); 
               $customer_image = $row_customer['customer_image'];
               echo "<img src='customer_images/$customer_image' width='150px' height='150px'>";
                ?>  
              <li><a href="myaccount.php?my_orders">My Orders</a></li>
              <li><a href="myaccount.php?edit_account">Edit Account</a></li>
              <li><a href="myaccount.php?change_pass">Change Password</a></li>
              <li><a href="myaccount.php?delete_account">Delete Account</a></li>
              <li><a href="myaccount.php?logout">Logout</a></li>
               
        </ul>
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