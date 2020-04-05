<?php
  $c = $_SESSION['customer_email'];
  $get_c = "select * from customer where customer_email = '$c'";
  $run_c = mysqli_query($con,$get_c);
  $row_c = mysqli_fetch_array($run_c);
  $customer_id = $row_c['customer_id'];
$get_order = "select * from customer_order where customer_id='$customer_id'";
$run_order = mysqli_query($con,$get_order);
	?>
	<h3 align="center">All order details:</h3>
<table width="770" align="center" bgcolor="pink"> 
	<tr align="center" bgcolor="skyblue">
		<th>Order no</th>
		<th>Due amount</th>
		<th>Invoice no</th>
		<th>Total Product</th>
		<th>Order date</th>
		<th>Paid/Unpaid</th>
		<th>status</th>
	</tr>
	<?php 
while($row_order = mysqli_fetch_array($run_order)){ 
	$order_no = $row_order['order_id'];
	$due_amount = $row_order['due_amount'];
    $invoice_no = $row_order['invoice_no'];
    $total_product = $row_order['total_product'];
    $order_date = $row_order['order_date'];
    $status = $row_order['order_status'];
    if($status == 'pending'){
    	$status = 'unpaid';
    }else{
    	$status = 'paid';
    }
	?>
	<tr align="center">
		<th><?php echo $order_no; ?></th>
		<th><?php echo $due_amount; ?></th>
		<th><?php echo $invoice_no; ?></th>
		<th><?php echo $total_product; ?></th>
		<th><?php echo $order_date; ?></th>
		<th><?php echo $status; ?></th>
		<th><a href="../confirm.php?order_id= <?php echo $order_no; ?>">confirm if paid</a></th>
	</tr>


	<?php
}


?></table>