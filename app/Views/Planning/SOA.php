<title>SOA Version</title>
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
</style>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>SOA
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a>SOA</a></li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Details</h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a href="<?= site_url('context/context_analysis/index/' . $data['type_version']) ?>" style="color: #ADB5BD;">Version</a></button>
                            <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;">
                                <a href="<?= base_url('planning/planningAddressRisksOpp/context/timeline_log/' . $data['id_version'] . '/' . $data['type_version'] . '/' . $data['num_ver']) ?>" style="color: #ADB5BD;">History</a>
                            </button>
                            <button class="badge badge-edit" style="background-color: #007BFF; color: #ffffff; border: 1px solid #007BFF" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                                    <div class="dropdown-menu">
                                        <!-- Second-level dropdown items -->
                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Reviewed หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/1')">Pending
                                            Review</a>
                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Review หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/2')">Review</a>
                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(7,5)">Reject Review</a>

                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Approve หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/3')">Pending
                                            Approve</a>
                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Approved หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/4')">Approved</a>
                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(7,6)">Reject
                                            Approved</a>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Update</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('Would you like to confirm the update review date?', 'context/update_date/<?= $data['id_version'] ?>/1')">Update
                                            review date</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Copy ข้อมูลหรือไม่', 'context/copydata/<?= $data['id_version'] ?>')">Revise</a>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-default" id="load-modal-button" href="#" onclick="load_modal(6)">Create Note</a>
                            </div>

                            <i class="fas fa-cog" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(2)"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row justify-content-center mb-2">
                                <div class="col-sm-3 ">
                                    <h6>Version:
                                        <span class="blue-text">
                                            <?php echo $data['num_ver']; ?>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-sm-3 ">
                                    <h6>Status:
                                        <?php
                                        if ($data['status'] == 0) {
                                            echo "<span class='badge bg-secondary'>Draft</span>";
                                        } else if ($data['status'] == 1) {
                                            echo "<span class='badge bg-info'>Pending Review</span>";
                                        } else if ($data['status'] == 2) {
                                            echo "<span class='badge bg-warning'>Review</span>";
                                        } else if ($data['status'] == 3) {
                                            echo "<span class='badge bg-info'>Pending Approved</span>";
                                        } else if ($data['status'] == 4) {
                                            echo "<span class='badge bg-success'>Approved</span>";
                                        } else if ($data['status'] == 5) {
                                            echo "<span class='badge bg-danger'>Reject_Review</span>";
                                        } else if ($data['status'] == 6) {
                                            echo "<span class='badge bg-danger'>Reject_Approved</span>";
                                        }
                                        ?>
                                    </h6>
                                </div>
                                <div class="col-sm-3 ">
                                    <h6>Approved Date:
                                        <span class="gray-text">
                                            <?php echo $data['approved_date']; ?>
                                        </span>
                                    </h6>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-2">
                                <div class="col-sm-3 ">
                                    <h6>Modified Date:
                                        <span class="gray-text">
                                            <?php echo $data['modified_date']; ?>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-sm-3 ">
                                    <h6>Last Reviewed:
                                        <span class="gray-text">
                                            <?php echo $data['review_date']; ?>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-sm-3 ">
                                    <h6>Announce Date:
                                        <span class="gray-text">
                                            <?php echo $data['announce_date']; ?>
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="context-ana">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="tab-content" id="tabs-tabContent">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4>Statement of Applicability (SOA)</h4>
                                    <div id="btn-Objectives" name="btn-Objectives">
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-default" onclick="load_modal(3)">
                                            <span class="text-nowrap"><i class="fas fa-edit"></i>Create SOA</span>
                                        </button>
                                    </div>
                                </div>

                                <table id="example1" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ACTION</th>
                                            <th>SEC</th>
                                            <th>CONTROL</th>
                                            <th>EXCLUSION</th>
                                            <th>JUSTIFICATION</th>
                                            <th>HOW TO</th>
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
            <?= $this->include("Modal/CRUD_Planning_SOA"); ?>
        </div>
        <div id="modal4">
            <?= $this->include("Modal/CRUD_Note"); ?>
        </div>
        <div id="modal5">
            <?= $this->include("Modal/Reject_Modal"); ?>
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

            if (check == '1') {
                //--show modal requirment--//
                modal1.style.display = "block";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
            } else if (check == '2') {
                //--show modal Version Control--//
                modal1.style.display = "none";
                modal2.style.display = "block";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";

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
                //--show modal SOA create--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "block";
                modal4.style.display = "none";
                modal5.style.display = "none";
                $(".modal-body #control").val('');
                $(".modal-body #control").attr('readonly', false);
                $(".modal-body #exclusion").val('null');
                $(".modal-body #justification").empty();
                $(".modal-body #how_to").empty();

                var data = <?php echo json_encode($data); ?>;
                $(".modal-body #url_route").val("planning/soa/create/" + data.id_version + "/" + data.status);
            } else if (check == '4') {
                //--show modal SOA edit--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "block";
                modal4.style.display = "none";
                modal5.style.display = "none";

                $(".modal-body #control").empty();
                $(".modal-body #exclusion").val('null');
                $(".modal-body #justification").empty();
                $(".modal-body #how_to").empty();
                var data = <?php echo json_encode($data); ?>;
                const rowData = JSON.parse(decodeURIComponent(data_));
                $(".modal-body #control").val(rowData.control);
                $(".modal-body #exclusion").val(rowData.exclusion ?? 'null');
                $(".modal-body #justification").val(rowData.justification);
                $(".modal-body #how_to").val(rowData.how_to);
                if (status == 1) {
                    $(".modal-body #control").attr('readonly', false);
                } else if (status == 2) {
                    $(".modal-body #control").attr('readonly', true);
                }
                $(".modal-body #url_route").val("planning/soa/edit/" + rowData.id_soa + "/" + data.id_version + "/" + data.status);
            } else if (check == '6') {
                //--show modal create note--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "block";
                modal5.style.display = "none";

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

                $(".modal-body #status").val(data_);
                var element = <?php echo json_encode($data); ?>;
                $(".modal-body #modified_date").val(element.modified_date);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            getTableData1();
        })
        var countTable1 = 0;

        function getTableData1() {
            if (countTable1 === 0) {
                countTable1++;
                var data_version = <?php echo json_encode($data); ?>;
                if (data_version.status === '4' || data_version.status === '5') {
                    var disabledAttribute = 'disabled';
                }
                if ($.fn.DataTable.isDataTable('#example1')) {
                    $('#example1').DataTable().destroy();
                }
                $('#example1').DataTable({
                    "processing": $("#example1 .overlay").show(),
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('planning/soa/getdata/'); ?>" + data_version.id_version,
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "searching": true,
                    "ordering": false,
                    "scrollX": false,
                    "drawCallback": function(settings) {
                        $("#example1 .overlay").hide();
                        var daData = settings.json.data;
                        if (daData.length == 0) {
                            $('#example1 tbody').html(`
                                <tr>
                                    <td colspan="6">
                                        <div class="dropdown">
                                            <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                                class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" ${disabledAttribute}></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" onclick="load_modal(5)" data-toggle="modal"
                                                    data-target="#modal-default">Create</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>`);
                        }
                    },
                    'columns': [{
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                console.log(data);
                                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                number = parseFloat(data.sec);
                                
                                if (Number.isInteger(number)) {
                                    $(meta.settings.aoData[meta.row].anCells[meta.col]).css('background-color', '#E2F0FF');
                                    return '';
                                } else {
                                    if (data.sec.startsWith("LC")) {
                                        return `<div class="dropdown"${disabledAttribute}>
                                                <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"></i>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(4,'${encodedRowData}',1)"><a class="dropdown-item" href="#">Edit</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="confirm_Alert('Do you want to copy this ${data.sec} ?', 'planning/soa/copydata/${data.id_soa}/${data_version.id_version}/${data_version.status}')">Copy</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="confirm_Alert('Do you want to delete this ${data.sec} ?', 'planning/soa/delete/${data.id_soa}/${data_version.id_version}/${data_version.status}')">Delete</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(3)"><a class="dropdown-item" href="#">Create</a></li>
                                                </ul>
                                            </div>`;
                                    } else {
                                        return `<div class="dropdown" ${disabledAttribute}>
                                                <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"></i>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li data-toggle="modal" data-target="#modal-default " onclick="load_modal(4,'${encodedRowData}',2)"><a class="dropdown-item" href="#">Edit</a></li>
                                                    </ul>
                                            </div>`;
                                    }
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                if (Number.isInteger(number)) {
                                    // ถ้า data.sec เป็นจำนวนเต็ม
                                    $(meta.settings.aoData[meta.row].anCells[meta.col]).css('background-color', '#E2F0FF');
                                    return '<div style="color: rgba(0, 123, 255, 1);">' + data.sec + '</div>';
                                } else {
                                    // ถ้า data.sec ไม่เป็นจำนวนเต็ม
                                    return '<div style="color: rgba(0, 123, 255, 1);">' + data.sec + '</div>';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                if (Number.isInteger(number)) {
                                    $(meta.settings.aoData[meta.row].anCells[meta.col]).css('background-color', '#E2F0FF');
                                }
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.control) + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                if (Number.isInteger(number)) {
                                    $(meta.settings.aoData[meta.row].anCells[meta.col]).css('background-color', '#E2F0FF');
                                    return '';
                                } else {
                                    return '<div style="color: rgba(0, 123, 255, 1);">' + (data.exclusion ?? '') + '</div>';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                if (Number.isInteger(number)) {
                                    $(meta.settings.aoData[meta.row].anCells[meta.col]).css('background-color', '#E2F0FF');
                                    return '';
                                } else {
                                    return '<div style="color: rgba(0, 123, 255, 1);">' + (data.justification ?? '') + '</div>';
                                }
                            }
                        },
                        {
                            'data': null,
                            'class': 'text-center',
                            'render': function(data, type, row, meta) {
                                if (Number.isInteger(number)) {
                                    $(meta.settings.aoData[meta.row].anCells[meta.col]).css('background-color', '#E2F0FF');
                                    return '';
                                } else {
                                    return '<div style="color: rgba(0, 123, 255, 1);">' + (data.how_to ?? '') + '</div>';
                                }
                            }
                        },
                    ],
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
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
                                onOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: response.message,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                                setTimeout(() => {
                                    if (response.newCopy) {
                                        window.location.href = '<?= base_url("planning/soa/index/") ?>' + response.id_version + '/' + response.num_ver;
                                    } else {
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
                    })
                }
            });
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
                    // Show loading indicator here
                    Swal.fire({
                        title: 'Loading...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
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