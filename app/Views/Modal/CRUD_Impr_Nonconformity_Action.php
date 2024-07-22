<?php
$data = [
    'type' => 'Nonconformity Issue',
];

$type = $data['type'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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
</head>

<body>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="title_modal" name="title_modal">Nonconformity & Action</h4>
            </div>
            <div class="modal-body">
                <form class="mb-3" id="form_crud" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                    <div>
                        <h6>Description</h6>
                    </div>
                    <div>
                        <h6 class="gray-text" name="description_detail" id="description_detail">
                            รอใส่คำอธิบายเพิ่มเติม
                        </h6>
                    </div>
                    <div>
                        <h6 class="gray-text" name="description" id="description"></h6>
                    </div>
                    <div class="form-group mt-3">
                        <h6>Audit Report No.</h6>
                        <input class="form-control gray-text" type="text" placeholder="Text..." name="auditreport" id="auditreport"></input>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-5">
                            <h6>Type</h6>
                            <input class="form-control gray-text" type="text" placeholder="Text..." name="type" id="type" value="<?php echo htmlspecialchars($type); ?>" readonly></input>
                        </div>
                        <div class="col-lg-7">
                            <?php if ($type === 'Nonconformity Issue') : ?>
                                <div class="form-group" id="ipnonconformity">
                                    <h6>Nonconformity Issue</h6>
                                    <input class="form-control gray-text" type="text" placeholder="Text..." name="nonconformity" id="nonconformity">
                                </div>
                            <?php elseif ($type === 'Observation Issue') : ?>
                                <div class="form-group" id="ipobservation">
                                    <h6>Observation Issue</h6>
                                    <input class="form-control gray-text" type="text" placeholder="Text..." name="observation" id="observation">
                                </div>
                            <?php elseif ($type === 'Opportunity Issue') : ?>
                                <div class="form-group" id="ipopportunity">
                                    <h6>Opportunity Issue</h6>
                                    <input class="form-control gray-text" type="text" placeholder="Text..." name="opportunity" id="opportunity">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <h6>Corrective Action</h6>
                        <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="correctiveaction" id="correctiveaction"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <?php if ($type === 'Nonconformity Issue') : ?>
                                <div class="form-group">
                                <h6>Level of Nonconformity</h6>
                                <input class="form-control gray-text" type="text" placeholder="Text..." name="levelnonconformity" id="levelnonconformity"></input>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <h6>Requirements/Control</h6>
                                <input class="form-control gray-text" type="text" placeholder="Text..." name="control" id="control"></input>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <h6>Detail</h6>
                                <textarea class="form-control gray-text" rows="4" placeholder="Text..." name="detail" id="detail"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h6>Responsible Person</h6>
                        <input class="form-control gray-text" type="text" placeholder="Text..." name="responsibleperson" id="responsibleperson"></input>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <h6>Start Date</h6>
                                <input class="form-control gray-text" type="date" name="start_date" id="start_date"></input>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <h6>End Date</h6>
                                <input class="form-control gray-text" type="date" name="end_date" id="end_date"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <h6>Annual</h6>
                                <input class="form-control gray-text" type="number" id="annual" name="annual" min="1900" max="2100" placeholder="yyyy" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <h6>Finish Date</h6>
                                <input class="form-control gray-text" type="date" name="end_date" id="end_date"></input>
                            </div>
                        </div>
                    </div>
                    <input type="text" id="url_route" name="url_route" hidden>
                    <input type="text" id="check_type" name="check_type" hidden>
                    <input type="text" id="id_" name="id_" hidden>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="submit" value="Submit">SAVE</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".overlay").hide();

            // ใช้งาน select2 กับ select tags-reportname
            var selectData = ["AR_001 รายงานโปรเจคตัวอย่างที่ 1", "AR_002 รายงานโปรเจคตัวอย่างที่ 2", "AR_003 รายงานโปรเจคตัวอย่างที่ 3", "AR_004 รายงานโปรเจคตัวอย่างที่ 4", "AR_005 รายงานโปรเจคตัวอย่างที่ 5"];
            $('#tags-reportname').select2({
                data: selectData,
                placeholder: "Select or Search",
                tags: false,
                tokenSeparators: [',', ' '],
                width: '100%',
                maximumSelectionLength: 1
            });

            $("#form_crud").on('submit', function(e) {
                e.preventDefault();
                const urlRouteInput = document.getElementById("url_route");
                action_(urlRouteInput.value, 'form_crud');
            });
        });
    </script>
</body>

</html>