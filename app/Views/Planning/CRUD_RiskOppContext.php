<title>RA & RTP Result IS</title>
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
<?php if ($data_risk === null && $data_opportunity === null) {
    $check_edit_or_create = '';
} else {
    $check_edit_or_create = 'hidden';
} ?>
<?php if ($viewMode) {
    $disabled_view = 'disabled';
} else {
    $disabled_view = '';
} ?>


<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            RA & RTP Result IS
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('planning/planningAddressRisksOpp/context/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Address
                                    risks & opportunities Version
                                    <?= $data['num_ver'] ?>
                                </a></li>
                            <?php if ($data_risk == null && $data_opportunity == null) : ?>
                                <li class="breadcrumb-item"><a>Create Context Risk & Opportunities</a></li>
                            <?php elseif ($data_risk != null && $data_opportunity == null) : ?>
                                <?php if ($viewMode) : ?>
                                    <li class="breadcrumb-item"><a>View Context Risk</a></li>
                                <?php else : ?>
                                    <li class="breadcrumb-item"><a>Edit Context Risk</a></li>
                                <?php endif; ?>
                            <?php elseif ($data_risk == null && $data_opportunity != null) : ?>
                                <?php if ($viewMode) : ?>
                                    <li class="breadcrumb-item"><a>View Context Opportunity</a></li>
                                <?php else : ?>
                                    <li class="breadcrumb-item"><a>Edit Context Opportunity</a></li>
                                <?php endif; ?>
                            <?php endif; ?>
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
                        <?php if ($data_risk === null && $data_opportunity === null) : ?>
                            <h2 class="card-title">Create Context Risk & Opportunities</h2>
                        <?php elseif ($data_risk !== null && $data_opportunity === null) : ?>
                            <?php if ($viewMode) : ?>
                                <h2 class="card-title">View Context Risk</h2>
                            <?php else : ?>
                                <h2 class="card-title">Edit Context Risk</h2>
                            <?php endif; ?>
                        <?php elseif ($data_risk === null && $data_opportunity !== null) : ?>
                            <?php if ($viewMode) : ?>
                                <h2 class="card-title">View Context Risk</h2>
                            <?php else : ?>
                                <h2 class="card-title">Edit Context Risk</h2>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <form class="mb-3" id="form_address" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group mt-2">
                                            <h6>Issue</h6>
                                            <select class="custom-select" id="issue" name="issue" <?= $disabled_view ?>>
                                                <?php if ($internal_data != null) : ?>
                                                    <optgroup label="Internal">
                                                        <?php foreach ($internal_data as $key => $value) : ?>
                                                            <?php if ($data_risk !== null) : ?>
                                                                <?php if ($value['internal_issues']['topic'] == $data_risk['issue']) : ?>
                                                                    <option value="<?= $value['internal_issues']['topic'] ?>" selected>
                                                                        <?= $value['internal_issues']['topic'] ?>
                                                                    </option>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['internal_issues']['topic'] ?>">
                                                                        <?= $value['internal_issues']['topic'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php elseif ($data_opportunity !== null) : ?>
                                                                <?php if ($value['internal_issues']['topic'] == $data_opportunity['issue']) : ?>
                                                                    <option value="<?= $value['internal_issues']['topic'] ?>" selected>
                                                                        <?= $value['internal_issues']['topic'] ?>
                                                                    </option>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['internal_issues']['topic'] ?>">
                                                                        <?= $value['internal_issues']['topic'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <option value="<?= $value['internal_issues']['topic'] ?>">
                                                                    <?= $value['internal_issues']['topic'] ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </optgroup>
                                                <?php endif; ?>
                                                <?php if ($external_data != null) : ?>
                                                    <optgroup label="External">
                                                        <?php foreach ($external_data as $key => $value) : ?>
                                                            <?php if ($data_risk !== null) : ?>
                                                                <?php if ($value['external_issues']['topic'] == $data_risk['issue']) : ?>
                                                                    <option value="<?= $value['external_issues']['topic'] ?>" selected>
                                                                        <?= $value['external_issues']['topic'] ?>
                                                                    </option>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['external_issues']['topic'] ?>">
                                                                        <?= $value['external_issues']['topic'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php elseif ($data_opportunity !== null) : ?>
                                                                <?php if ($value['external_issues']['topic'] == $data_opportunity['issue']) : ?>
                                                                    <option value="<?= $value['external_issues']['topic'] ?>" selected>
                                                                        <?= $value['external_issues']['topic'] ?>
                                                                    </option>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['external_issues']['topic'] ?>">
                                                                        <?= $value['external_issues']['topic'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <option value="<?= $value['external_issues']['topic'] ?>">
                                                                    <?= $value['external_issues']['topic'] ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </optgroup>
                                                <?php endif; ?>
                                                <?php if ($interested_data !== null) : ?>
                                                    <optgroup label="Interested Party">
                                                        <?php foreach ($interested_data as $key => $value) : ?>
                                                            <?php if ($data_risk !== null) : ?>
                                                                <?php if ($value['interested_issues']['topic'] == $data_risk['issue']) : ?>
                                                                    <option value="<?= $value['interested_issues']['topic'] ?>" selected>
                                                                        <?= $value['interested_issues']['topic'] ?>
                                                                    </option>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['interested_issues']['topic'] ?>">
                                                                        <?= $value['interested_issues']['topic'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php elseif ($data_opportunity !== null) : ?>
                                                                <?php if ($value['interested_issues']['topic'] == $data_opportunity['issue']) : ?>
                                                                    <option value="<?= $value['interested_issues']['topic'] ?>" selected>
                                                                        <?= $value['interested_issues']['topic'] ?>
                                                                    </option>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['interested_issues']['topic'] ?>">
                                                                        <?= $value['interested_issues']['topic'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <option value="<?= $value['interested_issues']['topic'] ?>">
                                                                    <?= $value['interested_issues']['topic'] ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </optgroup>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mt-2" <?= $check_edit_or_create ?>>
                                            <h6>Risk / Opportunities</h6>
                                            <div class="d-flex mt-3">
                                                <div class="form-check" style="margin-right: 30px;">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="riskRadio" value="option1" <?php if ($data_risk !== null || ($data_opportunity === null && $data_risk === null)) : echo 'checked';
                                                                                                                                                        endif ?>>
                                                    <label class="form-check-label" for="riskRadio">
                                                        Risk
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="oppRadio" value="option2" <?php if ($data_opportunity !== null) : echo 'checked';
                                                                                                                                                    endif ?>>
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
                                            <?php if (!empty($consequence_level_context)) : ?>
                                                <?php foreach ($consequence_level_context as $key => $consequenceData) : ?>
                                                    <div class="col-lg-4">
                                                        <div class="form-group mt-2">
                                                            <h6>
                                                                <?= $consequenceData['consequence_name']; ?>
                                                            </h6>
                                                            <select class="custom-select select-impact-risk" id="operational-select_<?= $key; ?>" name="operational_<?= $key; ?>" <?= $disabled_view ?>>
                                                                <?php if ($data_risk !== null) : $check = false ?>
                                                                    <option value="0" selected>Select Operational</option>
                                                                    <?php foreach ($consequenceData['data_item'] as $operational) : ?>
                                                                        <?php $risk_consequenc = explode(',', $data_risk['consequence']); ?>
                                                                        <?php if (in_array($consequenceData['id_consequence_level_context'] . '-' . $operational['impact_level'], $risk_consequenc)) : ?>
                                                                            <option value="<?= $consequenceData['id_consequence_level_context'] . '-' . $operational['impact_level']; ?>" selected>
                                                                                <?= $operational['impact_level']; ?>
                                                                            </option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $consequenceData['id_consequence_level_context'] . '-' . $operational['impact_level']; ?>">
                                                                                <?= $operational['impact_level']; ?>
                                                                            </option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <option value="0" selected>Select Operational</option>
                                                                    <?php foreach ($consequenceData['data_item'] as $operational) : ?>
                                                                        <option value="<?= $consequenceData['id_consequence_level_context'] . '-' . $operational['impact_level']; ?>">
                                                                            <?= $operational['impact_level']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
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
                                                    <select class="custom-select" id="likelihood" name="likelihood" <?= $disabled_view ?>>
                                                        <option value="0" selected>Select Likelihood</option>
                                                        <?php if (!empty($Likelihood_level_context)) : ?>
                                                            <?php foreach ($Likelihood_level_context as $key => $value) : ?>
                                                                <?php if ($data_risk !== null) : ?>
                                                                    <?php if ($data_risk['likelihood'] == $value['likelihood_level']) : ?>
                                                                        <option value="<?= $value['likelihood_level'] ?>" selected>
                                                                            <?= $value['likelihood_level'] ?>
                                                                        </option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $value['likelihood_level'] ?>">
                                                                            <?= $value['likelihood_level'] ?>
                                                                        </option>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['likelihood_level'] ?>">
                                                                        <?= $value['likelihood_level'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-4">
                                                    <h6>Risk Level</h6>
                                                    <input class="form-control gray-text" type="number" name="risklevel" id="risklevel" readonly></input>
                                                </div>
                                            </div>
                                            <?php if (!empty($Likelihood_level_context)) : ?>

                                                <div class="col-lg-6" style="overflow-x:auto;">
                                                    <table class="table table-bordered" style="font-size: 8pt">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px;background-color: #fff;" class="text-center" rowspan="2" colspan="2"></th>
                                                                <th style="width: 130px; background-color: #658ABF;color: floralwhite; font-weight: 500;" class="text-center" colspan="<?= count($Likelihood_level_context) ?>">
                                                                    <div>ผลกระทบ</div>
                                                                    <div style="font-size:90%;">(Impact)</div>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <?php foreach ($Likelihood_level_context as $impact) : ?>
                                                                    <th class="text-center " style="background-color: #E2EEFF; font-weight: 400;">
                                                                        <?= $impact['likelihood_name'] ?> (
                                                                        <?= $impact['likelihood_level'] ?>)
                                                                    </th>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th rowspan="<?= count($Likelihood_level_context) + 1 ?>" style="background-color: #658ABF; color: floralwhite; font-weight: 500; text-align: center;">
                                                                    <div>โอกาสเกิด</div>
                                                                    <div style="font-size:90%;">(Likelihood)</div>
                                                                </th>
                                                            </tr>
                                                            <?php foreach ($Likelihood_level_context as $likelihood) : ?>
                                                                <tr>
                                                                    <th class="text-center" style="background-color: #E2EEFF; font-weight: 400;">
                                                                        <?= $likelihood['likelihood_name'] ?> (
                                                                        <?= $likelihood['likelihood_level'] ?>)
                                                                    </th>
                                                                    <?php foreach ($Likelihood_level_context as $impact) : ?>
                                                                        <?php $result = $impact['likelihood_level'] * $likelihood['likelihood_level'] ?>
                                                                        <td class="text-center" style="background-color: <?= getRiskColor($result, $Risk_level_context) ?>; color: <?= getTextColor($result, $Risk_level_context) ?>">
                                                                            <?= $result ?>
                                                                        </td>
                                                                    <?php endforeach; ?>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="" id="risk-context-risk-treatment-plan" style="display: none;">
                                        <h6>Risk Treatment Plan</h6>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mt-2">
                                                    <h6>Risk Option</h6>
                                                    <select class="custom-select" id="risk-option" name="risk-option" <?= $disabled_view ?>>
                                                        <option selected value="0">Select Option</option>
                                                        <?php if (!empty($risk_options)) : ?>
                                                            <?php foreach ($risk_options as $key => $value) : ?>
                                                                <?php if ($data_risk !== null) : ?>
                                                                    <?php if ($data_risk['risk_options'] == $value['id_risk_options_context']) : ?>
                                                                        <option value="<?= $value['id_risk_options_context'] ?>" selected>
                                                                            <?= $value['options'] ?> (
                                                                            <?= $value['description'] ?>)
                                                                        </option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $value['id_risk_options_context'] ?>">
                                                                            <?= $value['options'] ?> (
                                                                            <?= $value['description'] ?>)
                                                                        </option>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['id_risk_options_context'] ?>">
                                                                        <?= $value['options'] ?> (
                                                                        <?= $value['description'] ?>)
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-2">
                                                    <h6>Name Of Risk Treatment Plan</h6>
                                                    <?php if ($data_risk !== null) : ?>
                                                        <input class="form-control" type="text" placeholder="Text..." name="name_of_risk_treatment_plan" id="name_of_risk_treatment_plan" value="<?= $data_risk['name_of_risk_treatment_plan'] ?>" <?= $disabled_view ?>></input>
                                                    <?php else : ?>
                                                        <input class="form-control" type="text" placeholder="Text..." name="name_of_risk_treatment_plan" id="name_of_risk_treatment_plan"></input>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-group mt-2">
                                                    <h6>Risk Owner</h6>
                                                    <?php if ($data_risk !== null) : ?>
                                                        <input class="form-control" type="text" placeholder="Text..." name="risk_owner" id="risk_owner" value="<?= $data_risk['risk_ownner'] ?>" <?= $disabled_view ?>></input>
                                                    <?php else : ?>
                                                        <input class="form-control" type="text" placeholder="Text..." name="risk_owner" id="risk_owner"></input>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mt-3">
                                                            <h6>Start Date</h6>
                                                            <?php if ($data_risk !== null) : ?>
                                                                <input class="form-control" type="date" name="startdate_context" id="startdate_context" <?= $disabled_view ?> value="<?= $data_risk['start_date'] ?>"></input>
                                                            <?php else : ?>
                                                                <input class="form-control" type="date" name="startdate_context" id="startdate_context"></input>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mt-3">
                                                            <h6>End Date</h6>
                                                            <?php if ($data_risk !== null) : ?>
                                                                <input class="form-control" type="date" name="enddate_context" id="enddate_context" <?= $disabled_view ?> value="<?= $data_risk['end_date'] ?>"></input>
                                                            <?php else : ?>
                                                                <input class="form-control" type="date" name="enddate_context" id="enddate_context"></input>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-3">
                                                    <h6>Detail</h6>
                                                    <?php if ($data_risk !== null) : ?>
                                                        <textarea class="form-control" rows="5" placeholder="Text..." name="risk_treatmentplan" id="risk_treatmentplan" <?= $disabled_view ?>><?= $data_risk['risk_treatment_plan'] ?></textarea>
                                                    <?php else : ?>
                                                        <textarea class="form-control" rows="5" placeholder="Text..." name="risk_treatmentplan" id="risk_treatmentplan"></textarea>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <h6>Attach File</h6>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="risk_file" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="risk_file" <?= $disabled_view ?>>
                                                        <label class="custom-file-label" for="risk-file">Choose
                                                            file</label>
                                                    </div>
                                                    <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mt-2">
                                                    <h6>Evaluation</h6>
                                                    <?php if ($data_risk !== null) : ?>
                                                        <input class="form-control" type="text" placeholder="Text..." name="evaluation" id="evaluation" value="<?= $data_risk['evaluation'] ?>" <?= $disabled_view ?>></input>
                                                    <?php else : ?>
                                                        <input class="form-control" type="text" placeholder="Text..." name="evaluation" id="evaluation"></input>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3" id="risk-context-consequences-after-treatment" style="display: none;">
                                        <h6>Consequences (After Treatment)</h6>
                                        <div class="row">
                                            <?php if (!empty($consequence_level_context)) : ?>
                                                <?php foreach ($consequence_level_context as $key => $consequenceData) : ?>
                                                    <div class="col-lg-2">
                                                        <div class="form-group mt-2">
                                                            <h6>
                                                                <?= $consequenceData['consequence_name']; ?>
                                                            </h6>
                                                            <select class="custom-select select-impact-residual" id="operational_after-select_<?= $key; ?>" name="operational_after_<?= $key; ?>" <?= $disabled_view ?>>
                                                                <?php if ($data_risk !== null) : $check = false ?>
                                                                    <option value="0" selected>Select Operational</option>
                                                                    <?php foreach ($consequenceData['data_item'] as $operational) : ?>
                                                                        <?php $risk_consequenc = explode(',', $data_risk['consequence_after']); ?>
                                                                        <?php if (in_array($consequenceData['id_consequence_level_context'] . '-' . $operational['impact_level'], $risk_consequenc)) : ?>
                                                                            <option value="<?= $consequenceData['id_consequence_level_context'] . '-' . $operational['impact_level']; ?>" selected>
                                                                                <?= $operational['impact_level']; ?>
                                                                            </option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $consequenceData['id_consequence_level_context'] . '-' . $operational['impact_level']; ?>">
                                                                                <?= $operational['impact_level']; ?>
                                                                            </option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <option value="0" selected>Select Operational</option>
                                                                    <?php foreach ($consequenceData['data_item'] as $operational) : ?>
                                                                        <option value="<?= $consequenceData['id_consequence_level_context'] . '-' . $operational['impact_level']; ?>">
                                                                            <?= $operational['impact_level']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
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
                                                    <select class="custom-select" id="likelihood2" name="likelihood2" <?= $disabled_view ?>>
                                                        <option value="0" selected>Select Likelihood</option>
                                                        <?php if (!empty($Likelihood_level_context)) : ?>
                                                            <?php foreach ($Likelihood_level_context as $key => $value) : ?>
                                                                <?php if ($data_risk !== null) : ?>
                                                                    <?php if ($data_risk['likelihood_after'] == $value['likelihood_level']) : ?>
                                                                        <option value="<?= $value['likelihood_level'] ?>" selected>
                                                                            <?= $value['likelihood_level'] ?>
                                                                        </option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $value['likelihood_level'] ?>">
                                                                            <?= $value['likelihood_level'] ?>
                                                                        </option>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['likelihood_level'] ?>">
                                                                        <?= $value['likelihood_level'] ?>
                                                                    </option>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
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
                                <div id="opportunities-context">
                                    <?php if ($data_opportunity === null) : ?>
                                        <div class="row" id="opportunities-context-content" style="border-bottom: 1px solid #ccc;">
                                            <div class="col-lg-6">
                                                <div class="form-group mt-3">
                                                    <h6>Opportunity planning</h6>
                                                    <textarea class="form-control gray-text" rows="5" placeholder="Text..." name="risktreatmentplan_1" id="risktreatmentplan_1"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-group mt-2">
                                                    <h6>Opportunities Owner</h6>
                                                    <input class="form-control gray-text" type="text" placeholder="Text..." name="riskowner_1" id="riskowner_1"></input>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mt-3">
                                                            <h6>Start Date</h6>
                                                            <input class="form-control gray-text" type="date" name="startdate_1" id="startdate_1"></input>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mt-3">
                                                            <h6>End Date</h6>
                                                            <input class="form-control gray-text" type="date" name="enddate_1" id="enddate_1"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <h6>Attach File</h6>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="fileopp_1" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="fileopp_1">
                                                        <label class="custom-file-label" for="fileopp_1">Choose
                                                            file</label>
                                                    </div>
                                                    <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                                                    <br>
                                                    <div id="button_delete"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="checkopportunities_1" id="checkopportunities_1">
                                        </div>
                                    <?php else : ?>
                                        <?php foreach ($data_opportunity['data_opp'] as $key => $value) : ?>
                                            <div class="row" id="opportunities-context-content-<?= $key ?>" style="border-bottom: 1px solid #ccc;">
                                                <div class="col-lg-6">
                                                    <div class="form-group mt-3">
                                                        <h6>Opportunity planning</h6>
                                                        <textarea class="form-control gray-text" rows="5" placeholder="Text..." name="risktreatmentplan_<?= $key ?>" id="risktreatmentplan_<?= $key ?>" <?= $disabled_view ?>><?= $value['opportunity_plannings'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-2">
                                                    <div class="form-group mt-2">
                                                        <h6>Opportunities Owner</h6>
                                                        <input class="form-control gray-text" type="text" placeholder="Text..." name="riskowner_<?= $key ?>" id="riskowner_<?= $key ?>" value="<?= $value['opp_ownner'] ?>" <?= $disabled_view ?>></input>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group mt-3">
                                                                <h6>Start Date</h6>
                                                                <input class="form-control gray-text" type="date" name="startdate_<?= $key ?>" id="startdate_<?= $key ?>" value="<?= $value['start_date'] ?>" <?= $disabled_view ?>></input>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group mt-3">
                                                                <h6>End Date</h6>
                                                                <input class="form-control gray-text" type="date" name="enddate_<?= $key ?>" id="enddate_<?= $key ?>" value="<?= $value['end_date'] ?>" <?= $disabled_view ?>></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <h6>Attach File</h6>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="fileopp_<?= $key ?>" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="fileopp_<?= $key ?>" <?= $disabled_view ?>>
                                                            <label class="custom-file-label" for="fileopp_<?= $key ?>">Choose
                                                                file</label>
                                                        </div>
                                                        <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                                                        <br>
                                                        <div id="button_delete"></div>
                                                        <?php if ($disabled_view !== 'disabled') :?>
                                                        <button type="button" class="btn btn-danger btn-sm" id="delete-opportunities-context" onclick="deleteRow(<?= $key ?>)" <?php if ($key == 0) : ?>hidden <?php endif ?>><i class="fas fa-trash-alt"></i> Delete</button>
                                                        <?php endif;?>
                                                        </div>
                                                </div>
                                                <input type="hidden" name="checkopportunities_<?= $key ?>" id="checkopportunities_<?= $key ?>" value="<?= $value['id_address_risks_opp_context_data'] ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <button type="button" class="btn btn-secondary btn-sm" id="add-opportunities-context" onclick="add_opportunities_context()"> + Add Operationality planning</button>
                            </div>
                        </div>
                        <?php if ($viewMode == false) : ?>
                            <div class="d-flex justify-content-center mb-5">
                                <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 30px;">Cancel</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-default">
        <div id="modal1">
            <?= $this->include("Modal/Requirement_Modal"); ?>
        </div>
    </div>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
        var check_overload_risk_1 = 0;
        $("#form_address").on('submit', function(event) {
            event.preventDefault();
            const exampleRadios = document.getElementsByName("exampleRadios");
            var data_risk = <?php echo json_encode($data_risk); ?>;
            var data_opportunity = <?php echo json_encode($data_opportunity); ?>;
            if (data_risk !== null || data_opportunity !== null) {
                if (data_risk !== null && data_opportunity === null) {
                    var url = "planning/planningAddressRisksOpp/context/risk/edit/" + <?php echo $data['id_version']; ?> + "/" + <?php echo $data['status']; ?> + "/" + check_overload_risk_1 + "/" + data_risk['id_address_risks_context'];
                } else if (data_risk === null && data_opportunity !== null) {
                    var url = "planning/planningAddressRisksOpp/context/opportunities/edit/" + <?php echo $data['id_version']; ?> + "/" + <?php echo $data['status']; ?> + "/" + set_opp + "/" + data_opportunity['id_address_risks_opp_context'];
                }
            } else {
                if (exampleRadios[0].checked) {
                    var url = "planning/planningAddressRisksOpp/context/risk/create/" + <?php echo $data['id_version']; ?> + "/" + <?php echo $data['status']; ?> + "/" + check_overload_risk_1;
                } else {
                    var url = "planning/planningAddressRisksOpp/context/opportunities/create/" + <?php echo $data['id_version']; ?> + "/" + <?php echo $data['status']; ?> + "/" + set_opp;
                }
            }

            action_(url, 'form_address');
        });
        $("#form_address").on('reset', function(event) {
            var riskPlanDiv = document.getElementById("risk-context-risk-treatment-plan");
            var riskAfterDiv = document.getElementById("risk-context-consequences-after-treatment");
            document.getElementById("residual").style.backgroundColor = "white";
            document.getElementById("risklevel").style.backgroundColor = "white";
            riskPlanDiv.style.display = "none";
            riskAfterDiv.style.display = "none";
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#risklevelmaxtrix_placeholder").load("<?php echo base_url('risk_Criteria_Context_Risk_Level'); ?> #risklevelmaxtrix");
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var riskRadio = document.getElementById("riskRadio");
            var opportunitiesRadio = document.getElementById("oppRadio");
            var riskContext = document.getElementById("risk-context");
            var opportunitiesContext = document.getElementById("opportunities-context");
            var add_opportunities_context = document.getElementById("add-opportunities-context");
            riskRadio.addEventListener("change", function() {
                if (riskRadio.checked) {
                    riskContext.style.display = "block";
                    opportunitiesContext.style.display = "none";
                    add_opportunities_context.style.display = "none";
                }
            });

            opportunitiesRadio.addEventListener("change", function() {
                if (opportunitiesRadio.checked) {
                    riskContext.style.display = "none";
                    opportunitiesContext.style.display = "block";
                    add_opportunities_context.style.display = "block";
                }
            });

            if (riskRadio.checked) {
                riskContext.style.display = "block";
                opportunitiesContext.style.display = "none";
                add_opportunities_context.style.display = "none";
            } else if (opportunitiesRadio.checked) {
                riskContext.style.display = "none";
                opportunitiesContext.style.display = "block";
                add_opportunities_context.style.display = "block";
            }
        });
    </script>
    <!-- risk-level-over -->
    <script>
        $(document).ready(function() {
            var data_risk = <?php echo json_encode($data_risk); ?>;
            var data_opportunity = <?php echo json_encode($data_opportunity); ?>;
            console.log(data_risk, data_opportunity);
            if (data_risk !== null) {
                showMaxValueInImpact();
                showMaxValueInImpactResidual();
            }
        })
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("select.select-impact-risk").forEach(function(select) {
                select.addEventListener("change", showMaxValueInImpact);
            });
            document.getElementById("likelihood").addEventListener("input", calRiskLevel);
        });

        function showMaxValueInImpact() {
            var check_2 = true;
            document.querySelectorAll("select.select-impact-risk").forEach(function(select) {
                if (select.value === '0') {
                    check_2 = false;
                }
            });
            if (check_2) {
                var maxValue = findMaxValue("select.select-impact-risk");
                document.getElementById("impact").value = maxValue;
                calRiskLevel();
            }
        }

        function findMaxValue(selector) {
            var selects = document.querySelectorAll(selector);
            var maxValue = 0;

            selects.forEach(function(select) {
                var temp = select.value.split("-");
                var value = parseInt(temp[1]);
                // var value = parseInt(select.value);
                if (value > maxValue) {
                    maxValue = value;
                }
            });
            return maxValue;
        }

        function calRiskLevel() {
            var Risk_level_context = <?php echo isset($Risk_level_context) ? json_encode($Risk_level_context) : 'null'; ?>;
            var impactValue = parseFloat(document.getElementById("impact").value);
            var likelihoodValue = parseFloat(document.getElementById("likelihood").value);

            var riskLevel = impactValue * likelihoodValue;
            document.getElementById("risklevel").value = riskLevel;

            var riskPlanDiv = document.getElementById("risk-context-risk-treatment-plan");
            var riskAfterDiv = document.getElementById("risk-context-consequences-after-treatment");

            var check_1 = false;
            Risk_level_context.forEach((element, index) => {
                if (element.risk_assessment_level == 1) {
                    if (riskLevel > element.maximum) {

                        riskPlanDiv.style.display = "block";
                        riskAfterDiv.style.display = "block";
                        check_overload_risk_1 = 1;
                    } else {
                        check_overload_risk_1 = 0;
                        riskPlanDiv.style.display = "none";
                        riskAfterDiv.style.display = "none";
                    }
                }
                if (riskLevel >= element.minimum && riskLevel <= element.maximum) {
                    check_1 = true;
                    document.getElementById("risklevel").style.backgroundColor = element.risk_color;
                    document.getElementById("risklevel").style.color = element.text_color;
                }
                if (check_1 == false) {
                    document.getElementById("risklevel").style.backgroundColor = "white";
                    document.getElementById("risklevel").style.color = "black";
                }
            });

        }
    </script>
    <!-- ถ้าหาก risk level มีการเปลี่ยนแปลง การซ่อนและแสดง risk-context-risk-treatment-plan และ risk-context-consequences-after-treatment จะเปลี่ยนแปลงไปด้วย -->
    <!-- risk-level-not-over -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("select.select-impact-residual").forEach(function(select) {
                select.addEventListener("change", showMaxValueInImpactResidual);
            });

            document.getElementById("likelihood2").addEventListener("input", calResidual);
        });

        function showMaxValueInImpactResidual() {
            var check_3 = true;
            document.querySelectorAll("select.select-impact-residual").forEach(function(select) {
                if (select.value === '0') {
                    check_3 = false;
                }
            });
            if (check_3) {
                var maxValue = findMaxValue("select.select-impact-residual");
                document.getElementById("impact2").value = maxValue;
                calResidual();
            }
        }

        function findMaxValue(selector) {
            var selects = document.querySelectorAll(selector);
            var maxValue = 0;

            selects.forEach(function(select) {
                var temp = select.value.split("-");
                var value = parseInt(temp[1]);
                // var value = parseInt(select.value);
                if (value > maxValue) {
                    maxValue = value;
                }
            });
            return maxValue;
        }

        function calResidual() {
            var Risk_level_context = <?php echo isset($Risk_level_context) ? json_encode($Risk_level_context) : 'null'; ?>;
            var impactValue2 = parseFloat(document.getElementById("impact2").value);
            var likelihoodValue2 = parseFloat(document.getElementById("likelihood2").value);
            var residual = impactValue2 * likelihoodValue2;

            document.getElementById("residual").value = residual;

            var check_4 = false;
            Risk_level_context.forEach((element, index) => {
                if (residual >= element.minimum && residual <= element.maximum) {
                    check_4 = true;
                    document.getElementById("residual").style.backgroundColor = element.risk_color;
                    document.getElementById("residual").style.color = element.text_color;
                }
            });
            if (check_4 == false) {
                document.getElementById("residual").style.backgroundColor = "white";
                document.getElementById("residual").style.color = "black";
            }
        }
    </script>
    <script>
        function action_(url, form) {
            if (form != null) {
                var formData = new FormData(document.getElementById(form));
                var Risk_level_context = <?php echo isset($Risk_level_context) ? json_encode($Risk_level_context) : 'null'; ?>;
                if (Risk_level_context != null) {
                    Risk_level_context.forEach(element => {
                    if (element.risk_assessment_level == 1) {
                        formData.append('risk_assessment_level_max', element.maximum);
                    }
                });
                }
            }
            $.ajax({
                url: '<?= base_url() ?>' + url,
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function() {
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
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: true
                        });
                        setTimeout(() => {
                            if (response.reload) {
                                window.location.href = '<?= base_url('planning/planningAddressRisksOpp/context/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>';
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
        var data_opportunity = <?php echo json_encode($data_opportunity); ?>;

        if (data_opportunity !== null) {
            set_opp = data_opportunity.data_opp.length;
        } else {
            set_opp = 1;
        }
        function add_opportunities_context() {
            set_opp++;
            // Clone the opportunities-context-content element
            if (data_opportunity !== null) {
                var opportunitiesContextContent = document.getElementById('opportunities-context-content-0');
            } else {
                var opportunitiesContextContent = document.getElementById('opportunities-context-content');
            }
            var clone = opportunitiesContextContent.cloneNode(true);

            // Clear input values in the cloned element
            var inputs = clone.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
                var id_name = inputs[i].getAttribute('id');
                var id_ex = id_name.split('_');
                var new_id = id_ex[0] + '_' + set_opp;
                inputs[i].setAttribute('id', new_id);
                inputs[i].setAttribute('name', new_id);

                var label = clone.querySelector('label[for="' + id_name + '"]');
                if (label != null) {
                    label.setAttribute('for', new_id);
                    label.textContent = 'Choose file';
                }
            }
            var textarea = clone.getElementsByTagName('textarea')[0]; // Assuming there's only one textarea
            var textareaId = textarea.getAttribute('id');
            var id_textareaId = textareaId.split('_');
            textarea.setAttribute('id', id_textareaId[0] + '_' + set_opp);
            textarea.setAttribute('name', id_textareaId[0] + '_' + set_opp);
            textarea.value = ''; // Clear the value of the textarea
            // Append the cloned element to the opportunities-context
            var opportunitiesContext = document.getElementById('opportunities-context');
            opportunitiesContext.appendChild(clone);

            // Create and append delete button
            var deleteButton = document.createElement('button');
            deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i> Delete';
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
            deleteButton.onclick = function() {
                clone.remove();
            };

            // Append the delete button after the file input
            var fileInput = clone.querySelector('.custom-file');
            fileInput.parentNode.appendChild(deleteButton);

            var fileInput = document.getElementById('fileopp_' + set_opp);
            fileInput.addEventListener('change', function() {
                var fileName = fileInput.files[0].name;
                var labelForInput = document.querySelector('label[for="' + fileInput.id + '"]');
                labelForInput.textContent = fileName;
            });

        }

        function deleteRow(rowId) {
            document.getElementById('opportunities-context-content-' + rowId + '').remove();
        }
    </script>