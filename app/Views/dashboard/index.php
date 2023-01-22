<?= $this->extend('template') ?>
<?= $this->section('content') ?>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Rak</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_rak">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Supplier</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_supplier">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-building fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jenis Barang
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="total_jenis_barang">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-archive fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Barang</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_barang">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-box fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(user('role') == 'admin') { ?>
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Admin
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="total_admin">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Petugas</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_petugas">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Customer
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="total_customer">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Barang Masuk</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_barang_masuk">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-box fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Barang Keluar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_barang_keluar">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-box fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                <!-- Rak Chart -->
                <div class="col-xl-7 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Rak Overview</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="rakChart" style="width: 100%; height:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supplier Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Top 5 Supplier</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="supplierChart" style="width: 100%; height:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                <!-- Barang Masuk & Keluar Chart -->
                <div class="col-xl-6 col-lg-4">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Barang Masuk & Barang Keluar</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="barangInOutChart" style="width: 100%; height:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jenis Barang Chart -->
                <div class="col-xl-6 col-lg-8">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Jenis Barang Overview</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="jenisBarangChart" style="width: 100%; height:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Transaksi Barang Overview</h6>
                                
                                <select name="tahun" id="tahun" class="form-control col-4" id="">
                                    <option value="">- TAHUN -</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-2 pb-2">
                                    <canvas id="barangMasukChart" style="width: 100%; height:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page level plugins -->
