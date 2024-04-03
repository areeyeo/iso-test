<title>Documented Information Version</title>
<style>
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

<div class="card" id="context-ana">
    <div class="card-body">
        <div class="form-group">
            <div class="tab-content" id="tabs-tabContent">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Document control</h4>
                </div>
                <div class="tab-pane fade show active" id="Create-Update" role="tabpanel"
                    aria-labelledby="org-strategy-tab">
                    <div class="" id="example1-wrapper">
                        <table id="example1" class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ACTION</th>
                                    <th>NO.</th>
                                    <th>DOCUMENT TYPE</th>
                                    <th>DOCUMENT ABBREVIATION</th>
                                    <th>NAME TH</th>
                                    <th>NAME ENG</th>
                                    <th>SECRET LEVEL</th>
                                    <th>VERSION</th>
                                    <th>RELEASE DATE</th>
                                    <th>REVIEW DATE</th>
                                    <th>FILE</th>
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
    $(function () {
        $('#example1').on('show.bs.dropdown', function () {
            $('.dataTables_scrollBody').addClass('dropdown-visible');
            $('#example1-wrapper').addClass('table-wrapper');
        }).on('hide.bs.dropdown', function () {
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
                "drawCallback": function (settings) {
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
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        var number_index = +meta.settings.oAjaxData.start + 1;
                        var my_fullname_user = '<?= session()->get('name') . ' ' . session()->get('lastname') ?>';
                        var check_menu = false;
                        data.create_update_upload.forEach(element => {
                            var full_name = element.name_user + ' ' + element.lastname_user
                            if (my_fullname_user === full_name) {
                                check_menu = true;
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
                            dropdownHtml += `<a class="dropdown-item" onclick="CRUDDocumentControl(${data.id_document_create_update})">Edit</a>`
                        }
                        dropdownHtml += `<a class="dropdown-item" onclick="ViewDocumentControl(${data.id_document_create_update})">View Detail</a>
                            </div>`
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
                    'width': 200,
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + data.document_type + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + data.document_abbreviation + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'width': 150,
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + data.name_th + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'width': 150,
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + data.name_eng + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + data.secret_level + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + data.version + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'width': 150,
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + (data.release_date ? data.release_date : '-') + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'width': 150,
                    'render': function (data, type, row, meta) {
                        return '<div style="color: rgba(0, 123, 255, 1);">' + data.review_time + '</div>';
                    }
                },
                {
                    'data': null,
                    'class': 'text-center',
                    'width': 200,
                    'render': function (data, type, row, meta) {
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