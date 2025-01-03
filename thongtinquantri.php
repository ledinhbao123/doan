<head>
    <script src="https://kit.fontawesome.com/71a8190e62.js" crossorigin="anonymous"></script>
</head>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include ("header.php");
include ('ketnoi.php');

if (!isset($_SESSION['ma_nv'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header('Location: login.php');
    exit;
}

// Lấy thông tin khách hàng từ cơ sở dữ liệu
$ma_nv = $_SESSION['ma_nv'];
$sql = "SELECT ho_ten, gioi_tinh, cccd, ngay_sinh, sdtnv, dia_chi, user, pass FROM nhan_vien WHERE ma_nv = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ma_nv);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ho_ten = $row['ho_ten'];
    $gioi_tinh = $row['gioi_tinh'];
    $cccd = $row['cccd'];
    $ngay_sinh = $row['ngay_sinh'];
    $sdtnv = $row['sdtnv'];
    $dia_chi = $row['dia_chi'];
    $user = $row['user'];
    $pass = $row['pass'];

} else {

    echo "Không tìm thấy thông tin nhân viên.";
    exit;
}
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/thongtinkhach.css" />
</head>

<body>

    <div class="title-info1">
        <i class="fa-solid fa-user"></i>
        <h4>TRANG THÔNG TIN CÁ NHÂN</h4>
    </div>

    <div >
        <table class="table">
            <tr style="display:none;">
                <td style="width: 160px; color: dimgray; border-bottom: 1px solid floralwhite;">Mã nhân viên</td>
                <td style="width:343px; border-bottom: 1px solid floralwhite;"><?php echo htmlspecialchars($ma_nv); ?>
                </td>
            </tr>
            <tr>
                <td style="width: 160px; color: dimgray; border-bottom: 1px solid floralwhite;border-top: none;">Họ và tên</td>
                <td style="width:343px; border-bottom: 1px solid floralwhite;border-top: none;"><?php echo htmlspecialchars($ho_ten); ?>
                </td>
            </tr>
            <tr>
                <td style="color: dimgray;border-bottom: 1px solid floralwhite;">Giới tính</td>
                <td style="border-bottom: 1px solid floralwhite;"><?php echo htmlspecialchars($gioi_tinh); ?></td>
            </tr>
            <tr>
                <td style="color: dimgray; border-bottom: 1px solid floralwhite;">CCCD/CMND</td>
                <td style="border-bottom: 1px solid floralwhite;"><?php echo htmlspecialchars($cccd); ?></td>
            </tr>
            <tr>
                <td style="color: dimgray; border-bottom: 1px solid floralwhite;">Ngày sinh</td>
                <td style="border-bottom: 1px solid floralwhite;"><?php echo htmlspecialchars($ngay_sinh); ?></td>
            </tr>
            <tr>
                <td style="color: dimgray; border-bottom: 1px solid floralwhite;">Điện thoại</td>
                <td style="border-bottom: 1px solid floralwhite;"><?php echo htmlspecialchars($sdtnv); ?></td>
            </tr>

            <tr>
                <td style="color: dimgray; border-bottom: 1px solid floralwhite;">Địa chỉ</td>
                <td style="border-bottom: 1px solid floralwhite;"><?php echo htmlspecialchars($dia_chi); ?></td>
            </tr>
            <tr>
                <td style="color: dimgray; border-bottom: 1px solid floralwhite;">Tài khoản</td>
                <td style="border-bottom: 1px solid floralwhite;"><?php echo htmlspecialchars($user); ?></td>
            </tr>
            <!-- <tr>
                <td style="color: dimgray;">Mật khẩu</td>
                <td><?php echo htmlspecialchars($pass); ?></td>
            </tr> -->

            <tr>
                <td colspan="2">
                    <button style="width:400px; margin-left:48px; height: 25px; margin-top: 10px; background-color: #40679E; border: none; color:
                    white;">
                        <i class="fa-solid fa-pen"></i>
                        <a style="color: white;" href="suathongtinquantri.php">Chỉnh sửa thông tin cá nhân</a>
                    </button>
                </td>

            </tr>


        </table>
    </div>

</body>

</html>
<?php
include ("footer.php")
    ?>