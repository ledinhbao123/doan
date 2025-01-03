<?php
session_start();
include("ketnoi.php");
include("ghilog.php");

// Kiểm tra session đã đăng nhập hay chưa
if (!isset($_SESSION['ma_nv'])) {
    header("Location: login.php");
    exit();
}

$ten_vat_tu = $_POST["ten_vat_tu"];
$so_luong_tong = $_POST["so_luong_tong"];
$so_luong_su_dung = $_POST["so_luong_su_dung"];
$so_luong_ton = $_POST["so_luong_ton"];
$ma_nv = $_SESSION['ma_nv'];

// Thêm vật tư mới vào CSDL
$sql = "INSERT INTO vat_tu (ten_vat_tu, so_luong_tong, so_luong_su_dung, so_luong_ton) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("siii", $ten_vat_tu, $so_luong_tong, $so_luong_su_dung, $so_luong_ton);

if ($stmt->execute()) {
    // Ghi log hành động thêm vật tư
    $hanh_dong = "Thêm vật tư mới: $ten_vat_tu, tổng số lượng: $so_luong_tong, số lượng sử dụng: $so_luong_su_dung, số lượng tồn: $so_luong_ton";
    ghi_log($ma_nv, $hanh_dong);

    echo "<script language=javascript>
            alert('Thêm vật tư mới thành công!');
            window.location='QLVT.php';
          </script>";
} else {
    echo "Không thể thêm vật tư mới: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
