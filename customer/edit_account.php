<?php 
@session_start();
if(isset($_GET['edit_account'])){
   $customer_email = $_SESSION['customer_email'];
   $get_customer = "select * from customer where customer_email='$customer_email'";
   $run_customer = mysqli_query($con,$get_customer);
   $row = mysqli_fetch_array($run_customer);
   $id = $row['customer_id'];
   $name = $row['customer_name'];
   $email = $row['customer_email'];
   $pass = $row['customer_pass'];
   $country = $row['customer_coun'];
    $city = $row['customer_city']; 
    $phone = $row['customer_phno'];   
    $address = $row['customer_add']; 
    $image =  $row['customer_image']; 

}
?>
<form action="" method="post" enctype="multipart/form-data">
	<table center="600" align="center">
		<tr><th colspan="2">Update your account:</th></tr>
		     <tr>
              <td align="right">Customer Image</td>
              <td><input type="file" name="c_img" value="<?php echo $image; ?>"/><img src="customer_images/<?php echo $image; ?>" width="100px" height="100px" ></td>
            </tr><tr>
              <td align="right">Customer Name</td>
              <td><input type="text" name="c_name"  value="<?php echo $name; ?>"required /></td>
            </tr>
            <tr>
              <td align="right">Customer Country</td>
              <td><select name="c_country">
                <option value="india" <?php if($country=="india"){echo "selected";}; ?>>india</option>
                <option value="china" <?php if($country=="china"){echo "selected";}; ?>>china</option>
                <option value="japan" <?php if($country=="japan"){echo "selected";}; ?>>japan</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Customer City</td>
              <td><input type="text" name="c_city" value="<?php echo $city; ?>" required /></td>
            </tr>
            <tr>
              <td align="right">Customer Phoneno</td>
              <td><input type="number" value="<?php echo $phone; ?>" name="c_phone" required /></td>
            </tr>
            <tr>
              <td align="right">Customer Address</td>
              <td><input type="text" name="c_add" value="<?php echo $address; ?>" required /></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="submit" name="update" value="update  "></td>
            </tr>
	</table>
</form>
<?php



if(isset($_POST['update'])){
	$update_id = $id;
	$filename =$_FILES['c_img']['name'];
  $tempname = $_FILES['c_img']['tmp_name'];
	$c_name = $_POST['c_name'];
  $c_country = $_POST['c_country'];

	$c_email = $_POST['c_email'];
	$c_pass = $_POST['c_pass'];
	$c_city = $_POST['c_city'];
	$c_phone = $_POST['c_phone'];
	$c_add = $_POST['c_add'];
  $image = "customer_images/".$filename;
	move_uploaded_file($tempname, $image);
	$update_c = "update customer set customer_image='$filename' ,customer_name='$c_name',customer_coun='$c_country',customer_city ='$c_city',customer_phno='$c_phone',customer_add ='$c_add' where customer_id = '$update_id'";
	$run_c = mysqli_query($con,$update_c);
	if($run_c){
		echo "<script>alert('your account is updated') </script>";
    echo "<script>window.open('myaccount.php','_self')</script>";
	}
 
}