<title>Leadership & Commitment</title>
<!-- summernote -->
<link rel="stylesheet" href="<?= base_url('plugins/summernote/summernote-bs4.min.css'); ?>">
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
<style>
    /* สไตล์สำหรับแท็บที่ยังไม่ได้คลิก */
    .nav-item-tab:not(.active) a.nav-link {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px 15px;
    }

    tr:nth-child(even) {
        background-color: #F5F5F5;
    }

    th {
        background-color: #F5F6FA;
        text-align: center;
        border-bottom: none;
    }

    .blue-text {
        color: #0000FF;
    }

    .gray-text {
        color: #adb5bd;
    }

    .badge-edit {
        font-size: 100%;
    }

    tbody {
        border-bottom: 10px solid #ccc;
        text-align: center;
    }

    .table thead th {
        border-bottom: none;
    }

    .button-table {
        border-color: transparent;
        background-color: transparent;
    }

    .modal-footer {
        justify-content: space-evenly;
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
</style>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Leadership & Commitment
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                                data-target="#modal-default" id="load-modal-button"
                                onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Leadership & Commitment</li>
                            <li class="breadcrumb-item active" id="org-heaer-path">Organizational Strategy</li>
                            <li class="breadcrumb-item active" id="objective-heaer-path">IS Objective</li>
                            <li class="breadcrumb-item active" id="version-heaer-path">Version
                                <?= $data['num_ver'] ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <hr>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                                <li class="nav-item-tab" style="padding-right: 10px;">
                                    <a class="nav-link " id="org-strategy-tab" data-toggle="pill" href="#org-strategy"
                                        role="tab" aria-controls="org-strategy" aria-selected="true"
                                        onclick="getTableData1();">Org Strategy</a>
                                </li>
                                <li class="nav-item-tab">
                                    <a class="nav-link active" id="is-objective-tab" data-toggle="pill"
                                        href="#is-objective" role="tab" aria-controls="is-objective"
                                        aria-selected="false">IS Objective</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show" id="org-strategy" role="tabpanel"
                                aria-labelledby="org-strategy-tab">
                                <div class="card" id="org-strategy-tab-text">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <h4>Organizational Strategy </h4>
                                                    </div>
                                                    <div class="col-1 ">
                                                        <button type="button" class="btn btn-primary float-sm-right"
                                                            onclick="click_edit()"><i class="fas fa-edit"></i>
                                                            Edit</button>
                                                    </div>
                                                </div>
                                                <br>
                                                <form class="mb-3" id="Organizational_edit" action="javascript:void(0)"
                                                    method="post" enctype="multipart/form-data">
                                                    <textarea id="Organizational" name="Organizational"></textarea>
                                                    <div class=" clearfix"
                                                        style="display: flex; justify-content: center; gap: 10px;">
                                                        <button type="submit" class="btn btn-success" name="submit"
                                                            id="submit" value="Submit">Save</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal" id="close"
                                                            onclick="click_close()">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                                <br>
                                <div class="card" id="org-strategy-tab-file">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>File</h4>
                                                <br>
                                                <table id="example1" class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">ACTION</th>
                                                            <th>NO.</th>
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
                                    <div class="overlay dark">
                                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="is-objective" role="tabpanel"
                                aria-labelledby="is-objective-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 class="card-title">Details</h2>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool"
                                                        data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <?php if ($data['status'] == 4 || $data['status'] == 5) {
                                                        $disabled = '';
                                                    } else {
                                                        $disabled = '';
                                                    } ?>
                                                    <button class="badge badge-edit <?= $disabled ?>"
                                                        style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a
                                                            href="<?= site_url('context/context_analysis/index/' . $data['type_version']); ?>"
                                                            style="color: #ADB5BD;">Version</a></button>
                                                    <button class="badge badge-edit <?= $disabled ?>"
                                                        style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a
                                                            href="<?= site_url('context/context_analysis/timeline_log/' . $data['id_version'] . '/' . $data['type_version'] . '/' . $data['num_ver']); ?>"
                                                            style="color: #ADB5BD;">History</a></button>
                                                    <button class="badge badge-edit"
                                                        style="background-color: #007BFF; color: #ffffff; border: 1px solid #007BFF"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">Action</button>
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
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#modal-default" id="load-modal-button" href="#"
                                                            onclick="load_modal(6)">Create Note</a>
                                                    </div>

                                                    <i class="fas fa-cog" data-toggle="modal"
                                                        data-target="#modal-default" id="load-modal-button"
                                                        onclick="load_modal(2)"></i>
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
                                        <br>
                                        <div class="card" id="is_objective">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4>IS Objective</h4>
                                                        <br>
                                                        <table id="example2" class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">ACTION</th>
                                                                    <th>NO.</th>
                                                                    <th>INFORMATION SECURITY OBJECTIVE</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
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
            <?= $this->include("Modal/CRUD_Leadership_modal"); ?>
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
    </div>
    <!-- summernote -->
    <script src="<?= base_url('plugins/summernote/summernote-bs4.min.js'); ?>"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
    <!-- moment -->
    <script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

    <script>
        function load_modal(check, data_, status) {
            modal1 = document.getElementById("modal1");
            modal2 = document.getElementById("modal2");
            modal3 = document.getElementById("modal3");
            modal4 = document.getElementById("modal4");
            modal5 = document.getElementById("modal5");
            modal6 = document.getElementById("modal6");

            if (check == '1') {
                //--show modal requirment--//
                modal1.style.display = "block";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";
            } else if (check == '2') {
                //--show modal Version Control--//
                modal1.style.display = "none";
                modal2.style.display = "block";
                modal3.style.display = "none";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";

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
                //--show modal file create--//
                const formGroupFile = document.getElementById("form-group-file");
                const formGroupText = document.getElementById("form-group-text");
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "block";
                modal4.style.display = "none";
                modal5.style.display = "none";
                modal6.style.display = "none";

                formGroupFile.style.display = "block";
                formGroupText.style.display = "none";
                $(".modal-header #title_modal").text("File Organizational Strategy");
                $(".modal-body #url_route").val("leadership/file_ls/create/" + data_);
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
                                        window.location.href = '<?= site_url("leadership/commitment/is_objective/index/") ?>' + response.id_version + '/' + response.num_ver;
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
        $(document).ready(function () {
            getTableData2();
            $("#Organizational").summernote('disable');
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "none";
            close_btn.style.display = "none";
            $("#org-strategy-tab-text .overlay").show();

        });
        $("#Organizational").summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline',]],
            ]
        });

        function click_edit() {
            $("#Organizational").summernote('enable');
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "block";
            close_btn.style.display = "block";
        }

        function click_close() {
            $("#Organizational").summernote('disable');
            var submit_btn = document.getElementById('submit');
            var close_btn = document.getElementById('close');
            submit_btn.style.display = "none";
            close_btn.style.display = "none";
        }
    </script>
    <script>
        var count = 0;
        var id_org_temp = 0;
        $("#Organizational_edit").on('submit', function (event) {
            event.preventDefault();
            action_('leadership/commitment/org/edit/' + id_org_temp, 'Organizational_edit');
        });

        function getTableData1() {
            if (count === 0) {
                count++;
                $.ajax({
                    url: '<?= base_url("context/loaddatatype/6") ?>',
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function (response) {
                        id_org_temp = response.org_data.id_org;
                        $("#Organizational").summernote('code', response.org_data.text);
                        $("#org-strategy-tab-text .overlay").hide();

                        var disabledAttribute = '';
                        if ($.fn.DataTable.isDataTable('#example1')) {
                            $('#example1').DataTable().destroy();
                        }
                        $('#example1').DataTable({
                            "processing": $("#org-strategy-tab-file .overlay").show(),
                            "pageLength": 10,
                            "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                            'serverSide': true,
                            'ajax': {
                                'url': "<?php echo site_url('leadership/file_ls/getdata/'); ?>" +
                                    response.org_data.id_version,
                                'type': 'GET',
                                'dataSrc': 'data',
                            },
                            "responsive": true,
                            "lengthChange": false,
                            "autoWidth": false,
                            "searching": false,
                            "drawCallback": function (settings) {
                                var daData = settings.json.data;
                                $("#org-strategy-tab-file .overlay").hide();

                                if (daData.length == 0) {
                                    $('#example1 tbody').html(`
                                    <tr>
                                        <td colspan="1">
                                            <div class="dropdown">
                                                <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                                                    class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-default"
                                                        onclick="load_modal(3 , '${response.org_data.id_version}')">Create</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="3"> 
                                        </td>
                                    </tr>`);
                                }
                            },
                            'columns': [{
                                'data': null,
                                'class': 'text-center',
                                'render': function (data, type, row, meta) {
                                    const encodedRowData = encodeURIComponent(JSON.stringify(row));
                                    return `
                                    <div class="dropdown">
                                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            ${disabledAttribute}></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="<?php echo base_url('leadership/file_ls/open/'); ?>${row.id_ls_file}"
                                                target="_blank">Open</a>
                                            <a class="dropdown-item"
                                                href="<?php echo base_url('leadership/file_ls/dowloadfile/'); ?>${row.id_ls_file}">Download</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                                                onclick="load_modal('8' , '${encodedRowData}')">Rename</a>
                                            <a class="dropdown-item" href="#"
                                                onclick="confirm_Alert('Do you want to delete this file ?', 'leadership/file_ls/delete/${row.id_ls_file}')">Delete</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#modal-default"
                                                onclick="load_modal(3 , '${response.org_data.id_version}')">Create</a>
                                        </div>
                                    </div>`;
                                }
                            },
                            {
                                'data': null,
                                'class': 'text-center',
                                'render': function (data, type, row, meta) {
                                    return '<div style="color: rgba(0, 123, 255, 1);">' + (
                                        meta.settings.oAjaxData.start += 1) + '</div>';
                                }
                            },
                            {
                                'data': null,
                                'class': 'text-center',
                                'render': function (data, type, row, meta) {
                                    return `<a"> ${row.name_file}</a>`
                                }
                            },
                            {
                                'data': null,
                                'class': 'text-center',
                                'render': function (data, type, row, meta) {
                                    return `<a"> ${row.upload_date}</a>`
                                }
                            },
                            ]
                        });
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }
        }
    </script>
    <script>
        function getTableData2() {
            var disabledAttribute = '';

            var data = <?php echo json_encode($data); ?>;
            var data1 = <?php echo json_encode($data1); ?>;
            if ($.fn.DataTable.isDataTable('#example2')) {
                $('#example2').DataTable().destroy();
            }
            $('#example2').DataTable({
                "processing": $("#is_objective .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('leadership/commitment/is_objective/getdata/'); ?>" + data
                        .id_version,
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "drawCallback": function (settings) {
                    $("#is_objective .overlay").hide();
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#example2 tbody').html(`
                        <tr>
                            <td colspan="1">
                                <div class="dropdown">
                                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-default"
                                            onclick="load_modal(4 , '' , '${data1.status}')">Create</a>
                                    </div>
                                </div>
                            </td>
                            <td colspan="2">
                            </td>
                        </tr>`);
                    }
                },
                'columns': [{
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        const encodedRowData = encodeURIComponent(JSON.stringify(row));
                        return `
                        <div class="dropdown">
                            <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                                class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                ${disabledAttribute}></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-default"
                                    onclick="load_modal('5' , '${encodedRowData}' , '${data1.status}')">Edit</a>
                                <a class="dropdown-item"
                                    onclick="confirm_Alert('Do you want to copy this data ?' , 'leadership/commitment/is_objective/copy/${row.id_is_objective}')">Copy</a>
                                <a class="dropdown-item"
                                    onclick="confirm_Alert('Do you want to delete this data ?' , 'leadership/commitment/is_objective/delete/${row.id_is_objective}/${data.id_version}/${data1.status}')">Delete</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-default"
                                    onclick="load_modal(4 , '' , '${data1.status}')">Create</a>
                            </div>
                        </div>`;
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
                        return `<a"> ${row.text}</a>`
                    }
                },
                ]
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>
    <script>
        // Get references to the tabs by their IDs
        let orgStrategyTab = document.getElementById("org-strategy-tab");
        let isObjectiveTab = document.getElementById("is-objective-tab");
        document.getElementById("org-heaer-path").style.display = "none";
        document.getElementById("objective-heaer-path").style.display = "block";
        document.getElementById("version-heaer-path").style.display = "block";
        orgStrategyTab.addEventListener("click", function () {
            document.getElementById("org-heaer-path").style.display = "block";
            document.getElementById("objective-heaer-path").style.display = "none";
            document.getElementById("version-heaer-path").style.display = "none";
        });

        isObjectiveTab.addEventListener("click", function () {
            document.getElementById("org-heaer-path").style.display = "none";
            document.getElementById("objective-heaer-path").style.display = "block";
            document.getElementById("version-heaer-path").style.display = "block";
        });
    </script>