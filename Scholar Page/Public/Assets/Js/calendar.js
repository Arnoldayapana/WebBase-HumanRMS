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
        showNonCurrentDates: false,
        height: '100%',
        contentHeight: 'auto',
        aspectRatio: 1.5,
        dayMaxEvents: true,
        weekends: true
    });
    calendar.render();
});