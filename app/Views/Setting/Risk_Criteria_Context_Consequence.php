<title>Risk Criteria Information Security</title>
<style>
    .table th,
    .table td {
        text-align: center;
    }
    .blue-text {
        color: #0000FF;
    }
</style>
<?php
$count_1 = 0;
$count_2 = 0;
?>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Page header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="">
                    <h3>&nbsp;Risk Criteria Context</h3>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4>
                                Consequence Level
                            </h4>
                            <div class="d-flex align-items-center">
                                <span>Impact Level:</span>
                                <div class="" style="margin-left: 10px; margin-right: 10px;">
                                    <select class="custom-select" id="select_impact_level">
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                            <?php if ($i == $impact_level[0]['number_level']): ?>
                                                <option value="<?= $i ?>" selected>
                                                    <?= $i ?>
                                                </option>
                                            <?php else: ?>
                                                <option value="<?= $i ?>">
                                                    <?= $i ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#modal-consequence" onclick="load_modal(1)">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Consequence
                                </button>
                            </div>
                        </div>
                        <?php if (!empty($consequence_level_context)): ?>
                            <nav style="border-color: #0000FF">
                                <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist" >
                                    <?php foreach ($consequence_level_context as $item): ?>
                                        <?php if ($count_1 == 0):
                                            $count_1++ ?>
                                            <button class="nav-link active" style="color: #0000FF;"
                                                id="nav-<?php echo $item['id_consequence_level_context']; ?>-tab" data-toggle="tab"
                                                data-target="#nav-<?php echo $item['id_consequence_level_context']; ?>"
                                                type="button" role="tab"
                                                aria-controls="nav-<?php echo $item['id_consequence_level_context']; ?>"
                                                aria-selected="true">
                                                <?php echo $item['consequence_name']; ?>
                                            </button>
                                        <?php else: ?>
                                            <button class="nav-link"
                                                id="nav-<?php echo $item['id_consequence_level_context']; ?>-tab" data-toggle="tab"
                                                data-target="#nav-<?php echo $item['id_consequence_level_context']; ?>"
                                                type="button" role="tab"
                                                aria-controls="nav-<?php echo $item['id_consequence_level_context']; ?>"
                                                aria-selected="false">
                                                <?php echo $item['consequence_name']; ?>
                                            </button>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </nav>
                            <div class="tab-content mt-3" id="nav-tabContent">
                                <?php foreach ($consequence_level_context as $key => $item) { ?>
                                    <?php if ($count_2 == 0):
                                        $count_2++; ?>
                                        <div class="tab-pane fade show active"
                                            id="nav-<?php echo $item['id_consequence_level_context']; ?>" role="tabpanel"
                                            aria-labelledby="nav-<?php echo $item['id_consequence_level_context']; ?>-tab"
                                            style="padding: 10px;">
                                        <?php else: ?>
                                            <div class="tab-pane fade" id="nav-<?php echo $item['id_consequence_level_context']; ?>"
                                                role="tabpanel"
                                                aria-labelledby="nav-<?php echo $item['id_consequence_level_context']; ?>-tab"
                                                style="padding: 10px;">
                                            <?php endif; ?>
                                            <div class="d-flex justify-content-between">
                                                <span style="font-size: 15pt;">
                                                    <?php echo $item['consequence_name']; ?>
                                                </span>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    style="margin-left: 10px;"
                                                    onclick="deleteConsequence(<?php echo $item['id_consequence_level_context']; ?>, '<?php echo $item['consequence_name']; ?>')">
                                                    <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete
                                                </button>
                                            </div>
                                            <table id="consequence" class="table table-hover mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>ACTION</th>
                                                        <th>NAME</th>
                                                        <th>IMPACT LEVEL</th>
                                                        <th>DESCRIPTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($item['data_item'] as $index => $row) { ?>
                                                        <tr>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <i class="fas fa-ellipsis-v pointer text-primary"
                                                                        id="dropdownMenuButtonPlanning<?php echo $index; ?>"
                                                                        data-toggle="dropdown" aria-expanded="false"></i>
                                                                    <ul class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButtonPlanning<?php echo $index; ?>">
                                                                        <li data-toggle="modal" data-target="#modal-consequence"
                                                                            onclick="load_modal(2,<?= $key; ?>,<?= $index; ?>)"><a
                                                                                class="dropdown-item" href="#">Edit</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <td class="blue-text">
                                                                <?php echo $row['name']; ?>
                                                            </td>
                                                            <td class="blue-text">
                                                                <?php echo $row['impact_level']; ?>
                                                            </td>
                                                            <td class="blue-text">
                                                                <?php echo $row['description']; ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <h3 class="text-center">No Data</h3>
                        <?php endif; ?>
                    </div>
                </div>
        </section>
    </div>
</body>
<div class="modal fade" id="modal-consequence">
    <div id="modal_crud_criteria_consequence">
        <?= $this->include("Modal/CRUD_Criteria_Context_Consequence"); ?>
    </div>
    <div id="modal_crud_criteria_consequence_item">
        <?= $this->include("Modal/CRUD_Criteria_Context_Consequence_Item"); ?>
    </div>
</div>

<script>
    function load_modal(check, check_type, data_encode) {
        modal_crud_criteria_consequence = document.getElementById("modal_crud_criteria_consequence");
        modal_crud_criteria_consequence_item = document.getElementById("modal_crud_criteria_consequence_item");

        if (check == '1') {
            //--show modal create consequence --//
            modal_crud_criteria_consequence.style.display = "block";
            modal_crud_criteria_consequence_item.style.display = "none"

            $(".modal-body #url_route").val('planning/risk_Criteria_Context_Consequence/create');

        } else if (check == '2') {
            //--show modal edit consequence --//
            modal_crud_criteria_consequence.style.display = "none";
            modal_crud_criteria_consequence_item.style.display = "block"
            var element = <?php echo json_encode($consequence_level_context); ?>;
            $(".modal-body #consequencename").val(element[check_type].consequence_name);
            $(".modal-body #impactlevel").val(element[check_type].data_item[data_encode].impact_level);
            $(".modal-body #name").val(element[check_type].data_item[data_encode].name);
            $(".modal-body #description").val(element[check_type].data_item[data_encode].description);
            $(".modal-body #url_route").val('planning/risk_Criteria_Context_Consequence/edit/' + element[check_type].data_item[data_encode].id_consequence_level_item_context);
        }
    }
</script>
<script>
    function deleteConsequence(index, text) {
        var url_select = 'planning/risk_Criteria_Context_Consequence/delete/' + index;
        confirm_Alert('Do you want to delete this Consequence' + ' ' + text, url_select);
    }
</script>
<script>
    var select_impact_level = document.getElementById("select_impact_level");
    select_impact_level.addEventListener("change", function () {
        var url_select = 'planning/risk_Criteria_Context_Consequence/change_impact_level/' + select_impact_level.value;
        action_(url_select, null);
    })
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
                        allowOutsideClick: false
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