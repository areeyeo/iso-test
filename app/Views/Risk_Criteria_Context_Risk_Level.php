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

    #risklevel2 td:nth-child(3),
    #risklevel2 td:nth-child(4) {
        background-color: var(--color);
    }

    .risk-matrix {
        border-collapse: collapse;
        width: 100%;
    }

    .risk-matrix td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }
</style>
<style>
    tbody {
        text-align: center;
    }
    th[rowspan] {
        vertical-align: middle;
    }
</style>
<?php
$likelihoodData = [
    ["น้อยมาก", 1],
    ["น้อย", 2],
    ["ปาดกลาง", 3],
    ["สูง", 4],
    ["สูงมาก", 5]
];

$impactData = [
    ["น้อยมาก", 1],
    ["น้อย", 2],
    ["ปาดกลาง", 3],
    ["สูง", 4],
    ["สูงมาก", 5]
];

function getRiskColor($result){
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
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>Risk Level</h4>

                        </div>
                        <!-- <div class="d-flex justify-content-center mb-3" id="risklevelmaxtrix-test"></div> -->
                        <div class="d-flex justify-content-center mb-3" id="risklevelmaxtrix">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px" class="text-center" rowspan="2" colspan="2"></th>
                                        <th style="width: 130px" class="text-center" colspan="8">ผลกระทบ</th>
                                    </tr>
                                    <tr>
                                        <?php foreach ($impactData as $impact): ?>
                                            <th class="text-center">
                                                <?= $impact[0] ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <th rowspan="6">โอกาสเกิด</th>
                                        </tr>
                                    <?php foreach ($likelihoodData as $likelihood): ?>
                                        <tr>
                                            <th class="text-center">
                                                <?= $likelihood[0] ?>
                                            </th>
                                            <?php foreach ($impactData as $impact): ?>
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
                        <div class="risklevel">
                            <table id="risklevel1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>RISK LEVEL</th>
                                        <th>DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="risklevel-management">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary mt-3 mb-3" data-toggle="modal"
                                    data-target="#modal-risk-option" onclick="load_modal(1)">
                                    <i class="fas fa-edit"></i>&nbsp;&nbsp;Create Risk Level
                                </button>
                            </div>
                            <table id="risklevel2" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ACTION</th>
                                        <th>RISK LEVEL</th>
                                        <th>RISK COLOR</th>
                                        <th>TEXT COLOR</th>
                                        <th>MINIMUM</th>
                                        <th>MAXIMUM</th>
                                        <th>RISK ASSESSMENT LEVEL</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
<div class="modal fade" id="modal-risk-option">
    <div id="modal_crud_criteria_risk_level">
    </div>
</div>
<script>
    function load_modal(check, check_type, data_encode) {
        console.log('Function is called with check:', check, 'and check_type:', check_type);

        modal_crud_criteria_risk_level = document.getElementById("modal_crud_criteria_risk_level");
        $(".modal-body #iss").empty();

        if (check == '1') {
            //--show modal requirment--//
            console.log('Showing modal 1');;
            modal_crud_criteria_risk_level.style.display = "block";
        }
    }
</script>
<script>
    var Data = [{
        "RISK LEVEL": "น้อยมาก",
        "DESCRIPTION": "การรักษาความเสี่ยง",
        "RISK COLOR": "#92D050",
        "TEXT COLOR": "#000000",
        "MINIMUM": 1,
        "MAXIMUM": 4,
        "RISK ASSESSMENT LEVEL": ""
    },
    {
        "RISK LEVEL": "น้อย",
        "DESCRIPTION": "การปรับเปลี่ยนความเสี่ยง",
        "RISK COLOR": "#FFF700",
        "TEXT COLOR": "#000000",
        "MINIMUM": 5,
        "MAXIMUM": 9,
        "RISK ASSESSMENT LEVEL": ""
    },
    {
        "RISK LEVEL": "ปาดกลาง",
        "DESCRIPTION": "การหลีกเลี่ยงความเสี่ยง",
        "RISK COLOR": "#FFC000",
        "TEXT COLOR": "#000000",
        "MINIMUM": 10,
        "MAXIMUM": 16,
        "RISK ASSESSMENT LEVEL": ""
    },
    {
        "RISK LEVEL": "สูง",
        "DESCRIPTION": "การแบ่งปันความเสี่ยง",
        "RISK COLOR": "#FD2B2B",
        "TEXT COLOR": "#ffffff",
        "MINIMUM": 17,
        "MAXIMUM": 25,
        "RISK ASSESSMENT LEVEL": ""
    }
    ];

    var risklevelTableBody1 = document.getElementById("risklevel1").getElementsByTagName("tbody")[0];
    Data.forEach(function (row, index) {
        var newRow1 = risklevelTableBody1.insertRow();
        var cell1_1 = newRow1.insertCell(0);
        var cell2_1 = newRow1.insertCell(1);
        var cell3_1 = newRow1.insertCell(2);

        cell1_1.textContent = index + 1;
        cell2_1.textContent = row["RISK LEVEL"];
        cell3_1.textContent = row["DESCRIPTION"];
    });

    var risklevelTableBody2 = document.getElementById("risklevel2").getElementsByTagName("tbody")[0];
    Data.forEach(function (row, index) {
        var newRow2 = risklevelTableBody2.insertRow();
        var cell1_2 = newRow2.insertCell(0);
        var cell2_2 = newRow2.insertCell(1);
        var cell3_2 = newRow2.insertCell(2);
        var cell4_2 = newRow2.insertCell(3);
        var cell5_2 = newRow2.insertCell(4);
        var cell6_2 = newRow2.insertCell(5);
        var cell7_2 = newRow2.insertCell(6);

        cell1_2.innerHTML = `
            <div class="dropdown">
                <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
                    <li data-toggle="modal" data-target="#modal-likelihood" onclick="load_modal(1)"><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Delete</a></li>
                </ul>
            </div>`;
        cell2_2.textContent = row["RISK LEVEL"];
        cell3_2.style.backgroundColor = row["RISK COLOR"];
        cell4_2.style.backgroundColor = row["TEXT COLOR"];
        cell5_2.textContent = row["MINIMUM"];
        cell6_2.textContent = row["MAXIMUM"];
        cell7_2.innerHTML = `<input type="radio" id="radio${index}_1" name="riskAssessment" value="${index}">`;
    });
</script>
<!-- risk-matrix -->
<!-- <script>
    var likelihoodData = [
        ["น้อยมาก", 1],
        ["น้อย", 2],
        ["ปาดกลาง", 3],
        ["สูง", 4],
        ["สูงมาก", 5]
    ];

    var impactData = [
        ["น้อยมาก", 1],
        ["น้อย", 2],
        ["ปาดกลาง", 3],
        ["สูง", 4],
        ["สูงมาก", 5]
    ];

    var riskMatrixTable = document.createElement("table");
    riskMatrixTable.className = "risk-matrix";

    for (var i = 0; i < likelihoodData.length + 1; i++) {
        var row = document.createElement("tr");

        for (var j = 0; j < impactData.length + 1; j++) {
            var cell = document.createElement("td");

            if (i === 0 && j === 0) {
                cell.textContent = "Impact/Likelihood";
            } else if (i === 0) {
                cell.textContent = likelihoodData[j - 1][0] + " (" + (j) + ")";
            } else if (j === 0) {
                cell.textContent = impactData[i - 1][0] + " (" + (i) + ")";
            } else {
                var riskScore = impactData[i - 1][1] * likelihoodData[j - 1][1];
                var color = getRiskColor(riskScore);
                cell.textContent = riskScore;
                cell.style.backgroundColor = color;
            }
            row.appendChild(cell);
        }
        riskMatrixTable.appendChild(row);
    }


    var risklevelMatrixDiv = document.getElementById("risklevelmaxtrix");
    risklevelMatrixDiv.appendChild(riskMatrixTable);

    function getRiskColor(riskScore) {
        if (riskScore <= 5) {
            return "#92D050";
        } else if (riskScore <= 10) {
            return "#FFFF00";
        } else if (riskScore <= 15) {
            return "#FFC000";
        } else {
            return "#FD2B2B";
        }
    }
</script> -->
<!-- <script>
    var likelihoodData = [
        ["", ""],
        ["น้อยมาก", 1],
        ["น้อย", 2],
        ["ปาดกลาง", 3],
        ["สูง", 4],
        ["สูงมาก", 5]
    ];

    var impactData = [
        ["", ""],
        ["", ""],
        ["น้อยมาก", 1],
        ["น้อย", 2],
        ["ปาดกลาง", 3],
        ["สูง", 4],
        ["สูงมาก", 5]
    ];

    var riskMatrixTable = document.createElement("table");
    riskMatrixTable.className = "risk-matrix";

    var likelihoodHeaderRow = document.createElement("tr");
    var likelihoodHeaderCell = document.createElement("td");
    likelihoodHeaderCell.setAttribute("colspan", impactData.length + 1);
    likelihoodHeaderCell.textContent = "ผลกระทบ";
    likelihoodHeaderRow.appendChild(likelihoodHeaderCell);
    riskMatrixTable.appendChild(likelihoodHeaderRow);


    var likelihoodHeaderRow = document.createElement("tr");
    var likelihoodHeaderCell = document.createElement("td");
    likelihoodHeaderCell.setAttribute("rowspan", likelihoodData.length);
    likelihoodHeaderCell.textContent = "โอกาสเกิด";
    likelihoodHeaderRow.appendChild(likelihoodHeaderCell);

    for (var i = 0; i < impactData.length; i++) {
        var emptyCell = document.createElement("td");
        likelihoodHeaderRow.appendChild(emptyCell);
    }

    riskMatrixTable.appendChild(likelihoodHeaderRow);

    likelihoodData.forEach(function(likelihood, likelihoodIndex) {
        var row = document.createElement("tr");
        if (likelihoodIndex === 0) {
            var emptyCell = document.createElement("td");
            row.appendChild(emptyCell);
        } else {
            var likelihoodCell = document.createElement("td");
            likelihoodCell.textContent = likelihood[0] + " " + "(" + likelihood[1] + ")";
            row.appendChild(likelihoodCell);
        }

        impactData.forEach(function(impact, impactIndex) {
            var cell = document.createElement("td");
            if (likelihoodIndex === 0 && impactIndex === 0) {
                cell.textContent = "";
            } else if (likelihoodIndex === 0) {
                cell.textContent = impact[0];
            } else if (impactIndex === 0) {
                cell.textContent = likelihood[0];
            } else {
                var riskScore = impact[1] * likelihood[1];
                cell.textContent = riskScore;
                cell.style.backgroundColor = getRiskColor(riskScore);
            }
            row.appendChild(cell);
        });

        riskMatrixTable.appendChild(row);
    });

    var risklevelMatrixDiv = document.getElementById("risklevelmaxtrix-test");
    risklevelMatrixDiv.appendChild(riskMatrixTable);

    function getRiskColor(riskScore) {
        if (riskScore <= 5) {
            return "#92D050";
        } else if (riskScore <= 10) {
            return "#FFFF00";
        } else if (riskScore <= 15) {
            return "#FFC000";
        } else {
            return "#FD2B2B";
        }
    }
</script> -->