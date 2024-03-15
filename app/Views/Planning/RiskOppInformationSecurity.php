<title>Address risks & opportunities</title>

<style>
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

    .custom-select {
        background-color: #fff;
        border: 1px solid #007BFF;
        color: #007BFF;
        font-size: 14px;
        padding: .375rem .75rem;
        margin-bottom: 10px;
    }
</style>
<?php
$consequenceData = ["CENTRAL", "INTELLIGENCE", "AGENCY"];
$consequenceData2 = ["CENTRAL", "INTELLIGENCE", "AGENCY"];
?>

<!-- Main content -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Details</h2>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a
                    href="<?= site_url('context/context_analysis/index/') ?>"
                    style="color: #ADB5BD;">Version</a></button>
            <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;">
                <a href="<?= site_url('context/ISObjective/timeline_log/') ?>" style="color: #ADB5BD;">History</a>
            </button>
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
                    href="#" onclick="load_modal(4)">Create Note</a>
            </div>

            <i class="fas fa-cog" data-toggle="modal" data-target="#modal-default" id="load-modal-button"
                onclick="load_modal(2)"></i>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row justify-content-center mb-2">
                <div class="col-sm-3 ">
                    <h6>Version:
                        <span class="blue-text">
                            <?php echo $data['num_ver']; ?>
                        </span>
                    </h6>
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
                    <h6>Approved Date:
                        <span class="gray-text">
                            <?php echo $data['approved_date']; ?>
                        </span>
                    </h6>
                </div>
            </div>
            <div class="row justify-content-center mb-2">
                <div class="col-sm-3 ">
                    <h6>Modified Date:
                        <span class="gray-text">
                            <?php echo $data['modified_date']; ?>
                        </span>
                    </h6>
                </div>
                <div class="col-sm-3 ">
                    <h6>Last Reviewed:
                        <span class="gray-text">
                            <?php echo $data['review_date']; ?>
                        </span>
                    </h6>
                </div>
                <div class="col-sm-3 ">
                    <h6>Announce Date:
                        <span class="gray-text">
                            <?php echo $data['announce_date']; ?>
                        </span>
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card" id="information-security-ana">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <div class="form-group">
                    <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                        <li class="nav-item-tab" style="padding-right: 10px;">
                            <a class="nav-link active" id="risk-information-security-tab" data-toggle="pill"
                                href="#risk-information-security" role="tab" aria-controls="risk-information-security"
                                aria-selected="true">Risk</a>
                        </li>
                        <li class="nav-item-tab">
                            <a class="nav-link" id="opportunity-information-security-tab" data-toggle="pill"
                                href="#opportunity-information-security" role="tab"
                                aria-controls="opportunity-information-security" aria-selected="false">Opportunity</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class=" d-flex">
                <div id="btn-Awareness" name="btn-Awareness">
                    <button type="button" class="btn btn-outline-primary" onclick="CRUDInformationSecurityRiskOpp()">
                        <span class="text-nowrap"><i class="fas fa-edit"></i>Create Information Security</span>
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="risk-information-security" role="tabpanel"
                aria-labelledby="org-strategy-tab">
                <div class="d-flex justify-content-start align-items-center" id="information-security-risk-table">
                    <span>Content:</span>
                    <div class="col-4 d-flex">
                        <select class="custom-select" id="select-content">
                            <option selected>Select Content</option>
                            <option value="1">Risks that must be prepared as a risk treatment plan.</option>
                            <option value="2">Risks that do not have risks exceeding the risk assessment level.</option>
                            <option value="3">Risks that are being done risk treatment.</option>
                            <option value="4">Risks that have completed risk treatment</option>
                            <option value="5">All risk context.</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="custom-select" id="table-is-display-select">
                            <option value="full-table-is">Full Table</option>
                            <option value="short-table-is">Short Table</option>
                        </select>
                    </div>
                </div>
                <div class="table-wrapper">
                    <table id="risk-information-security-table-full" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ACTION</th>
                                <th>NO.</th>
                                <th>TYPE</th>
                                <th>ASSET GROUP</th>
                                <th>THREAT</th>
                                <th style="max-width: 200px;">VULNERABILITY</th>
                                <th>EXISTING CONTROLS</th>
                                <?php
                                foreach ($consequenceData as $data_) {
                                    echo "<th>$data_</th>";
                                }
                                ?>
                                <th>CONSEQUENCE</th>
                                <th>LIKELIHOOD</th>
                                <th>RISK LEVEL</th>
                                <th>RISK ASSESSMENT LEVEL</th>
                                <th>RISK OPTIONS</th>
                                <th>RISK TREATMENT PLAN</th>
                                <th>RISK OWNER</th>
                                <th>START DATE</th>
                                <th>END DATE</th>
                                <th>APPROVE</th>
                                <th>RTP STATUS</th>
                                <th>FILE</th>
                                <?php
                                foreach ($consequenceData2 as $data_) {
                                    echo "<th>$data_</th>";
                                }
                                ?>
                                <th>CONSEQUENCE</th>
                                <th>LIKELIHOOD</th>
                                <th>RESIDUAL</th>
                            </tr>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table id="risk-information-security-table-short" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ACTION</th>
                                <th>NO.</th>
                                <th>TYPE</th>
                                <th>ASSET GROUP</th>
                                <th>CONSEQUENCE</th>
                                <th>LIKELIHOOD</th>
                                <th>RISK LEVEL</th>
                                <th>RISK OPTIONS</th>
                                <th>RISK TREATMENT PLAN</th>
                                <th>RISK OWNER</th>
                                <th>RESIDUAL</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tab-pane table-wrapper fade show" id="opportunity-information-security" role="tabpanel"
                aria-labelledby="opportunity-information-security-tab">
                <table id="opp-information-security-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ACTION</th>
                            <th>NO.</th>
                            <th>TYPE</th>
                            <th>ASSET GROUP</th>
                            <th>QUANTITY OF PLANNING</th>
                            <th>OPPORTUNITY PLANNINGS</th>
                            <th>OPPORTUNITIES OWNNER</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th>FILE</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="overlay dark">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div> -->
