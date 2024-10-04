document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: '',
            center: 'title',
            right: ''
        },
        titleFormat: {
            month: 'long',
            year: 'numeric'
        },
        events: [
            {
                title: 'Event 1',
                start: '2024-10-01'
            },
            {
                title: 'Event 2',
                start: '2024-10-05',
                end: '2024-10-07'
            },
            {
                title: 'Meeting',
                start: '2024-10-12T10:30:00',
                end: '2024-10-12T12:30:00'
            }
        ],
        showNonCurrentDates: false,
        height: '100%',
        contentHeight: 'auto',
        aspectRatio: 1.5,
        dayMaxEvents: true,
        weekends: true
    });
    calendar.render();
});