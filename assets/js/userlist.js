$(function() {
    $('#dataTable').DataTable({
        "pageLength": 5,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });

    $('.close').click(function() {
        $('.costom-notification').hide();
    });

    $('td:contains("No Data")').css('color', 'red');

});

function openaddmodel() {
    window.location.href = "index.php";
}