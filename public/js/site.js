$(function() {
    $('#upload_image').submit(function(e) {
        e.preventDefault();
        $.ajaxFileUpload({
            url             :'/bustracking-php/dashboard/upload_image/',
            secureuri       :false,
            fileElementId   :'profileImage',
            dataType        : 'json',
            success : function (data, status)
            {
                if(data.status != 'error')
                {
                    $('#files').html('<p>Reloading files...</p>');
                    refresh_files();
                }
                alert(data.msg);
            },
            error: function (data, status, e)
            {
                $("#info").html(e);
            }
        });
        return false;
    });
});
function refresh_files()
{
    $.get('/bustracking-php/files/')
        .success(function (data){
            $('#files').html(data);
        });
}