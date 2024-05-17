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
                        <div class="p-4" style="background-color: #ccc; height: 80px; display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center;">
                                <h5 style="margin-right: 10px;">Audit Plan</h5>
                            </div>
                            <div>
                                <button type="button" class="btn btn-dark btn-sm" onclick="OpenAuditManagementProgram()">All</button>
                            </div>
                        </div>
                        <div class="card-body" style="overflow-y: auto; max-height: 700px;">
                            <div style="display: flex;justify-content: flex-end;align-items: center;">
                                <span>Audit Planning Date:&nbsp;</span>
                                <input class="form-control gray-text #" type="date" placeholder="Text..." name="dateplan" id="dateplan"></input>
                            </div>

                            <?php foreach ($datatest as $item) : ?>
                                <div class="card-body mt-3" style="background-color: #E2F0FF; border-radius: 4px;">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span style="color: #666666; font-size: large;">Project Name:&nbsp;</span>
                                            <span id="projectname" style="color: #007BFF; font-size: large;"><?php echo $item['projectname']; ?></span>
                                        </div>
                                        <div>
                                            <span style="color: #007BFF; cursor: pointer;" data-toggle="modal" data-target="#modal-default" id="load-modal-button" onclick="load_modal(9)">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <span style="color: #666666;">Event Name:&nbsp;</span>
                                        <span id="period" style="color: #007BFF;"><?php echo $item['eventname']; ?></span>
                                    </div>
                                    <div>
                                        <span style="color: #666666;">Detail:&nbsp;</span>
                                        <span id="period" style="color: #007BFF;"><?php echo $item['detail']; ?></span>
                                    </div>
                                    <div>
                                        <span style="color: #666666;">Auditee:&nbsp;</span>
                                        <span id="period" style="color: #007BFF;"><?php echo $item['auditee']; ?></span>
                                    </div>
                                    <div>
                                        <span style="color: #666666;">Time:&nbsp;</span>
                                        <span id="period" style="color: #007BFF;"><?php echo $item['time']; ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
                console.log('Clicked on event: ', info.event.title);
                $("#modal-default").modal('toggle');
                load_modal(9);
            },
            dayMaxEvents: true,
            events: [{
                    title: 'Example Event',
                    start: '2024-05-01',
                    end: '2024-05-01',
                    backgroundColor: '#82B4FF',
                    borderColor: '#F5F6FA'
                },
                {
                    title: 'Long Event',
                    start: '2024-05-07',
                    end: '2024-05-15',
                    backgroundColor: '#82B4FF',
                    borderColor: '#F5F6FA'
                },
                {
                    title: 'test',
                    start: '2024-05-11',
                    end: '2024-05-13',
                    backgroundColor: '#82B4FF',
                    borderColor: '#F5F6FA'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2024-05-28',
                    backgroundColor: '#82B4FF',
                    borderColor: '#F5F6FA'
                }
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
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        var currentDate = new Date();
        var formattedDate = currentDate.toLocaleDateString('en-US', options);
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