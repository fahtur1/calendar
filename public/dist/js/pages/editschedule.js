document.addEventListener('DOMContentLoaded', () => {

    const checkOneDay = document.getElementById('checkOneDay');
    const rowJam = document.getElementById('inputJam');

    const tanggalKedua = document.getElementById('inputTanggalKedua');
    if (checkOneDay.checked) {
        rowJam.style.display = 'none';
        tanggalKedua.style.display = 'none';
    }

    // * Toogle Input Jam
    checkOneDay.addEventListener('change', (e) => {
        const status = e.target.checked;

        if (status) {
            rowJam.style.display = 'none';
            tanggalKedua.style.display = 'none';
        } else {
            rowJam.style.display = 'flex';
            tanggalKedua.style.display = 'block';
        }
    });

    $('#tanggal1').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $('#jamStart').datetimepicker({
        format: 'HH:mm'
    });

    $('#tanggal2').datetimepicker({
        format: 'DD-MM-YYYY',
        minDate: moment()
    });

    $('#jamEnd').datetimepicker({
        format: 'HH:mm'
    });

    $('#jamEnd2').datetimepicker({
        format: 'HH:mm',
    });

    $('#tanggal1').on("change.datetimepicker", function (e) {
        const today = new Date();

        if (e.date.isSame(today, "day")) {
            $('#jamStart').datetimepicker('date', e.date);
            $('#jamStart').datetimepicker('minDate', e.date);
        } else {
            $('#jamStart').datetimepicker('minDate', moment().hours(7));
        }
    });

    $('#jamStart').on('change.datetimepicker', function (e) {
        $('#jamEnd').datetimepicker('minDate', e.date);
    });

});