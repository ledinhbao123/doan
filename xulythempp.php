<?php
session_start();
include("ketnoi.php");
include("ghilog.php");

// Kiểm tra session đã đăng nhập hay chưa
if (!isset($_SESSION['ma_nv'])) {
    header("Location: login.php");
    exit();
}
require 'vendor/autoload.php'; // Include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("ketnoi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ma_phieu_dat = $_POST['phieu_dat'];
    $ma_phong = $_POST['phong'];
    $ho_ten_nv = $_SESSION['ho_ten'] ?? '';
    $ngay_den = $_POST['ngay_den'];
    $thoi_gian_den = $_POST['thoi_gian_den'];
    $ngay_di = $_POST['ngay_di'];
    $thoi_gian_di = $_POST['thoi_gian_di'];
    $tong_tien = $_POST['tong_tien'];
    $so_tien_da_coc = $_POST['so_tien_da_coc'];
    $tong_so_tien_can_tra = $_POST['tong_so_tien_can_tra'];
    $so_tien_thuc_nhan = $_POST['so_tien_thuc_nhan'];
    $tinh_trang = $_POST['tinh_trang'];
    $phu_thu_den_truoc = (isset($_POST['nhan_phong_som_6_9']) ? '6h00 - 9h00, ' : '') . (isset($_POST['nhan_phong_som_9_12']) ? '9h00 - 12h00, ' : '');
    $so_tien_phu_thu_den_truoc = $_POST['so_tien_phu_thu_den_truoc'];
    $phu_thu_den_sau = (isset($_POST['tra_phong_muon_13_15']) ? '13h00 - 15h00, ' : '') . (isset($_POST['tra_phong_muon_15_18']) ? '15h00 - 18h00, ' : '') . (isset($_POST['tra_phong_muon_sau_18']) ? 'Sau 18h00, ' : '');
    $so_tien_phu_thu_den_sau = $_POST['so_tien_phu_thu_den_sau'];
    $gia_han_phong = $_POST['gia_han_phong'];
    $so_tien_gia_han_phong = $_POST['so_tien_gia_han_phong'];
    $chi_phi_phat_sinh = $_POST['chi_phi_phat_sinh'];
    $ghi_chu = $_POST['ghi_chu'];
    $ma_nv = $_SESSION['ma_nv'];
    // Loại bỏ dấu phẩy cuối cùng trong chuỗi phụ thu nếu có
    $phu_thu_den_truoc = rtrim($phu_thu_den_truoc, ', ');
    $phu_thu_den_sau = rtrim($phu_thu_den_sau, ', ');

    // Kiểm tra xem ho_ten_nv có trống không
    if (empty($ho_ten_nv)) {
        echo "Không tìm thấy mã nhân viên cho tên vì biến ho_ten_nv trống.";
        exit;
    }

    // Truy vấn mã khách hàng và mã loại phòng từ mã phiếu đặt
    $sql_get_ma_kh_ma_loai = "SELECT ma_kh, ma_loai FROM phieu_dat WHERE ma_phieu_dat = '$ma_phieu_dat'";
    $result = mysqli_query($conn, $sql_get_ma_kh_ma_loai);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $ma_kh = $row['ma_kh'];
        $ma_loai = $row['ma_loai'];

        // Truy vấn mã nhân viên từ họ tên nhân viên
        $sql_get_ma_nv = "SELECT ma_nv FROM nhan_vien WHERE ho_ten = '$ho_ten_nv'";
        $result_nv = mysqli_query($conn, $sql_get_ma_nv);

        if (mysqli_num_rows($result_nv) > 0) {
            $row_nv = mysqli_fetch_assoc($result_nv);
            $ma_nv = $row_nv['ma_nv'];

            // Truy vấn tên phòng từ mã phòng
            $sql_get_ten_phong = "SELECT ten_phong FROM phong WHERE ma_phong = '$ma_phong'";
            $result_phong = mysqli_query($conn, $sql_get_ten_phong);

            if (mysqli_num_rows($result_phong) > 0) {
                $row_phong = mysqli_fetch_assoc($result_phong);
                $ten_phong = $row_phong['ten_phong'];

                // Chèn dữ liệu vào bảng `o`
                $sql = "INSERT INTO `o` (
                        `ma_phieu_dat`, 
                        `ma_loai`, 
                        `ma_phong`, 
                        `ma_kh`, 
                        `ma_nv`, 
                        `ngay_den`, 
                        `thoi_gian_den`, 
                        `ngay_di`, 
                        `thoi_gian_di`, 
                        `tong_tien`, 
                        `so_tien_da_coc`, 
                        `tong_so_tien_can_tra`, 
                        `so_tien_thuc_nhan`, 
                        `tinh_trang`, 
                        `phu_thu_den_truoc`, 
                        `so_tien_phu_thu_den_truoc`, 
                        `phu_thu_den_sau`, 
                        `so_tien_phu_thu_den_sau`, 
                        `gia_han_phong`, 
                        `so_tien_gia_han_phong`, 
                        `chi_phi_phat_sinh`,
                        `ghi_chu`
                    ) VALUES (
                        '$ma_phieu_dat', 
                        '$ma_loai', 
                        '$ma_phong', 
                        '$ma_kh', 
                        '$ma_nv', 
                        '$ngay_den', 
                        '$thoi_gian_den', 
                        '$ngay_di', 
                        '$thoi_gian_di', 
                        '$tong_tien', 
                        '$so_tien_da_coc', 
                        '$tong_so_tien_can_tra', 
                        '$so_tien_thuc_nhan', 
                        '$tinh_trang', 
                        '$phu_thu_den_truoc', 
                        '$so_tien_phu_thu_den_truoc', 
                        '$phu_thu_den_sau', 
                        '$so_tien_phu_thu_den_sau', 
                        '$gia_han_phong', 
                        '$so_tien_gia_han_phong', 
                        '$chi_phi_phat_sinh',
                        '$ghi_chu'
                    )";

                if (mysqli_query($conn, $sql)) {
                    // Nếu tình trạng = "Đã phân phòng", gửi mail thông báo
                    if ($tinh_trang == "Đã phân phòng") {
                        $sql_update_trang_thai="UPDATE phong SET trang_thai='1' WHERE ma_phong='".$ma_phong."'";
                        // Truy vấn email khách hàng từ mã khách hàng
                        $sql_get_email_kh = "SELECT emailkh FROM khach_hang WHERE ma_kh = '$ma_kh'";
                        $result_email = mysqli_query($conn, $sql_get_email_kh);

                        if (mysqli_num_rows($result_email) > 0 && mysqli_query($conn, $sql_update_trang_thai)) {
                            $row_email = mysqli_fetch_assoc($result_email);
                            $email_kh = $row_email['emailkh'];

                            // Gửi email
                            $mail = new PHPMailer(true);
                            try {
                                //Server settings
                                $mail->isSMTP();
                                $mail->Host       = 'smtp.gmail.com'; // SMTP server của bạn
                                $mail->SMTPAuth   = true;
                                $mail->Username   = 'hihilife22@gmail.com'; // SMTP username
                                $mail->Password   = 'uqit tekx pvlf aeij'; // SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port       = 587;
                        
                                //Recipients
                                $mail->setFrom('hihilife22@gmail.com', 'THE ROSE HOTEL');
                                $mail->addAddress($email_kh); 
                        
                                // Content
                                $mail->isHTML(true);
                                $mail->CharSet = 'UTF-8'; // Đảm bảo sử dụng UTF-8
                                $mail->Subject = 'Thông báo phân phòng';
                                $mail->Body = "Kính chào quý khách,<br><br>Phòng của quý khách đã được phân. Thông tin chi tiết:<br><br>";
                                $mail->Body .= "Mã phiếu đặt: $ma_phieu_dat<br>";
                                $mail->Body .= "Tên phòng: $ten_phong<br>";
                                $mail->Body .= "Ngày nhận phòng: $ngay_den<br>";
                                $mail->Body .= "Quý khách vui lòng mang CCCD để checkin khi nhận phòng. Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi.";

                                $mail->send();
                            } catch (Exception $e) {
                                echo "Gửi email không thành công. Lỗi: {$mail->ErrorInfo}";
                            }
                        }
                    }

                    echo "<script language=javascript>
                        alert('Đã phòng thành công!');
                        window.location.href = 'phanphong.php';
                    </script>";
                } else {
                    echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Không tìm thấy tên phòng cho mã phòng: $ma_phong";
            }
        } else {
            echo "Không tìm thấy mã nhân viên cho tên: $ho_ten_nv";
        }
    } else {
        echo "Không tìm thấy mã khách hàng hoặc mã loại phòng cho mã phiếu đặt: $ma_phieu_dat";
    }

    mysqli_close($conn);
}
?>
