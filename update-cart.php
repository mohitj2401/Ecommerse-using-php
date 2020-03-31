<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'includes/db.php';

$product_id = $_GET['id'];
$action = $_GET['action'];


// if($action === 'empty')
//   unset($_SESSION['cart']);

$query ="select qry from cart where  p_id = '$product_id'";
$result=mysqli_query($con,$query);

if($result){

    switch($action) {

      case "add":
                    $upd_qty="update cart set qry=qry+1 where  p_id = '$product_id'";
                    $run_qry=mysqli_query($con,$upd_qty);
      break;

      case "remove": $run= mysqli_fetch_array($result);
                        if($run['qry']<2){
                                    $del_pro="delete from cart where p_id='$product_id'";
                  
                                     $run=mysqli_query($con,$del_pro);
                             }
                     $upd_qty="update cart set qry=qry-1 where  p_id = '$product_id'";
                    $run_qry=mysqli_query($con,$upd_qty);
        break;



    }
  
}



header("location:cart.php");

?>
