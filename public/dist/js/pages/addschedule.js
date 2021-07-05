document.addEventListener('DOMContentLoaded', () => {

    $('#tanggal1').datetimepicker({
        format: 'DD-MM-YYYY',
        minDate: moment()
    });

    $('#jamStart').datetimepicker({
        format: 'HH:mm',
        maxDate: moment().hours(17)
    });

    $('#jamEnd').datetimepicker({
        format: 'HH:mm',
        maxDate: moment().hours(17)
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

    const checkOneDay = document.getElementById('checkOneDay');
    const rowJam = document.getElementById('inputJam');

    // * Toogle Input Jam
    checkOneDay.addEventListener('change', (e) => {
        const status = e.target.checked;

        if (status) {
            rowJam.style.display = 'none';
        } else {
            rowJam.style.display = 'flex';
        }
    });

});