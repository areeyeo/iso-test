<title>Risk Criteria IS</title>
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
                <div class="">
                    <h3>&nbsp;Risk Criteria IS</h3>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>Risk Level</h4>
                        </div>
                        <div class="d-flex justify-content-center mt-3 mb-3" id="risklevelmaxtrix">
                            <table class="table table-bordered">
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

                        <div class="risklevel table-wrapper">
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
                                <button type="button" class="btn btn-outline-primary mt-3 mb-3" data-toggle="modal" data-target="#modal-risk-level" onclick="load_modal(1)">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Risk Level
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
<div class="modal fade" id="modal-risk-level">
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
            "DESCRIPTION": "ระดับความเสี่ยงที่องค์กรยอมรับ (Acceptable) อาจมีมาตรการที่มีอยู่แล้วป้องกันหรือไม่ก็ได้",
            "RISK COLOR": "#92D050",
            "TEXT COLOR": "#000000",
            "MINIMUM": 1,
            "MAXIMUM": 4,
            "RISK ASSESSMENT LEVEL": ""
        },
        {
            "RISK LEVEL": "น้อย",
            "DESCRIPTION": "ระดับความเสี่ยงที่องค์กรสามารถยอมรับได้ แต่ต้องมีการควบคุม เพื่อป้องกันไม่ให้ความเสี่ยงมีค่าสูงขึ้นไปยังระดับที่ไม่สามารถยอมรับได้",
            "RISK COLOR": "#FFF700",
            "TEXT COLOR": "#000000",
            "MINIMUM": 5,
            "MAXIMUM": 9,
            "RISK ASSESSMENT LEVEL": ""
        },
        {
            "RISK LEVEL": "ปานกลาง",
            "DESCRIPTION": "ระดับความเสี่ยงที่องค์กรไม่สามารถยอมรับได้ โดยต้องจัดการความเสี่ยงเพื่อให้อยู่ในระดับที่สามารถยอมรับหรือยอมรับได้ต่อไป",
            "RISK COLOR": "#FFC000",
            "TEXT COLOR": "#000000",
            "MINIMUM": 10,
            "MAXIMUM": 16,
            "RISK ASSESSMENT LEVEL": ""
        },
        {
            "RISK LEVEL": "สูง",
            "DESCRIPTION": "ระดับความเสี่ยงที่องค์กรไม่สามารถยอมรับได้ และต้องจำเป็นต้องเร่งจัดการความเสี่ยงจนกระทั่งให้อยู่ในระดับที่สามารถยอมรับได้ทันที",
            "RISK COLOR": "#FD2B2B",
            "TEXT COLOR": "#ffffff",
            "MINIMUM": 17,
            "MAXIMUM": 25,
            "RISK ASSESSMENT LEVEL": ""
        }
    ];

    var risklevelTableBody1 = document.getElementById("risklevel1").getElementsByTagName("tbody")[0];
    Data.forEach(function(row, index) {
        var newRow1 = risklevelTableBody1.insertRow();
        var cell1_1 = newRow1.insertCell(0);
        var cell2_1 = newRow1.insertCell(1);
        var cell3_1 = newRow1.insertCell(2);

        cell1_1.textContent = index + 1;
        cell2_1.textContent = row["RISK LEVEL"];
        cell2_1.style.backgroundColor = row["RISK COLOR"];
        cell2_1.style.color = row["TEXT COLOR"];
        cell3_1.textContent = row["DESCRIPTION"];
    });

    var risklevelTableBody2 = document.getElementById("risklevel2").getElementsByTagName("tbody")[0];
    Data.forEach(function(row, index) {
        var newRow2 = risklevelTableBody2.insertRow();
        var cell1_2 = newRow2.insertCell(0);
        var cell2_2 = newRow2.insertCell(1);
        var cell3_2 = newRow2.insertCell(2);
        var cell4_2 = newRow2.insertCell(3);
        var cell5_2 = newRow2.insertCell(4);
        var cell6_2 = newRow2.insertCell(5);
        var cell7_2 = newRow2.insertCell(6);

        cell1_2.innerHTML =`<div class="dropdown">
                                <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
                                <li data-toggle="modal" data-target="#modal-is " onclick="load_modal(2)"><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li data-toggle="modal" data-target="#modal-is " onclick="load_modal(2)"><a class="dropdown-item" href="#">Create</a></li>
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