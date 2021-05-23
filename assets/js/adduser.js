$(function() {
    $("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        enablefinishbutton: true,
        transitionEffectSpeed: 500,
        onStepChanging: function(event, currentIndex, newIndex) {
            if (newIndex === 1) {
                $('.steps ul').addClass('step-2');
            } else {
                $('.steps ul').removeClass('step-2');
            }
            // if (newIndex === 2) {
            //     $('.steps ul').addClass('step-3');
            // } else {
            //     $('.steps ul').removeClass('step-3');
            // }

            if (newIndex === 2) {
                $('.steps ul').addClass('step-4');
                $('.actions ul').addClass('step-last');

                //set value in check lables
                $('#fn').text($('#prefix').val() + ' ' + $('#firstname').val() + ' ' + $('#lastname').val());
                $('#st').text($('#status').val());
                $('#rl').text($('#role').val());
                $('#mo').text($('#phonenumber').val());
                $('#em').text($('#email').val());
                $('#aa').text($('#aadharno').val());
                $('#add1').text($('#addr1').val());
                $('#add2').text($('#addr2').val());
                $('#add3').text($('#addr3').val());
                $('#citylable').text($('#city').val());
                $('#pin').text($('#zipcode').val());
                $('#statelable').text($('#state').val());

            } else {
                $('.steps ul').removeClass('step-4');
                $('.actions ul').removeClass('step-last');
            }
            return true;
        },
        labels: {
            finish: "Save User",
            next: "Next",
            previous: "Previous"
        },
        onFinished: function(event, currentIndex) {
            $('form').submit();
        }
    });
    // Custom Steps Jquery Steps
    $('.wizard > .steps li a').click(function() {
        $(this).parent().addClass('checked');
        $(this).parent().prevAll().addClass('checked');
        $(this).parent().nextAll().removeClass('checked');
    });
    // Custom Button Jquery Steps
    $('.forward').click(function() {
        $("#wizard").steps('next');
    })
    $('.backward').click(function() {
            $("#wizard").steps('previous');
        })
        // Checkbox
    $('.checkbox-circle label').click(function() {
        $('.checkbox-circle label').removeClass('active');
        $(this).addClass('active');
    })
})