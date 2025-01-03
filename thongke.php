<?php
include 'ketnoi.php'; 

$sql = "SELECT p.ten_phong AS ten_phong, COUNT(*) AS so_lan_phan_phong
        FROM o o
        INNER JOIN phong p ON o.ma_phong = p.ma_phong
        WHERE MONTH(STR_TO_DATE(o.ngay_den, '%d/%m/%Y')) = MONTH(CURDATE())
        GROUP BY o.ma_phong
        ORDER BY so_lan_phan_phong DESC
        LIMIT 10";

$result = mysqli_query($conn, $sql);

$data = array();
$data[] = ['Phòng', 'Số lần phân phòng'];

while ($row = mysqli_fetch_assoc($result)) {
    $phong = $row['ten_phong'];
    $so_lan = intval($row['so_lan_phan_phong']); 
    $data[] = [$phong, $so_lan];
}

$json_data = json_encode($data);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Biểu đồ Top 10 phòng được phân phòng nhiều nhất trong tháng</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $json_data; ?>);

            var options = {
                title: 'Top 10 phòng được phân phòng nhiều nhất trong tháng',
                chartArea: {width: '60%', height: '70%'},
                hAxis: {
                    title: 'Số lần phân phòng',
                    minValue: 0,
                    format: '0'
                },
                vAxis: {
                    title: 'Phòng'
                },
                bars: 'horizontal' 
            };


            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>

    <div id="chart_div" style="width: 900px; height: 400px; margin: 0 auto;"></div>
</body>
</html>
