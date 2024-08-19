<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documented Information Version</title>
    <style>
    table {
        table-layout: fixed;
        width: 100%;
        word-wrap: break-word;
    }

    tr:nth-child(even) {
        background-color: #F5F5F5;
    }

    th {
        background-color: #F5F6FA;
        text-align: center !important;
        border-bottom: none;
    }

    tbody {
        border-bottom: 10px solid #ccc;
        text-align: center;
    }

    .table thead th {
        border-bottom: none;
        white-space: nowrap;
        text-align: center !important;
    }

    .table td {
        white-space: normal !important;
        word-wrap: break-word;
        height: auto;
        overflow: hidden;
    }

    .md-column-1 {
        width: 100px !important;
    }

    .md-column-2 {
        width: 50px !important;
    }

    .md-column-3 {
        width: 250px !important;
    }

    .md-column-4 {
        width: 200px !important;
    }

    .md-column-5 {
        width: 200px !important;
    }

    .md-column-6 {
        width: 150px !important;
    }

    .md-column-7 {
        width: 150px !important;
    }

    .md-column-8 {
        width: 300px !important;
    }

    .md-column-9 {
        width: 100px !important;
    }

    .md-column-10 {
        width: 150px !important;
    }

    .md-column-11 {
        width: 300px !important;
        white-space: normal !important;
        word-wrap: break-word;
    }

    .cu-column-1 {
        width: 100px !important;
    }

    .cu-column-2 {
        width: 50px !important;
    }

    .cu-column-3 {
        width: 250px !important;
    }

    .cu-column-4 {
        width: 200px !important;
    }

    .cu-column-5 {
        width: 200px !important;
    }

    .cu-column-6 {
        width: 150px !important;
    }

    .cu-column-7 {
        width: 150px !important;
    }

    .cu-column-8 {
        width: 250px !important;
    }

    .cu-column-9 {
        width: 250px !important;
    }

    .cu-column-10 {
        width: 250px !important;
    }

    .cu-column-11 {
        width: 70px !important;
        white-space: normal !important;
        word-wrap: break-word;
    }

    .cu-column-12 {
        width: 70px !important;
        white-space: normal !important;
        word-wrap: break-word;
    }

    .cu-column-12 {
        width: 300px !important;
        white-space: normal !important;
        word-wrap: break-word;
    }
</style>
</head>

<body>
<div class="card" id="context-ana">
    <div class="card-body">
        <div class="form-group d-flex justify-content-between align-items-center">
            <div>
                <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                    <li class="nav-item-tab" style="padding-right: 10px;">
                        <a class="nav-link active" id="Create-Update-tab" data-toggle="pill" href="#Create-Update"
                            role="tab" aria-controls="Create-Update" aria-selected="true">
                            Creating & Updating
                        </a>
                    </li>
                    <li class="nav-item-tab">
                        <a class="nav-link" id="Management-Doc-tab" data-toggle="pill" href="#Management-Doc" role="tab"
                            aria-controls="Management-Doc" aria-selected="false" onclick="getTableData2();">
                            Management Document
                        </a>
                    </li>
                </ul>
            </div>
            <div id="btn-Document" name="btn-Document">
                <button type="button" class="btn btn-outline-primary" onclick="CRUDDocumentCreateUpdate()">
                    <span class="text-nowrap"><i class="fas fa-edit"></i>&nbsp;&nbsp;Create Document</span>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="Create-Update" role="tabpanel"
                aria-labelledby="org-strategy-tab">
                <div class="" id="table-craete-update-wrapper">
                    <table id="table-craete-update" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="cu-column-1 text-center">ACTION</th>
                                <th class="cu-column-2">NO.</th>
                                <th class="cu-column-3">DOCUMENT TYPE</th>
                                <th class="cu-column-4">DOCUMENT ABBREVIATION</th>
                                <th class="cu-column-5">NAME TH</th>
                                <th class="cu-column-6">NAME ENG</th>
                                <th class="cu-column-7">SECRET LEVEL</th>
                                <th class="cu-column-8 text-center">CREATE / UPDATE / UPLOAD</th>
                                <th class="cu-column-9 text-center">REVIEW</th>
                                <th class="cu-column-10 text-center">APPROVAL</th>
                                <th class="cu-column-11 text-center">VERSION</th>
                                <th class="cu-column-12 text-center">STATUS</th>
                                <th class="cu-column-12 text-center">FILE</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="Management-Doc" role="tabpanel" aria-labelledby="Management-Doc-tab">
                <div class="" id="table-management-doc-wrapper">
                    <table id="table-management-doc" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="md-column-1">ACTION</th>
                                <th class="md-column-2">NO.</th>
                                <th class="md-column-3">DOCUMENT TYPE</th>
                                <th class="md-column-4">DOCUMENT ABBREVIATION</th>
                                <th class="md-column-5">NAME TH</th>
                                <th class="md-column-6">NAME ENG</th>
                                <th class="md-column-7">SECRET LEVEL</th>
                                <th class="md-column-8">MANAGEMENT PERMISSIONS</th>
                                <th class="md-column-9">VERSION</th>
                                <th class="md-column-10">STATUS</th>
                                <th class="md-column-11">FILE</th>
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
<!-- data -->
<script>
    $(document).ready(function() {
        getTableData1();
        getTableData2();
        setTimeout(function() {
            var table1 = $('#table-craete-update').DataTable();
            table1.columns.adjust().draw();
            var table2 = $('#table-management-doc').DataTable();
            table2.columns.adjust().draw();
        }, 2000);
    });
