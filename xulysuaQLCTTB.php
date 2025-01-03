<?php
include("ketnoi.php");

$ma_cttb = $_POST["ma_cttb"];
$ma_phong = $_POST["ma_phong"];
$ma_thiet_bi = $_POST["ma_thiet_bi"];
$so_luong_trong_phong = $_POST["so_luong_trong_phong"];
$tinh_trang = $_POST["tinh_trang"];

// Lấy thông tin số lượng trong phòng cũ để cập nhật lại thiet_bi
$sql_select_old_qty = "SELECT so_luong_trong_phong, ma_thiet_bi FROM chi_tiet_thiet_bi WHERE ma_cttb = '$ma_cttb'";
$result_old_qty = mysqli_query($conn, $sql_select_old_qty);
if ($result_old_qty) {
    $row_old_qty = mysqli_fetch_assoc($result_old_qty);
    $so_luong_trong_phong_cu = $row_old_qty['so_luong_trong_phong'];
    $ma_thiet_bi_cu = $row_old_qty['ma_thiet_bi'];

    // Cập nhật chi tiết thiết bị
    $sql_update_cttb = "UPDATE chi_tiet_thiet_bi 
                        SET ma_phong = '$ma_phong', ma_thiet_bi = '$ma_thiet_bi', so_luong_trong_phong = '$so_luong_trong_phong', tinh_trang = '$tinh_trang' 
                        WHERE ma_cttb = '$ma_cttb'";
    $kq_update_cttb = mysqli_query($conn, $sql_update_cttb) or die("Không thể cập nhật thông tin chi tiết thiết bị: " . mysqli_error($conn));

    // Cập nhật số lượng tồn và số lượng sử dụng trong thiet_bi
    if ($ma_thiet_bi != $ma_thiet_bi_cu) {
        // Nếu thiết bị đã thay đổi, cần cập nhật cả thiết bị cũ và mới
        $sql_update_old_tb = "UPDATE thiet_bi 
                              SET so_luong_su_dung = so_luong_su_dung - $so_luong_trong_phong_cu,
                                  so_luong_ton = so_luong_tong - so_luong_su_dung 
                              WHERE ma_thiet_bi = '$ma_thiet_bi_cu'";
        $kq_update_old_tb = mysqli_query($conn, $sql_update_old_tb) or die("Không thể cập nhật thiết bị cũ: " . mysqli_error($conn));

        $sql_update_new_tb = "UPDATE thiet_bi 
                              SET so_luong_su_dung = so_luong_su_dung + $so_luong_trong_phong,
                                  so_luong_ton = so_luong_tong - so_luong_su_dung 
                              WHERE ma_thiet_bi = '$ma_thiet_bi'";
        $kq_update_new_tb = mysqli_query($conn, $sql_update_new_tb) or die("Không thể cập nhật thiết bị mới: " . mysqli_error($conn));
    } else {
        // Nếu chỉ cập nhật số lượng trong phòng của thiết bị hiện tại
        $sql_update_tb = "UPDATE thiet_bi 
                          SET so_luong_su_dung = so_luong_su_dung - $so_luong_trong_phong_cu + $so_luong_trong_phong,
                              so_luong_ton = so_luong_tong - so_luong_su_dung 
                          WHERE ma_thiet_bi = '$ma_thiet_bi'";
        $kq_update_tb = mysqli_query($conn, $sql_update_tb) or die("Không thể cập nhật thiết bị: " . mysqli_error($conn));
    }

    echo "<script language=javascript>
            alert('Cập nhật thông tin chi tiết thiết bị thành công!');
            window.location='QLCTTB.php';
        </script>";
} else {
    echo "Không tìm thấy thông tin chi tiết thiết bị cũ.";
}
?>
