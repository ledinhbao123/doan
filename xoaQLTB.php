
<?php
session_start();
include("ketnoi.php");

    $user_xoa=$_REQUEST["user"];
    $sql="delete from thiet_bi where ma_thiet_bi='".$user_xoa."'";
    $kq=mysqli_query($conn, $sql) or die ("Không thể xuất thông tin".mysqli_error());
    echo ("<script language=javascript>
    {
    alert('Xóa thiết bị thành công');
    window.location='QLTB.php';}
    </script> ");
?>
