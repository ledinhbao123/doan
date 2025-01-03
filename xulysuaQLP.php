<?php
include("ketnoi.php");

$ma_phong = $_POST["ma_phong"];
$ma_loai = $_POST["ma_loai"];
$ten_phong = $_POST["ten_phong"];


// Update academic department in the database
$sql = "UPDATE phong SET ma_loai = '$ma_loai', ten_phong = '$ten_phong' WHERE ma_phong = '$ma_phong'";
$kq = mysqli_query($conn, $sql) or die("Không thể cập nhật thông tin phòng: " . mysqli_error($conn));

echo "<script language=javascript>
        alert('Cập nhật thông tin phòng thành công!');
        window.location='QLP.php';
    </script>";
?>
