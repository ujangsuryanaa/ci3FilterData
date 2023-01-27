<?php

?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>chart filter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  
  <div class="container mt-5">
    <div class="card">
      <center class="card-header position-relative">
        <h3>Filter Berdasarkan Area dan tanggal</h3>
        <br />
        <form action="<?php echo base_url() ?>" method="post">
            <label for="area_name">Area Name:</label>
              <select name="area_name">
                <option>pilih area</option>
                  <?php
                    foreach ($area as $g) {
                      ?>
                      <option value="<?php echo $g->area_name ?>"><?php echo $g->area_name ?></option>
                  <?php } ?>
              </select>
            <label for="date_from">Date From:</label>
            <input type="date" name="date_from" value="<?php echo date('Y-m-d') ?>">
            <label for="date_to">Date To:</label>
            <input type="date" name="date_to" value="<?php echo date('Y-m-d') ?>">
            <input type="submit" value="Filter">
            <button onclick="window.print()">view</button>
            <a href="<?php echo base_url().'chart/alldata' ?>" class="btn btn-success btn-sm">All Data</a>
        </form>
      </center>
    </div>

    <center class="card mt-5">
      <div class="card-header">
        Grafik
      </div>
      <div>
        <div><?php echo $area_name ?></div>
        <canvas style="margin-left: 100px; margin-right: 100px; height: 30%;" id="myChart"></canvas>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
            new Chart(document.getElementById("myChart"), {
            type: 'bar',
            data: {
              labels: [],
              datasets: [{
                label: "Compilience",
                backgroundColor: ["#3e95cd", "#8e5ea2", "orange", "#e8c3b9", "#c45850", "#c45850"],
                data: [],
              }]
            },
            options: {
              legend: {
              display: true
              },
              title: {
                display: true,
                text: 'Product Compilience'
              }
            }
            });
        </script>
    </center>

    <center class="card mt-5">
      <table border='1' class="text-center">
        <thead class="card-header">
          <tr>
            <th>Area Name</th>
            <th>Brand</th>
            <th>compliance</th>
          </tr>
        </thead>
        <tbody>
          <?php 
              $count = 0;
              $unique_brands = array();
              foreach ($compliance_data as $data) { 
                if($count == 2) {
                    break;
                }
                if(!in_array($data['brand_name'], $unique_brands)) {
                    array_push($unique_brands, $data['brand_name']);
                    $compliance_data_new = $this->m_chart->get_data($area_name, $data['brand_name'], $date_from, $date_to);
                    $compliance_count = count($compliance_data_new);
                    $compliance_sum = array_sum(array_column($compliance_data_new, 'compliance'));
                    $compliance_avg = $compliance_sum / $compliance_count;
                    $count++;
                    ?>
                    <tr>
                        <td><?php echo $area_name ?></td>
                        <td><?php echo $data['brand_name'] ?></td>
                        <td>
                            <?php echo $compliance_avg * 100; ?>
                        </td>
                    </tr>
                    <script>
                      data.labels.push("<?php echo $data['brand_name']; ?>");
                      data.datasets[0].data.push("<?php echo $compliance_avg * 100; ?>");
                    </script>
                <?php }
                } ?>
        </tbody>
      </table>
    </center>
  </div>
</body>
</html>