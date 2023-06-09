$(document).ready(function() {
  $('.done').click(function(e) {
    e.preventDefault();
    var taskId = $(this).data('task-id');
    var button = $(this);

    $.post('planTasks.php', {
      taskId: taskId,
      done: true
    }, function(response) {
      console.log(response);
      if (response === 'Task marked as done') {
        button.text('Unfinished');
      } else {
        button.text('Finished');
      }
    });
  });
});
