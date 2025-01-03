<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/logo/rose1.png" rel="icon">
    <title>The Rose Hotel - The Rose Hotel</title>
    <link href="css\trangchu.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://kit.fontawesome.com/71a8190e62.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include ("headertc.php");
    ?>

    <div class="slideshow-container">

        <div class="mySlides fade">
            <img src="anhtin\a1.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="anhtin\a2.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="anhtin\sanh.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <img src="anhtin\mattien.jpg" style="width:100%">
        </div>
        <div style="text-align:center">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
    </div>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000);
        }
    </script>
    <br>
    <div class="center_info">
        <div class="title">
            <label class="title1">
                <a>THE ROSE HOTEL</a>
            </label>
            <label class="title2">
                <a>"</a>
                <p>Trải nghiệm khách sạn theo tiêu chuẩn 3 sao</p>
                <a>"</a>
            </label>
        </div>
        <div class="gioithieu">
            <label class="gioithieu2">
                <p>The Rose Hotel là khách sạn sang trọng nằm ở trung tâm Thành phố Vinh, là lựa chọn lý tưởng
                    cho những ai muốn trải nghiệm dịch vụ đẳng cấp và tiện nghi hiện đại. Khách sạn này mang đến
                    không gian sống tinh tế, hài hòa, cùng hàng loạt tiện ích giải trí và thư giãn, hứa hẹn sẽ đem
                    lại cho bạn và gia đình một kỳ nghỉ đáng nhớ.</p>
                <p>Dù bạn đi du lịch cùng gia đình hay chỉ đơn thuần là muốn tìm một không gian riêng tư, The Rose
                    Hotel đều có thể đáp ứng mọi nhu cầu. Đây là địa điểm lý tưởng cho những ai muốn tận hưởng kỳ
                    nghỉ thoải mái mà vẫn tiết kiệm chi phí, với mức giá vô cùng hợp lý.</p>
                <p>The Rose Hotel mang đẳng cấp 3 sao, với những thiết kế hiện đại và trang bị đầy đủ tiện nghi,
                    cùng với khu vực thư giãn cho khách hàng có thể ngắm nhìn toàn cảnh Thành phố Vinh. Với vị
                    trí thuận lợi ngay trung tâm, The Rose Hotel là điểm dừng chân hoàn hảo cho mọi du khách khi đến
                    với Vinh, mang lại những trải nghiệm lưu trú tuyệt vời và dịch vụ chất lượng cao.</p>
            </label>
        </div>
    </div>

    <div class="room-container">
        <div class="frame_1">
            <label class="title-room">
                <p>HÃY TẬN HƯỞNG THỜI GIAN VUI VẺ CÙNG NGƯỜI THÂN TẠI THE ROSE HOTEL</p>
                <span>PHÒNG KHÁCH SẠN</span>
            </label>
            <?php
            include ("ketnoi.php");

            $offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;
            $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 3;

            if ($stmt = $conn->prepare("SELECT ten_loai, dien_tich, chi_tiet_phong, anh_loai_phong FROM loai_phong LIMIT ?, ?")) {
                $stmt->bind_param("ii", $offset, $limit);
                $stmt->execute();
                $result = $stmt->get_result();

                $output = '';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $output .= '
            <div class="room1">
                <div class="image-fr">
                    <img src="' . htmlspecialchars($row["anh_loai_phong"]) . '" class="image-room" />
                </div>
                <div class="info-room1">
                    <h4>' . htmlspecialchars($row["ten_loai"]) . '</h4>
                    <div class="tt-chung">
                        <label class="dt-room">
                            <a><i class="fa-solid fa-location-dot"></i></a>
                            <span>' . htmlspecialchars($row["dien_tich"]) . '</span>
                        </label>
                        <label class="dt-room">
                            <a><i class="fa-solid fa-user-group"></i></a>
                            <span>' . htmlspecialchars($row["chi_tiet_phong"]) . '</span>
                        </label>
                    </div>
                    <a style="color:#b20600;" class="btXemphong" href="xemphong.php?loai_phong=' . urlencode($row["ten_loai"]) . '">XEM PHÒNG</a>
                </div>
            </div>';
                    }
                    $stmt_count = $conn->prepare("SELECT COUNT(*) AS total FROM loai_phong");
                    $stmt_count->execute();
                    $count_result = $stmt_count->get_result();
                    $row_count = $count_result->fetch_assoc();
                    $total_rooms = $row_count['total'];

                    if ($offset + $limit < $total_rooms) {
                        $output .= '<button class="load-more" data-offset="' . ($offset + $limit) . '">HIỂN THỊ THÊM</button>';
                    } else {
                        $output .= '<button class="load-more hide-more">ẨN BỚT</button>';
                    }
                } else {
                    $output = "Không có kết quả";
                }

                echo $output;
                $stmt->close();
                $stmt_count->close();
            } else {
                echo "Lỗi truy vấn: " . $conn->error;
            }

            $conn->close();
            ?>

        </div>
    </div>


    <div class="tienich">
        <div class="tienichh">
            <div class="tienich1">
                <div class="title-ti">
                    <a><i class="fa-solid fa-wand-magic-sparkles"></i></a>
                    <span>Điểm nổi bật</span>
                </div>
                <div class="icon-ti">
                    <div class="icon-fr">
                        <label class="wifi">
                            <a><i class="fa-solid fa-house-signal"></i></a>
                            <span>Wifi phòng miễn phí</span>
                        </label>
                        <label class="clean">
                            <a><i class="fa-solid fa-spray-can-sparkles"></i></a>
                            <span>Sạch sẽ, thoáng mát</span>
                        </label>
                        <label class="food">
                            <a><i class="fa-solid fa-utensils"></i></a>
                            <span>Phục vụ ăn uống</span>
                        </label>
                        <label class="check">
                            <a><i class="fa-solid fa-check-to-slot"></i></a>
                            <span>Nhận/trả phòng nhanh</span>
                        </label>

                        <label class="car">
                            <a><i class="fa-solid fa-car-side"></i></a>
                            <span>Nằm gần trung tâm</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gioi-thieu-food">
        <div class="khung-chua-gt">
            <div class="w3-content w3-section" style="width:30%;">
                <img class="mySlide mySlide1" src="./anhtin/drink1.jpg" style="width:100%">
                <img class="mySlide mySlide1" src="./anhtin/drink2.jpg" style="width:100%">
                <img class="mySlide mySlide1" src="./anhtin/drink3.jpg" style="width:100%">
            </div>

            <div class="w3-content w3-section" style="width:30%;">
                <img class="mySlide mySlide2" src="./anhtin/food1.jpg" style="width:100%">
                <img class="mySlide mySlide2" src="./anhtin/food2.jpg" style="width:100%">
                <img class="mySlide mySlide2" src="./anhtin/food3.jpg" style="width:100%">
            </div>

            <div class="w3-content w3-section" style="width:30%;">
                <img class="mySlide mySlide3" src="./anhtin/retail1.jpg" style="width:100%">
                <img class="mySlide mySlide3" src="./anhtin/retail4.jpg" style="width:100%">
                <img class="mySlide mySlide3" src="./anhtin/retail3.jpg" style="width:100%">
            </div>
        </div>
    </div>

    <div class="phone-button">
        <a href="tel:+0903345615">
            <i class="fa-solid fa-phone"></i>0903 345 615
        </a>
    </div>
    <button onclick="topFunction()" id="scrollToTopBtn" title="Go to top">
        <i style="font-size: 18px;color:white;" class="fa-solid fa-arrow-up"></i>
    </button>
    </div>
