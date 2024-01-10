<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Topic Management</title>

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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Topic Management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Topic Management</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-1">
                                <div class="card-header">
                                    <h3 class="card-title">Topic Management</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool">
                                            <i class="fas fa-plus-square" data-toggle="modal"
                                                data-target="#modal-default-create"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                                href="#pills-home" role="tab" aria-controls="pills-home"
                                                aria-selected="true">Internal Issues</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                                href="#pills-profile" role="tab" aria-controls="pills-profile"
                                                aria-selected="false">External Issues</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                                href="#pills-contact" role="tab" aria-controls="pills-contact"
                                                aria-selected="false">Interested Party</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab">
                                            <table id="example1" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ID</th>
                                                        <th>Details</th>
                                                        <th>Activated</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if ($data_inter_iss): ?>
                                                        <?php foreach ($data_inter_iss as $item): ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?php echo $item['id_internal_issues'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $item['topic'] ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php if ($item['activated'] == 0): ?>
                                                                        <span class='badge'
                                                                            style='background-color: #dc3545; color: #f8f9fa;'>ปิดใช้งาน</span>
                                                                    <?php else: ?>
                                                                        <span class='badge'
                                                                            style='background-color: #28a745; color: #f8f9fa;'>เปิดใช้งาน</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn" data-toggle="modal"
                                                                        data-target="#modal-default-edit"
                                                                        onclick="ShowEdit(<?php echo $item['id_internal_issues']; ?> , 1)">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                </td>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab">
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ID</th>
                                                        <th>Details</th>
                                                        <th>Activated</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if ($data_exter_iss): ?>
                                                        <?php foreach ($data_exter_iss as $item): ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?php echo $item['id_external_issues'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $item['topic'] ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php if ($item['activated'] == 0): ?>
                                                                        <span class='badge'
                                                                            style='background-color: #dc3545; color: #f8f9fa;'>ปิดใช้งาน</span>
                                                                    <?php else: ?>
                                                                        <span class='badge'
                                                                            style='background-color: #28a745; color: #f8f9fa;'>เปิดใช้งาน</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn" data-toggle="modal"
                                                                        data-target="#modal-default-edit"
                                                                        onclick="ShowEdit(<?php echo $item['id_external_issues']; ?> , 2)">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                </td>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                            aria-labelledby="pills-contact-tab">
                                            <table id="example3" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ID</th>
                                                        <th>Details</th>
                                                        <th>Activated</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if ($data_interested_iss): ?>
                                                        <?php foreach ($data_interested_iss as $item): ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?php echo $item['id_interested_issues'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $item['topic'] ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php if ($item['activated'] == 0): ?>
                                                                        <span class='badge'
                                                                            style='background-color: #dc3545; color: #f8f9fa;'>ปิดใช้งาน</span>
                                                                    <?php else: ?>
                                                                        <span class='badge'
                                                                            style='background-color: #28a745; color: #f8f9fa;'>เปิดใช้งาน</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn" data-toggle="modal"
                                                                        data-target="#modal-default-edit"
                                                                        onclick="ShowEdit(<?php echo $item['id_interested_issues']; ?> , 3)">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                </td>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                            <td class="text-center"> - </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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

    <div class="modal fade" id="modal-default-edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form class="mb-3" id="context_select" action="javascript:void(0)" method="post"
                    enctype="multipart/form-data">
                    <div class="overlay preloader">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <div class="modal-header ">
                        <h4 class="modal-title" id="title" name="title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <h5>Activated</h5>
                            <input type="checkbox" name="activated" id="activated" data-bootstrap-switch
                                data-off-color="danger" data-on-color="success">
                        </div>
                        <div class="mt-3">
                            <h5>Topic</h5>
                            <textarea class="form-control" type="text" placeholder="" name="topic" id="topic"
                                disabled></textarea>
                        </div>
                        <div class="mt-3">
                            <h5>Description</h5>
                            <textarea class="form-control" type="text" placeholder="" name="description"
                                id="description" disabled></textarea>
                        </div>
                        <input type="text" id="check" name="check" hidden>
                        <input type="text" id="id_" name="id_" hidden>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="submit" value="Submit"
                            onclick="store_alert('context_select' , 'update')">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-default-create" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="mb-3" id="context_select_create" action="javascript:void(0)" method="post"
                    enctype="multipart/form-data">
                    <div class="overlay preloader">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <div class="modal-header ">
                        <h4 class="modal-title" id="title_create" name="title_create">Create</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <h5>Select Topic</h5>
                            <select class="form-control select2" style="width: 100%;" id="select_topic"
                                name="select_topic">
                                <option selected="selected" value="1">Internal Issues</option>
                                <option value="2">External Issues</option>
                                <option value="3">Interested Party</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <h5>Topic</h5>
                            <textarea class="form-control" type="text" placeholder="" name="topic_create"
                                id="topic_create" required></textarea>
                        </div>
                        <div class="mt-3">
                            <h5>Description</h5>
                            <textarea class="form-control" type="text" placeholder="" name="description_create"
                                id="description_create" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="submit" value="Submit"
                            onclick="store_alert('context_select_create' , 'create')">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
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
        $(function () {
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
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "lengthMenu": [5]
            });
            $('#example3').DataTable({
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
    <script>
        function ShowEdit(id, check) {
            // console.log(id);
            // console.log(check);
            if (check == 1) {
                var data_inter_iss = <?php echo json_encode($data_inter_iss); ?>;
                data_inter_iss.forEach(element => {
                    if (id == element.id_internal_issues) {
                        $(".modal-header #title").text("Internal Issues ID " + id);
                        $(".modal-body #topic").val(element.topic);
                        $(".modal-body #description").val(element.description);
                        $(".modal-body #id_").val(id);
                        $(".modal-body #check").val(check);
                        if (element.activated == 1) {
                            $("input[data-bootstrap-switch]").each(function () {
                                $(this).bootstrapSwitch('state', true);
                            });
                        } else {
                            $("input[data-bootstrap-switch]").each(function () {
                                $(this).bootstrapSwitch('state', false);
                            });
                        }
                    }
                });
            } else if (check == 2) {
                var data_exter_iss = <?php echo json_encode($data_exter_iss); ?>;
                data_exter_iss.forEach(element => {
                    if (id == element.id_external_issues) {
                        $(".modal-header #title").text("External Issues ID " + id);
                        $(".modal-body #topic").val(element.topic);
                        $(".modal-body #description").val(element.description);
                        $(".modal-body #id_").val(id);
                        $(".modal-body #check").val(check);
                        if (element.activated == 1) {
                            $("input[data-bootstrap-switch]").each(function () {
                                $(this).bootstrapSwitch('state', true);
                            });
                        } else {
                            $("input[data-bootstrap-switch]").each(function () {
                                $(this).bootstrapSwitch('state', false);
                            });
                        }
                    }
                });
            } else if (check == 3) {
                var data_interested_iss = <?php echo json_encode($data_interested_iss); ?>;
                data_interested_iss.forEach(element => {
                    if (id == element.id_interested_issues) {
                        $(".modal-header #title").text("Interested Party ID " + id);
                        $(".modal-body #topic").val(element.topic);
                        $(".modal-body #description").val(element.description);
                        $(".modal-body #id_").val(id);
                        $(".modal-body #check").val(check);
                        if (element.activated == 1) {
                            $("input[data-bootstrap-switch]").each(function () {
                                $(this).bootstrapSwitch('state', true);
                            });
                        } else {
                            $("input[data-bootstrap-switch]").each(function () {
                                $(this).bootstrapSwitch('state', false);
                            });
                        }
                    }
                });
            }

        }
    </script>
    <script>
        function store_alert(id_modal, url_link) {
            $("#" + id_modal).off('submit').on('submit', function (e) {
                e.preventDefault();
                // อ่านข้อมูลจากฟอร์ม
                var formData = new FormData(this);

                // Show loading indicator here
                var loadingIndicator = Swal.fire({
                    title: 'Loading...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onOpen: () => {
                        Swal.showLoading();
                    }
                });

                // ส่งคำขอ AJAX
                $.ajax({
                    url: '<?= base_url("database/context_select/") ?>' + url_link,
                    type: "POST",
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    beforeSend: function () {
                        // Show loading indicator here
                        loadingIndicator;
                    },
                    success: function (response) {
                        // ซ่อน loading modal เมื่อ AJAX POST เสร็จสิ้น
                        if (response.success) {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                showConfirmButton: false
                            });
                            setTimeout(() => {
                                if (response.reload) {
                                    window.location.reload();
                                }
                            }, 2000);
                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Hide loading modal when there is an AJAX POST error
                        Swal.fire({
                            title: "เกิดข้อผิดพลาด",
                            icon: 'error',
                            showConfirmButton: true
                        });
                    }
                });
            });
        }

    </script>
</body>

</html>