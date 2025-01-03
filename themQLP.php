<?php
include ("header.php");
include ("ketnoi.php");
?>

<link rel="stylesheet" href="css/chinhsua.css" type="text/css" />
<form enctype="multipart/form-data" action="xulythemQLP.php" name="xulythemQLP" method="post">

    <div class="text">
        <h4>
            THÊM THÔNG TIN PHÒNG MỚI
        </h4>
    </div>


    <div class="themmoi">
 
        <div class="them">
            <div class="thema">
                <span>Loại phòng</span>
                <select name="loai_phong">
                    <?php
                    $sql = "SELECT ma_loai, ten_loai FROM loai_phong";
                    $kq = mysqli_query($conn, $sql) or die("Không thể thêm thông tin phòng mới: " . mysqli_error($conn));
                    while ($row = mysqli_fetch_assoc($kq)) {
                        $ma_loai = $row['ma_loai'];
                        $ten_loai = $row['ten_loai'];
                        echo "<option value=\"$ma_loai\">$ten_loai</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="thema">
                <span>Tên phòng</span>
                <input type="text" name="ten_phong" />
            </div>
        </div>

    </div>
    <div class="luulai">
        <input type="submit" name="luu" value="Lưu lại" />
        <button type="button" onclick="window.location.href='QLP.php'">Trở về</button>
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