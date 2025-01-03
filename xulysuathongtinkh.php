<?php
session_start();

if (!isset($_SESSION['ma_kh'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header('Location: login.php');
    exit;
}

include("ketnoi.php");

$ma_kh = $_SESSION['ma_kh'];
$ho_ten = $_POST["ho_ten"];
$gioi_tinh = $_POST["gioi_tinh"];
$cccd = $_POST["cccd"];
$sdtkh = $_POST["sdtkh"];
$dia_chi = $_POST["dia_chi"];
$emailkh = $_POST["emailkh"];
$matkhaukh = $_POST["matkhaukh"];

// Update thông tin khách hàng trong cơ sở dữ liệu
$sql = "UPDATE khach_hang SET ho_ten = ?, gioi_tinh = ?, cccd = ?, sdtkh = ?, dia_chi = ?, emailkh = ?, matkhaukh = ? WHERE ma_kh = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $ho_ten, $gioi_tinh, $cccd, $sdtkh, $dia_chi, $emailkh, $matkhaukh, $ma_kh);

if ($stmt->execute()) {
    echo "<script language=javascript>
        alert('Cập nhật thông tin cá nhân thành công!');
        window.location='thongtinkhach.php';
    </script>";
} else {
    echo "Không thể cập nhật thông tin: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
