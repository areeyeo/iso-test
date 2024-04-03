<title>Documented Information Version</title>
<!DOCTYPE html>
<html lang="en">
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da !important;
    }

    .select2-selection__choice {
        background-color: #E2F0FF !important;
        border: 1px solid #E2F0FF !important;
        color: #0062FF !important;
    }

    .select2-selection__choice__remove {
        color: #0062FF !important;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documented Information Version</title>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Style the container */
        .select2-container {
            width: 100%;
        }

        /* Style the tags */
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
    "Draft" => ["background-color" => "#343A40", "color" => "#fff"],
    "Rejected" => ["background-color" => "#D40000", "color" => "#fff"],
    "Pending Review" => ["background-color" => "#E2F0FF", "color" => "#0062FF"],
    "Pending Approval" => ["background-color" => "#D4EDDA", "color" => "#28A745"],
    "Approved" => ["background-color" => "#28A745", "color" => "#fff"],
    "Request Modification" => ["background-color" => "#FBCB0A", "color" => "#fff"]
];

$status = "Pending Approval";
$badgeStyle = $statuses[$status];


?>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Documented Information
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                                data-target="#modal-default" id="load-modal-button"
                                onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('context/context_analysis/index/17'); ?>">Documented Information</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('support/documentation/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Version <?= $data['num_ver'] ?></a></li>
                            <li class="breadcrumb-item"><a>Create Creating & Updating</a></li>
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
                        <div>
                            <h2 class="card-title">Create Creating & Updating</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if ($data_doc != null): ?>
                            <div class="d-flex justify-content-end align-items-baseline">
                                <span>Status Document:&nbsp;&nbsp;</span>
                                <span class="badge rounded-pill"
                                    style="background-color: <?= $badgeStyle['background-color']; ?>; color: <?= $badgeStyle['color']; ?>;">
                                    <?= $status; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <form class="mb-3" id="form_documented" action="javascript:void(0)" method="post"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Type</h6>
                                        <select class="custom-select" id="doc-type-select" name="document_type">
                                            <option value="0" selected>Select Document Type</option>
                                            <option value="Management system manaul">Management system manaul</option>
                                            <option value="Policy">Policy</option>
                                            <option value="Plan">Plan</option>
                                            <option value="Procedure">Procedure</option>
                                            <option value="Workintruction">Workintruction</option>
                                            <option value="Form">Form</option>
                                            <option value="External">External</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4" <?php if ($data_doc === null): ?> hidden <?php endif; ?>>
                                    <div class="form-group mt-3">
                                        <h6>Document Abbreviation</h6>
                                        <input class="form-control gray-text" type="text" name="document_abbreviation"
                                            id="document_abbreviation" readonly></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Name TH</h6>
                                        <input class="form-control gray-text" type="text" name="name_th" id="name_th"
                                            required></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Name ENG</h6>
                                        <input class="form-control gray-text" type="text" name="name_eng" id="name_eng"
                                            required></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Secret Level</h6>
                                        <select class="custom-select" id="doc-secret-level" name="secret_level">
                                            <option value="0" selected>Select Secret Level</option>
                                            <option value="Top secret">Top secret</option>
                                            <option value="Secret">Secret</option>
                                            <option value="Confidential">Confidential</option>
                                            <option value="Internal use">Internal use</option>
                                            <option value="Public">Public</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mt-3">
                                        <h6>Create / Update / Upload</h6>
                                        <select id="tags-create" name="tags_create[]" multiple="multiple"
                                            class="form-control select2tags" required>
                                            <?php foreach ($user_data as $user): ?>
                                                <?php if (session()->get('id') === $user['id_user']): ?>
                                                    <option value="<?= $user['id_user']; ?>" selected>
                                                        <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                    </option>
                                                <?php else: ?>
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
                                        <h6>Review</h6>
                                        <select id="tags-review" name="tags_review[]" multiple="multiple"
                                            class="form-control" required>
                                            <?php foreach ($user_data as $user): ?>
                                                <?php if ($user['status'] === '0')
                                                    continue; ?>
                                                <option value="<?= $user['id_user']; ?>">
                                                    <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mt-3">
                                        <h6>Approve</h6>
                                        <select id="tags-approve" name="tags_approve[]" multiple="multiple"
                                            class="form-control" required>
                                            <?php foreach ($user_data as $user): ?>
                                                <?php if ($user['status'] === '0')
                                                    continue; ?>
                                                <option value="<?= $user['id_user']; ?>">
                                                    <?= $user['name_user'] . ' ' . $user['lastname_user']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <div class="form-group">
                                        <h6>Attach File</h6>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="risk-file"
                                                accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
                                            <label class="custom-file-label" for="risk-file">Choose file</label>
                                        </div>
                                        <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                                    </div>
                                </div>
                            </div>
                            <?php if ($data_doc != null): ?>
                                <div class="row mt-3 d-flex justify-content-end">
                                    <div class="col-lg-3">
                                        <div class="form-group mt-3">
                                            <h6>Created By</h6>
                                            <input class="form-control gray-text" type="text" name="createdby"
                                                id="createdby" disabled></input>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mt-3">
                                            <h6>Creation Date</h6>
                                            <input class="form-control gray-text" type="datetime-local" name="creationtime"
                                                id="creationtime" disabled></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col-lg-3">
                                        <div class="form-group mt-3">
                                            <h6>Last Modified By</h6>
                                            <input class="form-control gray-text" type="text" name="lastmodifiedby"
                                                id="lastmodifiedby" disabled></input>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mt-3">
                                            <h6>Last Modified Date</h6>
                                            <input class="form-control gray-text" type="datetime-local"
                                                name="lastmodifiedtime" id="lastmodifiedtime" disabled></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col-lg-3">
                                        <div class="form-group mt-3">
                                            <h6>Approved By</h6>
                                            <input class="form-control gray-text" type="text" name="approvedby"
                                                id="approvedby" disabled></input>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mt-3">
                                            <h6>Approval Date</h6>
                                            <input class="form-control gray-text" type="datetime-local" name="approvaldate"
                                                id="approvaldate" disabled></input>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="d-flex justify-content-center mb-5">
                                <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
                                <button type="reset" class="btn btn-danger" style="margin-left: 30px;">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>

    <script>
        $("#form_documented").on('submit', function (event) {
            event.preventDefault();
            var data_doc = <?php echo json_encode($data_doc); ?>;
            var doc_type_select = document.getElementById("doc-type-select");
            var secret_level = document.getElementById("doc-secret-level");
            console.log(doc_type_select.value, secret_level.value);
            if (doc_type_select.value == 0 || secret_level.value == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select all fields!'
                });
                return false;
            } else {
                if (data_doc !== null) {
                    //edit url
                } else {
                    //create url
                    var url = 'support/documentation/create/insert/<?= $data['id_version'] . '/' . $data['num_ver'] . '/' . $data['status'] ?>';
                }
                action_(url, 'form_documented');
            }
        });
    </script>
    <script>
        function action_(url, form) {
            var formData = new FormData(document.getElementById(form));

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
                                window.location.href = '<?= base_url('support/documentation/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>';
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
        $(document).ready(function () {
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
        });
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>