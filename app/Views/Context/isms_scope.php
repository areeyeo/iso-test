<title>ISMS Scope Version</title>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300,400,400i,700&display=swap">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
<!-- summernote -->
<link rel="stylesheet" href="<?= base_url('plugins/summernote/summernote-bs4.min.css'); ?>">
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
                        <h1>ISMS Scope
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                                data-target="#modal-default" id="load-modal-button"
                                onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a
                                    href="<?= site_url('context/isms_scope/index/' . $data['type_version']); ?>">ISMS
                                    Scope</a></li>
                            <li class="breadcrumb-item active">Version
                                <?php echo $data['num_ver']; ?>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Details</h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <?php if ($data['status'] == 4 || $data['status'] == 5) {
                                        $disabled = '';
                                    } else {
                                        $disabled = '';
                                    } ?>
                                    <button class="badge badge-edit <?= $disabled ?>"
                                        style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a
                                            href="<?= site_url('context/isms_scope/index/' . $data['type_version']); ?>"
                                            style="color: #ADB5BD;">Version</a></button>
                                    <button class="badge badge-edit <?= $disabled ?>"
                                        style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a
                                            href="<?= site_url('context/isms_scope/timeline_log/' . $data['id_version'] . '/' . $data['type_version'] . '/' . $data['num_ver']); ?>"
                                            style="color: #ADB5BD;">History</a></button>
                                    <button class="badge badge-edit"
                                        style="background-color: #007BFF; color: #ffffff; border: 1px solid #007BFF"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Action</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                                            <div class="dropdown-menu">
                                                <!-- Second-level dropdown items -->
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirm_Alert('ต้องการที่จะ Pending Reviewed หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/1')">Pending
                                                    Review</a>
                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="#"
                                                    onclick="confirm_Alert('ต้องการที่จะ Review หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/2')">Review</a>
                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modal-default" id="load-modal-button"
                                                    onclick="load_modal(7,5)">Reject Review</a>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirm_Alert('ต้องการที่จะ Pending Approve หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/3')">Pending
                                                    Approve</a>
                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="#"
                                                    onclick="confirm_Alert('ต้องการที่จะ Approved หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/4')">Approved</a>
                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modal-default" id="load-modal-button"
                                                    onclick="load_modal(7,6)">Reject
                                                    Approved</a>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">Update</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirm_Alert('Would you like to confirm the update review date?', 'context/update_date/<?= $data['id_version'] ?>/1')">Update
                                                    review date</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"
                                                    onclick="confirm_Alert('ต้องการที่จะ Copy ข้อมูลหรือไม่', 'context/copydata/<?= $data['id_version'] ?>')">Revise</a>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-default"
                                            id="load-modal-button" href="#" onclick="load_modal(9)">Create Note</a>
                                    </div>

                                    <i class="fas fa-cog" data-toggle="modal" data-target="#modal-default"
                                        id="load-modal-button" onclick="load_modal(8)"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row justify-content-center mb-2">
                                        <div class="col-sm-3 ">
                                            <h6>Version: <span class="blue-text">
                                                    <?php echo $data['num_ver']; ?>
                                                </span></h6>
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
                                            <h6>Approved Date: <span class="gray-text">
                                                    <?php echo $data['approved_date']; ?>
                                                </span></h6>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-2">
                                        <div class="col-sm-3 ">
                                            <h6>Modified Date: <span class="gray-text">
                                                    <?php echo $data['modified_date']; ?>
                                                </span></h6>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <h6>Last Reviewed: <span class="gray-text">
                                                    <?php echo $data['review_date']; ?>
                                                </span></h6>
                                        </div>
                                        <div class="col-sm-3 ">
                                            <h6>Announce Date: <span class="gray-text">
                                                    <?php echo $data['announce_date']; ?>
                                                </span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="isms_scope">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="scope-tab" data-toggle="pill"
                                                    href="#scope" role="tab" aria-controls="scope"
                                                    aria-selected="false">Scope</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="scope-ad-tab"
                                                    onclick="getTableData(4 , 'context_isms_scope_ad/find_data/' + <?= $data['id_version'] ?>);"
                                                    data-toggle="pill" href="#scope-ad" role="tab"
                                                    aria-controls="scope-ad" aria-selected="false">Scope Activities
                                                    Diagram</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="tab-content" id="tabs-tabContent">
                                            <div class="tab-pane fade show active" id="scope" role="tabpanel"
                                                aria-labelledby="scope-tab">
                                                <?php if ($data_scope): ?>
                                                    <?php foreach ($data_scope as $row_scope): ?>
                                                        <?php if ($data['id_version'] == $row_scope['id_version']): ?>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <a href="#"><span class="badge badge-edit float-right"
                                                                            style="background-color: #adb5bd; color: #ffffff;"
                                                                            id="VersionMenuButton" data-toggle="modal"
                                                                            data-target="#modal-default" id="load-modal-button"
                                                                            onclick="load_modal(3)">Edit</span></a>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="position-relative p-3 bg-gray"
                                                                        style="height: 180px">
                                                                        Location<br>
                                                                        <?= $row_scope['location'] ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="position-relative p-3 bg-gray"
                                                                        style="height: 180px">
                                                                        Organization<br>
                                                                        <?= $row_scope['organization'] ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="position-relative p-3 bg-gray"
                                                                        style="height: 180px">
                                                                        System/Service<br>
                                                                        <?= $row_scope['system_service'] ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <b>Scope Statement</b><br>
                                                            <?= $row_scope['scope_statement'] ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <a href="#"><span class="badge badge-edit float-right"
                                                                    style="background-color: #adb5bd; color: #ffffff;"
                                                                    id="VersionMenuButton" data-toggle="modal"
                                                                    data-target="#modal-default" id="load-modal-button"
                                                                    onclick="load_modal(2)">Create</span></a>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="position-relative p-3 bg-gray"
                                                                style="height: 180px">
                                                                Location<br>
                                                                -
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="position-relative p-3 bg-gray"
                                                                style="height: 180px">
                                                                Organization<br>
                                                                -
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="position-relative p-3 bg-gray"
                                                                style="height: 180px">
                                                                System/Service<br>
                                                                -
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <b>Scope Statement</b><br>
                                                    -
                                                <?php endif; ?>
                                            </div>
                                            <div class="tab-pane fade" id="scope-ad" role="tabpanel"
                                                aria-labelledby="scope-ad-tab">
                                                <table id="example1" class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">ACTION</th>
                                                            <th>No.</th>
                                                            <th>FILE</th>
                                                            <th>UPLOAD DATE</th>
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
                            <div class="overlay dark">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modal-default">
        <div id="Requirement_Modal">
            <?= $this->include("Modal/Requirement_Modal"); ?>
        </div>
        <div id="CRUD_ISMS_Scope_modal">
            <?= $this->include("Modal/CRUD_ISMS_Scope_modal"); ?>
        </div>
        <div id="CRUD_File_UploadOnly">
            <?= $this->include("Modal/CRUD_File_UploadOnly"); ?>
        </div>
        <div id="Context_Ver">
            <?= $this->include("Modal/Context_Ver"); ?>
        </div>
        <div id="CRUD_Note">
            <?= $this->include("Modal/CRUD_Note"); ?>
        </div>
        <div id="Reject_Modal">
            <?= $this->include("Modal/Reject_Modal"); ?>
        </div>
        <div id="File_Rename_Modal">
            <?= $this->include("Modal/File_Rename_Modal"); ?>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var data = <?php echo json_encode($data); ?>;
        });
    </script>
    <script>
        var countTable1 = 0;
        function getTableData(check, url) {

            if (countTable1 === 0) {
                countTable1++;
                var data_context = <?php echo json_encode($data); ?>;
                if (data_context.status === '4' || data_context.status === '5') {
                    var disabledAttribute = 'disabled';
                }
                if ($.fn.DataTable.isDataTable('#example1')) {
                    $('#example1').DataTable().destroy();
                }
                $('#example1').DataTable({
                    "processing": $("#isms_scope .overlay").show(),
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('context/isms_scope/context_isms_scope_ad/find_data/'); ?>" + data_context.id_version,
                        'type': 'GET',
                        'dataSrc': 'data',
                    },
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "searching": false,
                    "drawCallback": function (settings) {
                        $("#isms_scope .overlay").hide();
                        var daData = settings.json.data;
                        if (daData.length == 0) {
                            $('#example1 tbody').html(`
                            <tr>
                                <td colspan="1">
                                    <div class="dropdown">
                                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" ${disabledAttribute}></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="load_modal(4)" data-toggle="modal"
                                                data-target="#modal-default">Create</a>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="3">
                                </td>
                            </tr>
                            `);
                        }
                    },
                    'columns': [{
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            var number_index = +meta.settings.oAjaxData.start + 1;
                            const encodedRowData = encodeURIComponent(JSON.stringify(row));
                            let dropdownHtml = `
                                <div class="dropdown">
                                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        ${disabledAttribute}></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" onclick="load_modal(5, '${encodedRowData}')" data-toggle="modal"
                                            data-target="#modal-default">Edit</a>
                                        <a class="dropdown-item" href="#"
                                            onclick="confirm_Alert('You want to copy data ${number_index} ?', 'context/isms_scope/context_isms_scope_ad/copydata/${row.id_}/${number_index}/${data_context.id_version}/${data_context.status}')">Copy</a>
                                        <a class="dropdown-item" href="#"
                                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'context/isms_scope/context_isms_scope_ad/delete/${row.id_}/${row.id_file}/${number_index}/${data_context.id_version}/${data_context.status}')">Delete</a>
                                        <a class="dropdown-item" onclick="load_modal(4)" data-toggle="modal" data-target="#modal-default">Create</a>
                                `;
                            if (row.id_file > 0) {
                                dropdownHtml += `
                                <div class="dropdown-divider"></div>
                                    <div class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">File</a>
                                        <div class="dropdown-menu right-menu-table">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                                                onclick="load_modal('6' , '${encodedRowData}')">Rename</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"
                                                onclick="confirm_Alert('You want to delete the data file ${number_index} ?', 'context/isms_scope/context_isms_scope_ad/delete_file/${row.id_}/${row.id_file}/${number_index}/${data_context.id_version}/${data_context.status}')">Delete
                                                File</a>
                                        </div>`;
                            }
                            dropdownHtml += `</div>
                                </div>`;
                            return dropdownHtml;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData
                                .start += 1) + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function (data, type, row, meta) {
                            if (row.id_file > 0) {
                                var number_index = +meta.settings.oAjaxData.start;

                                return `<a href="<?php echo base_url('openfile/'); ?>${row.id_file}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">
                ${row.name_file}
                </a>`
                            } else {
                                return '<div style="color: rgba(0, 123, 255, 1);">No File</div>';
                            }
                        }
                    },
                    {
                        'data': 'date_upload',
                        'class': 'text-center',
                        render: function (data, type, row) {
                            if (type === 'display' && data && data.length > 50) {
                                return '<span data-toggle="tooltip" data-placement="top" title="' + data +
                                    '" style="color: rgba(0, 123, 255, 1);">' +
                                    data.substr(0, 50) + '...</span>';
                            }
                            return `<span data-toggle="tooltip" data-placement="top" title="${data}" style="color: rgba(0, 123, 255, 1);">
                ${data} </span>`;
                        }
                    },
                    ],
                });
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    </script>
    <script>
        function load_modal(check, data_encode) {
            Requirement_Modal = document.getElementById("Requirement_Modal");
            CRUD_ISMS_Scope_modal = document.getElementById("CRUD_ISMS_Scope_modal");
            CRUD_File_UploadOnly = document.getElementById("CRUD_File_UploadOnly");
            Context_Ver = document.getElementById("Context_Ver");
            CRUD_Note = document.getElementById("CRUD_Note");
            Reject_Modal = document.getElementById("Reject_Modal");
            File_Rename_Modal = document.getElementById("File_Rename_Modal");
            var element = <?php echo json_encode($data); ?>;
            if (check == '1') {
                //--show modal requirment--//
                Requirement_Modal.style.display = "block";
                CRUD_ISMS_Scope_modal.style.display = "none";
                CRUD_File_UploadOnly.style.display = "none";
                Context_Ver.style.display = "none";
                CRUD_Note.style.display = "none";
                Reject_Modal.style.display = "none";
                File_Rename_Modal.style.display = "none";
            } else if (check == '2') {
                //--show modal create scope--//
                Requirement_Modal.style.display = "none";
                CRUD_ISMS_Scope_modal.style.display = "block";
                CRUD_File_UploadOnly.style.display = "none";
                Context_Ver.style.display = "none";
                CRUD_Note.style.display = "none";
                Reject_Modal.style.display = "none";
                File_Rename_Modal.style.display = "none";
                $(".modal-body #url_route").val("context/isms_scope/context_isms_scope/store/" + element.id_version + "/" + element.status);
            } else if (check == '3') {
                //--show modal edit scope--//
                Requirement_Modal.style.display = "none";
                CRUD_ISMS_Scope_modal.style.display = "block";
                CRUD_File_UploadOnly.style.display = "none";
                Context_Ver.style.display = "none";
                CRUD_Note.style.display = "none";
                Reject_Modal.style.display = "none";
                File_Rename_Modal.style.display = "none";
                var data_scope_ = <?php echo json_encode($data_scope); ?>;
                $(".modal-body #location").val(data_scope_[0].location);
                $(".modal-body #organization").val(data_scope_[0].organization);
                $(".modal-body #system_service").val(data_scope_[0].system_service);
                $(".modal-body #scope_statement").val(data_scope_[0].scope_statement);
                $(".modal-body #url_route").val("context/isms_scope/context_isms_scope/edit/" + element.id_version + "/" + element.status + "/" + data_scope_[0].id_scope);
            } else if (check == '4') {
                //--show modal create scopeAD--//
                Requirement_Modal.style.display = "none";
                CRUD_ISMS_Scope_modal.style.display = "none";
                CRUD_File_UploadOnly.style.display = "block";
                Context_Ver.style.display = "none";
                CRUD_Note.style.display = "none";
                Reject_Modal.style.display = "none";
                File_Rename_Modal.style.display = "none";
                $(".modal-header #title_modal").text("Scope Activities Diagram");
                $(".modal-body #url_route").val("context/isms_scope/context_isms_scope_ad/store/" + element.id_version + "/" + element.status);
            } else if (check == '5') {
                //--show modal create scopeAD--//
                Requirement_Modal.style.display = "none";
                CRUD_ISMS_Scope_modal.style.display = "none";
                CRUD_File_UploadOnly.style.display = "block";
                Context_Ver.style.display = "none";
                CRUD_Note.style.display = "none";
                Reject_Modal.style.display = "none";
                File_Rename_Modal.style.display = "none";
                $(".modal-header #title_modal").text("Scope Activities Diagram");
                const rowData = JSON.parse(decodeURIComponent(data_encode));
                $(".modal-body #id_").val(rowData.id_scope_activites);
                $(".modal-body #url_route").val("context/isms_scope/context_isms_scope_ad/edit");
            } else if (check == '6') {
                //--show modal Rename File--//
                Requirement_Modal.style.display = "none";
                CRUD_ISMS_Scope_modal.style.display = "none";
                CRUD_File_UploadOnly.style.display = "none";
                Context_Ver.style.display = "none";
                CRUD_Note.style.display = "none";
                Reject_Modal.style.display = "none";
                File_Rename_Modal.style.display = "block";

                const rowData = JSON.parse(decodeURIComponent(data_encode));
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
                $(".modal-body #url_route").val("renamefile/" + rowData.id_file);
            } else if (check == '7') {
                //--show modal Reject--//
                Requirement_Modal.style.display = "none";
                CRUD_ISMS_Scope_modal.style.display = "none";
                CRUD_File_UploadOnly.style.display = "none";
                Context_Ver.style.display = "none";
                CRUD_Note.style.display = "none";
                Reject_Modal.style.display = "block";
                File_Rename_Modal.style.display = "none";

                $(".modal-body #status").val(data_encode);
                $(".modal-body #modified_date").val(element.modified_date);
            } else if (check == '8') {
                //--show modal Version Control--//
                Requirement_Modal.style.display = "none";
                CRUD_ISMS_Scope_modal.style.display = "none";
                CRUD_File_UploadOnly.style.display = "none";
                Context_Ver.style.display = "block";
                CRUD_Note.style.display = "none";
                Reject_Modal.style.display = "none";
                File_Rename_Modal.style.display = "none";

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
            } else if (check == '9') {
                //--show modal Create Note--//
                Requirement_Modal.style.display = "none";
                CRUD_ISMS_Scope_modal.style.display = "none";
                CRUD_File_UploadOnly.style.display = "none";
                Context_Ver.style.display = "none";
                CRUD_Note.style.display = "block";
                Reject_Modal.style.display = "none";
                File_Rename_Modal.style.display = "none";

                $(".modal-body #modified").val(element.modified_date);
                $(".modal-body #check").val(10);
                $(".modal-body #params").val(10);
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

                    return $.ajax({
                        url: '<?= base_url() ?>' + url,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        beforeSend: function () {
                            // Show loading indicator here
                            loadingIndicator;
                        },
                        complete: function () {
                            // Hide loading indicator here
                            Swal.close();
                        }
                    }).then(function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                showConfirmButton: false
                            });
                            setTimeout(() => {
                                if (response.reload) {
                                    if (response.newCopy) {
                                        window.location.href = '<?= site_url("context/isms_scope/") ?>' + response.id_version + '/' + response.num_ver;
                                    } else {
                                        window.location.reload();
                                    }
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