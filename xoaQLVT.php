<?php
session_start();
include("ketnoi.php");
include("ghilog.php");

// Kiểm tra session đã đăng nhập hay chưa
if (!isset($_SESSION['ma_nv'])) {
    header("Location: login.php");
    exit();
}

$user_xoa = $_REQUEST["user"]; // Lấy mã vật tư cần xóa từ request

// Lấy thông tin vật tư trước khi xóa
$sql_select = "SELECT ten_vat_tu, so_luong_tong, so_luong_su_dung, so_luong_ton FROM vat_tu WHERE ma_vat_tu = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("s", $user_xoa);
$stmt_select->execute();
$stmt_select->store_result();

if ($stmt_select->num_rows == 1) {
    $stmt_select->bind_result($ten_vat_tu, $so_luong_tong, $so_luong_su_dung, $so_luong_ton);
    $stmt_select->fetch();

    // Thực hiện xóa vật tư
    $sql_delete = "DELETE FROM vat_tu WHERE ma_vat_tu = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("s", $user_xoa);

    if ($stmt_delete->execute()) {
        // Ghi log hành động xóa vật tư
        $ma_nv = $_SESSION['ma_nv'];
        $hanh_dong = "Xóa vật tư: $ten_vat_tu, tổng số lượng: $so_luong_tong, số lượng sử dụng: $so_luong_su_dung, số lượng tồn: $so_luong_ton";
        ghi_log($ma_nv, $hanh_dong);

        echo "<script language=javascript>
                alert('Xóa vật tư thành công');
                window.location='QLVT.php';
              </script>";
    } else {
        echo "Không thể xóa vật tư: " . $stmt_delete->error;
    }

    $stmt_delete->close();
} else {
    echo "Không tìm thấy vật tư cần xóa.";
}

$stmt_select->close();
$conn->close();
?>
