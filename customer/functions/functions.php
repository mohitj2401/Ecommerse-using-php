<?php 
$con = mysqli_connect("localhost","root","","shopingcart");

function getPro(){
    global $con;
    if(!isset($_GET['cat'])){

        if (!isset($_GET['brand'])) {
            
    $get_pro="Select * from products order by rand() LIMIT 0,6";
    $run=mysqli_query($con,$get_pro);
    while ($row_pro=mysqli_fetch_array($run)) {
     $pro_id=$row_pro['product_id'];
     $pro_title=$row_pro['product_title'];
     $pro_cat=$row_pro['cat_id'];
     $pro_brand=$row_pro['brand_id'];
     $pro_desc=$row_pro['product_des'];
     $pro_price=$row_pro['product_price'];
     $pro_img=$row_pro['product_img1'];
      echo "
      <div class='col-md-4'>
      <div class='card'>
      <div class='card-body'>
      <h6>$pro_title</h6>

      <img src='admin_area/product_image/$pro_img' class='img_pro' />
      <h5>Price: $$pro_price</h5>
      <a href='details.php?pro_id=$pro_id' class='float-left'>Details</a>
      <a href='index.php?add_cart=$pro_id'><input type='submit' value='Add to Cart' class='float-right'></a>

      </div>
      </div>
      </div>
      ";


    }
}
}

}

function getBrandPro(){
    global $con;

        if (isset($_GET['brand'])) {
            $brand_id=$_GET['brand'];
            
    $get_pro="Select * from products where brand_id='$brand_id'";
    $run=mysqli_query($con,$get_pro);
    while ($row_pro=mysqli_fetch_array($run)) {
     $pro_id=$row_pro['product_id'];
     $pro_title=$row_pro['product_title'];
     $pro_cat=$row_pro['cat_id'];
     $pro_brand=$row_pro['brand_id'];
     $pro_desc=$row_pro['product_des'];
     $pro_price=$row_pro['product_price'];
     $pro_img=$row_pro['product_img1'];
      echo "
      <div class='col-md-4'>
      <div class='card'>
      <div class='card-body'>
      <h6>$pro_title</h6>

      <img src='admin_area/product_image/$pro_img' class='img_pro' />
      <h5>Price: $$pro_price</h5>
      <a href='details.php?pro_id=$pro_id' class='float-left'>Details</a>
      <a href='index.php?add_cart=$pro_id'><input type='submit' value='Add to Cart' class='float-right'></a>

      </div>
      </div>
      </div>
      ";


    }
}


}



function getCatPro(){
    global $con;
    if(isset($_GET['cat'])){
            $cat_id=$_GET['cat'];
    $get_pro="Select * from products where cat_id='$cat_id'";
    $run=mysqli_query($con,$get_pro);
    while ($row_pro=mysqli_fetch_array($run)) {
     $pro_id=$row_pro['product_id'];
     $pro_title=$row_pro['product_title'];
     $pro_cat=$row_pro['cat_id'];
     $pro_brand=$row_pro['brand_id'];
     $pro_desc=$row_pro['product_des'];
     $pro_price=$row_pro['product_price'];
     $pro_img=$row_pro['product_img1'];
      echo "
      <div class='col-md-4'>
      <div class='card'>
      <div class='card-body'>
      <h6>$pro_title</h6>

      <img src='admin_area/product_image/$pro_img' class='img_pro' />
      <h5>Price: $$pro_price</h5>
      <a href='details.php?pro_id=$pro_id' class='float-left'>Details</a>
      <a href='index.php?add_cart=$pro_id'><input type='submit' value='Add to Cart' class='float-right'></a>

      </div>
      </div>
      </div>
      ";


    }

}

}
function getBrand(){
    global $con;

    $get_brand= "Select * from brand";
  $run=mysqli_query($con,$get_brand);
  while ($row_brand=mysqli_fetch_array($run)) {
    $brand_id=$row_brand['brand_id'];
    $brand_title=$row_brand['brand_title'];

    echo "<li class='brand_list'> <a href='index.php?brand=$brand_id'>$brand_title</a> </li>";
  }
}

function getCat(){
    global $con;

    $get_cat= "Select * from categories";
    $run=mysqli_query($con,$get_cat);
    while ($row_cat=mysqli_fetch_array($run)) {
      $cat_id=$row_cat['cat_id'];
      $cat_title=$row_cat['cat_title'];
  
      echo "<li class='cat_list'> <a href='index.php?cat=$cat_id'>$cat_title</a> </li>";
    }
    }

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

//Getting defaults for customers
function getDefault(){
    global $con;

  $c=$_SESSION['customer_email'];
  $get_c="select * from customer  where customer_email='$c'";
  $run=mysqli_query($con,$get_c);
  $row=mysqli_fetch_array($run);
  $customer_id=$row['customer_id'];
      if(!isset($_GET['my_orders'])){
        if(!isset($_GET['edit_account'])){
          if(!isset($_GET['change_pass'])){
              if(!isset($_GET['delete_account'])){
                    $get_order="select * from customer_order where customer_id='$customer_id' AND order_status='pending'";
                    $run_order=mysqli_query($con,$get_order);
                    $count_orders=mysqli_num_rows($run_order);
                    if ($count_orders>0) {
                      echo "
                        <div style='padding:10px'>
                          <h1 style='color:red'>Important</h1>
                          <h2>You Have $count_orders Pending orders</h2>
                          <h3>Please see your orders details by clicking  <a href='myaccount.php?my_orders'>this link</a> <br> Or you can <a href='pay_offline.php'>Pay Offline</a></h3>
                        </div>
                      ";
                    }
                    else{
                      echo "You currently don't have any order plz<a href='../index.php'> click here</a> for shoping";
                    }
            }
          }
        }
      }
}


//cart functions

function cart(){
    global $con;
    if (isset($_GET['add_cart'])) {
       $ip_add=getUserIP();
       $p_id=$_GET['add_cart'];
       $check_pro="select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
       $run=mysqli_query($con,$check_pro);
       if (mysqli_num_rows($run)>0) {
           echo "";
           
       }else{
           $q="insert into cart (p_id,ip_add,qry)values($p_id,'$ip_add',1)";
           $run=mysqli_query($con,$q);
           echo "<script>window.open('index.php','_self')</script>";
       }
    }
}
//geting no of atom from the cart

function item(){
    global $con;
    $ip_add=getUserIP();

    if(isset($_GET['add_cart'])){
        $get_item="select * from cart where ip_add='$ip_add'";
        $run=mysqli_query($con,$get_item);
        $count_items=mysqli_num_rows($run);
        echo $count_items;
    }else{
        $get_item="select * from cart where ip_add='$ip_add'";
        $run=mysqli_query($con,$get_item);
        $count_items=mysqli_num_rows($run);
        echo $count_items; 
    }
    
}

//price update

function total_price(){
    global $con;
    $ip_add=getUserIP();
    $total= 0;
     $get_item="select * from cart where ip_add='$ip_add'";
    $run=mysqli_query($con,$get_item);
    while($record=mysqli_fetch_array($run)){
        $pro_id=$record['p_id'];
        $pro_price="select * from products where product_id='$pro_id'";
        $price_run=mysqli_query($con,$pro_price);
        while($p_price=mysqli_fetch_array($price_run)){
            $product_price=array($p_price['product_price']);
            $value=array_sum($product_price);
            $total +=$value;

        }
    }
    echo  "$".$total;
}

?>