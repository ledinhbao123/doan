<?php
include ("headertc.php");
?>
<link rel="stylesheet" href="css/tintuc.css" />
<div class="khung-chua">
    <div class="image-bia">
        <img class="img-bia" src="anhtin/a1.jpg" />
    </div>
    <?php
    // Kết nối đến cơ sở dữ liệu
    include 'ketnoi.php';

    // Lấy mã tin tức từ URL
    if (isset($_GET['ma_tin_tuc'])) {
        $ma_tin_tuc = $_GET['ma_tin_tuc'];

        // Truy vấn dữ liệu từ bảng tin_tuc theo mã tin tức
        $sql = "SELECT ma_tin_tuc, ten_tin_tuc, noi_dung, hinh_anh, ngay_dang FROM tin_tuc WHERE ma_tin_tuc = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ma_tin_tuc);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra và hiển thị kết quả
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '
            <div class="frame-tin1">
                <div class="frame1">
                    <div class="frame-tin2">
                        <div class="fr-hinh1">
                            <img class="hinh-tin1" src="' . $row["hinh_anh"] . '" />
                        </div>
                        <div class="fr-thongtin1">
                            <label class="tieude1">' . $row["ten_tin_tuc"] . '</label>
                            <label class="noidung1">
                                <p>' . $row["noi_dung"] . '</p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>';
        } else {
            echo "Không tìm thấy tin tức nào.";
        }

        // Đóng kết nối
        $stmt->close();
    } else {
        echo "Không có mã tin tức.";
    }

    $conn->close();
    ?>
    <div class="phone-button">
        <a href="tel:+0903345615">
            <i class="fa-solid fa-phone"></i>0903 345 615
        </a>
    </div>
</div>
<?php
include("footertc.php");
?>
