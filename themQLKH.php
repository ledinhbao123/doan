<?php
include ("header.php");
?>

<link rel="stylesheet" href="css/chinhsua.css" type="text/css" />
<form enctype="multipart/form-data" action="xulythemQLKH.php" name="xulythemQLKH" method="post">

    <div class="text">
        <h4>
            THÊM THÔNG TIN KHÁCH HÀNG MỚI
        </h4>
    </div>


    <div class="themtong">
        <div class="themmoi">
            <div class="thema">
                <span>Họ tên khách hàng</span>
                <input style="width:800px" type="text" name="ho_ten"/>
            </div>
        </div>
        <div class="themmoi">
            <div class="themm">
                <div class="thema">
                <span>Giới tính</span>
                    <select  name="gioi_tinh">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
                </div>

                <div class="thema">
                    <span>Căn cước công dân</span>
                    <input type="text" name="cccd" />
                </div>

                <div class="thema">
                    <span>Ngày sinh</span>
                    <input type="text" name="ngay_sinh" />
                </div>
                <div class="thema">
                    <span>Số điện thoại</span>
                    <input type="text" name="sdtnv"/>
                </div>
            </div>
            <div class="themm">
                <div class="thema">
                    <span>Địa chỉ</span>
                    <input type="text" name="dia_chi" />
                </div>

                <div class="thema">
                    <span>Tài khoản</span>
                    <input type="text" name="user" />
                </div>
                <div class="thema">
                    <span>Mật khẩu</span>
                    <input type="text" name="pass" />
                </div>
                <div class="thema">
                    <span>Tình trạng</span>
                    <select  name="tinh_trang">
                    <option value="Hoạt động">Hoạt động</option>
                    <option value="Ngưng">Ngưng</option>
                </select>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="themmoi">

        <div class="them">
            <div class="thema">
                <span>Họ tên khách hàng</span>
                <input type="text" name="ho_ten" />
            </div>

            <div class="thema">
            <span>Giới tính</span>
                    <select  name="gioi_tinh">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="thema">
                <span>Căn cước công dân</span>
                <input type="text" name="cccd" />
            </div>

            <div class="thema">
                <span>Số điện thoại</span>
                <input type="text" name="sdtkh" />
            </div>
        </div>

        <div class="them">
            <div class="thema">
                <span>Email</span>
                <input type="text" name="emailkh" />
            </div>

            <div class="thema">
                <span>Địa chỉ</span>
                <input type="text" name="dia_chi" />
            </div>

            <div class="thema">
                <span>Mật khẩu</span>
                <input type="password" name="matkhaukh" />
            </div>
        </div>
    </div> -->
    <div class="luulai">
        <input type="submit" name="them" value="Lưu lại" />
        <button type="button" onclick="window.location.href='QLKH.php'">Trở về</button>
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