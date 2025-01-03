
<?php
session_start();
include("ketnoi.php");

    $user_xoa=$_REQUEST["user"];
    $sql="delete from loai_phong where ma_loai='".$user_xoa."'";
    $kq=mysqli_query($conn, $sql) or die ("Không thể xuất thông tin".mysqli_error($conn));
    echo ("<script language=javascript>
    {
    alert('Xóa loại phòng thành công');
    window.location='QLLP.php';}
    </script> ");
?>
