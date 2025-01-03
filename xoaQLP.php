
<?php
session_start();
include("ketnoi.php");

    $user_xoa=$_REQUEST["user"];
    $sql="delete from phong where ma_phong='".$user_xoa."'";
    $kq=mysqli_query($conn, $sql) or die ("Không thể xuất thông tin".mysqli_error());
    echo ("<script language=javascript>
    {
    alert('Xóa phòng thành công');
    window.location='QLP.php';}
    </script> ");
?>
