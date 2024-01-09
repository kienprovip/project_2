<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Analytics</h2>
        </div>
    </nav>
    <div class="container-fluid px-4">
        <?php
        $totalDashboard = array(); // Create a new array to store the calculated totals

        for ($i = 1; $i <= 12; $i++) {
            $dashboard = 0;
            foreach ($data['month' . $i] as $month) {
                $dashboard += $month['order_price'];
            }

            $totalDashboard[] = $dashboard; // Store the total in the new array
        }
        ?>
        <div>
            <div class="col-12">
                <canvas id="myPercentageChart" width="100%" height="500"></canvas>

                <script>
                    // Dữ liệu biểu đồ (chuyển giá trị sang phần trăm)
                    var dataInPercent = <?php echo json_encode($totalDashboard); ?>;
                    var data = {
                        labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                        datasets: [{
                            label: "Tỉ lệ hoàn thành (%)",
                            borderColor: "rgb(75, 192, 192)",
                            data: dataInPercent.map(function(value) {
                                return value / 100; // Chia cho 100 để chuyển sang phần trăm
                            }),
                            fill: false,
                        }]
                    };

                    // Cấu hình biểu đồ
                    var options = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                type: 'category',
                                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                            },
                            y: {
                                beginAtZero: true,
                                max: 100 // Đảm bảo biểu đồ hiển thị từ 0 đến 1
                            }
                        }
                    };

                    // Lấy đối tượng canvas và vẽ biểu đồ
                    var ctx = document.getElementById('myPercentageChart').getContext('2d');
                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: data,
                        options: options
                    });
                </script>
            </div>
        </div>

    </div>
</div>