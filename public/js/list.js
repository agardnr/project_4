//triggered when modal is about to be shown
$('#my_Modal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var taskId = $(e.relatedTarget).data('task-id');

    //populate the textbox
    $(e.currentTarget).find('input[name="task_description"]').val(taskId);
});


function troubleshoot() {
    console.log($('15').val());
}

\