</script>
<script>
    function CRUDDocumentCreateUpdate() {
        window.location.href = "<?= base_url('support/documentation/create/index/' . $data['id_version'] . '/' . $data['num_ver'] . '/' . $data['status']); ?>";
    }

    function CRUDDocumentManagementDocument(id_doc) {
        window.location.href = "<?= base_url('support/documentation/management/index/' . $data['id_version'] . '/' . $data['num_ver'] . '/' . $data['status'] . '/'); ?>" + id_doc;
    }

    function CRUDDocumentManagementDocumentView(id_doc) {
        window.location.href = "<?= base_url('support/documentation/management/index/view/' . $data['id_version'] . '/' . $data['num_ver'] . '/' . $data['status'] . '/'); ?>" + id_doc;
    }

    $('#Create-Update-tab').on('click', function() {
        $('#btn-Document').show();
    });
    $('#Management-Doc-tab').on('click', function() {
        $('#btn-Document').hide();
    })
    const statusMap = {
        '1': {
            label: 'Draft',
            backgroundColor: '#343A40',
            color: '#fff'
        },
        '2': {
            label: 'Pending Review',
            backgroundColor: '#E2F0FF',
            color: '#0062FF'
        },
        '3': {
            label: 'Rejected',
            backgroundColor: '#D40000',
            color: '#fff'
        },
        '4': {
            label: 'Pending Approval',
            backgroundColor: '#D4EDDA',
            color: '#28A745'
        },
        '5': {
            label: 'Approved',
            backgroundColor: '#28A745',
            color: '#fff'
        },
        '6': {
            label: 'Request Modification',
            backgroundColor: '#FBCB0A',
            color: '#fff'
        }
    };
