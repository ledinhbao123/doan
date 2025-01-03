<?php
session_start();
include("ketnoi.php");
include("ghilog.php");

// Kiểm tra session đã đăng nhập hay chưa
if (!isset($_SESSION['ma_nv'])) {
    header("Location: login.php");
    exit();
}


$ma_vat_tu = $_POST["ma_vat_tu"];
$ten_vat_tu = $_POST["ten_vat_tu"];
$so_luong_tong = $_POST["so_luong_tong"];
$so_luong_su_dung = $_POST["so_luong_su_dung"];
$so_luong_ton = $_POST["so_luong_ton"];
$ma_nv = $_SESSION['ma_nv'];


// Update academic department in the database
$sql = "UPDATE vat_tu SET ten_vat_tu = '$ten_vat_tu', so_luong_tong = '$so_luong_tong', so_luong_su_dung = '$so_luong_su_dung', so_luong_ton = '$so_luong_ton' WHERE ma_vat_tu = '$ma_vat_tu'";
$kq_insert = mysqli_query($conn, $sql) or die("Không thể cập nhật vật tư: " . mysqli_error($conn));

// Tính toán số lượng tồn mới
$so_luong_ton = $so_luong_tong - $so_luong_su_dung;

// Update thông tin vật tư trong CSDL
$sql = "UPDATE vat_tu 
        SET ten_vat_tu = '$ten_vat_tu', 
            so_luong_tong = '$so_luong_tong', 
            so_luong_su_dung = '$so_luong_su_dung', 
            so_luong_ton = '$so_luong_ton' 
        WHERE ma_vat_tu = '$ma_vat_tu'";
$kq_update = mysqli_query($conn, $sql) or die("Không thể cập nhật vật tư: " . mysqli_error($conn));

if ($kq_insert && $kq_update) {
    echo "<script language='javascript'>
            alert('Sửa vật tư thành công!');
            window.location='QLVT.php';
          </script>";
} else {
    echo "<script language='javascript'>
            alert('Có lỗi xảy ra khi sửa vật tư!');
            window.location='QLVT.php';
          </script>";
}

?>