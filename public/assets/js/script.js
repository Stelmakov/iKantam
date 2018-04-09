$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $('.deleteComment').on('click',function(){
        var commentId = $(this).attr('id');
        $.ajax({

            type: 'POST',
            url: '/comments/delete',
            data: {id: commentId },
            dataType: 'json',
            success: function (data) {
                $('#' + commentId).parents('.card-panel').remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;

    });
    $('.editComment').on('click',function(){
        var commentId = $(this).attr('id');
        $(this).parents('.card-panel').find('.commentContent').hide();
        $(this).parents('.card-panel').append('<textarea type="text" name="text" class="commentInput materialize-textarea " ></textarea><input type="submit" id="' + commentId + '" class="btn saveComment" value="Save">');
        return false;

    });
    $('.comments').on('click', '.saveComment', function(){
        var commentId = $(this).attr('id');
        var commentContent = $(this).parents('.card-panel').find('.commentInput').val();

        $.ajax({

            type: 'POST',
            url: '/comments/edit',
            data: {id: commentId , text: commentContent},
            dataType: 'json',
            success: function (data) {
                $('#' + commentId).parents('.card-panel').find('.commentContent').text(commentContent).show();
                $('#' + commentId).parents('.card-panel').find('.commentInput').remove();
                $('#' + commentId).parents('.card-panel').find('.saveComment').remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

});