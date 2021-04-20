$(function() {
    $('.type-msg').on('keyup', function (e) {
        if (e.key === 'Enter') {
            sendMessage($(this));
        }
    });

    $('.send-btn').on('click', function (e) {
        sendMessage($(this));
    });

    // add the users message to the chat interface and send the message
    function sendMessage(element) {
        $('.chat .card .card-body').append(
            `<div class="d-flex justify-content-start mb-4">
                <div class="msg-container">` +
                    element.val() +
                `</div>
            </div>`
        );

        lookupMessage(element.val());
        element.val('');
    }

    // check the contents of the message entered and return an appropriate response to the ui
    function lookupMessage(message) {
        var protocol = window.location.protocol;
        var hostname = window.location.hostname;

        $.ajax({
            url: protocol + '//' + hostname + '/trains/check-message',
            type: 'POST',
            headers: {'X-CSRF-Token': csrfToken},
            data: {'message': message},
            success: function(data) {
                $('.chat .card .card-body').append(data);
                $('.chat .card .card-body').scrollTop($('.chat .card .card-body')[0].scrollHeight);
            }
        });
    }
});
