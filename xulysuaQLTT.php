<?php
include("ketnoi.php");

$ma_tin_tuc = $_POST["ma_tin_tuc"];
$ma_nv = $_POST["ma_nv"];
$ten_tin_tuc = $_POST["ten_tin_tuc"];
$noi_dung = $_POST["noi_dung"];
$ngay_dang = $_POST["ngay_dang"];
$trang_thai = $_POST["trang_thai"];

// Lấy ảnh hiện tại từ cơ sở dữ liệu
$query = "SELECT hinh_anh FROM tin_tuc WHERE ma_tin_tuc = '$ma_tin_tuc'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$hinh_anh_hien_tai = $row['hinh_anh'];

// Khởi tạo biến hinh_anh
$hinh_anh = $hinh_anh_hien_tai;

if (isset($_FILES["hinh_anh"]) && $_FILES["hinh_anh"]["name"] != "") {
    $duongdan = "./anhtin/";
    $duongdan = $duongdan . basename($_FILES["hinh_anh"]["name"]);
    if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $duongdan)) {
        $hinh_anh = $duongdan;
    } else {
        die("Không thể tải lên hình ảnh.");
    }
}

$sql = "UPDATE tin_tuc SET ma_nv = '$ma_nv', ten_tin_tuc = '$ten_tin_tuc', noi_dung = '$noi_dung', hinh_anh = '$hinh_anh', ngay_dang = '$ngay_dang', trang_thai = '$trang_thai' WHERE ma_tin_tuc = '$ma_tin_tuc'";
$kq = mysqli_query($conn, $sql) or die("Không thể cập nhật bài đăng: " . mysqli_error($conn));

echo "<script language=javascript>
        alert('Cập nhật bài đăng thành công!');
         window.location='QLTT.php';
    </script>";
?>
