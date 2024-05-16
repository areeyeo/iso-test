<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requirement Management</title>

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
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('plugins/summernote/summernote-bs4.min.css'); ?>">
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

    label[for="topic"] {
        color: white;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Requirement Management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Requirement Management</li>
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
                                    <h3 class="card-title">Requirement Management</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool">
                                            <i class="fas fa-plus-square" data-toggle="modal"
                                                data-target="#modal-default-create"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" onclick="click_edit()">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>หมวดหมู่หัวข้อ</label>
                                                <select class="form-control select2bs4" style="width: 100%;" id="topic"
                                                    name="topic">
                                                    <option value="1" id="1">4.1 Context</option>
                                                    <option value="2" id="2">4.2 Interested Party</option>
                                                    <option value="3" id="3">4.3 ISMS Scope</option>
                                                    <option value="4" id="4">4.4 ISMS Process</option>
                                                    <option value="5" id="5">5.1 Leadership</option>
                                                    <option value="6" id="6">5.2 Policy</option>
                                                    <option value="7" id="7">5.3 Org Roles</option>
                                                    <option value="8" id="8">6.1</option>
                                                    <option value="9" id="9">6.2 Information security objectives and planning to achieve them</option>
                                                    <option value="10" id="10">6.3 Planning of changes</option>
                                                    <option value="11" id="11">7.1 รอข้อมูล</option>
                                                    <option value="12" id="12">7.2 Competence</option>
                                                    <option value="13" id="13">7.3 Awareness</option>
                                                    <option value="14" id="14">7.4 Communication</option>
                                                    <option value="15" id="15">7.5</option>
                                                    <option value="16" id="16">8.2 Information security risk assessment</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-2">
                                            <label for="topic">.</label>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary btn-block"
                                                    onclick="changeData()">ตกลง</i></button>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    <form class="mb-3" id="requirement_edit" action="javascript:void(0)" method="post"
                                        enctype="multipart/form-data">
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <textarea class="form-control" type="text" placeholder="" name="topic_"
                                                id="topic_"></textarea>
                                            <textarea class="form-control" type="text" placeholder="" name="details_"
                                                id="details_"></textarea>
                                            <input type="text" id="id_" name="id_" hidden>
                                        </div>
                                        <div class="card-footer clearfix"
                                            style="display: flex; justify-content: center; gap: 10px;">
                                            <button type="submit" class="btn btn-success" name="submit" id="submit"
                                                value="Submit"
                                                onclick="store_alert('requirement_edit' , 'update')">Save</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="close"
                                                onclick="click_close()">Close</button>
                                        </div>
                                    </form>
                                    <!-- /.card-body -->
                                </div>
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

    <div class="modal fade" id="modal-default-create" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form class="mb-3" id="requirement_create" action="javascript:void(0)" method="post"
                    enctype="multipart/form-data">
                    <div class="overlay preloader">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <div class="modal-header ">
                        <h4 class="modal-title" id="title_create" name="title_create">Create Requirement</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-3">
                            <h5>Topic Standart</h5>
                            <textarea class="form-control" type="text" placeholder="" name="topic_create"
                                id="summernote1"></textarea>
                        </div>
                        <div class="mt-3">
                            <h5>Details</h5>
                            <textarea class="form-control" type="text" placeholder="" name="description_create"
                                id="summernote2"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="submit" value="Submit"
                            onclick="store_alert('requirement_create' , 'create')">Save</button>
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
    <!-- Summernote -->
    <script src="<?= base_url('plugins/summernote/summernote-bs4.min.js'); ?>"></script>
    <!-- CodeMirror -->
    <script src="<?= base_url('plugins/codemirror/codemirror.js'); ?>"></script>
    <script src="<?= base_url('plugins/codemirror/mode/css/css.js'); ?>"></script>
    <script src="<?= base_url('plugins/codemirror/mode/xml/xml.js'); ?>"></script>
    <script src="<?= base_url('plugins/codemirror/mode/htmlmixed/htmlmixed.js'); ?>"></script>


    <script>
        $(document).ready(function () {
            // Summernote
            $("#summernote1").summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline',]],
                ]
            });
            $("#summernote2").summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline',]],
                ]
            });
            $("#topic_").summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline',]],
                ]
            });
            $("#details_").summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline',]],
                ]
            });
            $("#topic_").summernote('disable');
            $("#details_").summernote('disable');
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "none";
            close_btn.style.display = "none";

            changeData(0);
        });
    </script>
    <script>
        var topic_select = document.getElementById("topic");
        var data_requirement = <?php echo json_encode($data_requirement); ?>;
        console.log(data_requirement);
        // topic_select.addEventListener("change", function () {
        //     changeData(topic_select.value - 1);
        // });
        function changeData(id) {
            var topic_select = document.getElementById("topic");
            id = topic_select.value - 1;
            console.log(data_requirement[id]);
            $("#topic_").summernote('code', data_requirement[id]['topic_standart']);
            $("#details_").summernote('code', data_requirement[id]['details']);
            $("#id_").val(data_requirement[id]['id_standard']);
        }
    </script>
    <script>
        function click_edit() {
            $("#topic_").summernote('enable');
            $("#details_").summernote('enable');
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "block";
            close_btn.style.display = "block";
        }
        function click_close() {
            $("#topic_").summernote('disable');
            $("#details_").summernote('disable');
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "none";
            close_btn.style.display = "none";
        }
    </script>
    <script>
        $(document).ready(function () {
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
    <script>
        function store_alert(id_modal, url_link) {
            $("#" + id_modal).off('submit').on('submit', function (e) {
                e.preventDefault();
                // อ่านข้อมูลจากฟอร์ม
                var formData = new FormData(this);
                var loadingIndicator = Swal.fire({
                    title: 'Loading...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    url: '<?= base_url("database/context_requirement/") ?>' + url_link,
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
                        // ซ่อน loading modal เมื่อเกิดข้อผิดพลาดในการ AJAX POST

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