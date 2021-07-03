document.addEventListener('DOMContentLoaded', () => {
    const calendarElmt = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarElmt, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap'
    });

    calendar.render();
});