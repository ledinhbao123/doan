<?php
include ("header.php");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Thống kê đặt phòng</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Loại phòng', 'Số lần đặt'],
        <?php
        include ("ketnoi.php");

        $month = isset($_GET['month']) ? $_GET['month'] : date('n');
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

        $sql = "SELECT lp.ten_loai, COUNT(pd.ma_phieu_dat) as so_luong_dat
                  FROM phieu_dat pd
                  JOIN loai_phong lp ON pd.ma_loai = lp.ma_loai
                  WHERE MONTH(pd.ngay_dat) = $month AND YEAR(pd.ngay_dat) = $year
                  GROUP BY lp.ten_loai
                  ORDER BY so_luong_dat DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "['" . $row["ten_loai"] . "', " . $row["so_luong_dat"] . "],";
          }
        } else {
          echo "['Không có dữ liệu', 0]";
        }
        $conn->close();
        ?>
      ]);

      var options = {
        title: 'Biểu đồ thống kê loại phòng được đặt nhiều nhất theo tháng',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <div id="filters" style="width: 77%; margin: auto;">
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="month"></label>
      <select name="month" id="month" style="width: 80px; height: 30px;">
        <?php
        include ("ketnoi.php");

        $sql_months = "SELECT DISTINCT MONTH(ngay_dat) as month_num FROM phieu_dat";
        $result_months = $conn->query($sql_months);

        $available_months = array();
        if ($result_months->num_rows > 0) {
          while ($row_month = $result_months->fetch_assoc()) {
            $available_months[] = $row_month['month_num'];
          }
        }

        for ($m = 1; $m <= 12; $m++) {
          $month_name = 'Tháng ' . $m;
          if (in_array($m, $available_months)) {
            $selected = ($m == $_GET['month']) ? 'selected' : '';
            echo "<option value='$m' $selected>$month_name</option>";
          }
        }

        $conn->close();
        ?>
      </select>

      <label for="year"></label>
      <select name="year" id="year" style="width: 80px; height: 30px;">
        <?php
        include ("ketnoi.php");

        $sql_years = "SELECT DISTINCT YEAR(ngay_dat) as year_num FROM phieu_dat";
        $result_years = $conn->query($sql_years);

        $available_years = array();
        if ($result_years->num_rows > 0) {
          while ($row_year = $result_years->fetch_assoc()) {
            $available_years[] = $row_year['year_num'];
          }
        }

        foreach ($available_years as $year) {
          $selected = ($year == $_GET['year']) ? 'selected' : '';
          echo "<option value='$year' $selected>$year</option>";
        }

        $conn->close();
        ?>
      </select>

      <input type="submit" value="Lọc"
        style="width: 50px; height:30px; background-color: #40679E; color: white; border:none;">
    </form>
  </div>
  <div id="piechart" style="width: 900px; height: 500px; margin: 10px auto;"></div>
</body>

</html>
<?php
include ("footer.php");
?>