<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $header ?>
  </title>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css'); ?>">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300,400,400i,700&display=swap">

</head>
<style>
  .modal .modal-content .modal-footer {
    font-family: 'Kanit', sans-serif;
  }

  tr:nth-child(even) {
    background-color: #F5F5F5;
  }

  th {
    background-color: #F5F6FA;
    text-align: center;
    border-bottom: none;
  }

  tbody {
    border-bottom: 1px solid #ccc;
    text-align: center;
  }

  .table thead th {
    border-bottom: none;
  }

  .badge-edit {
    font-size: 100%;
  }

  .modal-footer {
    justify-content: space-evenly;
  }

  .gray-text {
    color: #adb5bd;
  }
</style>

<body class="hold-transition sidebar-mini">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <?= $header ?>
              <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default"
                id="load-modal-button" onclick="load_modal(1)">Requirement</button>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">
                <?= $header ?>
              </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card" id="all_version">
              <div class="card-header">
                <h3 class="card-title">All version</h3>
              </div>
              <div class="card-body">
                <table id="datatable" class="table table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">ACTION</th>
                      <th class="text-center">VERSION</th>
                      <th class="text-center">MODIFIED DATE</th>
                      <th class="text-center">LAST REVIEWED</th>
                      <th class="text-center">APPROVED DATE</th>
                      <th class="text-center">STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="overlay dark">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
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
  <!-- Page specific script -->

  <script>
    $(document).ready(function () {
      var type = <?php echo json_encode($type); ?>;
      var daData = null;
      $('#datatable').DataTable({
        "processing": $("#all_version .overlay").show(),
        "pageLength": 10,
        "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
        'serverSide': true,
        'ajax': {
          'url': "<?php echo site_url('context/getAllcontexts/'); ?>" + type,
          'type': 'GET',
          'dataSrc': 'data',
        },
        'columns': [{
          'data': null,
          'render': function (data, type, row, meta) {
            const encodedRowData = encodeURIComponent(JSON.stringify(row));
            var api = new $.fn.dataTable.Api(meta.settings);
            var totalRows = api.rows().count();
            var number_index = +meta.settings.oAjaxData.start + 1;
            if (totalRows == meta.settings.json.data.length) {
              // แสดงปุ่ม "Create" เฉพาะข้อมูลลำดับสุดท้าย
              return `
              <div class="btn-group">
                  <i class="fas fa-ellipsis-h fa-rotate-90" style="color: #007bff;" type="button"
                      class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?= site_url($url) ?>${row.id_version}/${number_index}">Open</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                          onclick="load_modal(2, '${encodedRowData}')">Version Control</a>
                      <a class="dropdown-item" href="#" onclick="Action_Alert('copydata/${row.id_version}')">Copy</a>
                      <a class="dropdown-item" href="#"
                          onclick="confirmDelete('delete/${row.id_version}', ${number_index})">Delete</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" onclick="Action_Alert('version/create/${row.type_version}/1')">Create</a>
                  </div>
              </div>`;
            } else {
              // ซ่อนปุ่ม "Create" ในข้อมูลอื่นๆ
              return `
              <div class="btn-group">
                  <i class="fas fa-ellipsis-h fa-rotate-90" style="color: #007bff;" type="button"
                      class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?= site_url($url) ?>${row.id_version}/${number_index}">Open</a>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                          onclick="load_modal(2, '${encodedRowData}')">Version Control</a>
                      <a class="dropdown-item" href="#" onclick="Action_Alert('copydata/${row.id_version}')">Copy</a>
                      <a class="dropdown-item" href="#"
                          onclick="confirmDelete('delete/${row.id_version}', ${number_index})">Delete</a>
                  </div>
              </div>
                `;
            }
          }
        },
        {
          'data': null,
          'render': function (data, type, row, meta) {
            return meta.settings.oAjaxData.start += 1;
          }
        },
        {
          'data': 'modified_date'
        },
        {
          'data': 'review_date'
        },
        {
          'data': 'approved_date'
        },
        {
          'data': null,
          'render': function (data, type, row) {
            var status = row.status;
            if (status == 0) {
              return `<span class='badge bg-secondary'>Draft</span>`;
            } else if (status == 1) {
              return `<span class='badge bg-info'>Pending Review</span>`;
            } else if (status == 2) {
              return `<span class='badge bg-warning'>Review</span>`;
            } else if (status == 3) {
              return `<span class='badge bg-info'>Pending Approved</span>`;
            } else if (status == 4) {
              return `<span class='badge bg-success'>Approved</span>`;
            } else if (status == 5) {
              return `<span class='badge bg-danger'>Reject_Review</span>`;
            } else if (status == 6) {
              return `<span class='badge bg-danger'>Reject_Approved</span>`;
            } else {
              return status;
            }
          }
        }
        ],
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "drawCallback": function (settings) {
          $("#all_version .overlay").hide();

          daData = settings.json.data;
          if (daData.length === 0) {
            $('#datatable tbody').html(`
            <tr>
                <td colspan="1">
                    <div class="dropdown">
                        <i class="fas fa-ellipsis-h fa-rotate-90" style="color: #007bff;" type="button"
                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"></i>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onclick="Action_Alert('version/create/${type}/1')">Create</a>
                        </div>
                    </div>
                </td>
                <td colspan="5">
                  </td>
            </tr>
            `);
          }
        }
      });
    });
  </script>
  <script>
    function confirmDelete(url, id) {
      Swal.fire({
        title: 'ยืนยันต้องการจะลบข้อมูลที่ No. ' + id + ' หรือไม่',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#C4C3C3',
        confirmButtonText: 'Confirm',
      }).then((result) => {
        if (result.isConfirmed) {
          Action_Alert(url);
        }
      })
    }
  </script>
  <script>
    function Action_Alert(url_link) {
      var url1 = "";

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

      $.ajax({
        url: '<?= base_url("context/") ?>' + url_link,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        },
        beforeSend: function () {
          // Show loading indicator here
          loadingIndicator;
        },
      }).done(function (response) {
        if (response.success) {
          Swal.fire({
            title: response.message,
            icon: 'success',
            showConfirmButton: false
          });

          setTimeout(() => {
            if (response.reload) {
              window.location.reload();
            } else {
              window.location.href = '<?= site_url($url) ?>' + response.id_version + '/' + response.num_ver;
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

  </script>
  <script>
    function load_modal(params, data) {

      modal1 = document.getElementById("modal1");
      modal2 = document.getElementById("modal2");

      if (params == '1') {
        //--show modal requirment--//
        modal1.style.display = "block";
        modal2.style.display = "none";
      } else if (params == '2') {
        modal1.style.display = "none";
        modal2.style.display = "block";

        const element = JSON.parse(decodeURIComponent(data));

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
      }
    }
  </script>