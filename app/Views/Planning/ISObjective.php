<title>IS Objectives Version
  <?= $data['num_ver'] ?>
</title>
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
            <h1>IS Objectives
              <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a>IS Objectives</a></li>
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
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Details</h2>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <?php if ($data['status'] == 4 || $data['status'] == 5) {
                    $disabled = '';
                  } else {
                    $disabled = '';
                  } ?>
                  <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a href="<?= site_url('context/context_analysis/index/' . $data['type_version']); ?>" style="color: #ADB5BD;">Version</a></button>
                  <button class="badge badge-edit <?= $disabled ?>" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a href="<?= site_url('planning/isobjective/timeline_log/' . $data['id_version'] . '/' . $data['type_version'] . '/' . $data['num_ver']); ?>" style="color: #ADB5BD;">History</a></button>
                  <button class="badge badge-edit" style="background-color: #007BFF; color: #ffffff; border: 1px solid #007BFF" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-submenu">
                      <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                      <div class="dropdown-menu">
                        <!-- Second-level dropdown items -->
                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Reviewed หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/1')">Pending
                          Review</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Review หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/2')">Review</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(3 ,5)">Reject Review</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Approve หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/3')">Pending
                          Approve</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Approved หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/4')">Approved</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(3 ,6)">Reject Approved</a>
                      </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-submenu">
                      <a class="dropdown-item dropdown-toggle" href="#">Update</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item">Update review date</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">Revise</a>
                      </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-default" href="#" onclick="load_modal(4)">Create Note</a>
                  </div>
                  <i class="fas fa-cog" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(2)"></i>
                  <!-- show version Control -->
                </div>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                  <div class="row justify-content-center mb-2">
                    <div class="col-sm-3 ">
                      <h6>Version: <span class="blue-text">
                          <?= $data['num_ver'] ?>
                        </span></h6>
                    </div>
                    <div class="col-sm-3 ">
                      <h6>Status:
                        <?php
                        if ($data['status'] == 0) {
                          echo "<span class='badge bg-secondary'>Draft</span>";
                        } else if ($data['status'] == 1) {
                          echo "<span class='badge bg-info'>Pending Review</span>";
                        } else if ($data['status'] == 2) {
                          echo "<span class='badge bg-warning'>Review</span>";
                        } else if ($data['status'] == 3) {
                          echo "<span class='badge bg-info'>Pending Approved</span>";
                        } else if ($data['status'] == 4) {
                          echo "<span class='badge bg-success'>Approved</span>";
                        } else if ($data['status'] == 5) {
                          echo "<span class='badge bg-danger'>Reject_Review</span>";
                        } else if ($data['status'] == 6) {
                          echo "<span class='badge bg-danger'>Reject_Approved</span>";
                        }
                        ?>
                      </h6>
                    </div>
                    <div class="col-sm-3 ">
                      <h6>Approved Date: <span class="gray-text">
                          <?php echo $data['approved_date']; ?>
                        </span></h6>
                    </div>
                  </div>
                  <div class="row justify-content-center mb-2">
                    <div class="col-sm-3 ">
                      <h6>Modified Date: <span class="gray-text">
                          <?php echo $data['modified_date']; ?>
                        </span></h6>
                    </div>
                    <div class="col-sm-3 ">
                      <h6>Last Reviewed: <span class="gray-text">
                          <?php echo $data['review_date']; ?>
                        </span></h6>
                    </div>
                    <div class="col-sm-3 ">
                      <h6>Announce Date: <span class="gray-text">
                          <?php echo $data['announce_date']; ?>
                        </span></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card" id="context-ana">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div>
                    <div class="form-group">
                      <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                        <li class="nav-item-tab" style="padding-right: 10px;">
                          <a class="nav-link active" id="Objectives-tab" data-toggle="pill" href="#Objectives" role="tab" aria-controls="Objectives" aria-selected="true">Objectives</a>
                        </li>
                        <li class="nav-item-tab">
                          <a class="nav-link" id="Planning-tab" data-toggle="pill" href="#Planning" role="tab" aria-controls="Planning" aria-selected="false" onclick="getTableData2();">Planning</a>
                        </li>
                        <li class="nav-item-tab">
                          <a class="nav-link" id="Summary-tab" data-toggle="pill" href="#Summary" role="tab" aria-controls="Summary" aria-selected="false" onclick="getTableData3();">Summary</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="d-flex">
                    <div id="btn-Objectives" name="btn-Objectives">
                      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-default " onclick="load_modal(5,1)">
                        <span class="text-nowrap"><i class="fas fa-edit"></i>Create Objectives</span>
                      </button>
                    </div>
                    <div id="btn-Planning" name="btn-Planning">
                      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-default" onclick="load_modal(6,1)">
                        <span class="text-nowrap"><i class="fas fa-edit"></i>Create Planning</span>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="Objectives" role="tabpanel" aria-labelledby="org-strategy-tab">
                    <table id="example1" class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">ACTION</th>
                          <th>No.</th>
                          <th>OBJ NO.</th>
                          <th>OBJECTIVES</th>
                          <th>EVALUATION</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade show" id="Planning" role="tabpanel" aria-labelledby="Planning-tab">
                    <table id="example2" class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">ACTION</th>
                          <th>No.</th>
                          <th>OBJ NO.</th>
                          <th>OBJECTIVES</th>
                          <th>EVALUATION</th>
                          <th>PLANNING</th>
                          <th>START DATE</th>
                          <th>END DATE</th>
                          <th>OWNER</th>
                          <th>DATE EVALUATION</th>
                          <th>EVALUATION METHODS</th>
                          <th>FILE</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade show" id="Summary" role="tabpanel" aria-labelledby="Summary-tab">
                    <table id="example3" class="table table-hover">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>OBJ NO.</th>
                          <th>OBJECTIVES</th>
                          <th>EVALUATION</th>
                          <th>PLANNING</th>
                          <th>START DATE</th>
                          <th>END DATE</th>
                          <th>OWNER</th>
                          <th>DATE EVALUATION</th>
                          <th>EVALUATION METHODS</th>
                          <th>FILE</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="overlay dark">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="modal-default">
    <div id="modal_requirement">
      <?= $this->include("Modal/Requirement_Modal"); ?>
    </div>
    <div id="modal_contextver">
      <?= $this->include("Modal/Context_Ver"); ?>
    </div>
    <div id="modal_reject">
      <?= $this->include("Modal/Reject_Modal"); ?>
    </div>
    <div id="modal_crud_note">
      <?= $this->include("Modal/CRUD_Note"); ?>
    </div>
    <div id="modal_crud_planning_is_objectives">
      <?= $this->include("Modal/CRUD_Planning_IS_Objectives"); ?>
    </div>
    <div id="modal_crud_planning_is_planning">
      <?= $this->include("Modal/CRUD_Planning_IS_Planning"); ?>
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
    $('#btn-Planning').hide();
  </script>
  <script>
    function load_modal(check, check_type, data_encode) {
      modal_requirement = document.getElementById("modal_requirement");
      modal_contextver = document.getElementById("modal_contextver");
      modal_crud_planning_is_objectives = document.getElementById("modal_crud_planning_is_objectives");
      modal_crud_planning_is_planning = document.getElementById("modal_crud_planning_is_planning");
      modal_reject = document.getElementById("modal_reject");
      modal_crud_note = document.getElementById("modal_crud_note");

      var element = <?php echo json_encode($data); ?>; //data version control
      var select_objective = <?php echo json_encode($objective); ?>;

      if (check == '1') {
        //--show modal requirment--//
        modal_requirement.style.display = "block";
        modal_contextver.style.display = "none";
        modal_reject.style.display = "none";
        modal_crud_note.style.display = "none";
        modal_crud_planning_is_objectives.style.display = "none";
        modal_crud_planning_is_planning.style.display = "none";
      } else if (check == '2') {
        //--show modal Version Control--//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "block";
        modal_reject.style.display = "none";
        modal_crud_note.style.display = "none";
        modal_crud_planning_is_objectives.style.display = "none";
        modal_crud_planning_is_planning.style.display = "none";

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
      } else if (check == '3') {
        //--show modal Reject --//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_reject.style.display = "block";
        modal_crud_note.style.display = "none";
        modal_crud_planning_is_objectives.style.display = "none";
        modal_crud_planning_is_planning.style.display = "none";

        $(".modal-body #status").val(check_type);
        $(".modal-body #modified_date").val(element.modified_date);
      } else if (check == '4') {
        //--show modal Crate Note --//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_reject.style.display = "none";
        modal_crud_note.style.display = "block";
        modal_crud_planning_is_objectives.style.display = "none";
        modal_crud_planning_is_planning.style.display = "none";

        $(".modal-body #modified").val(element.modified_date);
        $(".modal-body #check").val(10);
        $(".modal-body #params").val(10);
      } else if (check == '5') {
        //-- planning_is_objectives  --//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_reject.style.display = "none";
        modal_crud_note.style.display = "none";
        modal_crud_planning_is_objectives.style.display = "block";
        modal_crud_planning_is_planning.style.display = "none";
        if (check_type == 1) {
          //-- planning_is_objectives create --//
          $(".modal-body #objective").val("");
          $(".modal-body #evaluation").val("");
          $(".modal-body #url_route").val("planning/isobjective/create/" + element.id_version + "/" + element.status);
        } else {
          //-- planning_is_objectives edit --//
          const rowData = JSON.parse(decodeURIComponent(data_encode));
          $(".modal-body #objective").val(rowData.objective);
          $(".modal-body #evaluation").val(rowData.evaluation);
          $(".modal-body #url_route").val("planning/isobjective/edit/" + rowData.id_objective + "/" + element.id_version + "/" + element.status);
        }
      } else if (check == '6') {
        //-- planning_is_planning --//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_reject.style.display = "none";
        modal_crud_note.style.display = "none";
        modal_crud_planning_is_objectives.style.display = "none";
        modal_crud_planning_is_planning.style.display = "block";
        $(".modal-body #project_name").val("");
        $(".modal-body #start_date").val("");
        $(".modal-body #end_date").val("");
        $(".modal-body #owner").val("");
        $(".modal-body #date_of_evaluation").val("");
        $(".modal-body #evaluation_methods").val("");
        $(".modal-body #objective_evaluation").empty();
        $(".modal-body #evaluation_detail").val("");
        if (select_objective.length == 0) {
          //-- ถ้าไม่มีข้อมูล objective --//
          var newOption = $('<option>').val(0).text("ไม่มีข้อมูล");
          $(".modal-body #objective_evaluation").append(newOption);
          $(".modal-content #evaluation_detail").text("ไม่มีข้อมูล");
        } else {
          if (check_type == 1) {
            //-- planning_is_planning create --//
            select_objective.forEach(element_objective => {
              var newOption = $('<option>').val(element_objective.id_objective).text(element_objective.objective);
              $(".modal-body #objective_evaluation").append(newOption);
            })
            $(".modal-content #evaluation_detail").text(select_objective[0]['evaluation']);
            $(".modal-body #url_route").val("planning/planning/create/" + element.id_version + "/" + element.status);
          } else {
            //-- planning_is_planning edit --//
            const rowData = JSON.parse(decodeURIComponent(data_encode));
            select_objective.forEach(element_objective => {
              var newOption = $('<option></option>').val(element_objective.id_objective).text(element_objective.objective);
              if (element_objective.id_objective == rowData.id_objective) {
                $(".modal-body #objective_evaluation").append(newOption.prop('selected', true));
                $(".modal-body #evaluation_detail").text(element_objective.evaluation);
              } else {
                $(".modal-body #objective_evaluation").append(newOption);
              }
            });
            $(".modal-body #project_name").val(rowData.planning);
            $(".modal-body #start_date").val(rowData.start_date);
            $(".modal-body #end_date").val(rowData.end_date);
            $(".modal-body #owner").val(rowData.owner);
            $(".modal-body #date_of_evaluation").val(rowData.date_evaluation);
            $(".modal-body #evaluation_methods").val(rowData.evaluation_methods);
            $(".modal-body #url_route").val("planning/planning/edit/" + rowData.id_planning + "/" + element.id_version + "/" + element.status);
          }
        }
      }
    }
  </script>
  <script>
    $('#Objectives-tab').on('click', function() {
      // console.log('Objectives-tab');
      $('#btn-Objectives').show();
      $('#btn-Planning').hide();
    });
    $('#Planning-tab').on('click', function() {
      // console.log('Planning-tab');
      $('#btn-Objectives').hide();
      $('#btn-Planning').show();
    })
    $('#Summary-tab').on('click', function() {
      // console.log('Summary-tab');
      $('#btn-Objectives').hide();
      $('#btn-Planning').hide();
    })
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
                  if (response.newCopy) {
                    window.location.href = '<?= site_url("planning/isobjective/index/") ?>' + response.id_version + '/' + response.num_ver;
                  } else {
                    window.location.reload();
                  }
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
  <script>
    $(document).ready(function() {
      getTableData1();
      getTableData3();
    })
  </script>
  <script>
    var countTable1 = 0;

    function getTableData1() {

      if (countTable1 === 0) {
        countTable1++;
        var data_version = <?php echo json_encode($data); ?>;
        if (data_version.status === '4' || data_version.status === '5') {
          var disabledAttribute = 'disabled';
        }
        if ($.fn.DataTable.isDataTable('#example1')) {
          $('#example1').DataTable().destroy();
        }
        $('#example1').DataTable({
          "processing": $("#example1 .overlay").show(),
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('planning/isobjective/getdata/'); ?>" + data_version.id_version,
            'type': 'GET',
            'dataSrc': 'data',
          },
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "searching": true,
          "ordering": false,
          "drawCallback": function(settings) {
            $("#example1 .overlay").hide();
            var daData = settings.json.data;
            if (daData.length == 0) {
              $('#example1 tbody').html(`
              <tr>
                  <td colspan="5">
                      <div class="dropdown">
                          <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                              class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" ${disabledAttribute}></button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" onclick="load_modal(5,1)" data-toggle="modal"
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
                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        ${disabledAttribute}></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" onclick="load_modal(5, 2,'${encodedRowData}')" data-toggle="modal"
                            data-target="#modal-default">Edit</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to copy data ${number_index} ?', 'planning/isobjective/copydata/${data.id_objective}/${number_index}/${data_version.id_version}/${data_version.status}')">Copy</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'planning/isobjective/delete/${data.id_objective}/${number_index}/${data_version.id_version}/${data_version.status}')">Delete</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="load_modal(5,1)" data-toggle="modal" data-target="#modal-default">Create</a>`;
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
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.obj_no) + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.objective) + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.evaluation) + '</div>';
              }
            },
          ],
        });
        $('[data-toggle="tooltip"]').tooltip();
      }
    }
  </script>
  <script>
    var countTable2 = 0;

    function getTableData2() {
      if (countTable2 === 0) {
        countTable2++;
        var data_version = <?php echo json_encode($data); ?>;
        if (data_version.status === '4' || data_version.status === '5') {
          var disabledAttribute = 'disabled';
        }
        if ($.fn.DataTable.isDataTable('#example2')) {
          $('#example2').DataTable().destroy();
        }
        $('#example2').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('planning/planning/getdata/'); ?>" + data_version.id_version,
            'type': 'GET',
            'dataSrc': 'data',
          },
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "searching": true,
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
                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        ${disabledAttribute}></button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" onclick="load_modal(6, 2,'${encodedRowData}')" data-toggle="modal"
                            data-target="#modal-default">Edit</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to copy data ${number_index} ?', 'planning/planning/copydata/${data.id_planning}/${number_index}/${data_version.id_version}/${data_version.status}')">Copy</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'planning/planning/delete/${data.id_planning}/${data.file}/${number_index}/${data_version.id_version}/${data_version.status}')">Delete</a>
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
                var objective = <?php echo json_encode($objective); ?>;
                let matobjective = objective.find(element_objective => element_objective.id_objective === data.id_objective);
                return '<div style="color: rgba(0, 123, 255, 1);">' + (matobjective.obj_no ?? '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                var objective = <?php echo json_encode($objective); ?>;
                let matobjective = objective.find(element_objective => element_objective.id_objective === data.id_objective);
                return '<div style="color: rgba(0, 123, 255, 1);">' + (matobjective.objective ?? '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                var objective = <?php echo json_encode($objective); ?>;
                let matobjective = objective.find(element_objective => element_objective.id_objective === data.id_objective);
                return '<div style="color: rgba(0, 123, 255, 1);">' + (matobjective.evaluation ?? '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.planning !== null ? (data.planning !== '' ? data.planning : '-') : '-') + '</div>';
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
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.owner !== null ? (data.owner !== '' ? data.owner : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.date_evaluation !== null ? (data.date_evaluation !== '' ? data.date_evaluation : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.evaluation_methods !== null ? (data.evaluation_methods !== '' ? data.evaluation_methods : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                if (row.file > 0) {
                  var number_index = +meta.settings.oAjaxData.start;
                  return `<a href="<?php echo base_url('openfile/'); ?>${row.file}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">
                  ${row.file_data.name_file}
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
    }
  </script>
  <script>
    var countTable3 = 0;

    function getTableData3() {

      if (countTable3 === 0) {
        countTable3++;
        var data_version = <?php echo json_encode($data); ?>;
        if (data_version.status === '4' || data_version.status === '5') {
          var disabledAttribute = 'disabled';
        }
        if ($.fn.DataTable.isDataTable('#example3')) {
          $('#example3').DataTable().destroy();
        }
        $('#example3').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('planning/summary/getdata/'); ?>" + data_version.id_version,
            'type': 'GET',
            'dataSrc': 'data',
          },
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "searching": true,
          "ordering": false,
          "drawCallback": function(settings) {
            $("#interested_table .overlay").hide();
            var daData = settings.json.data;
            var count_ = 0;
            if (daData.length == 0) {
              $('#example3 tbody').html(`
              <tr>
                  <td colspan="8">
                    <p class="text-center">No data available in table</p>
                  </td>
              </tr>`);
            } else {
              // Use append() to add new rows to the existing content
              $('#example3 tbody').empty(); // Clear existing content before appending new rows
              daData.forEach(element => {
                count_++;
                var table = `
                <tr>
                  <td style="color: #007bff">${count_}</td>
                  <td style="color: #007bff">${element.obj_no}</td>
                  <td style="color: #007bff">${element.objective}</td>
                  <td style="color: #007bff">${element.evaluation}</td>`;
                var check_round = 0;
                element.data_planning.forEach(element_planning => {
                  // Concatenate the HTML string for each planning data
                  if (check_round > 0) {
                    table += `
                    <td colspan="4"></td>
                    <td style="color: #007bff">${element_planning.planning !== '' ? element_planning.planning : '-'}</td>
                    `;
                  } else {
                    check_round++;
                    table += `<td style="color: #007bff">${element_planning.planning !== '' ? element_planning.planning : '-'}</td>`;
                  }
                  table += `<td style="color: #007bff">${element_planning.start_date !== '' ? element_planning.start_date : '-'}</td>`;
                  table += `<td style="color: #007bff">${element_planning.end_date !== '' ? element_planning.end_date : '-'}</td>`;
                  table += `<td style="color: #007bff">${element_planning.owner !== '' ? element_planning.owner : '-'}</td>`;
                  table += `<td style="color: #007bff">${element_planning.date_evaluation !== '' ? element_planning.date_evaluation : '-'}</td>`;
                  table += `<td style="color: #007bff">${element_planning.evaluation_methods !== '' ? element_planning.evaluation_methods : '-'}</td>`;
                  if (element_planning.file_data == null) {
                    table += `<td style="color: #007bff">No File</td>`;
                  } else {
                    table += `<td style="color: #007bff"><a href="<?php echo base_url('openfile/'); ?>${element_planning.file_data.id_files}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">${element_planning.file_data.name_file}</a></td>`;
                  }
                  table += `</tr>`;
                });
                // Append the row to the table
                $('#example3 tbody').append(table);
              });
            }
          },
          "columns": [{
            "data": null
          }]
        });
        $('[data-toggle="tooltip"]').tooltip();
      }
    }
  </script>