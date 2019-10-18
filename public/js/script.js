$(function(){
    $('#searchUsers').submit( function(e) {
        $("#results").empty();

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url:  '/groups/group/search_groupmember',
            type:  'post',
            data: {
                name: $("#userName").val(),
                group_id: $("#group_id").val(),
            },
            success: function(result){
                if (result.group) {
                    $.each(result.users, function (key, value) {
                        $("#results").append('<tr><td scope="row">' + value.name + '</td><td scope="row">' + value.email + '</td><td scope="row"><button class="btn btn-success btn-sm send-invite-button"  value="' + result.group.id + '" id="' + value.id +'"><i class="fas fa-paper-plane"></i></button></td></tr>');
                    })
                } else {
                    $.each(result.users, function (key, value) {
                        $("#results").append('<tr><td scope="row">' + value.name + '</td><td scope="row">' + value.email + '</td><td scope="row"><button class="btn btn-success btn-sm add-invite-button" value="' + value.id +'"><i class="fas fa-user-plus"></i></button></td></tr>');
                    })
                }


            },
            error: function() {
                console.log("Name to search must be atleast 5 characters");
            }

        });

    });

    $('#addTask').submit( function(e) {
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
                name: $("#taskName").val(),
                description: $("#taskDescription").val(),
                group_id: $("#group_id").val(),
            },
            success: function(result){
                $("#openTasks").append(
                    '<tr data-toggle="collapse" data-target="#description' + result.id + '" class="accordion-toggle" id="task' + result.id + '"><th>' + result.name +
                    '</th><td>not claimed</td><td><button class="btn btn-warning btn-sm do-task-button" value="' + result.id +
                    '">Do</button></td><td><button class="btn btn-danger btn-sm delete-task-button" value="' + result.id +
                    '"><i class="fas fa-trash"></i></button></td></tr><tr><td colspan="4"><div class="accordian-body collapse" id="description' + result.id + '">' + result.description +
                    '</div></td></tr>'
                );
                $('#taskName').val('');
                $('#taskDescription').val('');

            }
        });

    });

    $('#openTasks').on('click', '.do-task-button', function() {
        $.ajax({
            url: 'dotask/' + $(this).val(),
            type: 'get',
            success: function(result) {
                $('#task' + result.id).next().remove();
                $('#task' + result.id).replaceWith(
                    '<tr data-toggle="collapse" data-target="#' + result.id + '" class="accordion-toggle" id="task' + result.id + '"><th>' + result.name +
                    '</th><td>not claimed</td><td><button class="btn btn-success btn-sm complete-task-button" value="' + result.id + '">Complete</button></td><td><button class="btn btn-danger btn-sm delete-task-button" value="' + result.id + '"><i class="fas fa-trash"></i></button></td></tr><tr><td colspan="4"><div class="accordian-body collapse" id="' + result.id + '">' + result.description +
                    '</div></td></tr>'
                )
            }
        });

    });

    $('#allTasks').on('click', '.delete-task-button', function() {
        if (confirm("Are you sure you want to delete this task?")) {
            $.ajax({
                url: 'deletetask/' + $(this).val(),
                type: 'get',
                success: function (result) {
                    $('#task' + result.id).next().remove();
                    $('#task' + result.id).remove();

                }
            });
        }
    });

    $('#openTasks').on('click', '.complete-task-button', function() {
        if (confirm("Are you sure you want to complete this task?")) {
            $.ajax({
                url: 'completetask/' + $(this).val(),
                type: 'get',
                success: function (result) {
                    var collapse = $('#task' + result.id).next();
                    $('#task' + result.id).find(".complete-task-button").text('Move back').removeClass("complete-task-button btn-success").addClass("open-task-button btn-warning");
                    $('#task' + result.id).detach().appendTo('#completedTasks');
                    collapse.detach().appendTo('#completedTasks');

                }
            });
        }
    });

    $('#completedTasks').on('click', '.open-task-button', function() {
        if (confirm("Are you sure you want to re-open this task?")) {
            $.ajax({
                url: 'opentask/' + $(this).val(),
                type: 'get',
                success: function (result) {
                    var collapse = $('#task' + result.id).next();
                    $('#task' + result.id).find(".open-task-button").text('Complete').removeClass("open-task-button btn-warning").addClass("complete-task-button btn-success");
                    $('#task' + result.id).detach().appendTo('#openTasks');
                    collapse.detach().appendTo('#openTasks');
                }
            });
        }
    });

    $('#results').on('click', '.send-invite-button', function() {
        console.log($(this).val());
        $.ajax({
            url: '/groups/group/' + $(this).val() + '/add_groupmember/' + $(this).attr('id'),
            type: 'get',
            success: function (result) {
                alert(result.name + ' is invited to the group');
            }
        });

    });


    $('#results').on('click', '.add-invite-button', function() {
        $(this).find(".fas").removeClass("fa-user-plus").addClass("fa-user-minus");
        $(this).removeClass("btn-success add-invite-button").addClass("btn-danger remove-invite-button");
        $('#addedGroupmembers').append($(this).parent().parent());
        $('#groupForm').append('<input type="hidden" class="group-user-field" name="group_user_list[]" value="' + $(this).val() + '">');

    });

    $('#addedGroupmembers').on('click', '.remove-invite-button', function() {
        console.log($('.group-user-field').find("[value='" + $(this).val() + "']").val());
        $(this).parent().parent().remove();



    });




});



