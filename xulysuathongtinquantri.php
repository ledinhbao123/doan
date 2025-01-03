<?php
session_start();

if (!isset($_SESSION['ma_nv'])) {
    header('Location: login.php');
    exit;
}

include("ketnoi.php");

$ma_nv = $_SESSION['ma_nv'];
$ho_ten = $_POST["ho_ten"];
$gioi_tinh = $_POST["gioi_tinh"];
$cccd = $_POST["cccd"];
$ngay_sinh= $_POST["ngay_sinh"];
$sdtnv = $_POST["sdtnv"];
$dia_chi = $_POST["dia_chi"];
$pass = $_POST["pass"];
$user = $_POST["user"];

$sql = "UPDATE nhan_vien SET ho_ten = ?, gioi_tinh = ? ,cccd = ?, ngay_sinh= ?, sdtnv = ?, dia_chi = ?, pass = ?, user = ? WHERE ma_nv = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $ho_ten, $gioi_tinh, $cccd, $ngay_sinh, $sdtnv, $dia_chi, $pass, $user, $ma_nv);

if ($stmt->execute()) {
    echo "<script language=javascript>
        alert('Cập nhật thông tin cá nhân thành công!');
        window.location='thongtinquantri.php';
    </script>";
} else {
    echo "Không thể cập nhật thông tin: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
