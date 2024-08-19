<title>RA & RTP Result IS</title>

<style>
    table {
        table-layout: fixed;
        width: 100%;
    }

    tr:nth-child(even) {
        background-color: #F5F5F5;
    }

    th {
        background-color: #F5F6FA;
        text-align: center;
        border-bottom: none;
    }

    tbody {
        border-bottom: 10px solid #ccc;
        text-align: center;
    }

    .table thead th {
        border-bottom: none;
    }

    .custom-select {
        background-color: #fff;
        border: 1px solid #007BFF;
        color: #007BFF;
        font-size: 14px;
        padding: .375rem .75rem;
        margin-bottom: 10px;
    }

    /* Column 1: ACTION */
    .ri-column-1 {
        width: 100px !important;
    }

    /* Column 2: NO. */
    .ri-column-2 {
        width: 50px !important;
    }

    /* Column 3: TYPE */
    .ri-column-3 {
        width: 200px !important;
    }

    /* Column 4: ASSET GROUP */
    .ri-column-4 {
        width: 200px !important;
    }

    /* Column 5: THREAT */
    .ri-column-5 {
        width: 300px !important;
        white-space: normal;
    }

    /* Column 6: VULNERABILITY */
    .ri-column-6 {
        width: 300px !important;
    }

    /* Column 7: EXISTING CONTROLS */
    .ri-column-7 {
        width: 300px !important;
    }

    /* Column 8: CONSEQUENCE */
    .ri-column-8 {
        width: 250px !important;
    }

    /* Column 9: IMPACT */
    .ri-column-9 {
        width: 100px !important;
        white-space: normal;
    }

    /* Column 10: LIKELIHOOD */
    .ri-column-10 {
        width: 150px !important;
    }

    /* Column 11: RISK LEVEL */
    .ri-column-11 {
        width: 150px !important;
    }

    /* Column 12: RISK ASSESSMENT LEVEL */
    .ri-column-12 {
        width: 180px !important;
    }

    /* Column 13: RISK OPTIONS */
    .ri-column-13 {
        width: 200px !important;
        white-space: normal;
    }

    /* Column 14: NAME OF RISK TREATMENT PLAN */
    .ri-column-14 {
        width: 250px !important;
    }

    /* Column 15: EVALUATION */
    .ri-column-15 {
        width: 150px !important;
    }

    /* Column 16: RISK OWNER */
    .ri-column-16 {
        width: 150px !important;
    }

    /* Column 17: START DATE */
    .ri-column-17 {
        width: 150px !important;
    }

    /* Column 18: END DATE */
    .ri-column-18 {
        width: 150px !important;
    }

    /* Column 19: APPROVE */
    .ri-column-19 {
        width: 150px !important;
    }

    /* Column 20: RTP STATUS */
    .ri-column-20 {
        width: 150px !important;
    }

    /* Column 21: FILE */
    .ri-column-21 {
        width: 250px !important;
    }

    /* Column 22: CONSEQUENCE (repeated) */
    .ri-column-22 {
        width: 250px !important;
    }

    /* Column 23: IMPACT (repeated) */
    .ri-column-23 {
        width: 150px !important;
    }

    /* Column 24: LIKELIHOOD (repeated) */
    .ri-column-24 {
        width: 150px !important;
    }

    /* Column 25: RESIDUAL */
    .ri-column-25 {
        width: 150px !important;
    }

    /* Column 26: RTP NO. */
    .ri-column-26 {
        width: 150px !important;
    }

    /* Column 1: ACTION */
    .op-is-column-1 {
        width: 100px !important;
    }

    /* Column 2: NO. */
    .op-is-column-2 {
        width: 50px !important;
    }

    /* Column 3: TYPE */
    .op-is-column-3 {
        width: 200px !important;
    }

    /* Column 4: ASSET GROUP */
    .op-is-column-4 {
        width: 200px !important;
    }

    /* Column 5: QUANTITY OF PLANNING */
    .op-is-column-5 {
        width: 250px !important;
        white-space: normal;
    }

    /* Column 6: OPPORTUNITY PLANNINGS */
    .op-is-column-6 {
        width: 300px !important;
    }

    /* Column 7: RISK OWNER */
    .op-is-column-7 {
        width: 150px !important;
    }

    /* Column 8: START DATE */
    .op-is-column-8 {
        width: 150px !important;
    }

    /* Column 9: END DATE */
    .op-is-column-9 {
        width: 150px !important;
    }

    /* Column 10: FILE */
    .op-is-column-10 {
        width: 300px !important;
        white-space: normal;
    }
