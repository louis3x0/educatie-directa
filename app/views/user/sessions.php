<?php
    // get available sessions
    // use teachercontroller
    $teacherController = new ProfileController();
    $getCurrentUser = $teacherController->getUserData();
    $role = $getCurrentUser['role'];

    $sessions = $teacherController->getSessions($getCurrentUser['id'], $role);
    $events = [];

    foreach ($sessions as $session) {
        $events[] = [
            'title' => 'Meeting with ' . $session['teacher_name'],
            'start' => $session['session_date'] . 'T' . $session['session_start_time'],
            'end' => $session['session_date'] . 'T' . $session['session_end_time'],
            'url' => $session['session_link']
        ];
    }

    $eventsJson = json_encode($events);
?>


<div class="container mt-5">
    <h1 class="text-start">Calendar sesiuni</h1>
    <div id='calendar'></div>
</div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'ro', // Set the locale to Romanian
            slotMinTime: '08:00:00', // Set the earliest time to 08:00
            slotMaxTime: '20:00:00', // Set the latest time to 18:00
            events: <?php echo $eventsJson; ?>
        });

        calendar.render();
    });
</script>