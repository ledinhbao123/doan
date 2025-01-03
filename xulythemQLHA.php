<?php
session_start();
include("ketnoi.php");
include("ghilog.php");

// Kiểm tra session đã đăng nhập hay chưa
if (!isset($_SESSION['ma_nv'])) {
    header("Location: login.php");
    exit();
}

if (isset($_FILES["hinh_anh"], $_POST["loai_phong"])) {
    $loai_phong = $_POST["loai_phong"];
    $ma_nv = $_SESSION['ma_nv'];

    $hinh_anh = '';

    if ($_FILES["hinh_anh"]["name"] != "") {
        $duongdan = "./anhtin/";
        $ten_file = basename($_FILES["hinh_anh"]["name"]);
        $duongdan = $duongdan . $ten_file;

        if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $duongdan)) {
            $hinh_anh = $duongdan;
        } else {
            die("Không thể tải lên hình ảnh.");
        }
    }

    // Thực hiện truy vấn SQL để thêm hình ảnh mới
    $sql = "INSERT INTO hinh_anh (hinh_anh, ma_loai) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $hinh_anh, $loai_phong);

        if ($stmt->execute()) {
            // Ghi log hành động thêm hình ảnh
            $hanh_dong = "Thêm hình ảnh mới cho loại phòng có mã: $loai_phong";
            ghi_log($ma_nv, $hanh_dong);

            echo "<script language=javascript>
                    alert('Thêm loại hình ảnh cho loại phòng thành công!');
                    window.location.href = 'QLHA.php'; 
                  </script>";
            exit();
        } else {
            echo "Không thể thêm hình ảnh: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Lỗi chuẩn bị câu lệnh SQL: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Các trường dữ liệu không được gửi đầy đủ từ form.";
}
?>
