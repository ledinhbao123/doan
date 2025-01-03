<?php
session_start();
include("ketnoi.php");
include("ghilog.php");

// Kiểm tra session đã đăng nhập hay chưa
if (!isset($_SESSION['ma_nv'])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra các biến từ form được gửi đi
if (isset($_POST["loai_phong"], $_POST["ten_phong"])) {
    $loai_phong = $_POST["loai_phong"];
    $ten_phong = $_POST["ten_phong"];
    $ma_nv = $_SESSION['ma_nv'];

    // Thêm thông tin phòng vào CSDL
    $sql = "INSERT INTO phong (ma_loai, ten_phong) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $loai_phong, $ten_phong);

    if ($stmt->execute()) {
        // Ghi log hành động thêm thông tin phòng
        $hanh_dong = "Thêm thông tin phòng mới: Loại phòng $loai_phong, Tên phòng $ten_phong";
        ghi_log($ma_nv, $hanh_dong);

        echo "<script language=javascript>
                alert('Thêm thông tin phòng mới thành công!');
                window.location.href = 'QLP.php'; 
              </script>";
    } else {
        echo "Không thể thêm thông tin phòng mới: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Các trường dữ liệu không được gửi đầy đủ từ form.";
}
?>
