$(document).ready(function() {
    $imgSrc = $('#imgProfile').attr('src');
    $('#condition').val(parseInt($('#tempCondition').text()));
    $('#disease').val(parseInt($('#tempDiseaseId').text()));
    $('#selectstatus').val($('#status').val());
    $('#selectrole').val($('#role').val());
    $('#state').val($('#selectedstate').val());
    $('#state').trigger('change');
    switchcitypincode();

    $('#dataTable').DataTable({
        "pageLength": 5,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "autoWidth": true
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgProfile').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#btnChangePicture').on('click', function() {
        // document.getElementById('profilePicture').click();
        if (!$('#btnChangePicture').hasClass('changing')) {
            $('#profilePicture').click();
        } else {
            // change
        }
    });
    $('#profilePicture').on('change', function() {
        readURL(this);
        $('#btnChangePicture').addClass('changing');
        $('#btnChangePicture').attr('value', 'Confirm');
        $('#btnDiscard').removeClass('d-none');
        // $('#imgProfile').attr('src', '');
    });
    $('#btnDiscard').on('click', function() {
        // if ($('#btnDiscard').hasClass('d-none')) {
        $('#btnChangePicture').removeClass('changing');
        $('#btnChangePicture').attr('value', 'Change');
        $('#btnDiscard').addClass('d-none');
        $('#imgProfile').attr('src', $imgSrc);
        $('#profilePicture').val('');
        // }
    });

    // $('.0').text('Invalid');
    // $('.1').text('Active');
});

var changestatus = function() {
    $('#status').val($('#selectstatus').val());
};

var changerole = function() {
    $('#role').val($('#selectrole').val());
};

var changepincode = function() {
    $('#selectedzipcode').val($('#zipcode').val());
};

var switchcitypincode = function() {
    if ($('#switchc').val() == 'hide') {
        $('#switchc').val('show');
        $('#city').hide();
        $('#zipcode').hide();
    } else {
        $('#switchc').val('hide');
        $('#city').show();
        $('#zipcode').show();
    }
}