@extends('layout.app')

@section('back')
<a href="{{ url()->previous() }}" class="btn btn-outline-primary mr-3">
    <i class="fas fa-angle-left"></i>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">...</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('edit.schedule.post', $event['id']) }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Event</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Berita Acara" name="event" value="{{ $event['title'] }}">
                                @error('event')
                                <small class="form-text text-danger ml-2">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal</label>
                                <div class="input-group date" id="tanggal1" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#tanggal1" name="tanggal" value="{{ $event['tanggal'] }}" />
                                    <div class="input-group-append" data-target="#tanggal1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('tanggal')
                                <small class="form-text text-danger ml-2">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkOneDay" name="oneday" {{ $event['isChecked'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="exampleCheck1">Satu Hari Penuh</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" id="inputJam">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Start</label>
                                <div class="input-group date" id="jamStart" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#jamStart" name="jam_start" value="{{ $event['start'] }}" />
                                    <div class="input-group-append" data-target="#jamStart" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">End</label>
                                <div class="input-group date" id="jamEnd" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#jamEnd" name="jam_end" value="{{ $event['end'] }}" />
                                    <div class="input-group-append" data-target="#jamEnd" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('plugins') }}/moment/moment.min.js"></script>
<script src="{{ asset('plugins') }}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const checkOneDay = document.getElementById('checkOneDay');
        const rowJam = document.getElementById('inputJam');

        if (checkOneDay.checked) {
            rowJam.style.display = 'none';
        }

        // * Toogle Input Jam
        checkOneDay.addEventListener('change', (e) => {
            const status = e.target.checked;

            if (status) {
                rowJam.style.display = 'none';
            } else {
                rowJam.style.display = 'flex';
            }
        });

        $('#tanggal1').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#jamStart').datetimepicker({
            format: 'HH:mm'
        });

        $('#jamEnd').datetimepicker({
            format: 'HH:mm'
        });

        $('#tanggal1').on("change.datetimepicker", function(e) {
            const today = new Date();

            if (e.date.isSame(today, "day")) {
                $('#jamStart').datetimepicker('date', e.date);
                $('#jamStart').datetimepicker('minDate', e.date);
            } else {
                $('#jamStart').datetimepicker('minDate', moment().hours(7));
            }
        });

        $('#jamStart').on('change.datetimepicker', function(e) {
            $('#jamEnd').datetimepicker('minDate', e.date);
        });

    });

</script>
@endpush