</style>

<!-- Main content -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Details</h2>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;"><a href="<?= site_url('context/context_analysis/index/' . $data['type_version']) ?>" style="color: #ADB5BD;">Version</a></button>
            <button class="badge badge-edit" style="background-color: #FFFFFF;  border: 1px solid #ADB5BD;">
                <a href="<?= base_url('planning/planningAddressRisksOpp/is/timeline_log/' . $data['id_version'] . '/' . $data['type_version'] . '/' . $data['num_ver']) ?>" style="color: #ADB5BD;">History</a>
            </button>
            <button class="badge badge-edit" style="background-color: #007BFF; color: #ffffff; border: 1px solid #007BFF" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                    <div class="dropdown-menu">
                        <!-- Second-level dropdown items -->
                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Reviewed หรือไม่', 'is/status_update/<?= $data['id_version'] ?>/1')">Pending
                            Review</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Review หรือไม่', 'is/status_update/<?= $data['id_version'] ?>/2')">Review</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(7,5)">Reject Review</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Pending Approve หรือไม่', 'is/status_update/<?= $data['id_version'] ?>/3')">Pending
                            Approve</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Approved หรือไม่', 'is/status_update/<?= $data['id_version'] ?>/4')">Approved</a>
                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(7,6)">Reject
                            Approved</a>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">Update</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" onclick="confirm_Alert('Would you like to confirm the update review date?', 'is/update_date/<?= $data['id_version'] ?>/1')">Update
                            review date</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" onclick="confirm_Alert('ต้องการที่จะ Copy ข้อมูลหรือไม่', 'is/copydata/<?= $data['id_version'] ?>')">Revise</a>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" data-toggle="modal" data-target="#modal-default" id="load-modal-button" href="#" onclick="load_modal(6)">Create Note</a>
            </div>

            <i class="fas fa-cog" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(2)"></i>
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
<div class="card" id="is-ana">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <div class="form-group">
                    <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                        <li class="nav-item-tab" style="padding-right: 10px;">
                            <a class="nav-link active" id="risk-is-tab" data-toggle="pill" href="#risk-is" role="tab" aria-controls="risk-is" aria-selected="true">Risk</a>
                        </li>
                        <li class="nav-item-tab">
                            <a class="nav-link" id="opportunity-is-tab" data-toggle="pill" href="#opportunity-is" role="tab" aria-controls="opportunity-is" aria-selected="false" onclick="getTableData2()">Opportunity</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class=" d-flex">
                <div id="btn-Awareness" name="btn-Awareness">
                    <a type="button" class="btn btn-outline-primary" href="<?= base_url('planning/crud_is_risk_opp/' . $data['id_version'] . '/' . $data['num_ver']) ?>">
                        <span class="text-nowrap"><i class="fas fa-edit"></i>Create IS</span>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="risk-is" role="tabpanel" aria-labelledby="org-strategy-tab">
                <div class="d-flex justify-content-start align-items-center" id="content-risk-table">
                    <span>Content:</span>
                    <div class="col-4 d-flex">
                        <select class="custom-select" id="select-content">
                            <option value="1">Risks that must be prepared as a risk treatment plan.</option>
                            <option value="2">Risks that do not have risks exceeding the risk assessment level.
                            </option>
                            <option value="3">Risks that are being done risk treatment.</option>
                            <option value="4">Risks that have completed risk treatment</option>
                            <option value="0" selected>All risk is.</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <select class="custom-select" id="table-display-select">
                            <option value="full">Full Table</option>
                            <option value="short">Short Table</option>
                        </select>
                    </div>
                </div>
                <div>
                    <table id="risk-is-table-full" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center ri-column-1">ACTION</th>
                                <th class="ri-column-2">NO.</th>
                                <th class="ri-column-3">TYPE</th>
                                <th class="ri-column-4">ASSET GROUP</th>
                                <th class="ri-column-5">THREAT</th>
                                <th class="ri-column-6">VULNERABILITY</th>
                                <th class="ri-column-7">EXISTING CONTROLS</th>
                                <th class="text-center ri-column-8">CONSEQUENCE</th>
                                <th class="ri-column-9">IMPACT</th>
                                <th class="ri-column-10">LIKELIHOOD</th>
                                <th class="ri-column-11">RISK LEVEL</th>
                                <th id="display_element_risk" class="ri-column-12">RISK ASSESSMENT LEVEL</th>
                                <th class="ri-column-13">RISK OPTIONS</th>
                                <th class="ri-column-14">NAME OF RISK TREATMENT PLAN</th>
                                <th class="ri-column-15">EVALUATION</th>
                                <th class="ri-column-16">RISK OWNER</th>
                                <th id="display_element_startdate" class="ri-column-17">START DATE</th>
                                <th id="display_element_enddate" class="ri-column-18">END DATE</th>
                                <th id="display_element_approve" class="ri-column-19">APPROVE</th>
                                <th id="display_element_rtp" class="ri-column-20">RTP STATUS</th>
                                <th id="display_element_file" class="ri-column-21">FILE</th>
                                <th class="text-center ri-column-22" id="display_element">CONSEQUENCE</th>
                                <th class="ri-column-23" id="display_element_impact">IMPACT</th>
                                <th class="ri-column-24" id="display_element_likelihood">LIKELIHOOD</th>
                                <th class="ri-column-25">RESIDUAL</th>
                                <th class="ri-column-26">RTP NO.</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="opportunity-is" role="tabpanel" aria-labelledby="opportunity-is-tab">
                <table id="opp_is_table" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center op-is-column-1">ACTION</th>
                            <th class="op-is-column-2">NO.</th>
                            <th class="op-is-column-3">TYPE</th>
                            <th class="op-is-column-4">ASSET GROUP</th>
                            <th class="op-is-column-5">QUANTITY OF PLANNING</th>
                            <th class="text-center op-is-column-6">OPPORTUNITY PLANNINGS</th>
                            <th class="text-center op-is-column-7">RISK OWNER</th>
                            <th class="text-center op-is-column-8">START DATE</th>
                            <th class="text-center op-is-column-9">END DATE</th>
                            <th class="text-center op-is-column-10">FILE</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        getTableData1();
        getTableData2();
        setTimeout(function() {
            var table1 = $('#risk-is-table-full').DataTable();
            table1.columns.adjust().draw();
            var table2 = $('#opp_is_table').DataTable();
            table2.columns.adjust().draw();
        }, 2000);
    });
