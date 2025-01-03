<?php
include ("header.php");
include ("ketnoi.php");
?>

<head>
    <script src="editor/ckeditor.js"></script>
</head>

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

    .text h2 {
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
        gap: 18px;
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
    }

    input[type="date" i] {
        height: 40px;
        border: 1px solid #40679E;
        border-radius: 3px;
        color: black;
        width: 350px;
    }

    .thema>select {
        height: 40px;
        border: 1px solid #40679E;
        border-radius: 3px;
        color: black;
        width: 350px;
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
<form enctype="multipart/form-data" action="xulythemQLTT.php" name="xulythemQLTT" method="post">
    <div class="text">
        <h2>
            <ion-icon name="add-circle"></ion-icon>
            THÊM TIN TỨC MỚI
        </h2>
    </div>

    <div class="themtong">
        <div class="themmoi">
            <div class="thema">
                <span>Tiêu đề</span>
                <input type="text" name="ten_tin_tuc" />
            </div>
            <div class="thema">
                <span>Người đăng tin</span>
                <input style="border:none; background-color:#F5F5F5;" type="text" name="nhan_vien"
                    id="nhan_vien_xac_nhan" value="<?php echo $_SESSION['ho_ten']; ?>" readonly />
            </div>
        </div>

        <div class="themmoi">
            <div class="thema">
                <span>Nội dung</span>
                <textarea name="noi_dung" id="editor1"></textarea>
            </div>
        </div>

        <div class="themmoi">
            <div class="themm">
                <div class="thema">
                    <span>Ngày đăng</span>
                    <input type="date" name="ngay_dang" id="ngay_dang" min="<?php echo date('Y-m-d'); ?>" required />
                </div>
            </div>
            <div class="themm">
                <div class="thema">
                    <span>Trạng thái</span>
                    <select name="trang_thai">
                        <option value="Công khai">Công khai</option>
                        <option value="Ẩn bài">Ẩn bài</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="themmoi">
            <div class="thema">
                <span>Hình ảnh</span>
                <input style="width:800px;" type="text" name="hinh_anh_hien_tai" id="hinh_anh_hien_tai" readonly>
                <input type="file" name="hinh_anh" id="hinh_anh" style="display:none;" onchange="updateImagePath(this)">
                <img id="hinh_anh_preview" src="" style="max-width:800px; max-height: 400px;">
                <button
                    style="width:200px; margin: 10px auto; border-radius: 3px; height: 35px;background-color: #40679E; color:white; border:none;"
                    type="button" onclick="document.getElementById('hinh_anh').click();">Vui lòng chọn
                    ảnh!</button>
            </div>
        </div>
    </div>
    <div class="luulai">
        <input type="submit" name="luu" value="Lưu lại" />
        <button type="button" onclick="window.location.href='QLTT.php'">Trở về</button>
    </div>
</form>

<script>
    function updateImagePath(input) {
        var filePath = input.value.split('\\').pop();
        document.getElementById('hinh_anh_hien_tai').value = "./anhtin/" + filePath;
        // Hiển thị hình ảnh mới
        var file = input.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('hinh_anh_preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>

<script src="editor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: 'upload.php?type=Files',
        filebrowserImageUploadUrl: 'upload.php?type=Images',
        filebrowserBrowseUrl: 'editor/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl: 'editor/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
        height: 200,
        width: 800,
        toolbar: [
            ['NewPage', '-', 'Undo', 'Redo', 'PageBreak'],
            ['Cut', '-', 'Copy', 'Paste', 'PasteFromWord'],
            ['Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
            ['Link', 'Unlink', 'Image', 'Flash', 'Table', 'Smiley', 'SpecialChar'],
            '/',
            ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull', 'JustifyBlock'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
            ['Maximize', 'ckeditor_wiris_formulaEditor']
        ]
    });
</script>

<?php
include("footer.php");
?>
