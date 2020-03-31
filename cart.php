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
            <a class="nav-link" href="all_products.php">All Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myaccount.php">My Account</a>
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
            <span>Item :- <?php item(); ?> Total Price :- <?php total_price(); ?> </span>&nbsp;
            <?php if(!isset($_SESSION['customer_email'])){
              echo "<a href='checkout.php' style='color:white'>Login</a>";
            }
            else{
              echo "<a href='logout.php' style='color:white'>Logout</a>";
            }
            
          ?>
          </p>





        </div>

        <div class="all_pro">
          <div style="" class="row">
      <div class='col-sm-12'>

 <form action="cart.php" method="post" entype="multipart/form-data" style="margin:10px">
          <table  align="center" width="100%">
                
                    <tr align="center">
                        <td><b>Remove</b></td>
                        <td><b>Product(s)</b></td>
                        <td><b>Quantity</b></td>
                        <td><b>Total Price</b></td>
                    </tr>
  <?php $ip_add=getUserIP();
    $total= 0;
     $get_item="select * from cart where ip_add='$ip_add'";
    $run=mysqli_query($con,$get_item);
    while($record=mysqli_fetch_array($run)){
        $pro_id=$record['p_id'];
        $qty_i=$record['qry'];
        $pro_price_query="select * from products where product_id='$pro_id'";
        $price_run=mysqli_query($con,$pro_price_query);
        while($p_price=mysqli_fetch_array($price_run)){
            $product_price=array($p_price['product_price']);
            $pro_price=$p_price['product_price'];
            $product_title=$p_price['product_title'];
            $product_img1=$p_price['product_img1'];
            $value=array_sum($product_price);
            $total +=$value*$qty_i;
?>
                <tr align="center">
                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>"></td>
                <td><?php echo $product_title ?><br><img src="admin_area/product_image/<?php echo $product_img1 ?>" alt="" height="80px" width="80px"></td>
                <?php  echo '<td>'.$qty_i.'&nbsp;<a class="btn btn-secondary" style="padding:5px;" href="update-cart.php?action=add&id='.$pro_id.'">+</a>&nbsp;<a class="btn btn-danger" style="padding:5px;" href="update-cart.php?action=remove&id='.$pro_id.'">-</a></td>';
                ?>
                <td><?php echo "$".$pro_price*$qty_i ?></td>
                </tr>
    <?php          }
    }
  ?>
                <tr align="center">
                  <td colspan="3" align="right">Sub Total:</td>
                  <td><?php echo "$".$total;?></td>
                
                </tr>
                <br>
                <tr align="center">
                <td colspan="2"><b><input type="submit" value="Update Cart" name="update"></b></td>
                <td><b><input type="submit" value="Continue Shopping" name="continue"></b></td>
                <td><button> <a href="checkout.php">Checkout</a></button></td>
                </tr>
                </table>
            </form>
            <?php
            if (isset($_POST['update'])) {
              if (isset($_POST['remove'])) {
                # code...
              
              foreach($_POST['remove'] as $remove_id){
                  $del_pro="delete from cart where p_id='$remove_id'";
                  
                  $run=mysqli_query($con,$del_pro);
                  if ($run) {
                    echo "<script>window.open('cart.php','_self')</script>";
                  }
              }
              }
            }
            if (isset($_POST['continue'])) {
              echo "<script>window.open('index.php','_self')</script>";

            }
            ?>
      </div>
          </div>
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