<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/plugins') }}/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('/plugins') }}/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist') }}/css/adminlte.min.css">
    <!-- Full calendar -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/fullcalendar/main.css">

</head>

<body>
    <section class="content">
        <div class="container-fluid">
            <div id='calendar'></div>
        </div>
    </section>

    <script src="{{ asset('plugins') }}/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins') }}/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist') }}/js/adminlte.js"></script>
    <script src="{{ asset('plugins') }}/fullcalendar/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                }
            })

            const calendarElmt = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarElmt, {
                initialView: 'timeGridWeek'
                , headerToolbar: {
                    left: 'prev,next today'
                    , center: 'title'
                    , right: 'dayGridMonth,timeGridWeek,timeGridDay'
                }
                , slotLabelFormat: {
                    minute: '2-digit'
                    , hour: '2-digit'
                    , hour12: false
                }
                , slotMinTime: '07:00:00'
                , slotMaxTime: '17:00:00'
                , nowIndicator: true
                , allDaySlot: false
                , height: 700
                , themeSystem: 'bootstrap'
                , events: {
                    url: `{{ route('calendar.ajax') }}`
                }
            });

            calendar.render();
        });

    </script>
</body>

</html>
