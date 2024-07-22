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
                        <h1>Management Review
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Management Review</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="tab-content" id="tabs-tabContent">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4>Minutes of Meeting</h4>
                                    <div>
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-default " onclick="load_modal(2)">
                                            <span><i class="fas fa-edit"></i>&nbsp;&nbsp;Create MOM</span>
                                        </button>
                                    </div>
                                </div>
                                    <table id="example1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ACTION</th>
                                                <th>MEETING ID</th>
                                                <th>MEETING DATE</th>
                                                <th>MEETING DOCUMENTS</th>
                                                <th>MEETING MINUTES DOCUMENTS</th>
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
            <?= $this->include("Modal/CRUD_Perf_Management_Review"); ?>
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
        function load_modal(check, data_encode) {
            modal1 = document.getElementById("modal1");
            modal2 = document.getElementById("modal2");
            file_array = [];
            file_array2 = [];
            $(".modal-body #meeting_doc").empty();
            $(".modal-body #meeting_minutes_doc").empty();
            var fileNamesContainer = document.getElementById('fileNamesContainer');
            var fileNamesContainer2 = document.getElementById('fileNamesContainer2');
            fileNamesContainer.innerHTML = '';
            fileNamesContainer2.innerHTML = '';
            $(".modal-body #meetingdate").val('');
            $(".modal-body #label_meeting_minutes_doc").text('Choose file');

            if (check == '1') {
                //--show modal requirment--//
                modal1.style.display = "block";
                modal2.style.display = "none";
            } else if (check == '2') {

                //--show modal create Minutes of Meeting--//
                modal1.style.display = "none";
                modal2.style.display = "block";
                $(".modal-body #url_route").val("performance/management_review/create");
            } else if (check == '3') {
                //--show modal edit Minutes of Meeting--//
                modal1.style.display = "none";
                modal2.style.display = "block";

                const rowData = JSON.parse(decodeURIComponent(1));
                $(".modal-body #meetingdate").val(rowData.meeting_date);
                if (rowData.meeting_minutes_doc != null) {
                    $(".modal-body #label_meeting_minutes_doc").text(rowData.meeting_minutes_doc['name_file']);
                }
                if (rowData.meeting_doc != null) {
                    rowData.meeting_doc_data.forEach((element, i) => {
                        file_array2.push(element);
                        var fileNameContainer = document.createElement('div');
                        fileNameContainer.classList.add('file-name');
                        fileNameContainer.id = 'fileNameContainer2_' + element.id_files;

                        var fileIcon = document.createElement('span');
                        fileIcon.innerHTML = '<i class="far fa-file-alt"></i>';
                        fileIcon.classList.add('file-icon');

                        var fileInfo = document.createElement('span');
                        fileInfo.classList.add('file-info');
                        fileInfo.style.fontSize = '10pt';

                        var fileName = document.createElement('span');
                        fileName.textContent = element.name_file;
                        fileName.className = 'filename';

                        var fileIcons = document.createElement('span');
                        fileIcons.innerHTML = '<i class="fas fa-trash-alt"></i>';
                        fileIcons.classList.add('file-icon-bin');
                        fileIcons.addEventListener('click', function() {
                            deleteFile2(element.id_files, 'fileNameContainer2_' + element.id_files);
                        });
                        fileInfo.appendChild(fileIcon);
                        fileInfo.appendChild(fileName);
                        fileInfo.appendChild(fileIcons);
                        fileNameContainer.appendChild(fileInfo);
                        fileNamesContainer2.appendChild(fileNameContainer);
                    });
                }
                $(".modal-body #url_route").val("performance/management_review/edit/" + rowData.id_management_review);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            getTableData1();
        })

        function getTableData1() {
            if ($.fn.DataTable.isDataTable('#example1')) {
                $('#example1').DataTable().destroy();
            }
            $('#example1').DataTable({
                "processing": true,
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?= base_url('performance/management_review/getdata') ?>",
                    'type': 'GET',
                    'dataSrc': 'data',
                },
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "ordering": false,
                "drawCallback": function(settings) {
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#example1 tbody').html(`
                            <tr>
                                <td colspan="5">
                                    <div class="dropdown">
                                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="load_modal(2)" data-toggle="modal"
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
                        var number_index = (meta.settings.oAjaxData.start += 1);
                        const encodedRowData = encodeURIComponent(JSON.stringify(data));
                        return `<div class="dropdown">
                                    <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButtonPlanning" data-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPlanning">
                                        <li data-toggle="modal" data-target="#modal-default " onclick="load_modal(3, '${encodedRowData}')"><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="javascript:confirm_Alert('You want to copy data ${number_index} ?', 'performance/management_review/copydata/${data.id_management_review}')"">Copy</a></li>
                                        <li><a class="dropdown-item" href="javascript:confirm_Alert('You want to delete data ${number_index} ?', 'performance/management_review/delete/${data.id_management_review}')">Delete</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li data-toggle="modal" data-target="#modal-default " onclick="load_modal(2)"><a class="dropdown-item" href="#">Create</a></li>
                                    </ul>
                                </div>`
                    }
                }, {
                    'data': 'meeting_id',
                    'class': 'text-center',
                    'render': function(data, type, row, meta) {
                        return `<div style="color: #007bff">${data}</div>`
                    }
                }, {
                    'data': 'meeting_date',
                    'class': 'text-center',
                    'render': function(data, type, row, meta) {
                        // แปลงวันที่ให้เป็นรูปแบบใหม่
                        if (data == '0000-00-00') {
                            return `<div style="color: #007bff">-</div>`
                        } else {
                            const date = new Date(data);
                            const options = {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            };
                            const formattedDate = date.toLocaleDateString('en-GB', options).replace(/\./g, '');
                            return `<div style="color: #007bff">${formattedDate}</div>`;
                        }
                    }
                }, {
                    'data': null,
                    'class': 'text-center',
                    'render': function(data, type, row, meta) {
                        var inhtmlfile = '';
                        if (data.meeting_doc != null) {
                            data.meeting_doc_data.forEach(element => {
                                if (element.name_file.length > 30) {
                                    element.name_file = element.name_file.substring(0, 30) + '...';
                                }
                                inhtmlfile += `<a href="<?php echo base_url('openfile/'); ?>${element.id_files}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">
                                        ${element.name_file}
                                        </a> <br>`
                            });
                            return inhtmlfile;
                        } else {
                            return '<div style="color: rgba(0, 123, 255, 1);">No File</div>';
                        }
                    }
                }, {
                    'data': 'meeting_minutes_doc',
                    'class': 'text-center',
                    'render': function(data, type, row, meta) {
                        if (data == null) {
                            return '<div style="color: rgba(0, 123, 255, 1);">No File</div>';
                        } else {
                            return `<a href="<?php echo base_url('openfile/'); ?>${data.id_files}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">
                                    ${data.name_file}
                                    </a>`;
                        }
                    }
                }],
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));
            var fileArray;
            if (file_array && file_array.length > 0) {
                for (var i = 0; i < file_array.length; i++) {
                    formData.append("file[]", file_array[i]);
                }
            }
            var id_file_after = '';
            file_array2.forEach(element => {
                id_file_after += element.id_files + ",";
            });
            console.log(id_file_after);
            formData.append("id_file_after", id_file_after);
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
                        title: 'กําลังดําเนินการ...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function(response) {
                    Swal.close();
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            allowOutsideClick: true,
                        });
                        if (response.reload) {
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    } else {
                        Swal.fire({
                            title: response.message,
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonText: 'ตกลง',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonText: 'ตกลง',
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