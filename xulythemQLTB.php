<?php
session_start();
include("ketnoi.php");
include("ghilog.php");

if (!isset($_SESSION['ma_nv'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["ten_thiet_bi"], $_POST["so_luong_tong"], $_POST["so_luong_su_dung"], $_POST["so_luong_ton"])) {
    $ten_thiet_bi = trim($_POST["ten_thiet_bi"]);
    $so_luong_tong = $_POST["so_luong_tong"];
    $so_luong_su_dung = $_POST["so_luong_su_dung"];
    $so_luong_ton = $_POST["so_luong_ton"];
    $ma_nv = $_SESSION['ma_nv'];

    if (empty($ten_thiet_bi)) {
        echo "<script language=javascript>
                alert('Tên thiết bị không được để trống!');
                window.location.href = 'QLTB.php'; 
              </script>";
        exit();
    }

    if (empty($so_luong_tong) || !is_numeric($so_luong_tong)) {
        echo "<script language=javascript>
                alert('Tổng số lượng không được để trống và phải là số!');
                window.location.href = 'QLTB.php'; 
              </script>";
        exit();
    }

    $sql = "INSERT INTO thiet_bi (ten_thiet_bi, so_luong_tong, so_luong_su_dung, so_luong_ton) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $ten_thiet_bi, $so_luong_tong, $so_luong_su_dung, $so_luong_ton);

    if ($stmt->execute()) {
        $hanh_dong = "Thêm thiết bị mới: $ten_thiet_bi, tổng số lượng: $so_luong_tong, số lượng sử dụng: $so_luong_su_dung, số lượng tồn: $so_luong_ton";
        ghi_log($ma_nv, $hanh_dong);

        echo "<script language=javascript>
                alert('Thêm thiết bị mới thành công!');
                window.location.href = 'QLTB.php'; 
              </script>";
    } else {
        echo "Không thể thêm thiết bị mới: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Các trường dữ liệu không được gửi đầy đủ từ form.";
}
?>
