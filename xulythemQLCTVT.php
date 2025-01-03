<?php
session_start();
include("ketnoi.php");
include("ghilog.php");

// Kiểm tra session đã đăng nhập hay chưa
if (!isset($_SESSION['ma_nv'])) {
    header("Location: login.php");
    exit();
}

$phong = $_POST["phong"];
$vat_tu = $_POST["vat_tu"];
$so_luong_trong_phong = $_POST["so_luong_trong_phong"];
$tinh_trang = $_POST["tinh_trang"];
$ma_nv = $_SESSION['ma_nv'];

// Thêm chi tiết vật tư
$sql = "INSERT INTO chi_tiet_vat_tu (ma_phong, ma_vat_tu, so_luong_trong_phong, tinh_trang) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $phong, $vat_tu, $so_luong_trong_phong, $tinh_trang);

if ($stmt->execute()) {
    // Ghi log hành động thêm chi tiết vật tư
    $hanh_dong = "Thêm chi tiết vật tư cho phòng: $phong, vật tư: $vat_tu, số lượng: $so_luong_trong_phong";
    ghi_log($ma_nv, $hanh_dong);

    // Cập nhật vật tư
    $sql_update = "UPDATE vat_tu 
                   SET 
                   so_luong_su_dung = so_luong_su_dung + ?,
                   so_luong_ton = so_luong_ton - so_luong_su_dung
                   WHERE ma_vat_tu = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("is", $so_luong_trong_phong, $vat_tu);

    if ($stmt_update->execute()) {
        echo "<script language=javascript>
                alert('Thêm chi tiết vật tư thành công!');
                window.location='QLCTVT.php';
              </script>";
    } else {
        echo "Không thể cập nhật vật tư: " . $stmt_update->error;
    }

    $stmt_update->close();
} else {
    echo "Không thể thêm chi tiết vật tư: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