</body>
<script>

    let mybutton = document.getElementById("scrollToTopBtn");
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0; 
        document.documentElement.scrollTop = 0; 
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
       
        $(document).on('click', '.load-more:not(.hide-more)', function () {
            var offset = $(this).data('offset');
            var limit = 3; // Số lượng phòng để tải thêm
            var button = $(this);

            $.ajax({
                type: 'GET',
                url: 'load_more.php',
                data: { offset: offset, limit: limit },
                success: function (response) {
                    button.remove();
                    $('.room-container').append(response);
                },
                error: function () {
                    alert('Đã xảy ra lỗi khi tải thêm phòng.');
                }
            });
        });

        // Hiển thị ít hơn khi click vào nút "Ẩn bớt"
        $(document).on('click', '.load-more.hide-more', function () {
            $('.room1').slice(3).hide();
            $(this).remove();
            $('.room-container').append('<button class="load-more" data-offset="3">HIỂN THỊ THÊM</button>');
        });
    });
</script>
<script>
    var myIndex1 = 0;
    var myIndex2 = 0;
    var myIndex3 = 0;
    carousel1();
    carousel2();
    carousel3();

    function carousel1() {
        var i;
        var x = document.getElementsByClassName("mySlide1");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex1++;
        if (myIndex1 > x.length) { myIndex1 = 1 }
        x[myIndex1 - 1].style.display = "block";
        setTimeout(carousel1, 3000);
    }

    function carousel2() {
        var i;
        var x = document.getElementsByClassName("mySlide2");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex2++;
        if (myIndex2 > x.length) { myIndex2 = 1 }
        x[myIndex2 - 1].style.display = "block";
        setTimeout(carousel2, 3000);
    }

    function carousel3() {
        var i;
        var x = document.getElementsByClassName("mySlide3");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex3++;
        if (myIndex3 > x.length) { myIndex3 = 1 }
        x[myIndex3 - 1].style.display = "block";
        setTimeout(carousel3, 3000);
    }
</script>

</html>
<?php
include ("footertc.php");
?>

<style>
    .optionn>:nth-child(1) {
        text-shadow: 1px 3px 4px #EE4E4E;
        color: #B20600;
    }
</style>