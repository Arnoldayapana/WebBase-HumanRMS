document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Monthly view of the calendar
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
            {
                title: 'Project Meeting',
                start: '2024-10-14T10:00:00',
                description: 'Discuss the project timeline and progress'
            },
            {
                title: 'Report Submission',
                start: '2024-10-16',
                description: 'Submit the quarterly reports'
            },
            {
                title: 'Team Building',
                start: '2024-10-18T15:00:00',
                description: 'Fun team-building activities'
            }
        ],
        eventClick: function(info) {
            alert(info.event.title + "\n" + info.event.start);
        }
    });

    calendar.render();
});