</script>
<script>
    var countTable1 = 0;
    var data_lenght = 0;
    var table_show = true;

    function getTableData1() {
        if (countTable1 === 0) {
            var select_Content = document.getElementById('select-content');

            countTable1++;
            var data_version = <?php echo json_encode($data); ?>;
            if (data_version.status === '4' || data_version.status === '5') {
                var disabledAttribute = 'disabled';
            }
            if ($.fn.DataTable.isDataTable('#risk-is-table-full')) {
                $('#risk-is-table-full').DataTable().destroy();
            }
            $('#risk-is-table-full').DataTable({
                "processing": true,
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('planning/planningAddressRisksOpp/is/risk/getdata/'); ?>" + data_version.id_version,
                    'type': 'GET',
                    'data': {
                        'select_Content': select_Content.value
                    }
                },
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "searching": true,
                "ordering": false,
                "scrollX": true,
                "drawCallback": function(settings) {
                    var daData = settings.json.data;
                    data_lenght = daData.length;
                    if (daData.length == 0) {
                        $('#risk-is-table-full tbody').html(`
                            <tr>
                                <td colspan="5">
                                    <div class="dropdown">
                                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" ${disabledAttribute}>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('planning/crud_is_risk_opp/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Create</a>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="15">
                                </td>
                            </tr>`);
                    }
                },
                'columns': [{
                        'data': null,
                        'class': 'text-center ri-column-1',
                        'width': 100,
                        'render': function(data, type, row, meta) {
                            var number_index = +meta.settings.oAjaxData.start + 1;
                            const encodedRowData = encodeURIComponent(JSON.stringify(row));
                            let dropdownHtml = `
                                <div class="dropdown">
                                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        ${disabledAttribute}></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?= base_url('planning/crud_is_risk_opp/edit/' . $data['id_version'] . '/' . $data['num_ver']) ?>/${data.id_address_risks_is}">Edit</a>    
                                        <a class="dropdown-item" href="<?= base_url('planning/crud_is_risk_opp/view/' . $data['id_version'] . '/' . $data['num_ver']) ?>/${data.id_address_risks_is}">View Detail</a>    
                                        <a class="dropdown-item" href="#"
                                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'planning/planningAddressRisksOpp/is/risk/delete/${data.id_address_risks_is}/${number_index}/${data_version.id_version}/${data_version.status}')">Delete</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url('planning/crud_is_risk_opp/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Create</a>`;
                            dropdownHtml += `</div>
                                </div>`;
                            return dropdownHtml;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-2',
                        'width': 500,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-3',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.type + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-4',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.asset_group + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-5',
                        'width': 300,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.threat + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-6',
                        'width': 300,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.vulnerability + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-7',
                        'width': 300,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.existing_controls + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left ri-column-8',
                        'width': 250,
                        'render': function(data, type, row, meta) {
                            var html_consequence = '';
                            var data_consequence = data.consequence.split(',')
                            for (var i = 0; i < data_consequence.length; i++) {
                                var number = data_consequence[i].split('-')
                                html_consequence += '<li style="color: rgba(0, 123, 255, 1);">' + data.consequence_data[i].consequence_name + ': ' + number[1] + '</li>';
                            }
                            return html_consequence;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-9',
                        'width': 100,
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            var max_value = 0;
                            var data_consequence = data.consequence.split(',')
                            for (var i = 0; i < data_consequence.length; i++) {
                                var number = data_consequence[i].split('-')
                                if (number[1] > max_value) {
                                    max_value = number[1];
                                }
                            }
                            return '<div style="color: rgba(0, 123, 255, 1);">' + max_value + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-10',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.likelihood + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-11',
                        'width': 100,
                        'render': function(data, type, row, meta) {
                            return data.risk_level;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-12',
                        'width': 180,
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.risk_assessment_level + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-13',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.risk_options ?? '') + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-14',
                        'width': 500,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.name_of_risk_treatment_plan ?? '') + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-15',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.evaluation ?? '') + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-16',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.risk_ownner ?? '') + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-17',
                        'width': 100,
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.start_date ?? '') + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-18',
                        'width': 100,
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.end_date ?? '') + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-19',
                        'width': 100,
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.approve ?? '') + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-20',
                        'width': 200,
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            if (data.rtp_status != null) {
                                if (data.rtp_status == 'รอดำเนินการ') {
                                    return '<p style="color: #DC3545; border-style: solid">' + data.rtp_status + '</p>';
                                } else if (data.rtp_status == 'ดำเนินการเสร็จสิ้น') {
                                    return '<div style="color: #28A745; border-style: solid">' + data.rtp_status + '</div>';
                                } else if (data.rtp_status == 'กำลังดำเนินการ') {
                                    return '<div style="color: #FFC107; border-style: solid">' + data.rtp_status + '</div>';
                                }
                            } else {
                                return '<div style="color: rgba(0, 123, 255, 1);">ไม่มีข้อมูล</div>';
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-21',
                        'width': 200,
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            if (data.risk_options != null) {
                                if (data.file != null) {
                                    return `<a href="<?php echo base_url('openfile/'); ?>${data.file.id_files}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">
                                ${data.file.name_file}
                                </a>`
                                } else {
                                    return '<div style="color: rgba(0, 123, 255, 1);">No File</div>';
                                }
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left ri-column-22',
                        'width': 250,
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            var html_consequence = '';
                            if (data.consequence_after != null) {
                                var data_consequence_after = data.consequence_after.split(',')
                                for (var i = 0; i < data_consequence_after.length; i++) {
                                    var number = data_consequence_after[i].split('-')
                                    html_consequence += '<li style="color: rgba(0, 123, 255, 1);">' + data.consequence_after_data[i].consequence_name + ': ' + number[1] + '</li>';
                                }
                                return html_consequence;
                            } else {
                                return '';
                            }

                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-23',
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            var max_value = 0;
                            if (data.consequence_after != null) {
                                var data_consequence = data.consequence_after.split(',')
                                for (var i = 0; i < data_consequence.length; i++) {
                                    var number = data_consequence[i].split('-')
                                    if (number[1] > max_value) {
                                        max_value = number[1];
                                    }
                                }
                                return '<div style="color: rgba(0, 123, 255, 1);">' + max_value + '</div>';
                            } else {
                                return '';
                            }

                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-24',
                        'visible': table_show,
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.likelihood_after ?? '') + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-25',
                        'render': function(data, type, row, meta) {
                            return (data.residual ?? '');
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center ri-column-26',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (data.rtp_no ?? '') + '</div>';
                        }
                    },
                ],
                createdRow: function(row, data, index) {
                    var Risk_level_is = <?php echo json_encode($Risk_level_is); ?>;
                    if (table_show) {
                        if (Risk_level_is != null) {
                            Risk_level_is.forEach(element => {
                                if (parseInt(data.risk_level) >= element.minimum && parseInt(data.risk_level) <= element.maximum) {
                                    $('td:eq(6)', row).css('background-color', element.risk_color);
                                }
                                if (data.residual != null) {
                                    if (parseInt(data.residual) >= element.minimum && parseInt(data.residual) <= element.maximum) {
                                        $('td:eq(20)', row).css('background-color', element.risk_color);
                                    }
                                }
                            });
                        } else {
                            if (parseInt(data.risk_level) <= 4) {
                                $('td:eq(6)', row).css('background-color', '#92D050');
                            } else if (parseInt(data.risk_level) <= 9) {
                                $('td:eq(6)', row).css('background-color', '#FFFF00');
                            } else if (parseInt(data.risk_level) <= 19) {
                                $('td:eq(6)', row).css('background-color', '#FFC000');
                            } else {
                                $('td:eq(6)', row).css('background-color', '#FD2B2B');
                            }
                        }

                        if (Risk_level_is != null) {
                            Risk_level_is.forEach(element => {
                                if (parseInt(data.risk_level) >= element.minimum && parseInt(data.risk_level) <= element.maximum) {
                                    $('td:eq(6)', row).css('color', element.text_color);
                                }
                                if (data.residual != null) {
                                    if (parseInt(data.residual) >= element.minimum && parseInt(data.residual) <= element.maximum) {
                                        $('td:eq(20)', row).css('color', element.text_color);
                                    }
                                }
                            })
                        } else {
                            $('td:eq(6)', row).css('color', '"#000000"');
                        }
                    } else {
                        if (Risk_level_is != null) {
                            Risk_level_is.forEach(element => {
                                if (parseInt(data.risk_level) >= element.minimum && parseInt(data.risk_level) <= element.maximum) {
                                    $('td:eq(5)', row).css('background-color', element.risk_color);
                                }
                                if (data.residual != null) {
                                    if (parseInt(data.residual) >= element.minimum && parseInt(data.residual) <= element.maximum) {
                                        $('td:eq(10)', row).css('background-color', element.risk_color);
                                    }
                                }
                            });
                        } else {
                            if (parseInt(data.risk_level) <= 4) {
                                $('td:eq(5)', row).css('background-color', '#92D050');
                            } else if (parseInt(data.risk_level) <= 9) {
                                $('td:eq(5)', row).css('background-color', '#FFFF00');
                            } else if (parseInt(data.risk_level) <= 19) {
                                $('td:eq(5)', row).css('background-color', '#FFC000');
                            } else {
                                $('td:eq(5)', row).css('background-color', '#FD2B2B');
                            }
                        }

                        if (Risk_level_is != null) {
                            Risk_level_is.forEach(element => {
                                if (parseInt(data.risk_level) >= element.minimum && parseInt(data.risk_level) <= element.maximum) {
                                    $('td:eq(5)', row).css('color', element.text_color);
                                }
                                if (data.residual != null) {
                                    if (parseInt(data.residual) >= element.minimum && parseInt(data.residual) <= element.maximum) {
                                        $('td:eq(9)', row).css('color', element.text_color);
                                    }
                                }
                            })
                        } else {
                            $('td:eq(5)', row).css('color', '"#000000"');
                        }
                    }

                },
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectElement = document.getElementById('select-content');
        var selectElement_Display = document.getElementById('table-display-select');

        selectElement_Display.addEventListener('change', function(e) {
            if (selectElement_Display.value == 'full') {
                table_show = true;
                countTable1 = 0;
                getTableData1();
            } else {
                table_show = false;
                countTable1 = 0;
                getTableData1();
            }
        });
        selectElement.addEventListener('change', function(e) {
            countTable1 = 0;
            getTableData1();
        });
    });
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
                })
            }
        });
    }
