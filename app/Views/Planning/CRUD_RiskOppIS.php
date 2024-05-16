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
                            <li class="breadcrumb-item"><a href="<?= base_url('planning/planningAddressRisksOpp/is/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Address
                                    risks & opportunities Version
                                    <?= $data['num_ver'] ?>
                                </a></li>
                            <?php if ($data_risk == null && $data_opportunity == null) : ?>
                                <li class="breadcrumb-item"><a>Create IS Risk & Opportunities</a></li>
                            <?php elseif ($data_risk != null && $data_opportunity == null) : ?>
                                <?php if ($viewMode) : ?>
                                    <li class="breadcrumb-item"><a>View IS Risk</a></li>
                                <?php else : ?>
                                    <li class="breadcrumb-item"><a>Edit IS Risk</a></li>
                                <?php endif; ?>
                            <?php elseif ($data_risk == null && $data_opportunity != null) : ?>
                                <?php if ($viewMode) : ?>
                                    <li class="breadcrumb-item"><a>View IS Opportunity</a></li>
                                <?php else : ?>
                                    <li class="breadcrumb-item"><a>Edit IS Opportunity</a></li>
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
                            <h2 class="card-title">Create IS Risk & Opportunities</h2>
                        <?php elseif ($data_risk !== null && $data_opportunity === null) : ?>
                            <?php if ($viewMode) : ?>
                                <h2 class="card-title">View IS Risk</h2>
                            <?php else : ?>
                                <h2 class="card-title">Edit IS Risk</h2>
                            <?php endif; ?>
                        <?php elseif ($data_risk === null && $data_opportunity !== null) : ?>
                            <?php if ($viewMode) : ?>
                                <h2 class="card-title">View IS Risk</h2>
                            <?php else : ?>
                                <h2 class="card-title">Edit IS Risk</h2>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <form class="mb-3" id="form_address" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mt-2">
                                            <h6>Type</h6>
                                            <select class="custom-select" id="type" name="type">
                                                <?php 
                                                    $select0 = "selected";
                                                    $select1 = ""; 
                                                    $select2 = ""; 
                                                    $select3 = ""; 
                                                    $select4 = ""; 
                                                    $select5 = ""; 
                                                    $select6 = ""; 
                                                    $select7 = "";
                                                    $select8 = "";   
                                                ?>
                                                <?php if ($data_risk !== null) : ?>
                                                    <?php $typevalue = $data_risk['type'];?>
                                                    <?php $select0 = ""; ?>
                                                    <?php if ($typevalue == "Hardware") : 
                                                        $select1 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Software") : 
                                                        $select2 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Information") : 
                                                        $select3 = "selected"; ?>
                                                    <?php elseif ($typevalue == "People") : 
                                                        $select4 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Service") : 
                                                        $select5 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Virtual Machine") : 
                                                        $select6 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Location") : 
                                                        $select7 = "selected"; ?>
                                                    <?php else : 
                                                        $select8 = "selected"; ?>
                                                    <?php endif; ?>
                                                <?php elseif ($data_opportunity !== null) : ?>
                                                    <?php $typevalue = $data_opportunity['type'];?>
                                                    <?php $select0 = ""; ?>
                                                    <?php if ($typevalue == "Hardware") : 
                                                        $select1 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Software") : 
                                                        $select2 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Information") : 
                                                        $select3 = "selected"; ?>
                                                    <?php elseif ($typevalue == "People") : 
                                                        $select4 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Service") : 
                                                        $select5 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Virtual Machine") : 
                                                        $select6 = "selected"; ?>
                                                    <?php elseif ($typevalue == "Location") : 
                                                        $select7 = "selected"; ?>
                                                    <?php else : 
                                                        $select8 = "selected"; ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                <?php endif; ?>
                                                                                                
                                                <option <?= $select0 ?>>Select Type</option>
                                                <option value="Hardware" <?= $select1 ?>>Hardware</option>
                                                <option value="Software" <?= $select2 ?>>Software</option>
                                                <option value="Information" <?= $select3 ?>>Information</option>
                                                <option value="People" <?= $select4 ?>>People</option>
                                                <option value="Service" <?= $select5 ?>>Service</option>
                                                <option value="Virtual Machine" <?= $select6 ?>>Virtual Machine</option>
                                                <option value="Location" <?= $select7 ?>>Location</option>
                                                <option value="Other" <?= $select8 ?>>Other (please specify)</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="input-othertype">
                                        <div class="form-group mt-2">
                                            <h6>Other Types</h6>
                                            <?php if ($data_risk !== null) : ?>
                                                <input class="form-control gray-text" type="text" placeholder="Text..." name="othertype" id="othertype" value="<?= $data_risk['type'] ?>" <?= $disabled_view ?>></input>
                                            <?php elseif ($data_opportunity !== null) : ?>
                                                <input class="form-control gray-text" type="text" placeholder="Text..." name="othertype" id="othertype" value="<?= $data_opportunity['type'] ?>" <?= $disabled_view ?>></input>
                                            <?php else : ?>
                                                <input class="form-control gray-text" type="text" placeholder="Text..." name="othertype" id="othertype"></input>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mt-2">
                                            <h6>Asset Group</h6>
                                            <?php if ($data_risk !== null) : ?>
                                                <input class="form-control gray-text" type="text" placeholder="Text..." name="assetgroup" id="assetgroup" value="<?= $data_risk['asset_group'] ?>" <?= $disabled_view ?>></input>
                                            <?php elseif ($data_opportunity !== null) : ?>
                                                <input class="form-control gray-text" type="text" placeholder="Text..." name="assetgroup" id="assetgroup" value="<?= $data_opportunity['asset_group'] ?>" <?= $disabled_view ?>></input>
                                            <?php else : ?>
                                                <input class="form-control gray-text" type="text" placeholder="Text..." name="assetgroup" id="assetgroup"></input>
                                            <?php endif; ?>
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
                                <div id="risk-is">
                                    <div class="row" id="risk-is">
                                        <div class="col-lg-4">
                                            <div class="form-group mt-3">
                                                <h6>Threat</h6>
                                                <?php if ($data_risk !== null) : ?>
                                                    <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="threat" id="threat" <?= $disabled_view ?>><?= $data_risk['threat'] ?></textarea>
                                                <?php else : ?>
                                                    <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="threat" id="threat"></textarea>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mt-3">
                                                <h6>Vulnerability</h6>
                                                <?php if ($data_risk !== null) : ?>
                                                    <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="vulnerability" id="vulnerability" <?= $disabled_view ?>><?= $data_risk['vulnerability'] ?></textarea>
                                                <?php else : ?>
                                                    <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="vulnerability" id="vulnerability"></textarea>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mt-3">
                                                <h6>Existing Controls</h6>
                                                <?php if ($data_risk !== null) : ?>
                                                    <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="existing_controls" id="existing_controls" <?= $disabled_view ?>><?= $data_risk['existing_controls'] ?></textarea>
                                                <?php else : ?>
                                                    <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="existing_controls" id="existing_controls"></textarea>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3" id="risk-is-consequences">
                                        <h6>Consequences</h6>
                                        <div class="row">
                                            <?php if (!empty($consequence_level_is)) : ?>
                                                <?php foreach ($consequence_level_is as $key => $consequenceData) : ?>
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
                                                                        <?php if (in_array($consequenceData['id_consequence_level_is'] . '-' . $operational['impact_level'], $risk_consequenc)) : ?>
                                                                            <option value="<?= $consequenceData['id_consequence_level_is'] . '-' . $operational['impact_level']; ?>" selected>
                                                                                <?= $operational['impact_level']; ?>
                                                                            </option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $consequenceData['id_consequence_level_is'] . '-' . $operational['impact_level']; ?>">
                                                                                <?= $operational['impact_level']; ?>
                                                                            </option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <option value="0" selected>Select Operational</option>
                                                                    <?php foreach ($consequenceData['data_item'] as $operational) : ?>
                                                                        <option value="<?= $consequenceData['id_consequence_level_is'] . '-' . $operational['impact_level']; ?>">
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
                                    <div class="mt-3" id="risk-is-analysis">
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
                                                        <?php if (!empty($Likelihood_level_is)) : ?>
                                                            <?php foreach ($Likelihood_level_is as $key => $value) : ?>
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
                                            <?php if (!empty($Likelihood_level_is)) : ?>

                                                <div class="col-lg-6" style="overflow-x:auto;">
                                                    <table class="table table-bordered" style="font-size: 8pt">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px;background-color: #fff;" class="text-center" rowspan="2" colspan="2"></th>
                                                                <th style="width: 130px; background-color: #658ABF;color: floralwhite; font-weight: 500;" class="text-center" colspan="<?= count($Likelihood_level_is) ?>">
                                                                    <div>ผลกระทบ</div>
                                                                    <div style="font-size:90%;">(Impact)</div>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <?php foreach ($Likelihood_level_is as $impact) : ?>
                                                                    <th class="text-center " style="background-color: #E2EEFF; font-weight: 400;">
                                                                        <?= $impact['likelihood_name'] ?> (
                                                                        <?= $impact['likelihood_level'] ?>)
                                                                    </th>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th rowspan="<?= count($Likelihood_level_is) + 1 ?>" style="background-color: #658ABF; color: floralwhite; font-weight: 500; text-align: center;">
                                                                    <div>โอกาสเกิด</div>
                                                                    <div style="font-size:90%;">(Likelihood)</div>
                                                                </th>
                                                            </tr>
                                                            <?php foreach ($Likelihood_level_is as $likelihood) : ?>
                                                                <tr>
                                                                    <th class="text-center" style="background-color: #E2EEFF; font-weight: 400;">
                                                                        <?= $likelihood['likelihood_name'] ?> (
                                                                        <?= $likelihood['likelihood_level'] ?>)
                                                                    </th>
                                                                    <?php foreach ($Likelihood_level_is as $impact) : ?>
                                                                        <?php $result = $impact['likelihood_level'] * $likelihood['likelihood_level'] ?>
                                                                        <td class="text-center" style="background-color: <?= getRiskColor($result, $Risk_level_is) ?>; color: <?= getTextColor($result, $Risk_level_is) ?>">
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
                                    <div class="" id="risk-is-risk-treatment-plan" style="display: none;">
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
                                                                    <?php if ($data_risk['risk_options'] == $value['id_risk_options_is']) : ?>
                                                                        <option value="<?= $value['id_risk_options_is'] ?>" selected>
                                                                            <?= $value['options'] ?> (
                                                                            <?= $value['description'] ?>)
                                                                        </option>
                                                                    <?php else : ?>
                                                                        <option value="<?= $value['id_risk_options_is'] ?>">
                                                                            <?= $value['options'] ?> (
                                                                            <?= $value['description'] ?>)
                                                                        </option>
                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <option value="<?= $value['id_risk_options_is'] ?>">
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
                                                        <input class="form-control" type="text" placeholder="Text..." name="risk_owner" id="risk_owner" value="<?= $data_risk['name_of_risk_treatment_plan'] ?>" <?= $disabled_view ?>></input>
                                                    <?php else : ?>
                                                        <input class="form-control" type="text" placeholder="Text..." name="risk_owner" id="risk_owner"></input>
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
                                                                <input class="form-control" type="date" name="startdate_is" id="startdate_is" <?= $disabled_view ?> value="<?= $data_risk['start_date'] ?>"></input>
                                                            <?php else : ?>
                                                                <input class="form-control" type="date" name="startdate_is" id="startdate_is"></input>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mt-3">
                                                            <h6>End Date</h6>
                                                            <?php if ($data_risk !== null) : ?>
                                                                <input class="form-control" type="date" name="enddate_is" id="enddate_is" <?= $disabled_view ?> value="<?= $data_risk['end_date'] ?>"></input>
                                                            <?php else : ?>
                                                                <input class="form-control" type="date" name="enddate_is" id="enddate_is"></input>
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
                                                        <input class="form-control" type="text" placeholder="Text..." name="risk_owner" id="risk_owner" value="<?= $data_risk['evaluation'] ?>" <?= $disabled_view ?>></input>
                                                    <?php else : ?>
                                                        <input class="form-control" type="text" placeholder="Text..." name="risk_owner" id="risk_owner"></input>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3" id="risk-is-consequences-after-treatment" style="display: none;">
                                        <h6>Consequences (After Treatment)</h6>
                                        <div class="row">
                                            <?php if (!empty($consequence_level_is)) : ?>
                                                <?php foreach ($consequence_level_is as $key => $consequenceData) : ?>
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
                                                                        <?php if (in_array($consequenceData['id_consequence_level_is'] . '-' . $operational['impact_level'], $risk_consequenc)) : ?>
                                                                            <option value="<?= $consequenceData['id_consequence_level_is'] . '-' . $operational['impact_level']; ?>" selected>
                                                                                <?= $operational['impact_level']; ?>
                                                                            </option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $consequenceData['id_consequence_level_is'] . '-' . $operational['impact_level']; ?>">
                                                                                <?= $operational['impact_level']; ?>
                                                                            </option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <option value="0" selected>Select Operational</option>
                                                                    <?php foreach ($consequenceData['data_item'] as $operational) : ?>
                                                                        <option value="<?= $consequenceData['id_consequence_level_is'] . '-' . $operational['impact_level']; ?>">
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
                                                        <?php if (!empty($Likelihood_level_is)) : ?>
                                                            <?php foreach ($Likelihood_level_is as $key => $value) : ?>
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
                                <div id="opportunities-is">
                                    <?php if ($data_opportunity === null) : ?>
                                        <div class="row" id="opportunities-is-content" style="border-bottom: 1px solid #ccc;">
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
                                            <div class="row" id="opportunities-is-content-<?= $key ?>" style="border-bottom: 1px solid #ccc;">
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
                                                        <button type="button" class="btn btn-danger btn-sm" id="delete-opportunities-is" onclick="deleteRow(<?= $key ?>)" <?php if ($key == 0) : ?>hidden <?php endif ?>><i class="fas fa-trash-alt"></i> Delete</button>
                                                        <?php endif;?>
                                                        </div>
                                                </div>
                                                <input type="hidden" name="checkopportunities_<?= $key ?>" id="checkopportunities_<?= $key ?>" value="<?= $value['id_address_risks_opp_is_data'] ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <br>
                                <button type="button" class="btn btn-secondary btn-sm" id="add-opportunities-is" onclick="add_opportunities_is()"> + Add Operationality planning</button>
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
                    var url = "planning/planningAddressRisksOpp/is/risk/edit/" + <?php echo $data['id_version']; ?> + "/" + <?php echo $data['status']; ?> + "/" + check_overload_risk_1 + "/" + data_risk['id_address_risks_is'];
                } else if (data_risk === null && data_opportunity !== null) {
                    var url = "planning/planningAddressRisksOpp/is/opportunities/edit/" + <?php echo $data['id_version']; ?> + "/" + <?php echo $data['status']; ?> + "/" + set_opp + "/" + data_opportunity['id_address_risks_opp_is'];
                }
            } else {
                if (exampleRadios[0].checked) {
                    var url = "planning/planningAddressRisksOpp/is/risk/create/" + <?php echo $data['id_version']; ?> + "/" + <?php echo $data['status']; ?> + "/" + check_overload_risk_1;
                } else {
                    var url = "planning/planningAddressRisksOpp/is/opportunities/create/" + <?php echo $data['id_version']; ?> + "/" + <?php echo $data['status']; ?> + "/" + set_opp;
                }
            }

            action_(url, 'form_address');
        });
        $("#form_address").on('reset', function(event) {
            var riskPlanDiv = document.getElementById("risk-is-risk-treatment-plan");
            var riskAfterDiv = document.getElementById("risk-is-consequences-after-treatment");
            document.getElementById("residual").style.backgroundColor = "white";
            document.getElementById("risklevel").style.backgroundColor = "white";
            riskPlanDiv.style.display = "none";
            riskAfterDiv.style.display = "none";
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#risklevelmaxtrix_placeholder").load("<?php echo base_url('risk_Criteria_IS_Risk_Level'); ?> #risklevelmaxtrix");
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var riskRadio = document.getElementById("riskRadio");
            var opportunitiesRadio = document.getElementById("oppRadio");
            var riskIS = document.getElementById("risk-is");
            var opportunitiesIS = document.getElementById("opportunities-is");
            var add_opportunities_is = document.getElementById("add-opportunities-is");
            riskRadio.addEventListener("change", function() {
                if (riskRadio.checked) {
                    riskIS.style.display = "block";
                    opportunitiesIS.style.display = "none";
                    add_opportunities_is.style.display = "none";
                }
            });

            opportunitiesRadio.addEventListener("change", function() {
                if (opportunitiesRadio.checked) {
                    riskIS.style.display = "none";
                    opportunitiesIS.style.display = "block";
                    add_opportunities_is.style.display = "block";
                }
            });

            if (riskRadio.checked) {
                riskIS.style.display = "block";
                opportunitiesIS.style.display = "none";
                add_opportunities_is.style.display = "none";
            } else if (opportunitiesRadio.checked) {
                riskIS.style.display = "none";
                opportunitiesIS.style.display = "block";
                add_opportunities_is.style.display = "block";
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
            var Risk_level_is = <?php echo isset($Risk_level_is) ? json_encode($Risk_level_is) : 'null'; ?>;
            var impactValue = parseFloat(document.getElementById("impact").value);
            var likelihoodValue = parseFloat(document.getElementById("likelihood").value);

            var riskLevel = impactValue * likelihoodValue;
            document.getElementById("risklevel").value = riskLevel;

            var riskPlanDiv = document.getElementById("risk-is-risk-treatment-plan");
            var riskAfterDiv = document.getElementById("risk-is-consequences-after-treatment");

            var check_1 = false;
            Risk_level_is.forEach((element, index) => {
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
            var Risk_level_is = <?php echo isset($Risk_level_is) ? json_encode($Risk_level_is) : 'null'; ?>;
            var impactValue2 = parseFloat(document.getElementById("impact2").value);
            var likelihoodValue2 = parseFloat(document.getElementById("likelihood2").value);
            var residual = impactValue2 * likelihoodValue2;

            document.getElementById("residual").value = residual;

            var check_4 = false;
            Risk_level_is.forEach((element, index) => {
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
                var Risk_level_is = <?php echo isset($Risk_level_is) ? json_encode($Risk_level_is) : 'null'; ?>;
                if (Risk_level_is != null) {
                    Risk_level_is.forEach(element => {
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
                                window.location.href = '<?= base_url('planning/planningAddressRisksOpp/is/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>';
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
        function add_opportunities_is() {
            set_opp++;
            // Clone the opportunities-is-content element
            if (data_opportunity !== null) {
                var opportunitiesISContent = document.getElementById('opportunities-is-content-0');
            } else {
                var opportunitiesISContent = document.getElementById('opportunities-is-content');
            }
            var clone = opportunitiesISContent.cloneNode(true);

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
            // Append the cloned element to the opportunities-is
            var opportunitiesIS = document.getElementById('opportunities-is');
            opportunitiesIS.appendChild(clone);

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
            document.getElementById('opportunities-is-content-' + rowId + '').remove();
        }
    </script>
    <script>
            $(document).ready(function() {
                // ซ่อน input เมื่อโหลดหน้าเว็บ
                var type = document.getElementById("type").value;
                // console.log(type)
                if (type == "Other") {
                    $('#input-othertype').show();
                } else {
                    $('#input-othertype').hide();
                }

                // เมื่อเปลี่ยนการเลือกของเมนู dropdown
                $('select.custom-select').change(function() {
                    // ถ้าเลือกตัวเลือก "Other (please specify)"
                    if ($(this).val() == 'Other') {
                        // แสดง input
                        $('#input-othertype').show();
                    } else {
                        // ซ่อน input
                        $('#input-othertype').hide();
                    }
                });
            });
        </script>