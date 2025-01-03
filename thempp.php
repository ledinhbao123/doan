<style>
    .text {
        height: 60px;
        font-size: medium;
        display: flex;
        /* flex-direction: column; */
        margin-top: 40px;
        gap: 15px;
        justify-content: center;
    }

    .text h4 {
        font-family: Tahoma;
        background-color: #F5F5F5;
        font-size: large;
        width: 90%;
        padding: 10px 30px;
        display: flex;
        align-items: center;
        color: #40679E;
        font-weight: bold;
    }

    .themtong {
        margin-top: 20px;
        background: #F5F5F5;
        display: flex;
        flex-direction: column;
        /* align-items: center; */
        justify-content: center;
        /* border: 2px solid #F5F5F5; */
        width: 90%;
        margin: 20px auto;
        gap: 20px;
        padding: 40px;
        border-radius: 5px;
    }

    .themmoi {
        gap: 100px;
        display: flex;
        justify-content: center;
    }

    .themm {
        display: flex;
        flex-direction: column;
        gap: 20px;

    }

    .thema {
        display: flex;
        flex-direction: column;
        gap: 5px;

    }

    input[type="text" i] {
        height: 40px;
        border: 1px solid #40679E;
        border-radius: 3px;
        color: black;
        width: 350px;
        padding-left: 7px;
    }

    input[type="time" i] {
        height: 40px;
        border: 1px solid #40679E;
        border-radius: 3px;
        color: black;
        width: 350px;
        padding-left: 7px;
    }

    .thema>select {
        height: 40px;
        border: 1px solid #40679E;
        border-radius: 3px;
        color: black;
        width: 350px;
        padding-left: 7px;
    }

    .thema>span {
        color: #40679E;
        font-weight: 600;
        font-size: large;
    }

    .luulai {
        display: flex;
        gap: 30px;
        justify-content: center;
        align-items: center;
        padding: 10px 20px;

    }

    .themmm {
        display: flex;
        margin-left: 86px;
        gap: 100px;
    }

    .luulai input {
        margin-top: 5px;
        width: 80px;
        padding: 5px 10px;
        color: #fafafa;
        background-color: #65B741;
        border: 1px solid white;
        font-weight: bolder;
        border-radius: 3px;
        font-size: large;
    }

    .luulai button {
        margin-top: 5px;
        width: 80px;
        padding: 5px 10px;
        color: #fafafa;
        background-color: #FFC100;
        border: 1px solid white;
        font-weight: bolder;
        border-radius: 3px;
        font-size: large;
    }

    .themaa {
        font-size: large;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .checkbox {
        display: flex;
        gap: 78px;
        justify-content: center;
    }
.themmmm{
    display: flex;
    gap: 99px;
}
    .checkboxx {
        gap: 96px;
        margin-left: 152px;
        display: flex;
    }

    .themmoii {
        margin-left: 67px;
    }

    .nhanphong {
        display: flex;
        gap: 16px;
        flex-direction: column;

    }

    .nhanphong>span {
        color: #40679E;
        font-weight: 600;
        font-size: large;
    }

    input[type="checkbox"] {
        height: 20px;
        width: 20px;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <?php
    include ("header.php");
    include ("ketnoi.php");
    ?>

    <form enctype="multipart/form-data" action="xulythempp.php" name="xulythempp" method="post">
        <div class="text">
            <h4>PHÂN PHÒNG</h4>
        </div>

        <div class="themtong">
            <div class="themmoi">
                <div class="themm">
                    <div class="thema">
                        <span>Mã phiếu đặt</span>
                        <select name="phieu_dat" id="phieu_dat">
                            <option value="" disabled selected>Vui lòng chọn mã phiếu</option>
                            <?php
                            // $sql = "SELECT ma_phieu_dat FROM phieu_dat";
                            $sql = "SELECT pd.*
                                FROM phieu_dat pd
                                LEFT JOIN (SELECT ma_phieu_dat, COUNT(ma_o) AS so_luong_phan FROM o GROUP BY ma_phieu_dat) pp ON pd.ma_phieu_dat = pp.ma_phieu_dat WHERE pd.so_luong_phong_dat > IFNULL(pp.so_luong_phan, 0);";
                            $kq = mysqli_query($conn, $sql) or die("Không thể thêm thông tin: " . mysqli_error($conn));
                            while ($row = mysqli_fetch_assoc($kq)) {
                                $ma_phieu_dat = $row['ma_phieu_dat'];
                                echo "<option value=\"$ma_phieu_dat\">$ma_phieu_dat</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="themm">
                    <div class="thema">
                        <span>Nhân viên xác nhận</span>
                        <input type="text" name="ho_ten_nhan_vien" id="nhan_vien_xac_nhan"
                            value="<?php echo $_SESSION['ho_ten']; ?>" readonly />
                    </div>
                </div>
            </div>
            <div class="themmoi">
                <div class="thema">
                    <span>Họ tên khách hàng</span>
                    <input style="width:800px;" type="text" name="ho_ten_khach_hang" id="ho_ten_khach_hang" readonly />
                </div>
            </div>
            <!--  -->
            <div class="themmoi">
                <div class="thema">
                    <span>Loại phòng</span>
                    <input style="width:800px;" type="text" name="loai_phong" id="loai_phong" readonly />
                </div>
            </div>
            <div class="themmoi">
                <div class="thema">
                    <span>Tên phòng</span>
                    <select style="width:800px;" name="phong" id="phong">
                        <option value="">-- Chọn phòng --</option>
                        <?php
                        $sql = "SELECT p.ma_phong, p.ten_phong, lp.ten_loai 
                FROM phong p 
                JOIN loai_phong lp ON p.ma_loai = lp.ma_loai
                WHERE trang_thai='0'";
                        $kq = mysqli_query($conn, $sql) or die("Không thể thêm thông tin: " . mysqli_error($conn));
                        while ($row = mysqli_fetch_assoc($kq)) {
                            $ma_phong = $row['ma_phong'];
                            $ten_phong = $row['ten_phong'];
                            $ten_loai = $row['ten_loai'];
                            echo "<option value=\"$ma_phong\">$ten_loai - $ten_phong</option>";
                        }
                        ?>
                    </select>

                </div>
            </div>
            <div class="themmoi">
                <div class="themmmm">
                    <div class="thema">
                        <span>Ngày nhận phòng</span>
                        <input type="text" name="ngay_den" id="ngay_den" readonly />
                    </div>
                    <div class="thema">
                        <span>Ngày trả phòng</span>
                        <input type="text" name="ngay_di" id="ngay_di" readonly />
                    </div>
                </div>
            </div>
            <div class="themm" style="display: none;">
                <div class="thema">
                    <span>Thời gian nhận phòng</span>
                    <input type="time" name="thoi_gian_den" id="thoi_gian_den" />
                </div>
                <div class="thema">
                    <span>Thời gian trả phòng</span>
                    <input type="time" name="thoi_gian_di" id="thoi_gian_di" />
                </div>
            </div>

            <div class="themmoiiii">
                <div class="themmm">
                    <div class="thema">
                        <span>Tổng số tiền</span>
                        <input type="text" name="tong_tien" id="tong_tien" readonly />
                    </div>
                    <div class="thema">
                        <span>Số tiền đã cọc</span>
                        <input type="text" name="so_tien_da_coc" id="so_tien_da_coc" readonly />
                    </div>
                </div>
            </div>
            <div class="themmoi">
                <div class="themm">
                    <div class="thema">
                        <span>Số tiền cần thanh toán</span>
                        <input type="text" name="tong_so_tien_can_tra" id="tong_so_tien_can_tra" readonly
                            style="width:800px;" />
                    </div>
                </div>
            </div>

            <div class="themmoi">
                <div class="thema">
                    <span>Tình trạng</span>
                    <select style="width:800px;" name="tinh_trang" id="tinh_trang">
                        <option value="Đã phân phòng">Đã phân phòng</option>
                        <option value="Đã nhận phòng">Đã nhận phòng</option>
                    
                    </select>
                </div>
            </div>

            <div class="themmoi" style="display: none;">
                <div class="thema">
                    <span>Gia hạn phòng (ngày)</span>
                    <select style="width: 800px;" name="gia_han_phong" id="gia_han_phong">
                        <option value="0">Không gia hạn</option>
                        <option value="1">1 ngày</option>
                        <option value="2">2 ngày</option>
                        <option value="3">3 ngày</option>
                        <option value="4">4 ngày</option>
                        <option value="5">5 ngày</option>
                        <option value="6">6 ngày</option>
                        <option value="7">7 ngày</option>
                        <option value="8">8 ngày</option>
                        <option value="9">9 ngày</option>
                        <option value="10">10 ngày</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

            </div>
            <div class="themmoi" style="display: none;">
                <div class="thema">
                    <span>Số tiền gia hạn phòng</span>
                    <input type="text" name="so_tien_gia_han_phong" id="so_tien_gia_han_phong" readonly />
                </div>
            </div>

            <div class="themmoii" style="display:none;">
                <div class="nhanphong">
                    <span>Nhận phòng sớm</span>
                    <div class="checkboxx">
                        <div class="themaa">
                            <input type="checkbox" id="nhan_phong_som_6_9" name="nhan_phong_som_6_9"
                                onchange="updateTotalAmount()" />
                            <span>6h00 - 9h00</span>
                        </div>
                        <div class="themaa">
                            <input type="checkbox" id="nhan_phong_som_9_12" name="nhan_phong_som_9_12"
                                onchange="updateTotalAmount()" />
                            <span>9h00 - 12h00</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="themmoii" style="display:none;">
                <div class="nhanphong">
                    <span>Trả phòng trễ</span>
                    <div class="checkbox">
                        <div class="themaa">
                            <input type="checkbox" id="tra_phong_muon_13_15" name="tra_phong_muon_13_15"
                                onchange="updateTotalAmount()" />
                            <span>13h00 - 15h00</span>
                        </div>
                        <div class="themaa">
                            <input type="checkbox" id="tra_phong_muon_15_18" name="tra_phong_muon_15_18"
                                onchange="updateTotalAmount()" />
                            <span>15h00 - 18h00</span>
                        </div>
                        <div class="themaa">
                            <input type="checkbox" id="tra_phong_muon_sau_18" name="tra_phong_muon_sau_18"
                                onchange="updateTotalAmount()" />
                            <span>Sau 18h00</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="themmoi" style="display:none;">
                <div class="thema">
                    <span>Số tiền phụ thu đến trước</span>
                    <input type="text" name="so_tien_phu_thu_den_truoc" id="so_tien_phu_thu_den_truoc" readonly />
                </div>
                <div class="thema">
                    <span>Số tiền phụ thu đến sau</span>
                    <input type="text" name="so_tien_phu_thu_den_sau" id="so_tien_phu_thu_den_sau" readonly />
                </div>
            </div>
            <div class="themmoi">
                <div class="thema">
                    <span>Ghi chú</span>
                    <input style="width:800px" type="text" name="ghi_chu" id="ghi_chu" />
                </div>
            </div>
        </div>
        <div class="luulai">
            <input type="submit" name="luu" value="Lưu lại" />
            <button type="button" onclick="window.location.href='phanphong.php'">Trở về</button>
        </div>
    </form>

    <?php include ("footer.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>

        function formatDate(dateString) {
            var date = new Date(dateString);
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            return day + '/' + month + '/' + year;
        }

        function updateTotalAmount() {
            var maPhieuDat = document.getElementById('phieu_dat').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'layThongTinPhieuDat.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    if (!data.error) {
                        // Update form fields with retrieved data
                        document.getElementById('ho_ten_khach_hang').value = data.ho_ten_khach_hang;
                        document.getElementById('loai_phong').value = data.loai_phong;
                        document.getElementById('ngay_den').value = formatDate(data.ngay_nhan);
                        document.getElementById('ngay_di').value = formatDate(data.ngay_tra);
                        document.getElementById('tong_tien').value = data.tong_tien;
                        document.getElementById('so_tien_da_coc').value = data.tien_coc;

                        var loaiPhongGia = parseFloat(data.gia_phong);
                        var soNgayGiaHan = parseInt(document.getElementById('gia_han_phong').value);

                        // Calculate extension cost and update the input field
                        // var tienGiaHanPhong = loaiPhongGia * soNgayGiaHan;
                        // document.getElementById('so_tien_gia_han_phong').value = tienGiaHanPhong.toFixed(0);

                        // Calculate remaining amount to be paid
                        var soTienDaCoc = parseFloat(data.tien_coc);
                        var tongTien = parseFloat(data.tong_tien);
                        var soTienConLai = tongTien - soTienDaCoc;

                        var checkbox6_9 = document.getElementById('nhan_phong_som_6_9');
                        var checkbox9_12 = document.getElementById('nhan_phong_som_9_12');
                        var checkbox13_15 = document.getElementById('tra_phong_muon_13_15');
                        var checkbox15_18 = document.getElementById('tra_phong_muon_15_18');
                        var checkboxSau18 = document.getElementById('tra_phong_muon_sau_18');

                        // Calculate surcharge amounts
                        var phuThuDenTruoc = 0;
                        if (checkbox6_9.checked) {
                            phuThuDenTruoc += tongTien * 0.10;
                        }
                        if (checkbox9_12.checked) {
                            phuThuDenTruoc += tongTien * 0.15;
                        }

                        var phuThuDenSau = 0;
                        if (checkbox13_15.checked) {
                            phuThuDenSau += tongTien * 0.10;
                        }
                        if (checkbox15_18.checked) {
                            phuThuDenSau += tongTien * 0.15;
                        }
                        if (checkboxSau18.checked) {
                            phuThuDenSau += tongTien * 0.50;
                        }

                        // Update surcharge input fields
                        document.getElementById('so_tien_phu_thu_den_truoc').value = phuThuDenTruoc.toFixed(0);
                        document.getElementById('so_tien_phu_thu_den_sau').value = phuThuDenSau.toFixed(0);

                        // Calculate total amount to be paid
                        var soTienConLaiSauPhi = soTienConLai + phuThuDenTruoc + phuThuDenSau;
                        document.getElementById('tong_so_tien_can_tra').value = soTienConLaiSauPhi.toFixed(0);
                    } else {
                        alert(data.error);
                    }
                }
            };
            xhr.send('ma_phieu_dat=' + maPhieuDat);
        }

        // Add event listeners to relevant elements
        document.getElementById('phieu_dat').addEventListener('change', updateTotalAmount);
        document.getElementById('gia_han_phong').addEventListener('change', updateTotalAmount);
        document.getElementById('nhan_phong_som_6_9').addEventListener('change', updateTotalAmount);
        document.getElementById('nhan_phong_som_9_12').addEventListener('change', updateTotalAmount);
        document.getElementById('tra_phong_muon_13_15').addEventListener('change', updateTotalAmount);
        document.getElementById('tra_phong_muon_15_18').addEventListener('change', updateTotalAmount);
        document.getElementById('tra_phong_muon_sau_18').addEventListener('change', updateTotalAmount);
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#phong').select2({
                placeholder: "-- Chọn phòng --",
                allowClear: true
            });
        });
    </script>