<title>RA & RTP Result IS</title>
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

    /* CSS สำหรับหน้าจอขนาดกลาง */
    @media (min-width: 992px) and (max-width: 1200px) {
        table {
            font-size: 10px; /* กำหนดขนาดตัวอักษรในตารางเมื่อเป็นหน้าจอขนาดกลาง */
        }
    }
    @media (max-width: 522px) {
        table {
            font-size: 7px; /* กำหนดขนาดตัวอักษรในตารางเมื่อเป็นหน้าจอขนาดกลาง */
        }
    }

    @media (max-width: 378px) {
        table {
            font-size: 5px; /* กำหนดขนาดตัวอักษรในตารางเมื่อเป็นหน้าจอขนาดกลาง */
        }
    }
</style>
<?php
// ข้อมูลจากหน้า likelihood
$likelihoodData = [
    ["น้อยมาก", 1],
    ["น้อย", 2],
    ["ปานกลาง", 3],
    ["สูง", 4],
    ["สูงมาก", 5]
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
                            RA & RTP Result IS
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                                data-target="#modal-default" id="load-modal-button">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a>RA & RTP Result IS</a></li>
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
                        <h2 class="card-title">Create Context Risk & Opportunities</h2>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group mt-2">
                                        <h6>Issue</h6>
                                        <select class="custom-select">
                                            <option selected>Select Issue</option>
                                            <option value="1">item1</option>
                                            <option value="2">item1</option>
                                            <option value="3">item1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mt-2">
                                        <h6>Risk / Opportunities</h6>
                                        <div class="d-flex mt-3">
                                            <div class="form-check" style="margin-right: 30px;">
                                                <input class="form-check-input" type="radio" name="exampleRadios"
                                                    id="riskRadio" value="option1" checked>
                                                <label class="form-check-label" for="riskRadio">
                                                    Risk
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios"
                                                    id="oppRadio" value="option2">
                                                <label class="form-check-label" for="oppRadio">
                                                    Opportunities
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="risk-context">
                                <div class="mt-3" id="risk-context-consequences">
                                    <h6>Consequences</h6>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Operational</h6>
                                                <select class="custom-select select-impact-risk"
                                                    id="operational-select">
                                                    <option selected>Select Operational</option>
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
                                                <h6>Productivity</h6>
                                                <select class="custom-select select-impact-risk"
                                                    id="productivity-select">
                                                    <option selected>Select Productivity</option>
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
                                                <h6>Reputation</h6>
                                                <select class="custom-select select-impact-risk" id="reputation-select">
                                                    <option selected>Select Reputation</option>
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
                                                <h6>Compliance</h6>
                                                <select class="custom-select select-impact-risk" id="compliance-select">
                                                    <option selected>Select Compliance</option>
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
                                                <h6>Privacy</h6>
                                                <select class="custom-select select-impact-risk" id="privacy-select">
                                                    <option selected>Select Privacy</option>
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
                                                <input class="form-control gray-text" type="number" name="impact"
                                                    id="impact" readonly></input>
                                            </div>
                                            <div class="form-group mt-4">
                                                <h6>Likelihood</h6>
                                                <select class="custom-select" id="likelihood">
                                                    <option selected>Select Likelihood</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-4">
                                                <h6>Risk Level</h6>
                                                <input class="form-control gray-text" type="number" name="risklevel"
                                                    id="risklevel" readonly></input>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px;background-color: #fff;"
                                                            class="text-center" rowspan="2" colspan="2"></th>
                                                        <th style="width: 130px; background-color: #658ABF;color: floralwhite; font-weight: 500;"
                                                            class="text-center" colspan="8">
                                                            <div>ผลกระทบ</div>
                                                            <div style="font-size:90%;">(Impact)</div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <?php foreach ($impactData as $impact): ?>
                                                            <th class="text-center "
                                                                style="background-color: #E2EEFF; font-weight: 400;">
                                                                <?= $impact[0] ?> (
                                                                <?= $impact[1] ?>)
                                                            </th>
                                                        <?php endforeach; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th rowspan="6"
                                                            style="background-color: #658ABF; color: floralwhite; font-weight: 500; text-align: center;">
                                                            <div>โอกาสเกิด</div>
                                                            <div style="font-size:90%;">(Likelihood)</div>
                                                        </th>
                                                    </tr>

                                                    <?php foreach ($likelihoodData as $likelihood): ?>
                                                        <tr>
                                                            <th class="text-center"
                                                                style="background-color: #E2EEFF; font-weight: 400;">
                                                                <?= $likelihood[0] ?> (
                                                                <?= $likelihood[1] ?>)
                                                            </th>
                                                            <?php foreach ($impactData as $impact): ?>
                                                                <?php $result = $impact[1] * $likelihood[1] ?>
                                                                <td class="text-center"
                                                                    style="background-color: <?= getRiskColor($result) ?>">
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
                                <div class="" id="risk-context-risk-treatment-plan" style="display: none;">
                                    <h6>Risk Treatment Plan</h6>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group mt-2">
                                                <h6>Risk Option</h6>
                                                <select class="custom-select" id="risk-option">
                                                    <option selected>Select Option</option>
                                                    <option value="1">Risk Treatment (การรักษาความเสี่ยง)</option>
                                                    <option value="2">Risk Modification (การปรับเปลี่ยนความเสี่ยง)
                                                    </option>
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
                                                <textarea class="form-control gray-text" rows="5" placeholder="Text..."
                                                    name="risktreatmentplan" id="risktreatmentplan"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-2">
                                            <div class="form-group mt-2">
                                                <h6>Risk Owner</h6>
                                                <input class="form-control gray-text" type="text" placeholder="Text..."
                                                    name="riskowner" id="riskowner"></input>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mt-3">
                                                        <h6>Start Date</h6>
                                                        <input class="form-control gray-text" type="date"
                                                            name="startdate" id="startdate"></input>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mt-3">
                                                        <h6>End Date</h6>
                                                        <input class="form-control gray-text" type="date" name="enddate"
                                                            id="enddate"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <h6>Attach File</h6>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="risk-file"
                                                        accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520"
                                                        name="file">
                                                    <label class="custom-file-label" for="risk-file">Choose file</label>
                                                </div>
                                                <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3" id="risk-context-consequences-after-treatment" style="display: none;">
                                    <h6>Consequences (After Treatment)</h6>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="form-group mt-2">
                                                <h6>Operational</h6>
                                                <select class="custom-select select-impact-residual"
                                                    id="operational-select2">
                                                    <option selected>Select Operational</option>
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
                                                <h6>Productivity</h6>
                                                <select class="custom-select select-impact-residual"
                                                    id="productivity-select2">
                                                    <option selected>Select Productivity</option>
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
                                                <h6>Reputation</h6>
                                                <select class="custom-select select-impact-residual"
                                                    id="reputation-select2">
                                                    <option selected>Select Reputation</option>
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
                                                <h6>Compliance</h6>
                                                <select class="custom-select select-impact-residual"
                                                    id="compliance-select2">
                                                    <option selected>Select Compliance</option>
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
                                                <h6>Privacy</h6>
                                                <select class="custom-select select-impact-residual"
                                                    id="privacy-select2">
                                                    <option selected>Select Privacy</option>
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
                                                <input class="form-control gray-text" type="number" name="impact2"
                                                    id="impact2" readonly></input>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Likelihood</h6>
                                                <input class="form-control gray-text" type="number" name="likelihood2"
                                                    id="likelihood2"></input>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mt-2">
                                                <h6>Residual</h6>
                                                <input class="form-control gray-text" type="number" name="residual"
                                                    id="residual" readonly></input>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="opportunities-context">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mt-3">
                                            <h6>Opportunity planning</h6>
                                            <textarea class="form-control gray-text" rows="5" placeholder="Text..."
                                                name="risktreatmentplan" id="risktreatmentplan"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-2">
                                        <div class="form-group mt-2">
                                            <h6>Opportunities Owner</h6>
                                            <input class="form-control gray-text" type="text" placeholder="Text..."
                                                name="riskowner" id="riskowner"></input>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mt-3">
                                                    <h6>Start Date</h6>
                                                    <input class="form-control gray-text" type="date" name="startdate"
                                                        id="startdate"></input>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-3">
                                                    <h6>End Date</h6>
                                                    <input class="form-control gray-text" type="date" name="enddate"
                                                        id="enddate"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <h6>Attach File</h6>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="opportunities-file"
                                                    accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520"
                                                    name="file">
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            style="margin-left: 30px;">Cancel</button>
                    </div>
                </div>
            </div>


        </section>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var riskRadio = document.getElementById("riskRadio");
                var opportunitiesRadio = document.getElementById("oppRadio");
                var riskContext = document.getElementById("risk-context");
                var opportunitiesContext = document.getElementById("opportunities-context");

                riskRadio.addEventListener("change", function () {
                    if (riskRadio.checked) {
                        riskContext.style.display = "block";
                        opportunitiesContext.style.display = "none";
                    }
                });

                opportunitiesRadio.addEventListener("change", function () {
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
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll("select.select-impact-risk").forEach(function (select) {
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

                selects.forEach(function (select) {
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

                var riskPlanDiv = document.getElementById("risk-context-risk-treatment-plan");
                var riskAfterDiv = document.getElementById("risk-context-consequences-after-treatment");

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
        <!-- ถ้าหาก risk level มีการเปลี่ยนแปลง การซ่อนและแสดง risk-context-risk-treatment-plan และ risk-context-consequences-after-treatment จะเปลี่ยนแปลงไปด้วย -->
        <!-- risk-level-not-over -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll("select.select-impact-residual").forEach(function (select) {
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

                selects.forEach(function (select) {
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