function onloadCallback(){
    grecaptcha.render('g-recaptcha', {
        'sitekey' : '6LfAkCcTAAAAAI-5vkdE6-hUb7IRjL3TPUgbiHiN',
        'callback' : callback
    });
}

function callback(){
    $('[name="submit-btn"]').removeAttr('disabled');
}