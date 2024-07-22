<!DOCTYPE html>
<html lang="en">

<body>
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <h4>Audit Management Program</h4>
                    <button type="button" class="btn btn-dark" onclick="OpenAuditManagement()"><i class="fas fa-book"></i>&nbsp;&nbsp;Audit Program Main</button>
                </div>
                <hr>
                <div>
                    <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                        <li class="nav-item-tab" style="padding-right: 10px;">
                            <a class="nav-link active" id="Audit-Program-tab" data-toggle="pill" href="#Audit-Program" role="tab" aria-controls="Audit-Program" aria-selected="true">
                                Audit Program
                            </a>
                        </li>
                        <li class="nav-item-tab">
                            <a class="nav-link" id="Audit-Plan-tab" data-toggle="pill" href="#Audit-Plan" role="tab" aria-controls="Audit-Plan" aria-selected="false" onclick="getTableData_AMP_AuditPlan()">
                                Audit Plan
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="Audit-Program" role="tabpanel" aria-labelledby="Audit-Program-tab">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary mb-3" onclick="load_modal(3)" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-edit"></i>&nbsp;&nbsp;Create Program
                            </button>
                        </div>

                        <div class="table-wrapper">
                            <table id="example1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">ACTION</th>
                                        <th>NO.</th>
                                        <th>AP NO.</th>
                                        <th>PROGRAM NAME</th>
                                        <th>START DATE</th>
                                        <th>END DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="Audit-Plan" role="tabpanel" aria-labelledby="Audit-Plan-tab">
                        <div class="table-wrapper">
                            <table id="example2" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">ACTION</th>
                                        <th>AP NO.</th>
                                        <th>PROGRAM NAME</th>
                                        <th>SCOPE</th>
                                        <th>OBJECTIVE</th>
                                        <th>CRITERIA</th>
                                        <th>AUDIT LEAD</th>
                                        <th>AUDIT TEAM</th>
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
    <script>
        $(document).ready(function() {
            getTableData_AMP_AuditProgram();
        });
    </script>

    <!-- change page -->
    <script>
        function OpenAuditManagement() {
            window.location.href = "index";
        }
    </script>

    <!-- table audit program -->
    <script>
    var countTable1 = 0;

    function getTableData_AMP_AuditProgram() {
      if (countTable1 === 0) {
        countTable1++;
    
        if ($.fn.DataTable.isDataTable('#example1')) {
          $('#example1').DataTable().destroy();
        }
        $('#example1').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('internal_audit/audit_management/audit_program/getdata'); ?>",
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
                  <td colspan="10">
                      <div class="dropdown">
                          <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                              class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"></button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" onclick="load_modal(6,1)" data-toggle="modal"
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
                var number_index = +meta.settings.oAjaxData.start + 1;
                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                let dropdownHtml = `
                <div class="dropdown">
                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" onclick="load_modal(6, 2,'${encodedRowData}')" data-toggle="modal"
                            data-target="#modal-default">Edit</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to copy data ${number_index} ?', 'planning/planning/copydata/')">Copy</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'planning/planning/delete/')">Delete</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="load_modal(6,1)" data-toggle="modal" data-target="#modal-default">Create</a>`;
                dropdownHtml += `</div>
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
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.audit_report_no !== null ? (data.audit_report_no !== '' ? data.audit_report_no : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.program_name !== null ? (data.program_name !== '' ? data.program_name : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.start_date !== null ? (data.start_date !== '' ? data.start_date : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.end_date !== null ? (data.end_date !== '' ? data.end_date : '-') : '-') + '</div>';
              }
            },
          ],
        });
        $('[data-toggle="tooltip"]').tooltip();
      }
    }
  </script>

    <!-- table audit plan -->
    <script>
    var countTable2 = 0;

    function getTableData_AMP_AuditPlan() {
      if (countTable2 === 0) {
        countTable2++;
    
        if ($.fn.DataTable.isDataTable('#example2')) {
          $('#example2').DataTable().destroy();
        }
        $('#example2').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('internal_audit/audit_management/audit_plan/getdata'); ?>",
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
              $('#example2 tbody').html(`
              <tr>
                  <td colspan="10">
                      <div class="dropdown">
                          <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                              class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"></button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" onclick="load_modal(6,1)" data-toggle="modal"
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
                var number_index = +meta.settings.oAjaxData.start + 1;
                const encodedRowData = encodeURIComponent(JSON.stringify(row));
                let dropdownHtml = `
                <div class="dropdown">
                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" onclick="load_modal(6, 2,'${encodedRowData}')" data-toggle="modal"
                            data-target="#modal-default">Edit</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to copy data ${number_index} ?', 'planning/planning/copydata/')">Copy</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'planning/planning/delete/')">Delete</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="load_modal(6,1)" data-toggle="modal" data-target="#modal-default">Create</a>`;
                dropdownHtml += `</div>
                </div>`;
                return dropdownHtml;
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.audit_report_no !== null ? (data.audit_report_no !== '' ? data.audit_report_no : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.program_name !== null ? (data.program_name !== '' ? data.program_name : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.audit_scope !== null ? (data.audit_scope !== '' ? data.audit_scope : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.audit_objective !== null ? (data.audit_objective !== '' ? data.audit_objective : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.audit_criteria !== null ? (data.audit_criteria !== '' ? data.audit_criteria : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.audit_lead !== null ? (data.audit_lead !== '' ? data.audit_lead : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.audit_team !== null ? (data.audit_team !== '' ? data.audit_team : '-') : '-') + '</div>';
              }
            },
            {
                        'data': 'file_data',
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
                    },
          ],
        });
        $('[data-toggle="tooltip"]').tooltip();
      }
    }
  </script>

    <!-- switch tabs -->
    <script>
        $('#Audit-Program-tab').on('click', function() {
            console.log('Audit-Program-tab');
            $('#btn-Document').show();
        });
        $('#Audit-Plan-tab').on('click', function() {
            console.log('Audit-Plan-tab');
            $('#btn-Document').hide();
        })
    </script>
</body>

</html>