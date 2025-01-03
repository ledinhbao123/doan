<?php

include("ketnoi.php");

$ma_kh = $_POST["ma_kh"];
$ho_ten = $_POST["ho_ten"];
$gioi_tinh = $_POST["gioi_tinh"];
$cccd = $_POST["cccd"];
$sdtkh = $_POST["sdtkh"];
$emailkh = $_POST["emailkh"];
$dia_chi = $_POST["dia_chi"];
$matkhaukh = $_POST["matkhaukh"];



$sql = "INSERT INTO khach_hang VALUES ('" .$ma_kh. "', '" .$ho_ten. "', '" .$gioi_tinh. "', '" .$cccd. "', '" .$sdtkh. "', '" .$emailkh. "', '" .$dia_chi. "', '" .$matkhaukh. "')";
$kq = mysqli_query($conn, $sql) or die("Không thể đăng ký tài khoản: " . mysqli_error($conn));

echo "<script language=javascript>
        alert('Đăng ký tài khoản thành công!');
        window.location='dangnhap.php';
    </script>";
?>