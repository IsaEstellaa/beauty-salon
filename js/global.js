$(document).ready(function () {
    $(window).on('scroll', function () {
        if (window.scrollY == 0) {
            $('.voltar-topo').removeClass('visible');
        } else {
            $('.voltar-topo').addClass('visible');
        }
    })
})

//HOME -- Olho de senha
$(document).ready(function() {
    $('.password-eye').on('click', function() {
        let input = $('.input-pass');
        let divInput = $('.input-senha');

        if(input.attr('type') === 'text') {
            divInput.removeClass('eye-hidden');
            divInput.addClass('eye-visible');
            input.attr('type', 'password');
            
        } else {
            divInput.removeClass('eye-visible');
            divInput.addClass('eye-hidden');
            input.attr('type', 'text');
            
        }
    });
});