<?php
session_start();
include ("headertc.php");
include ("ketnoi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/xemphong.css" />
    <script src="https://kit.fontawesome.com/71a8190e62.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="tong">
        <?php
        if (isset($_GET['loai_phong'])) {
            $loai_phong = $_GET['loai_phong'];

            $sql = "SELECT hinh_anh FROM hinh_anh HA
        INNER JOIN loai_phong LP ON HA.ma_loai = LP.ma_loai
        WHERE LP.ten_loai = '" . $conn->real_escape_string($loai_phong) . "'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="img-room">
                    <div class="slideshow-container">';
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="mySlides fade">
                          <img src="' . $row["hinh_anh"] . '" style="width:100%">
                      </div>';
                    $count++;
                }
                echo '<a class="prev" onclick="plusSlides(-1)">❮</a>
                  <a class="next" onclick="plusSlides(1)">❯</a>
                  </div>';

                echo '<div style="text-align:center;margin-top: 4px;">';
                for ($i = 1; $i < $count; $i++) {
                    echo '<span class="dot" onclick="currentSlide(' . $i . ')"></span>';
                }
                echo '</div>
                  </div>';
            } else {
                echo 'Không có hình ảnh cho loại phòng này.';
            }
        } else {
            echo 'Thiếu thông tin loại phòng.';
        }
        ?>
        <?php

        if (isset($_GET['loai_phong'])) {
            $loai_phong = $_GET['loai_phong'];

            $sql = "SELECT * FROM loai_phong WHERE ten_loai = '" . $conn->real_escape_string($loai_phong) . "'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '

        <div class="name-price">
            <div class="frame">
                <span>' . $row["ten_loai"] . '</span>
                <a>-</a>
                <a>' . $row["gia_phong"] . '</a>
            </div>
            <div class="detail">
                        <div class="fr-detail">
                            <h5>Thông tin phòng</h5>
                            <span>Diện tích: ' . $row["dien_tich"] . '</span>
                            <span>Loại phòng: ' . $row["chi_tiet_phong"] . '</span>
                            <span>Số lượng: ' . $row["so_luong"] . '</span>
                              <button class="btdatphong" onclick="handleBooking(' . $row["ma_loai"] . ')">Đặt phòng</button>
                        </div>
                    </div>
        </div>
        ';
            } else {
                echo 'Không có thông tin phòng.';
            }
        } else {
            echo 'Thiếu thông tin phòng.';
        }
        ?>

        <div id="popup" class="popup">
            <div class="popup-content">
                <!-- <span class="close" onclick="closePopup()">&times;</span> -->
                <p>Khách hàng đăng nhập bằng tài khoản có thể xem được thông tin phòng đã đặt!</p>
                <div class="fr-xn">
                    <button class="btn" style=" font-size: 15px; font-weight:bold;" id="confirmBtn">Không đăng
                        nhập</button>

                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['loai_phong'])) {
            $loai_phong = $_GET['loai_phong'];


            $sql_room = "SELECT * FROM phong P
                 INNER JOIN loai_phong LP ON P.ma_loai = LP.ma_loai
                 WHERE LP.ten_loai = '" . $conn->real_escape_string($loai_phong) . "'";
            $result_room = $conn->query($sql_room);

            if ($result_room->num_rows > 0) {
                $row_room = $result_room->fetch_assoc();
                $ma_phong = $row_room['ma_phong'];


                $sql_equipment = "SELECT CTTB.*, TB.ten_thiet_bi FROM chi_tiet_thiet_bi CTTB
                          INNER JOIN thiet_bi TB ON CTTB.ma_thiet_bi = TB.ma_thiet_bi
                          WHERE CTTB.ma_phong = $ma_phong";
                $result_equipment = $conn->query($sql_equipment);


                $sql_supplies = "SELECT CTVT.*, VT.ten_vat_tu FROM chi_tiet_vat_tu CTVT
                         INNER JOIN vat_tu VT ON CTVT.ma_vat_tu = VT.ma_vat_tu
                         WHERE CTVT.ma_phong = $ma_phong";
                $result_supplies = $conn->query($sql_supplies);

                echo '<div class="tools">
                <div class="fr-tool">
                    <h5>Tiện nghi trong phòng</h5>
                    <div class="fr-tool-ch">';


                echo '<div class="tool-ch">
                <h4>THIẾT BỊ</h4>';
                if ($result_equipment->num_rows > 0) {
                    while ($row_equipment = $result_equipment->fetch_assoc()) {
                        echo '<label class="tool">
                        <i class="fa-solid fa-square-check"></i>
                        <span>' . $row_equipment['ten_thiet_bi'] . '</span>
                      </label>';
                    }
                } else {
                    echo '<span>Không có thiết bị cho phòng này.</span>';
                }
                echo '</div>';
                echo '<div class="tool-ch">
                <h4>VẬT TƯ</h4>';
                if ($result_supplies->num_rows > 0) {
                    while ($row_supplies = $result_supplies->fetch_assoc()) {
                        echo '<label class="tool">
                        <i class="fa-solid fa-square-check"></i>
                        <span>' . $row_supplies['ten_vat_tu'] . '</span>
                      </label>';
                    }
                } else {
                    echo '<span>Không có vật tư cho phòng này.</span>';
                }
                echo '</div>';
                echo '</div>
              </div>
              </div>';
            } else {
                echo 'Không tìm thấy thông tin phòng.';
            }
        } else {
            echo 'Thiếu thông tin loại phòng.';
        }
        ?>
        <div class="hotel-policy">
            <div class="bfr-policy">
                <div class="fr-policy">
                    <h3>CHÍNH SÁCH KHÁCH SẠN</h3>
                    <button class="toggle-button" onclick="togglePolicy()">+</button>

                    <div class="regu">
                        <div class="regulation">
                            <label class="icon-re">
                                <i style="color: #b20600;" class="fa-solid fa-list"></i>
                                <h4>QUY ĐỊNH VÀ LƯU TRÚ</h4>
                            </label>

                            <span>Thời gian nhận phòng: sau 14h00. </span>
                            <span>Thời gian trả phòng: trước 12h00 trưa.</span>
                            <p>Việc yêu cầu nhận phòng sớm hoặc trả phòng trễ tùy thuộc vào tình trạng phòng trống của
                                khách
                                sạn
                                và phải được sự chấp thuận của khách sạn, phí phụ thu sẽ được áp dụng như sau:
                            </p>
                            <span>Trường hợp nhận phòng sớm:</span>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p>Từ 6h00 đến 9h00 phụ thu thêm 50% tiền phòng.</p>
                            </label>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p>Từ 9h00 đến 13h00 phụ thu thêm 15% tiền phòng.</p>
                            </label>

                            <span>Trường hợp trả phòng trễ: Khách hàng có thể trả trễ phòng hoặc gia hạn để
                                tiếp
                                tục ở lại căn cứ vào tình hình phòng trống và áp dụng phí phụ thu như sau:
                            </span>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p>Từ 12h00 đến 15h00 phụ thu thêm 20% tiền phòng.</p>
                            </label>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p>Từ 15h00 đến 18h00 phụ thu thêm 50% tiền phòng.</p>
                            </label>

                            <span>Sau 18h00 phụ thu 100% tiền phòng.</span>

                            <label class="icon-re">
                                <i style="color: #b20600;" class="fa-solid fa-list"></i>
                                <h4>CHÍNH SÁCH HUỶ PHÒNG</h4>
                            </label>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p> Quý khách vui lòng gửi yêu cầu hủy phòng trước 24 tiếng so với ngày nhận phòng
                                    để được hoàn lại 100% tiền cọc</p>
                            </label>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p> Khách hàng huỷ phòng sau 24 tiếng vẫn được chấp nhận nhưng KHÔNG HOÀN
                                    TIỀN
                                    đã
                                    đặt cọc trước đó</p>
                            </label>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p> Huỷ đặt phòng vào các dịp lễ, tết sẽ KHÔNG HOÀN CỌC</p>
                            </label>

                            <label class="icon-re">
                                <i style="color: #b20600;" class="fa-solid fa-list"></i>
                                <h4>CHÍNH SÁCH CHO TRẺ EM</h4>
                            </label>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p>Trẻ em 0 - 6 tuổi được ở miễn phí</p>
                            </label>

                            <label class="notept">
                                <i style="color: darkslategrey; font-size: 10px;"
                                    class="fa-solid fa-window-restore"></i>
                                <p>Trẻ từ 6 tuổi trở lên, phụ thu 70.000/người</p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fr-danhgia">
    <span>Bình luận của khách hàng</span>
    <?php
    $sql_comment = "SELECT danh_gia.*, khach_hang.emailkh FROM danh_gia 
                    JOIN khach_hang ON khach_hang.ma_kh = danh_gia.ma_kh 
                    JOIN loai_phong ON loai_phong.ma_loai = danh_gia.ma_loai 
                    WHERE loai_phong.ten_loai = '" . $conn->real_escape_string($loai_phong) . "'";
    $result_comment = $conn->query($sql_comment);
    if ($result_comment && $result_comment->num_rows > 0) {
        while ($row_comment = $result_comment->fetch_assoc()) { ?>
            <div class="danhgia">
                <label><?php echo htmlspecialchars($row_comment['emailkh']); ?></label>
                <span>
                    <?php
                    $original_date = $row_comment['ngay_danh_gia'];
                    $formatted_date = date('d/m/Y', strtotime($original_date));
                    echo htmlspecialchars($formatted_date);
                    ?>
                </span>
                <p><?php echo htmlspecialchars($row_comment['noi_dung']); ?></p>
            </div>
        <?php }
    } else { ?>
        <p>Không có đánh giá nào.</p>
    <?php } ?>





            <!-- <div class="danhgia">
                <label>hieuthao@gmail.com</label>
                <span>25/06/2024</span>
                <p>Nhân viên vui vẻ nhiệt tình, phòng thoáng mát, thức ăn ngon</p>
            </div> -->

        </div>

    </div>
    <div class="footer">
        <div class="footer-ch">
            <div class="contact-ks">
                <h3>THE ROSE HOTEL</h3>
                <label class="contact-ks1">
                    <i style="color: #b20600;" class="fa-solid fa-location-dot"></i>
                    <p>182 Lê Duẩn, Thành phố Vinh, Nghệ An</p>
                </label>

                <label class="contact-ks1">
                    <i style="color: #b20600;" class="fa-solid fa-phone"></i>
                    <p>0903 345 615</p>
                </label>

                <label class="contact-ks1">
                    <i style="color: #b20600;" class="fa-solid fa-envelope"></i>
                    <p>therosehotelandcoffee@gmail.com</p>
                </label>

                <div class="icon-ks">
                    <a target="_blank" href="https://www.facebook.com/therosehoteltravinh" class="fb"><i
                            class="fa-brands fa-facebook"></i></a>
                    <a target="_blank" href="https://www.youtube.com/@TheRoseHotelTraVinh" class="ytb"><i
                            class="fa-brands fa-youtube"></i></a>
                    <a class="tiktok"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>

            <div class="design">
                <p>The Rose Hotel - Design by BDT</p>
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
    <script>
        function togglePolicy() {
            var regu = document.querySelector('.hotel-policy .regu');
            var button = document.querySelector('.toggle-button');
            if (regu.style.display === "none" || regu.style.display === "") {
                regu.style.display = "block";
                button.textContent = "-";
            } else {
                regu.style.display = "none";
                button.textContent = "+";
            }
        }
    </script>
    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

    </script>
    <script>
        function handleBooking(roomId) {
            var isLoggedIn = <?php echo isset($_SESSION['ma_kh']) ? 'true' : 'false'; ?>;
            if (isLoggedIn) {
                window.location.href = 'datphong.php?id=' + roomId;
            } else {
                var popup = document.getElementById('popup');
                var confirmBtn = document.getElementById('confirmBtn');
                confirmBtn.onclick = function () {
                    window.location.href = 'datphong2.php?id=' + roomId;
                };
                popup.style.display = 'block';
            }
        }

        function closePopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        }

        window.onclick = function (event) {
            var popup = document.getElementById('popup');
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        }
    </script>
</body>

</html>