<script src="<?= base_url() ?>/assets/sb-admin-2/vendor/chart.js/Chart.min.js"></script>
<script>
    $(document).ready(function () {
        // Chart
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        /* Filter Chart Barang Masuk & Keluar */
        let barangMasukChartLabels = []
        let barangMasukChartData = []
        let barangKeluarChartData = []

        $("#tahun").change(function (e) { 
            e.preventDefault();

            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>/dashboard",
                dataType: "JSON",
                data: {
                    tahun: $(this).val()
                },
                success: function (response) {
                    let result = response
                    
                    barangMasukChartLabels = []
                    barangMasukChartData = []
                    barangKeluarChartData = []

                    result.barang_masuk_chart.forEach((value, index) => {
                        barangMasukChartLabels.push(value.bulan)
                        barangMasukChartData.push(value.jumlah_masuk)
                    })

                    result.barang_keluar_chart.forEach((value, index) => {
                        barangKeluarChartData.push(value.jumlah_keluar)
                    })

                    /* Chart Keluar Masuk Barang */
                    let barangMasukChart = document.getElementById("barangMasukChart");
                    new Chart(barangMasukChart, {
                        type: 'bar',
                        data: {
                            labels: barangMasukChartLabels,
                            datasets: [
                                {
                                    label: 'Barang Masuk',
                                    data: barangMasukChartData,
                                    fill: true,
                                    borderColor: "#84D2C5",
                                    backgroundColor: "#84D2C5",
                                    tension: 0,
                                },
                                {
                                    label: 'Barang keluar',
                                    data: barangKeluarChartData,
                                    fill: true,
                                    borderColor: "#7286D3",
                                    backgroundColor: "#7286D3",
                                    tension: 0,
                                }
                            ],
                        },
                        options: {
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    },
                                }]
                            }
                        }
                    });
                }
            });
        });

        $.ajax({
            type: "GET",
            url: "<?= base_url() ?>/dashboard",
            dataType: "JSON",
            success: function (response) {
                let result = response

                $("#total_rak").html(result.total_rak)
                $("#total_supplier").html(result.total_supplier)
                $("#total_jenis_barang").html(result.total_jenis_barang)
                $("#total_barang").html(result.total_barang)
                $("#total_admin").html(result.total_admin)
                $("#total_petugas").html(result.total_petugas)
                $("#total_customer").html(result.total_customer)
                $("#total_barang_masuk").html(result.total_barang_masuk)
                $("#total_barang_keluar").html(result.total_barang_keluar)

                /* Chart Overview Rak */
                let rakChartLabels = []
                let rakChartTotalBarang = []
                let rakChartTotalQty = []

                result.overview_rak.forEach((value, index) => {
                    rakChartLabels.push(value.rak_name)
                    rakChartTotalBarang.push(value.total_barang)
                    rakChartTotalQty.push(value.qty)
                })

                let rakChart = document.getElementById('rakChart');
                new Chart(rakChart, {
                    type: 'bar',
                    data: {
                    labels: rakChartLabels,
                    datasets: [
                        {
                            label: 'Total Stok',
                            data: rakChartTotalQty,
                            borderWidth: 1,
                            backgroundColor: "#84D2C5",
                        },
                        {
                            label: 'Jumlah Barang',
                            data: rakChartTotalBarang,
                            borderWidth: 1,
                            backgroundColor: "#7286D3",
                        },
                    ],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes: [{
                                stacked: true,
                                gridLines: {
                                    display: false,
                                }
                            }],
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true,
                                },
                                type: 'linear',
                            }]
                        }
                    }
                });

                /* Chart Top 5 Supplier */
                let supplierChartLabels = []
                let supplierChartTotalBarang = []

                result.top_five_supplier.forEach((value, index) => {
                    supplierChartLabels.push(value.supplier_name)
                    supplierChartTotalBarang.push(value.total_barang)
                })

                let supplierChart = document.getElementById('supplierChart');
                new Chart(supplierChart, {
                    type: 'horizontalBar',
                    data: {
                        labels: supplierChartLabels,
                        datasets: [{
                            label: "Barang",
                            borderWidth: 1,
                            data: supplierChartTotalBarang,
                            backgroundColor: "rgba(8, 26, 252, 0.36)"
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision: 0
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    padding: '-10',
                                    fontSize: '15',
                                    fontColor: 'black',
                                    mirror: true,
                                }
                            }]
                        }
                    }
                });

                /* Chart Customer & Supplier */
                let barangInOutChart = document.getElementById('barangInOutChart');
                new Chart(barangInOutChart, {
                    type: 'pie',
                    data: {
                        labels: ['Barang Masuk', 'Barang Keluar'],
                        datasets: [{
                            data: [result.total_barang_masuk, result.total_barang_keluar],
                            backgroundColor: [
                                "#84D2C5",
                                'rgb(54, 162, 235)'
                            ],
                            hoverOffset: 4
                        }]
                    }
                });

                /* Chart Jenis Barang */
                let jenisBarangChartLabels = []
                let jenisBarangChartStok = []
                let jenisBarangChartData = []

                result.jenis_barang_chart.forEach((value, index) => {
                    jenisBarangChartLabels.push(value.jenis_barang)
                    jenisBarangChartData.push(value.total_barang)
                    jenisBarangChartStok.push(value.stock_barang)
                })

                let jenisBarangChart = document.getElementById('jenisBarangChart');
                new Chart(jenisBarangChart, {
                    type: 'bar',
                    data: {
                    labels: jenisBarangChartLabels,
                    datasets: [
                        {
                            label: 'Jumlah Stok',
                            data: jenisBarangChartStok,
                            borderWidth: 1,
                            backgroundColor: "#7286D3",
                        },
                        {
                            label: 'Total Barang',
                            data: jenisBarangChartData,
                            borderWidth: 1,
                            backgroundColor: "#84D2C5",
                        },
                    ],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes: [{
                                stacked: true,
                                gridLines: {
                                    display: false,
                                }
                            }],
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true,
                                },
                                type: 'linear',
                            }]
                        }
                    }
                })

                /* Chart Barang Masuk & Keluar */
                barangMasukChartLabels = []
                barangMasukChartData = []
                barangKeluarChartData = []

                result.barang_masuk_chart.forEach((value, index) => {
                    barangMasukChartLabels.push(value.bulan)
                    barangMasukChartData.push(value.jumlah_masuk)
                })

                result.barang_keluar_chart.forEach((value, index) => {
                    barangKeluarChartData.push(value.jumlah_keluar)
                })

                let barangMasukChart = document.getElementById("barangMasukChart");
                new Chart(barangMasukChart, {
                    type: 'bar',
                    data: {
                        labels: barangMasukChartLabels,
                        datasets: [
                            {
                                label: 'Barang Masuk',
                                data: barangMasukChartData,
                                fill: true,
                                borderColor: "#84D2C5",
                                backgroundColor: "#84D2C5",
                                tension: 0,
                            },
                            {
                                label: 'Barang keluar',
                                data: barangKeluarChartData,
                                fill: true,
                                borderColor: "#7286D3",
                                backgroundColor: "#7286D3",
                                tension: 0,
                            }
                        ],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                },
                            }]
                        }
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>