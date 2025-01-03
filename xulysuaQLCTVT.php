<?php
include("ketnoi.php");

$ma_ctvt = $_POST["ma_ctvt"];
$ma_phong = $_POST["ma_phong"];
$ma_vat_tu = $_POST["ma_vat_tu"];
$so_luong_trong_phong = $_POST["so_luong_trong_phong"];
$tinh_trang = $_POST["tinh_trang"];

// Lấy thông tin số lượng trong phòng cũ để cập nhật lại vat_tu
$sql_select_old_qty = "SELECT so_luong_trong_phong, ma_vat_tu FROM chi_tiet_vat_tu WHERE ma_ctvt = '$ma_ctvt'";
$result_old_qty = mysqli_query($conn, $sql_select_old_qty);
if ($result_old_qty) {
    $row_old_qty = mysqli_fetch_assoc($result_old_qty);
    $so_luong_trong_phong_cu = $row_old_qty['so_luong_trong_phong'];
    $ma_vat_tu_cu = $row_old_qty['ma_vat_tu'];

    // Cập nhật chi tiết vật tư
    $sql_update_ctvt = "UPDATE chi_tiet_vat_tu 
                        SET ma_phong = '$ma_phong', ma_vat_tu = '$ma_vat_tu', so_luong_trong_phong = '$so_luong_trong_phong', tinh_trang = '$tinh_trang' 
                        WHERE ma_ctvt = '$ma_ctvt'";
    $kq_update_ctvt = mysqli_query($conn, $sql_update_ctvt) or die("Không thể cập nhật thông tin chi tiết vật tư: " . mysqli_error($conn));

    // Cập nhật số lượng tồn và số lượng sử dụng 
    if ($ma_vat_tu != $ma_vat_tu_cu) {
        // Cập nhật cả vật tư cũ và mới
        $sql_update_old_vt = "UPDATE vat_tu 
                              SET so_luong_su_dung = so_luong_su_dung - $so_luong_trong_phong_cu,
                                  so_luong_ton = so_luong_tong - so_luong_su_dung 
                              WHERE ma_vat_tu = '$ma_vat_tu_cu'";
        $kq_update_old_vt = mysqli_query($conn, $sql_update_old_vt) or die("Không thể cập nhật vật tư cũ: " . mysqli_error($conn));

        $sql_update_new_vt = "UPDATE vat_tu 
                              SET so_luong_su_dung = so_luong_su_dung + $so_luong_trong_phong,
                                  so_luong_ton = so_luong_tong - so_luong_su_dung 
                              WHERE ma_vat_tu = '$ma_vat_tu'";
        $kq_update_new_vt = mysqli_query($conn, $sql_update_new_vt) or die("Không thể cập nhật vật tư mới: " . mysqli_error($conn));
    } else {
        // Cập nhật số lượng trong phòng hiện tại
        $sql_update_vt = "UPDATE vat_tu 
                          SET so_luong_su_dung = so_luong_su_dung - $so_luong_trong_phong_cu + $so_luong_trong_phong,
                              so_luong_ton = so_luong_tong - so_luong_su_dung 
                          WHERE ma_vat_tu = '$ma_vat_tu'";
        $kq_update_vt = mysqli_query($conn, $sql_update_vt) or die("Không thể cập nhật vật tư: " . mysqli_error($conn));
    }

    echo "<script language=javascript>
            alert('Cập nhật thông tin chi tiết vật tư thành công!');
            window.location='QLCTVT.php';
        </script>";
} else {
    echo "Không tìm thấy thông tin chi tiết vật tư cũ.";
}
?>
