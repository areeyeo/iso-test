<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Log Activites</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">

</head>
<style>
    tr:nth-child(even) {
        background-color: #F5F5F5;
    }

    th {
        background-color: #F5F6FA;
        text-align: center;
        border-bottom: none;
    }

    tbody {
        border-bottom: 10px solid #ccc;
        text-align: center;
    }

    .table thead th {
        border-bottom: none;
    }

    .badge-edit {
        font-size: 100%;
    }

    .blue-text {
        color: #0000FF;
    }

    .gray-text {
        color: #adb5bd;
    }

    .modal-footer {
        justify-content: space-evenly;
    }

    .swal2-popup textarea.swal2-textarea {
        width: 90%;
    }

</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper" >
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <h3 class="card-title">Data Log Activites list</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>หมวดหมู่ประเภท</label>
                                                <select class="form-control select2bs4" style="width: 100%;"
                                                    id="category" name="category">
                                                    <option selected="selected" value="0">All</option>
                                                    <option value="1">Create</option>
                                                    <option value="2">Update</option>
                                                    <option value="3">Delete</option>
                                                    <option value="4">Login</option>
                                                    <option value="5">Logout</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>หมวดหมู่ผู้ใช้</label>
                                                <select class="form-control select2bs4" style="width: 100%;"
                                                    id="user_id" name="user_id">
                                                    <?php if ($user_data): ?>
                                                        <option selected="selected" value="0">All</option>
                                                        <?php foreach ($user_data as $item): ?>
                                                            <option value="<?= $item['id_user'] ?>"><?= $item['name_user'] . ' ' . $item['lastname_user'] ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>วันที่</label>
                                                <div class="input-group date" id="date_search"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#date_search" id="date_input" name="date_search" />
                                                    <div class="input-group-append" data-target="#date_search"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>ค้นหา</label>
                                                <button type="button" class="btn btn-primary btn-block"
                                                    onclick="getData()"><i class="fas fa-search"></i></button>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID Log</th>
                                                <th class="text-center">List</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">ID User</th>
                                                <th class="text-center">Date-Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>
    </div>

    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/jszip/jszip.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/pdfmake.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/pdfmake/vfs_fonts.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
    <!-- InputMask -->
    <script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
    <script>
        $(document).ready(function () {

            getData();
        });
    </script>
    <script>
        function getData() {
            var daData = null;
            var category = document.getElementById("category").value;
            var user_id = document.getElementById("user_id").value;
            var date_search = $("#date_input").val();
            if (date_search) {
                var formattedDate = moment(date_search); // Convert to desired format
            } else {
                formattedDate = "0";
            }

            $('#example1').DataTable({
                "processing": "<i class='fa fa-refresh fa-spin'></i>",
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('database/log_list/getDatalog/'); ?>" + category + "/" + user_id + "/" + formattedDate,
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                'columns': [
                    {
                        'data': 'id_activities',
                    },
                    {
                        'data': 'text_activities',
                    },
                    {
                        'data': 'type_activities',
                    },
                    {
                        'data': 'id_user',
                    },
                    {
                        'data': function (row) {
                            return row.date_activites + ' ' + row.time_activites;
                        },
                    },
                ],
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "destroy": true,
                "drawCallback": function (settings) {
                    var date_search = settings.json.date_search;
                    console.log(date_search);
                }
            });
        }
    </script>
    <script>
        $(function () {
            //Date picker
            $('#date_search').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        })
    </script>
</body>

</html>