</script>
<script>
    var countTable2 = 0;

    function getTableData2() {
        if (countTable2 === 0) {

            countTable2++;
            var data_version = <?php echo json_encode($data); ?>;
            if (data_version.status === '4' || data_version.status === '5') {
                var disabledAttribute = 'disabled';
            }
            if ($.fn.DataTable.isDataTable('#opp_is_table')) {
                $('#opp_is_table').DataTable().destroy();
            }
            $('#opp_is_table').DataTable({
                "processing": true,
                "pageLength": 10,
                "pagingType": "full_numbers", // Display pagination as 1, 2, 3... instead of Previous, Next buttons
                'serverSide': true,
                'ajax': {
                    'url': "<?php echo site_url('planning/planningAddressRisksOpp/is/opportunities/getdata/'); ?>" + data_version.id_version,
                    'type': 'GET',
                },
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "searching": false,
                "ordering": false,
                "scrollX": true,
                "drawCallback": function(settings) {
                    var daData = settings.json.data;
                    if (daData.length == 0) {
                        $('#opp_is_table tbody').html(`
                            <tr>
                                <td colspan="8">
                                    <div class="dropdown">
                                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                            class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" ${disabledAttribute}>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('planning/crud_is_risk_opp/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Create</a>
                                        </div>
                                    </div>
                                </td>
                                <td colspan="15">
                                </td>
                            </tr>`);
                    }
                },
                'columns': [{
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            var number_index = +meta.settings.oAjaxData.start + 1;
                            const encodedRowData = encodeURIComponent(JSON.stringify(row));
                            let dropdownHtml = `
                                <div class="dropdown">
                                    <button class="fas fa-ellipsis-h fa-rotate-90 button-table" style="color: #007bff" type="button"
                                        class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        ${disabledAttribute}></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="<?= base_url('planning/crud_is_risk_opp/opportunities/edit/' . $data['id_version'] . '/' . $data['num_ver']) ?>/${data.id_address_risks_opp_is}">Edit</a>    
                                        <a class="dropdown-item" href="<?= base_url('planning/crud_is_risk_opp/opportunities/view/' . $data['id_version'] . '/' . $data['num_ver']) ?>/${data.id_address_risks_opp_is}">View Detail</a>    
                                        <a class="dropdown-item" href="#"
                                            onclick="confirm_Alert('You want to delete data ${number_index} ?', 'planning/planningAddressRisksOpp/is/opportunities/delete/${data.id_address_risks_opp_is}/${number_index}/${data_version.id_version}/${data_version.status}')">Delete</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url('planning/crud_is_risk_opp/' . $data['id_version'] . '/' . $data['num_ver']) ?>">Create</a>`;
                            dropdownHtml += `</div>
                                </div>`;
                            return dropdownHtml;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + (meta.settings.oAjaxData.start += 1) + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.type + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'render': function(data, type, row, meta) {
                            return '<div style="color: rgba(0, 123, 255, 1);">' + data.asset_group + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-center',
                        'width': 150,
                        'render': function(data, type, row, meta) {
                            var length = data.opp_data.length;
                            return '<div style="color: rgba(0, 123, 255, 1);">' + length + '</div>';
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'width': 300,
                        'render': function(data, type, row, meta) {
                            var html = '';
                            data.opp_data.forEach(element => {
                                if (element.opportunity_plannings != null) {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">' + (element.opportunity_plannings ?? '') + '</li>';
                                } else {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">No Date</li>';
                                }
                            });
                            return html;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'width': 300,
                        'render': function(data, type, row, meta) {
                            var html = '';
                            data.opp_data.forEach(element => {
                                if (element.opp_ownner != null) {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">' + (element.opp_ownner ?? '') + '</li>';
                                } else {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">No Date</li>';
                                }
                            });
                            return html;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            var html = '';
                            data.opp_data.forEach(element => {
                                if (element.start_date != null) {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">' + (element.start_date ?? '') + '</li>';
                                } else {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">No Date</li>';
                                }
                            });
                            return html;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'width': 200,
                        'render': function(data, type, row, meta) {
                            var html = '';
                            data.opp_data.forEach(element => {
                                if (element.end_date != null) {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">' + (element.end_date ?? '') + '</li>';
                                } else {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">No Date</li>';
                                }
                            });
                            return html;
                        }
                    },
                    {
                        'data': null,
                        'class': 'text-left',
                        'width': 300,
                        'render': function(data, type, row, meta) {
                            var html = '';
                            data.opp_data.forEach(element => {
                                if (element.file != null) {
                                    html += `<li style="color: rgba(0, 123, 255, 1);"> <a href="<?php echo base_url('openfile/'); ?>${element.file.id_files}" target="_blank" style="color: rgba(0, 123, 255, 1); text-decoration: underline; ">
                                ${element.file.name_file}
                                </a></li> <br>`;
                                } else {
                                    html += '<li style="color: rgba(0, 123, 255, 1);">No File</li>';
                                }

                            });
                            return html;
                        }
                    },
                ],
            });
            $('[data-toggle="tooltip"]').tooltip();
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#risk-is-table-full, #opp_is_table').on('show.bs.dropdown', function(e) {
            var $dropdown = $(e.relatedTarget).next('.dropdown-menu');
            $('body').append($dropdown.detach());
            var eOffset = $(e.relatedTarget).offset();
            $dropdown.css({
                'display': 'block',
                'top': eOffset.top + $(e.relatedTarget).outerHeight(),
                'left': eOffset.left
            });
        });

        $('#risk-is-table-full, #opp_is_table').on('hide.bs.dropdown', function(e) {
            var $dropdown = $(e.relatedTarget).next('.dropdown-menu');
            $(e.relatedTarget).after($dropdown.detach());
            $dropdown.hide();
        });
    });
</script>