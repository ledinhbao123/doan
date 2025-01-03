<?php
include ("header.php");
include ("ketnoi.php");
?>

<link rel="stylesheet" href="css/chinhsua.css" type="text/css" />
<form enctype="multipart/form-data" action="xulythemQLCTTB.php" name="xulythemQLCTTB" method="post">

    <div class="text">
        <h4>
            THÊM CHI TIẾT THIẾT BỊ MỚI
        </h4>
    </div>


    <div class="themmoi">
        <div class="them">
            <!-- <div class="thema">
                <span>STT</span>
                <input type="text" readonly name="ma_cttb" />
            </div> -->

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
                <span>Thiết bị</span>
                <select name="thiet_bi">
                    <?php
                    $sql = "SELECT ma_thiet_bi, ten_thiet_bi FROM thiet_bi";
                    $kq = mysqli_query($conn, $sql) or die("Không thể thêm thiết bị: " . mysqli_error($conn));
                    while ($row = mysqli_fetch_assoc($kq)) {
                        $ma_thiet_bi = $row['ma_thiet_bi'];
                        $ten_thiet_bi = $row['ten_thiet_bi'];
                        echo "<option value=\"$ma_thiet_bi\">$ten_thiet_bi</option>";
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
                <span>Tình trạng thiết bị</span>
                <select name="tinh_trang">
                    <option value="Đang sử dụng">Đang sử dụng</option>
                    <option value="Đang sửa chữa">Đang sửa chữa</option>
                </select>
            </div>
        </div>
    </div>

    <div class="luulai">
        <input type="submit" name="them" value="Lưu lại" />
        <button type="button" onclick="window.location.href='QLCTTB.php'">Trở về</button>
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