$(document).ready(function() {
    // SAVING OF COMMENTS
    $('#postcomment').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/comment",
            data: $('#postcomment').serialize(),
            success: function(data)
            {
                if($.isEmptyObject(data.error))
                {
                    // Clearing the form after success
                    $('#postcomment')[0].reset();
                }
                else
                {
                    showErrors(data.error);
                }
            }
        });
    });
    // SAVING REACTS
    $('#Heart').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/react",
            data: $('#Heart').serialize()
        });
    });
});
// SHOWING OF ERRORS
function showErrors(message)
{
    $('.alert-danger').find('ul').empty();
    $('.alert-danger').css('display', 'block');

    $.each(message, function(key, value){
        $('.alert-danger').find('ul').append("<li>" + value + "</li>");
    });
}