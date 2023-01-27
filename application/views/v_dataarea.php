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
                <h4>Data by Area</h4>
                <form method="post">
                <a href="<?php echo base_url().'chart/alldata' ?>" class="btn btn-outline-primary btn-sm"><- All Data</a>
                    <label>Pilih Area:</label>
                    <select name="area_name">
                        <option value="DKI Jakarta">DKI Jakarta</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Kalimantan">Kalimantan</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Bali">Bali</option>
                    </select>
                    <label for="date_from">Date From:</label>
                        <input type="date" name="date_from" value="<?php echo date('Y-m-d') ?>">
                        <label for="date_to">Date To:</label>
                        <input type="date" name="date_to" value="<?php echo date('Y-m-d') ?>">
                        <input type="submit" value="Filter">
                        <button onclick="window.print()">view</button>
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
                <?php
                    $area = array(
                        "DKI Jakarta" => array($nilai1, $nilai6),
                        "Jawa Barat" => array($nilai2, $nilai7),
                        "Kalimantan" => array($nilai3, $nilai8),
                        "Jawa Tengah" => array($nilai4, $nilai9),
                        "Bali" => array($nilai5, $nilai10)
                    );

                ?>
            <script>
                const ctx = document.getElementById('myChart');
                
                var data = {
                    labels: ['ROTI TAWAR', 'SUSU KALENG'],
                    datasets: [
                        {
                            label: 'compliance',
                            data: [<?php echo $area[$_POST['area_name']][0];?>, <?php echo $area[$_POST['area_name']][1];?>],
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
        <?php
            $area = array(
                "DKI Jakarta" => array($nilai1, $nilai6),
                "Jawa Barat" => array($nilai2, $nilai7),
                "Kalimantan" => array($nilai3, $nilai8),
                "Jawa Tengah" => array($nilai4, $nilai9),
                "Bali" => array($nilai5, $nilai10)
            );

            // if (isset($_POST['area_name'])) {
            //     echo $area[$_POST['area_name']][0];
            //     echo $area[$_POST['area_name']][1];
            // }
        ?>

        <table border="1" class="text-center">
            <tr class="card-header">
                <th>Brand</th>
                <th>Compliance</th>
            </tr>
                <?php 
                    if(!empty($_POST['area_name'])){
                        echo '<tr>
                        <td>ROTI TAWAR</td>
                        <td>'.$area[$_POST['area_name']][0].'%</td>
                        </tr>
                        <tr>
                            <td>SUSU KALENG</td>
                            <td>'.$area[$_POST['area_name']][1].'%</td>
                        </tr>';
                        }else{
                            echo '<tr>
                                    <td colspan="2">Pilih area terlebih dahulu</td>
                                </tr>';
                        }
                    ?>
        </table>


        <!-- <table border="1" class="text-center">
            <tr class="card-header">
                <th>Brand</th>
                <th>Compliance</th>
            </tr>
            <tr>
                <td>ROTI TAWAR</td>
                <td><?php echo $area[$_POST['area_name']][0];?>%</td>
            </tr>
            <tr>
                <td>SUSU KALENG</td>
                <td><?php echo $area[$_POST['area_name']][1];?>%</td>
            </tr>
        </table> -->
      </center>
    </div>
</body>
</html>