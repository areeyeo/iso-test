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


    /* .table-wrapper {
        max-height: 400px;
        overflow-y: auto;
    } */

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
                        <h1>Performance Evaluation
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Performance Evaluation</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div style="display: flex; flex-direction: column; align-items: flex-end;">
                    <div>
                        <span style="color: #007bff;">จำนวนรายการที่ผ่านการประเมิน:</span>
                        <span style="color: #666666;" id="num_pass"></span>
                    </div>
                    <div>
                        <span style="color: #007bff;">จำนวนรายการที่ไม่ผ่านการประเมิน:</span>
                        <span style="color: #666666;" id="num_fail"></span>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="tab-content" id="tabs-tabContent">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4>Performance Evaluation</h4>
                                    <div>
                                        <select class="form-select form-control" aria-label="Default select example" id="search_about" name="search_about" onchange="getTableData1()">
                                            <option value="0">Search About...</option>
                                            <option value="1">Items that pass the evaluation.</option>
                                            <option value="2">Items that do not pass the evaluation criteria.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-wrapper">
                                    <table id="example1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NO.</th>
                                                <th>OBJ NO.</th>
                                                <th>OBJECTIVE</th>
                                                <th>EVALUATION</th>
                                                <th>PLANNING</th>
                                                <th>WHEN TO EVALUATED</th>
                                                <th>ACTUAL</th>
                                                <th>WHO SHALL MONITOR</th>
                                                <th>METHODS FOR MONITORING</th>
                                                <th>CRITERIA</th>
                                                <th>RESULT</th>
                                                <th>ACTION</th>
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
        <div id="modal2">
            <?= $this->include("Modal/CRUD_Perf_Performance_Evaluation"); ?>
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

    <!-- load modal -->
    <script>
        function load_modal(check, encoded_element_planning, encoded_obj) {

            modal1 = document.getElementById("modal1");
            modal2 = document.getElementById("modal2");

            if (check == '1') {
                //--show modal requirment--//
                modal1.style.display = "block";
                modal2.style.display = "none";
            } else if (check == '2') {
                //--show modal Performance Evaluation --//
                const element_planning = JSON.parse(decodeURIComponent(encoded_element_planning));
                const element_obj = JSON.parse(decodeURIComponent(encoded_obj));
                modal1.style.display = "none";
                modal2.style.display = "block";

                $(".modal-body #obj_no_detail").text(element_obj.obj_no);
                $(".modal-body #objective").text(element_obj.objective);
                $(".modal-body #evaluation").text(element_obj.evaluation);

                $(".modal-body #planning").text(element_planning.planning);
                const date_start = new Date(element_planning.start_date);
                const date_end = new Date(element_planning.end_date);
                const options = {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                };
                const formattedDate_start = date_start.toLocaleDateString('en-GB', options).replace(/\./g, '');
                const formattedDate_end = date_end.toLocaleDateString('en-GB', options).replace(/\./g, '');
                $(".modal-body #startdate_detail").text(formattedDate_start == 'Invalid Date' ?  '-' : formattedDate_start);
                $(".modal-body #enddate_detail").text(formattedDate_end == 'Invalid Date' ?  '-' : formattedDate_end);
                $(".modal-body #who_detail").text(element_planning.owner);
                $(".modal-body #methods_detail").text(element_planning.evaluation_methods);
                $(".modal-body #when_evaluated_detail").text(element_planning.date_evaluation);
                $(".modal-body #actual").val(element_planning.actual);
                $(".modal-body #criteria").val(element_planning.criteria);
                $(".modal-body #evaluation_results").val(element_planning.evaluation_results ?? '0');
                $(".modal-body #url_route").val('performance/performance_management/edit/' + element_planning.id_planning);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            getTableData1();
        })

        function getTableData1() {
            var select_about = document.getElementById('search_about').value;
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            $('#example1').DataTable({
                "processing": true,
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('performance/performance_management/getdata/'); ?>" + select_about,
                    'type': 'GET',
                },
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "ordering": false,
                "drawCallback": function(settings) {
                    var daData = settings.json.data;
                    var count_ = 0;
                    $('#num_pass').text(settings.json.data_count.count_pass + ' รายการ (Pass)');
                    $('#num_fail').text(settings.json.data_count.count_fail + ' รายการ (Fail)');
                    if (daData.length == 0) {
                        $('#example1 tbody').html(`
                                <tr>
                                    <td colspan="12">
                                        <p class="text-center">No data available in table</p>
                                    </td>
                                </tr>`);
                    } else {
                        // Use append() to add new rows to the existing content
                        $('#example1 tbody').empty();
                        daData.forEach(element => {
                            count_++;
                            var table = `
                                    <tr style="background-color: #E2F0FF">
                                    <td style="color: #007bff">${count_}</td>
                                    <td style="color: #007bff">${element.obj_no}</td>
                                    <td style="color: #007bff">${element.objective}</td>
                                    <td style="color: #007bff">${element.evaluation}</td>
                                    <td colspan="8"></td>
                                    </tr>`;
                            element.data_planning.forEach(element_planning => {
                                table += `<tr>
                                    <td colspan="4"></td>`;
                                table += `<td >${element_planning.planning !== '' ? element_planning.planning : '-'}</td>`;
                                table += `<td >${element_planning.date_evaluation !== '' ? element_planning.date_evaluation : '-'}</td>`;
                                table += `<td >${element_planning.actual !== null ? element_planning.actual : '-'}</td>`;
                                table += `<td >${element_planning.owner !== '' ? element_planning.owner : '-'}</td>`;
                                table += `<td >${element_planning.evaluation_methods !== '' ? element_planning.evaluation_methods : '-'}</td>`;
                                table += `<td >${element_planning.criteria !== null ? element_planning.criteria : '-'}</td>`;
                                if (element_planning.evaluation_results == 0 || element_planning.evaluation_results == null) {
                                    table += `<td >-</td>`;
                                } else if (element_planning.evaluation_results == 1) {
                                    table += `<td ><i class="fas fa-check text-success"></i></td>`;
                                } else if (element_planning.evaluation_results == 2) {
                                    table += `<td ><i class="fas fa-times text-danger"></i></td>`;
                                }
                                const encoded_element_planning = encodeURIComponent(JSON.stringify(element_planning));
                                const encoded_obj = encodeURIComponent(JSON.stringify(element));
                                table += `<td ><span style="color:#007BFF; cursor:pointer;" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2, '${encoded_element_planning}', '${encoded_obj}')"><i class="fas fa-user-edit"></i></span></td>`;
                                table += `</tr>`;
                            });
                            // Append the row to the table
                            $('#example1 tbody').append(table);
                        });
                    }
                },
                'columns': [{
                    'data': null,
                }, ],
            });
            $('[data-toggle="tooltip"]').tooltip();
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
</body>