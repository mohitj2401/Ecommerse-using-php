<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<?php
   include('includes/db.php');
 $ip = getUserIP();
 $select_cust = "select * from customer where customer_ip = '$ip'";
 $run_cust = mysqli_query($con,$select_cust);
 $customer = mysqli_fetch_array($run_cust);
 $customer_id1 = $customer['customer_id']; 
?>
<body>
<div class="col-9">
	<h1>Payment option for you</h1>
	<b>Pay with</b>&nbsp;<a href="http://www.paypal.com"><img src="images\paypal.jpg" align="center" width="200px" height="200px"></a><br><b><a href="order.php?c_id=<?php  echo $customer_id1; ?>">Pay Offline</a></b>
	<p>If you selceted "pay offline" option then please check your email or account to find no for your order</p>
</div>

</body>
</html>