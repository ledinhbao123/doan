<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('ketnoi.php');

if (!isset($_SESSION['ma_kh'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header('Location: login.php');
    exit;
}

// Lấy thông tin chi tiết phiếu đặt từ URL
if (isset($_GET['user'])) {
    $ma_phieu_dat = $_GET['user'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin chi tiết phiếu đặt
    $sql = "SELECT pd.*, lp.ten_loai, lp.anh_loai_phong, kh.ho_ten
            FROM phieu_dat pd
            JOIN loai_phong lp ON pd.ma_loai = lp.ma_loai
            JOIN khach_hang kh ON pd.ma_kh = kh.ma_kh
            WHERE pd.ma_phieu_dat = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Lỗi chuẩn bị truy vấn: " . $conn->error;
        exit;
    }
    $stmt->bind_param("s", $ma_phieu_dat);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ho_ten = $row['ho_ten'];
        $ten_loai = $row['ten_loai'];
        $anh_loai_phong = $row['anh_loai_phong'];
        $ngay_dat = $row['ngay_dat'];
        $ngay_nhan = $row['ngay_nhan'];
        $ngay_tra = $row['ngay_tra'];
        $so_luong_nguoi_lon = $row['so_luong_nguoi_lon'];
        $so_luong_tre_em = $row['so_luong_tre_em'];
        $so_luong_tre_em_duoi_6 = $row['so_luong_tre_em_duoi_6'];
        $so_luong_tre_em_tren_6 = $row['so_luong_tre_em_tren_6'];
        $phu_thu_tre_em = $row['phu_thu_tre_em'];
        $so_luong_phong_dat = $row['so_luong_phong_dat'];
        $tien_coc = $row['tien_coc'];
        $tong_tien = $row['tong_tien'];
        $trang_thai = $row['trang_thai'];
    } else {
        echo "Không tìm thấy thông tin chi tiết phiếu đặt.";
        exit;
    }
    $stmt->close();
} else {
    echo "Không có thông tin chi tiết phiếu đặt.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Rose Hotel - The Rose Hotel</title>
    <style>
        .details-container {
            background-color: #FEFAF6;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .details-container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .details-container h2 {
            margin-bottom: 20px;
        }
        .details-container p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="details-container">
        <h2>Chi tiết phiếu đặt</h2>
        <img src="<?php echo $anh_loai_phong; ?>" alt="Hình ảnh loại phòng">
        <p><strong>Tên khách hàng:</strong> <?php echo $ho_ten; ?></p>
        <p><strong>Loại phòng:</strong> <?php echo $ten_loai; ?></p>
        <p><strong>Ngày đặt phòng:</strong> <?php echo date('d/m/Y', strtotime($ngay_dat)); ?></p>
        <p><strong>Ngày nhận phòng:</strong> <?php echo date('d/m/Y', strtotime($ngay_nhan)); ?></p>
        <p><strong>Ngày trả phòng:</strong> <?php echo date('d/m/Y', strtotime($ngay_tra)); ?></p>
        <p><strong>Số lượng người lớn:</strong> <?php echo $so_luong_nguoi_lon; ?></p>
        <p><strong>Tổng số lượng trẻ em:</strong> <?php echo $so_luong_tre_em; ?></p>
        <p><strong>Số lượng trẻ em dưới 6 tuổi:</strong> <?php echo $so_luong_tre_em_duoi_6; ?></p>
        <p><strong>Trẻ lượng trẻ em trên 6 tuổi:</strong> <?php echo $so_luong_tre_em_tren_6; ?></p>
        <p><strong>Số tiền phụ thu trẻ trên 6 tuổi</strong> <?php echo $phu_thu_tre_em; ?></p>
        <p><strong>Số lượng phòng đặt:</strong> <?php echo $so_luong_phong_dat; ?></p>
        <p><strong>Tổng số tiền:</strong> <?php echo $tong_tien; ?></p>
        <p><strong>Số tiền đã cọc:</strong> <?php echo $tien_coc; ?></p>
        <p><strong>Trạng thái:</strong> <?php echo $trang_thai; ?></p>
    </div>
</body>
</html>
