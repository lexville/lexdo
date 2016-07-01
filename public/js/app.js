var postId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.post-edit').on('click', function(event) {
    event.preventDefault();

    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset.postid;
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function() {
    var data = { body: $('#post-body').val(), postId: postId, _token: token};
    $.ajax({
        method: 'POST',
        url: url,
        data: data
    })
    .done(function (msg) {
        $(postBodyElement).text(msg['new_body']);
        $('#edit-modal').modal('hide');
    });
});
