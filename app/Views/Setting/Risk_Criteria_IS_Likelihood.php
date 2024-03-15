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
          <h3>&nbsp;Risk Criteria Information Security</h3>
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
                Likelihood Level
              </h4>
              <!-- <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-likelihood" onclick="load_modal(1)">
        <i class="fas fa-edit"></i>&nbsp;&nbsp;Create Likelihood
      </button> -->

            </div>
            <div class="mt-3">
              <table id="likelihood" class="table table-hover">
                <thead>
                  <tr>
                    <th style="width: 50px;">ACTION</th>
                    <th style="width: 100px;">LIKELIHOOD NAME</th>
                    <th style="width: 50px;">LIKELIHOOD LEVEL</th>
                    <th style="width: 100px;">DESCRIPTION</th>
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
<div class="modal fade" id="modal-likelihood">
  <div id="modal_crud_criteria_likelihood">
    <?= $this->include("Modal/CRUD_Criteria_Context_Likelihood"); ?>
  </div>
</div>
<script>
  function load_modal(check, check_type, data_encode) {
    console.log('Function is called with check:', check, 'and check_type:', check_type);

    modal_likelihood = document.getElementById("modal-likelihood");
    $(".modal-body #iss").empty();

    if (check == '1') {
      //--show modal requirment--//
      console.log('Showing modal 1');
      modal_likelihood.style.display = "block";
    }
  }
</script>
<script>
  var Data = [{
      "LIKELIHOODNAME": "น้อยมาก",
      "LIKELIHOODLEVEL": 1,
      "DESCRIPTION": "แทบจะไม่เกิดหรืออย่างมากปีละ 1 ครั้ง",
    },
    {
      "LIKELIHOODNAME": "น้อย",
      "LIKELIHOODLEVEL": 2,
      "DESCRIPTION": "โอกาสเกิดน้อยหรืออย่างมากไม่เกินปีละ 2 ครั้ง",
    },
    {
      "LIKELIHOODNAME": "ปานกลาง",
      "LIKELIHOODLEVEL": 3,
      "DESCRIPTION": "ปานกลาง ปีละ 3-5 ครั้ง",
    },
    {
      "LIKELIHOODNAME": "สูง",
      "LIKELIHOODLEVEL": 4,
      "DESCRIPTION": "ค่อนข้างบ่อย ปีละ 6-10 ครั้ง",
    },
    {
      "LIKELIHOODNAME": "สูงมาก",
      "LIKELIHOODLEVEL": 5,
      "DESCRIPTION": "บ่อยครั้ง ปีละ 11-15 ครั้ง",
    },
  ];

  var likelihoodTableBody = document.getElementById("likelihood").getElementsByTagName("tbody")[0];

  Data.forEach(function(row, index) {
    var newRow = likelihoodTableBody.insertRow();
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);
    var cell4 = newRow.insertCell(3);

    cell1.innerHTML = `<div class="dropdown">
                          <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
                                  <li data-toggle="modal" data-target="#modal-likelihood" onclick="load_modal(1)"><a class="dropdown-item" href="#" >Edit</a></li>
                              </ul>
                      </div>`;
    cell2.textContent = row.LIKELIHOODNAME;
    cell3.textContent = row.LIKELIHOODLEVEL;
    cell4.textContent = row.DESCRIPTION;
  });
</script>