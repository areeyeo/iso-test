<title>Dashboard</title>

<style>
    .col-lg-custome {
        -ms-flex: 0 0 16.666667%;
        flex: 1 0 19.666667%;
        max-width: 20.666667%;
    }
</style>

<body class="hold-transition sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                                data-target="#modal-default" id="load-modal-button"
                                onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-custome col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>
                                    <?= $data['totalDrafts'] ?>
                                </h3>

                                <p>Draft</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default"
                                id="load-modal-button" onclick="load_modal(2 , 1)">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-custome col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?= $data['totalPendingR'] + $data['totalPendingA'] ?>
                                </h3>

                                <p>Pending</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default"
                                id="load-modal-button" onclick="load_modal(2 , 2)">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-custome col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?= $data['totalReview'] ?>
                                </h3>
                                <p>Review</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default"
                                id="load-modal-button" onclick="load_modal(2 , 3)">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-custome col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    <?= $data['totalApproval'] ?>
                                </h3>

                                <p>Approve</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default"
                                id="load-modal-button" onclick="load_modal(2 , 4)">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-custome col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    <?= $data['totalReject'] ?>
                                </h3>

                                <p>Reject</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default"
                                id="load-modal-button" onclick="load_modal(2 , 5)">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- DONUT CHART -->
                        <div class="card card-indigo">
                            <div class="card-header">
                                <h3 class="card-title">Donut Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- BAR CHART -->
                        <div class="card card-fuchsia">
                            <div class="card-header">
                                <h3 class="card-title">Bar Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modal-default">
        <div id="modal1">
            <?= $this->include("Modal/Requirement_Modal"); ?>
        </div>
        <div id="modal2">
            <?= $this->include("Modal/Info_dash"); ?>
        </div>
    </div>
    <!-- ChartJS -->
    <script src="<?= base_url('plugins/chart.js/Chart.min.js'); ?>"></script>
    <!-- jQuery -->
    <script>
        $(document).ready(function () {
            var data = <?php echo json_encode($data); ?>;
            console.log(data);
            $(function () {

                //-------------
                //- DONUT CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData = {
                    labels: ['Draft', 'Pending', 'Review', 'Approve', 'Reject',],

                    datasets: [{
                        data: [data.totalDrafts, data.totalPendingR + data.totalPendingA, data.totalReview, data.totalApproval, data.totalReject],
                        backgroundColor: ['#6c757d', '#17a2b8', '#ffc107', '#28a745', '#dc3545'],
                    }]
                }
                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                })

                //-------------
                //- BAR CHART -
                //-------------
                var areaChartData = {
                    labels: ['Data Status'],
                    datasets: [{
                        label: 'Draft',
                        backgroundColor: '#6c757d',
                        borderColor: '#6c757d',
                        pointRadius: false,
                        pointColor: '#6c757d',
                        pointStrokeColor: '#6c757d',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#6c757d',
                        data: [data.totalDrafts]
                    },
                    {
                        label: 'Pending',
                        backgroundColor: '#17a2b8',
                        borderColor: '#17a2b8',
                        pointRadius: false,
                        pointColor: '#17a2b8',
                        pointStrokeColor: '#17a2b8',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#17a2b8',
                        data: [data.totalPendingR + data.totalPendingA]
                    },
                    {
                        label: 'Review',
                        backgroundColor: '#ffc107',
                        borderColor: '#ffc107',
                        pointRadius: false,
                        pointColor: '#ffc107',
                        pointStrokeColor: '#ffc107',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#ffc107',
                        data: [data.totalReview]
                    },
                    {
                        label: 'Approve',
                        backgroundColor: '#28a745',
                        borderColor: '#28a745',
                        pointRadius: false,
                        pointColor: '#28a745',
                        pointStrokeColor: '#28a745',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#28a745',
                        data: [data.totalApproval]
                    },
                    {
                        label: 'Reject',
                        backgroundColor: '#dc3545',
                        borderColor: '#dc3545',
                        pointRadius: false,
                        pointColor: '#dc3545',
                        pointStrokeColor: '#dc3545',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: '#dc3545',
                        data: [data.totalReject]
                    },
                    ]
                }

                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]

                barChartData.datasets[0] = temp0
                barChartData.datasets[1] = temp1

                console.log(barChartData);

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0
                            }
                        }]
                    }
                };

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })
            })
        });
    </script>

    <script>
        function load_modal(params, check) {
            console.log(params);

            modal1 = document.getElementById("modal1");
            modal2 = document.getElementById("modal2");
            if (params == '1') {
                //--show modal Requirement_Modal--//
                modal1.style.display = "block";
                modal2.style.display = "none";
            } else if (params == '2') {
                //--show modal Info_dash--//
                modal1.style.display = "none";
                modal2.style.display = "block"
            }
        }
    </script>