@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('plugins') }}/fullcalendar/main.css">
@endsection

@section('button')
<a href="{{ route('calendar.add_schedule') }}" class="btn btn-success float-right">
    <i class="fas fa-plus"></i>
    Tambah Jadwal
</a>
@endsection

@section('content')
<div class="row">
    <div class="col">
        @if(session('status'))
        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card card-primary">
            <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id='calendar'></div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('plugins') }}/fullcalendar/main.min.js"></script>
{{-- <script src="{{ asset('dist') }}/js/pages/calendar.js"></script> --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': `{{ csrf_token() }}`
            }
        })

        const calendarElmt = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarElmt, {
            headerToolbar: {
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
            , height: 600
            , themeSystem: 'bootstrap'
            , events: {
                url: `{{ route('calendar.ajax') }}`
            }
        });

        calendar.render();
    });

</script>
@endpush
