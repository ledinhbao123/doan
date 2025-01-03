<?php
session_start();

include("ketnoi.php");

$ma_thiet_bi = $_POST["ma_thiet_bi"];
$ten_thiet_bi = $_POST["ten_thiet_bi"];
$so_luong_tong = $_POST["so_luong_tong"];
$so_luong_su_dung = $_POST["so_luong_su_dung"];
$so_luong_ton = $_POST["so_luong_ton"];


$sql = "UPDATE thiet_bi SET ten_thiet_bi = '$ten_thiet_bi', so_luong_tong = '$so_luong_tong', so_luong_su_dung = '$so_luong_su_dung', so_luong_ton = '$so_luong_ton' WHERE ma_thiet_bi = '$ma_thiet_bi'";
$kq_insert = mysqli_query($conn, $sql) or die("Không thể cập nhật thiết bị: " . mysqli_error($conn));

$so_luong_ton = $so_luong_tong - $so_luong_su_dung;

$sql = "UPDATE thiet_bi 
        SET ten_thiet_bi = '$ten_thiet_bi', 
            so_luong_tong = '$so_luong_tong', 
            so_luong_su_dung = '$so_luong_su_dung', 
            so_luong_ton = '$so_luong_ton' 
        WHERE ma_thiet_bi = '$ma_thiet_bi'";
$kq_update = mysqli_query($conn, $sql) or die("Không thể cập nhật thiết bị: " . mysqli_error($conn));

if ($kq_insert && $kq_update) {
    echo "<script language='javascript'>
            alert('Sửa thiết bị thành công!');
            window.location='QLTB.php';
          </script>";
} else {
    echo "<script language='javascript'>
            alert('Có lỗi xảy ra khi sửa thiết bị!');
            window.location='QLTB.php';
          </script>";
}

?>