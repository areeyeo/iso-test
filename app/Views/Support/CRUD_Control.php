<title>Documented Information Version</title>
<!DOCTYPE html>
<html lang="en">
<style>
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
</head>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Documented Information
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-default" id="load-modal-button">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('context/context_analysis/index/17'); ?>">Documented Information</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('support/documentation/index/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Version <?= $data['num_ver'] ?></a></li>
                            <li class="breadcrumb-item"><a>Document Control</a></li>
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
                            <h2 class="card-title">Document Control</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="mb-3" id="form_documented_control" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                            <div class="d-flex justify-content-end align-items-baseline">
                                <span>Version Document:
                                    <?php $version = explode('.', $data_doc['version']);
                                    echo $version[1] . '.' . $version[2] . '.' . $version[3] ?>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Type</h6>
                                        <input class="form-control gray-text" type="text" name="doc-type-select" id="doc-type-select" disabled value="<?= $data_doc['document_type']; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Abbreviation</h6>
                                        <input class="form-control gray-text" type="text" name="document_abbreviation" id="document_abbreviation" disabled value="<?= $data_doc['document_abbreviation']; ?>"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Name TH</h6>
                                        <input class="form-control gray-text" type="text" name="nameth" id="nameth" disabled value="<?= $data_doc['name_th']; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Name ENG</h6>
                                        <input class="form-control gray-text" type="text" name="nameen" id="nameen" disabled value="<?= $data_doc['name_eng']; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Secret Level</h6>
                                        <input class="form-control gray-text" type="text" name="doc-secret-level" id="doc-secret-level" disabled value="<?= $data_doc['secret_level']; ?>"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Document Owner</h6>
                                        <input class="form-control gray-text" type="text" name="docown" id="docown" value="<?= $data_doc['document_owner']; ?>" <?= $edit_mode ?>></input>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>File</h6>
                                        <div class="input-group">
                                            <input class="form-control gray-text" type="text" name="file" id="file" disabled value="<?= $data_doc['id_file'] ? $data_doc['id_file']['name_file'] : 'No File' ?>"></input>
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
                                <div class="col-lg-4">
                                    <div class="form-group mt-3">
                                        <h6>Release date</h6>
                                        <input class="form-control gray-text" type="datetime-local" name="releasedate" id="releasedate" value="<?= $data_doc['release_date']; ?>" <?= $edit_mode ?>></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 d-flex justify-content-end">
                                <div class="col-lg-3">
                                    <div class="form-group mt-3">
                                        <h6>Created By</h6>
                                        <input class="form-control gray-text" type="text" name="createdby" id="createdby" disabled value="<?= $data_doc['created_by']; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mt-3">
                                        <h6>Creation Date</h6>
                                        <input class="form-control gray-text" type="datetime-local" name="creationtime" id="creationtime" disabled value="<?= $data_doc['creation_time']; ?>"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-lg-3">
                                    <div class="form-group mt-3">
                                        <h6>Last Modified By</h6>
                                        <input class="form-control gray-text" type="text" name="lastmodifiedby" id="lastmodifiedby" disabled value="<?= $data_doc['last_modified_by']; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mt-3">
                                        <h6>Last Modified Date</h6>
                                        <input class="form-control gray-text" type="datetime-local" name="lastmodifiedtime" id="lastmodifiedtime" disabled value="<?= $data_doc['last_modified_time']; ?>"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-lg-3">
                                    <div class="form-group mt-3">
                                        <h6>Review By</h6>
                                        <input class="form-control gray-text" type="text" name="lastmodifiedby" id="lastmodifiedby" disabled value="<?= $data_doc['review_by']; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mt-3">
                                        <h6>Review Date</h6>
                                        <input class="form-control gray-text" type="datetime-local" name="lastmodifiedtime" id="lastmodifiedtime" disabled value="<?= $data_doc['review_time']; ?>"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-lg-3">
                                    <div class="form-group mt-3">
                                        <h6>Approved By</h6>
                                        <input class="form-control gray-text" type="text" name="approvedby" id="approvedby" disabled value="<?= $data_doc['approver_by']; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mt-3">
                                        <h6>Approval Date</h6>
                                        <input class="form-control gray-text" type="datetime-local" name="approvaldate" id="approvaldate" disabled value="<?= $data_doc['approval_time']; ?>"></input>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <?php if ($edit_mode != 'disabled') : ?>
                            <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
                            <button type="reset" class="btn btn-danger" style="margin-left: 30px;">Cancel</button>
                        <?php endif; ?>
                    </div>
                    </form>
                </div>
            </div>
    </div>
    </section>
    <div class="modal fade" id="modal-default">
        <div id="modal_requirement">
            <?= $this->include("Modal/Requirement_Modal"); ?>
        </div>
    </div>
    <script>
        var data_doc = <?php echo json_encode($data_doc); ?>;
        var data = <?php echo json_encode($data); ?>;
        $("#form_documented_control").on('submit', function(e) {
            e.preventDefault();
            var url = "support/documentation/documentControl/edit/" + data_doc['id_document_create_update'] + "/" + data['id_version'] + "/" + data['status'];
            action_(url, 'form_documented_control');
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
</body>

</html>