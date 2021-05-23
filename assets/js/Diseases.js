$(function() {
    closeupdatemodel();
    closeaddmodel();
    showsuccessbanner();
    showerrorbanner();

    $('#dataTable').DataTable({
        "pageLength": 5,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true
    });

    $('td:contains("No Data")').css('color', 'red');
});

function closeupdatemodel() {
    $('.update-model').hide();
}

function closeaddmodel() {
    $('.add-model').hide();
}

function closesuccessbanner() {
    $('.success-banner').hide();
}

function showsuccessbanner() {
    if ($('#successmsg').text() != '') {
        $('.success-banner').show();
    }

}

function closeerrorbanner() {
    $('.error-banner').hide();
}

function showerrorbanner() {
    if ($('#errormsg').text() != '') {
        $('.error-banner').show();
    }
}

function updatevalue($id, $name, $desc) {
    $('#updateid').val($id);
    $('#tempupdateid').val($id);
    $('#updatename').val($name);
    $('#updatedesc').val($desc);
    $('.update-model').show();
}

function openaddmodel() {
    $('.add-model').show();
}