<!DOCTYPE html>
<html lang="en">

<head>
    <title>Internal Audit Version</title>
    <!-- FullCalendar CSS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300,400,400i,700&display=swap">
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

    .dropdown-submenu:hover .dropdown-menu {
        display: block;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        left: -100%;
        margin-top: 0;
        border-radius: 10px;
    }

    .dropdown-submenu .right-menu-table {
        left: 100%;
        margin-top: 0;
        border-radius: 10px;
    }

    .button-table {
        border-color: transparent;
        background-color: transparent;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Internal Audit
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Internal Audit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link title-topic active" id="pills-audit-management-tab" data-toggle="pill" href="#pills-audit-management" role="tab" aria-controls="pills-audit-management" aria-selected="true">Audit Management</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link title-topic" id="pills-audit-result-tab" data-toggle="pill" href="#pills-audit-result" role="tab" aria-controls="pills-audit-result" aria-selected="false" onclick="getTableData();">Audit Result</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-audit-management" role="tabpanel" aria-labelledby="pills-audit-management-tab">
                        <?php include("Perf_AuditManagement.php"); ?>
                    </div>
                    <div class="tab-pane fade" id="pills-audit-result" role="tabpanel" aria-labelledby="pills-audit-result-tab">
                        <?php include("Perf_Audit_Result.php"); ?>
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
            <?= $this->include("Modal/Context_Ver"); ?>
        </div>
        <div id="modal3">
            <?= $this->include("Modal/CRUD_Perf_Audit_Program"); ?>
        </div>
        <div id="modal4">
            <?= $this->include("Modal/CRUD_Note"); ?>
        </div>
        <div id="modal5">
            <?= $this->include("Modal/Reject_Modal"); ?>
        </div>
        <div id="modal6">
            <?= $this->include("Modal/File_Rename_Modal"); ?>
        </div>
        <div id="modal7">
            <?= $this->include("Modal/CRUD_Perf_Audit_Plan"); ?>
        </div>
        <div id="modal8">
            <?= $this->include("Modal/CRUD_Perf_Audit_Checklist"); ?>
        </div>
        <div id="modal9">
            <?= $this->include("Modal/CRUD_Perf_Audit_Report"); ?>
        </div>
        <div id="modal10">
            <?= $this->include("Modal/CRUD_Perf_Audit_Result"); ?>
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
    <!-- Summernote -->
    <script src="<?= base_url('plugins/summernote/summernote-bs4.min.js'); ?>"></script>
    <!-- CodeMirror -->
    <script src="<?= base_url('plugins/codemirror/codemirror.js'); ?>"></script>
    <script src="<?= base_url('plugins/codemirror/mode/css/css.js'); ?>"></script>
    <script src="<?= base_url('plugins/codemirror/mode/xml/xml.js'); ?>"></script>
    <script src="<?= base_url('plugins/codemirror/mode/htmlmixed/htmlmixed.js'); ?>"></script>

    <script>
        function load_modal(check, data_, status) {
            modal1 = document.getElementById("modal1");
            modal2 = document.getElementById("modal2");
            modal3 = document.getElementById("modal3");
            modal4 = document.getElementById("modal4");
            modal5 = document.getElementById("modal5");
            modal6 = document.getElementById("modal6");
            modal7 = document.getElementById("modal7");
            modal8 = document.getElementById("modal8");
            modal9 = document.getElementById("modal9");
            modal10 = document.getElementById("modal10");

            if (check == '1') {
                //--show modal requirment--//
                modal1.style.display = "block";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

            } else if (check == '2') {
                //--show modal Version Control--//
                modal1.style.display = "none";
                modal2.style.display = "block";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

                var element = <?php echo json_encode($data); ?>;
                $(".modal-body #description").text(element.details);
                $(".modal-body #status").val(element.status);
                $(".modal-body #commentTextArea").text(element.comment_reject);
                $(".modal-body #id_").val(element.id_version);
                var modified_day = "";
                var reviewed_day = "";
                var approved_day = "";
                var announce_date = "";
                $(".modal-body #modified").val(element.modified_date);
                $(".modal-body #reviewed").val(element.review_date);
                $(".modal-body #approved").val(element.approved_date);
                $(".modal-body #announce").val(element.announce_date);
                check_status(element.status);
            } else if (check == '3') {
                //--show modal audit program-//
                console.log('open modal audit program')
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "block";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

                $(".modal-body #url_route").val('internal_audit/audit_program/create');

            } else if (check == '4') {
                //--show modal objective create--//
                const formGroupFile = document.getElementById("form-group-file");
                const formGroupText = document.getElementById("form-group-text");
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "block";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

                formGroupFile.style.display = "none";
                formGroupText.style.display = "block";
                $(".modal-body #text").val('');

                var data = <?php echo json_encode($data); ?>;
                $(".modal-header #title_modal").text("IS Objective");
                $(".modal-body #url_route").val("leadership/commitment/is_objective/create/" + data.id_version + "/" +
                    status);
            } else if (check == '5') {
                //--show modal objective edit--//
                const formGroupFile = document.getElementById("form-group-file");
                const formGroupText = document.getElementById("form-group-text");
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "block";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

                formGroupFile.style.display = "none";
                formGroupText.style.display = "block";
                const rowData = JSON.parse(decodeURIComponent(data_));
                $(".modal-header #title_modal").text("IS Objective");
                $(".modal-body #text").val(rowData.text);
                $(".modal-body #url_route").val("leadership/commitment/is_objective/edit/" + rowData.id_is_objective + "/" +
                    rowData.id_version + "/" + status);
            } else if (check == '6') {
                //--show modal create note--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "block";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

                var data = <?php echo json_encode($data); ?>;
                $(".modal-header #title_modal").text("Note");
                $(".modal-body #modified").val(data.modified_date);
                $(".modal-body #check").val(10);
                $(".modal-body #params").val(10);
            } else if (check == '7') {
                //--show modal Reject--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "block";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

                $(".modal-body #status").val(data_);
                var element = <?php echo json_encode($data); ?>;
                $(".modal-body #modified_date").val(element.modified_date);
            } else if (check == '8') {
                //--show modal Rename File--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "block";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

                const rowData = JSON.parse(decodeURIComponent(data_));
                // แบ่งข้อความด้วยจุด (.)
                var parts = rowData.name_file.split('.');

                // นับจำนวนส่วนหลังจากการแบ่งด้วยจุด
                var numberOfParts = parts.length;

                // สร้างตัวแปรเพื่อเก็บส่วนทั้งหมดยกเว้นส่วนสุดท้าย
                var exceptLastPart = "";

                for (var i = 0; i < numberOfParts - 1; i++) {
                    exceptLastPart += parts[i];
                    if (i < numberOfParts - 2) {
                        exceptLastPart += "."; // เพิ่มจุด (.) หลังจากทุกส่วนยกเว้นส่วนสุดท้าย
                    }
                }
                // กำหนดค่าให้กับองค์ประกอบที่มี ID "namefile" ใน Modal Body
                $(".modal-body #oldname").val(rowData.name_file);
                $(".modal-body #oldnameFile").val(exceptLastPart);
                $(".modal-body #namefile").val(exceptLastPart);
                $(".modal-body #url_route").val("leadership/file_ls/rename/" + rowData.id_ls_file);
            } else if (check == '9') {
                //--show modal audit program-//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "block";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "none";

                var data_id = data_;

                getTableData1(data_id);
                getTableData2(data_id);
                getTableData3(data_id);

                <?php foreach($audit_plan as $row1) { ?>
                    if (<?=$row1['id_audit_plan']?> == data_id) {
                        document.getElementById('projectname_detail').innerHTML = "<?=$row1['program_name']?>";
                        document.getElementById('startdate_detail').innerHTML = "<?=$row1['start_date']?>";
                        document.getElementById('enddate_detail').innerHTML = "<?=$row1['end_date']?>";

                        $(".p-4 #id_plan_schedule").val('<?=$row1['id_audit_plan']?>');
                        $(".p-4 #id_plan_checklist").val('<?=$row1['id_audit_plan']?>');
                        $(".p-4 #id_plan_report").val('<?=$row1['id_audit_plan']?>');
                        $(".p-4 #url_route_schedule").val('internal_audit/schedule/create');
                        $(".p-4 #url_route_checklist").val('internal_audit/checklist/create');
                        $(".p-4 #url_route_report").val('internal_audit/report/create');
                    }
                <?php } ?>

                <?php foreach($initial_data as $row2) { ?>
                    if (<?=$row2['id_audit_plan']?> == data_id) {
                        $(".modal-body #auditobjectives").val('<?=$row2['audit_objective']?>');
                        $(".modal-body #auditscope").val('<?=$row2['audit_scope']?>');
                        $(".modal-body #auditcriteria").val('<?=$row2['audit_criteria']?>');
                        $(".modal-body #auditlead").val('<?=$row2['audit_lead']?>');
                        $(".modal-body #auditteam").val('<?=$row2['audit_team']?>');
                        $(".modal-body #url_route").val('internal_audit/initial_data/update/<?=$row2['id_initial_data']?>');
                    }
                <?php } ?>

            } else if (check == '10') {
                //--show modal audit program-//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "block";
                modal9.style.display = "none";
                modal10.style.display = "none";

            } else if (check == '11') {
                //--show modal audit program-//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "block";
                modal10.style.display = "none";

            } else if (check == '12') {
                //--show modal audit program-//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
                modal10.style.display = "block";

            }
        }
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));

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
                url: '<?= base_url() ?>' + url,
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
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: false
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
        function confirm_Alert(text, url) {
            Swal.fire({
                title: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "Submit",
                preConfirm: () => {
                    return $.ajax({
                        url: '<?= base_url() ?>' + url,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Loading...',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                showConfirmButton: false,
                            });
                        },
                    }).then(function(response) {
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
                    });
                }
            });
        }
    </script>
</body>

</html>