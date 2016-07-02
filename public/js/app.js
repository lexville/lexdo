$(document).ready(function(){
    $('#btn-add').click(function() {
        $('#myModal').modal('show');
        $('#btn-save').on('click', function() {
            var task = $('#task').val();
            var description = $('#description').val();
            var data = {task: task, description: description, _token: token };
            // console.log(data);
            $.ajax({
                method: 'POST',
                url: url,
                data: data,
            })
            .done(function(data) {
                // var first = $('tbody tr:first');
                // first.prepend('<tr><td>' + data.task + '</td>'
                //         + '<td>' + data.description + '</td><td></td><td></td><td></td></tr>');
                // console.log(data);
                $('#myModal').modal('hide');
                location.reload();
            })
            .fail(function(req, error) {
                console.log("error");
            })
        });
    });
    $('.task-edit').on('click', function(event) {
        var task = event.target.parentNode.parentNode.childNodes[1].textContent;
        var description = event.target.parentNode.parentNode.childNodes[3].textContent;
        var data = {task: task, description: description, _token: token };
        var id = $(this).data('id');
        console.log($(this).data('id'));
        console.log(task);
        console.log(description);
        $('#task').val(task);
        $('#description').val(description);

        $('#myModal').modal('show');
        $('#btn-save').on('click',function (event){
            event.preventDefault();
            var task = $('#task').val();
            var description = $('#description').val();
            var data = {task: task, description: description, _token: token };
            console.log(data);
            $.ajax({
                method: 'PUT',
                url: url + '/' + id,
                data: data,
            })
            .done(function() {
                $(task).text();
            });
        });

    });
});
