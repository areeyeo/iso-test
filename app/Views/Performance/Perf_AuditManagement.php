<style>
    tbody {
        background-color: #ffffff;
    }

    .fc-header-toolbar .fc-button {
        background-color: #BBDCFF;
        color: #ffffff;
        border-color: transparent;
    }

    #section2 {
        display: none;
    }

    .fc-event-main {
        cursor: pointer;
    }

    .fc-toolbar-title {
        cursor: pointer;
    }

    .fc .fc-daygrid-day-frame {
        cursor: copy;
    }

    :hover.fc-event-main {
        background-color: #3384FF;
        border-radius: 8%;
    }

    #dateplan {
        width: 155px;
    }
</style>
<?php
$datatest = [
    ['projectname' => 'test1', 'eventname' => 'ประชุมเปิดการตรวจสอบ (Open Meeting)', 'detail' => 'abcdefghijklmnopqrstuvwsyz', 'auditee' => 'Areeya Dengjaroen', 'time' => '09:00 - 12:00'],
    ['projectname' => 'test1', 'eventname' => 'ประชุมเปิดการตรวจสอบ (Open Meeting)', 'detail' => 'abcdefghijklmnopqrstuvwsyz', 'auditee' => 'Areeya Dengjaroen', 'time' => '09:00 - 12:00'],
    ['projectname' => 'test1', 'eventname' => 'ประชุมเปิดการตรวจสอบ (Open Meeting)', 'detail' => 'abcdefghijklmnopqrstuvwsyz', 'auditee' => 'Areeya Dengjaroen', 'time' => '09:00 - 12:00'],
    ['projectname' => 'test1', 'eventname' => 'ประชุมเปิดการตรวจสอบ (Open Meeting)', 'detail' => 'abcdefghijklmnopqrstuvwsyz', 'auditee' => 'Areeya Dengjaroen', 'time' => '09:00 - 12:00'],
    ['projectname' => 'test1', 'eventname' => 'ประชุมเปิดการตรวจสอบ (Open Meeting)', 'detail' => 'abcdefghijklmnopqrstuvwsyz', 'auditee' => 'Areeya Dengjaroen', 'time' => '09:00 - 12:00'],
];
?>
<!-- Section 1 -->
<div class="card" id="section1">
    <div class="card-body">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <h4>Summary Audit Program</h4>
                <button type="button" class="btn btn-dark" onclick="OpenAuditManagementProgram()">
                    <i class="fas fa-book"></i>&nbsp;&nbsp;Audit Management Program
                </button>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <div id='calendar'></div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="p-4"
                            style="background-color: #ccc; height: 80px; display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center;">
                                <h5 style="margin-right: 10px;">Audit Plan</h5>
                            </div>
                            <div>
                                <button type="button" class="btn btn-dark btn-sm"
                                    onclick="OpenAuditManagementProgram()">All</button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-y: auto; max-height: 700px;">
                            <div style="display: flex;justify-content: flex-end;align-items: center;">
                                <span>Audit Planning Date:&nbsp;</span>
                                <input class="form-control gray-text #dateplan" type="date" placeholder="Text..."
                                    name="dateplan" id="dateplan" onchange="get_auditplan_with_date()"></input>
                            </div>

                            <div id="auditplan"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Section 2 -->
<div id="section2">
    <?php include("Perf_AuditManagementProgram.php"); ?>
</div>

<!-- display date today -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentDate = new Date().toISOString().split('T')[0];
        document.getElementById('dateplan').value = currentDate;
    });
</script>

<!-- management calendar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: { // ปุ่มควบคุมด้านบนของปฏิทิน
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridYear,dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            navLinks: true,
            selectable: true,
            selectMirror: true,
            select: function(arg) {
                $("#modal-default").modal('toggle');
                load_modal(3);
            },
            eventClick: function(info) { // ฟังก์ชันที่เรียกเมื่อเลือก Event
                $("#modal-default").modal('toggle');
                load_modal(9, info.event.id);
            },
            dayMaxEvents: true,
            events: [
                <?php foreach ($audit_plan as $row) {
                    $end_date = new DateTime($row['end_date']);
                    $end_date->modify('+1 day');
                ?> {
                        id: '<?= $row['id_audit_plan'] ?>',
                        title: '<?= $row['program_name'] ?>',
                        start: '<?= $row['start_date'] ?>',
                        end: '<?= $end_date->format('Y-m-d') ?>',
                        backgroundColor: '#82B4FF',
                        borderColor: '#F5F6FA'
                    },
                <?php } ?>

            ],
        });
        calendar.render();
    });
</script>

<!-- format date -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.getElementById('dateplan');
        var options = {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
        };
        var currentDate = new Date();
        var formattedDate = currentDate.toLocaleDateString('fr-CA', options);
        input.value = formattedDate;
    });
</script>

<!-- management section -->
<script>
    function OpenAuditManagementProgram() {
        document.getElementById('section1').style.display = 'none';
        document.getElementById('section2').style.display = 'block';
    }
</script>

<!-- Audit Plan Date -->
<script>
    $(document).ready(function() {
        get_auditplan_with_date();
    });

    function get_auditplan_with_date() {
        let date_value = document.getElementById('dateplan').value

        $.ajax({
            url: '<?= base_url('internal_audit/getdata/schedule_plan') ?>',
            type: 'POST',
            data: {
                'date': date_value
            },
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                let html_schedule = '';
                response.data.forEach(element => {
                    html_schedule += `
            <div class="card-body mt-3" style="background-color: #E2F0FF; border-radius: 4px;">
                <div class="d-flex justify-content-between">
                    <div>
                        <span style="color: #666666; font-size: large;">Project Name:&nbsp;</span>
                        <span id="projectname" style="color: #007BFF; font-size: large;">${element.program_name}</span>
                    </div>
                    <div>
                        <span style="color: #007BFF; cursor: pointer;" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(9,${element.id_audit_plan})">
                            <i class="fas fa-ellipsis-h"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <span style="color: #666666;">Event Name:&nbsp;</span>
                    <span id="period" style="color: #007BFF;">${element.event_name ?? '-'}</span>
                </div>
                <div>
                    <span style="color: #666666;">Detail:&nbsp;</span>
                    <span id="period" style="color: #007BFF;">${element.detail ?? '-'}</span>
                </div>
                <div>
                    <span style="color: #666666;">Auditee:&nbsp;</span>
                    <span id="period" style="color: #007BFF;">${element.auditee ?? '-'}</span>
                </div>
                <div>
                    <span style="color: #666666;">Time:&nbsp;</span>
                    <span id="period" style="color: #007BFF;">${element.start_time ?? ''} - ${element.end_time ?? ''}</span>
                </div>
            </div>
            `
                });

                document.getElementById('auditplan').innerHTML = html_schedule
            },
        });
    }
</script>