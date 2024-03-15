<title>Address risks & opportunities</title>
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

    .vertical-line {
        width: 2px;
        /* ความกว้างของเส้นแนวตั้ง */
        height: 100px;
        /* ความสูงของเส้นแนวตั้ง */
        background-color: #000;
        /* สีของเส้นแนวตั้ง */
        margin: 0 10px;
        /* ระยะห่างระหว่างเส้นแต่ละเส้น */
    }
</style>
<?php
// ข้อมูลจากหน้า likelihood
$likelihoodData = [
    ["สูงมาก", 5],
    ["สูง", 4],
    ["ปานกลาง", 3],
    ["น้อย", 2],
    ["น้อยมาก", 1]
];

// ข้อมูลจากหน้า Consequenc
$impactData = [
    ["น้อยมาก", 1],
    ["น้อย", 2],
    ["ปานกลาง", 3],
    ["สูง", 4],
    ["สูงมาก", 5]
];

function getRiskColor($result)
{
    if ($result <= 4) {
        return "#92D050";
    } else if ($result <= 9) {
        return "#FFFF00";
    } else if ($result <= 19) {
        return "#FFC000";
    } else {
        return "#FD2B2B";
    }
}
?>
<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            Address risks & opportunities
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a>Address risks & opportunities</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Create Information Security Risk & Opportunities</h2>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mt-2">
                                        <h6>Type</h6>
                                        <select class="custom-select">
                                            <option selected>Select Type</option>
                                            <option value="1">Hardware</option>
                                            <option value="2">Software</option>
                                            <option value="3">Information</option>
                                            <option value="4">People</option>
                                            <option value="5">Service</option>
                                            <option value="6">Virtual Machine</option>
                                            <option value="7">Location</option>
                                            <option value="8">Other (please specify)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4" id="input-othertype">
                                    <div class="form-group mt-2">
                                        <h6>Other Types</h6>
                                        <input class="form-control gray-text" type="text" placeholder="Text..." name="othertype" id="othertype"></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-2">
                                        <h6>Asset Group</h6>
                                        <input class="form-control gray-text" type="text" name="assetgroup" id="assetgroup"></input>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mt-2">
                                        <h6>Risk / Opportunities</h6>
                                        <div class="d-flex mt-3">
                                            <div class="form-check" style="margin-right: 30px;">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="riskRadio" value="option1" checked>
                                                <label class="form-check-label" for="riskRadio">
                                                    Risk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="oppRadio" value="option2">
                                                <label class="form-check-label" for="oppRadio">
                                                    Opportunities
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="risk-is">
                                <div class="row" id="risk-is">
                                    <div class="col-lg-4">
                                        <div class="form-group mt-3">
                                            <h6>Threat</h6>
                                            <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="threat" id="threat"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mt-3">
                                            <h6>Vulnerability</h6>
                                            <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="threat" id="threat"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mt-3">
                                            <h6>Existing Controls</h6>
                                            <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="threat" id="threat"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3" id="risk-context-consequences">
                                    <h6>Consequences</h6>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Confidentiality</h6>
                                                <select class="custom-select select-impact-risk" id="operational-select">
                                                    <option selected>Select Confidentiality</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Integrity</h6>
                                                <select class="custom-select select-impact-risk" id="productivity-select">
                                                    <option selected>Select Integrity</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Availability</h6>
                                                <select class="custom-select select-impact-risk" id="reputation-select">
                                                    <option selected>Select Availability</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3" id="risk-context-analysis">
                                    <h6>Risk Analysis</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mt-2">
                                                <h6>Impact</h6>
                                                <input class="form-control gray-text" type="number" name="impact" id="impact" readonly></input>
                                            </div>
                                            <div class="form-group mt-4">
                                                <h6>Likelihood</h6>
                                                <input class="form-control gray-text" type="number" name="likelihood" id="likelihood"></input>
                                            </div>
                                            <div class="form-group mt-4">
                                                <h6>Risk Level</h6>
                                                <input class="form-control gray-text" type="number" name="risklevel" id="risklevel" readonly></input>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="overflow-x:auto;">
                                                <table class="table table-bordered" style="font-size: 8pt">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px;background-color: #fff;" class="text-center" rowspan="2" colspan="2"></th>
                                                            <th style="width: 130px; background-color: #658ABF;color: floralwhite; font-weight: 500;" class="text-center" colspan="8">
                                                                <div>ผลกระทบ</div>
                                                                <div style="font-size:90%;">(Impact)</div>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <?php foreach ($impactData as $impact) : ?>
                                                                <th class="text-center " style="background-color: #E2EEFF; font-weight: 400;">
                                                                    <?= $impact[0] ?> (<?= $impact[1] ?>)
                                                                </th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th rowspan="6" style="background-color: #658ABF; color: floralwhite; font-weight: 500; text-align: center;">
                                                                <div>โอกาสเกิด</div>
                                                                <div style="font-size:90%;">(Likelihood)</div>
                                                            </th>
                                                        </tr>

                                                        <?php foreach ($likelihoodData as $likelihood) : ?>
                                                            <tr>
                                                                <th class="text-center" style="background-color: #E2EEFF; font-weight: 400;">
                                                                    <?= $likelihood[0] ?> (<?= $likelihood[1] ?>)
                                                                </th>
                                                                <?php foreach ($impactData as $impact) : ?>
                                                                    <?php $result = $impact[1] * $likelihood[1] ?>
                                                                    <td class="text-center" style="background-color: <?= getRiskColor($result) ?>">
                                                                        <?= $result ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="" id="risk-is-risk-treatment-plan" style="display: none;">
                                    <h6>Risk Treatment Plan</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mt-2">
                                                <h6>Risk Option</h6>
                                                <select class="custom-select" id="risk-option">
                                                    <option selected>Select Option</option>
                                                    <option value="1">Risk Treatment (การรักษาความเสี่ยง)</option>
                                                    <option value="2">Risk Modification (การปรับเปลี่ยนความเสี่ยง)</option>
                                                    <option value="3">Risk Avoidance (การหลีกเลี่ยงความเสี่ยง)</option>
                                                    <option value="4">Risk Sharing (การแบ่งปันความเสี่ยง)</option>
                                                    <option value="5">Risk Acceptance (การยอมรับความเสี่ยง)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mt-3">
                                                <h6>Risk Treatment Plan</h6>
                                                <textarea class="form-control gray-text" rows="5" placeholder="Text..." name="risktreatmentplan" id="risktreatmentplan"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <div class="form-group mt-2">
                                                <h6>Risk Owner</h6>
                                                <input class="form-control gray-text" type="text" placeholder="Text..." name="riskowner" id="riskowner"></input>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mt-3">
                                                        <h6>Start Date</h6>
                                                        <input class="form-control gray-text" type="date" name="startdate" id="startdate"></input>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mt-3">
                                                        <h6>End Date</h6>
                                                        <input class="form-control gray-text" type="date" name="enddate" id="enddate"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <h6>Attach File</h6>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="risk-file" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
                                                    <label class="custom-file-label" for="risk-file">Choose file</label>
                                                </div>
                                                <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3" id="risk-is-consequences-after-treatment" style="display: none;">
                                    <h6>Consequences (After Treatment)</h6>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group mt-2">
                                                <h6>Confidentiality</h6>
                                                <select class="custom-select select-impact-residual" id="operational-select2">
                                                    <option selected>Select Confidentiality</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group mt-2">
                                                <h6>Integrity</h6>
                                                <select class="custom-select select-impact-residual" id="productivity-select2">
                                                    <option selected>Select Integrity</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group mt-2">
                                                <h6>Availability</h6>
                                                <select class="custom-select select-impact-residual" id="reputation-select2">
                                                    <option selected>Select Availability</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Impact</h6>
                                                <input class="form-control gray-text" type="number" name="impact2" id="impact2" readonly></input>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Likelihood</h6>
                                                <input class="form-control gray-text" type="number" name="likelihood2" id="likelihood2"></input>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Residual</h6>
                                                <input class="form-control gray-text" type="number" name="residual" id="residual" readonly></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="opportunities-is">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mt-3">
                                            <h6>Opportunity planning</h6>
                                            <textarea class="form-control gray-text" rows="5" placeholder="Text..." name="risktreatmentplan" id="risktreatmentplan"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <div class="form-group mt-2">
                                            <h6>Opportunities Owner</h6>
                                            <input class="form-control gray-text" type="text" placeholder="Text..." name="riskowner" id="riskowner"></input>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mt-3">
                                                    <h6>Start Date</h6>
                                                    <input class="form-control gray-text" type="date" name="startdate" id="startdate"></input>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-3">
                                                    <h6>End Date</h6>
                                                    <input class="form-control gray-text" type="date" name="enddate" id="enddate"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <h6>Attach File</h6>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="opportunities-file" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
                                                <label class="custom-file-label" for="opportunities">Choose file</label>
                                            </div>
                                            <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 30px;">Cancel</button>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $("#risklevelmaxtrix_placeholder").load("<?php echo base_url('risk_Criteria_Context_Risk_Level'); ?> #risklevelmaxtrix");
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var riskRadio = document.getElementById("riskRadio");
                var opportunitiesRadio = document.getElementById("oppRadio");
                var riskContext = document.getElementById("risk-is");
                var opportunitiesContext = document.getElementById("opportunities-is");

                riskRadio.addEventListener("change", function() {
                    if (riskRadio.checked) {
                        riskContext.style.display = "block";
                        opportunitiesContext.style.display = "none";
                    }
                });

                opportunitiesRadio.addEventListener("change", function() {
                    if (opportunitiesRadio.checked) {
                        riskContext.style.display = "none";
                        opportunitiesContext.style.display = "block";
                    }
                });

                // Check initial state
                if (riskRadio.checked) {
                    riskContext.style.display = "block";
                    opportunitiesContext.style.display = "none";
                } else if (opportunitiesRadio.checked) {
                    riskContext.style.display = "none";
                    opportunitiesContext.style.display = "block";
                }
            });
        </script>

        <!-- risk-level-over -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll("select.select-impact-risk").forEach(function(select) {
                    select.addEventListener("change", showMaxValueInImpact);
                });

                document.getElementById("likelihood").addEventListener("input", calRiskLevel);
            });

            function showMaxValueInImpact() {
                var maxValue = findMaxValue("select.select-impact-risk");
                document.getElementById("impact").value = maxValue;
                calRiskLevel();
            }

            function findMaxValue(selector) {
                var selects = document.querySelectorAll(selector);
                var maxValue = 0;

                selects.forEach(function(select) {
                    var value = parseInt(select.value);
                    if (value > maxValue) {
                        maxValue = value;
                    }
                });
                return maxValue;
            }

            function calRiskLevel() {
                var impactValue = parseFloat(document.getElementById("impact").value);
                var likelihoodValue = parseFloat(document.getElementById("likelihood").value);
                var riskLevel = impactValue * likelihoodValue;

                document.getElementById("risklevel").value = riskLevel;

                var riskPlanDiv = document.getElementById("risk-is-risk-treatment-plan");
                var riskAfterDiv = document.getElementById("risk-is-consequences-after-treatment");

                if (riskLevel > 16) {
                    document.getElementById("risklevel").style.backgroundColor = "#FF5757";
                    document.getElementById("risklevel").style.color = "black";
                    riskPlanDiv.style.display = "block";
                    riskAfterDiv.style.display = "block";
                } else if (riskLevel >= 10) {
                    document.getElementById("risklevel").style.backgroundColor = "#FF9E62";
                    document.getElementById("risklevel").style.color = "black";
                    riskPlanDiv.style.display = "block";
                    riskAfterDiv.style.display = "block";
                } else if (riskLevel >= 5) {
                    document.getElementById("risklevel").style.backgroundColor = "#FFDE59";
                    document.getElementById("risklevel").style.color = "black";
                    riskPlanDiv.style.display = "block";
                    riskAfterDiv.style.display = "block";
                } else if (riskLevel <= 4) {
                    document.getElementById("risklevel").style.backgroundColor = "#5FD19A";
                    document.getElementById("risklevel").style.color = "black";
                    riskPlanDiv.style.display = "none";
                    riskAfterDiv.style.display = "none";
                } else {
                    document.getElementById("risklevel").style.backgroundColor = "";
                }
            }
        </script>
        <!-- ถ้าหาก risk level มีการเปลี่ยนแปลง การซ่อนและแสดง risk-is-risk-treatment-plan และ risk-is-consequences-after-treatment จะเปลี่ยนแปลงไปด้วย -->
        <!-- risk-level-not-over -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll("select.select-impact-residual").forEach(function(select) {
                    select.addEventListener("change", showMaxValueInImpactResidual);
                });

                document.getElementById("likelihood2").addEventListener("input", calResidual);
            });

            function showMaxValueInImpactResidual() {
                var maxValue = findMaxValue("select.select-impact-residual");
                document.getElementById("impact2").value = maxValue;
                calResidual();
            }

            function findMaxValue(selector) {
                var selects = document.querySelectorAll(selector);
                var maxValue = 0;

                selects.forEach(function(select) {
                    var value = parseInt(select.value);
                    if (value > maxValue) {
                        maxValue = value;
                    }
                });
                return maxValue;
            }

            function calResidual() {
                var impactValue2 = parseFloat(document.getElementById("impact2").value);
                var likelihoodValue2 = parseFloat(document.getElementById("likelihood2").value);
                var residual = impactValue2 * likelihoodValue2;

                document.getElementById("residual").value = residual;

                if (residual > 16) {
                    document.getElementById("residual").style.backgroundColor = "#FF5757";
                    document.getElementById("residual").style.color = "black";
                } else if (residual >= 10) {
                    document.getElementById("residual").style.backgroundColor = "#FF9E62";
                    document.getElementById("residual").style.color = "black";
                } else if (residual >= 5) {
                    document.getElementById("residual").style.backgroundColor = "#FFDE59";
                    document.getElementById("residual").style.color = "black";
                } else if (residual <= 4) {
                    document.getElementById("residual").style.backgroundColor = "#5FD19A";
                    document.getElementById("residual").style.color = "black";
                } else {
                    document.getElementById("residual").style.backgroundColor = "";
                }
            }
        </script>
        <script>
            $(document).ready(function() {
                // ซ่อน input เมื่อโหลดหน้าเว็บ
                $('#input-othertype').hide();

                // เมื่อเปลี่ยนการเลือกของเมนู dropdown
                $('select.custom-select').change(function() {
                    // ถ้าเลือกตัวเลือก "Other (please specify)"
                    if ($(this).val() == '8') {
                        // แสดง input
                        $('#input-othertype').show();
                    } else {
                        // ซ่อน input
                        $('#input-othertype').hide();
                    }
                });
            });
        </script>