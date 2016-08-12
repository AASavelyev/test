$(document).ready(function(){
    $('[name="show-remove-modal-btn"]').on('click', function(){
        $('#remove-comment-modal').modal();
        $("#removed-comment").val($(this).data('id'))
    });

    $('#remove-comment-btn').on('click', function(){
        window.location.href = "/removeComment.php?id=" + $("#removed-comment").val();
    })
});