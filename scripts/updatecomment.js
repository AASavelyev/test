$(document).ready(function(){
    $('[name="submit-btn"]').on('click', function(e){
        e.preventDefault();

        $.ajax({
            method: 'POST',
            url: $("form").attr('action'),
            data: $("form").serialize(),
            success: function(responce){
                var result = JSON.parse(responce);
                $('.text-danger').html('');
                if (result.success){
                    $('.text-success').text('Saved');
                    $('.text-success').removeClass('hide');
                    $('[name="submit-btn"]').attr('disabled', 'disabled');
                }
                else {
                    for (var i = 0; i < result.errors.length; i++){
                        $('.text-danger').html($('.text-danger').html() + result.errors[i] + '<br>');
                        $('.text-danger').removeClass('hide');
                    }
                }
            }
        })
    });
});