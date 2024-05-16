<title>Operations Management Version</title>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/dist/css/bootstrap-icons.min.css" rel="stylesheet">
<style>
    th {
        background-color: #F5F6FA;
        text-align: center;
        border-bottom: none;
    }

    tbody {
        border-bottom: 10px;
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

    .text-color {
        color: #316497;
    }


    .table-wrapper {
        max-height: 400px;
        overflow-y: auto;
    }

    .table-wrapper::-webkit-scrollbar {
        width: 10px;
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background-color: #ADB5BD;
        border-radius: 10px;
        border: 3px solid #f1f1f1;
    }

    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background-color: #6C757D;
    }

    .table th,
    .table td {
        white-space: nowrap;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Operations Management
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Operations Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card" id="context-ana">
                    <div class="card-body">
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div>
                                <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                                    <li class="nav-item-tab" style="padding-right: 10px;">
                                        <a class="nav-link active" id="Risk-Context-tab" data-toggle="pill" href="#Risk-Context" role="tab" aria-controls="Risk-Context" aria-selected="true">
                                            Risk Context
                                        </a>
                                    </li>
                                    <li class="nav-item-tab" style="padding-right: 10px;">
                                        <a class="nav-link" id="Risk-IS-tab" data-toggle="pill" href="#Risk-IS" role="tab" aria-controls="Risk-IS" aria-selected="false" onclick="getTableData2();">
                                            Risk IS
                                        </a>
                                    </li>
                                    <li class="nav-item-tab" style="padding-right: 10px;">
                                        <a class="nav-link" id="IS-Objectives-tab" data-toggle="pill" href="#IS-Objectives" role="tab" aria-controls="IS-Objectives" aria-selected="false" onclick="getTableData3();">
                                            IS Objectives
                                        </a>
                                    </li>
                                    <li class="nav-item-tab" style="padding-right: 10px;">
                                        <a class="nav-link" id="Planning-of-Change-tab" data-toggle="pill" href="#Planning-of-Change" role="tab" aria-controls="Planning-of-Change" aria-selected="false" onclick="getTableData4();">
                                            Planning of Change
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="Risk-Context" role="tabpanel" aria-labelledby="org-strategy-tab">
                                <div class="table-wrapper">
                                    <table id="table-risk-context" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ACTION</th>
                                                <th>NO.</th>
                                                <th>RTP NO.</th>
                                                <th>NAME PLANNING</th>
                                                <th>START DATE</th>
                                                <th>END DATE</th>
                                                <th>RESPONSIBLE PERSON</th>
                                                <th>STATUS (%)</th>
                                                <th>EVALUATION</th>
                                                <th>RESULT</th>
                                                <th>ORIGIN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="Risk-IS" role="tabpanel" aria-labelledby="Risk-IS-tab">
                                <div class="table-wrapper">
                                    <table id="table-risk-is" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ACTION</th>
                                                <th>NO.</th>
                                                <th>RTP NO.</th>
                                                <th>NAME PLANNING</th>
                                                <th>START DATE</th>
                                                <th>END DATE</th>
                                                <th>RESPONSIBLE PERSON</th>
                                                <th>STATUS (%)</th>
                                                <th>EVALUATION</th>
                                                <th>RESULT</th>
                                                <th>ORIGIN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="IS-Objectives" role="tabpanel" aria-labelledby="IS-Objectives-tab">
                                <div class="table-wrapper">
                                    <table id="table-is-objectives" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ACTION</th>
                                                <th>NO.</th>
                                                <th>OBJ NO.</th>
                                                <th>NAME PLANNING</th>
                                                <th>START DATE</th>
                                                <th>END DATE</th>
                                                <th>RESPONSIBLE PERSON</th>
                                                <th>STATUS (%)</th>
                                                <th>EVALUATION</th>
                                                <th>RESULT</th>
                                                <th>ORIGIN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="Planning-of-Change" role="tabpanel" aria-labelledby="Planning-of-Change-tab">
                                <div class="table-wrapper">
                                    <table id="table-planning-of-change" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ACTION</th>
                                                <th>NO.</th>
                                                <th>PLO NO.</th>
                                                <th>NAME PLANNING</th>
                                                <th>START DATE</th>
                                                <th>END DATE</th>
                                                <th>RESPONSIBLE PERSON</th>
                                                <th>STATUS (%)</th>
                                                <th>EVALUATION</th>
                                                <th>RESULT</th>
                                                <th>ORIGIN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-default">
        <div id="modal1">
            <?= $this->include("Modal/Requirement_Modal"); ?>
        </div>
        <div id="modal3">
            <?= $this->include("Modal/CRUD_Leadership_modal"); ?>
        </div>
        <div id="modal6">
            <?= $this->include("Modal/CRUD_OP_Risk_Context"); ?>
        </div>
        <div id="modal7">
            <?= $this->include("Modal/CRUD_OP_Risk_IS"); ?>
        </div>
        <div id="modal8">
            <?= $this->include("Modal/CRUD_OP_IS_Objectives"); ?>
        </div>
        <div id="modal9">
            <?= $this->include("Modal/CRUD_OP_Planning_of_Change"); ?>
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
        $(document).ready(function() {
            getTableData1();
        })
    </script>
    <!-- load modal -->
    <script>
        function load_modal(check, data_, status) {
            modal1 = document.getElementById("modal1");
            modal3 = document.getElementById("modal3");
            modal6 = document.getElementById("modal6");
            modal7 = document.getElementById("modal7");
            modal8 = document.getElementById("modal8");
            modal9 = document.getElementById("modal9");

            if (check == '1') {
                //--show modal requirment--//
                modal1.style.display = "block";
                modal3.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";
            } else if (check == '8') {
                //--show modal crud risk context--//
                const rowData = JSON.parse(decodeURIComponent(data_));
                modal1.style.display = "none";
                modal3.style.display = "none";
                modal6.style.display = "block";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "none";

                $(".modal-body #rtp_context_no").val(rowData.rtp_no);
                $(".modal-body #planning_name").val(rowData.name_of_risk_treatment_plan);
                $(".modal-body #start_date").val(rowData.start_date);
                $(".modal-body #end_date").val(rowData.end_date);
                $(".modal-body #owner").val(rowData.risk_ownner);
                $(".modal-body #status").val(rowData.status ?? '0');
                $(".modal-body #evaluation").val(rowData.evaluation);
                $(".modal-body #result").val(rowData.result);
                $(".modal-body #url_route").val("operations/operations_management/risk_context/edit/" + rowData.id_address_risks_context);
            } else if (check == '9') {
                //--show modal crud risk is--//
                const rowData = JSON.parse(decodeURIComponent(data_));
                modal1.style.display = "none";
                modal3.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "block";
                modal8.style.display = "none";
                modal9.style.display = "none";

                $(".modal-body #rtp_is_no").val(rowData.rtp_no);
                $(".modal-body #planning_name").val(rowData.name_of_risk_treatment_plan);
                $(".modal-body #start_date").val(rowData.start_date);
                $(".modal-body #end_date").val(rowData.end_date);
                $(".modal-body #owner").val(rowData.risk_ownner);
                $(".modal-body #status").val(rowData.status ?? '0');
                $(".modal-body #evaluation").val(rowData.evaluation);
                $(".modal-body #result").val(rowData.result);
                $(".modal-body #url_route").val("operations/operations_management/risk_is/edit/" + rowData.id_address_risks_is);
            } else if (check == '10') {
                //--show modal crud is objectives--//
                const rowData = JSON.parse(decodeURIComponent(data_));

                modal1.style.display = "none";
                modal3.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "block";
                modal9.style.display = "none";

                $(".modal-body #obj_no").val(rowData.objectives.obj_no);
                $(".modal-body #planning_name").val(rowData.planning);
                $(".modal-body #start_date_is_objective").val(rowData.start_date);
                $(".modal-body #end_date_is_objective").val(rowData.end_date);
                $(".modal-body #owner").val(rowData.owner);
                $(".modal-body #status").val(rowData.status ?? '0');
                $(".modal-body #evaluation").val(rowData.objectives.evaluation);
                $(".modal-body #result").val(rowData.result);
                $(".modal-body #url_route").val("operations/operations_management/is_objectives/edit/" + rowData.id_planning + "/" + rowData.id_objective);
            } else if (check == '11') {
                //--show modal crud planning of change--//
                const rowData = JSON.parse(decodeURIComponent(data_));

                modal1.style.display = "none";
                modal3.style.display = "none";
                modal6.style.display = "none";
                modal7.style.display = "none";
                modal8.style.display = "none";
                modal9.style.display = "block";

                $(".modal-body #pl_no").val(rowData.pl_no);
                $(".modal-body #planning_name").val(rowData.name_planing_change);
                $(".modal-body #start_date").val(rowData.start_date);
                $(".modal-body #end_date").val(rowData.end_date);
                $(".modal-body #owner").val(rowData.owner);
                $(".modal-body #status").val(rowData.status ?? '0');
                $(".modal-body #evaluation").val(rowData.evaluation);
                $(".modal-body #result").val(rowData.result);
                $(".modal-body #url_route").val("operations/operations_management/planning_change/edit/" + rowData.id_planning_changes);
            }
        }
    </script>
    <script>
        function OriginInfoRiskContext() {
            // อนาคตแก้เป็นลิ้งของ ra & rtp result context นะคะ
            window.location.href = "<?= base_url('context/loaddatatype/15') ?>";
        }

        function OriginInfoRiskIS() {
            // อนาคตแก้เป็นลิ้งของ ra & rtp result is นะคะ
            window.location.href = "<?= base_url('context/loaddatatype/16') ?>";
        }

        function OriginInfoISObjectives() {
            window.location.href = "<?= base_url('context/loaddatatype/10') ?>";
        }

        function OriginInfoPlanningofChange() {
            window.location.href = "<?= base_url('context/loaddatatype/11') ?>";
        }
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));
            $.ajax({
                url: '<?= base_url() ?>' + url,
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: true
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
                error: function(xhr, status, error) {
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
        var countTable1 = 0;

        function getTableData1() {
            if (countTable1 === 0) {
                countTable1++;
                if ($.fn.DataTable.isDataTable('#table-risk-context')) {
                    $('#table-risk-context').DataTable().destroy();
                }
                $('#table-risk-context').DataTable({
                    "processing": true,
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('operations/operations_management/risk_context/getdata'); ?>",
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": true,
                    "searching": true,
                    "ordering": false,
                    "drawCallback": function(settings) {
                        $("#interested_table .overlay").hide();
                        var daData = settings.json.data;
                        if (daData.length == 0) {
                            $('#table-risk-context tbody').html(`
                            <tr>
                                <td colspan="11">
                                    ไม่พบข้อมูล
                                </td>
                            </tr>`);
                        }
                    },
                    'columns': [{
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                var number_index = +meta.settings.oAjaxData.start + 1;
                                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                let dropdownHtml = `<a href="javascript:void(0)" style="color: rgba(0, 123, 255, 1);" data-toggle="modal" data-target="#modal-default" onclick="load_modal(8, '${encodedRowData}')"><i class="fas fa-edit"></i></a>`;
                                return dropdownHtml;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.rtp_no ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.name_of_risk_treatment_plan ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.start_date ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.end_date ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.risk_ownner ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.status ?? '0') + '%</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.evaluation ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.result ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<span style="color:#007BFF; cursor:pointer;" onclick="OriginInfoRiskContext()"><i class="fas fa-map-marker-alt"></i></span>';
                            }
                        },
                    ],
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    </script>
    <script>
        var countTable2 = 0;

        function getTableData2() {
            if (countTable2 === 0) {
                countTable2++;
                if ($.fn.DataTable.isDataTable('#table-risk-is')) {
                    $('#table-risk-is').DataTable().destroy();
                }
                $('#table-risk-is').DataTable({
                    "processing": true,
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('operations/operations_management/risk_is/getdata'); ?>",
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": true,
                    "searching": true,
                    "ordering": false,
                    "drawCallback": function(settings) {
                        $("#interested_table .overlay").hide();
                        var daData = settings.json.data;
                        if (daData.length == 0) {
                            $('#table-risk-is tbody').html(`
                            <tr>
                                <td colspan="11">
                                    ไม่พบข้อมูล
                                </td>
                            </tr>`);
                        }
                    },
                    'columns': [{
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                var number_index = +meta.settings.oAjaxData.start + 1;
                                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                let dropdownHtml = `<a href="javascript:void(0)" style="color: rgba(0, 123, 255, 1);" data-toggle="modal" data-target="#modal-default" onclick="load_modal(9, '${encodedRowData}')"><i class="fas fa-edit"></i></a>`;
                                return dropdownHtml;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.rtp_no ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.name_of_risk_treatment_plan ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.start_date ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.end_date ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.risk_ownner ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.status ?? '0') + '%</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.evaluation ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.result ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<span style="color:#007BFF; cursor:pointer;" onclick="OriginInfoRiskIS()"><i class="fas fa-map-marker-alt"></i></span>';
                            }
                        },
                    ],
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    </script>
    <script>
        var countTable3 = 0;

        function getTableData3() {
            if (countTable3 === 0) {
                countTable3++;
                if ($.fn.DataTable.isDataTable('#table-is-objectives')) {
                    $('#table-is-objectives').DataTable().destroy();
                }
                $('#table-is-objectives').DataTable({
                    "processing": true,
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('operations/operations_management/is_objectives/getdata'); ?>",
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": true,
                    "searching": true,
                    "ordering": false,
                    "drawCallback": function(settings) {
                        $("#interested_table .overlay").hide();
                        var daData = settings.json.data;
                        if (daData.length == 0) {
                            $('#table-is-objectives tbody').html(`
                            <tr>
                                <td colspan="11">
                                    ไม่พบข้อมูล
                                </td>
                            </tr>`);
                        }
                    },
                    'columns': [{
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                var number_index = +meta.settings.oAjaxData.start + 1;
                                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                let dropdownHtml = `<a href="javascript:void(0)" style="color: rgba(0, 123, 255, 1);" data-toggle="modal" data-target="#modal-default" onclick="load_modal(10, '${encodedRowData}')"><i class="fas fa-edit"></i></a>`;
                                return dropdownHtml;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.objectives.obj_no ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.planning ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.start_date ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.end_date ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.owner ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.status ?? '0') + '%</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.objectives.evaluation ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.result ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<span style="color:#007BFF; cursor:pointer;" onclick="OriginInfoISObjectives()"><i class="fas fa-map-marker-alt"></i></span>';
                            }
                        },
                    ],
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    </script>
    <script>
        var countTable4 = 0;

        function getTableData4() {
            if (countTable4 === 0) {
                countTable4++;
                if ($.fn.DataTable.isDataTable('#table-planning-of-change')) {
                    $('#table-planning-of-change').DataTable().destroy();
                }
                $('#table-planning-of-change').DataTable({
                    "processing": true,
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('operations/operations_management/planning_change/getdata'); ?>",
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": true,
                    "searching": true,
                    "ordering": false,
                    "drawCallback": function(settings) {
                        $("#interested_table .overlay").hide();
                        var daData = settings.json.data;
                        console.table(daData);
                        if (daData.length == 0) {
                            $('#table-planning-of-change tbody').html(`
                            <tr>
                                <td colspan="11">
                                    ไม่พบข้อมูล
                                </td>
                            </tr>`);
                        }
                    },
                    'columns': [{
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                var number_index = +meta.settings.oAjaxData.start + 1;
                                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                let dropdownHtml = `<a href="javascript:void(0)" style="color: rgba(0, 123, 255, 1);" data-toggle="modal" data-target="#modal-default" onclick="load_modal(11, '${encodedRowData}')"><i class="fas fa-edit"></i></a>`;
                                return dropdownHtml;
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.pl_no ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.name_planing_change ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.start_date ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.end_date ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.owner ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.status ?? '0') + '%</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.evaluation ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.result ?? '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                return '<span style="color:#007BFF; cursor:pointer;" onclick="OriginInfoPlanningofChange()"><i class="fas fa-map-marker-alt"></i></span>';
                            }
                        },
                    ],
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    </script>