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
$thiet_bi = $_POST["thiet_bi"];
$so_luong_trong_phong = $_POST["so_luong_trong_phong"];
$tinh_trang = $_POST["tinh_trang"];
$ma_nv = $_SESSION['ma_nv'];

// Thêm chi tiết thiết bị vào CSDL
$sql = "INSERT INTO chi_tiet_thiet_bi (ma_phong, ma_thiet_bi, so_luong_trong_phong, tinh_trang) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssis", $phong, $thiet_bi, $so_luong_trong_phong, $tinh_trang);

    if ($stmt->execute()) {
        // Ghi log hành động thêm chi tiết thiết bị
        $hanh_dong = "Thêm chi tiết thiết bị vào phòng $phong: Thiết bị $thiet_bi, Số lượng: $so_luong_trong_phong";
        ghi_log($ma_nv, $hanh_dong);

        // Cập nhật số lượng thiết bị sử dụng và tồn kho
        $sql_update = "UPDATE thiet_bi 
                       SET 
                       so_luong_su_dung = so_luong_su_dung + ?,
                       so_luong_ton = so_luong_ton - ?
                       WHERE ma_thiet_bi = ?";
        $stmt_update = $conn->prepare($sql_update);

        if ($stmt_update) {
            $stmt_update->bind_param("iis", $so_luong_trong_phong, $so_luong_trong_phong, $thiet_bi);

            if ($stmt_update->execute()) {
                // Cập nhật thành công
            } else {
                echo "Không thể cập nhật thiết bị: " . $stmt_update->error;
            }

            $stmt_update->close();
        } else {
            echo "Lỗi chuẩn bị câu lệnh SQL: " . $conn->error;
        }

        echo "<script language=javascript>
        alert('Thêm chi tiết thiết bị mới thành công!');
        window.location.href = 'QLCTTB.php'; 
      </script>";
        exit();
    } else {
        echo "Không thể thêm chi tiết thiết bị: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Lỗi chuẩn bị câu lệnh SQL: " . $conn->error;
}

$conn->close();

?>
