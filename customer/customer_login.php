<?php

include("includes/db.php");
@session_start();
?>
<div class="container" style="margin-top:40px;">
    <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-6">
            <div id="login-box" class="col-md-12">
                <form id="login-form" class="form" action="checkout.php" method="post">
                    <h3 class="text-center text-info">Login</h3>
                    <div class="form-group">
                        <label for="username" class="text-info">Username:</label>
                        <br>
                        <input type="email" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-info">Password:</label>
                        <br>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="remember-me" class="text-info">
                            <span>Remember me</span>
                            <span>
                                <input id="remember-me" name="remember-me" type="checkbox">
                            </span>
                        </label>
                        <br>
                        <input type="submit" name="login" class="btn btn-info btn-md" value="Login">
                    </div>
                    <div id="register-link" class="text-right">
                        <a href="customer-register.php" class="text-info">Register here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
if(isset($_POST['login'])){
	$c_email =htmlspecialchars( $_POST['username']);
	$c_pass =htmlspecialchars( $_POST['password']);
	$sel_c = "select * from customer where customer_pass = '$c_pass' AND customer_email = '$c_email' ";
	$run_c = mysqli_query($con, $sel_c);
	$check_customer = mysqli_num_rows($run_c);
	if($check_customer == 0){
        echo "<script>alert('pw or email is incorrect, try again!')</script>";
        exit();

	}
	$ip = getUserIP();
	$sel_cart = "select * from cart where ip_add='$ip' ";
	$run_cart = mysqli_query($con, $sel_cart);
	$check_cart = mysqli_num_rows($run_cart);
	if($check_customer>0 AND $check_cart==0){
		$_SESSION['customer_email'] = $c_email;
		//echo "$_SESSION[customer_email]";
		echo "<script>alert('log in successful!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";		
	}
	else{
		
        
		$_SESSION['customer_email'] = $c_email;
		echo "<script>alert('log in successful!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
	}
	
}
?>