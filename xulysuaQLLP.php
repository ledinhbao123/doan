<?php
session_start();

include("ketnoi.php");

$ma_loai = $_POST["ma_loai"];
$ten_loai = $_POST["ten_loai"];
$dien_tich = $_POST["dien_tich"];
$chi_tiet_phong = $_POST["chi_tiet_phong"];
$so_luong = $_POST["so_luong"];
$gia_phong = $_POST["gia_phong"];

// Lấy ảnh hiện tại từ cơ sở dữ liệu
$query = "SELECT anh_loai_phong FROM loai_phong WHERE ma_loai = '$ma_loai'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$hinh_anh_hien_tai = $row['anh_loai_phong'];

$anh_loai_phong = $hinh_anh_hien_tai;

if (isset($_FILES["anh_loai_phong"]) && $_FILES["anh_loai_phong"]["name"] != "") {
    $duongdan = "./anhtin/";
    $duongdan = $duongdan . basename($_FILES["anh_loai_phong"]["name"]);
    if (move_uploaded_file($_FILES["anh_loai_phong"]["tmp_name"], $duongdan)) {
        $anh_loai_phong = $duongdan;
    } else {
        die("Không thể tải lên hình ảnh.");
    }
}

$sql = "UPDATE loai_phong SET ten_loai = '$ten_loai', anh_loai_phong = '$anh_loai_phong', dien_tich = '$dien_tich', chi_tiet_phong = '$chi_tiet_phong', so_luong = '$so_luong', gia_phong = '$gia_phong' WHERE ma_loai = '$ma_loai'";
$kq = mysqli_query($conn, $sql) or die("Không thể cập nhật thông tin loại phòng: " . mysqli_error($conn));

echo "<script language=javascript>
        alert('Cập nhật thông tin loại phòng thành công!');
        window.location='QLLP.php';
    </script>";
?>