<?php
$con = mysqli_connect("localhost","root","","shopingcart");
if(mysqli_connect_errno()){
    echo "The Connection was not established: " . mysqli_connect_error();
}
?>