<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Role Management</title>

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
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
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <h3 class="card-title">Data Role list</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool">
                                            <i class="fas fa-plus-square" data-toggle="modal" data-target="#modal-management-role" onclick="load_modal(1)"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID Role</th>
                                                <th>Name Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($data) : ?>
                                                <?php foreach ($data as $item) : ?>
                                                    <tr>
                                                        <td><?= $item['id_role'] ?></td>
                                                        <td><?= $item['name_role'] ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn" data-toggle="modal" data-target="#modal-management-role" onclick="load_modal(2 , <?= $item['id_role'] ?>)">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </td>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <td>ไม่มีข้อมูล</td>
                                                    <td>ไม่มีข้อมูล</td>
                                                    <td>ไม่มีข้อมูล</td>
                                                    <td>ไม่มีข้อมูล</td>
                                                    <td>ไม่มีข้อมูล</td>
                                                    <td>ไม่มีข้อมูล</td>
                                                    <td>ไม่มีข้อมูล</td>
                                                    <td>ไม่มีข้อมูล</td>
                                                    </tr>
                                        </tbody>
                                    <?php endif; ?>
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

    <div class="modal fade" id="modal-management-role">
        <div id="modal1">
            <?= $this->include("Modal/Role_Management"); ?>
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
    <!-- bs-custom-file-input -->
    <script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
    <!-- Bootstrap Switch -->
    <script src="<?= base_url('plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"></script>


    <script>
        function load_modal(params, id_) {
            // console.log(check);
            // console.log(data)
            modal1 = document.getElementById("modal1");

            if (params == '1') {
                //--create--//
                $(".modal-header #title_modal").text("Create Role");
                $(".modal-body #params").val(params);
                $(".modal-body #namerole").val('');
            } else if (params == '2') {
                var data = <?php echo json_encode($data); ?>;

                data.forEach(element => {
                    $(".modal-header #title_modal").text("Edit Role");
                    $(".modal-body #params").val(params);
                    $(".modal-body #id_").val(id_);

                    if (element.id_role == id_) {
                        $(".modal-body #namerole").val(element.name_role);
                        if (element.status == 1) {
                            $("input[data-bootstrap-switch]").each(function() {
                                $(this).bootstrapSwitch('state', true);
                            });
                        } else {
                            $("input[data-bootstrap-switch]").each(function() {
                                $(this).bootstrapSwitch('state', false);
                            });
                        }
                    }
                });
            }
        }
    </script>

    <script>
        $(function() {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "lengthMenu": [5]
            });
        });
    </script>
</body>

</html>