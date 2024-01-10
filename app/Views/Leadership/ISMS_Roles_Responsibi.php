<title>ISMS Roles & Responsibilities</title>
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
                        <h1>ISMS Roles & Responsibilities
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                                data-target="#modal-default" id="load-modal-button"
                                onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">ISMS Roles & Responsibilities</li>
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
                        <div class="card" id="isms-table-responsibilities">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 id="header_">ISMS Roles & Responsibilities</h4>
                                        <br>
                                        <table id="example1" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ACTION</th>
                                                    <th>NO.</th>
                                                    <th>ROLES</th>
                                                    <th>RESPONSIBILITIES</th>
                                                    <th>NAME - LAST NAME</th>
                                                    <th>FILE</th>
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
                        <br>
                        <div class="card" id="isms-table-file">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 id="header_">File</h4>
                                        *Assigment of All ISMS Team
                                        <br>
                                        <table id="example2" class="table table-hover">
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
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-default">
        <div id="modal1">
            <?= $this->include("Modal/Requirement_Modal"); ?>
        </div>
        <div id="modal2">
            <?= $this->include("Modal/CRUD_Leadership_Responsibilities_modal"); ?>
        </div>
        <div id="modal3">
            <?= $this->include("Modal/CRUD_Leadership_modal"); ?>
        </div>
        <div id="modal4">
            <?= $this->include("Modal/File_Rename_Modal"); ?>
        </div>
    </div>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
    <script>
        function load_modal(check, data_) {
            modal1 = document.getElementById("modal1");
            modal2 = document.getElementById("modal2");
            modal3 = document.getElementById("modal3");
            modal4 = document.getElementById("modal4");

            if (check == '1') {
                //--show modal requirment--//
                modal1.style.display = "block";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "none";
            } else if (check == '2') {
                //--show modal ISMS_Responsibilities create--//
                $(".modal-body #responsibilities").empty();
                $(".modal-body #name_lastname").empty();
                $(".modal-body #url_route").empty();
                modal1.style.display = "none";
                modal2.style.display = "block";
                modal3.style.display = "none";
                modal4.style.display = "none";

                var data = <?php echo json_encode($data); ?>;
                $(".modal-body #roles_select").val(1);
                $(".modal-body #url_route").val("leadership/isms/create/" + data.id_version);
                updateDescription();
            } else if (check == '3') {
                //--show modal ISMS_Responsibilities edit--//
                modal1.style.display = "none";
                modal2.style.display = "block";
                modal3.style.display = "none";
                modal4.style.display = "none";

                const rowData = JSON.parse(decodeURIComponent(data_));
                $(".modal-body #roles_select").val(rowData.roles);
                $(".modal-body #responsibilities").val(rowData.responsibilities);
                $(".modal-body #name_lastname").val(rowData.name_lastname);
                $(".modal-body #url_route").val("leadership/isms/edit/" + rowData.id_responsibilities);
                updateDescription();
            } else if (check == '4') {
                //--show modal file create--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "block";
                modal4.style.display = "none";

                const formGroupFile = document.getElementById("form-group-file");
                const formGroupText = document.getElementById("form-group-text");
                formGroupFile.style.display = "block";
                formGroupText.style.display = "none";
                $(".modal-header #title_modal").text("File ISMS Roles & Responsibilities");
                $(".modal-body #url_route").val("leadership/file_ls/create/" + data_);
            } else if (check == '5') {
                //--show modal file create--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "block";

                const rowData = JSON.parse(decodeURIComponent(data_));
                console.log(rowData);
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
                $(".modal-body #url_route").val("renamefile/" + rowData.id_files);
            } else if (check == '6') {
                //--show modal file create--//
                modal1.style.display = "none";
                modal2.style.display = "none";
                modal3.style.display = "none";
                modal4.style.display = "block";

                const rowData = JSON.parse(decodeURIComponent(data_));
                console.log(rowData);
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
                    console.log(response);
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
                        if (response.validator) {
                            var mes = "";
                            if (response.validator.responsibilities) {
                                mes += 'Please enter responsibilities of more than 1 character.' + '<br>';
                            }
                            if (response.validator.responsibilities && response.validator.name_lastname) {
                                mes += '<hr>';
                            }
                            if (response.validator.name_lastname) {
                                mes += 'Please enter your first and last name, more than 1 character.' + '<br>';
                            }
                            Swal.fire({
                                title: mes,
                                icon: 'error',
                                showConfirmButton: true,
                                width: '55%'
                            });
                        } else {
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
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
        $(document).ready(function () {
            getTableData1();
            getTableData2();

        });
    </script>
    <script>
        function getTableData1() {
            var disabledAttribute = '';
            var data = <?php echo json_encode($data); ?>;
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            $('#example1').DataTable({
                "processing": $("#isms-table-responsibilities .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('leadership/isms/getdata/'); ?>" + data.id_version,
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "drawCallback": function (settings) {
                    var daData = settings.json.data;
                    $("#isms-table-responsibilities .overlay").hide();
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
                                            onclick="load_modal(2)">Create</a>
                                    </div>
                                </div>
                            </td>
                            <td colspan="5">
                            </td>
                        </tr>`);
                    }
                },
                'columns': [{
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        var number_index = +meta.settings.oAjaxData.start + 1;
                        const encodedRowData = encodeURIComponent(JSON.stringify(row));
                        let disabledAttribute = ""; // You need to define the `disabledAttribute` variable
                        let dropdownHtml = `
                        <div class="dropdown">
                            <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                                class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                ${disabledAttribute}></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-default"
                                    onclick="load_modal('3' , '${encodedRowData}')">Edit</a>
                                <a class="dropdown-item"
                                    onclick="confirm_Alert('Do you want to copy this data ?' , 'leadership/isms/copy/${row.id_responsibilities}')">Copy</a>
                                <a class="dropdown-item"
                                    onclick="confirm_Alert('Do you want to delete this data ?' , 'leadership/isms/delete/${row.id_responsibilities}/${row.id_file}')">Delete</a>
                                <div class="dropdown-submenu">`;
                        if (row.id_file > 0) {
                            dropdownHtml += `
                            <a class="dropdown-item dropdown-toggle" href="#">File</a>
                            <div class="dropdown-menu right-menu-table">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                                    onclick="load_modal('5' , '${encodedRowData}')">Rename</a>
                                <a class="dropdown-item"
                                    onclick="confirm_Alert('Do you want to delete this data ?' , 'leadership/isms/delete_file/${row.id_responsibilities}/${row.id_file}')">Delete
                                    File</a>
                            </div>`;
                        }
                        dropdownHtml += `</div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-default" onclick="load_modal(2)">Create</a>
                                </div>
                            </div>`;
                        return dropdownHtml;
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        if (row.roles === '1') {
                            return '<a>Top Management</a>';
                        } else if (row.roles === '2') {
                            return '<a>ISMC : Information Security Management Committee</a>';
                        } else if (row.roles === '3') {
                            return '<a>Internal Audit</a>';
                        } else if (row.roles === '4') {
                            return '<a>ISMR : Information Security Management Representative</a>';
                        } else if (row.roles === '5') {
                            return '<a>Document Control</a>';
                        } else if (row.roles === '6') {
                            return '<a>Working Team</a>';
                        }
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        return `<a> ${row.responsibilities}</a>`
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        return `<a style="color: rgba(0, 123, 255, 1);"> ${row.name_lastname}</a>`
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
                ]
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>
    <script>
        function getTableData2() {
            var disabledAttribute = '';
            var data = <?php echo json_encode($data); ?>;
            if ($.fn.DataTable.isDataTable('#example2')) {
                $('#example2').DataTable().destroy();
            }
            $('#example2').DataTable({
                "processing": $("#isms-table-file .overlay").show(),
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('leadership/file_ls/getdata/'); ?>" + data.id_version,
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "drawCallback": function (settings) {
                    var daData = settings.json.data;
                    $("#isms-table-file .overlay").hide();
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
                                            onclick="load_modal(4 , '${data.id_version}')">Create</a>
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
                                    href="<?php echo base_url('leadership/file_ls/dowloadfile/'); ?>${row.id_ls_file}">Download</a> <a
                                    class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                                    onclick="load_modal('6' , '${encodedRowData}')">Rename</a>
                                <a class="dropdown-item" href="#"
                                    onclick="confirm_Alert('Do you want to delete this file ?', 'leadership/file_ls/delete/${row.id_ls_file}')">Delete</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal-default"
                                    onclick="load_modal(4 , '${data.id_version}')">Create</a>
                            </div>
                        </div>`;
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
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
    </script>