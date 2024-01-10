<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permission Management</title>

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
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('plugins/select2/css/select2.min.css'); ?>">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?= base_url('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'); ?>">
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

    label[for="topic"] {
        color: white;
    }
</style>

<body class=" hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <h3 class="card-title">Permission Management</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" onclick="click_edit()">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label>หมวดหมู่หัวข้อ</label>
                                                <select class="form-control select2bs4" style="width: 100%;" id="topic"
                                                    name="topic">
                                                    <?php if ($topic_table): ?>
                                                        <?php foreach ($topic_table as $item): ?>
                                                            <option value="<?= $item['id_topic'] ?>">
                                                                <?= $item['topic_standard'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
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
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>สิทธิ์ในการ Create</label>
                                                <div class="select2-secondary ">
                                                    <select class="select2" multiple="multiple"
                                                        data-placeholder="Select user"
                                                        data-dropdown-css-class="select2-secondary "
                                                        style="width: 100%;" id="Create_Select">
                                                        <?php if ($user_data): ?>
                                                            <?php foreach ($user_data as $item): ?>
                                                                <option value="<?= $item['id_user'] ?>">
                                                                    <?= $item['name_user'] . ' ' . $item['lastname_user'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>สิทธิ์ในการ Review</label>
                                                <div class="select2-warning">
                                                    <select class="select2" multiple="multiple"
                                                        data-placeholder="Select user"
                                                        data-dropdown-css-class="select2-warning" style="width: 100%;"
                                                        id="Review_Select">
                                                        <?php if ($user_data): ?>
                                                            <?php foreach ($user_data as $item): ?>
                                                                <option value="<?= $item['id_user'] ?>">
                                                                    <?= $item['name_user'] . ' ' . $item['lastname_user'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>สิทธิ์ในการ Approved</label>
                                                <div class="select2-success">
                                                    <select class="select2" multiple="multiple"
                                                        data-placeholder="Select user"
                                                        data-dropdown-css-class="select2-success" style="width: 100%;"
                                                        id="Approved_Select">
                                                        <?php if ($user_data): ?>
                                                            <?php foreach ($user_data as $item): ?>
                                                                <option value="<?= $item['id_user'] ?>">
                                                                    <?= $item['name_user'] . ' ' . $item['lastname_user'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix"
                                    style="display: flex; justify-content: center; gap: 10px;">
                                    <button type="submit" class="btn btn-success" name="submit" id="submit"
                                        value="Submit"
                                        onclick="store_alert('requirement_edit' , 'update')">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="close"
                                        onclick="click_close()">Close</button>
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
    <!-- Select2 -->
    <script src="<?= base_url('plugins/select2/js/select2.full.min.js'); ?>"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="<?= base_url('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js'); ?>"></script>

    <script>
        $(document).ready(function () {
            $(".select2").select2({
                closeOnSelect: false,
                placeholder: "Placeholder",
                allowHtml: true,
                allowClear: true,
                tags: true // creates new options on the fly
            });
            $('#Create_Select').prop('disabled', true);
            $('#Review_Select').prop('disabled', true);
            $('#Approved_Select').prop('disabled', true);
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "none";
            close_btn.style.display = "none";
        });
    </script>

    <script>
        function click_edit() {
            $('#Create_Select').prop('disabled', false);
            $('#Review_Select').prop('disabled', false);
            $('#Approved_Select').prop('disabled', false);
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "block";
            close_btn.style.display = "block";
        }
        function click_close() {
            $('#Create_Select').prop('disabled', true);
            $('#Review_Select').prop('disabled', true);
            $('#Approved_Select').prop('disabled', true);
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "none";
            close_btn.style.display = "none";
        }
        function store_alert() {
            var formData = new FormData();
            formData.append('Create_Select', $('#Create_Select').val());
            formData.append('Review_Select', $('#Review_Select').val());
            formData.append('Approved_Select', $('#Approved_Select').val());
            formData.append('Toic', $('#topic').val());
            var loadingIndicator = Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: () => {
                    Swal.showLoading();
                }
            });            // ส่งคำขอ AJAX
            $.ajax({
                url: '<?= base_url("permission/context/create") ?>',
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
                    console.log(response);

                    if (response.success) {
                        console.log(response.data);
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
                    console.error(error);

                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        showConfirmButton: true
                    });
                }
            });
        }
    </script>

    <script>
        // $(document).ready(function () {
        //     $("#topic").on("change", function () {
        //         var selectedValue = $(this).val(); // Get the selected value
        //         var selectedText = $("#topic option:selected").text(); // Get the selected option text

        //         console.log("Selected Value: " + selectedValue);
        //         console.log("Selected Text: " + selectedText);

        //         var topic_table = <?php echo json_encode($topic_table); ?>;
        //         var create_id_user = topic_table[selectedValue - 1]['create_id_user'];
        //         var review_id_user = topic_table[selectedValue - 1]['review_id_user'];
        //         var approved_id_user = topic_table[selectedValue - 1]['approved_id_user'];

        //         // Split the user IDs into an array
        //         var selectedUserIds1 = create_id_user.split(',');
        //         var selectedUserIds2 = review_id_user.split(',');
        //         var selectedUserIds3 = approved_id_user.split(',');

        //         // Set selected options in the dropdown
        //         $("#Create_Select").val(selectedUserIds1).trigger('change');
        //         $("#Review_Select").val(selectedUserIds2).trigger('change');
        //         $("#Approved_Select").val(selectedUserIds3).trigger('change');
        //     });
        //     var topic_table = <?php echo json_encode($topic_table); ?>;
        //     var create_id_user = topic_table[0]['create_id_user'];
        //     var review_id_user = topic_table[0]['review_id_user'];
        //     var approved_id_user = topic_table[0]['approved_id_user'];

        //     // Split the user IDs into an array
        //     var selectedUserIds1 = create_id_user.split(',');
        //     var selectedUserIds2 = review_id_user.split(',');
        //     var selectedUserIds3 = approved_id_user.split(',');

        //     // Set selected options in the dropdown
        //     $("#Create_Select").val(selectedUserIds1).trigger('change');
        //     $("#Review_Select").val(selectedUserIds2).trigger('change');
        //     $("#Approved_Select").val(selectedUserIds3).trigger('change');
        // });
    </script>

    <script>
        $(document).ready(function () {
            changeData();
        });
        function changeData() {
            var selectTopic = document.getElementById("topic").value;
            var topic_table = <?php echo json_encode($topic_table); ?>;
            var create_id_user = topic_table[selectTopic - 1]['create_id_user'];
            var review_id_user = topic_table[selectTopic - 1]['review_id_user'];
            var approved_id_user = topic_table[selectTopic - 1]['approved_id_user'];

            // Split the user IDs into an array
            if (create_id_user) {
                var selectedUserIds1 = create_id_user.split(',');
            }
            if (review_id_user) {
                var selectedUserIds2 = review_id_user.split(',');
            }
            if (approved_id_user) {
                var selectedUserIds3 = approved_id_user.split(',');
            }

            // Set selected options in the dropdown
            $("#Create_Select").val(selectedUserIds1).trigger('change');
            $("#Review_Select").val(selectedUserIds2).trigger('change');
            $("#Approved_Select").val(selectedUserIds3).trigger('change');
        }
    </script>
</body>

</html>