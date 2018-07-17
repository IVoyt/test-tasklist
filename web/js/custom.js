
window.getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


function closeModal(elm) {
    $(elm).css({
        opacity: '',
        transform: '',
        filter: '',
        transition: 'opacity 0.85s ease-out 0s, transform 0.85s ease-out 0s, filter 0.45s ease-out 0s'
    });
    $('.overlay-modal').css({
        opacity: '',
        transition: 'opacity 0.85s ease-out 0s'
    });
    setTimeout(
        function() {
            $('.overlay-modal').remove();
            $(elm).remove();
        }, 1100
    );

}


$(document).on('click','#preview', function () {
    $('body').css('overflow-y','hidden')
            .append('<div class="overlay-modal" onclick="closeModal($(\'#modal\'));"></div>')
            .append(
                '<div id="modal">' +
                    '<div id="modal-header">Предпросмотр' +
                        '<img src="/web/img/close1.png" id="close-modal" onclick="closeModal($(\'#modal\'));" />' +
                    '</div>' +
                    '<div id="modal_body"></div>' +
                '</div>');

    var username = $('#username').val();
    var email = $('#email').val();
    var content = $('#content').val();
    // console.log(username);
    // console.log(email);
    // console.log(content);
    $.ajax({
        url: '/main/preview?username='+username+'&email='+email+'&content='+content,
        async: true,
        dataType: 'text',
        success: function(data) {
            // console.log(data);
            $('.overlay-modal').css({opacity: 0.6});
            $('#modal_body').html(data);
            $('#modal').css({opacity: 1, transform: 'scale(1,1)', filter: 'grayscale(0) blur(0px)'});
        },
        error: function(xhr) {
            console.log('Something went wrong...');
            console.log(xhr);
        }
    })
});