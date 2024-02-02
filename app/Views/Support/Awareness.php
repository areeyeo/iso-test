<title>Awareness Version</title>
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
                        <h1>
                            Awareness
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a>Awareness</a></li>
                        </ol>
                    </div>
                </div>
            </div>
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
                            <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a href="<?= site_url('context/context_analysis/index/') ?>" style="color: #ADB5BD;">Version</a></button>
                            <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;">
                                <a href="<?= site_url('context/ISObjective/timeline_log/') ?>" style="color: #ADB5BD;">History</a>
                            </button>
                            <button class="badge badge-edit" style="background-color: #007BFF; color: #ffffff; border: 1px solid #007BFF" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                                    <div class="dropdown-menu">
                                        <!-- Second-level dropdown items -->
                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Reviewed หรือไม่', 'context/status_update/id_version ?>/1')">Pending Review</a>
                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Review หรือไม่', 'context/status_update/id_version ?>/2')">Review</a>
                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button">Reject Review</a>

                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Approve หรือไม่', 'context/status_update/id_version ?>/3')">Pending
                                            Approve</a>
                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Approved หรือไม่', 'context/status_update/id_version ?>/4')">Approved</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(4)">Reject Approved</a>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Update</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item">Update review date</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item">Revise</a>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-default" id="load-modal-button">Create Note</a>
                            </div>

                            <i class="fas fa-cog" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)"></i>
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
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="isms_process">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="tab-content" id="tabs-tabContent">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4>Awareness</h4>
                                            <div id="btn-Awareness" name="btn-Awareness">
                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2)">
                                                    <span class="text-nowrap"><i class="fas fa-edit"></i>Create Awareness</span>
                                                </button>
                                            </div>
                                        </div>

                                        <table id="example1" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ACTION</th>
                                                    <th>No.</th>
                                                    <th>COURSE</th>
                                                    <th>DETAIL</th>
                                                    <th>DATE</th>
                                                    <th>FILE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="overlay dark">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modal-default">
        <div id="modal_contextver">
            <?= $this->include("Modal/Context_Ver"); ?>
        </div>
        <div id="modal_crud_support_awareness">
            <?= $this->include("Modal/CRUD_Support_Awareness"); ?>
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
        function load_modal(check, data_encode) {
            console.log('Function is called with check:', check, 'and check_type:', check_type);

            modal_contextver = document.getElementById("modal_contextver");
            modal_crud_support_awareness = document.getElementById("modal_crud_support_awareness");
            $(".modal-body #iss").empty();

            if (check == '1') {
                //--show modal requirment--//
                console.log('Showing modal 1');
                modal_contextver.style.display = "block";
                modal_crud_support_awareness.style.display = "none";
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
            } else if (check == '2') {
                //--show modal requirment--//
                console.log('Showing modal 2');
                modal_contextver.style.display = "none";
                modal_crud_support_awareness.style.display = "block";
            }
        }
    </script>
    <script>
        var Data = [{
                "COURSE": "Information Security Policy",
                "DETAIL": "-",
                "DATE": "01/01/2024",
                "FILE": ["file1.pdf", "file2.pdf", "file3.pdf"],
            },
            {
                "COURSE": "Security Awareness",
                "DETAIL": "-",
                "DATE": "01/01/2024",
                "FILE": ["file1.pdf", "file2.pdf"],
            },
        ];

        var example1TableBody = document.getElementById("example1").getElementsByTagName("tbody")[0];

        Data.forEach(function(row, index) {
            var newRow = example1TableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);


            cell1.innerHTML = `<div class="dropdown">
    <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
      <li data-toggle="modal" data-target="#modal-default " onclick="load_modal(2)"><a class="dropdown-item" href="#">Edit</a></li>
      <li><a class="dropdown-item" href="#">Copy</a></li>
      <li><a class="dropdown-item" href="#">Delete</a></li>
      <li><hr class="dropdown-divider"></li>
      <li data-toggle="modal" data-target="#modal-default " onclick="load_modal(2)"><a class="dropdown-item" href="#">Create</a></li>
    </ul>
  </div>`;
            cell2.textContent = index + 1;
            cell3.textContent = row.COURSE;
            cell4.textContent = row.DETAIL;
            cell5.textContent = row.DATE;
            displayArrayInCell(cell6, row.FILE);
        });

        function displayArrayInCell(cell, dataArray) {
            if (Array.isArray(dataArray) && dataArray.length > 1) {
                cell.innerHTML = dataArray.join('<br>');
            } else {
                cell.textContent = Array.isArray(dataArray) ? dataArray[0] : dataArray;
            }
        }
    </script>