</script>
<script>
    $(function() {
        $('#table-craete-update').on('show.bs.dropdown', function() {
            $('.dataTables_scrollBody').addClass('dropdown-visible');
            $('#table-craete-update-wrapper').addClass('table-wrapper');
        }).on('hide.bs.dropdown', function() {
            $('.dataTables_scrollBody').removeClass('dropdown-visible');
            $('#table-craete-update-wrapper').removeClass('table-wrapper');
        });
        $('#table-management-doc').on('show.bs.dropdown', function() {
            $('.dataTables_scrollBody').addClass('dropdown-visible');
            $('#table-management-doc-wrapper').addClass('table-wrapper');
        }).on('hide.bs.dropdown', function() {
            $('.dataTables_scrollBody').removeClass('dropdown-visible');
            $('#table-management-doc-wrapper').removeClass('table-wrapper');
        });
    });
    var countTable1 = 0;

    function getTableData1() {
        if (countTable1 === 0) {

            countTable1++;
            var data_version = <?php echo json_encode($data); ?>;
            if (data_version.status === '4' || data_version.status === '5') {
                var disabledAttribute = 'disabled';
            }
            if ($.fn.DataTable.isDataTable('#table-craete-update')) {
                $('#table-craete-update').DataTable().destroy();
            }
            $('#table-craete-update').DataTable({
                "processing": true,
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('support/documentation/create/getdata/'); ?>" + data_version.id_version,
                    'type': 'GET',
                },
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "searching": true,
                "ordering": false,
                "scrollX": true,
                "columnDefs": [{
                        "className": "cu-column-1",
                        "targets": 0
                    },
                    {
                        "className": "cu-column-2",
                        "targets": 1
                    },
                    {
                        "className": "cu-column-3",
                        "targets": 2
                    },
                    {
                        "className": "cu-column-4",
                        "targets": 3
                    },
                    {
                        "className": "cu-column-5",
                        "targets": 4
                    },
                    {
                        "className": "cu-column-6",
                        "targets": 5
                    },
                    {
                        "className": "cu-column-7",
                        "targets": 6
                    },
                    {
                        "className": "cu-column-8",
                        "targets": 7
                    },
                    {
                        "className": "cu-column-9",
                        "targets": 8
                    },
                    {
                        "className": "cu-column-10",
                        "targets": 9
                    },
                    {
                        "className": "cu-column-11",
                        "targets": 10
                    },
                    {
                        "className": "cu-column-12",
                        "targets": 11
                    },
                    {
                        "className": "cu-column-12",
                        "targets": 12
                    }
                ],
                "drawCallback": function(settings) {
                    var daData = settings.json.data;
                    if (daData.length == 0) {

                        $('#table-craete-update tbody').html(`
                            <tr>
                                <td colspan="8">
                                    <div class="dropdown">
                                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" ${disabledAttribute}>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" onclick="CRUDDocumentCreateUpdate()">Create</a>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="15">
                                </td>
                            </tr>`);
                    }
                },
                'columns': [{
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            var number_index = +meta.settings.oAjaxData.start + 1;
                            var my_fullname_user = '<?= session()->get('name') . ' ' . session()->get('lastname') ?>';
                            var check_menu = false;
                            var check_menu_delete = false;

                            data.create_update_upload.forEach(element => {
                                var full_name = element.name_user + ' ' + element.lastname_user
                                if (my_fullname_user === full_name) {
                                    check_menu_delete = true;
                                }
                            });
                            data.review.forEach(element => {
                                var full_name = element.name_user + ' ' + element.lastname_user
                                if (my_fullname_user === full_name) {
                                    check_menu = true;
                                }
                            });
                            data.approval.forEach(element => {
                                var full_name = element.name_user + ' ' + element.lastname_user
                                if (my_fullname_user === full_name) {
                                    check_menu = true;
                                }
                            });

                            let dropdownHtml = `
                                <div class="dropdown">
                                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        ${disabledAttribute}></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">`;
                            if (check_menu) {
                                dropdownHtml += `<a class="dropdown-item" onclick="CRUDDocumentManagementDocument(${data.id_document_create_update})">Edit</a>`
                            }
                            dropdownHtml += `<a class="dropdown-item" onclick="CRUDDocumentManagementDocumentView(${data.id_document_create_update})">View Detail</a>`
                            if (check_menu_delete) {
                                dropdownHtml += `<a class="dropdown-item" href="#" onclick="confirm_Alert('You want to delete data ${number_index} ?', 'support/documentation/delete/${data.id_document_create_update}/${data_version.id_version}/${data_version.status}')">Delete</a>`
                            }
                            dropdownHtml += `<div class="dropdown-divider"></div>
                                        <a class="dropdown-item" onclick="CRUDDocumentCreateUpdate()">Create</a>
                                        </div>
                                </div>`;
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
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.document_type + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.document_abbreviation + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'width': 150,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.name_th + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'width': 150,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.name_eng + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.secret_level + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            var html_consequence = '';
                            data.create_update_upload.forEach(element => {
                                html_consequence += '<li style="color: rgba(0, 123, 255, 1);">' + element.name_user + ' ' + element.lastname_user + '</li>';
                            });
                            return html_consequence;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            var html_consequence = '';
                            data.review.forEach(element => {
                                html_consequence += '<li style="color: rgba(0, 123, 255, 1);">' + element.name_user + ' ' + element.lastname_user + '</li>';
                            });
                            return html_consequence;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            var html_consequence = '';
                            data.approval.forEach(element => {
                                html_consequence += '<li style="color: rgba(0, 123, 255, 1);">' + element.name_user + ' ' + element.lastname_user + '</li>';
                            });
                            return html_consequence;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.version + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            const statusInfo = statusMap[data.status];
                            const badgeHTML = statusInfo ? `<span class="badge rounded-pill" style="background-color: ${statusInfo.backgroundColor}; color: ${statusInfo.color};">${statusInfo.label}</span>` : '';
                            return badgeHTML;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            if (data.id_file != null) {
                                return `<a href="<?php echo base_url('openfile/'); ?>${data.id_file.id_files}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">
                                ${data.id_file.name_file}
                                </a>`
                            } else {
                                return '<div style="color: rgba(0, 123, 255, 1);">No File</div>';
                            }
                        }
                    }
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
            var data_version = <?php echo json_encode($data); ?>;
            if (data_version.status === '4' || data_version.status === '5') {
                var disabledAttribute = 'disabled';
            }
            if ($.fn.DataTable.isDataTable('#table-management-doc')) {
                $('#table-management-doc').DataTable().destroy();
            }
            $('#table-management-doc').DataTable({
                "processing": true,
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('support/documentation/management/getdata/'); ?>" + data_version.id_version,
                    'type': 'GET',
                },
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "searching": true,
                "ordering": false,
                "scrollX": true,
                "columnDefs": [{
                        "className": "md-column-1",
                        "targets": 0
                    },
                    {
                        "className": "md-column-2",
                        "targets": 1
                    },
                    {
                        "className": "md-column-3",
                        "targets": 2
                    },
                    {
                        "className": "md-column-4",
                        "targets": 3
                    },
                    {
                        "className": "md-column-5",
                        "targets": 4
                    },
                    {
                        "className": "md-column-6",
                        "targets": 5
                    },
                    {
                        "className": "md-column-7",
                        "targets": 6
                    },
                    {
                        "className": "md-column-8",
                        "targets": 7
                    },
                    {
                        "className": "md-column-9",
                        "targets": 8
                    },
                    {
                        "className": "md-column-10",
                        "targets": 9
                    },
                    {
                        "className": "md-column-11",
                        "targets": 10
                    }
                ],
                "drawCallback": function(settings) {
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#table-management-doc tbody').html(`
                        <tr>
                            <td colspan="8">
                                <div class="dropdown">
                                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" ${disabledAttribute}>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="CRUDDocumentCreateUpdate()">Create</a>
                                    </div>
                                </div>
                            </td>
                            <td colspan="15">
                            </td>
                        </tr>`);
                    }
                },
                'columns': [{
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<a href="javascript:void(0);" onclick="CRUDDocumentManagementDocument(' + data.id_document_create_update + ')"><i class="fas fa-edit pointer text-primary" aria-expanded="false"></i></a>';
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
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.document_type + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.document_abbreviation + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'width': 150,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.name_th + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'width': 150,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.name_eng + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.secret_level + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'render': function(data, type, row, meta) {
                            var html_permissions = '';
                            if (data.create_update_upload) {
                                html_permissions += '<li style="color: rgba(0, 123, 255, 1);">Create/Update/Upload</li>';
                            }
                            if (data.review) {
                                html_permissions += '<li style="color: rgba(0, 123, 255, 1);">Review</li>';
                            }
                            if (data.approval) {
                                html_permissions += '<li style="color: rgba(0, 123, 255, 1);">Approval</li>';
                            }
                            return html_permissions;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.version + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            const statusInfo = statusMap[data.status];
                            const badgeHTML = statusInfo ? `<span class="badge rounded-pill" style="background-color: ${statusInfo.backgroundColor}; color: ${statusInfo.color};">${statusInfo.label}</span>` : '';
                            return badgeHTML;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            if (data.id_file != null) {
                                return `<a href="<?php echo base_url('openfile/'); ?>${data.id_file.id_files}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">
                            ${data.id_file.name_file}
                            </a>`
                            } else {
                                return '<div style="color: rgba(0, 123, 255, 1);">No File</div>';
                            }
                        }
                    }
                ],
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
</script>
<script>
        $(document).ready(function() {
            // เมื่อ dropdown แสดง
            $('#table-craete-update').on('show.bs.dropdown', function(e) {
                var $dropdown = $(e.relatedTarget).next('.dropdown-menu');
                $('body').append($dropdown.detach());
                var eOffset = $(e.relatedTarget).offset();
                $dropdown.css({
                    'display': 'block',
                    'top': eOffset.top + $(e.relatedTarget).outerHeight(),
                    'left': eOffset.left
                });
            });

            // เมื่อ dropdown ซ่อน
            $('#table-craete-update').on('hide.bs.dropdown', function(e) {
                var $dropdown = $(e.relatedTarget).next('.dropdown-menu');
                $(e.relatedTarget).after($dropdown.detach());
                $dropdown.hide();
            });
        });
    </script>
    </body>
</html>