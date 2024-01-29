<title>ISMS Process Version</title>
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
            <h1>Planning of changes
              <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active">ISMS Process</li>
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
                          <span class="text-nowrap"><i class="fas fa-edit" onclick="load_modal(1)"></i>Create File</span>
                        </button>
                      </div>
                    </div>

                    <table id="example1" class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">ACTION</th>
                          <th>No.</th>
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
              <!-- <div class="overlay dark">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="modal fade" id="modal-default">
    <div id="modal_crud_planning_planning_of_change">
      <?= $this->include("Modal/CRUD_Planning_Planning_of_change"); ?>
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
    function load_modal(check, check_type, data_encode) {
      console.log('Function is called with check:', check, 'and check_type:', check_type);

      modal_crud_planning_planning_of_change = document.getElementById("modal_crud_planning_planning_of_change");
      $(".modal-body #iss").empty();

      if (check == '1') {
        //--show modal requirment--//
        console.log('Showing modal 1');
        modal_crud_planning_planning_of_change.style.display = "block";
      }
    }
  </script>
  <script>
    var Data = [{
        "FILE": "fileupload1.pdf",
        "UPLOADDATE": "01/01/2024"
      },
      {
        "FILE": "fileupload2.pdf",
        "UPLOADDATE": "01/01/2024"
      }
    ];

    var example1TableBody = document.getElementById("example1").getElementsByTagName("tbody")[0];

    Data.forEach(function(row, index) {
      var newRow = example1TableBody.insertRow();
      var cell1 = newRow.insertCell(0);
      var cell2 = newRow.insertCell(1);
      var cell3 = newRow.insertCell(2);
      var cell4 = newRow.insertCell(3);

      cell1.innerHTML = `<div class="dropdown">
    <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
      <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(1)"><a class="dropdown-item" href="#" >Edit</a></li>
      <li><a class="dropdown-item" href="#">Copy</a></li>
      <li><a class="dropdown-item" href="#">Delete</a></li>
      <li><hr class="dropdown-divider"></li>
      <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(1)"><a class="dropdown-item">Create</a></li>
    </ul>
  </div>`;
      cell2.textContent = index + 1;
      cell3.textContent = row.FILE;
      cell4.textContent = row.UPLOADDATE;
    });
  </script>