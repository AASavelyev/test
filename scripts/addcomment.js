function onloadCallback(){
    grecaptcha.render('g-recaptcha', {
        'sitekey' : '6LfAkCcTAAAAAI-5vkdE6-hUb7IRjL3TPUgbiHiN',
        'callback' : callback
    });
}

function callback(){
    $('[name="submit-btn"]').removeAttr('disabled');
}

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
                   $('.text-success').text('Ваше сообщение отправленно на модерацию');
                   $('.text-success').removeClass('hide');
                   $('[name="submit-btn"]').attr('disabled', 'disabled');
               }
               else {
                   for (var i = 0; i < result.errors.length; i++){
                       $('.text-danger').html($('.text-danger').html() + result.errors[i] + '<br>');
                       $('.text-danger').removeClass('hide');
                       grecaptcha.reset();
                   }
               }
           }
       })
   });
});