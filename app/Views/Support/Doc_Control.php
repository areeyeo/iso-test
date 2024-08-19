<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documented Information Version</title>
    <style>
        .table th,
        .table td {
            white-space: nowrap;
        }

        .dc-column-1 {
            width: 100px !important;
        }

        .dc-column-2 {
            width: 50px !important;
        }

        .dc-column-3 {
            width: 250px !important;
        }

        .dc-column-4 {
            width: 200px !important;
        }

        .dc-column-5 {
            width: 200px !important;
        }

        .dc-column-6 {
            width: 150px !important;
        }

        .dc-column-7 {
            width: 150px !important;
        }

        .dc-column-8 {
            width: 100px !important;
        }

        .dc-column-9 {
            width: 150px !important;
        }

        .dc-column-10 {
            width: 250px !important;
        }

        .dc-column-11 {
            width: 300px !important;
        }
    </style>
</head>

<body>
    <div class="card" id="context-ana">
        <div class="card-body">
            <div class="form-group">
                <div class="tab-content" id="tabs-tabContent">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Document control</h4>
                    </div>
                    <div class="tab-pane fade show active" id="Create-Update" role="tabpanel" aria-labelledby="org-strategy-tab">
                        <div class="" id="example1-wrapper">
                            <table id="example1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center dc-column-1">ACTION</th>
                                        <th class="dc-column-2">NO.</th>
                                        <th class="dc-column-3">DOCUMENT TYPE</th>
                                        <th class="dc-column-4">DOCUMENT ABBREVIATION</th>
                                        <th class="dc-column-5">NAME TH</th>
                                        <th class="dc-column-6">NAME ENG</th>
                                        <th class="dc-column-7">SECRET LEVEL</th>
                                        <th class="dc-column-8">VERSION</th>
                                        <th class="dc-column-9">RELEASE DATE</th>
                                        <th class="dc-column-10">REVIEW DATE</th>
                                        <th class="dc-column-11">FILE</th>
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
    <!-- data -->
    <script>
        function CRUDDocumentControl(id_doc) {
            window.location.href = "<?= base_url('support/documentation/documentControl/index/' . $data['id_version'] . '/' . $data['num_ver'] . '/' . $data['status'] . '/'); ?>" + id_doc;
        }

        function ViewDocumentControl(id_doc) {
            window.location.href = "<?= base_url('support/documentation/documentControl/index/view/' . $data['id_version'] . '/' . $data['num_ver'] . '/' . $data['status'] . '/'); ?>" + id_doc;
        }
    </script>
    <script>
        $(function() {
            $('#example1').on('show.bs.dropdown', function() {
                $('.dataTables_scrollBody').addClass('dropdown-visible');
                $('#example1-wrapper').addClass('table-wrapper');
            }).on('hide.bs.dropdown', function() {
                $('.dataTables_scrollBody').removeClass('dropdown-visible');
                $('#example1-wrapper').removeClass('table-wrapper');
            });
        });
        var countTable3 = 0;

        function getTableData3() {
            if (countTable3 === 0) {

                countTable3++;
                var data_version = <?php echo json_encode($data); ?>;
                if (data_version.status === '4' || data_version.status === '5') {
                    var disabledAttribute = 'disabled';
                }
                if ($.fn.DataTable.isDataTable('#example1')) {
                    $('#example1').DataTable().destroy();
                }
                $('#example1').DataTable({
                    "processing": true,
                    "pageLength": 10,
                    "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                    'serverSide': true,
                    'ajax': {
                        'url': "<?php echo site_url('support/documentation/documentControl/getdata/'); ?>" + data_version.id_version,
                        'type': 'GET',
                    },
                    "responsive": false,
                    "lengthChange": false,
                    "autoWidth": true,
                    "searching": true,
                    "ordering": false,
                    "scrollX": true,
                    "drawCallback": function(settings) {
                        var daData = settings.json.data;
                        if (daData.length == 0) {
                            $('#example1 tbody').html(`
                                <tr>
                                    <td colspan="10">
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
                                    <td colspan="1">
                                    </td>
                                </tr>`);
                        }
                    },
                    'columns': [{
                            'data': null,
                            'className': 'text-center dc-column-1',
                            'render': function(data, type, row, meta) {
                                var number_index = +meta.settings.oAjaxData.start + 1;
                                var my_fullname_user = '<?= session()->get('name') . ' ' . session()->get('lastname') ?>';
                                var check_menu = false;
                                data.create_update_upload.forEach(element => {
                                    var full_name = element.name_user + ' ' + element.lastname_user;
                                    if (my_fullname_user === full_name) {
                                        check_menu = true;
                                    }
                                });
                                data.review.forEach(element => {
                                    var full_name = element.name_user + ' ' + element.lastname_user;
                                    if (my_fullname_user === full_name) {
                                        check_menu = true;
                                    }
                                });
                                data.approval.forEach(element => {
                                    var full_name = element.name_user + ' ' + element.lastname_user;
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
                                    dropdownHtml += `<a class="dropdown-item" onclick="CRUDDocumentControl(${data.id_document_create_update})">Edit</a>`
                                }
                                dropdownHtml += `<a class="dropdown-item" onclick="ViewDocumentControl(${data.id_document_create_update})">View Detail</a>
                                </div>`
                                return dropdownHtml;
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-2',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-3',
                            'width': 200,
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + data.document_type + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-4',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + data.document_abbreviation + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-5',
                            'width': 150,
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + data.name_th + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-6',
                            'width': 150,
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + data.name_eng + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-7',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + data.secret_level + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-8',
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + data.version + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-9',
                            'width': 150,
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.release_date ? data.release_date : '-') + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-10',
                            'width': 150,
                            'render': function(data, type, row, meta) {
                                return '<div style="color: rgba(0, 123, 255, 1);">' + data.review_time + '</div>';
                            }
                        },
                        {
                            'data': null,
                            'className': 'text-center dc-column-11',
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
            $('#example1').on('show.bs.dropdown', function(e) {
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
            $('#example1').on('hide.bs.dropdown', function(e) {
                var $dropdown = $(e.relatedTarget).next('.dropdown-menu');
                $(e.relatedTarget).after($dropdown.detach());
                $dropdown.hide();
            });
        });
    </script>
</body>

</html>