</div>

<script>
    // ดึงข้อมูลมาจากตาราง risk level minimum maximum color  
    function getRiskColor(result) {
        if (result <= 4) {
            return "#92D050";
        } else if (result <= 9) {
            return "#FFFF00";
        } else if (result <= 19) {
            return "#FFC000";
        } else if (result > 19) {
            return "#FD2B2B";
        } else {
            return ""; // คืนค่าว่างให้กลับไป
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectElement = document.getElementById('table-is-display-select');
        var fullTable = document.getElementById('risk-information-security-table-full');
        var shortTable = document.getElementById('risk-information-security-table-short');

        if (!selectElement || !fullTable || !shortTable) {
            console.error('อิเล็กเมนต์หรือตารางไม่ถูกต้อง');
            return;
        }

        fullTable.style.display = 'block';
        shortTable.style.display = 'none';

        selectElement.addEventListener('change', function (e) {
            var selectedValue = e.target.value;

            if (selectedValue === 'full-table-is') {
                fullTable.style.display = 'block';
                shortTable.style.display = 'none';
            } else if (selectedValue === 'short-table-is') {
                fullTable.style.display = 'none';
                shortTable.style.display = 'block';
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var contentRiskTable = document.getElementById('information-security-risk-table');
        var riskInformationSecurityTab = document.getElementById('risk-information-security-tab');

        contentRiskTable.style.display = 'none';

        riskInformationSecurityTab.addEventListener('click', function () {
            contentRiskTable.style.display = 'flex';
        });

        var opportunityInformationSecurityTab = document.getElementById('opportunity-information-security-tab');

        opportunityInformationSecurityTab.addEventListener('click', function () {
            contentRiskTable.style.display = 'none';
        });
    });
</script>
<script>
    var Data = [{
        "TYPE": "Hardward",
        "ASSET_GROUP": "Computer",
        "THREAT": "	การขอความยินยอมไม่ถูกต้อง",
        "VULNERABILITY": "ขาดการขอความยินยอมข้อมูลส่วนบุคคลแบบเป็นลายลักษณ์อักษร",
        "EXISTING_CONTROLS": "มีกระบวนการดำเนินการในการขอความยินยอมข้อมูลส่วนบุคคลแบบเป็นลายลักษณ์อักษร",
        "CONFIDENTIALITY": "3",
        "INTEGRITY": "2",
        "AVAILABILITY": "1",
        "CONSEQUENCE": "3",
        "LIKELIHOOD": "2",
        "RISK_LEVEL": "6",
        "RISK_ASSESSMENT_LEVEL": "2",
        "RISK_OPTIONS": "การยอมรับความเสี่ยง",
        "RISK_TREATMENT_PLAN": "จัดทำเอกสาร Configuration baseline",
        "OPP_OWNNER": "Areeya.D",
        "START_DATE": "01/01/2024",
        "END_DATE": "01/01/2024",
        "APPROVE": "Areeya.D",
        "RTP_STATUS": "รอดำเนินการ",
        "FILE": "FILE",
        "CONFIDENTIALITY2": "1",
        "INTEGRITY2": "2",
        "AVAILABILITY2": "2",
        "CONSEQUENCE2": "2",
        "LIKELIHOOD2": "2",
        "RESIDUAL": "4",
    },
    {
        "TYPE": "Hardward",
        "ASSET_GROUP": "Computer",
        "THREAT": "	การขอความยินยอมไม่ถูกต้อง",
        "VULNERABILITY": "ขาดการขอความยินยอมข้อมูลส่วนบุคคลแบบเป็นลายลักษณ์อักษร",
        "EXISTING_CONTROLS": "มีกระบวนการดำเนินการในการขอความยินยอมข้อมูลส่วนบุคคลแบบเป็นลายลักษณ์อักษร",
        "CONFIDENTIALITY": "3",
        "INTEGRITY": "2",
        "AVAILABILITY": "1",
        "CONSEQUENCE": "3",
        "LIKELIHOOD": "2",
        "RISK_LEVEL": "6",
        "RISK_ASSESSMENT_LEVEL": "2",
        "RISK_OPTIONS": "การยอมรับความเสี่ยง",
        "RISK_TREATMENT_PLAN": "จัดทำเอกสาร Configuration baseline",
        "OPP_OWNNER": "Areeya.D",
        "START_DATE": "01/01/2024",
        "END_DATE": "01/01/2024",
        "APPROVE": "Areeya.D",
        "RTP_STATUS": "กำลังดำเนินการ",
        "FILE": "FILE",
        "CONFIDENTIALITY2": "1",
        "INTEGRITY2": "2",
        "AVAILABILITY2": "2",
        "CONSEQUENCE2": "2",
        "LIKELIHOOD2": "2",
        "RESIDUAL": "4",
    },
    ];

    var riskcontextfull = document.getElementById("risk-information-security-table-full").getElementsByTagName("tbody")[0];

    Data.forEach(function (row, index) {
        var newRow = riskcontextfull.insertRow();
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        var cell7 = newRow.insertCell(6);
        var cell8 = newRow.insertCell(7);
        var cell9 = newRow.insertCell(8);
        var cell10 = newRow.insertCell(9);
        var cell11 = newRow.insertCell(10);
        var cell12 = newRow.insertCell(11);
        var cell13 = newRow.insertCell(12);
        var cell14 = newRow.insertCell(13);
        var cell15 = newRow.insertCell(14);
        var cell16 = newRow.insertCell(15);
        var cell17 = newRow.insertCell(16);
        var cell18 = newRow.insertCell(17);
        var cell19 = newRow.insertCell(18);
        var cell20 = newRow.insertCell(19);
        var cell21 = newRow.insertCell(20);
        var cell22 = newRow.insertCell(21);
        var cell23 = newRow.insertCell(22);
        var cell24 = newRow.insertCell(23);
        var cell25 = newRow.insertCell(24);
        var cell26 = newRow.insertCell(25);
        var cell27 = newRow.insertCell(26);
        var cell28 = newRow.insertCell(27);

        cell1.innerHTML = `<div class="dropdown">
                                <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
                                <li data-toggle="modal" data-target="#modal-default" onclick="CRUDInformationSecurityRiskOpp()"><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">View</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li data-toggle="modal" data-target="#modal-default" onclick="CRUDInformationSecurityRiskOpp()"><a class="dropdown-item" href="#">Create</a></li>
                                </ul>
                            </div>`;
        cell2.textContent = index + 1;
        cell3.textContent = row.TYPE;
        cell4.textContent = row.ASSET_GROUP;
        cell5.textContent = row.THREAT;
        cell6.textContent = row.VULNERABILITY;
        cell7.textContent = row.EXISTING_CONTROLS;
        cell8.textContent = row.CONFIDENTIALITY;
        cell9.textContent = row.INTEGRITY;
        cell10.textContent = row.AVAILABILITY;
        cell11.textContent = row.CONSEQUENCE;
        cell12.textContent = row.LIKELIHOOD;
        cell13.textContent = row.RISK_LEVEL;
        cell13.style.backgroundColor = getRiskColor(parseInt(row.RISK_LEVEL));
        cell14.textContent = row.RISK_ASSESSMENT_LEVEL;
        cell15.textContent = row.RISK_OPTIONS;
        cell16.textContent = row.RISK_TREATMENT_PLAN;
        cell17.textContent = row.OPP_OWNNER;
        cell18.textContent = row.START_DATE;
        cell19.textContent = row.END_DATE;
        cell20.textContent = row.APPROVE;
        cell21.innerHTML = row.RTP_STATUS === 'รอดำเนินการ' ? '<span class="badge badge-danger">รอดำเนินการ</span>' : row.RTP_STATUS === 'กำลังดำเนินการ' ? '<span class="badge badge-warning">กำลังดำเนินการ</span>' : row.RTP_STATUS === 'กำลังดำเนินการ' ? '<span class="badge badge-warning">กำลังดำเนินการ</span>' : '';
        cell22.textContent = row.FILE;
        cell23.textContent = row.CONFIDENTIALITY2;
        cell24.textContent = row.INTEGRITY2;
        cell25.textContent = row.AVAILABILITY2;
        cell26.textContent = row.CONSEQUENCE2;
        cell27.textContent = row.LIKELIHOOD2;
        cell28.textContent = row.RESIDUAL;
        cell28.style.backgroundColor = row.RESIDUAL ? getRiskColor(parseInt(row.RESIDUAL)) : "";
    });
</script>
<script>
    var Data = [
        {
            "TYPE": "Hardward",
            "ASSET_GROUP": "Computer",
            "CONSEQUENCE": "3",
            "LIKELIHOOD": "2",
            "RISK_LEVEL": "6",
            "RISK_OPTIONS": "การลดความเสี่ยง",
            "RISK_TREATMENT_PLAN": "ดำเนินการจัดทำเอกสาร Configuration baseline",
            "OPP_OWNNER": "Areeya.D",
            "RESIDUAL": "4",
        },];

    var riskinformationsecurityshort = document.getElementById("risk-information-security-table-short").getElementsByTagName("tbody")[0];

    Data.forEach(function (row, index) {
        var newRow = riskinformationsecurityshort.insertRow();
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        var cell7 = newRow.insertCell(6);
        var cell8 = newRow.insertCell(7);
        var cell9 = newRow.insertCell(8);
        var cell10 = newRow.insertCell(9);
        var cell11 = newRow.insertCell(10);

        cell1.innerHTML = `<div class="dropdown">
    <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
        <li data-toggle="modal" data-target="#modal-default" onclick="CRUDInformationSecurityRiskOpp()"><a class="dropdown-item" href="#">Edit</a></li>
        <li><a class="dropdown-item" href="#">View</a></li>
        <li><a class="dropdown-item" href="#">Delete</a></li>
        <li><hr class="dropdown-divider"></li>
        <li data-toggle="modal" data-target="#modal-default" onclick="CRUDInformationSecurityRiskOpp()"><a class="dropdown-item" href="#">Create</a></li>
        </ul>
    </div>`;
        cell2.textContent = index + 1;
        cell3.textContent = row.TYPE;
        cell4.textContent = row.ASSET_GROUP;
        cell5.textContent = row.CONSEQUENCE;
        cell6.textContent = row.LIKELIHOOD;
        cell7.textContent = row.RISK_LEVEL;
        cell7.style.backgroundColor = getRiskColor(parseInt(row.RISK_LEVEL));
        cell8.textContent = row.RISK_OPTIONS;
        cell9.textContent = row.RISK_TREATMENT_PLAN;
        cell10.textContent = row.OPP_OWNNER;
        cell11.textContent = row.RESIDUAL;
        cell11.style.backgroundColor = row.RESIDUAL ? getRiskColor(parseInt(row.RESIDUAL)) : "";
    });
</script>
<script>
    var Data = [
        {
            "TYPE": "text",
            "ASSET_GROUP": "text",
            "QUANTITY_PLANNING": "1",
            "OPPORTUNITY_PLANNINGS": ["OPPORTUNITY PLANNINGS1", "OPPORTUNITY PLANNINGS2"],
            "OPP_OWNNER": ["Areeya", "Jennifer"],
            "START_DATE": ["01/01/2024", "01/01/2024"],
            "END_DATE": ["01/01/2024", "01/01/2024"],
            "ATTACHMENTFILE": ["file1.pdf", "file1.pdf"],
        },
        {
            "TYPE": "text",
            "ASSET_GROUP": "text",
            "QUANTITY_PLANNING": "1",
            "OPPORTUNITY_PLANNINGS": ["OPPORTUNITY PLANNINGS1", "OPPORTUNITY PLANNINGS2"],
            "OPP_OWNNER": ["Areeya", "Jennifer"],
            "START_DATE": ["01/01/2024", "01/01/2024"],
            "END_DATE": ["01/01/2024", "01/01/2024"],
            "ATTACHMENTFILE": ["file1.pdf", "file1.pdf"],
        },
        {
            "TYPE": "text",
            "ASSET_GROUP": "text",
            "QUANTITY_PLANNING": "1",
            "OPPORTUNITY_PLANNINGS": ["OPPORTUNITY PLANNINGS1", "OPPORTUNITY PLANNINGS2"],
            "OPP_OWNNER": ["Areeya", "Jennifer"],
            "START_DATE": ["01/01/2024", "01/01/2024"],
            "END_DATE": ["01/01/2024", "01/01/2024"],
            "ATTACHMENTFILE": ["file1.pdf", "file1.pdf"],
        },
    ];

    var oppisTableBody = document.getElementById("opp-information-security-table").getElementsByTagName("tbody")[0];

    Data.forEach(function (row, index) {
        var newRow = oppisTableBody.insertRow();
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        var cell7 = newRow.insertCell(6);
        var cell8 = newRow.insertCell(7);
        var cell9 = newRow.insertCell(8);
        var cell10 = newRow.insertCell(9);


        cell1.innerHTML = `<div class="dropdown">
    <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
        <li data-toggle="modal" data-target="#modal-default" onclick="CRUDInformationSecurityRiskOpp()"><a class="dropdown-item" href="#">Edit</a></li>
        <li><a class="dropdown-item" href="#">Copy</a></li>
        <li><a class="dropdown-item" href="#">Delete</a></li>
        <li><hr class="dropdown-divider"></li>
        <li data-toggle="modal" data-target="#modal-default" onclick="CRUDInformationSecurityRiskOpp()"><a class="dropdown-item" href="#">Create</a></li>
        </ul>
    </div>`;
        cell2.textContent = index + 1;
        cell3.textContent = row.TYPE;
        cell4.textContent = row.ASSET_GROUP;
        displayArrayInCell(cell5, row.QUANTITY_PLANNING);
        displayArrayInCell(cell6, row.OPPORTUNITY_PLANNINGS);
        displayArrayInCell(cell7, row.OPP_OWNNER);
        displayArrayInCell(cell8, row.START_DATE);
        displayArrayInCell(cell9, row.END_DATE);
        displayArrayInCell(cell10, row.ATTACHMENTFILE);

    });

    function displayArrayInCell(cell, dataArray) {
        if (Array.isArray(dataArray) && dataArray.length > 1) {
            cell.innerHTML = dataArray.join('<br>');
        } else {
            cell.textContent = Array.isArray(dataArray) ? dataArray[0] : dataArray;
        }
    }
</script>
<script>
    function CRUDInformationSecurityRiskOpp() {
        window.location.href = "crud_is_risk_opp";
    }
</script>