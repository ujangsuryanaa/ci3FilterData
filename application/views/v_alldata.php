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
                <h4>All Data</h4>
                <form action="<?php echo base_url().'chart/alldata' ?>" method="post">
                    <a href="<?php echo base_url() ?>" class="btn btn-outline-primary btn-sm"><- back</a>
                    <label for="date_from">Date From:</label>
                    <input type="date" name="date_from" value="<?php echo date('Y-m-d') ?>">
                    <label for="date_to">Date To:</label>
                    <input type="date" name="date_to" value="<?php echo date('Y-m-d') ?>">
                    <input type="submit" value="Filter">
                    <button onclick="window.print()">view</button>
                    <a href="<?php echo base_url().'chart/dataarea' ?>" class="btn btn-outline-primary btn-sm">Data By Area -></a>
                </form>
            </center>
        </div>

        <center class="card mt-5">
            <div class="card-header">
                Grafik
            </div>
            <div>
                <canvas style="margin-left: 100px; margin-right: 100px; height: 30%;" id="myChart"></canvas>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            
            <script>
                const ctx = document.getElementById('myChart');
                
                var data = {
                    labels: ['DKI Jakarta', 'Jawa Barat', 'Kalimantan', 'Jawa Tengah', 'Bali'],
                    // labels: [<?php foreach ($area as $g) { echo $g->area_name . ','; } ?>]
                    datasets: [
                        {
                            label: 'ROTI TAWAR',
                            data: [<?php echo $nilai1; ?>, <?php echo $nilai2; ?>, <?php echo $nilai3; ?>, <?php echo $nilai4; ?>, <?php echo $nilai5; ?>],
                            // data: [<?php if(isset($nilai1)) echo $nilai1; else echo 0; ?>, <?php if(isset($nilai2)) echo $nilai2; else echo 0; ?>, <?php if(isset($nilai3)) echo $nilai3; else echo 0; ?>, <?php if(isset($nilai4)) echo $nilai4; else echo 0; ?>, <?php if(isset($nilai5)) echo $nilai5; else echo 0; ?>]
                            backgroundColor: '#f44336',
                            borderWidth: 1
                        },
                        {
                            label: 'SUSU KALENG',
                            data: [<?php echo $nilai6; ?>, <?php echo $nilai7; ?>, <?php echo $nilai8; ?>, <?php echo $nilai9; ?>, <?php echo $nilai10; ?>],
                            backgroundColor: '#3f51b5',
                            borderWidth: 1
                        }
                        ]
                    };
                    var options = {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                            }
                        };
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: data,
                        options: options
                    });
        </script>
      </center>

      <center class="card mt-5">
          <table border="1" class="text-center">
                <tr class="card-header">
                    <th>Brand</th>
                    <th>DKI Jakarta</th>
                    <th>Jawa Barat</th>
                    <th>Kalimantan</th>
                    <th>Jawa Tengah</th>
                    <th>Bali</th>
                </tr>
                <tr>
                    <td>ROTI TAWAR</td>
                    <td><?php echo $nilai1; ?>%</td>
                    <td><?php echo $nilai2; ?>%</td>
                    <td><?php echo $nilai3; ?>%</td>
                    <td><?php echo $nilai4; ?>%</td>
                    <td><?php echo $nilai5; ?>%</td>
                </tr>
                <tr>
                    <td>SUSU KALENG</td>
                    <td><?php echo $nilai6; ?>%</td>
                    <td><?php echo $nilai7; ?>%</td>
                    <td><?php echo $nilai8; ?>%</td>
                    <td><?php echo $nilai9; ?>%</td>
                    <td><?php echo $nilai10; ?>%</td>
                </tr>
            </table>
      </center>
    </div>
</body>
</html>