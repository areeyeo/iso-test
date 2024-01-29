<title>Context Analysis Version
  <?= $data['num_ver'] ?>
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
            <h1>Context Analysis
              <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default"
                id="load-modal-button" onclick="load_modal(1)">Requirement</button>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= site_url('context/context_analysis/index/1'); ?>">Context
                  Analysis</a></li>
              <li class="breadcrumb-item active">Version
                <?php echo $data['num_ver']; ?>
              </li>
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
                  <button class="badge badge-edit <?= $disabled ?>"
                    style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a
                      href="<?= site_url('context/context_analysis/index/' . $data['type_version']); ?>"
                      style="color: #ADB5BD;">Version</a></button>
                  <button class="badge badge-edit <?= $disabled ?>"
                    style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a
                      href="<?= site_url('context/context_analysis/timeline_log/' . $data['id_version'] . '/' . $data['type_version'] . '/' . $data['num_ver']); ?>"
                      style="color: #ADB5BD;">History</a></button>
                  <button class="badge badge-edit"
                    style="background-color: #007BFF; color: #ffffff; border: 1px solid #007BFF" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-submenu">
                      <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                      <div class="dropdown-menu">
                        <!-- Second-level dropdown items -->
                        <a class="dropdown-item" href="#"
                          onclick="confirm_Alert('ต้องการที่จะ Pending Reviewed หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/1')">Pending
                          Review</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#"
                          onclick="confirm_Alert('ต้องการที่จะ Review หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/2')">Review</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                          id="load-modal-button" onclick="load_modal(7,5)">Reject Review</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                          onclick="confirm_Alert('ต้องการที่จะ Pending Approve หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/3')">Pending
                          Approve</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#"
                          onclick="confirm_Alert('ต้องการที่จะ Approved หรือไม่', 'context/status_update/<?= $data['id_version'] ?>/4')">Approved</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                          id="load-modal-button" onclick="load_modal(7,6)">Reject
                          Approved</a>
                      </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-submenu">
                      <a class="dropdown-item dropdown-toggle" href="#">Update</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"
                          onclick="confirm_Alert('Would you like to confirm the update review date?', 'context/update_date/<?= $data['id_version'] ?>/1')">Update
                          review date</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"
                          onclick="confirm_Alert('ต้องการที่จะ Copy ข้อมูลหรือไม่', 'context/copydata/<?= $data['id_version'] ?>')">Revise</a>
                      </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#modal-default" id="load-modal-button"
                      href="#" onclick="load_modal(5)">Create Note</a>
                  </div>

                  <i class="fas fa-cog" data-toggle="modal" data-target="#modal-default" id="load-modal-button"
                    onclick="load_modal(2)"></i>
                </div>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                  <div class="row justify-content-center mb-2">
                    <div class="col-sm-3 ">
                      <h6>Version: <span class="blue-text">
                          <?php echo $data['num_ver']; ?>
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
                <div class="row">
                  <div class="col-sm-10">
                    <div class="form-group">
                      <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                        <li class="nav-item-tab" style="padding-right: 10px;">
                          <a class="nav-link active" id="internal-tab" data-toggle="pill" href="#internal" role="tab"
                            aria-controls="internal" aria-selected="true">Internal
                            Issues</a>
                        </li>
                        <li class="nav-item-tab">
                          <a class="nav-link" id="external-tab" data-toggle="pill" href="#external" role="tab"
                            aria-controls="external" aria-selected="false" onclick="getTableData2();">External
                            Issues</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-sm-2 text-right " id="btn-internal" name="btn-internal">
                    <button type="button" class="btn btn-outline-primary" onclick="load_modal(3,1)" data-toggle="modal"
                      data-target="#modal-default">
                      <span class="text-nowrap"><i class="fas fa-edit"></i>Create Internal Issue</span>
                    </button>
                  </div>
                  <div class="col-sm-2 text-right" id="btn-external" name="btn-internal">
                    <button type="button" class="btn btn-outline-primary" onclick="load_modal(3,2)" data-toggle="modal"
                      data-target="#modal-default">
                      <span class="text-nowrap"><i class="fas fa-edit"></i>Create External Issue</span>
                  </div>
                </div>
                <hr>
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="internal" role="tabpanel"
                    aria-labelledby="org-strategy-tab">
                    <table id="example1" class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">ACTION</th>
                          <th>No.</th>
                          <th>INTERNAL ISSUES</th>
                          <th>EFFECT</th>
                          <th>FILE</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade show" id="external" role="tabpanel" aria-labelledby="external-tab">
                    <table id="example2" class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center">ACTION</th>
                          <th>No.</th>
                          <th>EXTERNAL ISSUES</th>
                          <th>EFFECT</th>
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
    <div id="modal_crud_context_analysis">
      <?= $this->include("Modal/CRUD_Context_Analysis_modal"); ?>
    </div>
    <div id="modal_crud_note">
      <?= $this->include("Modal/CRUD_Note"); ?>
    </div>
    <div id="modal_reject">
      <?= $this->include("Modal/Reject_Modal"); ?>
    </div>
    <div id="modal_file_rename">
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
    $(document).ready(function () {
      getTableData1();
      $('#btn-external').hide();
    });
  </script>
  <script>
    function load_modal(check, check_type, data_encode) {
      var element = <?php echo json_encode($data); ?>;
      modal_requirement = document.getElementById("modal_requirement");
      modal_contextver = document.getElementById("modal_contextver");
      modal_crud_context_analysis = document.getElementById("modal_crud_context_analysis");
      modal_crud_note = document.getElementById("modal_crud_note");
      modal_reject = document.getElementById("modal_reject");
      modal_file_rename = document.getElementById("modal_file_rename");
      $(".modal-body #iss").empty();
      //--set header--//
      if (check_type == '1') {
        var select_iss = <?php echo json_encode($data_inter_iss); ?>;
        $(".modal-header #title_modal").text("Internal Issues");
        $(".modal-body #topic_title_select").text("Internal Issues");
      } else if (check_type == '2') {
        var select_iss = <?php echo json_encode($data_exter_iss); ?>;
        $(".modal-header #title_modal").text("External Issues");
        $(".modal-body #topic_title_select").text("External Issues");
      }

      if (check == '1') {
        //--show modal requirment--//
        modal_requirement.style.display = "block";
        modal_contextver.style.display = "none";
        modal_crud_context_analysis.style.display = "none";
        modal_crud_note.style.display = "none";
        modal_reject.style.display = "none";
        modal_file_rename.style.display = "none";
      } else if (check == '2') {
        //--show modal Version Control--//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "block";
        modal_crud_context_analysis.style.display = "none";
        modal_crud_note.style.display = "none";
        modal_reject.style.display = "none";
        modal_file_rename.style.display = "none";

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
        //--show modal create--//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_crud_context_analysis.style.display = "block";
        modal_crud_note.style.display = "none";
        modal_reject.style.display = "none";
        modal_file_rename.style.display = "none";
        $(".modal-body #effect").val("");
        select_iss.forEach(element_select => {
          if (element_select.activated == '1') {
            var newOption = $('<option>').val(element_select.id_select).text(element_select.topic);
            $(".modal-body #iss").append(newOption);
          }
        });
        $(".modal-content #description").text(select_iss[0]['description']);
        $(".modal-body #check_type").val(check_type);
        if (check_type == '1') {
          $(".modal-body #url_route").val("context/context_analysis/context_inter/store/" + element.id_version + "/" + element.status);
        } else if (check_type == '2') {
          $(".modal-body #url_route").val("context/context_analysis/context_exter/store/" + element.id_version + "/" + element.status);
        }
      } else if (check == '4') {
        //--show modal edit--//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_crud_context_analysis.style.display = "block";
        modal_crud_note.style.display = "none";
        modal_reject.style.display = "none";
        modal_file_rename.style.display = "none";
        const rowData = JSON.parse(decodeURIComponent(data_encode));
        select_iss.forEach(element_iss => {
          var newOption = $('<option></option>').val(element_iss.id_select).text(element_iss.topic);
          if (element_iss.id_select == rowData.id_selected) {
            $(".modal-body #iss").append(newOption.prop('selected', true));
            $(".modal-body #description").text(element_iss.description);
          } else {
            if (element_iss.activated == 1) {
              $(".modal-body #iss").append(newOption);
            }
          }
        });
        $(".modal-body #effect").val(rowData.effect);
        $(".modal-body #check_type").val(check_type);
        $(".modal-body #id_").val(rowData.id_);
        if (check_type == '1') {
          $(".modal-body #url_route").val("context/context_analysis/context_inter/edit/" + element.id_version + "/" + element.status);
        } else if (check_type == '2') {
          $(".modal-body #url_route").val("context/context_analysis/context_exter/edit/" + element.id_version + "/" + element.status);
        }
      } else if (check == '5') {
        //--show modal Create Note--//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_crud_context_analysis.style.display = "none";
        modal_crud_note.style.display = "block";
        modal_reject.style.display = "none";
        modal_file_rename.style.display = "none";

        $(".modal-body #modified").val(element.modified_date);
        $(".modal-body #check").val(10);
        $(".modal-body #params").val(10);
      } else if (check == '6') {
        //--show modal Rename File--//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_crud_context_analysis.style.display = "none";
        modal_crud_note.style.display = "none";
        modal_reject.style.display = "none";
        modal_file_rename.style.display = "block";

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
      } else if (check == '7') {
        //--show modal Reject--//
        modal_requirement.style.display = "none";
        modal_contextver.style.display = "none";
        modal_crud_context_analysis.style.display = "none";
        modal_crud_note.style.display = "none";
        modal_reject.style.display = "block";
        modal_file_rename.style.display = "none";

        $(".modal-body #status").val(check_type);
        $(".modal-body #modified_date").val(element.modified_date);
      }
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
            beforeSend: function () {
              // Show loading indicator here
              loadingIndicator;
            },
            complete: function () {
              // Hide loading indicator here
              Swal.close();
            }
          }).then(function (response) {
            if (response.success) {
              Swal.fire({
                title: response.message,
                icon: 'success',
                showConfirmButton: false
              });
              setTimeout(() => {
                if (response.reload) {
                  if (response.newCopy) {
                    window.location.href = '<?= site_url("context/context_analysis/") ?>' + response.id_version + '/' + response.num_ver;
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
        beforeSend: function () {
          // Show loading indicator here
          loadingIndicator;
        },
        success: function (response) {
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
  <script>
    var selected_iss = document.getElementById("iss");

    function updateDescription() {
      var check = document.getElementById("check_type").value;
      if (check == '1') {
        var select_iss_data = <?php echo json_encode($data_inter_iss); ?>;
      } else if (check == '2') {
        var select_iss_data = <?php echo json_encode($data_exter_iss); ?>;
      }
      let found = false;
      select_iss_data.forEach(element => {
        if (selected_iss.value === element.id_select) {
          found = true;
          if (element.activated === '1') {
            $(".modal-content #description").text(element.description);
          } else {
            found = false;
          }
        }
      });
      if (!found) {
        $(".modal-content #description").text("No Information");
      }
    }
    selected_iss.addEventListener("change", function () {
      updateDescription();
    });
  </script>
  <script>
    var countTable1 = 0;
    function getTableData1() {

      if (countTable1 === 0) {
        countTable1++;
        var data_context = <?php echo json_encode($data); ?>;
        if (data_context.status === '4' || data_context.status === '5') {
          var disabledAttribute = 'disabled';
        }
        if ($.fn.DataTable.isDataTable('#example1')) {
          $('#example1').DataTable().destroy();
        }
        $('#example1').DataTable({
          "processing": $("#context-ana .overlay").show(),
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('context/context_analysis/context_inter/find_data/'); ?>" + data_context.id_version,
            'type': 'GET',
            'dataSrc': 'data',
          },
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "searching": false,
          "drawCallback": function (settings) {
            $("#context-ana .overlay").hide();
            var daData = settings.json.data;
            if (daData.length == 0) {
              $('#example1 tbody').html(`
              <tr>
                <td colspan="5">
                    <div class="dropdown">
                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" ${disabledAttribute}></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="load_modal(3,1)" data-toggle="modal"
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
            'render': function (data, type, row, meta) {
              var number_index = +meta.settings.oAjaxData.start + 1;
              const encodedRowData = encodeURIComponent(JSON.stringify(row));
              let dropdownHtml = `
              <div class="dropdown">
                  <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                      class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                      ${disabledAttribute}></button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" onclick="load_modal(4, '1', '${encodedRowData}')" data-toggle="modal"
                          data-target="#modal-default">Edit</a>
                      <a class="dropdown-item" href="#"
                          onclick="confirm_Alert('You want to copy data ${number_index} ?', 'context/context_analysis/context_inter/copydata/${row.id_}/${number_index}/${data_context.id_version}/${data_context.status}')">Copy</a>
                      <a class="dropdown-item" href="#"
                          onclick="confirm_Alert('You want to delete data ${number_index} ?', 'context/context_analysis/context_inter/delete/${row.id_}/${row.id_file}/${number_index}/${data_context.id_version}/${data_context.status}')">Delete</a>

                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" onclick="load_modal(3,1)" data-toggle="modal" data-target="#modal-default">Create</a>
              `;
              if (row.id_file > 0) {
                dropdownHtml += `
                <div class="dropdown-divider"></div>
                  <div class="dropdown-submenu">
                      <a class="dropdown-item dropdown-toggle" href="#">File</a>
                      <div class="dropdown-menu right-menu-table">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                              onclick="load_modal('6' , '' ,'${encodedRowData}')">Rename</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"
                              onclick="confirm_Alert('You want to delete the data file ${number_index} ?', 'context/context_analysis/context_inter/delete_file/${row.id_}/${row.id_file}/${number_index}/${data_context.id_version}/${data_context.status}')">Delete
                              File</a>
                      </div>
                  </div>
                `;
              }
              dropdownHtml += `</div>
                </div>`;
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
            'render': function (data, type, row, meta) {
              var data_select = <?php echo json_encode($data_inter_iss); ?>;
              var topic = ''; // Variable to store the topic value
              data_select.forEach(function (element) {
                if (row.id_selected == element.id_select) {
                  topic = element.topic; // Store the topic value if a match is found
                }
              });
              if (topic.length > 50) {
                topic = '<span data-toggle="tooltip" data-placement="top" title="' + topic + '">' + topic.substring(0, 50) + '...</span>';
              }
              return topic; // Return the combined HTML content for the cell
            }
          },
          {
            'data': 'effect',
            'class': 'text-center',
            render: function (data, type, row) {
              if (type === 'display' && data && data.length > 50) {
                return '<span data-toggle="tooltip" data-placement="top" title="' + data + '" style="color: rgba(0, 123, 255, 1);">' +
                  data.substr(0, 50) + '...</span>';
              }
              return `<span data-toggle="tooltip" data-placement="top" title="${data}" style="color: rgba(0, 123, 255, 1);">
                ${data} </span>`;
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function (data, type, row, meta) {
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
    }
  </script>
  <script>
    var countTable2 = 0;
    function getTableData2() {
      if (countTable2 === 0) {
        countTable2++;
        var data_context = <?php echo json_encode($data); ?>;
        if (data_context.status === '4' || data_context.status === '5') {
          var disabledAttribute = 'disabled';
        }
        if ($.fn.DataTable.isDataTable('#example2')) {
          $('#example2').DataTable().destroy();
        }
        $('#example2').DataTable({
          "processing": $("#context-ana .overlay").show(),
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('context/context_analysis/context_exter/find_data/'); ?>" + data_context.id_version,
            'type': 'GET',
            'dataSrc': 'data',
          },
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "searching": false,
          "drawCallback": function (settings) {
            $("#context-ana .overlay").hide();
            var daData = settings.json.data;
            if (daData.length == 0) {
              $('#example2 tbody').html(`
              <tr>
                <td colspan="5">
                    <div class="dropdown">
                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" ${disabledAttribute}></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="load_modal(3,2)" data-toggle="modal"
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
            'render': function (data, type, row, meta) {
              var number_index = +meta.settings.oAjaxData.start + 1;
              const encodedRowData = encodeURIComponent(JSON.stringify(row));
              let dropdownHtml = `
              <div class="dropdown">
                <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff;" type="button"
                    class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    ${disabledAttribute}></button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" onclick="load_modal(4, '2', '${encodedRowData}')" data-toggle="modal"
                        data-target="#modal-default">Edit</a>
                    <a class="dropdown-item" href="#"
                        onclick="confirm_Alert('You want to copy data ${number_index} ?', 'context/context_analysis/context_exter/copydata/${row.id_}/${number_index}/${data_context.id_version}/${data_context.status}')">Copy</a>
                    <a class="dropdown-item" href="#"
                        onclick="confirm_Alert('You want to delete data ${number_index} ?', 'context/context_analysis/context_exter/delete/${row.id_}/${row.id_file}/${number_index}/${data_context.id_version}/${data_context.status}')">Delete</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="load_modal(3,2)" data-toggle="modal" data-target="#modal-default">Create</a>`;
              if (row.id_file > 0) {
                dropdownHtml += `
                <div class="dropdown-divider"></div>
                  <div class="dropdown-submenu">
                      <a class="dropdown-item dropdown-toggle" href="#">File</a>
                      <div class="dropdown-menu right-menu-table">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default"
                              onclick="load_modal('6' , '' ,'${encodedRowData}')">Rename</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"
                              onclick="confirm_Alert('You want to delete the data file ${number_index} ?', 'context/context_analysis/context_exter/delete_file/${row.id_}/${row.id_file}/${number_index}/${data_context.id_version}/${data_context.status}')">Delete
                              File</a>
                      </div>
                  </div>
                `;
              }
              dropdownHtml += `</div>
                </div>`;
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
            'render': function (data, type, row, meta) {
              var data_select = <?php echo json_encode($data_inter_iss); ?>;
              var topic = ''; // Variable to store the topic value
              data_select.forEach(function (element) {
                if (row.id_selected == element.id_select) {
                  topic = element.topic; // Store the topic value if a match is found
                }
              });
              if (topic.length > 50) {
                topic = '<span data-toggle="tooltip" data-placement="top" title="' + topic + '">' + topic.substring(0, 50) + '...</span>';
              }
              return topic; // Return the combined HTML content for the cell
            }
          },
          {
            'data': 'effect',
            'class': 'text-center',
            render: function (data, type, row) {
              if (type === 'display' && data && data.length > 50) {
                return '<span data-toggle="tooltip" data-placement="top" title="' + data + '" style="color: rgba(0, 123, 255, 1);">' +
                  data.substr(0, 50) + '...</span>';
              }
              return `<span data-toggle="tooltip" data-placement="top" title="${data}" style="color: rgba(0, 123, 255, 1);">
                ${data} </span>`;
            }
          },
          {
            'data': null,
            'class': 'text-center',
            'render': function (data, type, row, meta) {

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
    }
  </script>
  <script>
    $('#internal-tab').on('click', function () {
      console.log('internal-tab');
      $('#btn-internal').show();
      $('#btn-external').hide();
    });
    $('#external-tab').on('click', function () {
      console.log('external-tab');
      $('#btn-internal').hide();
      $('#btn-external').show();
    })
  </script>