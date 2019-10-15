$(function(){
    $('#search').click( function(e) {
        $("#results").empty();

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url:  'search_groupmember',
            type:  'post',
            data: {
                name: $("#name").val(),
                group_id: $("#group_id").val(),
            },
            success: function(result){
                var text = '';
                $.each(result.users, function (key, value) {
                    $("#results").append('<tr><td scope="row">' + value.name + '</td><td scope="row">' + value.email + '</td><td scope="row"><a class="btn-succes p-2 px-4 ml-4" href="' + result.group.id + '/add_groupmember/' + value.id + '">Invite</a></td></tr>');
                })

            }});

    });

    $('#addtask').click( function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url:  'newtask',
            type:  'post',
            data: {
                name: $("#name").val(),
                description: $("#description").val(),
                group_id: $("#group_id").val(),
            },
            success: function(result){
                    $("#tasks").append(
                        '<tr data-toggle="collapse" data-target="#' + result.id + '" class="accordion-toggle"><th>' + result.name + '</th><td>not claimed</td><td><a class="btn btn-warning btn-sm" href="dotask/' + result.id + '">Do</a></td><td></td></tr><tr><td colspan="4"><div class="accordian-body collapse" id="' + result.id + '">' + result.description +
                        '</div></td></tr>'
                    );
            }});

    });

    function dotask(task_id) {
        console.log('ja' + task_id)

    };
});


