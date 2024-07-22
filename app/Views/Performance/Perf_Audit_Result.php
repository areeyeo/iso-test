<!DOCTYPE html>
<html lang="en">
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

    .accordion-item {
        border-bottom: 1px solid #ddd;
    }

    .accordion-title {
        padding: 20px;
        background-color: #BEDEFF;
        color: #818181;
        font-size: 1.2em;
        cursor: pointer;
        position: relative;
        border-radius: 10px;
        transition: background-color 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .accordion-title:hover {
        background-color: #E1F0FF;
    }

    .accordion-item.active .accordion-title {
        background-color: #E1F0FF;
    }

    .accordion-content {
        padding: 10px;
        display: none;
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.5s ease-out;
    }

    .accordion-item.active .accordion-content {
        display: block;
        max-height: 500px;
    }

    .accordion-item.active .accordion-content {
        animation: fadeIn 0.5s ease-out;
    }

    .accordion-title::before {
        content: '+';
        display: inline-block;
        margin-right: 10px;
        font-size: 1.2em;
        transition: transform 0.5s ease;
        transform-origin: center;
    }

    .accordion-title::before {
        content: '+';
        display: inline-block;
        margin-right: 10px;
        font-size: 1.2em;
        transition: transform 0.3s ease;
        transform-origin: center;
    }

    .accordion-item.active .accordion-title::before {
        content: '-';
        transform: rotate(180deg);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<body>

    <!-- section audit result -->
    <section>
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <h4>Audit Result</h4>
                        <button type="button" class="btn btn-outline-primary" style="margin-inline-start: auto;" data-toggle="modal" data-target="#modal-default" onclick="load_modal(12)">
                            <i class="fas fa-edit"></i>&nbsp;&nbsp;Create Audit Result
                        </button>
                    </div>
                    <hr>
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-title">Nonconformity</div>
                            <div class="accordion-content">
                                <div class="table-wrapper">
                                    <table id="examplefollow1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ACTION</th>
                                                <th>AR NO.</th>
                                                <th>NONCONFORMITY ISSUE</th>
                                                <th>LEVEL OF NONCONFORMITY</th>
                                                <th>DETAIL</th>
                                                <th>REQUIREMENTS/CONTROL</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <div class="accordion-title">Observation</div>
                            <div class="accordion-content">
                                <div class="table-wrapper">
                                    <table id="examplefollow2" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ACTION</th>
                                                <th>AR NO.</th>
                                                <th>OBSERVATION ISSUE</th>
                                                <th>DETAIL</th>
                                                <th>REQUIREMENTS/CONTROL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mt-3">
                        <div class="accordion-title">Opportunity</div>
                        <div class="accordion-content">
                            <div class="table-wrapper">
                                <table id="examplefollow3" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ACTION</th>
                                            <th>AR NO.</th>
                                            <th>OPPORTUNITY ISSUE</th>
                                            <th>DETAIL</th>
                                            <th>REQUIREMENTS/CONTROL</th>
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
        </div>
        </div>
        </div>
    </section>

    <!-- open close tab -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const items = document.querySelectorAll('.accordion-item');

            items.forEach(item => {
                const title = item.querySelector('.accordion-title');
                title.addEventListener('click', () => {
                    items.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('active')) {
                            otherItem.classList.remove('active');
                            otherItem.querySelector('.accordion-content').style.display = 'none';
                        }
                    });

                    item.classList.toggle('active');
                    const content = item.querySelector('.accordion-content');
                    content.style.display = content.style.display === 'block' ? 'none' : 'block';
                });
            });
        });
    </script>

<script>
    var countTable = 0;

    function getTableData() {
      if (countTable === 0) {
        countTable++;
    
        // table data nonconformity
        if ($.fn.DataTable.isDataTable('#examplefollow1')) {
          $('#examplefollow1').DataTable().destroy();
        }
        $('#examplefollow1').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('internal_audit/audit_result/nonconformity/getdata/'); ?>",
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
              $('#examplefollow1 tbody').html(`
              <tr>
                  <td colspan="10">
                      <div class="dropdown">
                          <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                              class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" ${disabledAttribute}></button>
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
                var audit_report = <?php echo json_encode($audit_report); ?>;
                let mataudit_report = audit_report.find(element_objective => element_objective.id_audit_report === data.id_audit_report);
                return '<div style="color: rgba(0, 123, 255, 1);">' + (mataudit_report.audit_report_no + '&nbsp;' + mataudit_report.report_about ?? '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.nonconformity_issue !== null ? (data.nonconformity_issue !== '' ? data.nonconformity_issue : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.level_of_nonconformity !== null ? (data.level_of_nonconformity !== '' ? data.level_of_nonconformity : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.detail !== null ? (data.detail !== '' ? data.detail : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.requirements_control !== null ? (data.requirements_control !== '' ? data.requirements_control : '-') : '-') + '</div>';
              }
            },
          ],
        });
        $('[data-toggle="tooltip"]').tooltip();

        // table data observation
        if ($.fn.DataTable.isDataTable('#examplefollow2')) {
          $('#examplefollow2').DataTable().destroy();
        }
        $('#examplefollow2').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('internal_audit/audit_result/observation/getdata/'); ?>",
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
              $('#examplefollow2 tbody').html(`
              <tr>
                  <td colspan="10">
                      <div class="dropdown">
                          <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                              class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" ${disabledAttribute}></button>
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
                var audit_report = <?php echo json_encode($audit_report); ?>;
                let mataudit_report = audit_report.find(element_objective => element_objective.id_audit_report === data.id_audit_report);
                return '<div style="color: rgba(0, 123, 255, 1);">' + (mataudit_report.audit_report_no + '&nbsp;' + mataudit_report.report_about ?? '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.non_inconsistent !== null ? (data.non_inconsistent !== '' ? data.non_inconsistent : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.detail !== null ? (data.detail !== '' ? data.detail : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.requirements_control !== null ? (data.requirements_control !== '' ? data.requirements_control : '-') : '-') + '</div>';
              }
            },
          ],
        });
        $('[data-toggle="tooltip"]').tooltip();

        // table data opportunity
        if ($.fn.DataTable.isDataTable('#examplefollow3')) {
          $('#examplefollow3').DataTable().destroy();
        }
        $('#examplefollow3').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('internal_audit/audit_result/opportunity/getdata/'); ?>",
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
              $('#examplefollow3 tbody').html(`
              <tr>
                  <td colspan="10">
                      <div class="dropdown">
                          <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                              class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" ${disabledAttribute}></button>
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
                var audit_report = <?php echo json_encode($audit_report); ?>;
                let mataudit_report = audit_report.find(element_objective => element_objective.id_audit_report === data.id_audit_report);
                return '<div style="color: rgba(0, 123, 255, 1);">' + (mataudit_report.audit_report_no + '&nbsp;' + mataudit_report.report_about ?? '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.non_inconsistent !== null ? (data.non_inconsistent !== '' ? data.non_inconsistent : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.detail !== null ? (data.detail !== '' ? data.detail : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.requirements_control !== null ? (data.requirements_control !== '' ? data.requirements_control : '-') : '-') + '</div>';
              }
            },
          ],
        });
        $('[data-toggle="tooltip"]').tooltip();
      }
    }
  </script>
</body>

</html>