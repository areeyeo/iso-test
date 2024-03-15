<title>Risk Criteria Context</title>
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
                Likelihood Level
              </h4>
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
                  <?php foreach ($Likelihood_level_context as $index => $item): ?>
                    <tr>
                      <td>
                        <div class="dropdown">
                          <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}"
                            data-toggle="dropdown" aria-expanded="false"></i>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
                            <li data-toggle="modal" data-target="#modal-likelihood"
                              onclick="load_modal(1, <?= $index ?>)"><a class="dropdown-item">Edit</a></li>
                          </ul>
                        </div>
                      </td>
                      <td class="blue-text">
                        <?php echo $item['likelihood_name']; ?>
                      </td>
                      <td class="blue-text">
                        <?php echo $item['likelihood_level']; ?>
                      </td>
                      <td class="blue-text">
                        <?php echo $item['description']; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
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

    modal_likelihood = document.getElementById("modal-likelihood");

    if (check == '1') {
      //--show modal edit Likelihood --//
      var element = <?php echo json_encode($Likelihood_level_context); ?>;
      modal_likelihood.style.display = "block";
      $(".modal-body #likelihoodname").val(element[check_type]['likelihood_name']);
      $(".modal-body #likelihoodlevel").val(element[check_type]['likelihood_level']);
      $(".modal-body #description").val(element[check_type]['description']);
      $(".modal-body #url_route").val('planning/risk_Criteria_Context_Likelihood/edit/' + element[check_type]['id_likelihood_level_context']);
    }
  }
</script>
<script>
  function action_(url, form) {
    if (form != null) {
      var formData = new FormData(document.getElementById(form));
    }
    $.ajax({
      url: '<?= base_url() ?>' + url,
      type: "POST",
      cache: false,
      data: formData,
      processData: false,
      contentType: false,
      dataType: "JSON",
      beforeSend: function () {
        Swal.fire({
          title: 'Loading...',
          allowEscapeKey: false,
          allowOutsideClick: false,
          showConfirmButton: false,
          onOpen: () => {
            Swal.showLoading();
          }
        });
      },
      success: function (response) {
        console.log(response);
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
      error: function (xhr, status, error) {
        Swal.fire({
          title: "เกิดข้อผิดพลาด",
          icon: 'error',
          showConfirmButton: true
        });
      }
    });
  }
</script>