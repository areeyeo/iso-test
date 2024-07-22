<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    #dataTable {
      border-collapse: separate;
      border-spacing: 0;
      border: 2px solid #dee2e6;
      border-radius: 10px;
    }

    #dataTable th,
    #dataTable td {
      border: none;
    }

    #dataTable tbody tr {
      background-color: white;
    }

    #dataTable thead th {
      background-color: #f7f7f7;
    }

    #dataTable tr:hover {
      background-color: #f1f1f1;
    }

    .offcanvas {
      width: 400px;
      height: 100%;
      position: fixed;
      top: 0;
      right: -400px;
      background-color: white;
      z-index: 1051;
      transition: right 0.3s ease-in-out;
    }

    .offcanvas.show {
      right: 0;
    }

    .offcanvas-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.2);
      z-index: 1050;
      display: none;
    }

    .offcanvas-backdrop.show {
      display: block;
    }

    .offcanvaschecklist {
      width: 400px;
      height: 100%;
      position: fixed;
      top: 0;
      right: -400px;
      background-color: white;
      z-index: 1051;
      transition: right 0.3s ease-in-out;
    }

    .offcanvaschecklist.show {
      right: 0;
    }

    .offcanvas-backdrop-checklist {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.2);
      z-index: 1050;
      display: none;
    }

    .offcanvas-backdrop-checklist.show {
      display: block;
    }

    .offcanvasreport {
      width: 400px;
      height: 100%;
      position: fixed;
      top: 0;
      right: -400px;
      background-color: white;
      z-index: 1051;
      transition: right 0.3s ease-in-out;
    }

    .offcanvasreport.show {
      right: 0;
    }

    .offcanvas-backdrop-report {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.2);
      z-index: 1050;
      display: none;
    }

    .offcanvas-backdrop-report.show {
      display: block;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 40px;
      height: 20px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
      border-radius: 20px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      left: 2px;
      bottom: 2px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .2s;
      border-radius: 50%;
    }

    input:checked+.slider {
      background-color: #61F70D;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #61F70D;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(16px);
      -ms-transform: translateX(16px);
      transform: translateX(16px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 20px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    .tab {
      overflow: hidden;
      border: 1px solid #e2f0ff;
      background-color: #e2f0ff;
      height: 54px;
      border-radius: 10px 10px 0px 0px;
    }

    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    .tab button:hover {
      background-color: #B7DAFF;
      border-radius: 10px;
    }

    .tab button.active {
      background-color: #B7DAFF;
      border-radius: 10px;
    }

    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-radius: 0px 0px 10px 10px;
      border-top: none;
    }
  </style>
</head>

<body>
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div> -->
      <div class="modal-header bg-primary">
        <h4 class="modal-title" id="title_modal" name="title_modal">Audit Plan</h4>
        <span style="font-size: 20pt; cursor: pointer;" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;</span>
      </div>
      <div class="modal-body">
        <form class="mb-3" id="form_crud_initial" action="javascript:void(0)" method="post" enctype="multipart/form-data">
          <div class="form-group mt-3">
            <div style="font-weight: 600;">
              <h6>Program Name</h6>
            </div>
            <div>
              <h6 style="color: #007BFF;" name="projectname_detail" id="projectname_detail"></h6>      
            </div>
          </div>
          <div class="form-group mt-3">
            <div class="row mt-3">
              <div class="col-3">
                <div class="form-group">
                  <h6>Start date</h6>
                  <div style=" color: #666666; font-size: 11pt;" name="startdate_detail" id="startdate_detail"></div>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <h6>End date</h6>
                  <div style=" color: #666666; font-size: 11pt;" name="enddate_detail" id="enddate_detail"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab">
            <button class="tablinks active" onclick="openTabAuditPlan(event, 'initialdata')">Initial Data</button>
            <button class="tablinks" onclick="openTabAuditPlan(event, 'scheduleplan')">Schedule Plan</button>
            <button class="tablinks" onclick="openTabAuditPlan(event, 'auditchecklist')">Audit Checklist</button>
            <button class="tablinks" onclick="openTabAuditPlan(event, 'auditreport')">Audit Report</button>
          </div>

          <div id="initialdata" class="tabcontent">
            <div class="container">
              <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                <h5>Initial Data</h5>
                <div style="color: #666666;">
                  <span><i class="fas fa-edit"></i>&nbsp;Edit Mode</span>&nbsp;
                  <label class="switch mt-3">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>&nbsp;
                  <span class="switch-status">OFF</span>
                </div>
              </div>
              <div class="form-group mt-3">
                <h6>Audit Objective</h6>
                <input class="form-control gray-text tabInitialData" type="text" placeholder="Text..." name="auditobjectives" id="auditobjectives" disabled></input>
              </div>
              <div class="row mt-3">
                <div class="col-6">
                  <div class="form-group">
                    <h6>Audit Scope</h6>
                    <textarea class="form-control gray-text tabInitialData" rows="2" placeholder="Text..." name="auditscope" id="auditscope" disabled></textarea>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <h6>Audit Criteria</h6>
                    <textarea class="form-control gray-text tabInitialData" rows="2" placeholder="Text..." name="auditcriteria" id="auditcriteria" disabled></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group mt-3">
                    <h6>Audit Lead</h6>
                    <input class="form-control gray-text tabInitialData" type="text" placeholder="Text..." name="auditlead" id="auditlead" disabled></input>
                  </div>
                  <div class="form-group">
                    <h6>Attach File Audit Plan</h6>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input tabInitialData" id="exampleInputFile" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file" disabled>
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group mt-3">
                    <h6>Audit Team</h6>
                    <textarea onInput="handleInput(event)" class="form-control gray-text tabInitialData" rows="5" placeholder="Text..." name="auditteam" id="auditteam" disabled></textarea>
                  </div>
                </div>
              </div>
              <input type="text" id="url_route" name="url_route" hidden>
              <input type="text" id="check_type" name="check_type" hidden>
              <input type="text" id="id_" name="id_" hidden>
              <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-success" name="saveInitial" value="Submit" id="saveInitial">SAVE</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
              </div>
            </div>
          </div>

          <div id="scheduleplan" class="tabcontent">
            <div class="container">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mt-3">Schedule Plan</h5>
                <button type="button" class="btn btn-outline-primary btn-sm mt-3" onclick="toggleOffcanvas()"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add an event</button>
              </div>
              <table id="dataTableSchedule" class="table table-hover">
                <thead>
                  <tr>
                    <th style="border-radius: 10px 0px 0px 0px;">NO.</th>
                    <th>DATE</th>
                    <th>TIME</th>
                    <th>EVENT NAME</th>
                    <th>AUDITEE</th>
                    <th style="border-radius: 0px 10px 0px 0px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>

          <div id="auditchecklist" class="tabcontent">
            <div class="container">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mt-3">Audit Checklist</h5>
                <button type="button" class="btn btn-outline-primary btn-sm mt-3" onclick="toggleOffcanvaschecklist(0)">
                  <i class="fas fa-edit"></i>&nbsp;&nbsp;Create Audit Checklist
                </button>
              </div>

              <table class="table table table-hover" id="dataTableChecklist">
                <thead>
                  <tr>
                    <th>NO.</th>
                    <th>INSPECTION TOPIC</th>
                    <th>FILE</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>

          <div id="auditreport" class="tabcontent">
            <div class="container">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mt-3">Audit Report</h5>
                <button type="button" class="btn btn-outline-primary btn-sm mt-3" onclick="toggleOffcanvasreport(0)">
                  <i class="fas fa-edit"></i>&nbsp;&nbsp;Create Audit Report
                </button>
              </div>

              <table class="table table table-hover" id="dataTableReport">
                <thead>
                  <tr>
                    <th>AR NO.</th>
                    <th>REPORT ABOUT</th>
                    <th>NOTE</th>
                    <th>FILE</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- canvas details schedule-->
  <div id="offcanvas" class="offcanvas">
  <form class="mb-3" id="form_crud_schedule" action="javascript:void(0)" method="post" enctype="multipart/form-data">
    <div class="p-4">
      <div class="d-flex justify-content-between align-items-center">
        <h4>Daily Audit Schedule</h4>
        <span style="cursor: pointer;" onclick="closeOffcanvas()"><i class="fas fa-times"></i></span>
      </div>
      <hr>
      <input type="text" id="id_plan_schedule" name="id_plan_schedule" hidden>
      <input type="text" id="url_route_schedule" name="url_route_schedule" hidden>
      <input type="text" id="check_type" name="check_type" hidden>
      <div class="form-group mt-3">
        <h6>Date</h6>
        <input class="form-control gray-text" type="date" placeholder="Text..." name="date" id="date"></input>
      </div>
      <div class="form-group mt-3">
        <h6>Start Time</h6>
        <input class="form-control gray-text" type="time" placeholder="Text..." name="starttime" id="starttime"></input>
      </div>
      <div class="form-group mt-3">
        <h6>End Time</h6>
        <input class="form-control gray-text" type="time" placeholder="Text..." name="endtime" id="endtime"></input>
      </div>
      <div class="form-group mt-3">
        <h6>Event Name</h6>
        <input class="form-control gray-text" type="text" placeholder="Text..." name="eventname" id="eventname"></input>
      </div>
      <div class="form-group mt-3">
        <h6>Deteils</h6>
        <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="deteils" id="deteils"></textarea>
      </div>
      <div class="form-group mt-3">
        <h6>Auditee</h6>
        <input class="form-control gray-text" type="text" placeholder="Text..." name="auditee" id="auditee"></input>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-success" name="saveSchedule" value="Submit" id="saveSchedule">SAVE</button>&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-danger" onclick="closeOffcanvas()">CANCEL</button>
    </div>
  </form> 
  </div>
  <div id="offcanvasBackdrop" class="offcanvas-backdrop"></div>

  <!-- canvas audit checklist-->
  <div id="offcanvaschecklist" class="offcanvaschecklist">
  <form class="mb-3" id="form_crud_checklist" action="javascript:void(0)" method="post" enctype="multipart/form-data">
    <div class="p-4">
      <div class="d-flex justify-content-between align-items-center">
        <h4>Audit Checklist</h4>
        <span style="cursor: pointer;" onclick="closeOffcanvaschecklist()"><i class="fas fa-times"></i></span>
      </div>
      <hr>
      <input type="text" id="id_plan_checklist" name="id_plan_checklist" hidden>
      <input type="text" id="url_route_checklist" name="url_route_checklist" hidden>
      <input type="text" id="check_type" name="check_type" hidden>
      <div class="form-group mt-3">
        <h6>Inspection topic</h6>
        <input class="form-control gray-text" type="text" placeholder="Text..." name="inspectiontopic" id="inspectiontopic"></input>
      </div>
      <div class="form-group">
        <h6>Attach File Checklist</h6>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
          <label class="custom-file-label" for="customFile" id="filename">Choose file</label>
        </div>
        <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
      </div>
      <input type="text" id="id_checklist" name="id_checklist" hidden>
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-success" name="saveChecklist" value="Submit" id="saveChecklist">SAVE</button>&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-danger" onclick="closeOffcanvaschecklist()">CANCEL</button>
    </div>
  </form>
  </div>
  <div id="offcanvasBackdropchecklist" class="offcanvas-backdrop-checklist"></div>

  <!-- canvas audit report-->
  <div id="offcanvasreport" class="offcanvasreport">
  <form class="mb-3" id="form_crud_report" action="javascript:void(0)" method="post" enctype="multipart/form-data">
    <div class="p-4">
      <div class="d-flex justify-content-between align-items-center">
        <h4>Audit Report</h4>
        <span style="cursor: pointer;" onclick="closeOffcanvasreport()"><i class="fas fa-times"></i></span>
      </div>
      <hr>
      <input type="text" id="id_plan_report" name="id_plan_report" hidden>
      <input type="text" id="url_route_report" name="url_route_report" hidden>
      <input type="text" id="check_type" name="check_type" hidden>
      <div class="form-group mt-3">
        <h6>Report About</h6>
        <input class="form-control gray-text" type="text" placeholder="Text..." name="report" id="report"></input>
      </div>
      <div class="form-group mt-3">
        <h6>Note</h6>
        <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="note" id="note"></textarea>
      </div>
      <div class="form-group">
        <h6>Attach File Audit Report</h6>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="exampleInputFile" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
          <label class="custom-file-label" for="customFile" id="filename">Choose file</label>
        </div>
        <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
      </div>
      <input type="text" id="id_report" name="id_report" hidden>
    </div>
    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-success" name="saveReport" value="Submit" id="saveReport">SAVE</button>&nbsp;&nbsp;&nbsp;
      <button type="button" class="btn btn-danger" onclick="closeOffcanvasreport()">CANCEL</button>
    </div>
  </form>
  </div>
  <div id="offcanvasBackdropreport" class="offcanvas-backdrop-report"></div>


  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- overlay modal -->
  <script>
    $(document).ready(function() {
      $(".overlay").hide();
    });

    $(function() {
        bsCustomFileInput.init();
    });

    // เมื่อคลิกปุ่ม "Save"
    $("#saveInitial").click(function(e) {
      e.preventDefault();
      const urlRouteInput = document.getElementById("url_route");
      action_(urlRouteInput.value, 'form_crud_initial');
    });

    $("#saveSchedule").click(function(e) {
      e.preventDefault();
      const urlRouteInput = document.getElementById("url_route_schedule");
      action_(urlRouteInput.value, 'form_crud_schedule');
    });

    $("#saveChecklist").click(function(e) {
      e.preventDefault();
      const urlRouteInput = document.getElementById("url_route_checklist");
      action_(urlRouteInput.value, 'form_crud_checklist');
    });

    $("#saveReport").click(function(e) {
      e.preventDefault();
      const urlRouteInput = document.getElementById("url_route_report");
      action_(urlRouteInput.value, 'form_crud_report');
    });
  </script>



  <!-- bullet textarea -->
  <script>
    let previousLength = 0;

    const handleInput = (event) => {
      const bullet = "\u2022";
      const newLength = event.target.value.length;
      const characterCode = event.target.value.substr(-1).charCodeAt(0);

      if (newLength > previousLength) {
        if (characterCode === 10) {
          event.target.value = `${event.target.value}${bullet} `;
        } else if (newLength === 1) {
          event.target.value = `${bullet} ${event.target.value}`;
        }
      }

      previousLength = newLength;
    }
  </script>

  <!-- load data first tab  -->
  <script>
    window.onload = function() {
      openTabAuditPlan(event, 'initialdata');
    };

    function openTabAuditPlan(evt, cityName, eid) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";

      
    }
  </script>

  <!-- show tab switch -->
  <script>
    function showTab(tabId) {
      document.querySelectorAll('[id^="tab"]').forEach(tab => {
        tab.style.display = 'none';
      });

      document.getElementById('nav-link').forEach(item => {
        item.classList.remove('active');
      });

      document.getElementById(tabId + 'Content').style.display = 'block';

      document.querySelector('[href="#' + tabId + '"]').classList.add('active');
    }
  </script>

  <!-- table schedule plan -->
  <script>
        function getTableData1(pid) {
            if ($.fn.DataTable.isDataTable('#dataTableSchedule')) {
                $('#dataTableSchedule').DataTable().destroy();
            }
            $('#dataTableSchedule').DataTable({
                "processing": true,
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('internal_audit/audit_management/schedule_plan/getdata/'); ?>"+pid,
                    'type': 'GET',
                },
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "ordering": false,
                "drawCallback": function(settings) {
                    var daData = settings.json.data;
                    var count_ = 0;
                    if (daData.length == 0) {
                        $('#dataTableSchedule tbody').html(`
                          <tr>
                            <td colspan="10">
                                <div class="dropdown">
                                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" onclick="toggleOffcanvas()">Create</a>
                                    </div>
                                </div>
                            </td>
                          </tr>`);
                    } else {
                        // Use append() to add new rows to the existing content
                        $('#dataTableSchedule tbody').empty();
                        daData.forEach(element => {
                            count_++;
                            var table = `
                                    <tr style="background-color: #E2F0FF">
                                    <td style="color: #007bff">วันที่ ${count_}</td>
                                    <td style="color: #007bff">${element.date}</td>
                                    <td colspan="4"></td>
                                    </tr>`;
                              element.data_list.forEach(element_list => {
                                table += `<tr>
                                    <td colspan="2"></td>`;
                                table += `<td >${element_list.start_time !== '' ? element_list.start_time : '-'} - ${element_list.end_time !== '' ? element_list.end_time : '-'}</td>`;
                                table += `<td >${element_list.event_name !== '' ? element_list.event_name : '-'}</td>`;
                                table += `<td >${element_list.detail !== '' ? element_list.detail : '-'}</td>`;
                                table += `<td >${element_list.auditee !== '' ? element_list.auditee : '-'}</td>`;   
                                table += `</tr>`;
                              });
                            // Append the row to the table
                            $('#dataTableSchedule tbody').append(table);
                        });
                    }
                },
                'columns': [{
                    'data': null,
                }, ],
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    </script>

  <!-- table checklist -->
  <script>
    var countTable2 = 0;

    function getTableData2(pid) {
      
    
        if ($.fn.DataTable.isDataTable('#dataTableChecklist')) {
          $('#dataTableChecklist').DataTable().destroy();
        }
        $('#dataTableChecklist').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('internal_audit/audit_management/audit_checklist/getdata/'); ?>"+pid,
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
              $('#dataTableChecklist tbody').html(`
              <tr>
                  <td colspan="10">
                      <div class="dropdown">
                          <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                              class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"></button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" onclick="toggleOffcanvaschecklist(0)">Create</a>
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
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                        }
                    },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.inspection_topic !== null ? (data.inspection_topic !== '' ? data.inspection_topic : '-') : '-') + '</div>';
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
            {
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
                        <a class="dropdown-item" onclick="toggleOffcanvaschecklist(1,'${encodedRowData}')">Edit</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to copy data ${number_index} ?', 'internal_audit/checklist/copydata/${row.id_audit_checklist}')">Copy</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'internal_audit/checklist/delete/${row.id_audit_checklist}')">Delete</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="toggleOffcanvaschecklist(0)">Create</a>`;
                dropdownHtml += `</div>
                </div>`;
                return dropdownHtml;
              }
            },
          ],
        });
        $('[data-toggle="tooltip"]').tooltip();
      
    }
  </script>

  <!-- table report -->
  <script>
    var countTable3 = 0;

    function getTableData3(pid) {
      
    
        if ($.fn.DataTable.isDataTable('#dataTableReport')) {
          $('#dataTableReport').DataTable().destroy();
        }
        $('#dataTableReport').DataTable({
          "processing": true,
          "pageLength": 10,
          "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
          'serverSide': true,
          'ajax': {
            'url': "<?php echo site_url('internal_audit/audit_management/audit_report/getdata/'); ?>"+pid,
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
              $('#dataTableReport tbody').html(`
              <tr>
                  <td colspan="10">
                      <div class="dropdown">
                          <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                              class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"></button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" onclick="toggleOffcanvasreport(0)">Create</a>
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
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.audit_report_no !== null ? (data.audit_report_no !== '' ? data.audit_report_no : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.report_about !== null ? (data.report_about !== '' ? data.report_about : '-') : '-') + '</div>';
              }
            },
            {
              'data': null,
              'class': 'text-center',
              'render': function(data, type, row, meta) {
                return '<div style="color: rgba(0, 123, 255, 1);">' + (data.note !== null ? (data.note !== '' ? data.note : '-') : '-') + '</div>';
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
            {
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
                        <a class="dropdown-item" onclick="toggleOffcanvasreport(1,'${encodedRowData}')">Edit</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to copy data ${number_index} ?', 'internal_audit/report/copydata/${row.id_audit_report}')">Copy</a>
                        <a class="dropdown-item" href="#"
                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'internal_audit/report/delete/${row.id_audit_report}')">Delete</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="toggleOffcanvasreport(0)">Create</a>`;
                dropdownHtml += `</div>
                </div>`;
                return dropdownHtml;
              }
            },
          ],
        });
        $('[data-toggle="tooltip"]').tooltip();
      
    }
  </script>

  <!-- canvas open and close -->
  <script>
    function toggleOffcanvas() {
      const offcanvas = document.getElementById('offcanvas');
      const offcanvasBackdrop = document.getElementById('offcanvasBackdrop');
      offcanvas.classList.toggle('show');
      offcanvasBackdrop.classList.toggle('show');
    }

    function closeOffcanvas() {
      const offcanvas = document.getElementById('offcanvas');
      const offcanvasBackdrop = document.getElementById('offcanvasBackdrop');
      offcanvas.classList.remove('show');
      offcanvasBackdrop.classList.remove('show');
    }

    function toggleOffcanvaschecklist(check, data_) {
      const offcanvaschecklist = document.getElementById('offcanvaschecklist');
      const offcanvasBackdropchecklist = document.getElementById('offcanvasBackdropchecklist');
      offcanvaschecklist.classList.toggle('show');
      offcanvasBackdropchecklist.classList.toggle('show');
      if (check == '0') {
        $(".p-4 #inspectiontopic").val('');
        $(".p-4 #filename").text('Choose file');
      }
      else if (check == '1') {
        const rowData = JSON.parse(decodeURIComponent(data_));
        $(".p-4 #url_route_checklist").val('internal_audit/checklist/update/'+rowData.id_audit_checklist);
        $(".p-4 #id_checklist").val(rowData.id_audit_checklist);
        $(".p-4 #inspectiontopic").val(rowData.inspection_topic);
        if (rowData.file_data != null) {
          $(".p-4 #filename").text(rowData.file_data['name_file']);
        }else{
          $(".p-4 #filename").text('Choose file');
        }
      } else {

      }
    }

    function closeOffcanvaschecklist() {
      const offcanvaschecklist = document.getElementById('offcanvaschecklist');
      const offcanvasBackdropchecklist = document.getElementById('offcanvasBackdropchecklist');
      offcanvaschecklist.classList.remove('show');
      offcanvasBackdropchecklist.classList.remove('show');
    }

    function toggleOffcanvasreport(check, data_) {
      const offcanvasreport = document.getElementById('offcanvasreport');
      const offcanvasBackdropreport = document.getElementById('offcanvasBackdropreport');
      offcanvasreport.classList.toggle('show');
      offcanvasBackdropreport.classList.toggle('show');
      if (check == '0') {
        $(".p-4 #report").val('');
        $(".p-4 #note").val('');
        $(".p-4 #filename").text('Choose file');
      }
      else if (check == '1') {
        const rowData = JSON.parse(decodeURIComponent(data_));
        $(".p-4 #url_route_report").val('internal_audit/report/update/'+rowData.id_audit_report);
        $(".p-4 #id_report").val(rowData.id_audit_report);
        $(".p-4 #report").val(rowData.report_about);
        $(".p-4 #note").val(rowData.note);
        if (rowData.file_data != null) {
          $(".p-4 #filename").text(rowData.file_data['name_file']);
        }else{
          $(".p-4 #filename").text('Choose file');
        }
      } else {
        
      }
    }

    function closeOffcanvasreport() {
      const offcanvasreport = document.getElementById('offcanvasreport');
      const offcanvasBackdropreport = document.getElementById('offcanvasBackdropreport');
      offcanvasreport.classList.remove('show');
      offcanvasBackdropreport.classList.remove('show');
    }
  </script>

  <!-- edit mode -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const switchElement = document.querySelector('.switch input[type="checkbox"]');
      const initialDataInputs = document.querySelectorAll('.tabInitialData');
      const switchStatusElement = document.querySelector('.switch-status');

      switchElement.addEventListener('change', function() {
        const switchStatus = this.checked;

        initialDataInputs.forEach(input => {
          input.disabled = !switchStatus;

          if (this.checked) {
            switchStatusElement.textContent = 'ON';
          } else {
            switchStatusElement.textContent = 'OFF';
          }
        });
      });
    });
  </script>

</body>

</html>