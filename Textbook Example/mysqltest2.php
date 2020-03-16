<?php
$conn = mysqli_connect("localhost","root","123456");
if (mysqli_connect_errno()){
echo "MySQL connect error: " . mysqli_connect_error();
}
$sql = "CREATE DATABASE test2";
if (mysqli_query($conn,$sql)){
echo " make test2 success.";
}else {
echo "make test2 eorro: " . mysqli_error($conn);
}
?>
