<?php
include("includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Insert Product</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <table align="center" border="1" bgcolor="blue">
            <tr>
                <td colspan="2" align="center">
                    <h2>Insert Data</h2>
                </td>
            </tr>
            <tr>
                <td><label for="pro_title">Product Title :</td>
                <td><input type="text" name="pro_title"></td>
            </tr>
            <tr>
                <td><label for="pro_cat">Product Categories :</td>
                <td>
                    <select name="pro_cat" id="">
                        <option value="none">Select a Category</option>
                        <?php
                        $get_cat= "Select * from categories";
                         $run=mysqli_query($con,$get_cat);
                             while ($row_cat=mysqli_fetch_array($run)) {
                                     $cat_id=$row_cat['cat_id'];
                                    $cat_title=$row_cat['cat_title'];

                                     echo "<option value='$cat_id'>$cat_title</option>";
                                     }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="pro_brand">Product Brand :</td>
                <td>
                    <select name="pro_brand" id="">
                        <option value="none">Select a Brand</option>
                        <?php
                          $get_brand= "Select * from brand";
                          $run=mysqli_query($con,$get_brand);
                          while ($row_brand=mysqli_fetch_array($run)) {
                            $brand_id=$row_brand['brand_id'];
                            $brand_title=$row_brand['brand_title'];
                        
                                     echo "<option value='$brand_id'>$brand_title</option>";
                                     }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="pro_img1">Product Img :</td>
                <td><input type="file" name="pro_img1"></td>
            </tr>
            <tr>
                <td><label for="pro_img2">Product Img :</td>
                <td><input type="file" name="pro_img2"></td>
            </tr>
            <tr>
                <td><label for="pro_img3">Product Img :</td>
                <td><input type="file" name="pro_img3"></td>
            </tr>
            <tr>
                <td><label for="pro_price">Product Price :</td>
                <td><input type="number" name="pro_price"></td>
            </tr>
            <tr>
                <td><label for="pro_des">Product Discription :</td>
                <td><input type="text" name="pro_des"></td>
            </tr>
            <tr>
                <td><label for="pro_keyword">Product Keyword :</td>
                <td><input type="text" name="pro_keyword"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="submit"></input></td>

            </tr>

        </table>

    </form>
</body>

</html>
<?php 
    if (isset($_POST['submit'])) {
        $product_title=$_POST['pro_title'];
        $product_cat=$_POST['pro_cat'];
        $product_brand=$_POST['pro_brand'];
        $product_price=$_POST['pro_price'];
        $product_status="On";
        $product_keyword=$_POST['pro_keyword'];
        $product_desc=$_POST['pro_des'];



        $product_img1=$_FILES['pro_img1']['name'];
        $product_img2=$_FILES['pro_img2']['name'];
        $product_img3=$_FILES['pro_img3']['name'];

        $temp_name1=$_FILES['pro_img1']['tmp_name'];
        $temp_name2=$_FILES['pro_img2']['tmp_name'];
        $temp_name3=$_FILES['pro_img3']['tmp_name'];

            if($product_title=='' or $product_cat=='' or $product_keyword=='' or $product_brand=='' or $product_desc=='' or $product_img1=='' or $product_price==''){

                echo "<script>alert('Please fill all the field:- $product_title:-$product_cat:-$product_price:-$product_keyword:-$product_brand:-$product_desc:-$product_img1')</script>";
                exit();
            }
            else{
                move_uploaded_file($temp_name1,"product_image/$product_img1");
                move_uploaded_file($temp_name2,"product_image/$product_img2");
                move_uploaded_file($temp_name3,"product_image/$product_img3");

            $inser_pro="INSERT INTO `products`( `cat_id`, `brand_id`, `date`, `product_title`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_des`, `product_keyword`, `status`) VALUES ('$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$product_keyword','$product_status')";
            $run=mysqli_query($con,$inser_pro);
            if ($run) {
                echo "<script>alert('Product INSERTED')</script>";
            }else{
                echo $run;
                echo "$product_title<br>:-$product_cat<br>:-$product_price:-<br>$product_keyword:-<br>$product_brand:-<br>$product_desc:-<br>$product_img1 <br>";
            }
        }
    }else{
        
    }
?>