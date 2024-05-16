<title>Planning of Changes ISMS</title>
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
            <h1>Planning of Changes ISMS
              <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Planning of Changes ISMS</li>
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
            <div class="card" id="isms_process">
              <div class="card-body">
                <div class="form-group">
                  <div class="tab-content" id="tabs-tabContent">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <div>File</div>
                      <div id="btn-Objectives" name="btn-Objectives">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-default " onclick="load_modal(2)">
                          <span class="text-nowrap"><i class="fas fa-edit" onclick="load_modal(2)"></i>Create</span>
                        </button>
                      </div>
                    </div>

                    <table id="example1" class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">ACTION</th>
                          <th>No.</th>
                          <th>PLO No.</th>
                          <th>NAME</th>
                          <th>PLAN ORIGIN</th>
                          <th>START DATE</th>
                          <th>END DATE</th>
                          <th>OWNER</th>
                          <th>EVALUATION</th>
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
      </div>
    </section>
  </div>
  <div class="modal fade" id="modal-default">
    <div id="Requirement_Modal">
      <?= $this->include("Modal/Requirement_Modal"); ?>
    </div>
    <div id="CRUD_Planning_Planning_of_change">
      <?= $this->include("Modal/CRUD_Planning_Planning_of_change"); ?>
    </div>
    <div id="File_Rename_Modal">
      <?= $this->include("Modal/File_Rename_Modal"); ?>
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
    $(document).ready(function() {
      var data = <?php echo json_encode($data); ?>;
      getTableData();
    });
  </script>
  <script>
    function getTableData() {
      // console.log(check, url);
      var data_context = <?php echo json_encode($data); ?>;
      if (data_context.status === '4' || data_context.status === '5') {
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
          'url': "<?php echo site_url('planning/planningofchange/find_data/'); ?>" + data_context.id_version,
          'type': 'GET',
          'dataSrc': 'data',
        },
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": true,
        "drawCallback": function(settings) {
          var daData = settings.json.data;
          $("#isms-policy .overlay").hide();
          if (daData.length == 0) {
            $('#example1 tbody').html(`
            <tr>
              <td colspan="10">
                  <div class="dropdown">
                      <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                          class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false" ${disabledAttribute}></button>
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
              console.table(row);
              var number_index = +meta.settings.oAjaxData.start + 1;
              const encodedRowData = encodeURIComponent(JSON.stringify(row));
              let dropdownHtml = `
            <div class="dropdown">
              <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                  class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                  ${disabledAttribute}></button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" onclick="load_modal(3, '${encodedRowData}')" data-toggle="modal"
                      data-target="#modal-default">Edit</a>
                  <a class="dropdown-item" href="#"
                      onclick="confirm_Alert('You want to copy data ${number_index} ?', 'planning/planningofchange/copydata/${row.id_}/${number_index}')">Copy</a>
                  <a class="dropdown-item" href="#"
                      onclick="confirm_Alert('You want to delete data ${number_index} ?', 'planning/planningofchange/delete/${row.id_}/${row.id_file}/${number_index}')">Delete</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" onclick="load_modal(2)" data-toggle="modal" data-target="#modal-default">Create</a>`;
              if (row.id_file > 0) {
                dropdownHtml += `
              <div class="dropdown-divider"></div>
                <div class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">File</a>
                    <div class="dropdown-menu right-menu-table">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                            onclick="load_modal('4' , '${encodedRowData}')">Rename</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to delete the data file ${number_index} ?', 'planning/planningofchange/delete_file/${row.id_}/${row.id_file}/${number_index}')">Delete
                            File</a>
                    </div>
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
            'render': function(data, type, row, meta) {
              return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function(data, type, row, meta) {
              return '<div style="color: rgba(0, 123, 255, 1);">' + (data.pl_no ?? '-') + '</div>';
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function(data, type, row, meta) {
              return '<div style="color: rgba(0, 123, 255, 1);">' + (data.name_planing_change ?? '-') + '</div>';
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function(data, type, row, meta) {
              return '<div style="color: rgba(0, 123, 255, 1);">' + (data.plan_origin ?? '-') + '</div>';
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function(data, type, row, meta) {
              return '<div style="color: rgba(0, 123, 255, 1);">' + (data.start_date ?? '-') + '</div>';
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function(data, type, row, meta) {
              return '<div style="color: rgba(0, 123, 255, 1);">' + (data.end_date ?? '-') + '</div>';
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function(data, type, row, meta) {
              return '<div style="color: rgba(0, 123, 255, 1);">' + (data.owner ?? '-') + '</div>';
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function(data, type, row, meta) {
              return '<div style="color: rgba(0, 123, 255, 1);">' + (data.evaluation ?? '-') + '</div>';
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function(data, type, row, meta) {
              // console.log(data_context);

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
        ],
      });
      $('[data-toggle="tooltip"]').tooltip();
    }
  </script>
  <script>
    function load_modal(check, data_encode) {
      // console.log(check);
      // console.log(data)
      Requirement_Modal = document.getElementById("Requirement_Modal");
      CRUD_Planning_Planning_of_change = document.getElementById("CRUD_Planning_Planning_of_change");
      File_Rename_Modal = document.getElementById("File_Rename_Modal");
      var element = <?php echo json_encode($data); ?>;

      $(".modal-body #nameplan").val("");
      $(".modal-body #planorigin").val("");
      $(".modal-body #start_date").val("");
      $(".modal-body #end_date").val("");
      $(".modal-body #owner").val("");
      $(".modal-body #evaluation").val("");
      $(".custom-file-input").val('');
      $(".custom-file-label").html('Choose file');


      if (check == '1') {
        //--show modal requirment--//
        Requirement_Modal.style.display = "block";
        CRUD_Planning_Planning_of_change.style.display = "none";
        File_Rename_Modal.style.display = "none";
      } else if (check == '2') {
        //--show modal create--//
        Requirement_Modal.style.display = "none";
        CRUD_Planning_Planning_of_change.style.display = "block";
        File_Rename_Modal.style.display = "none";

        $(".modal-body #url_route").val('planning/planningofchange/store/' + element.id_version);
      } else if (check == '3') {
        //--show modal edit--//
        Requirement_Modal.style.display = "none";
        CRUD_Planning_Planning_of_change.style.display = "block";
        File_Rename_Modal.style.display = "none";
        const rowData = JSON.parse(decodeURIComponent(data_encode));
        $(".modal-body #nameplan").val(rowData.name_planing_change);
        $(".modal-body #planorigin").val(rowData.plan_origin);
        $(".modal-body #start_date").val(rowData.start_date);
        $(".modal-body #end_date").val(rowData.end_date);
        $(".modal-body #owner").val(rowData.owner);
        $(".modal-body #evaluation").val(rowData.evaluation);
        $(".modal-body #url_route").val('planning/planningofchange/edit/' + rowData.id_planning_changes);
      } else if (check == '4') {
        //--show modal Rename File--//
        Requirement_Modal.style.display = "none";
        CRUD_Planning_Planning_of_change.style.display = "none";
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
        beforeSend: function() {
          // Show loading indicator here
          loadingIndicator;
        },
        success: function(response) {
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
        error: function(xhr, status, error) {
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
            beforeSend: function() {
              // Show loading indicator here
              loadingIndicator;
            },
            complete: function() {
              // Hide loading indicator here
              Swal.close();
            }
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