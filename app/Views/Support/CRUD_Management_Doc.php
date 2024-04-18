<title>Documented Information Version</title>
<!DOCTYPE html>
<html lang="en">
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da !important;
    }

    .select2-selection__choice {
        background-color: #1D2124 !important;
        border: 1px solid #1D2124 !important;
        color: #fff !important;
    }

    .select2-selection__choice__remove {
        color: #fff !important;
    }

    .input-group button {
        padding: 5px 10px;
        background-color: transparent;
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 0px 4px 4px 0px;
        cursor: pointer;
    }

    .input-group button:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documented Information Version</title>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100%;
        }

        .select2-selection__choice {
            background-color: #343A40;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 3px 10px;
            margin-right: 5px;
        }

        .select2-search__field {
            width: 100%;
            border: none;
        }

        .select2-dropdown {
            border: 1px solid #343A40;
        }

        .select2-results__option {
            padding: 8px 12px;
        }

        .select2-results__option--highlighted {
            background-color: #343A40;
            color: #fff;
        }
    </style>
</head>
<?php
$statuses = [
    "1" => ["background-color" => "#343A40", "color" => "#fff", "status" => "Draft"],
    "2" => ["background-color" => "#E2F0FF", "color" => "#0062FF", "status" => "Pending Review"],
    "3" => ["background-color" => "#D40000", "color" => "#fff", "status" => "Rejected"],
    "4" => ["background-color" => "#D4EDDA", "color" => "#28A745", "status" => "Pending Approved"],
    "5" => ["background-color" => "#28A745", "color" => "#fff", "status" => "Approved"],
    "6" => ["background-color" => "#FBCB0A", "color" => "#fff", "status" => "Request Modification"],
];
$Document_Type = [
    "Management system manaul" => "Management system manaul",
    "Policy" => "Policy",
    "Plan" => "Plan",
    "Procedure" => "Procedure",
    "Workintruction" => "Workintruction",
    "Form" => "Form",
    "External" => "External"
];

$Secret_Level = [
    "Top secret" => "Top secret",
    "Secret" => "Secret",
    "Plan" => "Plan",
    "Confidential" => "Confidential",
    "Internal use" => "Internal use",
    "Public" => "Public",
];

$status = $data_doc['status'];
$badgeStyle = $statuses[$status];
if ($data_doc['status'] == "2" || $data_doc['status'] == "4" || $data_doc['status'] == "5" || $view_mode) {
    $edit_mode = "disabled";
} else {
    $edit_mode = "";
}
$my_id_ = session()->get('id');

