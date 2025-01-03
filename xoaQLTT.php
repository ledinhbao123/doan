
<?php
session_start();
include("ketnoi.php");

    $user_xoa=$_REQUEST["user"];
    $sql="delete from tin_tuc where ma_tin_tuc='".$user_xoa."'";
    $kq=mysqli_query($conn, $sql) or die ("Không thể xuất thông tin".mysqli_error());
    echo ("<script language=javascript>
    {
    alert('Xóa tin tức thành công');
    window.location='QLTT.php';}
    </script> ");
?>
