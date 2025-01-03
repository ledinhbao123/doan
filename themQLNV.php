<?php
include("header.php");
?>
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
    }
.thema>select{
    height: 40px;
        border: 1px solid #40679E;
        border-radius: 3px;
        color: black;
        width: 350px;
}
    .thema>span {
        color: #40679E;
        font-weight: bolder;
        font-size: large;
    }

    .luulai{
display: flex;
gap: 30px;
justify-content: center;
align-items: center;
padding: 10px 20px;

}

.luulai input{
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
.luulai button{
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

</style>
<form enctype="multipart/form-data" action="xulythemQLNV.php" name="xulythemQLNV" method="post">

    <div class="text">
        <h4>
        THÊM THÔNG TIN NHÂN VIÊN MỚI
        </h4>
    </div>
       
    <div class="themtong">
        <div class="themmoi">
            <div class="thema">
                <span>Họ tên nhân viên</span>
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
    <div class="luulai">
        <input type="submit" name="luu" value="Lưu lại" />
        <button type="button" onclick="window.location.href='QLNV.php'">Trở về</button>
    </div>
</form>
<!-- <style>
            .admin_tab >:nth-child(4){
                background-color: #3593D8;
                color: white;
            }
            </style> -->


<?php
include("footer.php")
?>