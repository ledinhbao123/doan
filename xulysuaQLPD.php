<?php
include("ketnoi.php");

$ma_phieu_dat = $_POST["ma_phieu_dat"];
$ma_loai = $_POST["ma_loai"];
$ma_nv = $_POST["ma_nv"];
$ngay_dat = $_POST["ngay_dat"];
$ngay_nhan = $_POST["ngay_nhan"];
$ngay_tra = $_POST["ngay_tra"];
$so_luong_nguoi_lon = $_POST["so_luong_nguoi_lon"];
$so_luong_tre_em = $_POST["so_luong_tre_em"];
$so_luong_phong_dat = $_POST["so_luong_phong_dat"];
$tien_coc = $_POST["tien_coc"];
$tong_tien = $_POST["tong_tien"];

// Update academic department in the database
$sql = "UPDATE phieu_dat SET ma_loai = '$ma_loai', ma_nv = '$ma_nv', ngay_dat = '$ngay_dat', ngay_nhan = '$ngay_nhan', ngay_tra = '$ngay_tra', so_luong_nguoi_lon = '$so_luong_nguoi_lon', so_luong_tre_em = '$so_luong_tre_em', so_luong_phong_dat = '$so_luong_phong_dat', tien_coc = '$tien_coc', tong_tien = '$tong_tien' WHERE ma_phieu_dat = '$ma_phieu_dat'";
$kq = mysqli_query($conn, $sql) or die("Không thể cập nhật thông tin phiếu đặt: " . mysqli_error($conn));

echo "<script language=javascript>
        alert('Cập nhật thông tin phiếu đặt thành công!');
        window.location='QLPD.php';
    </script>";
?>
