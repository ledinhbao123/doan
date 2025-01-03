<?php
include ("header.php");
include ("ketnoi.php");
?>

<link rel="stylesheet" href="css/chinhsua.css" type="text/css" />
<form enctype="multipart/form-data" action="xulythemQLCTVT.php" name="xulythemQLCTVT" method="post">

    <div class="text">
        <h4>
            THÊM CHI TIẾT VẬT TƯ MỚI
        </h4>
    </div>


    <div class="themmoi">
        <div class="them">
            <div class="thema">
                <span>Tên phòng</span>
                <select name="phong">
                    <?php
                    $sql = "SELECT ma_phong, ten_phong FROM phong";
                    $kq = mysqli_query($conn, $sql) or die("Không thể thêm phòng: " . mysqli_error($conn));
                    while ($row = mysqli_fetch_assoc($kq)) {
                        $ma_phong = $row['ma_phong'];
                        $ten_phong = $row['ten_phong'];
                        echo "<option value=\"$ma_phong\">$ten_phong</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="thema">
                <span>Vật tư</span>
                <select name="vat_tu">
                    <?php
                    $sql = "SELECT ma_vat_tu, ten_vat_tu FROM vat_tu";
                    $kq = mysqli_query($conn, $sql) or die("Không thể thêm vật tư: " . mysqli_error($conn));
                    while ($row = mysqli_fetch_assoc($kq)) {
                        $ma_vat_tu = $row['ma_vat_tu'];
                        $ten_vat_tu = $row['ten_vat_tu'];
                        echo "<option value=\"$ma_vat_tu\">$ten_vat_tu</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="them">
            <div class="thema">
                <span>Số lượng</span>
                <input type="number" name="so_luong_trong_phong" />
            </div>

            <div class="thema">
                <span>Tình trạng vật tư</span>
                <select name="tinh_trang">
                    <option value="Đang sử dụng">Đang sử dụng</option>
                    <option value="Đang sửa chữa">Đang sửa chữa</option>
                </select>
            </div>
        </div>
    </div>

    <div class="luulai">
        <input type="submit" name="them" value="Lưu lại" />
        <button type="button" onclick="window.location.href='QLCTVT.php'">Trở về</button>
    </div>

</form>
<!-- <style>
            .admin_tab >:nth-child(4){
                background-color: #3593D8;
                color: white;
            }
            </style> -->


<?php
include ("footer.php")
    ?>