<?php
include ("header.php");
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
        margin-top: 20px;
        background: #F5F5F5;
        display: flex;
        flex-direction: column;
        /* align-items: center; */
        justify-content: center;
        /* border: 2px solid #F5F5F5; */
        width: 90%;
        margin: 20px auto;
        gap: 40px;
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
        gap: 40px;

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

    input[type="number" i] {
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
        margin-top: 10px;
        margin-bottom: 50px;
        display: flex;
        gap: 30px;
        justify-content: center;
        align-items: center;
        padding: 10px 20px;

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
</style>

<form enctype="multipart/form-data" action="xulythemQLLP.php" name="xulythemQLLP" method="post">

    <div class="text">
        <h4>
            THÊM LOẠI PHÒNG MỚI
        </h4>
    </div>
    <div class="themtong">
        <div class="themmoi">
            <div class="thema">
                <span>Tên loại phòng</span>
                <input style="width:800px" type="text" name="ten_loai" />
            </div>
        </div>

        <div class="themmoi">
            <div class="themm">
                <div class="thema">
                    <span>Diện tích phòng</span>
                    <select name="dien_tich">
                        <option value="31-32m2">31-32m2</option>
                        <option value="35-36m2">35-36m2</option>
                    </select>
                </div>

                <div class="thema">
                    <span>Chi tiết phòng</span>
                    <select name="chi_tiet_phong">
                        <option value="2 người lớn, 2 giường đơn">2 người lớn, 2 giường đơn</option>
                        <option value="2 người lớn, giường đôi">2 người lớn, giường đôi</option>
                    </select>
                </div>
            </div>
            <div class="themm">
                <div class="thema">
                    <span>Số lượng loại phòng</span>
                    <input type="number" name="so_luong" />
                </div>
                <div class="thema">
                    <span>Giá loại phòng</span>
                    <input type="number" name="gia_phong" />
                </div>
            </div>
        </div>
        <div class="themmoi">
            <div class="thema">
            <span>Hình ảnh loại phòng</span>
                <input style="width:800px;" type="text" name="hinh_anh_hien_tai" id="hinh_anh_hien_tai"
                    readonly>
                <input type="file" name="anh_loai_phong" id="anh_loai_phong" style="display:none;"
                    onchange="updateImagePath(this)">
                <img id="anh_loai_phong_preview" src="<?php echo $row['anh_loai_phong']; ?>"
                    style="max-width:800px; max-height: 400px;">
                <button
                    style="width:200px; margin: 10px auto; border-radius: 3px; height: 35px;background-color: #40679E; color:white; border:none;"
                    type="button" onclick="document.getElementById('anh_loai_phong').click();">Vui lòng chọn
                    ảnh!</button>

            </div>
        </div>
    </div>
    <div class="luulai">
        <input type="submit" name="luu" value="Lưu lại" />
        <button type="button" onclick="window.location.href='QLLP.php'">Trở về</button>

    </div>
</form>
<script>
    function updateImagePath(input) {
        var filePath = input.value.split('\\').pop(); 
        document.getElementById('hinh_anh_hien_tai').value = "./anhtin/" + filePath; 

        var file = input.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('anh_loai_phong_preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>


<?php
include ("footer.php")
    ?>