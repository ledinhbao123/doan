<?php
session_start();

include("ketnoi.php");

$ma_ha = $_POST["ma_ha"];
$ma_loai = $_POST["ma_loai"];

// Lấy ảnh hiện tại từ cơ sở dữ liệu
$query = "SELECT hinh_anh FROM hinh_anh WHERE ma_ha = '$ma_ha'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$hinh_anh_hien_tai = $row['hinh_anh'];

$hinh_anh = $hinh_anh_hien_tai;

if (isset($_FILES["hinh_anh"]) && $_FILES["hinh_anh"]["name"] != "") {
    $duongdan = "./anhtin/";
    $duongdan = $duongdan . basename($_FILES["hinh_anh"]["name"]);
    if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $duongdan)) {
        $hinh_anh = $duongdan;
    } else {
        die("Không thể tải lên hình ảnh.");
    }
}

// Cập nhật thông tin vào cơ sở dữ liệu
$sql = "UPDATE hinh_anh SET ma_loai = '$ma_loai', hinh_anh = '$hinh_anh' WHERE ma_ha = '$ma_ha'";
$kq = mysqli_query($conn, $sql) or die("Không thể cập nhật: " . mysqli_error($conn));

// Hiển thị thông báo thành công và chuyển hướng về trang quản lý
echo "<script language=javascript>
        alert('Cập nhật hình ảnh loại phòng thành công!');
        window.location='QLHA.php';
      </script>";
?>
