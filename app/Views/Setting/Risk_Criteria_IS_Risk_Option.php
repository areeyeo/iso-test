<title>Risk Criteria Information Security</title>
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
  tr:nth-child(even) {
    background-color: #F5F5F5;
  }

  th {
    background-color: #F5F6FA;
    text-align: center;
    border-bottom: none;
  }

  tbody {
    /* border-bottom: 10px solid #ccc; */
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

  .btn {
    font-size: 10pt;
    text-align: left;
  }

  .nav-link.active {
    background-color: #E2F0FF;
    color: #007BFF;
    border-radius: 4px;
  }
</style>
<body class="hold-transition sidebar-mini">
  <div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="">
          <h3>&nbsp;Risk Criteria Context</h3>
        </div>
      </div>
    </section>
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h4>
                Risk Options
              </h4>
              <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-risk-option" onclick="load_modal(1)">
                <i class="fas fa-plus"></i>&nbsp;&nbsp;Risk Options
              </button>
            </div>
            <div class="mt-3">
              <table id="example3" class="table table-hover">
                <thead>
                  <tr>
                    <th>ACTION</th>
                    <th>OPTION</th>
                    <th>DESCRIPTION</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
<div class="modal fade" id="modal-risk-option">
  <div id="modal_crud_criteria_risk_option">
    <?= $this->include("Modal/CRUD_Criteria_Context_Risk_Option"); ?>
  </div>
</div>
<script>
  function load_modal(check, check_type, data_encode) {
    console.log('Function is called with check:', check, 'and check_type:', check_type);

    modal_crud_criteria_risk_option = document.getElementById("modal_crud_criteria_risk_option");
    $(".modal-body #iss").empty();

    if (check == '1') {
      //--show modal requirment--//
      console.log('Showing modal 1');;
      modal_crud_criteria_risk_option.style.display = "block";
    }
  }
</script>
<script>
  var DataSummary = [{
      "OPTION": "Risk Treatment",
      "DESCRIPTION": "การรักษาความเสี่ยง",
    },
    {
      "OPTION": "Risk Modification",
      "DESCRIPTION": "การปรับเปลี่ยนความเสี่ยง",
    },
    {
      "OPTION": "Risk Avoidance",
      "DESCRIPTION": "การหลีกเลี่ยงความเสี่ยง",
    },
    {
      "OPTION": "Risk Sharing",
      "DESCRIPTION": "การแบ่งปันความเสี่ยง",
    },
    {
      "OPTION": "Risk Acceptance",
      "DESCRIPTION": "การยอมรับความเสี่ยง",
    },
  ];

  var example3TableBody = document.getElementById("example3").getElementsByTagName("tbody")[0];

  DataSummary.forEach(function(row, index) {
    var newRow = example3TableBody.insertRow();
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);

    cell1.innerHTML = `<div class="dropdown">
                          <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
                                  <li data-toggle="modal" data-target="#modal-risk-option" onclick="load_modal(1)"><a class="dropdown-item" href="#" >Edit</a></li>
                                  <li><a class="dropdown-item" href="#">Delete</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li data-toggle="modal" data-target="#modal-risk-option" onclick="load_modal(1)"><a class="dropdown-item">Create</a></li>
                              </ul>
                      </div>`;
    cell2.textContent = row.OPTION;
    cell3.textContent = row.DESCRIPTION;
  });
</script>