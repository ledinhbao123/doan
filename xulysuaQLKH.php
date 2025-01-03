<?php

include("ketnoi.php");

$ma_kh = $_POST["ma_kh"];
$ho_ten = $_POST["ho_ten"];
$gioi_tinh = $_POST["gioi_tinh"];
$cccd = $_POST["cccd"];
$sdtkh = $_POST["sdtkh"];
$emailkh = $_POST["emailkh"];
$matkhaukh = $_POST["matkhaukh"];
$dia_chi = $_POST["dia_chi"];

// Update academic department in the database
$sql = "UPDATE khach_hang SET ho_ten = '$ho_ten', gioi_tinh = '$gioi_tinh', cccd = '$cccd', sdtkh = '$sdtkh', emailkh = '$emailkh', matkhaukh = '$matkhaukh', dia_chi = '$dia_chi' WHERE ma_kh = '$ma_kh'";
$kq = mysqli_query($conn, $sql) or die("Không thể cập nhật thông tin khách hàng: " . mysqli_error($conn));

echo "<script language=javascript>
        alert('Cập nhật thông tin khách hàng thành công!');
        window.location='QLKH.php';
    </script>";
?>