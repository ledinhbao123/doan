<?php
include("ketnoi.php");

$ma_hoa_don = $_POST["ma_hoa_don"];
$ma_o = $_POST["ma_o"];
$ma_kh = $_POST["ma_kh"];
$ma_nv = $_POST["ma_nv"];
$ngay_lap_hoa_don = $_POST["ngay_lap_hoa_don"];
$thanh_tien = $_POST["thanh_tien"];

$sql = "UPDATE phong SET ma_o = '$ma_o', ma_kh = '$ma_kh', ma_nv = '$ma_nv', ngay_lap_hoa_don = '$ngay_lap_hoa_don', thanh_tien = '$thanh_tien' WHERE ma_hoa_don = '$ma_hoa_don'";
$kq = mysqli_query($conn, $sql) or die("Không thể cập nhật thông tin hoá đơn: " . mysqli_error($conn));

echo "<script language=javascript>
        alert('Cập nhật thông tin hoá đơn thành công!');
        window.location='QLHD.php';
    </script>";
?>
