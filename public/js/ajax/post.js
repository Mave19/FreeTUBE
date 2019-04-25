$(document).ready(function() {
    $('#post').on('submit', function(e){
        e.preventDefault();
        // NEEDED THIS WHEN YOU UPLOADING A FILE THROUGH AJAX
        var formData = new FormData($('#post')[0]);
        // SAVING OF POST
        $.ajax({
            type: "POST",
            url: "/post",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data)
            {
                if($.isEmptyObject(data.error))
                {
                    //Clearing the form after success
                    $('#post')[0].reset();
                    
                    // Setting a setTimeout to fetch new posted data
                    var refresh = setTimeout(function(){
                        $("#showposts").load(url).fadeIn(500);
                    }, 1000);
                }
                else
                {
                    showErrors(data.error);
                }
            }
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