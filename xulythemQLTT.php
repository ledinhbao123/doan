<?php
include("ketnoi.php");


if (isset($_POST["nhan_vien"], $_POST["ma_tin_tuc"], $_POST["ten_tin_tuc"], $_POST["noi_dung"], $_POST["hinh_anh"], $_POST["ngay_dang"], $_POST["trang_thai"])) {
$nhan_vien = $_POST["nhan_vien"];
$ma_tin_tuc= $_POST["ma_tin_tuc"];
$ten_tin_tuc= $_POST["ten_tin_tuc"];
$noi_dung = $_POST["noi_dung"];
$hinh_anh = $_POST["hinh_anh"];
$ngay_dang = $_POST["ngay_dang"];
$trang_thai = $_POST["trang_thai"];

$hinh_anh = ''; 

if ($_FILES["hinh_anh"]["name"] != "") {
    $duongdan = "./anhtin/";
    $duongdan = $duongdan . basename($_FILES["hinh_anh"]["name"]);
    if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $duongdan)) {
        $hinh_anh = $duongdan;
    } else {
        die("Không thể tải lên hình ảnh.");
    }
}

$sql = "INSERT INTO tin_tuc (ma_tin_tuc, ma_nv, ten_tin_tuc, noi_dung, hinh_anh, ngay_dang, trang_thai) VALUES ('$ma_tin_tuc', '$nhan_vien', '$ten_tin_tuc', '$noi_dung', '$hinh_anh', '$ngay_dang', '$trang_thai')";
$kq = mysqli_query($conn, $sql) or die("Không thể thêm bài đăng mới: " . mysqli_error($conn));
echo "<script language=javascript>
            alert('Thêm loại phòng mới thành công!');
            window.location.href = 'QLTT.php'; 
          </script>";
} else {
    echo "Các trường dữ liệu không được gửi đầy đủ từ form.";
}
?>