if ($view_mode) {
    $view_button_mode = "hidden";
} else {
    $create_update_upload_array = explode(",", $data_doc['create_update_upload']);
    $review_array = explode(",", $data_doc['review']);
    $approval_array = explode(",", $data_doc['approval']);

    if (in_array($my_id_, $create_update_upload_array) && ($data_doc['status'] == "1" || $data_doc['status'] == "3" || $data_doc['status'] == "6")) {
        $view_button_mode = "";
    } else if (in_array($my_id_, $review_array) && $data_doc['status'] == "2") {
        $view_button_mode = "";
    } else if (in_array($my_id_, $approval_array) && $data_doc['status'] == "4") {
        $view_button_mode = "";
    } else {
        $view_button_mode = "hidden";
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
                        <h1>Documented Information
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('context/context_analysis/index/17'); ?>">Documented Information</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('support/documentation/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Version <?= $data['num_ver'] ?></a></li>
                            <li class="breadcrumb-item"><a>Management Control</a></li>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="card-title">Management Control</h2>
                            </div>
                            <div>
                                <?php if ($data_doc['status'] === "1" || $data_doc['status'] === "3" || $data_doc['status'] === "6") : ?>
                                    <button type="button" class="btn btn-outline-dark btn-sm btn-save-draft" onclick="confirm_Alert('ต้องการที่จะ Save Draft หรือไม่', 'support/documentation/management/edit/<?= $data_doc['id_document_create_update'] . '/' . $data['id_version'] . '/' . $data['status'] ?>')" <?= $view_button_mode ?>>
                                        <i class="fas fa-save"></i>
                                        &nbsp;Save Draft
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm btn-send-review" onclick="confirm_Alert('ต้องการที่จะ Send Review หรือไม่', 'support/documentation/management/update/status/<?= $data_doc['id_document_create_update'] . '/' . $data['id_version'] . '/' . $data['status'] ?>/2')" <?= $view_button_mode ?>>
                                        <i class="fas fa-user-check"></i>
                                        &nbsp;Send Review
                                    </button>
                                <?php elseif ($data_doc['status'] == "2") : ?>
                                    <button type="button" class="btn btn-outline-success btn-sm btn-send-approval" onclick="confirm_Alert('ต้องการที่จะ Send Approval หรือไม่', 'support/documentation/management/update/status/<?= $data_doc['id_document_create_update'] . '/' . $data['id_version'] . '/' . $data['status'] ?>/4')" <?= $view_button_mode ?>>
                                        <i class="fas fa-paper-plane"></i>
                                        &nbsp;Send Approval
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-rejected" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(2,1)" <?= $view_button_mode ?>>
                                        <i class="fas fa-times-circle"></i>
                                        &nbsp;Rejected
                                    </button>
                                <?php elseif ($data_doc['status'] == "4") : ?>
                                    <button type="button" class="btn btn-success btn-sm btn-approved" onclick="confirm_Alert('ต้องการที่จะ Approved หรือไม่', 'support/documentation/management/update/status/<?= $data_doc['id_document_create_update'] . '/' . $data['id_version'] . '/' . $data['status'] ?>/5')" <?= $view_button_mode ?>>
                                        <i class="fas fa-check-circle"></i>
                                        &nbsp;Approved
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-rejected" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(2,1)" <?= $view_button_mode ?>>
                                        <i class="fas fa-times-circle"></i>
                                        &nbsp;Rejected
                                    </button>
                                <?php elseif ($data_doc['status'] == "5") : ?>
                                    <button type="button" class="btn btn-warning btn-sm btn-request-modification" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(2,2)">
                                        <i class="fas fa-sync-alt"></i>
                                        &nbsp;Request Modification
                                    </button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-outline-warning btn-sm btn-view-request-details" id="view-request-details-button">
                                    <i class="fas fa-eye"></i>
                                    &nbsp;View Request Modification Details
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm btn-view-rejection-details" id="view-rejection-details-button">
                                    <i class="fas fa-eye"></i>
                                    &nbsp;View Rejection Details
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="mb-3" id="form_documented" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                            <div class="d-flex justify-content-end align-items-baseline">
                                <span>Status Document:&nbsp;&nbsp;</span>
                                <span class="badge rounded-pill" style="background-color: <?= $badgeStyle['background-color']; ?>; color: <?= $badgeStyle['color']; ?>;">
                                    <?= $badgeStyle['status']; ?>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Type</h6>
                                        <select class="custom-select" id="doc-type-select" name="document_type" <?= $edit_mode ?>>
                                            <?php foreach ($Document_Type as $key => $value) : ?>
                                                <?php if ($value == $data_doc['document_type'])
                                                    echo '<option selected>' . $value . '</option>'; ?>
                                                <?php if ($value != $data_doc['document_type'])
                                                    echo '<option>' . $value . '</option>'; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Abbreviation</h6>
                                        <input class="form-control gray-text" type="text" name="document_abbreviation" id="document_abbreviation" value="<?= $data_doc['document_abbreviation'] ?>" readonly></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Name TH</h6>
                                        <input class="form-control gray-text" type="text" name="name_th" id="name_th" value="<?= $data_doc['name_th'] ?>" <?= $edit_mode ?>></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Name ENG</h6>
                                        <input class="form-control gray-text" type="text" name="name_eng" id="name_eng" value="<?= $data_doc['name_eng'] ?>" <?= $edit_mode ?>></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Secret Level</h6>
                                        <select class="custom-select" id="doc-secret-level" name="secret_level" <?= $edit_mode ?>>
                                            <?php foreach ($Secret_Level as $key => $value) : ?>
                                                <?php if ($value == $data_doc['secret_level'])
                                                    echo '<option selected>' . $value . '</option>'; ?>
                                                <?php if ($value != $data_doc['secret_level'])
                                                    echo '<option>' . $value . '</option>'; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mt-3">
                                        <h6>Management Permissions</h6>
                                        <select id="tags-management-doc" multiple="multiple" class="form-control select2tags" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <div class="form-group user-upload">
                                        <h6>Attach File</h6>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="doc-file" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="doc-file" <?= $edit_mode ?>>
                                            <label class="custom-file-label" for="doc-file">Choose file</label>
                                        </div>
                                        <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mt-3" <?= $view_button_mode ?>>
                                        <h6>Create / Update / Upload</h6>
                                        <select id="tags-create" name="tags_create[]" multiple="multiple" class="form-control select2tags" required <?= $edit_mode ?>>
                                            <?php foreach ($user_data as $user) : ?>
                                                <?php if (in_array($user['id_user'], explode(',', $data_doc['create_update_upload']))) : ?>
                                                    <option value="<?= $user['id_user']; ?>" selected>
                                                        <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <?php if ($user['status'] === '0')
                                                        continue; ?>
                                                    <option value="<?= $user['id_user']; ?>">
                                                        <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mt-3">
                                        <h6>File</h6>
                                        <div class="input-group">
                                            <input class="form-control gray-text" type="text" name="file_old" id="file_old" disabled value="<?= $data_doc['id_file'] ? $data_doc['id_file']['name_file'] : 'No File' ?>"></input>
                                            <?php if ($data_doc['id_file']) : ?>
                                                <a id="button-addon2" href="<?php echo base_url('openfile/' . $data_doc['id_file']['id_files']); ?>" target="_blank">
                                                    <button type="button"><i class="fas fa-search"></i>&nbsp;View</button>
                                                </a>
                                            <?php else : ?>
                                                <button type="button" id="button-addon2"><i class="fas fa-search"></i>&nbsp;View</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" <?= $view_button_mode ?>>
                                <div class="col-lg-6">
                                    <div class="form-group mt-3">
                                        <h6>Review</h6>
                                        <select id="tags-review" name="tags_review[]" multiple="multiple" class="form-control" required <?= $edit_mode ?>>
                                            <?php foreach ($user_data as $user) : ?>
                                                <?php if (in_array($user['id_user'], explode(',', $data_doc['review']))) : ?>
                                                    <option value="<?= $user['id_user']; ?>" selected>
                                                        <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <?php if ($user['status'] === '0')
                                                        continue; ?>
                                                    <option value="<?= $user['id_user']; ?>">
                                                        <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" <?= $view_button_mode ?>>
                                <div class="col-lg-6">
                                    <div class="form-group mt-3">
                                        <h6>Approve</h6>
                                        <select id="tags-approve" name="tags_approve[]" multiple="multiple" class="form-control" required <?= $edit_mode ?>>
                                            <?php foreach ($user_data as $user) : ?>
                                                <?php if (in_array($user['id_user'], explode(',', $data_doc['approval']))) : ?>
                                                    <option value="<?= $user['id_user']; ?>" selected>
                                                        <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <?php if ($user['status'] === '0')
                                                        continue; ?>
                                                    <option value="<?= $user['id_user']; ?>">
                                                        <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row mt-3 d-flex justify-content-end">
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <h6>Created By</h6>
                                    <input class="form-control gray-text" type="text" name="createdby" id="createdby" disabled value="<?= $data_doc['created_by'] ?>"></input>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <h6>Creation Date</h6>
                                    <input class="form-control gray-text" type="datetime-local" name="creationtime" id="creationtime" disabled value="<?= $data_doc['creation_time'] ?>"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <h6>Last Modified By</h6>
                                    <input class="form-control gray-text" type="text" name="lastmodifiedby" id="lastmodifiedby" disabled value="<?= $data_doc['last_modified_by'] ?>"></input>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <h6>Last Modified Date</h6>
                                    <input class="form-control gray-text" type="datetime-local" name="lastmodifiedtime" id="lastmodifiedtime" disabled value="<?= $data_doc['last_modified_time'] ?>"></input>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <h6>Approved By</h6>
                                    <input class="form-control gray-text" type="text" name="approvedby" id="approvedby" disabled value="<?= $data_doc['approver_by'] ?>"></input>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group mt-3">
                                    <h6>Approval Date</h6>
                                    <input class="form-control gray-text" type="datetime-local" name="approvaldate" id="approvaldate" disabled value="<?= $data_doc['approval_time'] ?>"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <a href="javascript:history.back()"><button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 30px;">Back</button></a>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <div class="modal fade" id="modal-default">
        <div id="requirement_modal">
            <?= $this->include("Modal/Requirement_Modal"); ?>
        </div>
        <div id="doc_status_modal">
            <?= $this->include("Modal/Doc_Status_Modal"); ?>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#tags-create').select2({
                placeholder: "Select or Search",
                tags: false,
                tokenSeparators: [',', ' '],
                width: '100%'
            });
            $('#tags-review').select2({
                placeholder: "Select or Search",
                tags: false,
                tokenSeparators: [',', ' '],
                width: '100%'
            });
            $('#tags-approve').select2({
                placeholder: "Select or Search",
                tags: false,
                tokenSeparators: [',', ' '],
                width: '100%'
            });

            var element = <?php echo json_encode($data_doc); ?>;
            var my_id = <?= session()->get('id') ?>;
            var my_id_string = my_id.toString(); // Convert my_id to string for comparison
            var create_update_upload_ids = element.create_update_upload.split(',');
            var review_ids = element.review.split(',');
            var approval_ids = element.approval.split(',');
            var tags_management_doc = $('#tags-management-doc');

            tags_management_doc.select2({
                data: ["Create/Update/Upload", "Review", "Approval"],
                placeholder: "Select Tags",
                tags: false,
                tokenSeparators: [',', ' '],
                width: '100%',
            });

            function checkAndTriggerChange(ids, tag) {
                if (ids.includes(my_id_string)) {
                    tags_management_doc.val(function(index, oldValue) {
                        return (oldValue || []).concat([tag]);
                    }).trigger('change');
                }
            }

            checkAndTriggerChange(create_update_upload_ids, "Create/Update/Upload");
            checkAndTriggerChange(review_ids, "Review");
            checkAndTriggerChange(approval_ids, "Approval");
        });
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        function load_modal(check, data_, status) {
            doc_status_modal = document.getElementById("doc_status_modal");
            requirement_modal = document.getElementById("requirement_modal");

            if (check == 1) {
                doc_status_modal.style.display = "none";
                requirement_modal.style.display = "block";
            } else if (check == 2) {
                if (data_ == 1) {
                    document.querySelector('#dynamicModalHeader .modal-title').textContent = "Rejected";
                    document.querySelector('#dynamicModalHeader').classList.add("bg-danger");
                    document.querySelector('#dynamicModalHeader').classList.remove("bg-warning");
                    var url = 'support/documentation/management/update/status/<?= $data_doc['id_document_create_update'] . '/' . $data['id_version'] . '/' . $data['status'] ?>/3';
                } else if (data_ == 2) {
                    document.querySelector('#dynamicModalHeader .modal-title').textContent = "Request Modification";
                    document.querySelector('#dynamicModalHeader').classList.add("bg-warning");
                    document.querySelector('#dynamicModalHeader').classList.remove("bg-danger");
                    var url = 'support/documentation/management/update/status/<?= $data_doc['id_document_create_update'] . '/' . $data['id_version'] . '/' . $data['status'] ?>/6';
                }
                $(".modal-body #url_route").val(url);
                doc_status_modal.style.display = "block";
                requirement_modal.style.display = "none";
            }
        }
    </script>
    <script>
        var element = <?php echo json_encode($data_doc); ?>;

        $('#view-request-details-button').click(function() {
            Swal.fire({
                title: 'Request Modification Details',
                html: '<p>' + (element.request_details ? element.request_details : 'No Request Details') + '</p>',
                icon: 'info',
                confirmButtonText: 'Close'
            });
        });

        $('#view-rejection-details-button').click(function() {
            Swal.fire({
                title: 'Rejection Details',
                html: '<p>' + (element.rejection_details ? element.rejection_details : 'No Rejection Details') + '</p>',
                icon: 'info',
                confirmButtonText: 'Close'
            });
        });
    </script>
    <script>
        function confirm_Alert(text, url) {
            var element_data_doc = <?php echo json_encode($data_doc); ?>;
            var formData = new FormData($('#form_documented')[0]);
            formData.append('version', element_data_doc.version);
            formData.append('document_type_old', element_data_doc.document_type);
            formData.append('document_abbreviation_old', element_data_doc.document_abbreviation);
            formData.append('id_file_old', element_data_doc.id_file ? element_data_doc.id_file['id_files'] : '');
            formData.append('status_doc_Version', element_data_doc.status);

            Swal.fire({
                title: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "Submit",
                preConfirm: () => {
                    return $.ajax({
                        url: '<?= base_url() ?>' + url,
                        data: formData,
                        type: 'POST',
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
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
                                        window.location.reload();
                                        // window.location.href = '<?= base_url('support/documentation/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>';
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
                    })
                }
            });
        }
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));
            var element_data_doc = <?php echo json_encode($data_doc); ?>;
            formData.append('version', element_data_doc.version);
            formData.append('status_doc_Version', element_data_doc.status);
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
                    Swal.close();
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            allowOutsideClick: true,
                        });
                        if (response.reload) {
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    } else {
                        Swal.fire({
                            title: response.message,
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonText: 'ตกลง',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "เกิดข้อผิดพลาด",
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonText: 'ตกลง',
                    });
                }
            });
        }
    </script>
</body>

</html>