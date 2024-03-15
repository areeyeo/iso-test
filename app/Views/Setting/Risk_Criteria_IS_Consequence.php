<title>Risk Criteria Information Security</title>
<style>
    .table th,
    .table td {
        text-align: center;
    }
</style>
<script>
    <?php
    $data = [
        [
            'id' => 'confidentiality',
            'title' => 'Confidentiality',
            'active' => true,
            'data' => [
                ['action' => 'Action 1', 'name' => 'Name 1', 'impact_level' => 1, 'description' => 'Description 1'],
                ['action' => 'Action 2', 'name' => 'Name 2', 'impact_level' => 2, 'description' => 'Description 2'],
                ['action' => 'Action 3', 'name' => 'Name 3', 'impact_level' => 3, 'description' => 'Description 3'],
                ['action' => 'Action 4', 'name' => 'Name 4', 'impact_level' => 4, 'description' => 'Description 4'],
                ['action' => 'Action 5', 'name' => 'Name 5', 'impact_level' => 5, 'description' => 'Description 5'],
            ]
        ],
        [
            'id' => 'integrity',
            'title' => 'Integrity',
            'active' => false,
            'data' => [
                ['action' => 'Action 1', 'name' => 'Name 1', 'impact_level' => 1, 'description' => 'Description 1'],
                ['action' => 'Action 2', 'name' => 'Name 2', 'impact_level' => 2, 'description' => 'Description 2'],
                ['action' => 'Action 3', 'name' => 'Name 3', 'impact_level' => 3, 'description' => 'Description 3'],
                ['action' => 'Action 4', 'name' => 'Name 4', 'impact_level' => 4, 'description' => 'Description 4'],
                ['action' => 'Action 5', 'name' => 'Name 5', 'impact_level' => 5, 'description' => 'Description 5'],
            ]
        ],
        [
            'id' => 'availability',
            'title' => 'Availability',
            'active' => false,
            'data' => [
                ['action' => 'Action 1', 'name' => 'Name 1', 'impact_level' => 1, 'description' => 'Description 1'],
                ['action' => 'Action 2', 'name' => 'Name 2', 'impact_level' => 2, 'description' => 'Description 2'],
                ['action' => 'Action 3', 'name' => 'Name 3', 'impact_level' => 3, 'description' => 'Description 3'],
                ['action' => 'Action 4', 'name' => 'Name 4', 'impact_level' => 4, 'description' => 'Description 4'],
                ['action' => 'Action 5', 'name' => 'Name 5', 'impact_level' => 5, 'description' => 'Description 5'],
            ]
        ],
    ];

    function generateTabsAndTables($data)
    {
        $html = '';

        $html .= '<nav>';
        $html .= '<div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">';
        foreach ($data as $item) {
            $html .= '<button class="nav-link ' . ($item['active'] ? 'active' : '') . '" id="nav-' . $item['id'] . '-tab" data-toggle="tab" data-target="#nav-' . $item['id'] . '" type="button" role="tab" aria-controls="nav-' . $item['id'] . '" aria-selected="' . ($item['active'] ? 'true' : 'false') . '">' . $item['title'] . '</button>';
        }
        $html .= '</div>';
        $html .= '</nav>';

        $html .= '<div class="tab-content mt-3" id="nav-tabContent">';
        foreach ($data as $item) {
            $html .= '<div class="tab-pane fade ' . ($item['active'] ? 'show active' : '') . '" id="nav-' . $item['id'] . '" role="tabpanel" aria-labelledby="nav-' . $item['id'] . '-tab" style="padding: 10px;">';
            $html .= '<span>' . $item['title'] . '</span>';
            $html .= '<table id="consequence" class="table table-hover mt-3">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>ACTION</th>';
            $html .= '<th>NAME</th>';
            $html .= '<th>IMPACT LEVEL</th>';
            $html .= '<th>DESCRIPTION</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($item['data'] as $row) {
                $html .= '<tr>';
                $html .= '<td>' . $row['action'] . '</td>';
                $html .= '<td>' . $row['name'] . '</td>';
                $html .= '<td>' . $row['impact_level'] . '</td>';
                $html .= '<td>' . $row['description'] . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '</div>';
        }
        $html .= '</div>';

        return $html;
    }
    echo generateTabsAndTables($data);
    ?>
