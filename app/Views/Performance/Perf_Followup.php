<!DOCTYPE html>
<html lang="en">
<style>
    th {
        background-color: #F5F6FA;
        text-align: center;
        border-bottom: none;
    }

    tbody {
        border-bottom: 10px;
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

    .text-color {
        color: #316497;
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

    .accordion-item {
        border-bottom: 1px solid #ddd;
    }

    .accordion-title {
        padding: 20px;
        background-color: #BEDEFF;
        color: #818181;
        font-size: 1.2em;
        cursor: pointer;
        position: relative;
        border-radius: 10px;
        transition: background-color 0.3s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .accordion-title:hover {
        background-color: #E1F0FF;
    }

    .accordion-item.active .accordion-title {
        background-color: #E1F0FF;
    }

    .accordion-content {
        padding: 10px;
        display: none;
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.5s ease-out;
    }

    .accordion-item.active .accordion-content {
        display: block;
        max-height: 500px;
    }

    .accordion-item.active .accordion-content {
        animation: fadeIn 0.5s ease-out;
    }

    .accordion-title::before {
        content: '+';
        display: inline-block;
        margin-right: 10px;
        font-size: 1.2em;
        transition: transform 0.5s ease;
        transform-origin: center;
    }

    .accordion-title::before {
        content: '+';
        display: inline-block;
        margin-right: 10px;
        font-size: 1.2em;
        transition: transform 0.3s ease;
        transform-origin: center;
    }

    .accordion-item.active .accordion-title::before {
        content: '-';
        transform: rotate(180deg);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<body>
    <!-- section version -->
    <section>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Details</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a href="<?= site_url('context/context_analysis/index/') ?>" style="color: #ADB5BD;">Version</a></button>
                    <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;">
                        <a href="<?= site_url('context/ISObjective/timeline_log/') ?>" style="color: #ADB5BD;">History</a>
                    </button>
                    <button class="badge badge-edit" style="background-color: #007BFF; color: #ffffff; border: 1px solid #007BFF" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                            <div class="dropdown-menu">
                                <!-- Second-level dropdown items -->
                                <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Reviewed หรือไม่', 'context/status_update/id_version ?>/1')">Pending Review</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Review หรือไม่', 'context/status_update/id_version ?>/2')">Review</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button">Reject Review</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Approve หรือไม่', 'context/status_update/id_version ?>/3')">Pending
                                    Approve</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Approved หรือไม่', 'context/status_update/id_version ?>/4')">Approved</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(4)">Reject Approved</a>
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
                        <a class="dropdown-item" data-toggle="modal" data-target="#modal-default" id="load-modal-button">Create Note</a>
                    </div>

                    <i class="fas fa-cog" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)"></i>
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
    </section>

    <!-- section followup -->
    <section>
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <h4>Follow-up</h4>
                        <button type="button" class="btn btn-outline-primary" style="margin-inline-start: auto;" data-toggle="modal" data-target="#modal-default" onclick="load_modal(12)">
                            <i class="fas fa-edit"></i>&nbsp;&nbsp;Create Follow-up
                        </button>
                    </div>
                    <hr>
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-title">Inconsistent</div>
                            <div class="accordion-content">
                                <table id="examplefollow1" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ACTION</th>
                                            <th>AR NO.</th>
                                            <th>NON-INCONSISTENT ISSUE</th>
                                            <th>CORRECTIVE ACTION</th>
                                            <th>RESPONSIBLE PERSON</th>
                                            <th>START DATE</th>
                                            <th>END DATE</th>
                                            <th>STATUS</th>
                                            <th>ANNUAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <div class="accordion-title">Observation</div>
                            <div class="accordion-content">
                                <div class="table-wrapper">
                                    <table id="examplefollow2" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ACTION</th>
                                                <th>AR NO.</th>
                                                <th>NON-OBSERVATION ISSUE</th>
                                                <th>CORRECTIVE ACTION</th>
                                                <th>RESPONSIBLE PERSON</th>
                                                <th>START DATE</th>
                                                <th>END DATE</th>
                                                <th>STATUS</th>
                                                <th>ANNUAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <div class="accordion-title">Opportunity</div>
                            <div class="accordion-content">
                                <div class="table-wrapper">
                                    <table id="examplefollow3" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ACTION</th>
                                                <th>AR NO.</th>
                                                <th>NON-OPPORTUNITY ISSUE</th>
                                                <th>CORRECTIVE ACTION</th>
                                                <th>RESPONSIBLE PERSON</th>
                                                <th>START DATE</th>
                                                <th>END DATE</th>
                                                <th>STATUS</th>
                                                <th>ANNUAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- open close tab -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const items = document.querySelectorAll('.accordion-item');

            items.forEach(item => {
                const title = item.querySelector('.accordion-title');
                title.addEventListener('click', () => {
                    items.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('active')) {
                            otherItem.classList.remove('active');
                            otherItem.querySelector('.accordion-content').style.display = 'none';
                        }
                    });

                    item.classList.toggle('active');
                    const content = item.querySelector('.accordion-content');
                    content.style.display = content.style.display === 'block' ? 'none' : 'block';
                });
            });
        });
    </script>

    <!-- table data inconsistent -->
    <script>
        var Data = [{
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "INCONSISTENT": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "รอดำเนินการ",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "INCONSISTENT": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "ดำเนินการไม่เสร็จสิ้น",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "INCONSISTENT": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "กำลังดำเนินการ",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "INCONSISTENT": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "ดำเนินการเสร็จสิ้น",
                "ANNUAL": "2567",
            },
        ];

        var examplefollow1TableBody = document.getElementById("examplefollow1").getElementsByTagName("tbody")[0];

        Data.forEach(function(row, index) {
            var newRow = examplefollow1TableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);
            var cell7 = newRow.insertCell(6);
            var cell8 = newRow.insertCell(7);
            var cell9 = newRow.insertCell(8);

            cell1.innerHTML = `<div class="dropdown">
    <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
      <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(3)"><a class="dropdown-item" href="#">Edit</a></li>
      <li><a class="dropdown-item" href="#">Copy</a></li>
      <li><a class="dropdown-item" href="#">Delete</a></li>
      <li><hr class="dropdown-divider"></li>
      <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(3)"><a class="dropdown-item" href="#">Create</a></li>
    </ul>
  </div>`;
            cell2.textContent = row.ARNO;
            cell3.textContent = row.INCONSISTENT;
            cell4.textContent = row.CORRECTIVE;
            cell5.textContent = row.RESPONSIBLEPERSON;
            cell6.textContent = row.STARTDATE;
            cell7.textContent = row.ENDDATE;
            cell8.innerHTML = row.STATUS === 'รอดำเนินการ' ? '<span class="badge badge-dark">รอดำเนินการ</span>' :
                row.STATUS === 'ดำเนินการไม่เสร็จสิ้น' ? '<span class="badge badge-danger">ดำเนินการไม่เสร็จสิ้น</span>' :
                row.STATUS === 'กำลังดำเนินการ' ? '<span class="badge badge-warning">กำลังดำเนินการ</span>' :
                row.STATUS === 'ดำเนินการเสร็จสิ้น' ? '<span class="badge badge-success">ดำเนินการเสร็จสิ้น</span>' : '';
            cell9.textContent = row.ANNUAL;
        });
    </script>

    <!-- table data observation -->
    <script>
        var Data = [{
            "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "OBSERVATION": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "รอดำเนินการ",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "OBSERVATION": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "ดำเนินการไม่เสร็จสิ้น",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "OBSERVATION": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "กำลังดำเนินการ",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "OBSERVATION": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "ดำเนินการเสร็จสิ้น",
                "ANNUAL": "2567",
            },
        ];

        var examplefollow2TableBody = document.getElementById("examplefollow2").getElementsByTagName("tbody")[0];

        Data.forEach(function(row, index) {
            var newRow = examplefollow2TableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);
            var cell7 = newRow.insertCell(6);
            var cell8 = newRow.insertCell(7);
            var cell9 = newRow.insertCell(8);

            cell1.innerHTML = `<div class="dropdown">
    <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
      <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(3)"><a class="dropdown-item" href="#">Edit</a></li>
      <li><a class="dropdown-item" href="#">Copy</a></li>
      <li><a class="dropdown-item" href="#">Delete</a></li>
      <li><hr class="dropdown-divider"></li>
      <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(3)"><a class="dropdown-item" href="#">Create</a></li>
    </ul>
  </div>`;
            cell2.textContent = row.ARNO;
            cell3.textContent = row.OBSERVATION;
            cell4.textContent = row.CORRECTIVE;
            cell5.textContent = row.RESPONSIBLEPERSON;
            cell6.textContent = row.STARTDATE;
            cell7.textContent = row.ENDDATE;
            cell8.innerHTML = row.STATUS === 'รอดำเนินการ' ? '<span class="badge badge-dark">รอดำเนินการ</span>' :
                row.STATUS === 'ดำเนินการไม่เสร็จสิ้น' ? '<span class="badge badge-danger">ดำเนินการไม่เสร็จสิ้น</span>' :
                row.STATUS === 'กำลังดำเนินการ' ? '<span class="badge badge-warning">กำลังดำเนินการ</span>' :
                row.STATUS === 'ดำเนินการเสร็จสิ้น' ? '<span class="badge badge-success">ดำเนินการเสร็จสิ้น</span>' : '';
            cell9.textContent = row.ANNUAL;
        });
    </script>

    <!-- table data opportunity -->
    <script>
        var Data = [{
            "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "OPPORTUNITY": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "รอดำเนินการ",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "OPPORTUNITY": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "ดำเนินการไม่เสร็จสิ้น",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "OPPORTUNITY": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "กำลังดำเนินการ",
                "ANNUAL": "2567",
            },
            {
                "ARNO": "AR_001 รายงานโปรเจคตัวอย่างที่ 1",
                "OPPORTUNITY": "TEXT",
                "CORRECTIVE": "TEXT",
                "RESPONSIBLEPERSON": "TEXT",
                "STARTDATE": "01/01/2024",
                "ENDDATE": "01/01/2024",
                "STATUS": "ดำเนินการเสร็จสิ้น",
                "ANNUAL": "2567",
            },
        ];

        var examplefollow3TableBody = document.getElementById("examplefollow3").getElementsByTagName("tbody")[0];

        Data.forEach(function(row, index) {
            var newRow = examplefollow3TableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);
            var cell7 = newRow.insertCell(6);
            var cell8 = newRow.insertCell(7);
            var cell9 = newRow.insertCell(8);

            cell1.innerHTML = `<div class="dropdown">
    <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButton${index}" data-toggle="dropdown" aria-expanded="false"></i>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton${index}">
      <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(3)"><a class="dropdown-item" href="#">Edit</a></li>
      <li><a class="dropdown-item" href="#">Copy</a></li>
      <li><a class="dropdown-item" href="#">Delete</a></li>
      <li><hr class="dropdown-divider"></li>
      <li data-toggle="modal" data-target="#modal-default" onclick="load_modal(3)"><a class="dropdown-item" href="#">Create</a></li>
    </ul>
  </div>`;
            cell2.textContent = row.ARNO;
            cell3.textContent = row.OPPORTUNITY;
            cell4.textContent = row.CORRECTIVE;
            cell5.textContent = row.RESPONSIBLEPERSON;
            cell6.textContent = row.STARTDATE;
            cell7.textContent = row.ENDDATE;
            cell8.textContent = row.STATUS;
            cell8.innerHTML = row.STATUS === 'รอดำเนินการ' ? '<span class="badge badge-dark">รอดำเนินการ</span>' :
                row.STATUS === 'ดำเนินการไม่เสร็จสิ้น' ? '<span class="badge badge-danger">ดำเนินการไม่เสร็จสิ้น</span>' :
                row.STATUS === 'กำลังดำเนินการ' ? '<span class="badge badge-warning">กำลังดำเนินการ</span>' :
                row.STATUS === 'ดำเนินการเสร็จสิ้น' ? '<span class="badge badge-success">ดำเนินการเสร็จสิ้น</span>' : '';
            cell9.textContent = row.ANNUAL;
        });
    </script>
</body>

</html>