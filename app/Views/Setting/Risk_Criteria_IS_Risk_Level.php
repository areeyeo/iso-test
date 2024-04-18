<title>Risk Criteria IS</title>
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
function getRiskColor($result, $data)
{
    if (!empty($data)) {
        foreach ($data as $key => $value) {
            if ($result <= $value['maximum']) {
                return $value['risk_color'];
            }
        }
    } else {
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
} ?>
<?php
function getTextColor($result, $data)
{
    if (!empty($data)) {
        foreach ($data as $key => $value) {
            if ($result <= $value['maximum']) {
                return $value['text_color'];
            }
        }
    } else {
        return '#000000';
    }
} ?>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="">
                    <h3>&nbsp;Risk Criteria Information Security</h3>
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
                        <div class="" id="risklevelmaxtrix" style="overflow-x:auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;background-color: #fff;" class="text-center" rowspan="2"
                                            colspan="2"></th>
                                        <th style="width: 130px; background-color: #658ABF;color: floralwhite; font-weight: 500;"
                                            class="text-center" colspan="<?= count($Likelihood_level_is) ?>">
                                            <div>ผลกระทบ</div>
                                            <div style="font-size:90%;">(Impact)</div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <?php foreach ($Likelihood_level_is as $impact): ?>
                                            <th class="text-center " style="background-color: #E2EEFF; font-weight: 400;">
                                                <?= $impact['likelihood_name'] ?> (
                                                <?= $impact['likelihood_level'] ?>)
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th rowspan="<?= count($Likelihood_level_is) + 1 ?>"
                                            style="background-color: #658ABF; color: floralwhite; font-weight: 500; text-align: center;">
                                            <div>โอกาสเกิด</div>
                                            <div style="font-size:90%;">(Likelihood)</div>
                                        </th>
                                    </tr>
                                    <?php foreach ($Likelihood_level_is as $likelihood): ?>
                                        <tr>
                                            <th class="text-center" style="background-color: #E2EEFF; font-weight: 400;">
                                                <?= $likelihood['likelihood_name'] ?> (
                                                <?= $likelihood['likelihood_level'] ?>)
                                            </th>
                                            <?php foreach ($Likelihood_level_is as $impact): ?>
                                                <?php $result = $impact['likelihood_level'] * $likelihood['likelihood_level'] ?>
                                                <td class="text-center"
                                                    style="background-color: <?= getRiskColor($result, $Risk_level_is) ?>; color: <?= getTextColor($result, $Risk_level_is) ?>">
                                                    <?= $result ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="risklevel table-wrapper mt-3">
                            <table id="risklevel1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NO.</th>
                                        <th>RISK LEVEL</th>
                                        <th>DESCRIPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Risk_level_is as $key => $risk): ?>
                                        <tr>
                                            <td>
                                                <?= $key + 1 ?>
                                            </td>
                                            <td style="background-color: <?= $risk['risk_color'] ?>">
                                                <?= $risk['risk_level'] ?>
                                            </td>
                                            <td>
                                                <?= $risk['description'] ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="risklevel-management">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary mt-3 mb-3" data-toggle="modal"
                                    data-target="#modal-risk-level" onclick="load_modal(1)">
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
                                <tbody>
                                    <?php foreach ($Risk_level_is as $key => $risk): ?>
                                        <tr>
                                            <td>
                                                <div class="dropdown">
                                                    <i class="fas fa-ellipsis-v pointer text-primary"
                                                        id="dropdownMenuButton_<?= $key ?>" data-toggle="dropdown"
                                                        aria-expanded="false"></i>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton_<?= $key ?>">
                                                        <li data-toggle="modal" data-target="#modal-risk-level"
                                                            onclick="load_modal(2,<?= $key ?>)"><a
                                                                class="dropdown-item">Edit</a></li>
                                                        <li><a class="dropdown-item"
                                                                onclick="confirm_Alert('Do you want to delete risk level <?= $risk['risk_level'] ?> ?', 'planning/risk_Criteria_IS_Risk_Level/delete/<?= $risk['id_risk_level_is'] ?>')">Delete</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li data-toggle="modal" data-target="#modal-risk-level"
                                                            onclick="load_modal(1)"><a class="dropdown-item">Create</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <?= $risk['risk_level'] ?>
                                            </td>
                                            <td style="background-color: <?= $risk['risk_color'] ?>">
                                            </td>
                                            <td style="background-color: <?= $risk['text_color'] ?>">
                                            </td>
                                            <td>
                                                <?= $risk['minimum'] ?>
                                            </td>
                                            <td>
                                                <?= $risk['maximum'] ?>
                                            </td>
                                            <td>
                                                <input type="radio" id="radio_<?= $key ?>" name="riskAssessment"
                                                    <?= $risk['risk_assessment_level'] == 1 ? "checked" : "" ?>
                                                    onclick="change_assessment_level('planning/risk_Criteria_IS_Risk_Level/change_assessment_level/<?= $risk['id_risk_level_is'] ?>')">
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
<div class="modal fade" id="modal-risk-level">
    <div id="modal_crud_criteria_risk_levell">
        <?= $this->include("Modal/CRUD_Criteria_IS_Risk_Level"); ?>
    </div>
</div>
<script>
    function load_modal(check, check_type, data_encode) {
        modal_crud_criteria_risk_levell = document.getElementById("modal_crud_criteria_risk_levell");
        $(".modal-body #risklevel").val('');
        $(".modal-body #minranges").val('');
        $(".modal-body #maxranges").val('');
        $(".modal-body #description").val('');
        var risk_levell_data = <?php echo json_encode($Risk_level_is); ?>;

        if (check == '1') {
            //--show modal risk Level--//
            modal_crud_criteria_risk_levell.style.display = "block";
            $(".modal-body #url_route").val("planning/risk_Criteria_IS_Risk_Level/create");
        } else if (check == '2') {
            modal_crud_criteria_risk_levell.style.display = "block";
            $(".modal-body #risklevel").val(risk_levell_data[check_type]['risk_level']);
            $(".modal-body #riskcolor").val(risk_levell_data[check_type]['risk_color']);
            $(".modal-body #textcolor").val(risk_levell_data[check_type]['text_color']);
            $(".modal-body #minranges").val(risk_levell_data[check_type]['minimum']);
            $(".modal-body #maxranges").val(risk_levell_data[check_type]['maximum']);
            $(".modal-body #description").val(risk_levell_data[check_type]['description']);
            $(".modal-body #url_route").val("planning/risk_Criteria_IS_Risk_Level/edit/" + risk_levell_data[check_type]['id_risk_level_is']);
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
                if (response.success) {
                    Swal.fire({
                        title: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        allowOutsideClick: true
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
    function confirm_Alert(text, url) {
        Swal.fire({
            title: text,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Submit",
            preConfirm: () => {
                return $.ajax({
                    url: '<?= base_url() ?>' + url,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
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
                }).then(function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: false
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
                });
            }
        });
    }
</script>
<script>
    function change_assessment_level(url) {
        $.ajax({
            url: '<?= base_url() ?>' + url,
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Change Risk Assessment Level Success.'
                })
            }
        });
    }
</script>