</script>
<script>
    function load_modal(check, check_type, data_encode) {
        console.log('Function is called with check:', check, 'and check_type:', check_type);

        modal_crud_criteria_consequence = document.getElementById("modal_crud_criteria_consequence");
        modal_crud_criteria_consequence_item = document.getElementById("modal_crud_criteria_consequence_item");
        $(".modal-body #iss").empty();

        if (check == '1') {
            //--show modal requirment--//
            console.log('Showing modal 1');;
            modal_crud_criteria_consequence.style.display = "block";
            modal_crud_criteria_consequence_item.style.display = "none"
        } else if (check == '2') {
            console.log('Showing modal 2');;
            modal_crud_criteria_consequence.style.display = "none";
            modal_crud_criteria_consequence_item.style.display = "block"
        }
    }
</script>
<script>
    function deleteConsequence(index) {
        console.log('delete item with index:', index);
    }
</script>
<div class="modal fade" id="modal-consequence">
    <div id="modal_crud_criteria_consequence">
        <?= $this->include("Modal/CRUD_Criteria_IS_Consequence"); ?>
    </div>
    <div id="modal_crud_criteria_consequence_item">
        <?= $this->include("Modal/CRUD_Criteria_IS_Consequence_Item"); ?>
    </div>
</div>

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
                            <h4>
                                Consequence Level
                            </h4>
                            <div class="d-flex align-items-center">
                                <span>Impact Level:</span>
                                <div class="" style="margin-left: 10px; margin-right: 10px;">
                                    <select class="custom-select" id="select-content">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected>5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-consequence" onclick="load_modal(1)">
                                    <i class="fas fa-plus"></i>&nbsp;&nbsp;Consequence
                                </button>
                            </div>
                        </div>
                        <nav>
                            <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
                                <?php foreach ($data as $item) { ?>
                                    <button class="nav-link <?php echo $item['active'] ? 'active' : ''; ?>" id="nav-<?php echo $item['id']; ?>-tab" data-toggle="tab" data-target="#nav-<?php echo $item['id']; ?>" type="button" role="tab" aria-controls="nav-<?php echo $item['id']; ?>" aria-selected="<?php echo $item['active'] ? 'true' : 'false'; ?>"><?php echo $item['title']; ?></button>
                                <?php } ?>

                            </div>
                        </nav>
                        <div class="tab-content mt-3" id="nav-tabContent">
                            <?php foreach ($data as $item) { ?>
                                <div class="tab-pane fade <?php echo $item['active'] ? 'show active' : ''; ?>" id="nav-<?php echo $item['id']; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $item['id']; ?>-tab" style="padding: 10px;">
                                    <div class="d-flex justify-content-between">
                                        <span style="font-size: 15pt;"><?php echo $item['title']; ?></span>
                                        <button type="button" class="btn btn-outline-danger btn-sm" style="margin-left: 10px;" onclick="deleteConsequence()">
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
                                            <?php foreach ($item['data'] as $index => $row) { ?>
                                                <tr>
                                                    <td>
                                                        <div class="dropdown">
                                                            <i class="fas fa-ellipsis-v pointer text-primary" id="dropdownMenuButtonPlanning<?php echo $index; ?>" data-toggle="dropdown" aria-expanded="false"></i>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPlanning<?php echo $index; ?>">
                                                                <li data-toggle="modal" data-target="#modal-consequence" onclick="load_modal(2)"><a class="dropdown-item" href="#">Edit</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['impact_level']; ?></td>
                                                    <td><?php echo $row['description']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>