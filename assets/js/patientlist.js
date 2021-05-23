var filterswitchbool = false;

$(function() {

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = parseInt($('#min').val(), 10);
            var max = parseInt($('#max').val(), 10);
            var age = parseFloat(data[3]) || 0; // use data for the age column
            var diseases = $('#disease').val();

            if ((isNaN(min) && isNaN(max)) ||
                (isNaN(min) && age <= max) ||
                (min <= age && isNaN(max)) ||
                (min <= age && age <= max)) {
                return true;
            }
            return false;
        }
    );



    var table = $('#dataTable').DataTable({
        "pageLength": 5,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        scrollX: '100%',
        scrollCollapse: true,
    });

    $('#min, #max').keyup(function() {
        table.draw();
    });

    $('#disease').on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
        )

        table.search(val ? '' + val + '' : '', true, false).draw();
        $('#status').val('');
        $('#condition').val('');
    });

    $('#status').on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
        )

        table.search(val ? '' + val + '' : '', true, false).draw();
        $('#disease').val('');
        $('#condition').val('');
    });

    $('#condition').on('change', function() {
        var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
        )

        table.search(val ? '' + val + '' : '', true, false).draw();
        $('#disease').val('');
        $('#status').val('');
    });

    $('.close').click(function() {
        $('.costom-notification').hide();
    });

    $('td:contains("No Data")').css('color', 'red');

    $(".exportToExcel").click(function() {
        $title = "";
        if ($('#disease option').length == 2) {
            $('#disease option').each(function() { $title = this.value + " " });
        }
        $title = $title + "Patients Details";
        $("#dataTable").table2excel({
            exclude: ".noExl",
            name: "Patient Record",
            filename: $title,
            preserveColors: true
        });
    });

    $(".filter-switch").click(function() {
        if (filterswitchbool) {
            $('.filter-box').show();
            $('.title-lable').show();
            $('.filter-switch').text('Hide Filter');
            filterswitchbool = false;
        } else {
            $('.filter-box').hide();
            $('.title-lable').hide();
            $('.filter-switch').text('Show Filter');
            filterswitchbool = true;
        }
    });
});

function openaddmodel() {
    window.location.href = "index.php";
}