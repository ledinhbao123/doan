<?php
session_start();

include("ketnoi.php");

$ma_nv = $_POST["ma_nv"];
$ho_ten = $_POST["ho_ten"];
$gioi_tinh = $_POST["gioi_tinh"];
$cccd = $_POST["cccd"];
$ngay_sinh = $_POST["ngay_sinh"];
$sdtnv = $_POST["sdtnv"];
$dia_chi = $_POST["dia_chi"];
$user = $_POST["user"];
$pass = $_POST["pass"];
$tinh_trang = $_POST["tinh_trang"];

// Update academic department in the database
$sql = "UPDATE nhan_vien SET ho_ten = '$ho_ten', gioi_tinh = '$gioi_tinh', cccd = '$cccd', ngay_sinh = '$ngay_sinh', sdtnv = '$sdtnv', dia_chi = '$dia_chi', user = '$user', pass = '$pass', tinh_trang = '$tinh_trang'  WHERE ma_nv = '$ma_nv'";
$kq = mysqli_query($conn, $sql) or die("Không thể cập nhật thông tin nhân viên: " . mysqli_error($conn));

echo "<script language=javascript>
        alert('Cập nhật thông tin nhân viên thành công!');
        window.location='QLNV.php';
    </script>";
?>